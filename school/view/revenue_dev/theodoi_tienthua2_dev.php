<script src="<?php echo $this->webroot; ?>js/table/table.js"></script> 
<style>
.hover-row:hover{background-color:#ffd028 !important}
</style>
<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Theo dõi tiền thừa";
	
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:90px","value"=>date("d-m-Y",strtotime($tungay))));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:90px","value"=>date("d-m-Y",strtotime($denngay))));
	
	array_unshift($array_lop_hoc,array('id'=>'','value'=>"Chọn lớp"));
	$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"lop","id"=>"loai","style"=>"width:165px","onchange"=>"submit_form()"),$array_lop_hoc,$lop);
	
	array_unshift($array_hocsinh,array('id'=>'','value'=>"Chọn học sinh"));
	$str_timkiem .= $this->Template->load_label(" Học sinh: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"hocsinh","id"=>"loai","style"=>"width:165px","onchange"=>"submit_form()"),$array_hocsinh,$hocsinh);
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:142px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"revenue","action"=>"theodoi_thua"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_product =  array(
				"stt"=>array("STT",array("style"=>"text-align:center; z-index:1000; vertical-align: middle; ","rowspan"=>"2","class"=>"headcol")),
				"student_name"=>array("Tên trẻ",array("style"=>"text-align:center; z-index:1000; vertical-align: middle;","rowspan"=>"2")),
				"lop"=>array("Lớp",array("style"=>"text-align:center; z-index:1000; vertical-align: middle;","rowspan"=>"2")),
				"thang"=>array("Tháng",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),	
				"songay_dukien"=>array("Số ngày dự kiến",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),	
				"songay_dihoc"=>array("Số ngày đi học",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"songay_nghi"=>array("Số ngày nghỉ",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"songay_antoi"=>array("Số ngày ăn tối",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"songay_dihoc_t7"=>array("Số ngày đi học thứ 7",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"sotien_danop"=>array("Số tiền đã nộp",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"sotien_dukien"=>array("Số tiền nộp dự kiến",array("style"=>"text-align:center; vertical-align: middle;","colspan"=>"9")),
				"sotien_sudung"=>array("Số tiền sử dụng",array("style"=>"text-align:center; vertical-align: middle;","colspan"=>"8")),	
				"sotien_thua"=>array("Số tiền thừa",array("style"=>"text-align:center; vertical-align: middle;","colspan"=>"8")),
				"truythu"=>array("Truy thu",array("style"=>"text-align:center; vertical-align: middle;","colspan"=>"6")),
				"tong_truythu"=>array("Tổng truy thu",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),	
				"tongtien_thua"=>array("Tổng tiền thừa tháng hiện tại",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				"tongcong_butru"=>array("Tổng bù trừ",array("style"=>"text-align:center; vertical-align: middle;","rowspan"=>"2")),
				
					);

	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = "<thead>".$this->Template->load_table_row($array_header_product,array("style"=>"color: #fff; background: #2f83b7; text-shadow: 0 0 0 #000; font-weight: bold"));
	
	
			$array_row_product = NULL;
		
		$array_row_product["dukien_hocphi"] 	= array("Học phí",array("style"=>"text-align:center; vertical-align: middle;","nowrap"=>"nowrap"));
		$array_row_product["dukien_hocphi_daunam"] 	= array("Hoc phí đầu năm",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["dukien_tienan"] 	= array("Tiền ăn",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_dukien3"] 	= array("Bán trú + phụ phí",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_dukien4"] 	= array("Tiền sữa",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_dukien5"] 	= array("Ăn tối + phụ phí tối",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_dukien6"] 	= array("Dịch vụ khác",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_dukien7"] 	= array("Thứ 7",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sinhnhat"] 			= array("Sinh nhật",array("style"=>"text-align:center; vertical-align: middle;"));

		$array_row_product["sotien_dukien8"] 	= array("Tổng tiền dự kiến",array("style"=>"text-align:center; vertical-align: middle;"));
		
		$array_row_product["sotien_sudung1"] 	= array("Học phí",array("style"=>"text-align:center; vertical-align: middle;","nowrap"=>"nowrap"));
		$array_row_product["sotien_sudung2"] 	= array("Tiền ăn",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung3"] 	= array("Bán trú + phụ phí",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung4"] 	= array("Tiền sữa",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung5"] 	= array("Ăn tối + phụ phí tối",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung6"] 	= array("Dịch vụ khác",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung7"] 	= array("Thứ 7",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_sudung8"] 	= array("Tổng tiền sử dụng",array("style"=>"text-align:center; vertical-align: middle;"));
		
		
		//Phần tiền thừa
		$array_row_product["sotien_thua1"] 	= array("Học phí",array("style"=>"text-align:center; vertical-align: middle;","nowrap"=>"nowrap"));
		$array_row_product["sotien_thua2"] 	= array("Tiền ăn",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua3"] 	= array("Bán trú + phụ phí",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua4"] 	= array("Tiền sữa",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua5"] 	= array("Ăn tối Phụ phí tối",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua6"] 	= array("Dịch vụ khác",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua7"] 	= array("Thứ 7",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["sotien_thua_thangtruoc"] 	= array("Tiền thừa tháng trước",array("style"=>"text-align:center; vertical-align: middle;"));

		
		$array_row_product["truythu1"] 	= array("Tiền ăn",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["truythu2"] 	= array("Tiền sữa",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["truythu3"] 	= array("Ăn tối",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["truythu4"] 	= array("Thứ 7",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["truythu5"] 	= array("Dịch vụ khác",array("style"=>"text-align:center; vertical-align: middle;"));
		$array_row_product["truythu6"] 	= array("Tiền nợ tháng trước",array("style"=>"text-align:center; vertical-align: middle;"));
		
		$str_row_header2 = $this->Template->load_table_row($array_row_product,array("style"=>"color: #fff; background: #2f83b7; text-shadow: 0 0 0 #000; font-weight: bold"))."</thead>";
		
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$con_no = 0;
	$sotien_da_sudung = 0;
	if($array_thongke_tienthua)
	{

		
		$str_col_stt = "";
		foreach($array_thongke_tienthua as $thongke_tienthua)
		{
			$month_year 	 = date("m-Y",strtotime($thongke_tienthua["month_year"]));
			if($month_year != "01-1970")
			{
				
				
				//********************************************************************
				//Phần từ cột stt đến số tiền đã nộp
				$ten_tre 		= $thongke_tienthua["customer_name"];
				$ten_lop 		= $thongke_tienthua["classroom_name"];
				$songay_dukien  = $thongke_tienthua["songay_dukien"];
				$songay_dihoc   = $thongke_tienthua["songay_dihoc"];

				$songay_dihoc_theobuoi   = $thongke_tienthua["songay_dihoc_theobuoi"];
				
				if($songay_dihoc_theobuoi!="" && $songay_dihoc_theobuoi!=0) $songay_dihoc_theobuoi = "($songay_dihoc_theobuoi)";
				$songay_nghi 	= $thongke_tienthua["songay_nghi"];
				
				$songay_dihoc_thu7 	= $thongke_tienthua["songay_dihoc_thu7"];
				$songay_antoi =  $thongke_tienthua["songay_antoi"];
				if($songay_antoi == "") $songay_antoi = 0;
										
				$sotien_danop 		 = $thongke_tienthua["tong_danop"];
				
				
				//lấy ngày sinh để biết trẻ có sinh nhật không
				$birthday = $thongke_tienthua["customer_birthday"];
				$birth_month = "";
				if($birthday!="1970-01-01") 	$birth_month = date("m",strtotime($birthday));
				
				$current_month =  date("m",strtotime($thongke_tienthua["month_year"]));

				$str_birthday = "";
				$is_birthday = false;
				if($birth_month == $current_month)
				{
					$str_birthday = "<span style='color:green; font-weight:bold'><br>(Sinh nhật: $birthday)</span>"; 
					$is_birthday = true;
				}
				
				$stt++;
				$array_row_product = NULL;
				$array_row_product["stt"] 			 = array($stt,array("style"=>"text-align:center;","class"=>"headcol"));
				$array_row_product["student_name"] 	= array($ten_tre."$str_birthday",array("style"=>"text-align:left;","nowrap"=>"nowrap"));
				$array_row_product["lop"] 			 = array($ten_lop,array("style"=>"text-align:left;","nowrap"=>"nowrap"));
				$array_row_product["thang"]		   = array($month_year,array("style"=>"text-align:center;","nowrap"=>"nowrap"));
				$array_row_product["songay_dukien"]   = array($songay_dukien,array("style"=>"text-align:center;"));
				$array_row_product["songay_dihoc"] 	= array($songay_dihoc.$songay_dihoc_theobuoi,array("style"=>"text-align:center;"));
				$array_row_product["songay_nghi"] 	 = array($songay_nghi,array("style"=>"text-align:center;"));
				$array_row_product["songay_antoi"] 	= array($songay_antoi,array("style"=>"text-align:center;"));
				
				$array_row_product["songay_dihoc_t7"] = array($songay_dihoc_thu7,array("style"=>"text-align:center;"));
				$array_row_product["sotien_danop"] 	= array(number_format($sotien_danop),array("style"=>"text-align:center;","nowrap"=>"nowrap"));
				
				//Phần từ cột stt đến số tiền đã nộp		
				//*********************************************************
				
				
				
				//************************************************************
				//Các biến trong phần dự kiến
				//**************************************************
				$dukien_hocphi 		  = $thongke_tienthua["dukien_hocphi"];
				$dukien_hocphi_daunam 		  = $thongke_tienthua["dukien_hocphi_daunam"];
				$dukien_tienan 		  = $thongke_tienthua["dukien_tienan"];
				$dukien_bantru_phuphi   = $thongke_tienthua["dukien_bantru_phuphi"];
				$dukien_tiensua		 = $thongke_tienthua["dukien_tiensua"];	
				
				$dukien_an_toi 		  = $thongke_tienthua["dukien_an_toi"];
				$dukien_phuphi_toi 	  = $thongke_tienthua["dukien_phuphi_toi"];
				$dukien_dichvu_khac 	 = $thongke_tienthua["dukien_dichvu_khac"];
				$dukien_thu7 	 		= $thongke_tienthua["dukien_thu7"];	
				$dukien_sinhnhat 		= $thongke_tienthua["dukien_sinhnhat"];				
				 
				//*************************************
				//biến trong phần sử dụng
				$dangky_antoi = false;
				$dangky_dichvu_khac = false;
				$dangky_thu7 = false;
				//*************************************

				
					//************************************************************				
					//Xử lý phần dịch vụ
					//************************************************************				
					
				
				$array_row_product["dukien_hocphi"] = array(number_format($dukien_hocphi),array("style"=>"text-align:center;"));
				$array_row_product["dukien_hocphi_daunam"] = array(number_format($dukien_hocphi_daunam),array("style"=>"text-align:center;"));
				$array_row_product["dukien_tienan"] = array(number_format($dukien_tienan),array("style"=>"text-align:center;"));
				
				
				$array_row_product["dukien_bantru_phuphi"] = array(number_format($dukien_bantru_phuphi),array("style"=>"text-align:center;"));
				$array_row_product["dukien_tiensua"] = array(number_format($dukien_tiensua),array("style"=>"text-align:center;"));
				
				$dukien_an_toi_phuphi_toi = $dukien_an_toi + $dukien_phuphi_toi;

				$array_row_product["dukien_an_toi_phuphi_toi"] = array(number_format($dukien_an_toi_phuphi_toi),array("style"=>"text-align:center;"));

				$array_row_product["dukien_dichvu_khac"] = array(number_format($dukien_dichvu_khac),array("style"=>"text-align:center;"));
				$array_row_product["dukien_thu7"] = array(number_format($dukien_thu7),array("style"=>"text-align:center;"));
				$array_row_product["sinhnhat"] = array(number_format($thongke_tienthua["dukien_sinhnhat"]),array("style"=>"text-align:center;"));
				
					//xu ly tong du kien
				$dukien_tongcong = $dukien_hocphi + $dukien_tienan + $dukien_bantru_phuphi +  $dukien_tiensua + $dukien_an_toi_phuphi_toi + $dukien_dichvu_khac + $dukien_thu7 +$thongke_tienthua["dukien_sinhnhat"];
				$array_row_product["dukien_tongcong"] = array(number_format($dukien_tongcong),array("style"=>"text-align:center;"));
				
				//************************************************************
				//KẾT THÚC Xử lý phần dự kiến
				//**************************************************



				//************************************************************
				// II. Tính Phần Sử Dụng
				//**************************************************
				
				
					//1.tính số tiền sử dụng học phí
					$sudung_hocphi 		   = $thongke_tienthua["sudung_hocphi"];	;
					$sudung_tienan 		   =  $thongke_tienthua["sudung_tienan"];
					$sudung_bantru_phuphi    =  $thongke_tienthua["sudung_bantru_phuphi"];
					$sudung_tien_sua 		 =  $thongke_tienthua["sudung_tien_sua"];
					$sudung_antoi_phuphi_toi =  $thongke_tienthua["sudung_antoi_phuphi_toi"];
					$sudung_dichvu_khac 	  =  $thongke_tienthua["sudung_dichvu_khac"];
					$sudung_thu7 			 =  $thongke_tienthua["sudung_thu7"];
					$tong_sudung  			 =  $thongke_tienthua["tong_sudung"];

				
	
					$array_row_product["sudung_hocphi"] = array(number_format($sudung_hocphi),array("style"=>"text-align:center;"));
					$array_row_product["sudung_tienan"] = array(number_format($sudung_tienan),array("style"=>"text-align:center;"));
					$array_row_product["sudung_bantru_phuphi"] = array(number_format($sudung_bantru_phuphi),array("style"=>"text-align:center;"));
					$array_row_product["sudung_tien_sua"] = array(number_format($sudung_tien_sua),array("style"=>"text-align:center;"));
					$array_row_product["sudung_antoi_phuphi_toi"] = array(number_format($sudung_antoi_phuphi_toi),array("style"=>"text-align:center;"));
					$array_row_product["sudung_dichvu_khac"] = array(number_format($sudung_dichvu_khac),array("style"=>"text-align:center;"));
					$array_row_product["sudung_thu7"] = array(number_format($sudung_thu7),array("style"=>"text-align:center;"));
					$array_row_product["tong_sudung"] = array(number_format($tong_sudung),array("style"=>"text-align:center;"));
					// kết thúc phần stính số tiền đã sử dụng					
		
				//************************************************************
				//KẾT THÚC phần sử dụng
				//**************************************************
				
				
				
				//************************************************************
				// III. Tính Phần Tiền Thừa
				//**************************************************
				
					$tienthua_hocphi 		   = $thongke_tienthua["tienthua_hocphi"];
					$tienthua_tienan 		   = $thongke_tienthua["tienthua_tienan"];
					$tienthua_bantru_phuphi 	= $thongke_tienthua["tienthua_bantru_phuphi"];
					$tienthua_tiensua 		  = $thongke_tienthua["tienthua_tiensua"];
					$tienthua_anto_phuphi_toi  = $thongke_tienthua["tienthua_anto_phuphi_toi"];
					$tienthua_dichvu_khac 	  = $thongke_tienthua["tienthua_dichvu_khac"];
					$tienthua_thu7 		 	 = $thongke_tienthua["tienthua_thu7"];
					$tienthua_thangtruoc 	   = $thongke_tienthua["tienthua_thangtruoc"];
					$tong_tienthua 	   		 = $thongke_tienthua["tong_tienthua"];
					
					
	
	
					$array_row_product["tienthua_hocphi"] = array(number_format($tienthua_hocphi),array("style"=>"text-align:center;"));
					$array_row_product["tienthua_tienan"] = array(number_format($tienthua_tienan),array("style"=>"text-align:center;"));
					$array_row_product["tienthua_bantru_phuphi"] = array(number_format($tienthua_bantru_phuphi),array("style"=>"text-align:center;"));
					$array_row_product["tienthua_tiensua"] = array(number_format($tienthua_tiensua),array("style"=>"text-align:center;"));
					$array_row_product["tienthua_anto_phuphi_toi"] = array(number_format($tienthua_anto_phuphi_toi),array("style"=>"text-align:center;"));
 					$array_row_product["tienthua_dichvu_khac"] = array(number_format($tienthua_dichvu_khac),array("style"=>"text-align:center;"));
 					$array_row_product["tienthua_thu7"] = array(number_format($tienthua_thu7),array("style"=>"text-align:center;"));
 					$array_row_product["tienthua_thangtruoc"] = array(number_format($tienthua_thangtruoc),array("style"=>"text-align:center;"));
											
							
				//************************************************************
				//KẾT THÚC phần tiền thừa
				//**************************************************					
							
				//************************************************************
				// IV. Phần Truy Thu
				//**************************************************							
										
					$truythu_tienan 	    = $thongke_tienthua["truythu_tienan"];
					$truythu_tiensua 	   = $thongke_tienthua["truythu_tiensua"];
					$truythu_antoi 	     = $thongke_tienthua["truythu_antoi"];
					$truythu_thu7 	      = $thongke_tienthua["truythu_thu7"];
					$truythu_dichvu_khac   = $thongke_tienthua["truythu_dichvu_khac"];
					$truythu_no_thangtruoc = $thongke_tienthua["truythu_no_thangtruoc"];
					$tong_truythu 	   	  = $thongke_tienthua["tong_truythu"];
					


 					$array_row_product["truythu_tienan"] = array(number_format($truythu_tienan),array("style"=>"text-align:center;"));
					$array_row_product["truythu_tiensua"] = array(number_format($truythu_tiensua),array("style"=>"text-align:center;"));
 					$array_row_product["truythu_antoi"] = array(number_format($truythu_antoi),array("style"=>"text-align:center;"));
 					$array_row_product["truythu_thu7"] = array(number_format($truythu_thu7),array("style"=>"text-align:center;"));
 					$array_row_product["truythu_dichvu_khac"] = array(number_format($truythu_dichvu_khac),array("style"=>"text-align:center;"));
 					$array_row_product["truythu_no_thangtruoc"] = array(number_format($truythu_no_thangtruoc),array("style"=>"text-align:center;"));

						

					//V.2. Tổng số truy thu
 					$array_row_product["tong_truythu"] = array(number_format($tong_truythu),array("style"=>"text-align:center;"));
					// kết thúc tính số tiền thừa			


					//V.3. Số tiền thừa
 					$array_row_product["tongcong_tienthua"] = array(number_format($tong_tienthua),array("style"=>"text-align:center;"));
					// kết thúc tính số tiền thừa			
															
															
					//V.4. Tổng bù trừ
					$tong_butru 	   		= $thongke_tienthua["tong_butru"];
					$array_row_product["tong_butru"] = array(number_format($tong_butru),array("style"=>"text-align:center;"));
					// kết thúc tính số tiền nộp dư
																			
				//************************************************************
				//KẾT THÚC  Phần CUỐI
				//**************************************************						
							
				//cong don vao chuoi $str_row_product
				$str_row_product .= $this->Template->load_table_row($array_row_product,array("class"=>"hover-row","title"=>$thongke_tienthua["customer_name"]));
				
				
				//$str_col_stt .= "<tr><td>$stt</td></tr>";;
			}//END if($month_year != "01-1970")
		
		}//end for
		
	}//end  if($array_thongke_tienthua)
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  "<div  id='parent'>".$this->Template->load_table($str_header_product.$str_row_header2.$str_row_product,array("id"=>"table_tienthua","border"=>"1"))."</div>";
	//$str_table_product = $this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_tienthua"));	
	//buoc 6: hien thi du lieu table ra man hinh
	
?>

<style>
#parent {
	min-height: 200px;
	max-height: 450px;
	height: auto;
	position: absolute;
    width: 100%;
    left: 0;
	overflow:scroll;
}
			
#table_tienthua {
				width: 1800px !important;
}

#table_tienthua td.selected { border: 1px solid #F00; }
</style>


   <?php echo $str_table_product; ?>

<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"});
	
	$(document).ready(function() {
			//$("#table_tienthua").tableHeadFixer({"head" : true,"left":2}); 
	});
</script>