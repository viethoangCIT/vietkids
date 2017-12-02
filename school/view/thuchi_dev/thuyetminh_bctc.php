
<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='float:left;width:50%;text-align:left;'><b>Công Ty Cổ Phần Khiết Long</b>
	<br/>109 Hoàng Sỹ Khải, Phường An Hải Bắc, Quận Sơn Trà, TP. Đà Nẵng
	<br/>Điện thoại: 0511.393.5775</div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;'><b>Mẫu số B 01-DN</b>
	<br/>(Ban hành theo QĐ số 15/2006/QĐ-BTC<br/>
	ngày 20/03/2006 của Bộ trưởng BTC)</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>BẢN THUYẾT MINH BÁO CÁO TÀI CHÍNH</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;'>(2016)</div>
	<div style='text-align:right;width:100%;font-style:italic'>Đơn vị tính : VND</div>";
	$array_tbl_list = array(
								"row1"=>array(" I - Đặc điểm hoạt động của doanh nghiệp",array("style"=>"font-weight:bold;")),
							 );
	$tbl_list_row = $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 1 - Hình thức sỡ hữu vốn"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 2 - Lĩnh vực kinh doanh"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 3- Ngành nghề kinh doanh"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 4 - Đặc điểm hoạt động của doanh nghiệp trong năm tài chính có ảnh hưởng đến báo cáo tài chính."),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" II - Kỳ kế toán, đơn vị tiền tệ sử dụng trong kế toán",array("style"=>"font-weight:bold;")),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 1 - Kỳ kế toán năm (Bắt đầu từ ngày 01/01/2006 kết thúc vào ngày 31/12/2006)"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 2 - Đơn vị tiền tề sử dụng trong kế toán"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" III - Chuẩn mực và Chế độ kế toán áp dụng",array("style"=>"font-weight:bold;")),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 1 - Chế độ kế toán áp dụng"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 2 - Tuyên bố về việc tuân thủ chuẩn mực kế toán và Chế độ kế toán"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 3 - Hình thức kế toán áp dụng"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" IV - Các chính sách kế toán áp dụng",array("style"=>"font-weight:bold;")),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 1 - Nguyên tắc ghi nhận các khoản tiền và các khoản tương đương tiền."),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("   Phương pháp chuyển đổi các đồng tiền khác ra đồng tiền sử dụng trong kế toán."),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Nguyên tắc ghi nhận hàng tồn kho"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp tính giá trị hàng tồn kho"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp hoạch toán hàng tồn kho"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp lập dự phòng giảm giá hàng tồn kho"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 3 - Nguyên tắc ghi nhận và khấu hao TSCĐ"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Nguyên tắc ghi nhận TSCĐ (hữu hình, vô hình, thuế tài chính)"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp khấu hao TSCĐ (hữu hình, vô hình, thuế tài chính)"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 4 - Nguyên tắc ghi nhận và khấu hao bất động sản đầu tư"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Nguyên tắc ghi nhận bất động sản đầu tư"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp khấu hao bất động sản đầu tư"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" 5 - Nguyên tắc ghi nhận và vốn hóa các khoảng chi phí đi vay: "),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Các khoảng đầu tư vào công ty con, công ty liên kết, vốn góp vào cơ sở kinh doanh đồng kiểm soát"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" - Các khoản đầu tư ngắn hạn, dài hạn khác"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array("  - Phương pháp lập dự phòng giảm giá đầu tư ngắn hạn, dài hạn"),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	$array_tbl_list = array(
								"row1"=>array(" V - Thông tin bỗ sung cho các khoản mục trình bày trong bảng cân đối kế toán",array("style"=>"font-weight:bold;")),
							 );
	$tbl_list_row 	.= $this->Template->load_table_row($array_tbl_list);
	
	$tbl_list =  $this->Template->load_table($tbl_list_row);
	$str_top_vn	= 	"<div style='text-align:right;width:100%;font-style:italic'>Đơn vị tính : VND</div>";
	$array_tbl_top_2 = array(
								"taisan"=>array(" 01 - Tiền",array("style"=>"font-weight:bold;border:1px solid;border-right:0px;")),
								"thuyetminh"=>array("Cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-right:0px;")),
								"so_daunam"=>array("Đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;"))
								
							 );
	$str_tbl_top_2 = $this->Template->load_table_row($array_tbl_top_2);
	

	$array_tbl_row_2 = array(
								"1"=>array(" - Tiền mặt",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Tiền gửi ngân hàng",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Tiền đang chuyển",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("Cộng",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("02 - Các khoản đầu tư tài chính ngắn hạn: ",array("style"=>"font-weight:bold;border:1px solid;border-right:0px;border-top:0px;")),
								"4"=>array("Cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-right:0px;border-top:0px;")),
								"5"=>array("Đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-top:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Chứng khoán đầu tư ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Đầu tư ngắn hạn khác",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Dự phòng phải giảm giá đầu tư ngắn hạn",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("Cộng",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
		$array_tbl_row_2 = array(
								"1"=>array("03 - Các khoản phải thu ngắn hạn khác: ",array("style"=>"font-weight:bold;border:1px solid;border-right:0px;border-top:0px;")),
								"4"=>array("Cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-right:0px;border-top:0px;")),
								"5"=>array("Đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-top:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Phải thu về cổ phần hóa",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Phải thu về cổ phần hóa và lợi nhuận được chia",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Phải thu người lao động",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Phải thu khác",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("Cộng",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
		$array_tbl_row_2 = array(
								"1"=>array("04 - Hàng tồn kho: ",array("style"=>"font-weight:bold;border:1px solid;border-right:0px;border-top:0px;")),
								"4"=>array("Cuối năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-right:0px;border-top:0px;")),
								"5"=>array("Đầu năm",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;border-top:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Hàng mua đang đi đường",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array(" ",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Nguyên liệu, vật liệu",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Công cụ, dụng cụ",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Chi phí SX, KD dỡ dang",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Thành phẩm",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Hàng hóa",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Hàng gửi đi bán",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Hàng hóa kho bảo thuế",array("style"=>"border:1px solid;border-bottom:1px dotted;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px dotted;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("- Hàng hóa bất động sản",array("style"=>"border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("",array("style"=>"text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	
	$array_tbl_row_2 = array(
								"1"=>array("Cộng giá gốc hàng tồn kho",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-right:0px;")),
								"4"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;border-right:0px;")),
								"5"=>array("-",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-bottom:1px solid;border-top:0px;border-left:0px;"))
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("* Giá trị ghi sổ hàng tồn kho dùng để thế chấp, cầm cố đảm bảo các khoản nợ phải trả: "),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("* Giá trị hoàn nhập dự phòng giảm giá hàng tồn kho trong năm: "),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("* Các trường hợp hoặc sự kiện dẫn đến phải trích thêm hoặc nhập dự phòng giảm giá hàng tồn kho:"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	
	
	
	$array_tbl_row_2 = array(
								"1"=>array("29 - Tiền và các khoản tương đương tiền cuối kỳ:"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("29.1 - Các giao dịch không bằng tiền"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Mua tài sản bằng cách nhận các khoản nợ liên quan trực tiếp hoặc thông qua nghiệp vụ cho thuê tài chính: "),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Mua doanh nghiệp thông qua phát hành cổ phiếu"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Chuyển nợ thành vốn chủ sở hữu : "),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("29.2 - Mua và thanh lý nhanh công ty hoặc đơn vị kinh doanh khác trong kỳ báo cáo"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" - Tổng giá trị mua hoặc thanh lý :"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" Phần giá trị mua hoặc thanh lý được thanh toán bằng tiền và các khoản đương tiền :"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array("VII - Những thông tin khác",array("style"=>"font-weight:bold")),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" 1 - Những khoản nợ ngẫu nhiên, khoản cam kết và những thông tin tài chính khác "),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" 2 - Thông tin so sánh (những thay đổi về thông tin năm trước)"),
								"4"=>array(""),
								"5"=>array("")
							 );
	$str_tbl_row_2 .= $this->Template->load_table_row($array_tbl_row_2);
	$array_tbl_row_2 = array(
								"1"=>array(" 3 - Những khoản khác"),
								"4"=>array(""),
								"5"=>array("")
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
	
	$str_body =  $this->Template->load_function_body($str_top.$tbl_list.$str_title_h2.$str_top_vn.$str_tbl_2.$str_tbl_3);	
	echo $str_body;
?>
