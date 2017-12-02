<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Sổ quỹ tiền mặt";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	
	$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
	
	$str_timkiem = $this->Template->load_label(" Loại: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"loai","id"=>"loai","style"=>"width:80px"),$array_type);
	
	$str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay));
	
	$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","id"=>"id_classroom","style"=>"width:230px"),$array_lop_hoc)."<br><br>";
	
	$str_timkiem .= $this->Template->load_label(" Người thu: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","id"=>"id_classroom","style"=>"width:230px"),$array_nguoithu);
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim,"onkeyup"=>"timKiem()"));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	
	$link_danhsach = $this->Html->link(array("controller"=>"revenue","action"=>"index"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"type"=>array("Loại",array("style"=>"text-align:center; width:5%")),
							"username"=>array("Người Thu",array("style"=>"text-align:center; width:10%")),	
							"classroom"=>array("Lớp",array("style"=>"text-align:center")),
							"thongtin_lop"=>array("Thông Tin Lớp",array("style"=>"text-align:center; width:11%")),
							"student_name"=>array("Tên",array("style"=>"text-align:center")),
							"issued_date"=>array("Ngày",array("style"=>"text-align:center; width:10%")),
							"price"=>array("Số Tiền",array("style"=>"text-align:center; width:10%")),
							"tuychon"=>array("Tùy Chọn",array("style"=>"text-align:center; width:8%")),											
					);
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	
	if($array_thuchi != NULL)
	{
		foreach($array_thuchi as $thuchi)
		{
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_product["type"] 			= array($array_type[$thuchi["type"]],array("style"=>"text-align:center;"));
			
			$array_row_product["username"] 	= array($thuchi["username"],array("style"=>"text-align:left;"));
				
			$array_row_product["classroom"] 				= array($thuchi["classroom"],array("style"=>"text-align:left;"));
			
			$thongtin_lop = "Kỳ học: ".$thuchi["semester"]."<br>Năm học: ".$thuchi["year"]."<br>Tháng: ".$thuchi["month"];
			$array_row_product["thongtin_lop"] 		= array($thongtin_lop,array("style"=>"text-align:left;"));
			$array_row_product["student_name"] 	= array($thuchi["student_name"],array("style"=>"text-align:center;"));
			
			$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
			if($issued_date == "01-01-1970") $issued_date = "";
			$array_row_product["issued_date"] 	= array($issued_date,array("style"=>"text-align:center;"));
			
			$array_row_product["price"] 		= array(number_format($thuchi["price"])." ".$thuchi["unit"],array("style"=>"text-align:center;"));
			
			
			$link_sua 	= $this->Html->link(array("controller"=>"revenue","action"=>"add","params"=>array($thuchi["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			
			$link_xoa 				= $this->Html->link(array("controller"=>"revenue","action"=>"del","params"=>array($thuchi["id"])));
			$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			
			$array_row_product ["tuychon"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
			
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"9"));	
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	if($this->get_config("thuchi") == "0")
	{
		if($tong_chi < $tong_thu )$lai = $tong_thu - $tong_chi;
		if($tong_thu < $tong_chi )$lo = $tong_chi - $tong_thu;
		$lai = number_format($lai);
		$lo = number_format($lo);
		$tong_thu = number_format($tong_thu);
		$tong_chi = number_format($tong_chi);
		//thêm vào dòng tổng số dòng
		$array_row_product = NULL;
		$array_row_product["tongchi"] 	= array("Tổng chi: $tong_chi",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"3","id"=>"tongchi"));
		$array_row_product["tongthu"] = array("Tổng thu: $tong_thu",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"3","id"=>"thu"));
		$array_row_product["lai"] 	= array("Lãi: $lai",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"2","id"=>"lai"));
		$array_row_product["lo"] 	= array("Lỗ: $lo",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"2","id"=>"lo"));
		
		$str_row_product .= $this->Template->load_table_row($array_row_product);		
	}
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_thuchi"));
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
	document.getElementById('loai').value = "<?php echo $type; ?>";

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