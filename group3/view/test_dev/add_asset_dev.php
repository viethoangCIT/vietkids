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

	$id = "";
	$name = "";
	$code = "";
	$date_input = "";
	$des = "";
	$status = "";
	$modified = "";
	if($array_asset != null)
	{
		$name = $array_asset["0"]["name"];
		$id = $array_asset["0"]["id"];
		$code = $array_asset["0"]["code"];


		$date_input = date("d-m-Y",strtotime($array_asset["0"]["date_input"]));


		$des = $array_asset["0"]["des"];
		$status = $array_asset["0"]["status"];


	}

	$array_status = array("1"=>"Đang sử dụng","2"=>"Hỏng");

	//tạo tiêu đề hàm
	$str_form_row_asset = "";

	//goi ham this->template->load_inout() de tao  string input nhap
	$str_input_name_asset = $this->Template->load_textbox(array("name"=>"data[name]","value"=>$name,"style"=>"width:200px;"));
	//tao mot dong nhap ten tai san
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"Tên tài sản","input"=>$str_input_name_asset));

	//tao input nhap code
	$str_input_code_asset = $this->Template->load_textbox(array("name"=>"data[code]","value"=>$code,"style"=>"width:200px;"));
	//tao dong nhao ten code
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"Mã tài sản","input"=>$str_input_code_asset));


	//tao input ngay nhap
	$str_input_date_input_asset = $this->Template->load_textbox(array("name"=>"data[date_input]","value"=>$date_input,"style"=>"width:200px;","id"=>"date_input"));
	//tao dong nhao ten code
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"Ngày Nhập","input"=>$str_input_date_input_asset));

	//tao input nhap mo ta
	$str_input_des_asset = $this->Template->load_textbox(array("name"=>"data[des]","value"=>$des,"style"=>"width:200px;"));
	//tao dong nhao ten code
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_des_asset));

	//tao select trang thai
	$str_select_status_asset = $this->Template->load_selectbox_basic(array("name"=>"data[status]","value"=>$status,"style"=>"width:200px;"),$array_status);
	//tao dong nhao ten code
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"Trạng thái","input"=>$str_select_status_asset));



	//tao hidden id
	$str_hidden_id_asset = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id));
	
	//gọi hàm $this->Template->load_button() để tạo string input type = button, nút bấm để lưu
	$str_save_button = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");
	
	//gọi hàm $this->Template->load_form_row để tạo một dòng có nút lưu
	$str_form_row_asset .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_hidden_id_asset));


	
	//đưa vào form
	$str_form_asset = $this->Template->load_form(array("method"=>"POST","action"=>"/asset/add"),$str_form_row_asset);
	echo $str_form_asset; 
?>

 <script>
    	$(function()
{
	$( "#date_input" ).datepicker({dateFormat: "dd-mm-yy"})
});

</script>