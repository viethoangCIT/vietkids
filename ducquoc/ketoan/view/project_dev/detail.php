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
	$id = '';
	$code = '';  
    $name = '';       
    $desc = "";      
    $id_customer = "";      
    $customer_name ="";
	$start_date ="";
	$finish_date ="";
	$place = "";
	
	$org = "";
	$org_address = "";
	$org_phone = "";
	
	$manager_name = "";
	$manager_phone = "";
	$manager_email = "";
	
	$created_time = "";
	$note = "";
	$remind_time = "";
	
	$str_file = $array_sua[0]['str_file'];
	
    if($array_sua)
	{
            $id = $array_sua[0]['id'];
            $name = $array_sua[0]['name'];
			$code = $array_sua[0]['code'];
            $desc = $array_sua[0]['desc'];           
            $customer_name = $array_sua[0]['customer_name']; 
			$id_customer = $array_sua[0]['id_customer'];   
			$start_date = date("d-m-Y",strtotime($array_sua[0]['start_date']));
			$finish_date = date("d-m-Y",strtotime($array_sua[0]['finish_date']));
			$place = $array_sua[0]['place']; 
	
			$org = $array_sua[0]['org']; 
			$org_address = $array_sua[0]['org_address']; 
			$org_phone = $array_sua[0]['org_phone']; 
			
			$manager_name = $array_sua[0]['manager_name']; 
			$manager_phone = $array_sua[0]['manager_phone']; 
			$manager_email = $array_sua[0]['manager_email'];
			
			$created_time = date("d-m-Y",strtotime($array_sua[0]['created_time']));
			$note = $array_sua[0]['note']; 
			$remind_time = $array_sua[0]['remind_time'];
			
			$str_file = $array_sua[0]['str_file'];
			 
    }
	$str_form_product = $this->Template->load_form_row(array("title"=>"Mã dự án","input"=>$code));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên dự án","input"=>$name));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên khách hàng","input"=>$customer_name));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày bắt đầu","input"=>$start_date));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày kết thúc","input"=>$finish_date));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Địa điểm thực hiện","input"=>$place));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Đơn vị quản lý","input"=>$org));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Địa chỉ","input"=>$org_address));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Điện thoại","input"=>$org_phone));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Người quản lý","input"=>$manager_name));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Email","input"=>$manager_email));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Điện thoại","input"=>$manager_phone));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Thời điểm tạo","input"=>$created_time));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ghi chú","input"=>$note));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày nhắc nhở tính từ thời điểm tạo","input"=>$remind_time));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mô Tả","input"=>$desc));
	$link_file 	=  $this->Company->file_url.$this->Company->upload_url.$str_file;
	$link_file	= $this->Template->load_link("download","Tải",$link_file);	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"File đính kèm","input"=>$link_file));
	
	
	
	
	$str_form_post = $this->Template->load_form(array("method"=>"POST","action"=>""),$str_form_product);
	
	echo $str_form_post;

	
?>

