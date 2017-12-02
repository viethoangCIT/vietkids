<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Theo dõi công nợ";
	
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:90px","value"=>date("d-m-Y",strtotime($tungay))));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:90px","value"=>date("d-m-Y",strtotime($denngay))));
	
	array_unshift($array_lop_hoc,array('id'=>'','value'=>"Chọn lớp"));
	$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"lop","id"=>"loai","style"=>"width:165px","onchange"=>"submit_form()"),$array_lop_hoc,$lop);
	
	array_unshift($array_hocsinh,array('id'=>'','value'=>"Chọn học sinh"));
	$str_timkiem .= $this->Template->load_label(" Học sinh: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"hocsinh","id"=>"loai","style"=>"width:165px","onchange"=>"submit_form()"),$array_hocsinh,$hocsinh);
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:142px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"revenue","action"=>"theodoi_no"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"student_name"=>array("Tên trẻ",array("style"=>"text-align:center; width:15%")),
							"lop"=>array("Lớp",array("style"=>"text-align:center;")),
							"thang"=>array("Tháng",array("style"=>"text-align:center")),	
							"sotien_dukien"=>array("Số tiền nộp dự kiến",array("style"=>"text-align:center")),
							"sotien_danop"=>array("Số tiền đã nộp",array("style"=>"text-align:center")),
							"sotien_sudung"=>array("Số tiền sử dụng",array("style"=>"text-align:center")),	
							"tongtien_thieu"=>array("Tổng tiền thiếu",array("style"=>"text-align:center")),
					);
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$con_no = 0;
	$sotien_da_sudung = 0;
	if($array_thongke_tienno)
	{
		foreach($array_thongke_tienno as $thongke_tienno)
		{
			$month_year = date("m-Y",strtotime($thongke_tienno["thang"]));
			if($month_year != "01-1970")
			{
				$str_service = $thongke_tienno["dichvu"];
				
				$array_str_service = explode(chr(9),$str_service);
				$ten_dichvu = "";
				$gia_dichvu = 0;
				$code_dichvu = "";
				$tien_antoi = $tien_hocphi = $tien_bantru_phuphi = $tien_sua = $tien_dichvukhac = $tien_phuphitoi = $tien_thu7 = $tien_phihoc_daunam = $tien_an = 0;
				for($i = 0;$i < (count($array_str_service)-1);$i++)
				{
					$array_service = explode(chr(8),$array_str_service[$i]);
					if(isset($array_service[0])) $ten_dichvu = $array_service[0];
					if(isset($array_service[1])) $gia_dichvu = $array_service[1];
					if(isset($array_service[3])) $code_dichvu = $array_service[3];
					
					if($code_dichvu == "tienthu7") $tien_thu7 = $gia_dichvu;
					else
					{
						if($code_dichvu == "antoi") $tien_antoi = $gia_dichvu;
						if($code_dichvu == "tienan") $tien_an = $gia_dichvu;
						if($code_dichvu == "hocphi") $tien_hocphi = $gia_dichvu;
						if($code_dichvu == "bantru_phuphi") $tien_bantru_phuphi = $gia_dichvu;
						if($code_dichvu == "sua") $tien_sua = $gia_dichvu;
						if($code_dichvu == "phuphitoi") $tien_phuphitoi = $gia_dichvu;
						if($code_dichvu == "phihoc_daunam") $tien_phihoc_daunam = $gia_dichvu;
						if($code_dichvu == "khac") $tien_dichvukhac += $gia_dichvu;
					}
				}
				
				$sotien_sudung = 0;
				$sotien_sudung_antoi = 0;
				$sotien_sudung_dichvu_khac = 0;
				$songay_dukien = $thongke_tienthua["songay_dukien"];
				$songay_dihoc = $thongke_tienthua["songay_dihoc"];
				$songay_dihoc_thu7 = $thongke_tienthua["songay_dihoc_thu7"];
				
				if($songay_dihoc > 11)
				{
					if($songay_dihoc > $songay_dukien)
					{
						$sotien_sudung = ($tien_an + $tien_sua)/22 * 22 + ($tien_hocphi + $tien_bantru_phuphi);
					}
					else $sotien_sudung = ($tien_an + $tien_sua)/22 * $songay_dihoc + ($tien_hocphi + $tien_bantru_phuphi);
					$sotien_sudung_dichvu_khac = $tien_dichvukhac;
				}else
				{
					$sotien_sudung = (($tien_an + $tien_sua)/22 * $songay_dihoc) + (($tien_hocphi + $tien_bantru_phuphi)/22 * $songay_dihoc);
					$sotien_sudung_dichvu_khac = $tien_dichvukhac / 2;
				}
				
				$songay_antoi = $thongke_tienno["songay_antoi"];
				if($songay_antoi > 11)
				{
					$sotien_sudung_antoi = $tien_antoi / 22 * $songay_antoi + $tien_phuphitoi;
				}else
				{
					$sotien_sudung_antoi = ($tien_antoi + $tien_phuphitoi)/22 * $songay_antoi;	
				}
				
				$sotien_sudung_thu7 = 0;
				if($tien_thu7 > 0)
				{
					$sotien_sudung_thu7 = $songay_dihoc_thu7 * 77000;
				}
				
				$tong_sotien_sudung = $sotien_sudung + $sotien_sudung_antoi + $sotien_sudung_dichvu_khac + $sotien_sudung_thu7;
			
				$stt++;
				$array_row_product = NULL;
				$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
				$array_row_product["student_name"] 		= array($thongke_tienno["fullname"],array("style"=>"text-align:left;"));
				$array_row_product["lop"] 			= array($thongke_tienno["classroom_name"],array("style"=>"text-align:center;"));
				
				$array_row_product["thang"] 			= array($month_year,array("style"=>"text-align:center;"));
				
				$sotien_nopdukien = $thongke_tienno["sotien_dukien"];
				$array_row_product["sotien_dukien"] = array(number_format($sotien_nopdukien),array("style"=>"text-align:center;"));
				
				$sotien_danop = $thongke_tienno["sotien_danop"];
				$array_row_product["sotien_danop"] 	= array(number_format($sotien_danop),array("style"=>"text-align:center;"));
				
				$array_row_product["sotien_sudung"] = array(number_format($tong_sotien_sudung),array("style"=>"text-align:center;"));
				
				$sotien_truythu = 0;
				$tienan_tiensua = $tien_an + $tien_sua;
				if($songay_dihoc > $songay_dukien)
				{
					$sotien_truythu = ($songay_dihoc - $songay_dukien) * $tienan_tiensua / 22; 
					if($tien_antoi > 0) $sotien_truythu += (($songay_dihoc - $songay_dukien) * $tien_antoi / 22);
					if($songay_dihoc_thu7 >= 5) $sotien_truythu += 77000;
				}
				
				$tongtien_thua = $sotien_danop - $tong_sotien_sudung - $sotien_truythu;
				$tongtien_thieu = 0;
				if($tongtien_thua < 0) $tongtien_thieu = abs($tongtien_thua);
				
				$array_row_product["tongtien_thieu"] = array(number_format($tongtien_thieu),array("style"=>"text-align:center;"));
				
				/*$link_chuyen 	= $this->Html->link(array("controller"=>"revenue","action"=>"add"));
				$link_chuyen	= $this->Template->load_link("edit","Chuyển",$link_chuyen);	
				$array_row_product["tuychon"] = array($link_chuyen,array("style"=>"text-align:center;"));*/
				
				//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
				//cong don vao chuoi $str_row_product
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
		}
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  "<div style='overflow:auto'>".$this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_thuchi"))."</div>";
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>


<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})

function submit_form()
{
	document.getElementById("form_timkiem").submit();
}
 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
 </script> 