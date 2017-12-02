
<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='float:left;width:50%;text-align:left;'><b>Công Ty Cổ Phần Khiết Long</b>
	<br/>109 Hoàng Sỹ Khải, Phường An Hải Bắc, Quận Sơn Trà, TP. Đà Nẵng
	<br/>Điện thoại: 0511.393.5775</div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;'><b>Mẫu số B 01-DN</b>
	<br/>(Ban hành theo QĐ số 15/2006/QĐ-BTC<br/>
	ngày 20/03/2006 của Bộ trưởng BTC)</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>BÁO CÁO KẾT QUẢ KINH DOANH</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;'>(Năm 2016)</div>
	<div style='text-align:right;width:100%;font-style:italic'>Đơn vị tính : VND</div>";
	/// table 1
	$array_tbl_top = array(
								"taisan"=>array("CHỈ TIÊU",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:0px;")),
								"maso"=>array("Mã số",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"thuyetminh"=>array("Thuyết minh",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"so_cuoinam"=>array("Năm nay",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								"so_daunam"=>array("Năm trước",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-bottom:0px;")),
								
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
								"1"=>array("1. Doanh thu bán hàng và cung cấp dịch vụ",array("style"=>"font-weight:bold;border:1px solid;border-top:0px;")),
								"2"=>array("10",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("2. Các khoản giảm trừ doanh thu",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("3. Doanh thu thuần về BH và cung cấp DV (10=01-02)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("4. Giá vốn hàng bán",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("5. Lợi nhuận gộp về bán hàng và cung cấp DV (20=10-11)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("6. Doanh thu hoạt động tài chính",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("7. Chi phí tài chính",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("  - Trong đó : Chi phí lãi vay",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("8. Chi phí bán hàng",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("9. Chi phí quản lý doanh nghiệp",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("10. Lợi nhuận thuần từ hoạt động kinh doanh 
      {30=20+(21-22)-(24-25)}",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("11. Thu nhập khác",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("12. Chi phí khác",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("13. Lợi nhuận khác (40=31-32)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("14. Tổng lợi nhuận kế toán trước thuế (50=30+40)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("15. Chi phí thuế TNDN hiện hành",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("16. Chi phí thuế TNDN hoãn lại",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("17. Lợi nhuận sau thuế thu nhập doanh nghiệp
     (60=50-51-52)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	$array_tbl_row = array(
								"1"=>array("18. Lãi cơ bản trên cổ phiếu (*)",array("style"=>"font-weight:bold;border:1px solid;border-bottom:1px solid;border-top:0px;")),
								"2"=>array("11",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"3"=>array("V.01",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
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
	$str_body =  $this->Template->load_function_body($str_top.$str_tbl.$str_tbl_3);	
	echo $str_body;
?>
