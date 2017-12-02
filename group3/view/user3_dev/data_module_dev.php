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
    $str_select_box_function = $this->Template->load_selectbox(array("name"=>"data[id_function]","style"=>"width:200px;","onchange"=>"submit_form()"),$array_module_function,$id_function);
    $str_select_box_table = $this->Template->load_selectbox(array("name"=>"data[id_table]","style"=>"width:200px;","onchange"=>"submit_form()"),$array_function_table,$id_table);

    

    $str_form_row_module = "";
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"UserName","input"=>$str_select_box_user));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Danh sách module","input"=>$str_select_box_module));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Danh sách function","input"=>$str_select_box_function));
    $str_form_row_module .= $this->Template->load_form_row(array("title"=>"Danh sách table","input"=>$str_select_box_table));
    $str_form_module = $this->Template->load_form(array("method"=>"GET","action"=>"/user3/data.html","id"=>"form_function"),$str_form_row_module);
    
    //form phân quyền chức năng user
    echo $str_form_module;

    //table 
    $array_function_table_header = array(
        "num"               => array("stt",array("style"=>"width:1%;text-align:center")),
        "table_name"        => array("table_name",array("style"=>"width:1%;text-align:center")),
        "table_col"         =>array("table_col",array("style"=>"width:1%;text-align:center")),
        "sql"               =>array("sql",array("style"=>"width:1%;text-align:center")),
        "delete"			=>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );
    
    $str_function_table_header = $this->Template->load_table_header($array_function_table_header);

    $str_function_table_row = "";
    if($array_data != null)
    {
        $stt=0;
        foreach($array_data as $data)
        {
            $stt++;
			$array_function_table_row = null;
			$array_function_table_row["num"] = 
                array($stt,array("text-align:center"));

            $array_function_table_row["data_title"] = 
                array($data["data_title"],array("text-align:center"));

            $array_function_table_row["table_col"] = 
                array("",array("text-align:center"));

            $array_function_table_row["sql"] = 
                array("",array("text-align:center"));

            // $str_link_delete = $this->Template->load_link("del","Xóa","/user3/modules/".$user_module["id"].".html?act=del");
            // $array_table_user_module_row["option"] = array($str_link_delete,array("text-align:center"));
    

            $str_function_table_row .=$this->Template->load_table_row($array_function_table_row,array("align"=>"center","id"=>"table_posts"));
                
        }
    }

    $str_table_module =  $this->Template->load_table($str_function_table_header.$str_function_table_row,array("align"=>"center","id"=>"table_posts"));

    echo $str_table_module;



?>

<script>
    function submit_form()
    {
        document.getElementById("form_function").submit();
    }
    
</script>