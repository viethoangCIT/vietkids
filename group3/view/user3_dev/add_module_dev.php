<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "ADD MODULE";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************

    $str_input_title = $this->Template->load_textbox(array("name"=>"data[title]","style"=>"width:200px;"));
    $str_input_package = $this->Template->load_textbox(array("name"=>"data[package]","style"=>"width:200px;"));
    $str_input_folder = $this->Template->load_textbox(array("name"=>"data[folder]","style"=>"width:200px;"));
    $str_input_classname = $this->Template->load_textbox(array("name"=>"data[classname]","style"=>"width:200px;"));
    $str_input_des = $this->Template->load_textbox(array("name"=>"data[des]","style"=>"width:200px;"));
    $str_button_save = $this->Template->load_button(array("value"=>"luu","type"=>"submit"),"lưu");
    $str_form_row_module = "";
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Tên Module","input"=>$str_input_title));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Tên package","input"=>$str_input_package));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Tên Folder","input"=>$str_input_folder));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Tên Class","input"=>$str_input_classname));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_des));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"","input"=>$str_button_save));

    $str_load_form = $this->Template->load_form(array("method"=>"POST","action"=>""),$str_form_row_module);
    echo $str_load_form;
?>