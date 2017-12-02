<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    if($type == 0) $function_title = "Danh sách duyệt điểm danh trẻ";
	else $function_title = "Danh sách duyệt điểm danh giáo viên";

    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************

    //TIM KIEM
    //*****************************************
    $str_timkiem="";
	
	$array_type = array("0"=>"Trẻ","1"=>"Giáo viên");
	$str_timkiem .= $this->Template->load_label(" Loại: ","","search_list");
    $str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"type","id"=>"type","style"=>"width:95px"),$array_type);
	
    $str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"startday","autocomplete"=>"off","id"=>"startday","style"=>"width:100px","value"=>$tungay));

    $str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"finishday","autocomplete"=>"off","id"=>"finishday","style"=>"width:100px","value"=>$denngay));
	
	if($type == 0)
	{
		$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
		$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","style"=>"width:230px"),$array_list_classroom,$id_classroom);
	}
	
    $str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

    $link_danhsach = $this->Html->link(array("controller"=>"attendance","action"=>"duyet"));
    $str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);
    echo $str_timkiem;

    //*****************************************
    //END TIM KIEM

    //*****************************************
    //FUNCTION CONTENT

    //Table
    //buoc 1: tao mang table header
    $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "day"=>array("Ngày điểm danh",array("style"=>"text-align:center; width:15%")),
                                    "class"=>array("Tên lớp",array("style"=>"text-align:left; width:20%")),
									"siso"=>array("Sỉ số",array("style"=>"text-align:center;")),
                                    "dihoc"=>array("Có mặt",array("style"=>"text-align:center; width:10%")),
									"nuabuoi"=>array("Nửa buổi",array("style"=>"text-align:center; width:10%")),
									"vang"=>array("Vắng",array("style"=>"text-align:center; width:10%")),
									"chitiet"=>array("Tùy chọn",array("style"=>"text-align:center;width:10%")));

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_header_attendance = $this->Template->load_table_header($array_header_attendance);

    //buoc 3: duyet du lieu tu database tra ve de dua vao bảng
    $str_row_attendance = "";
    $i = 0;

    if($array_attendance)
    {
        foreach($array_attendance as $attendance)
        {
            $array_row_attendance['stt']     = array(++$i,array("style"=>"text-align:center"));
            $array_row_attendance['day']     = array($attendance["ngaydiemdanh"],array("style"=>"text-align:center"));
            $array_row_attendance['class']   = array($attendance['classroom_name'],array("style"=>"text-align:left"));
			$array_row_attendance['siso']   = array($attendance['siso'],array("style"=>"text-align:center"));
			$array_row_attendance['dihoc']   = array($attendance['dihoc'],array("style"=>"text-align:center"));
			$array_row_attendance['nuabuoi']   = array($attendance['nuabuoi'],array("style"=>"text-align:center"));
			$array_row_attendance['vang']   = array($attendance['vang'],array("style"=>"text-align:center"));
			
			$link_chitiet 	= $this->Html->link(array("controller"=>"attendance","action"=>"detail","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_chitiet	= $this->Template->load_link("edit","Chi tiết",$link_chitiet);	
			
			$link_sua	= $this->Html->link(array("controller"=>"attendance","action"=>"edit","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			
			$link_duyet	= $this->Html->link(array("controller"=>"attendance","action"=>"approve","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_duyet	= $this->Template->load_link("download","Duyệt",$link_duyet);	
			
			$array_row_attendance['chitiet'] = array($link_chitiet."<br>".$link_sua."<br>".$link_duyet,array("style"=>"text-align:center"));
			
            $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
        }
    }
    else
    {
        $array_row_attendance["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"8"));
        $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
    }

    //buoc 5: dung lam load_table de dữ liệu vào table
    $str_table_attendance =  $this->Template->load_table($str_header_attendance.$str_row_attendance);

    //buoc 6: hien thi du lieu table ra man hinh
    echo $str_table_attendance;

    //END FUNCTION CONTENT
    //*****************************************
?>

<script type="text/javascript">
    $( function() {
        $( "#startday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    $( function() {
        $( "#finishday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
	document.getElementById('type').value = '<?php echo $type; ?>';
</script>