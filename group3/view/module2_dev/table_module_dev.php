<?php
    //*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Quản Lý Table Của Chức Năng: ".$array_function_name[0]["name"];
    echo $this->Template->load_function_header($function_title);
    //*****************************************
    //FUNCTION HEADER
    //*****************************************

    $str_select_name_table = $this->Template->load_selectbox(array("name"=>"data[id_table]","style"=>"width:200px;"),$array_table);
    $str_button_save = $this->Template->load_button(array("value"=>"luu","type"=>"submit"),"Lưu");

    $str_form_row_table = "";
    $str_form_row_table .= $this->Template->load_form_row(array("title"=>"Tên bảng","input"=>$str_select_name_table));
    $str_form_row_table .= $this->Template->load_form_row(array("title"=>"","input"=>$str_button_save));
    $str_form_table = $this->Template->load_form(array("method"=>"POST","action"=>"/module2/table/$id_function.html"),$str_form_row_table);
    echo $str_form_table;

    //table
    $array_table_header = array(
        "num"               => array("stt",array("style"=>"width:1%;text-align:center")),
        "table_name"    => array("table_name",array("style"=>"width:1%;text-align:center")),
        "data_col"      =>array("data_col",array("style"=>"width:1%;text-align:center")),
        "sql"           =>array("sql",array("style"=>"width:1%;text-align:center")),
        "delete"			=>array("Xóa",array("style"=>"width:1%;text-align:center"))
    );

    $str_table_header = $this->Template->load_table_header($array_table_header);
    
    
        $str_table_row = "";
        if($array_function != null)
        {
            $stt=0;
            foreach($array_function as $table)
            {
                $stt++;
                $array_table_row = null;
                $array_table_row["num"] = 
                    array($stt,array("text-align:center"));
    
                $array_table_row["table_name"] = 
                    array($table["table_name"],array("text-align:center"));
    
                $array_table_row["table_col"] = 
                    array($table["table_col"],array("text-align:center"));
                    
                $array_table_row["sql"] = 
                array($table["sql"],array("text-align:center"));
    
                $str_link_delete = $this->Template->load_link("del","Xóa","/user3/tables/".$table["id"].".html?act=del");
                $array_table_row["option"] = array($str_link_delete,array("text-align:center"));
        
    
                $str_table_row .=$this->Template->load_table_row($array_table_row,array("align"=>"center","id"=>"table_posts"));
                    
            }
        }
    
        $str_table =  $this->Template->load_table($str_table_header.$str_table_row,array("align"=>"center","id"=>"table_posts"));
    
        echo $str_table;
    
    
?>