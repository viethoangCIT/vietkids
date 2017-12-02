<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Import Dữ Liệu Khách Hàng";
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	

	$str_form_customer = $this->Template->load_form_row(array("title"=>"Tên Nhóm","input"=>$this->Template->load_selectbox(array("name"=>"data[Customer][id_group]","style"=>"width:80%"),$array_group)));

	//tao dong hinh dai dien
	$str_input_upload = $this->Template->load_textbox(array("name"=>"data[Customer][file]","id"=>"file","value"=>"","style"=>"width: 80%"));
	$str_input_upload .=$this->Template->load_upload_bar("upload_button","upload_container","upload_hinhanh1","list_hinhanh1","ketqua_upload1");
	$str_form_customer .= $this->Template->load_form_row(array("title"=>"Upload file","input" =>$str_input_upload));

	
	
	$str_form_customer .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit"),"Import")));


	$str_form_customer = $this->Template->load_form(array("method"=>"POST","action"=>"/customer/import.html"),$str_form_customer);
	
	echo $str_form_customer;
	
	
	//gọi hàm load_upload_js: 
	//tham số 1: id của input, nơi mà upload xong sẽ trả kết quả phản hồi từ server về sau khi upload xong
	//tham số 2: id của nút lệnh chọn file, khi bấm vào nút chọn file thì sẽ hiển thị hộp thoại file browse
	//tham số 3: thẻ div: container chứa kết quả upload
	//4: nut bam de upload file
	//5: danh sach chua cac file dang trong qua trinh upload
	//6: console chua error
	echo $this->Template->load_upload_js("file","upload_button","upload_container","upload_hinhanh1","list_hinhanh1","ketqua_upload1","uploader1");
	
?>

