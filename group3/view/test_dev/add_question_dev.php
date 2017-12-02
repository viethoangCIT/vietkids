<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Nhập Câu Hỏi";

	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//*****************************************
	//BEGIN: FORM NHẬP BÀI THI
	//*****************************************


	$name = "";
	$id_test = "";
	$created = "";
	$id_created_user = "";
	if($array_question != null)
	{
		$name = $array_question["0"]["name"];
		$id_test = $array_question["0"]["id_test"];
		$created = $array_question["0"]["created"];
		$id_created_user = $array_question["0"]["id_created_user"];

	}

	$str_form_row_question = "";
	
	//gọi hàm $this->Template->load_input() để tạo string input nhập tên bài this
	$str_input_name_question = $this->Template->load_textbox(array("name"=>"name","value"=>$name,"style"=>"width:200px;"));
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng nhập tên bài thi và input tên bài thi
	$str_form_row_question .= $this->Template->load_form_row(array("title"=>"Tên câu hỏi","input"=>$str_input_name_question));
	
	//tạo textbox mô tả
	$str_select_test = $this->Template->load_selectbox(array("name"=>"id_test","value"=>$id_test,"style"=>"width:200px;"),$array_test);

	$str_form_row_question .= $this->Template->load_form_row(array("title"=>"Bài thi","input"=>$str_select_test));
	
	
	//tạo textbox ngày kết thúc
	$str_input_created_question = $this->Template->load_textbox(array("name"=>"created","value"=>$created,"style"=>"width:200px;"));
	$str_form_row_question .= $this->Template->load_form_row(array("title"=>"Ngày tạo","input"=>$str_input_created_question));
	
	//tạo textbox giờ bắt đầu
	$str_input_id_created_user_question = $this->Template->load_textbox(array("name"=>"id_created_user","value"=>$id_created_user,"style"=>"width:200px;"));
	$str_form_row_question .= $this->Template->load_form_row(array("title"=>"ID users","input"=>$str_input_id_created_user_question));


	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
	$str_form_row_question .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	$str_form_question = $this->Template->load_form(array("method"=>"post","action"=>"/test/add_question"),$str_form_row_question);
	echo $str_form_question;
	
	//tạo
	//*****************************************
	//END: FORM NHẬP BÀI THI
	//*****************************************
?>