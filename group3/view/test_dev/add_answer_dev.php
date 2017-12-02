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
	$id_question = "";
	$question_name = "";
	$id_test = "";
	$test_name = "";
	$id_created_user = "";
	$created_username = "";
	$created_fullname = "";
	$created = "";
	if($array_answer != null)
	{
		$name = $array_answer["0"]["name"];
		$id_question = $array_answer["0"]["id_question"];
		$question_name = $array_answer["0"]["question_name"];
		$id_test = $array_answer["0"]["id_test"];
		$test_name = $array_answer["0"]["test_name"];
		$id_created_user = $array_answer["0"]["id_created_user"];
		$created_username = $array_answer["0"]["created_username"];
		$created_fullname = $array_answer["0"]["created_fullname"];
		$created = $array_answer["0"]["created"];

	}
	
	$str_form_row_answer = "";
	
	//gọi hàm $this->Template->load_input() để tạo string input nhập tên bài this
	$str_input_name_answer = $this->Template->load_textbox(array("name"=>"name", "value"=>$name, "style"=>"width:200px;"));
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng nhập tên bài thi và input tên câu hỏi
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Tên","input"=>$str_input_name_answer));
	
	//tạo textbox id câu hỏi
	$str_select_id_question_answer = $this->Template->load_selectbox(array("name"=>"id_question","value"=>$id_question,"style"=>"width:200px;"),$array_question);
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Id Câu hỏi","input"=>$str_select_id_question_answer));
	
	//tạo textbox tên câu hỏi
	$str_input_question_name_answer = $this->Template->load_textbox(array("name"=>"question_name","value"=>$question_name,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Tên câu hỏi","input"=>$str_input_question_name_answer));
	
	//tạo textbox id bài thi
	$str_input_id_test_answer = $this->Template->load_textbox(array("name"=>"id_test","value"=>$id_test,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"ID bài thi","input"=>$str_input_id_test_answer));
	
	//tạo textbox tên bai thi
	$str_input_test_name_answer = $this->Template->load_textbox(array("name"=>"test_name","value"=>$test_name,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Tên bài thi","input"=>$str_input_test_name_answer));
	
	//tạo textbox id user
	$str_input_id_created_user_answer = $this->Template->load_textbox(array("name"=>"id_created_user","value"=>$id_created_user,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Id user","input"=>$str_input_id_created_user_answer));
	
	//tạo textbox tao username
	$str_input_created_username_answer = $this->Template->load_textbox(array("name"=>"created_username","value"=>$created_username,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Username","input"=>$str_input_created_username_answer));

	//tạo textbox tao fullname
	$str_input_created_fullname_answer = $this->Template->load_textbox(array("name"=>"created_fullname","value"=>$created_fullname,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"fullname","input"=>$str_input_created_fullname_answer));

	//tạo textbox tao username
	$str_input_created_answer = $this->Template->load_textbox(array("name"=>"created","value"=>$created,"style"=>"width:200px;"));
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"Ngày tạo","input"=>$str_input_created_answer));
	
	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
	$str_form_row_answer .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button));
	
	$str_form_answer = $this->Template->load_form(array("method"=>"post","action"=>"/test/add_answer"),$str_form_row_answer);
	echo $str_form_answer;
	
	//tạo
	//*****************************************
	//END: FORM NHẬP BÀI THI
	//*****************************************
?>