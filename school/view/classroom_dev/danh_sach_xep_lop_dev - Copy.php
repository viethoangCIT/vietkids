<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Xếp Lớp";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:95px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:95px","value"=>$denngay));
	
	$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","id"=>"id_classroom","style"=>"width:180px"),$array_lop_hoc,$id_classroom);
	
	$array_type = array(""=>"Tất cả","0"=>"Trẻ","1"=>"Giáo viên");
	$str_timkiem .= $this->Template->load_label(" Loại: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"type","id"=>"type","style"=>"width:90px"),$array_type);
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","style"=>"width:128px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất excel","type"=>"button","onclick"=>"exel()"),"Xuất excel");
	
	$link_danhsach = $this->Html->link(array("controller"=>"classroom","action"=>"arrange_list"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_xep_lop =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"student_name"=>array("Họ Và Tên",array("style"=>"text-align:center")),
							"type"=>array("Loại",array("style"=>"text-align:center")),
							"classroom"=>array("Lớp",array("style"=>"text-align:center; width:20%")),
							"start_date"=>array("Ngày Bắt Đầu",array("style"=>"text-align:center;")),	
							"finish_date"=>array("Ngày Kết Thúc",array("style"=>"text-align:center;")),
							"tuychon"=>array("Năm",array("style"=>"text-align:center; width:12%")),
					);
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_xep_lop = $this->Template->load_table_header($array_header_xep_lop);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table xep_lop
	$str_row_xep_lop = "";
	$stt = 0;
	
	if($array_danhsach)
	{
		foreach($array_danhsach as $danhsach)
		{
			$array_row_xep_lop = NULL;
			$stt++;
			
			$array_row_xep_lop["stt"] 			= array($stt,array("style"=>"text-align:center;"));
			
			$array_row_xep_lop["student_name"] 	= array($danhsach["fullname"],array("style"=>"text-align:left;"));
			
			$array_row_xep_lop["type"] 	= array($array_type[$danhsach["type"]],array("style"=>"text-align:center;"));
			
			$array_row_xep_lop["classroom"] 	= array($danhsach["classroom_name"],array("style"=>"text-align:center;"));
			
			$array_row_xep_lop["start_date"] 	= array(date("d-m-Y",strtotime($danhsach["start_date"])),array("style"=>"text-align:center;"));
				
			$array_row_xep_lop["finish_date"] 	= array(date("d-m-Y",strtotime($danhsach["finish_date"])),array("style"=>"text-align:center;"));
			
			//chuyển lớp
			/*$chuyenlop 	= $this->Html->link(array("controller"=>"classroom","action"=>"change_classroom","params"=>array($danhsach["id"])));
			$chuyenlop	= $this->Template->load_link("edit","Chuyển Lớp",$chuyenlop);*/
			
			$array_row_xep_lop["tuychon"] 	= array($danhsach["year"],array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_xep_lop
			$str_row_xep_lop .= $this->Template->load_table_row($array_row_xep_lop);
		}
	}else
	{
		$array_row_xep_lop ["stt"]  = array("Không tìm thấy dữ liệu này !!",array("style"=>"text-align:center;","colspan"=>"7"));
		$str_row_xep_lop .= $this->Template->load_table_row($array_row_xep_lop);
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_xep_lop =  $this->Template->load_table($str_header_xep_lop.$str_row_xep_lop);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_xep_lop;
?>
<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
	document.getElementById('type').value = "<?php echo $type; ?>";

 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
 </script> 