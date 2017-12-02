<?php
    // ---Tạo bảng
    // 1. Tạo mảng table header

    $array_table_header['stt']           = array("STT",array("style"=>"text-align:center"));
    $array_table_header['name_project']  = array("Tên dự án",array("style"=>"text-align:center"));
    $array_table_header['name']          = array("Tên giai đoạn",array("style"=>"text-align:center"));
    $array_table_header['start']         = array("Ngày bắt đầu dự kiến",array("style"=>"text-align:center"));
    $array_table_header['finish']        = array("Ngày kết thúc dự kiến",array("style"=>"text-align:center"));
    $array_table_header['start_actual']  = array("Ngày bắt đầu thực tế",array("style"=>"text-align:center"));
    $array_table_header['finish_actual'] = array("Ngày kết thúc thực tế",array("style"=>"text-align:center"));
    $array_table_header['desc']          = array("Mô tả",array("style"=>"text-align:center"));
    $array_table_header['status']        = array("Trạng thái",array("style"=>"text-align:center"));
    $array_table_header['opt']           = array("Tùy chọn",array("style"=>"text-align:center"));

    // 2. Chuyển dữ liệu mảng table header thành html
    $str_table_header = $this->Template->load_table_header($array_table_header);

    // 3. Lấy nội dung của bảng từ mảng $array_warehouse_sheet_detail
    $str_table_content ="";
    $stt = 0;
    if ($arr_milestone != NULL)
    {
        foreach($arr_milestone as $milestone)
        {
            $id_milestone = $milestone['id'];
            $str_link_edit = $this->Template->load_link('edit','Sửa','javascript: void(0)',array("onclick"=>"edit_milestone($id_milestone)"));
            $str_link_delete = $this->Template->load_link('edit','Xóa','javascript: void(0)',array("onclick"=>"delete_milestone($id_milestone)"));
            $start = $finish = $start_actual = $finish_actual = "";

            if ($milestone['start']  != NULL) $start         = date("d-m-Y",strtotime($milestone['start']));
            if ($milestone['finish'] != NULL) $finish        = date("d-m-Y",strtotime($milestone['finish']));
            if ($milestone['start_actual']  != NULL) $start_actual   = date("d-m-Y",strtotime($milestone['start_actual']));
            if ($milestone['finish_actual']  != NULL) $finish_actual = date("d-m-Y",strtotime($milestone['finish_actual']));

            $label_name_project  = $this->Template->load_label($milestone['name_project'],"","",array("id"=>"name_project_$id_milestone"));
            $label_name          = $this->Template->load_label($milestone['name'],"","",array("id"=>"name_$id_milestone"));
            $label_start         = $this->Template->load_label($start,"","",array("id"=>"start_$id_milestone"));
            $label_finish        = $this->Template->load_label($finish,"","",array("id"=>"finish_$id_milestone"));
            $label_start_actual  = $this->Template->load_label($start_actual,"","",array("id"=>"start_actual_$id_milestone"));
            $label_finish_actual = $this->Template->load_label($finish_actual,"","",array("id"=>"finish_actual_$id_milestone"));
            $label_desc          = $this->Template->load_label($milestone['desc'],"","",array("id"=>"desc_$id_milestone"));

            //trạng thái
            $status = "<span style='color:blueviolet;font-weight:bold;'>Chưa hoàn thành<span>";

            if ($finish != "" AND $finish_actual != "")
            {
                $status = "<span style='color:darkorange;font-weight:bold;'>Hoàn thành<span>";
                if (strtotime($milestone['finish']) < strtotime($milestone['finish_actual'])) $status = "<span style='color:red;font-weight:bold;'>Trễ<span>";
            }

            $array_row_table['stt']           = array(++$stt,array("style"                                   => "text-align:center"));
            $array_row_table['name_project']  = array($label_name_project,array("style"                      => "text-align:center"));
            $array_row_table['name']          = array($label_name,array("style"                              => "text-align:center"));
            $array_row_table['start']         = array($label_start ,array("style"                            => "text-align:center"));
            $array_row_table['finish']        = array($label_finish ,array("style"                           => "text-align:center"));
            $array_row_table['start_actual']  = array($label_start_actual ,array("style"                     => "text-align:center"));
            $array_row_table['finish_actual'] = array($label_finish_actual ,array("style"                    => "text-align:center"));
            $array_row_table['desc']          = array($label_desc,array("style"                              => "text-align:left"));
            $array_row_table['status']        = array($status,array("style"                                  => "text-align:center"));
            $array_row_table['opt']           = array($str_link_edit."&nbsp;".$str_link_delete,array("style" => "text-align:center"));

            // chuyển mảng row thành html, đưa vào string table content
            $str_table_content .= $this->Template->load_table_row($array_row_table);
        }//foreach($arr_milestone as $milestone)
    }
    else
    {
        $array_row_table = array("1"=>array("Không tìm thấy dữ liệu",array("style"=>"text-align:center;","colspan"=>10)));
        $str_table_content .= $this->Template->load_table_row($array_row_table);
    }// if ($arr_milestone != NULL)

    // 4.  Chuyển dữ liệu toàn bộ bảng order thành html (chứa html table header và html table content)
    $str_table = $this->Template->load_table($str_table_header.$str_table_content,array('style'=>'width:100%'));

    // 5. Truyền dữ liệu html của bảng order về trình duyệt
    echo $str_table;
?>
