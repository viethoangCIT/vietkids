<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Nhập Bài Thi";

	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//*****************************************
	//BEGIN: FORM NHẬP BÀI THI
	//*****************************************

	$test_name = "";
	$desc = "";
	$day_start = "";
	$day_finish = "";
	$hour_start = "";
	$hour_finish = "";
	$created = "";
	$id ="";
	if($array_test != null)
	{
		$test_name = $array_test["0"]["name"];
		$id = $array_test["0"]["id"];
		$desc = $array_test["0"]["desc"];
		$day_start = $array_test["0"]["day_start"];
		$day_finish = $array_test["0"]["day_finish"];
		$hour_start = $array_test["0"]["hour_start"];
		$hour_finish = $array_test["0"]["hour_finish"];
		$created = $array_test["0"]["created"];

	}
	$str_form_row_test = "";
	
	//gọi hàm $this->Template->load_input() để tạo string input nhập tên bài this
	$str_input_name_test = $this->Template->load_textbox(array("name"=>"data[name]", "value"=>$test_name, "style"=>"width:200px;"));
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng nhập tên bài thi và input tên bài thi
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Tên bài thi","input"=>$str_input_name_test));
	
	//tạo textbox mô tả
	$str_input_desc_test = $this->Template->load_textbox(array("name"=>"data[desc]","value"=>$desc,"style"=>"width:200px;"));
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_desc_test));
	
	//tạo textbox ngày bắt đầu
	$str_input_day_start_test = $this->Template->load_textbox(array("name"=>"data[day_start]","value"=>$day_start,"style"=>"width:200px;"));
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Ngày bắt đầu","input"=>$str_input_day_start_test));
	
	//tạo textbox ngày kết thúc
	$str_input_day_finish_test = $this->Template->load_textbox(array("name"=>"data[day_finish]","value"=>$day_finish,"style"=>"width:200px;"));
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Ngày kết thúc","input"=>$str_input_day_finish_test));
	
	//tạo textbox giờ bắt đầu
	$str_input_hour_start_test = $this->Template->load_textbox(array("name"=>"data[hour_start]","value"=>$hour_start,"style"=>"width:200px;"));
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Giờ bắt đầu","input"=>$str_input_hour_start_test));
	
	//tạo textbox giờ kết thúc
	$str_input_hour_finish_test = $this->Template->load_textbox(array("name"=>"data[hour_finish]","value"=>$hour_finish,"style"=>"width:200px;"));
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"Giờ kết thúc","input"=>$str_input_hour_finish_test));
	
	//tao hidden id
	$str_hidden_id_test = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id));
	
	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
	$str_form_row_test .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_hidden_id_test));
	
	$str_form_test = $this->Template->load_form(array("method"=>"post","action"=>"/test/add"),$str_form_row_test);
	echo $str_form_test;
	
	//tạo
	//*****************************************
	//END: FORM NHẬP BÀI THI
	//*****************************************
?>