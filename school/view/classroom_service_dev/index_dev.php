<!-- Bat dau noi dung -->
<?php
 		//function header
		$function_title="Danh Sách Dịch Vụ";
		echo $this->Template->load_function_header($function_title);
		//end function header
		
		//TIM KIEM
	//*****************************************
		
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>""));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$link_danhsach = $this->Html->link(array("controller"=>"fee","action"=>"index"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
		
		
		//function content
		if($this->Session->get_flash('save_ok')=='true') echo $this->Template->load_label("Lưu thành công","","success");
		
		//lay html table header
		$array_header_table =array(
								"stt"=>array("STT"),
								"name"=>array("Tên Dịch Vụ"), 
								"des"=>array("Mô Tả"),
								"price"=>array("Giá"),
								"code"=>array("Mã dịch vụ"),
								"edit"=>array("Sửa",array("style"=>"text-align:center; width:7%")),
								"del"=>array("Xóa",array("style"=>"text-align:center; width:7%")),
							);
		$str_table_header=$this->Template->load_table_header($array_header_table);
		
		//lay html noi dung classroom_service 
		$str_table_content_classroom_service = "";
		$stt = 1;
		$tongcong = 0;
		foreach($array_classroom_service as $classroom_service)
		{
			$link_sua=$this->Template->load_link("edit","Sửa","/classroom_service/add?id=".$classroom_service["id"]);
			$link_xoa=$this->Template->load_link("del","Xóa","/classroom_service/del?id=".$classroom_service["id"]);
		
			//tao mang noi dung classroom_service
			$array_classroom_service=array(
									"stt"=>array($stt++,array("style"=>"text-align:center;")),
									"name"=>array($classroom_service["name"]),
									"des"=>array($classroom_service["des"]),
									"price"=>array(number_format($classroom_service["price"]),array("style"=>"text-align:center;")),
									"code"=>array($classroom_service["code"]),
									"edit"=>array($link_sua),
									"del"=>array($link_xoa)
									);
			
			$tongcong += $classroom_service["price"];						
									
			//lay html row classroom_service
			$str_table_content_classroom_service.=$this->Template->load_table_row($array_classroom_service);
		}
		
		//thêm vào dòng tổng số giờ
			$array_classroom_service = NULL;
			$array_classroom_service["stt"] 	= array("",array("style"=>"text-align:center;","colspan"=>"2"));
			$array_classroom_service["tongso"] 	= array("Tổng Cộng: ",array("style"=>"text-align:center;"));
			$array_classroom_service["tong"] = array(number_format($tongcong),array("style"=>"text-align:center;"));
			$array_classroom_service["edit"] = array("",array("style"=>"text-align:center;","colspan"=>"2"));
			$str_table_content_classroom_service .= $this->Template->load_table_row($array_classroom_service);
		
		//lay html table classroom_service
			$str_table_classroom_service=$this->Template->load_table($str_table_header. $str_table_content_classroom_service,array("style" =>"width:100%"));
			echo $str_table_classroom_service;
			
		//end function content
	
?>

<!-- Ket thuc noi dung -->

<script type="text/javascript">

	function kiemtra()
	{
		input_name = document.getElementById("name");
		input_des = document.getElementById("des");
		input_price = document.getElementById("price");
		
		if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập tên dịch vụ";
			return;
		}
		if(input_price.value == ""){
			document.getElementById("lbl_price").innerHTML = "Vui lòng nhập giá";
			return;
		}
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
</script>
