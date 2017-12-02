<?php
	$customer_tax="";
	$id_customer="";
	$customer_name="";
	$customer_phone="";
	$customer_address="";
	$customer_id_group="";
	$customer_group="";
	$str_form_thuchi="";
	if($array_customer_detail)
	{	
		
		$customer_tax=$array_customer_detail[0]['tax_code'];
		$id_customer=$array_customer_detail[0]['id'];
		$customer_name=$array_customer_detail[0]['fullname'];
		$customer_phone=$array_customer_detail[0]['phone'];
		$customer_address=$array_customer_detail[0]['address'];
		$customer_id_group=$array_customer_detail[0]['id_group'];
		$customer_group=$array_customer_detail[0]['group'];
	}
	
	$input_tax=$this->Template->load_textbox(array("name"=>"data[ThuChi][customer_tax]","id"=>"customer_tax","value"=>$customer_tax,"style"=>"width:200px"));
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tên Khách Hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_customer]","id"=>"id_customer","style"=>"width:300px","onchange"=>"this.form.submit()"),$array_customer,$id_customer)." <label class='control-label' style='margin:0px 10px'>Mã số thuế </label>".$input_tax));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][customer_name]","value"=>$customer_name,"id"=>"customer_name"));
	$input_address = $this->Template->load_textbox(array("name"=>"data[ThuChi][customer_address]","id"=>"customer_address","value"=>$customer_address,"style"=>"width:300px"));
	$input_phone = $this->Template->load_textbox(array("name"=>"data[ThuChi][customer_phone]","id"=>"customer_phone","value"=>$customer_phone,"style"=>"width:200px"));
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Địa Chỉ","input"=>$input_address." <label class='control-label' style='margin:0px 12px'>Telephone </label>".$input_phone));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][customer_group]","value"=>$customer_id_group,"id"=>"customer_group"));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][customer_group_name]","value"=>$customer_group,"id"=>"customer_group_name"));
	
	if($this->get_config("thuchi_customer_nguoilienlac") == "yes")
	{
		$id_user_receive = $array_thuchi["id_user_receive"];
		$username_receive = $array_thuchi["username_receive"];
		
		//$array_nguoilienlac = array_unshift($array_nguoilienlac,"...");
		
		
		$str_hidden_username = $this->Template->load_hidden(array("name"=>"data[ThuChi][username_receive]","value"=>$username_receive,"id"=>"username_receive"));
		$str_combo_user = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_user_receive]","id"=>"id_user_receive","style"=>"width:200px"),$array_nguoilienlac,$id_user_receive);
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$array_title["customer_title"],"input"=>$str_combo_user.$str_hidden_username));
	}
	echo $str_form_thuchi
?>
<script>
	$( "#customer_name" ).val($("#id_customer :selected").text());
	$( "#id_customer" ).change(function() {  $( "#customer_name" ).val($("#id_customer :selected").text());	});
</script>