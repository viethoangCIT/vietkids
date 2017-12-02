<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Hình Ảnh";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************
    $id_picture = "";
    $name = "";
    if($array_edit_picture != null)
    {   
        $id_picture = $array_edit_picture[0]["id"];
        $name = $array_edit_picture[0]["name"]; 
    }

    $str_form_row_picture = "";
    $str_input_name = $this->Template->load_textbox(array("name"=>"data[name]","value"=>$name,"style"=>"width:50%"));
    $str_input_file = $this->Template->load_textbox(array("name"=>"data[file]","value","id"=>"file","style"=>"width:50%"));
    $str_input_des = $this->Template->load_textbox(array("name"=>"data[des]","style"=>"width:50%"));
    $str_hidden_picture = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id_picture));
    $str_hidden_id_post = $this->Template->load_hidden(array("name"=>"data[id_post]","value"=>$id_post));
    $str_hidden_article = $this->Template->load_hidden(array("name"=>"data[type]","value"=>$type));
    $str_save_button = $this->Template->Load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");

    $str_uploadbar = $this->Template->load_upload_bar("upload_container","select_img","upload_img","list_img","result_upload");
    $str_form_row_picture .= $this->Template->load_form_row(array("title"=>"Tên Hình ảnh","input"=>$str_input_name));
    $str_form_row_picture .= $this->Template->load_form_row(array("title"=>"File Đính kèm","input"=>$str_input_file.$str_uploadbar));
    $str_form_row_picture .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_des));
    $str_form_row_picture .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_hidden_picture.$str_hidden_id_post.$str_hidden_article));

    // $str_form_picture = $this->Template->load_form(array("method"=>"POST","action"=>""),$str_form_row_picture);
    // echo $str_form_picture;


    $array_table_picture_header = array(
        "num"               =>array("Stt",array("style"=>"width:1%;text-align:center")),
        "name"        =>array("Tên Hình Ảnh",array("style"=>"width:1%;text-align:center")),
        "file"              =>array("Hình",array("style"=>"width:1%;text-align:center")),
        "edit"              =>array("Sửa",array("style"=>"width:1%;text-align:center")),
        "delete"            =>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );

    $str_table_picture_header = $this->Template->load_table_header($array_table_picture_header);
    // echo $str_table_picture_header;

    //tao tr>td
    $str_table_picture_row ="";

    if($array_picture != null)
        {
            $stt = 0;
            foreach($array_picture as $picture)
            {
                //tao duong dan cho file
                $link_file = $this->Company->file_url.$picture["file"];
                $id_picture = $picture["id"];
                $stt++;
                $array_table_picture_row = null;
                $array_table_picture_row["num"] = array($stt,array("text-align:center"));
                $array_table_picture_row["name"] = array($picture["name"],array("text-align:center"));
                $array_table_picture_row["file"] = array("<img src=".$link_file." style = 'width:50px;height:50px;'>",array("text-align:center"));
                
    
                //tạo link sửa
                $str_link_edit = $this->Template->load_link("edit","Sửa","/picture/index/$type/$id_post/$id_picture.html");
                $array_table_picture_row["edit"] = array($str_link_edit,array("text-align:center"));
                //tạo link xóa
                $str_link_delete = $this->Template->load_link("del","Xóa","/picture/del/$type/$id_post/$id_picture.html");
                $array_table_picture_row["delete"] = array($str_link_delete,array("text-align:center"));
                //gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row
    
                $str_table_picture_row .=  $this->Template->load_table_row($array_table_picture_row,array("align"=>"center","id"=>"table_posts"));
            }
        }

    $str_table_picture = $this->Template->load_table($str_table_picture_header.$str_table_picture_row,array("align"=>"center","id"=>"table_posts"));
    // echo $str_table_picture;

    $str_form_picture = $this->Template->load_form(array("method"=>"POST","action"=>"/picture/index/$type/$id_post.html"),$str_form_row_picture.$str_table_picture);
    echo $str_form_picture;

?>

<!-- up load hinh -->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>

<?php
   echo $this->Template->load_upload_js("file","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf"),"1","xem_hinh_minhhoa");
    
?>