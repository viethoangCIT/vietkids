
<!-- Bat dau noi dung -->
<?php
	//function header
	$function_title="Danh Sách Loại Lớp Học";
	echo $this->Template->load_function_header($function_title);
	//end function header
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"classroom","action"=>"classroom_type"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
		
	//function content
	
	//lay html table header
	$array_header_table =array(
							"stt"=>array("STT"),
							"name"=>array("Tên Lớp"), 
							"code"=>array("Mã Lớp"), 
							"des"=>array("Mô Tả"),
							"edit"=>array("Sửa",array("style"=>"width: 7%")),
							"del"=>array("Xóa",array("style"=>"width: 7%")),
						);
	$str_table_header=$this->Template->load_table_header($array_header_table);
	
	//lay html noi dung classroom_type 
	$str_table_content_classroom_type = "";
	$stt = 1;
	if($array_classroom_type)
	{
		foreach($array_classroom_type as $classroom_type)
		{
			$link_sua=$this->Template->load_link("edit","Sửa","/classroom/add_classroom_type?id=".$classroom_type["id"]);
			$link_xoa=$this->Template->load_link("del","Xóa","/classroom/del_classroom_type?id=".$classroom_type["id"]);
			//tao mang noi dung classroom_type
			$array_classroom_type=array(
									"stt"=>array($stt++,array("style"=>"text-align: center")),
									"name"=>array($classroom_type["name"]),
									"code"=>array($classroom_type["code"],array("style"=>"text-align: center")),
									"des"=>array($classroom_type["des"]),
									"edit"=>array($link_sua),
									"del"=>array($link_xoa)
									);
			//lay html row classroom_type
			$str_table_content_classroom_type.=$this->Template->load_table_row($array_classroom_type);
		}
	}else
	{
		$array_classroom_type=array(
									"stt"=>array("Không tìm thấy dữ liệu !!",array("style"=>"text-align: center","colspan"=>"6"))
									);
									
		//lay html row classroom_type
		$str_table_content_classroom_type.=$this->Template->load_table_row($array_classroom_type);		
	}
	
	//lay html table classroom
	$str_table_classroom_type=$this->Template->load_table($str_table_header. $str_table_content_classroom_type,array("style" =>"width:100%"));
	echo $str_table_classroom_type;
		
	//end function content
	
?>

<!-- Ket thuc noi dung -->

<script type="text/javascript">
	function kiemtra()
	{
		input_name = document.getElementById("name");
		input_des = document.getElementById("des");
		
		if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập";
			return;
		}
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
</script>

