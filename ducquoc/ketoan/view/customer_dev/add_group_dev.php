<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Thêm Nhóm Khách Hàng";
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	$id = "";
	$name = "";
	$desc = "";	
	if($array_sua)
	{
		$id = $array_sua[0]["id"];
		$name = $array_sua[0]["name"];
		$desc = $array_sua[0]["desc"];	
	}
	$str_form_product = $this->Template->load_form_row(array("title"=>"Tên Nhóm","input"=>$this->Template->load_textbox(array("name"=>"data[CustomerGroup][name]","value"=>$name,"style"=>"width:80%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mô Tả","input"=>$this->Template->load_textarea(array("name"=>"data[CustomerGroup][desc]","style"=>"width:80%"),$desc)));
	$str_id_product = $this->Template->load_hidden(array("name"=>"data[CustomerGroup][id]","value"=>$id));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_product.$this->Template->load_button(array("type"=>"submit"),"Lưu")));


	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/customer/add_group.html"),$str_form_product);
	
	echo $str_form_product;
	
?>

