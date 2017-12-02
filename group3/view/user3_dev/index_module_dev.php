<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Phân Quyền Chức Năng User";
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************
    $str_select_box_user = $this->Template->load_selectbox(array("name"=>"data[id_user]","style"=>"width:200px;","onchange"=>"submit_form()"),$array_user,$id_user);
    $str_select_box_module = $this->Template->load_selectbox(array("name"=>"data[id_module]","style"=>"width:200px;","onchange"=>"submit_form()"),$array_module,$id_module);
    $str_select_box_function = $this->Template->load_selectbox(array("name"=>"data[id_function]","style"=>"width:200px;"),$array_module_function);
    $str_hidden_status = $this->Template->load_hidden(array("name"=>"data[status]","id"=>"status","value"=>"0"));
    $str_buton_save = $this->Template->load_button(array("value"=>"luu","type"=>"button","onclick"=>"save_user_module()"),"Lưu");
    

    $str_form_row_module = "";
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"UserName","input"=>$str_select_box_user));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Danh sách module","input"=>$str_select_box_module));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Danh sách function","input"=>$str_select_box_function));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"","input"=>$str_buton_save.$str_hidden_status));
    $str_form_module = $this->Template->load_form(array("method"=>"GET","action"=>"/user3/modules.html","id"=>"form_function"),$str_form_row_module);
    
    //form phân quyền chức năng user
    echo $str_form_module;



    $str_form_row_user_module = "";
    $str_select_user = $this->Template->load_selectbox(array("name"=>"id_user_search","style"=>"width:200px;"),$array_user,$id_user_search,$id_user);
    $str_buton_timkiem = $this->Template->load_button(array("value"=>"luu","type"=>"submit"),"Tìm kiếm");
    $str_form_row_user_module .= $this->Template->load_form_row(array("title"=>"User","input"=>$str_select_user.$str_buton_timkiem));
    $str_form_user_module = $this->Template->load_form(array("method"=>"GET","action"=>"/user3/modules.html?str=search"),$str_form_row_user_module);
    echo $str_form_user_module;

    //hiển thị table user_module

    $array_table_user_module_header = array(
        "num"               => array("stt",array("style"=>"width:1%;text-align:center")),
        "user_fullname"          => array("Họ và tên",array("style"=>"width:1%;text-align:center")),
        "module_package"    => array("Tên package",array("style"=>"width:1%;text-align:center")),
        "module_name"       =>array("Tên module",array("style"=>"width:1%;text-align:center")),
        "module_title"      =>array("Tiêu đề",array("style"=>"width:1%;text-align:center")),
        "function_name"     =>array("Tên chức năng",array("style"=>"width:1%;text-align:center")),
        "function_title"    =>array("Tiêu đề chức năng",array("style"=>"width:1%;text-align:center")),
        "delete"			=>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );
    
    $str_table_user_module_header = $this->Template->load_table_header($array_table_user_module_header);

    $str_table_user_module_row = "";
    if($array_user_module != null)
    {
        $stt=0;
        foreach($array_user_module as $user_module)
        {
            $stt++;
			$array_table_user_module_row = null;
			$array_table_user_module_row["num"] = 
                array($stt,array("text-align:center"));

            $array_table_user_module_row["user_fullname"] = 
                array($user_module["user_fullname"],array("text-align:center"));

            $array_table_user_module_row["module_package"] = 
                array($user_module["module_package"],array("text-align:center"));

            $array_table_user_module_row["module_name"] = 
                array($user_module["module_name"],array("text-align:center"));

            $array_table_user_module_row["module_title"] = 
                array($user_module["module_title"],array("text-align:center"));

            $array_table_user_module_row["function_name"] = 
                array($user_module["function_name"],array("text-align:center"));

            $array_table_user_module_row["function_title"] = 
                array($user_module["function_title"],array("text-align:center"));

            $str_link_delete = $this->Template->load_link("del","Xóa","/user3/modules/".$user_module["id"].".html?act=del");
            $array_table_user_module_row["option"] = array($str_link_delete,array("text-align:center"));
    

            $str_table_user_module_row .=$this->Template->load_table_row($array_table_user_module_row,array("align"=>"center","id"=>"table_posts"));
                
        }
    }
    else
    {
        $array_table_user_module_row = null;
        $array_table_user_module_row["num"] = array("Không có dữ liệu",array("colspan"=>"8"));
        $str_table_user_module_row .=$this->Template->load_table_row($array_table_user_module_row,array("align"=>"center","id"=>"table_posts"));
    }

    $str_table_user_module =  $this->Template->load_table($str_table_user_module_header.$str_table_user_module_row,array("align"=>"center","id"=>"table_posts"));

    echo $str_table_user_module;



?>

<script>
    function submit_form()
    {
        document.getElementById("form_function").submit();
    }
    
    function save_user_module()
    {
        document.getElementById("status").value = 1;
        document.getElementById("form_function").submit();
    }
</script>