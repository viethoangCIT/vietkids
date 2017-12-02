<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	if($type == 0) $function_title = "Chi Tiết Điểm Danh Trẻ";
	else $function_title = "Chi Tiết Điểm Danh Giáo Viên";

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	$day = date('d-m-Y',strtotime($day));
	$chuthich_t7 = "";
	if(date('w', strtotime($day)) == 6) $chuthich_t7 = " <b style='color:#0db400'>(Thứ 7)</b>";
	$str_form_date = "<h3 style='margin: 20px 0px'><b style='color:#2f83b7'>Lớp:</b> $classroom_name</h3>";
	$str_form_date .= "<h3 style='margin: 20px 0px'><b style='color:#2f83b7'>Ngày:</b> $day $chuthich_t7</h3>";
	
	echo $str_form_date;
	
	//TIM KIEM
	//*****************************************
	
	
	//$array_type = array(""=>"Tất cả","0"=>"Trẻ","1"=>"Giáo viên");
	
	/*$array_status = array(""=>"Tất cả","0"=>"Vắng","1"=>"Có mặt","2"=>"Nửa buổi");
	$str_timkiem .= $this->Template->load_label(" Trạng thái: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"status","id"=>"status","style"=>"width:90px"),$array_status);
	*/
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"attendance","action"=>"detail/$id_classroom/$day/$type"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"fullname"=>array("Họ và tên",array("style"=>"text-align:center; width:20%")),
							"status"=>array("Trạng Thái",array("style"=>"text-align:center;")),
					);
	
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	
	$id_created_user = "";	
	$id = "";
	$kihieu_diemdanh = "";

	if($array_attendance)
	{
		//$array_kihieu_diemdanh = array("0"=>"0","1"=>"1","2"=>"0.5");
		foreach($array_attendance as $attendance)
		{
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 			= array($stt,array("style"=>"text-align:center;"));
			
			$array_row_product["fullname"] 			= array($attendance["fullname"],array("style"=>"text-align:left;"));
			
			$antoi = "";
			if($attendance["antoi"] == "1") $antoi = " (Có ăn tối)";
			
			$status = $attendance["status"];
			$full_day = $attendance["full_day"];
			if($status == 1)
			{
				if($full_day == 1) $kihieu_diemdanh = "Có mặt";
				else $kihieu_diemdanh = "Nửa buổi";
			}else  $kihieu_diemdanh = "Vắng";
			
			$array_row_product["status"] 			= array($kihieu_diemdanh.$antoi,array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>

<script>
	document.getElementById('status').value = "<?php echo $status; ?>";
	//document.getElementById('type').value = "<?php //echo $type; ?>";
</script>