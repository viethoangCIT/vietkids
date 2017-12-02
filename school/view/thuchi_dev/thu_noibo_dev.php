<?php 
	$str_form_thuchi = "";
	if($this->get_config("thuchi_noibo") == "combo")
	{
		$id_user_receive = $array_thuchi["id_user_receive"];
		$username_receive = $array_thuchi["username_receive"];
		
		$str_hidden_username = $this->Template->load_hidden(array("name"=>"data[ThuChi][username_receive]","value"=>$username_receive,"id"=>"username_receive"));
		$str_combo_user = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_user_receive]","id"=>"id_user_receive","style"=>"width:200px"),$array_user_noibo,$id_user_receive);
		$str_form_thuchi = $this->Template->load_form_row(array("title"=>$array_title["customer_title"],"input"=>$str_combo_user.$str_hidden_username));
	}
	if($this->get_config("thuchi_noibo") == "text")
	{
		$username_receive = $array_thuchi["username_receive"];
		$str_text_username = $this->Template->load_textbox(array("name"=>"data[ThuChi][username_receive]","value"=>$username_receive,"id"=>"username_receive"));
		$str_form_thuchi = $this->Template->load_form_row(array("title"=>$array_title["customer_title"],"input"=>$str_text_username));
	}
	
	echo $str_form_thuchi
?>