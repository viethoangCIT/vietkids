<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    if($type == 0) $function_title = "Lịch sử điểm danh trẻ";
	else $function_title = "Lịch sử điểm danh giáo viên";

    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************

    //TIM KIEM
    //*****************************************
	
    $str_timkiem = $this->Template->load_label(" Từ ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"startday","autocomplete"=>"off","id"=>"startday","style"=>"width:100px","value"=>$tungay));

    $str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"finishday","autocomplete"=>"off","id"=>"finishday","style"=>"width:100px","value"=>$denngay));
	
	if($type == 0)
	{
		$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
		$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","style"=>"width:200px","onchange"=>"thaydoi_lop()"),$array_list_classroom,$id_classroom);
	}
	
	if($id_classroom != "" && $type == 0)
	{
		$str_timkiem .= $this->Template->load_label(" Trẻ: ","","search_list");
    	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_customer","style"=>"width:200px"),$array_customer,$id_customer);	
	}

    $str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

    $link_danhsach = $this->Html->link(array("controller"=>"attendance","action"=>"index/$type"));
    $str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);
    echo $str_timkiem;

    //*****************************************
    //END TIM KIEM

    //*****************************************
    //FUNCTION CONTENT

    //Table
    //buoc 1: tao mang table header
	if($type == 0)
	{
   	 	$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "day"=>array("Ngày điểm danh",array("style"=>"text-align:center; width:15%")),
                                    "class"=>array("Tên lớp",array("style"=>"text-align:left; width:20%")),
									"siso"=>array("Sỉ số",array("style"=>"text-align:center;")),
                                    "dihoc"=>array("Có mặt",array("style"=>"text-align:center; width:10%")),
									"nuabuoi"=>array("Nửa buổi",array("style"=>"text-align:center; width:10%")),
									"vang"=>array("Vắng",array("style"=>"text-align:center; width:10%")),
									"antoi"=>array("Ăn tối",array("style"=>"text-align:center; width:10%")),
									"chitiet"=>array("Tùy chọn",array("style"=>"text-align:center;width:10%")));
	}else
	{
		$array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "day"=>array("Ngày điểm danh",array("style"=>"text-align:center; width:15%")),
                                    "class"=>array("Tên lớp",array("style"=>"text-align:left; width:20%")),
									"siso"=>array("Sỉ số",array("style"=>"text-align:center;")),
                                    "dihoc"=>array("Có mặt",array("style"=>"text-align:center; width:10%")),
									"nuabuoi"=>array("Nửa buổi",array("style"=>"text-align:center; width:10%")),
									"vang"=>array("Vắng",array("style"=>"text-align:center; width:10%")),
									"chitiet"=>array("Tùy chọn",array("style"=>"text-align:center;width:10%")));
	}
	
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
			
			$chuthich_t7 = "";
			if(date('w', strtotime($attendance["ngaydiemdanh"])) == 6) $chuthich_t7 = " <br><b style='color:#0db400'>(Thứ 7)</b>";
            $array_row_attendance['day']     = array($attendance["ngaydiemdanh"].$chuthich_t7,array("style"=>"text-align:center"));
            $array_row_attendance['class']   = array($attendance['classroom_name'],array("style"=>"text-align:left"));
			$array_row_attendance['siso']   = array($attendance['siso'],array("style"=>"text-align:center"));
			$array_row_attendance['dihoc']   = array($attendance['dihoc'],array("style"=>"text-align:center"));
			$array_row_attendance['nuabuoi']   = array($attendance['nuabuoi'],array("style"=>"text-align:center"));
			$array_row_attendance['vang']   = array($attendance['vang'],array("style"=>"text-align:center"));
			if($type == 0) $array_row_attendance['antoi']   = array($attendance['antoi'],array("style"=>"text-align:center"));
			
			$link_chitiet 	= $this->Html->link(array("controller"=>"attendance","action"=>"detail","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_chitiet	= $this->Template->load_link("edit","Chi tiết",$link_chitiet);	
			
			$link_sua	= $this->Html->link(array("controller"=>"attendance","action"=>"edit","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
			
			$link_xoa	= $this->Html->link(array("controller"=>"attendance","action"=>"del","params"=>array($attendance["id_classroom"],$attendance["ngaydiemdanh"],$type)));
			$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);	
			
			$array_row_attendance['chitiet'] = array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center"));
			
            $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
        }
    }
    else
    {
        $array_row_attendance["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"9"));
        $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
    }

    //buoc 5: dung lam load_table de dữ liệu vào table
    $str_table_attendance =  $this->Template->load_table($str_header_attendance.$str_row_attendance);

    //buoc 6: hien thi du lieu table ra man hinh
    echo $str_table_attendance;

    //END FUNCTION CONTENT
    //*****************************************
	
	if($id_customer != "")
	{
		//tieu de cua ham
    	$function_title_tre = "Thông tin điểm danh trẻ";

   	 	echo $this->Template->load_function_header($function_title_tre);
		
		$str_row_attendance_tre = "<b style='color:red'>Lớp:</b> ".$array_diemdanh_tre[0]["classroom_name"]."<br>";
		$str_row_attendance_tre .= "<b style='color:red'>Tên trẻ:</b> ".$array_diemdanh_tre[0]["fullname"]."<br><br>";
		
		//Table
		//buoc 1: tao mang table header
		$array_header_attendance_tre =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
										"day"=>array("Ngày điểm danh",array("style"=>"text-align:center; width:15%")),
										"dihoc"=>array("Đi học",array("style"=>"text-align:center; width:10%")),
										"nuabuoi"=>array("Nửa buổi",array("style"=>"text-align:center; width:10%")),
										"vang"=>array("Vắng",array("style"=>"text-align:center; width:10%")),
										"antoi"=>array("Ăn tối",array("style"=>"text-align:center; width:10%")),
										);
	
		//buoc 2: dung hàm load_table_header de lay template table header
		$str_header_attendance_tre = $this->Template->load_table_header($array_header_attendance_tre);
	
		//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
		//$str_row_attendance_tre = "";
		$a = 0;
		$solan_dihoc = 0;
		$solan_nuabuoi = 0;
		$solan_vang = 0;
		$solan_antoi = 0;
		if($array_diemdanh_tre)
		{
			foreach($array_diemdanh_tre as $diemdanh_tre)
			{
				$array_row_attendance_tre['stt']     = array(++$a,array("style"=>"text-align:center"));
				
				$status = $diemdanh_tre["status"];
				$full_day = $diemdanh_tre["full_day"];
				$sat = $diemdanh_tre["sat"];
				$dihoc = "";
				$nuabuoi = "";
				$vang = "";
				if($status == "1")
				{ 
					if($full_day == "1") $dihoc = "X";
					else $nuabuoi = "X";
					$solan_dihoc++;
				}else 
				{
					$vang = "X";
					$solan_vang++;
				}
				
				$antoi = ""; 
				if($diemdanh_tre["antoi"] == "1")
				{
					$antoi = "Có";
					$solan_antoi++;
				}
				
				$date = date("d-m-Y",strtotime($diemdanh_tre["date"]));
				if($date == "01-01-1970") $date = "";
				$chuthich_t7 = "";
				if($sat == 1) $chuthich_t7 = " <b style='color:#0db400'>(Thứ 7)</b>";
				
				$array_row_attendance_tre['day']     = array($date.$chuthich_t7,array("style"=>"text-align:center"));
				$array_row_attendance_tre['dihoc']   = array($dihoc,array("style"=>"text-align:center"));
				$array_row_attendance_tre['nuabuoi']   = array($nuabuoi,array("style"=>"text-align:center"));
				$array_row_attendance_tre['vang']   = array($vang,array("style"=>"text-align:center"));
				$array_row_attendance_tre['antoi']   = array($antoi,array("style"=>"text-align:center"));
				
				$str_row_attendance_tre .= $this->Template->load_table_row($array_row_attendance_tre);
			}
			$array_row_attendance_tre = NULL;
			$array_row_attendance_tre['stt']     = array("<b>Tổng cộng:</b> ",array("style"=>"text-align:center; color:red","colspan"=>"2"));
			$array_row_attendance_tre['dihoc']   = array("<b>Đi học:</b> $solan_dihoc",array("style"=>"text-align:center"));
			$array_row_attendance_tre['nuabuoi']   = array("<b>Nửa buổi:</b> $solan_nuabuoi",array("style"=>"text-align:center"));
			$array_row_attendance_tre['vang']   = array("<b>Vắng:</b> $solan_vang",array("style"=>"text-align:center"));
			$array_row_attendance_tre['antoi']   = array("<b>Ăn tối:</b> $solan_antoi",array("style"=>"text-align:center"));
			$str_row_attendance_tre .= $this->Template->load_table_row($array_row_attendance_tre);
		}
		else
		{
			$array_row_attendance_tre["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"4"));
			$str_row_attendance_tre .= $this->Template->load_table_row($array_row_attendance_tre);
		}
	
		//buoc 5: dung lam load_table de dữ liệu vào table
		$str_row_attendance_tre =  $this->Template->load_table($str_header_attendance_tre.$str_row_attendance_tre);
	
		//buoc 6: hien thi du lieu table ra man hinh
		echo $str_row_attendance_tre;
	
		//END FUNCTION CONTENT
		//*****************************************
	}
?>

<script type="text/javascript">
    $( function() {
        $( "#startday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    $( function() {
        $( "#finishday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
	
	function thaydoi_lop()
	{
		document.getElementById('form_timkiem').submit();
	}
</script>