<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Danh Sách Users";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************

    $str_search_user        = $this->Template->load_textbox(array("name"=>"search","style"=>"width:200px;text-align:left;"));
    $str_buton_search       = $this->Template->load_button(array("value"=>"luu","type"=>"submit"),"Tìm");

    $str_load_form_row      = "";
    $str_load_form_row      .=  $this->Template->load_form_row(array("title"=>"","input"=>$str_search_user.$str_buton_search));

    $str_form_search_user   = $this->Template->load_form(array("method"=>"POST","action"=>"/user3/index"),$str_load_form_row);
    echo $str_form_search_user;
    

    echo "<a href = '/user3/add' style='align:right'>Thêm user</a>";

    $array_table_header = array(
        "num"           =>array("stt",array("style"=>"width:1%;text-align:center")),
        "username"      =>array("Username",array("style"=>"width:1%;text-align:center")),
        "fullname"      =>array("Họ Tên",array("style"=>"width:1%;text-align:center")),
        "gender"        =>array("Giới tính",array("style"=>"width:1%;text-align:center")),
        "birthday"      =>array("Ngày sinh",array("style"=>"width:1%;text-align:center")),
        "email"         =>array("Email",array("style"=>"width:1%;text-align:center")),
        "phone"         =>array("Số điện thoại",array("style"=>"width:1%;text-align:center")),
        "id_number"     =>array("Số CMND",array("style"=>"width:1%;text-align:center")),
        "address"       =>array("Địa chỉ thường trú",array("style"=>"width:1%;text-align:center")),
        "level"         =>array("Trình độ",array("style"=>"width:1%;text-align:center")),
        "specialize"    =>array("Chuyên môn",array("style"=>"width:1%;text-align:center")),
        "start_date"    =>array("Ngày vào công ty",array("style"=>"width:1%;text-align:center")),
        "status"        =>array("Trạng thái",array("style"=>"width:1%;text-align:center")),
        "facebook"      =>array("Link facebook",array("style"=>"width:1%;text-align:center")),
        "profile"       =>array("Hình minh họa",array("style"=>"width:1%;text-align:center")),
        "edit"	        =>array("Sửa",array("style"=>"width:1%;text-align:center")),
        "delete"		=>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );

    $str_table_header = $this->Template->load_table_header($array_table_header);

    $str_table_row = "";

    if($array_user != null)
    {
        $stt=0;
        foreach($array_user as $user)
        {
            //tao duong dan cho file
            $link_file = $this->Company->file_url.$user["profile"];
            $stt++;
			$array_table_row = null;
			$array_table_row["num"]         = array($stt,array("text-align:center"));
            $array_table_row["username"]    = array($user["username"],array("text-align:center"));
            $array_table_row["fullname"]    = array($user["fullname"],array("text-align:center"));
            $array_table_row["gender"]      = array($user["gender"],array("text-align:center"));
            $user["birthday"]               = date("d-m-Y",strtotime($user["birthday"])); 
            $array_table_row["birthday"]    = array($user["birthday"],array("text-align:center"));
            $array_table_row["email"]       = array($user["email"],array("text-align:center"));
            $array_table_row["phone"]       = array($user["phone"],array("text-align:center"));
            $array_table_row["id_number"]   = array($user["id_number"],array("text-align:center"));
            $array_table_row["address"]     = array($user["address"],array("text-align:center"));
            $array_table_row["level"]       = array($user["level"],array("text-align:center"));
            $array_table_row["specialize"]  = array($user["specialize"],array("text-align:center"));
            $array_table_row["start_date"]  = array($user["start_date"],array("text-align:center"));
            $array_table_row["status"]      = array($user["status"],array("text-align:center"));
            $array_table_row["facebook"]    = array($user["facebook"],array("text-align:center"));
            $array_table_row["profile"]     = array("<img src=".$link_file." style = 'width:50px;height:50px;'>",array("text-align:center"));
            
            //tạo linh sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/user3/add/".$user["id"].".html");
			$array_table_row["edit"]        = array($str_link_edit,array("text-align:center"));

			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/user3/index/".$user["id"].".html?act=del");
			$array_table_row["option"]      = array($str_link_delete,array("text-align:center"));
    

            $str_table_row .=$this->Template->load_table_row($array_table_row,array("align"=>"center","id"=>"table_posts"));
                
        }
    }

    $str_table=  $this->Template->load_table($str_table_header.$str_table_row,array("align"=>"center","id"=>"table_posts"));
    
        echo $str_table;

?>

<!-- up load hinh -->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>

<?php
   echo $this->Template->load_upload_js("file","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf"),"1","xem_hinh_minhhoa");
    
?>