<?php
	if($this->get_config("thuchi_thukhac") == "yes")
	{
	$input_name_nguoinhan = $this->Template->load_textbox(array("name"=>"data[ThuChi][username_receive]","id"=>"username_receive","value"=>$username_receive,"style"=>"width:300px"));
	$str_row_nguoinhan = $this->Template->load_form_row(array("title"=>$array_title["customer_title"],"input"=>$input_name_nguoinhan));
	
	echo $str_row_nguoinhan;
	}


?>