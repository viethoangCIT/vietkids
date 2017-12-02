
<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='float:left;width:50%;text-align:left;'><b>Công Ty Cổ Phần Khiết Long</b>
	<br/>109 Hoàng Sỹ Khải, Phường An Hải Bắc, Quận Sơn Trà, TP. Đà Nẵng
	<br/>Điện thoại: 0511.393.5775</div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;'><b>Mẫu số B 01-DN</b>
	<br/>(Ban hành theo QĐ số 15/2006/QĐ-BTC<br/>
	ngày 20/03/2006 của Bộ trưởng BTC)</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>BẢNG CÂN ĐỐI KẾ TOÁN</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;'>(Tại ngày 31 tháng 12 năm 2007)</div>
	<div style='text-align:right;width:100%;font-style:italic'>Đơn vị tính : VND</div>";
	/// table 1
	$array_tbl_top = array(
								"taisan"=>array("TÀI SẢN",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:0px;")),
								"maso"=>array("Mã số",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"thuyetminh"=>array("Thuyết minh",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"so_cuoinam"=>array("Số cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"so_daunam"=>array("Số đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								
							 );
	$str_tbl_top = $this->Template->load_table_row($array_tbl_top);
	$array_tbl_row = array(
								"1"=>array("1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"2"=>array("2",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"3"=>array("3",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"4"=>array("4",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"5"=>array("5",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
							 );
	$str_tbl_row = $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("A- TÀI SẢN NGẮN HẠN (100=110+120+130+140+150)",array("style"=>"font-weight:bold;border:1px solid;border-top:0px;")),
								"2"=>array("110",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("I. Tiền và các khoản tương đương tiền",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Tiền",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Các khoản tương đương tiền",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("II. Các khoản đầu tư tài chính ngắn hạn",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Đầu tư ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Dự phòng giảm giá đầu tư ngắn hạn (*) (2)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("III. Các khoản phải thu ",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Phải thu của khách hàng",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Trả trước cho người bán",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Phải thu nội bộ ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Phải thu theo tiến độ kế hoạch hợp đồng xây dựng",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Các khoản phải thu khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("6. Dự phòng phải thu ngắn hạn khó đòi (*)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("IV. Hàng tồn kho",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Hàng tồn kho",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Dự phòng giảm giá hàng tồn kho (*)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("V. Tài sản ngắn hạn khác",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Chi phí trả trước ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Thuế GTGT được khấu trừ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Thuế và các khoản khác phải thu Nhà nước",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Tài sản ngắn hạn khác",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("B- TÀI SẢN DÀI HẠN (200=210+220+240+250+260)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("I. Các khoản phải thu dài hạn",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Phải thu dài hạn của khách hàng",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Vốn kinh doanh ở đơn vị trực thuộc",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Phải thu nội bộ dài hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Phải thu dài hạn khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Dự phòng phải thu dài hạn khó đòi (*)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("II. Tài sản cố định",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Tài sản cố định hữu hình",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array(" - Nguyên giá",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Giá trị hao mòn luỹ kế (*)",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Tài sản cố định thuê tài chính",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("   - Nguyên giá",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("    - Giá trị hao mòn luỹ kế (*)",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Tài sản cố định vô hình",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Nguyên giá",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Giá trị hao mòn luỹ kế (*)",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Chi phí xây dựng cơ bản dở dang",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("III. Bất động sản sản đầu tư",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Nguyên giá",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Giá trị hao mòn luỹ kế (*)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("IV. Các khoản đầu tư tài chính dài hạn",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Đầu tư vào công ty con",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Đầu tư vào công ty liên kết, liên doanh",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Đầu tư dài hạn khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Dự phòng giảm giá đầu tư tài chính dài hạn (*)",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("V. Tài sản dài hạn khác",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Chí phí trả trước dài hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Tài sản thuế thu nhập hoãn lại ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Tài sản dài hạn khác",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("TỔNG CỘNG TÀI SẢN (270 = 100 + 200)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("NGUỒN VỐN",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("Số cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("Số đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("2",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("3",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("4",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("5",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);

	$array_tbl_row = array(
								"1"=>array("A- NỢ PHẢI TRẢ (300 = 310 + 320)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("I. Nợ ngắn hạn",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Vay và nợ ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Phải trả người bán",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Người mua trả tiền trước",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Thuế và các khoản phải nộp Nhà nước",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Phải trả người lao động",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("6. Chi phí phải trả",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("7. Phải trả nội bộ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("8. Phải trả theo tiến độ kế hoạch hợp đồng xây dựng",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("9. Các khoản phải trả, phải nộp ngắn hạn khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("10. Dự phòng phải trả ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("II. Nợ dài hạn",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Phải trả dài hạn người bán",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Phải trả dài hạn nội bộ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Phải trả dài hạn khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Vay và nợ dài hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Thuế thu nhập hoãn lại phải trả",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("6. Dự phòng trợ cấp mất việc làm",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("7. Dự phòng phải trả dài hạn",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("B- VỐN CHỦ SỞ HỮU (400 = 410 + 420)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("I. Vốn chủ sở hữu",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);

	$array_tbl_row = array(
								"1"=>array("1. Vốn đầu tư của chủ sở hữu",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Thặng dư vốn cổ phần",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Vốn khác của chủ sở hữu",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Cổ phiếu quỹ (*)",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Chênh lệch đánh giá lại tài sản",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("6. Chênh lệch tỷ giá hối đoái",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("7. Quỹ đầu tư phát triển",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("8. Quỹ dự phòng tài chính",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("9. Quỹ khác thuộc vốn chủ sở hữu",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("10. Lợi nhuận sau thuế chưa phân phối",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("11. Nguồn vốn đầu tư XDCB",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("II. Nguồn kinh phí và quỹ khác",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("1. Quỹ khen thưởng, phúc lợi ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Nguồn kinh phí",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Nguồn kinh phí đã hình thành TSCĐ",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("111",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("TỔNG CỘNG NGUỒN VỐN (430 = 300 + 400)",array("style"=>"text-align:center;font-weight:bold;border:1px solid;border-top:0px;")),
								"2"=>array("430",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$str_tbl =  $this->Template->load_table($str_tbl_top.$str_tbl_row);	
	
	/// table 2
	$str_title_h2	= "<h2 style='text-align:center;width:100%'>CÁC CHỈ TIÊU NGOẢI BẢNG CÂN ĐỐI KẾ TOÁN</h2>";
	$array_tbl_top_2 = array(
								"taisan"=>array("Chỉ tiêu",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"thuyetminh"=>array("Thuyết minh",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"so_cuoinam"=>array("Số cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"so_daunam"=>array("Số đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
								
							 );
	$str_tbl_top_2 = $this->Template->load_table_row($array_tbl_top_2);
	

	$array_tbl_row_2 = array(
								"1"=>array("1. Tài sản thuê ngoài",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("2. Vật tư, hàng hóa nhận giữ hộ, nhận gia công",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array("24",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("3. Hàng hóa nhận bán hộ, nhận ký gửi, ký cược",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("4. Nợ khó đòi đã xử lý",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("5. Ngoại tệ các loại",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("6. Dự toán chi sự nghiệp, dự án",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	
	$str_tbl_2 =  $this->Template->load_table($str_tbl_top_2.$str_tbl_row_2);	
	
	// table 3
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array(""),
								"ketoantruong"=>array(""),
								"giamdoc"=>array("Lập, ngày 14 tháng 04 năm 2016",array("style"=>"text-align:center;font-style:italic;"))
							);
	$str_tbl_row_3 = $this->Template->load_table_row($array_tbl_row_3);
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array("Người lập biểu",array("style"=>"text-align:center;font-weight:bold;")),
								"ketoantruong"=>array("Kế toán trưởng",array("style"=>"text-align:center;font-weight:bold;")),
								"giamdoc"=>array("Giám đốc",array("style"=>"text-align:center;font-weight:bold;"))
							);
	$str_tbl_row_3 .= $this->Template->load_table_row($array_tbl_row_3);
	
	$array_tbl_row_3 = array(
								"nguoilapphieu"=>array("(Ký, họ tên)",array("style"=>"text-align:center;font-style:italic;")),
								"ketoantruong"=>array("(Ký, họ tên)",array("style"=>"text-align:center;font-style:italic;")),
								"giamdoc"=>array("(Ký, họ tên, đóng dấu)",array("style"=>"text-align:center;font-style:italic;"))
							);
	$str_tbl_row_3 .= $this->Template->load_table_row($array_tbl_row_3);
	

	$str_tbl_3 =  $this->Template->load_table($str_tbl_row_3);	
	
	$str_body =  $this->Template->load_function_body($str_top.$str_tbl.$str_title_h2.$str_tbl_2.$str_tbl_3);	
	echo $str_body;
?>
