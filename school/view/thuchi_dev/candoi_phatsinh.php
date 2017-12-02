<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='float:left;width:50%;text-align:left;'><b>Công Ty Cổ Phần Khiết Long</b>
	<br/>109 Hoàng Sỹ Khải, Phường An Hải Bắc, Quận Sơn Trà, TP. Đà Nẵng
	<br/>Điện thoại: 0511.393.5775</div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;'><b>Mẫu số B 01-DN</b>
	<br/>(Ban hành theo QĐ số 15/2006/QĐ-BTC<br/>
	ngày 20/03/2006 của Bộ trưởng BTC)</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>BẢNG CÂN ĐỐI PHÁT SINH</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;'>Từ ngày:11/1/2016  - đến ngày: 1/31/2016</div>
	<div style='text-align:right;width:100%;font-style:italic'>Đơn vị tính : VND</div>";
	/// table 1
	$array_tbl_top = array(
								"sohieu"=>array("Số hiệu",array("rowspan"=>"2","style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"maso"=>array("Tên tài khoản kế toán",array("rowspan"=>"2","style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"so_dauky"=>array("Số dư đầu kỳ",array("colspan"=>"2","style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"so_phatsinh"=>array("Số phát sinh",array("colspan"=>"2","style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"so_cuoiky"=>array("Số dư cuối kỳ",array("colspan"=>"2","style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"so_tt"=>array("STT",array("rowspan"=>"3","style"=>"font-weight:bold;text-align:center;border:1px solid;"))
								
							 );
	$str_tbl_top = $this->Template->load_table_row($array_tbl_top);
	
	$array_tbl_top = array(
								"n1"=>array("Nợ",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"c1"=>array("Có",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"n2"=>array("Nợ",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"c2"=>array("Có",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"n3"=>array("Nợ",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"c3"=>array("Có",array("style"=>"font-weight:bold;text-align:center;border:1px solid;"))
							 );
	$str_tbl_top .= $this->Template->load_table_row($array_tbl_top);
	$array_tbl_row = array(
								"a"=>array("A",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"b"=>array("B",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"1"=>array("1",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"2"=>array("2",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"3"=>array("3",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"4"=>array("4",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"5"=>array("5",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"6"=>array("6",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
							 );
	$str_tbl_row = $this->Template->load_table_row($array_tbl_row);
	
	foreach ($array_taikhoan as $row)
	{
	$array_tbl_row = array(
								"1"=>array($row["ma"],array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:1px solid;border-right:1px solid;")),
								"2"=>array($row["ten"],array("style"=>"border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"3"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"6"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"7"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"8"=>array(number_format(),array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"9"=>array("",array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	}

	$array_tbl_row = array(
								"1"=>array("X",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"2"=>array("Tổng cộng",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"3"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"4"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"5"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"6"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"7"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"8"=>array(number_format(20000000),array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"9"=>array("005",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	
	$str_tbl =  $this->Template->load_table($str_tbl_top.$str_tbl_row);	
	
	
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
