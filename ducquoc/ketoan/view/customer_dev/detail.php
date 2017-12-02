<style>
.control-label{font-weight:bold !important}
.controls{padding: 10px 0px 5px 0px !important}

</style>
<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Chi Tiết Khách Hàng";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	$id = "";
	$fullname = "";
	$code = "";	
	$gender = "";	
	$birthdate = "";	
	$email = "";
	$phone = "";
	$address = "";
	$company = "";
	$type = "";
	$id_group = "";
	$group = "";
	
	$deputy = "";
	$contact_name = "";
	$contact_phone = "";
	$contact_email = "";	
	$business_areas = "";
	if($array_kh)
	{
		$id = $array_kh[0]["id"];
		$fullname = $array_kh[0]["fullname"];
		$code = $array_kh[0]["code"];	
		$gender = $array_kh[0]["gender"];	
		$birthdate = date("d-m-Y",strtotime($array_kh[0]["birthdate"]));
		$email = $array_kh[0]["email"];
		$phone = $array_kh[0]["phone"];
		$address = $array_kh[0]["address"];
		$type = $array_kh[0]["type"];	
		$company = $array_kh[0]["company"];
		$id_group = $array_kh[0]["id_group"];	
		$group = $array_kh[0]["group"];
		$business_areas = $array_kh[0]["business_areas"];
		$deputy = $array_kh[0]["deputy"];
		$contact_name  = $array_kh[0]["contact_name"];
		$contact_phone = $array_kh[0]["contact_phone"];
		$contact_email = $array_kh[0]["contact_email"];
	}
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Mã Khách Hàng","input"=>$code));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên Khách Hàng","input"=>$fullname));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Email","input"=>$email));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại","input"=>$phone));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Địa Chỉ","input"=>$address));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Nhóm","input"=>$group));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Lĩnh Vực Kinh Doanh","input"=>$business_areas));
	$array_loai = array("0"=>"Cá nhân", "1"=>"Tổ chức");
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Loại","input"=>$array_loai[$type]));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Đơn Vị Công Tác","input"=>$company));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Người đại diện","input"=>$deputy));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Người liên hệ","input"=>$contact_name));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Email liên hệ","input"=>$contact_email));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại liên hệ","input"=>$contact_phone));
	
	
	
	$str_form_post = $this->Template->load_form(array("method"=>"POST","action"=>""),$str_form_product);
	
	echo $str_form_post;

	
?>

