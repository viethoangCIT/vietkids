<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Thêm Người Liên Lạc";
	
	
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	$id = "";
	$id_customer = "";
	$customer_name = "";
	$fullname = "";
	$gender = "";	
	$email = "";
	$phone = "";
	$position = "";
	$username = "";
	$password = "";
	$des = "";	
	$re_pass = "";
	
	if($array_sua)
	{
		$id = $array_sua[0]["id"];
		$id_customer = $array_sua[0]["id_customer"];
		$customer_name = $array_sua[0]["customer_name"];
		$fullname = $array_sua[0]["fullname"];
		$gender = $array_sua[0]["gender"];	
		$email = $array_sua[0]["email"];
		$phone = $array_sua[0]["phone"];
		$position = $array_sua[0]["position"];
		$username = $array_sua[0]["username"];	
		$password = $array_sua[0]["password"];	
		$des = $array_sua[0]["desc"];	
	}
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Khách Hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[customer_user][id_customer]","id"=>"id_customer","style"=>"width:30%"),$array_kh,$id_customer)));
	$str_form_product .= $this->Template->load_hidden(array("name"=>"data[customer_user][customer_name]","value"=>$customer_name,"id"=>"customer_name"));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Họ Tên","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][fullname]","value"=>$fullname,"style"=>"width:80%"))));
	
	$array_gt = array("0"=>"Nữ", "1"=>"Nam");
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Giới Tính","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[customer_user][gender]","style"=>"width:10%"),$array_gt,$gender)));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Email","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][email]","value"=>$email,"style"=>"width:80%"))));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][phone]","value"=>$phone,"style"=>"width:80%"))));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Chức Vụ","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][position]","value"=>$position,"style"=>"width:80%"))));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên Đăng Nhập","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][username]","value"=>$username,"style"=>"width:80%"))));
	
	if($array_sua == NULL)
	{
		$str_form_product .= $this->Template->load_form_row(array("title"=>"Mật Khẩu","input"=>$this->Template->load_textbox(array("name"=>"data[customer_user][password]","value"=>$password,"style"=>"width:80%","type"=>"password","id"=>"pass"))));
	}
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mô Tả","input"=>$this->Template->load_textarea(array("name"=>"data[customer_user][desc]","style"=>"width:80%"),$des)));
	
	$str_id_product = $this->Template->load_hidden(array("name"=>"data[customer_user][id]","value"=>$id));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_product.$this->Template->load_button(array("type"=>"submit"),"Lưu")));

	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/customer/add_user.html","onsubmit"=>"return kiemtra()"),$str_form_product);
	
	echo $str_form_product;
	
?>
<script>
function kiemtra()
{
	document.getElementById("customer_name").value = $("#id_customer :selected").text();	
}
function nhaplai_matkhau()
{
	pass = document.getElementById('pass').value;
	re_pass = document.getElementById('re_pass').value;
	if(pass != re_pass)
	{
		alert('Nhập lại mật khẩu không đúng !!');
		return;
	}
}
</script>
