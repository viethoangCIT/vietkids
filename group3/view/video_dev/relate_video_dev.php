<?php

    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Video";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************

    $id_video = "";
    $name = "";
    if($array_edit_video != null)
    {
        $id_video = $array_edit_video[0]["id"];
        $name = $array_edit_video[0]["name"];
    }

    //tao form
    $str_form_row_video = "";
    $str_input_name = $this->Template->load_textbox(array("name"=>"data[name]","value"=>$name,"style"=>"width:50%"));
    $str_input_file = $this->Template->load_textbox(array("name"=>"data[file]","style"=>"width:50%"));
    $str_input_emb_code = $this->Template->load_textbox(array("name"=>"data[emb_code]","style"=>"width:50%"));
    $str_input_des = $this->Template->load_textbox(array("name"=>"data[des]","style"=>"width:50%"));
    $str_input_type = $this->Template->load_textbox(array("name"=>"data[type]","style"=>"width:50%"));
    $str_input_id_post = $this->Template->load_textbox(array("name"=>"data[id_post]","style"=>"width:50%"));
    $str_hidden_video = $this->Template->load_hidden(array("name"=>"data[id]","value"=>$id_video));
    $str_hidden_id_post = $this->Template->load_hidden(array("name"=>"data[id_post]","value"=>$id_post));
    $str_hidden_article = $this->Template->load_hidden(array("name"=>"data[type]","value"=>$type));
    $str_save_button = $this->Template->Load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");

    $str_uploadbar = $this->Template->load_upload_bar("upload_container","select_img","upload_img","list_img","result_upload");
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"Tên video","input"=>$str_input_name));
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"Tên File","input"=>$str_input_file.$str_uploadbar));
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"Embed code","input"=>$str_input_emb_code));
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"Mô tả","input"=>$str_input_des));

    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"type","input"=>$str_input_type));
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"id_post","input"=>$str_input_id_post));
    
    $str_form_row_video .= $this->Template->load_form_row(array("title"=>"","input"=>$str_save_button.$str_hidden_video.$str_hidden_id_post.$str_hidden_id_post));

    //tao table
    $array_table_video_header = array(
        "num"           =>array("Stt",array("style"=>"width:1%;text-align:center")),
        "name"    =>array("Tên video",array("style"=>"width:1%;text-align:center")),
        "file"          =>array("Video",array("style"=>"width:1%;text-align:center")),
        "edit"              =>array("Sửa",array("style"=>"width:1%;text-align:center")),
        "delete"            =>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );

    $str_table_video_header = $this->Template->load_table_header($array_table_video_header);

    $str_table_video_row = "";
    if($array_video != null)
    {
        $stt = 0;
        foreach($array_video as $video)
        {
            $link_file = $video["file"];
            $id_video= $video["id"];
            $stt++;
            $str_youtube = "<iframe width='560' height='315' src='$link_file' frameborder='0' allowfullscreen></iframe>";
            $array_table_video_row = null;
            $array_table_video_row["num"] = array($stt,array("text-align:center"));
            $array_table_video_row["name"] = array($video["name"],array("text-align:center"));
            $array_table_video_row["file"] = 
                array($str_youtube,array("text-align:center"));
            

            //tạo link sửa
            $str_link_edit = $this->Template->load_link("edit","Sửa","/video/relate_video/$type/$id_post/$id_video.html");
            $array_table_video_row["edit"] = array($str_link_edit,array("text-align:center"));
            //tạo link xóa
            $str_link_delete = $this->Template->load_link("del","Xóa","/video/del_video/$type/$id_post/$id_video.html");
            $array_table_video_row["delete"] = array($str_link_delete,array("text-align:center"));
            //gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row

            $str_table_video_row .=  $this->Template->load_table_row($array_table_video_row,array("align"=>"center","id"=>"table_posts"));
        }
    }

    $str_table_video = $this->Template->load_table($str_table_video_header.$str_table_video_row,array("align"=>"center","id"=>"table_posts"));

    $str_load_form_video = $this->Template->load_form(array("method"=>"POST","action"=>"/video/relate_video/$type/$id_post.html"),$str_form_row_video.$str_table_video);
    echo $str_load_form_video;

?>


<!-- up load hinh -->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>

<?php
   echo $this->Template->load_upload_js("file","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf"),"1","xem_hinh_minhhoa"); 
?>