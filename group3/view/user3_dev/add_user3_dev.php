<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Thêm User";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER

    //*****************************************

    $fullname = "";
    $username = "";
    $password = "";
	$gender = "";
    $birthday = "";
    $email = "";
    $phone = "";
    $id_number = "";
    $date_of_issue = "";
    $place_of_issue = "";
    $address = "";
    $ward = "";
    $district = "";
    $city = "";
    $country = "";
    $address2 = "";
    $ward2 = "";
    $district2 = "";
    $city2 = "";
    $country2 = "";
    $level = "";
    $degree = "";
    $schools = "";
    $specialize = "";
    $start_date = "";
    $status = "";
    $facebook = "";
    $profile = "";
    $id = "";

    //kiểm tra array_user từ view truyên qua có null hay không
    //nếu không null thì lấy giá trị từng phần từ trong mảng
    //để hiển thị ra form sửa
	if($array_user != null)
	{
        $id             = $array_user[0]["id"];
		$fullname       = $array_user[0]["fullname"];
		$username       = $array_user[0]["username"];
		$password       = $array_user[0]["password"];
        $gender         = $array_user[0]["gender"];
        $birthday       = date("d-m-Y",strtotime($array_user[0]["birthday"]));//chuyển đôi định dạng qua ngày tháng năm
        $email          = $array_user[0]["email"];
        $phone          = $array_user[0]["phone"];
        $id_number      = $array_user[0]["id_number"];
        $date_of_issue  = date("d-m-Y",strtotime($array_user[0]["date_of_issue"]));
        $place_of_issue = $array_user[0]["place_of_issue"];
        $address        = $array_user[0]["address"];
        $ward           = $array_user[0]["ward"];
        $district       = $array_user[0]["district"];
        $city           = $array_user[0]["city"];
        $country        = $array_user[0]["country"];
        $address2       = $array_user[0]["address2"];
        $ward2          = $array_user[0]["ward2"];
        $district2      = $array_user[0]["district2"];
        $city2          = $array_user[0]["city2"];
        $country2       = $array_user[0]["country2"];
        $level          = $array_user[0]["level"];
        $degree         = $array_user[0]["degree"];
        $schools        = $array_user[0]["schools"];
        $specialize     = $array_user[0]["specialize"];
        $start_date     = date("d-m-Y",strtotime($array_user[0]["start_date"]));
        $status         = $array_user[0]["status"];
        $facebook       = $array_user[0]["facebook"];
        $profile        = $array_user[0]["profile"];

	}

    $str_input_table_fullname       = $this->Template->load_textbox(array("name"=>"data[fullname]","value"=>$fullname,"style"=>"width:200px;"));
    $str_input_table_username       = $this->Template->load_textbox(array("name"=>"data[username]","value"=>$username,"style"=>"width:200px;"));
    $str_input_table_password       = $this->Template->load_textbox(array("name"=>"data[password]","value"=>$password,"style"=>"width:200px;"));
    $str_input_table_gender         = $this->Template->load_textbox(array("name"=>"data[gender]","value"=>$gender,"style"=>"width:200px;"));
    $str_input_table_birthday       = $this->Template->load_textbox(array("name"=>"data[birthday]","value"=>$birthday,"style"=>"width:200px;","id"=>"birthday"));
    $str_input_table_email          = $this->Template->load_textbox(array("name"=>"data[email]","value"=>$email,"style"=>"width:200px;"));
    $str_input_table_phone          = $this->Template->load_textbox(array("name"=>"data[phone]","value"=>$phone,"style"=>"width:200px;"));
    $str_input_table_id_number      = $this->Template->load_textbox(array("name"=>"data[id_number]","value"=>$id_number,"style"=>"width:200px;"));
    $str_input_table_date_of_issue  = $this->Template->load_textbox(array("name"=>"data[date_of_issue]","value"=>$date_of_issue,"style"=>"width:200px;","id"=>"date_of_issue"));
    $str_input_table_place_of_issue = $this->Template->load_textbox(array("name"=>"data[place_of_issue]","value"=>$place_of_issue,"style"=>"width:200px;"));
    $str_input_table_address        = $this->Template->load_textbox(array("name"=>"data[address]","value"=>$address,"style"=>"width:200px;"));
    $str_input_table_ward           = $this->Template->load_textbox(array("name"=>"data[ward]","value"=>$ward,"style"=>"width:200px;"));
    $str_input_table_district       = $this->Template->load_textbox(array("name"=>"data[district]","value"=>$district,"style"=>"width:200px;"));
    $str_input_table_city           = $this->Template->load_textbox(array("name"=>"data[city]","value"=>$city,"style"=>"width:200px;"));
    $str_input_table_country        = $this->Template->load_textbox(array("name"=>"data[country]","value"=>$country,"style"=>"width:200px;"));
    $str_input_table_address2       = $this->Template->load_textbox(array("name"=>"data[address2]","value"=>$address2,"style"=>"width:200px;"));
    $str_input_table_ward2          = $this->Template->load_textbox(array("name"=>"data[ward2]","value"=>$ward2,"style"=>"width:200px;"));
    $str_input_table_district2      = $this->Template->load_textbox(array("name"=>"data[district2]","value"=>$district2,"style"=>"width:200px;"));
    $str_input_table_city2          = $this->Template->load_textbox(array("name"=>"data[city2]","value"=>$city2,"style"=>"width:200px;"));
    $str_input_table_country2       = $this->Template->load_textbox(array("name"=>"data[country2]","value"=>$country2,"style"=>"width:200px;"));
    $str_input_table_level          = $this->Template->load_textbox(array("name"=>"data[level]","value"=>$level,"style"=>"width:200px;"));
    $str_input_table_degree         = $this->Template->load_textbox(array("name"=>"data[degree]","value"=>$degree,"style"=>"width:200px;"));
    $str_input_table_schools        = $this->Template->load_textbox(array("name"=>"data[schools]","value"=>$schools,"style"=>"width:200px;"));
    $str_input_table_specialize     = $this->Template->load_textbox(array("name"=>"data[specialize]","value"=>$specialize,"style"=>"width:200px;"));
    $str_input_table_start_date     = $this->Template->load_textbox(array("name"=>"data[start_date]","value"=>$start_date,"style"=>"width:200px;","id"=>"start_date"));
    $str_input_table_status         = $this->Template->load_textbox(array("name"=>"data[status]","value"=>$status,"style"=>"width:200px;"));
    $str_input_table_facebook       = $this->Template->load_textbox(array("name"=>"data[facebook]","value"=>$facebook,"style"=>"width:200px;"));
    $str_input_file                 = $this->Template->load_textbox(array("name"=>"data[profile]","value"=>$profile,"id"=>"file","style"=>"width:50%"));
	$str_hidden_id                  = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id));
    $str_uploadbar                  = $this->Template->load_upload_bar("upload_container","select_img","upload_img","list_img","result_upload");
    $str_buton_save                 = $this->Template->load_button(array("value"=>"luu","type"=>"submit"),"Lưu");

    $str_load_form_row = "";
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Họ và tên","input"=>$str_input_table_fullname));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Username","input"=>$str_input_table_username));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Mật khẩu","input"=>$str_input_table_password));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Giới tính","input"=>$str_input_table_gender));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Ngày sinh","input"=>$str_input_table_birthday));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Địa chỉ","input"=>$str_input_table_address));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Email","input"=>$str_input_table_email));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Số điện thoại","input"=>$str_input_table_phone));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Số CMND","input"=>$str_input_table_id_number));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Ngày cấp","input"=>$str_input_table_date_of_issue));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Nơi cấp","input"=>$str_input_table_place_of_issue));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Phường/xã thường trú","input"=>$str_input_table_ward));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Quận/huyện thường trú","input"=>$str_input_table_district));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Thành phố thường trú","input"=>$str_input_table_city));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Quốc gia thường trú","input"=>$str_input_table_country));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Địa chỉ tạm trú","input"=>$str_input_table_address2));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Phường/xã tạm trú","input"=>$str_input_table_ward2));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Quận/huyện tạm trú","input"=>$str_input_table_district2));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Thành phố tạm trú","input"=>$str_input_table_city2));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Quốc gia tạm trú","input"=>$str_input_table_country2));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Trình độ","input"=>$str_input_table_level));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Bằng cấp","input"=>$str_input_table_degree));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Trường học","input"=>$str_input_table_schools));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Chuyên môn","input"=>$str_input_table_specialize));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Ngày vào công ty","input"=>$str_input_table_start_date));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Trạng thái","input"=>$str_input_table_status));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Link Facebook","input"=>$str_input_table_facebook));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"Hình minh họa","input"=>$str_input_file.$str_uploadbar));
    $str_load_form_row .=  $this->Template->load_form_row(array("title"=>"","input"=>$str_buton_save.$str_hidden_id));

    $str_form_user = $this->Template->load_form(array("method"=>"POST","action"=>"/user3/add"),$str_load_form_row);
    echo $str_form_user;




?>

<!-- chuyển đổi định dạng ngày sang ngày-tháng-năm -->
<script>
    $(function()
    {
        $( "#birthday" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#date_of_issue" ).datepicker({dateFormat: "dd-mm-yy"});
        $( "#start_date" ).datepicker({dateFormat: "dd-mm-yy"});
    });
</script>


<!-- up load hinh -->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js"></script>

<?php
   echo $this->Template->load_upload_js("file","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf"),"1","xem_hinh_minhhoa");
    
?>