
<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='position:absolute;width:100%;text-align:center;font-size:16px;'><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b>
	<br/><span style='font-size:14px;font-weight:bold;text-decoration:underline;'>Độc lập - Tự do - Hạnh phúc</span></div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;font-style:italic;'>Mẫu số: <b>03/TNDN
</b>
	<br/>(Ban hành kèm theo Thông tư số <br/>
	n60/2007/TT-BTC ngày 14/6/2007 của<br/>Bộ Tài chính</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>TỜ KHAI QUYẾT TOÁN THUẾ THU NHẬP DOANH NGHIỆP</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;font-size:14px;'><b>[01] Kỳ tính thuế : ……….từ ………. đến …………</b></div>";
	$array_tbl_thongtin = array(
								"stt"=>array("[02]",array("style"=>"text-align:right;")),
								"ten"=>array("Người nộp thuế :"),
								"ndten"=>array(""),
								"stfax"=>array(""),
								"fax"=>array(""),
								"ndfax"=>array(""),
								"stemail"=>array(""),
								"email"=>array(""),
								"ndmail"=>array("")
							 );
	$str_tbl_tt	= $this->Template->load_table_row($array_tbl_thongtin);
	$array_tbl_thongtin = array(
								"stt"=>array("[03]",array("style"=>"text-align:right;")),
								"ten"=>array("Mã số thuế :"),
								"ndten"=>array(""),
								"stfax"=>array(""),
								"fax"=>array(""),
								"ndfax"=>array(""),
								"stemail"=>array(""),
								"email"=>array(""),
								"ndmail"=>array("")
							 );
	$str_tbl_tt		.= $this->Template->load_table_row($array_tbl_thongtin);
	$array_tbl_thongtin = array(
								"stt"=>array("[04]",array("style"=>"text-align:right;")),
								"ten"=>array("Địa chỉ :"),
								"ndten"=>array(""),
								"stfax"=>array(""),
								"fax"=>array(""),
								"ndfax"=>array(""),
								"stemail"=>array(""),
								"email"=>array(""),
								"ndmail"=>array("")
							 );
	$str_tbl_tt		.= $this->Template->load_table_row($array_tbl_thongtin);
	$array_tbl_thongtin = array(
								"stt"=>array("[06]",array("style"=>"text-align:right;")),
								"ten"=>array("Quận/Huyện :"),
								"ndten"=>array(""),
								"stfax"=>array(""),
								"fax"=>array(""),
								"ndfax"=>array(""),
								"stemail"=>array("[09]",array("style"=>"text-align:right;")),
								"email"=>array("Tỉnh/Thành phố :"),
								"ndmail"=>array("")
							 );
	$str_tbl_tt		.= $this->Template->load_table_row($array_tbl_thongtin);
	$array_tbl_thongtin = array(
								"stt"=>array("[07]",array("style"=>"text-align:right;")),
								"ten"=>array("Điện thoại :"),
								"ndten"=>array(""),
								"stfax"=>array("[08]",array("style"=>"text-align:right;")),
								"fax"=>array("Fax :"),
								"ndfax"=>array(""),
								"stemail"=>array("[10]",array("style"=>"text-align:right;")),
								"email"=>array(" E-mail :"),
								"ndmail"=>array("")
							 );
	$str_tbl_tt		.= $this->Template->load_table_row($array_tbl_thongtin);
	
	$str_tbl_thongtin =  $this->Template->load_table($str_tbl_tt);	
	
	/// table 1
	$array_tbl_top = array(
								
								"ndfax"=>array("",array("style"=>"border-left:1px solid;border-top:1px solid;")),
			
								"ndmail"=>array("Đơn vị tiền : đồng Việt Nam",array("colspan"=>"3","style"=>"border-right:1px solid;border-top:1px solid;font-style:italic;text-align:right;"))
							 );
	$str_tbl_top		= $this->Template->load_table_row($array_tbl_top);
	
	$array_tbl_top = array(
								"taisan"=>array("STT",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:0px;")),
								"maso"=>array("Chỉ tiêu",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"thuyetminh"=>array("Mã số ",array("style"=>"width:10% !important;font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"so_cuoinam"=>array("Số tiền",array("style"=>"width:20% !important;font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;"))
							 );
	$str_tbl_top 	.= $this->Template->load_table_row($array_tbl_top);
	$array_tbl_row = array(
								"1"=>array("(1)",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"2"=>array("(2)",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"3"=>array("(3)",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"4"=>array("(4)",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
							 );
	$str_tbl_row 	.= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("A.",array("style"=>"font-weight:bold;border:1px solid;border-top:0px;border-bottom:1px dotted;")),
								"2"=>array("Kết quả kinh doanh ghi nhận theo báo cáo tài chính",array("style"=>"font-weight:bold;border:1px solid;border-top:0px;border-left:0px;border-bottom:1px dotted;")),
								"3"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;border-bottom:1px dotted;")),
								"4"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;border-bottom:1px dotted;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Tổng lợi nhuận kế toán trước thuế thu nhâp doanh nghiệp",array("style"=>"font-weight:bold;border:1px solid;border-top:0px;border-left:0px;border-bottom:1px dotted;")),
								"3"=>array("A1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("B.",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Xác định thu nhập chịu thuế theo Luật thuế thu nhập doanh nghiệp",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Điều chỉnh giảm tổng lợi nhuận trước thuế thu nhập doanh nghiệp
(B1 = B2 + B3 + … + B16)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.1",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("Các khoản điều chỉnh tăng doanh thu",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.2",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí của phần doanh thu điều chỉnh giảm",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B4",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.3",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Thuế thu nhập đã nộp cho phần thu nhập nhận được ở nước ngoài",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B4",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.4",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí khấu hao TSCĐ không đúng quy định",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B5",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.5",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí lãi tiền vay vượt mức không chế theo quy định",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B6",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.6",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí không có hóa đơn, chứng từ theo chế độ quy định",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.7",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Các khoản thuế bị truy thu và tiền phạt về vi phạm hành chính đã tính vào chi phí",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B8",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.8",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí không liên quan đến doanh thu, thu nhập chịu thuế thu nhập doanh nghiệp",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B9",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.9",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Chi phí tiền lương, tiền công không được tính vào chi phí hợp lý do vi phạm chế độ hợp đồng lao động; Chi phí tiền lương, tiền công của chủ doanh nghiệp tư nhân, thành viên hợp danh, chủ hộ cá thể, cá nhân kinh doanh và tiền thù lao trả cho sáng lập viên,",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B10",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1.10",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Các khoản trích trước vào chi phí mà thực tế không chi",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B11",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Điều chỉnh giảm tổng lợi nhuận trước thuế thu nhập doanh nghiệp
(B17 = B18 + B19 + B20 + B21 + B22)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B17",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Tổng thu nhập chịu thuế thu nhập doanh nghiệp chưa trừ chuyển lỗ 
(B23 = A1 + B1 - B17)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B17",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Lỗ từ các năm trước chuyển sang (B26 = B27 + B28)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B17",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Tổng thu nhập chịu thuế thu nhập doanh nghiệp (đã trừ chuyển lỗ)
(B29 = B30 + B31)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B17",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("C.",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Xác định số thuế thu nhập doanh nghiệp phải nộp trong kỳ tính thuế",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("B17",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Thuế TNDN từ hoạt động SXKD (C1 = C2-C3-C4-C5)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("C1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("Thuế TNDN từ hoạt động chuyển quyền sử dụng đất, chuyển quyền thuê đất (C6 = C7 + C8 - C9)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("C1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("Thuế thu nhập doanh  nghiệp phát sinh phải nộp trong kỳ tính thuế 
(C10 = C1 + C6)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("C10",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(30000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$str_tbl =  $this->Template->load_table($str_tbl_top.$str_tbl_row);	
	
	
	/// table 2
	$str_title_h2	= "<h2 style='text-align:left;width:100%'>D. Ngoài các Phụ lục của tờ khai này, chúng tôi gửi kèm theo các tài liệu sau :</h2>";
	

	$array_tbl_row_2 = array(
								"1"=>array("1",array("style"=>"width:5% !important;text-align:center;border:1px solid;border-bottom:1px dotted;")),
								
								"3"=>array(" ",array("style"=>"width:5% !important;text-align:center;border:1px solid;border-bottom:1px dotted;border-left:0px;")),
								
								"5"=>array("",array("style"=>"border:1px solid;border-bottom:1px dotted;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("2",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								
								"5"=>array("",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("3",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								
								"5"=>array("",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	
	
	$array_tbl_row_2 = array(
								"1"=>array("4",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"3"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								
								"5"=>array("",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	
	$str_tbl_2 =  $this->Template->load_table($str_tbl_top_2.$str_tbl_row_2);	
	
	// table 3
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array(""),
								"ketoantruong"=>array(""),
								"giamdoc"=>array("Tôi cam đoan là các số liệu kê khai này là đúng và chịu trách nhiệm trước pháp luật về số liệu đã kê khai.",array("style"=>"padding-top:20px;padding-right:50px;padding-bottom:20px;text-align:right;font-weight:bold;"))
							);
	$str_tbl_row_3 = $this->Template->load_table_row($array_tbl_row_3);
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array("",array("style"=>"text-align:center;font-weight:bold;")),
								"ketoantruong"=>array("",array("style"=>"text-align:center;font-weight:bold;")),
								"giamdoc"=>array("Tp. HCM, ngày 20 tháng 08 năm 2008",array("style"=>"padding-right:70px;text-align:right;"))
							);
	$str_tbl_row_3 .= $this->Template->load_table_row($array_tbl_row_3);
	
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array("",array("style"=>"text-align:center;font-style:italic;")),
								"ketoantruong"=>array("",array("style"=>"text-align:center;font-style:italic;")),
								"giamdoc"=>array("ĐẠI DIỆN HỢP PHÁP CỦA NGƯỜI NỘP THUẾ",array("style"=>"font-weight:bold;text-align:right;padding-right:45px;"))
							);
	$str_tbl_row_3 .= $this->Template->load_table_row($array_tbl_row_3);
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array("",array("style"=>"text-align:center;font-style:italic;")),
								"ketoantruong"=>array("",array("style"=>"text-align:center;font-style:italic;")),
								"giamdoc"=>array("Ký tên, đóng dấu (ghi rõ họ tên và chức vụ)",array("style"=>"text-align:right;padding-right:55px;padding-bottom:100px;"))
							);
	$str_tbl_row_3 .= $this->Template->load_table_row($array_tbl_row_3);
	$str_tbl_3 =  $this->Template->load_table($str_tbl_row_3);	
	$str_body =  $this->Template->load_function_body($str_top.$str_tbl_thongtin.$str_tbl.$str_title_h2.$str_tbl_2.$str_tbl_3);	
	echo $str_body;
?>
