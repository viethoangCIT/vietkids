<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "TỔNG HỢP NỢ";
	if((isset($_GET["type"])) && ($_GET["type"] == "0"))$function_title = "TỔNG HỢP NỢ PHẢI THU";
	if((isset($_GET["type"])) && ($_GET["type"] == "1"))$function_title = "TỔNG HỢP NỢ PHẢI TRẢ";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array(
							"donvi"=>array("Đơn vị",array("style"=>"text-align:center")),
							"diachi"=>array("Địa chỉ",array("style"=>"text-align:center")),
							"dauky"=>array("Đầu kỳ",array("style"=>"text-align:center;")),
							"no"=>array("Nợ",array("style"=>"text-align:center;")),
							"tra"=>array("Trả",array("style"=>"text-align:center;")),
							"du_no"=>array("Dư nợ",array("style"=>"text-align:center;")),
				);
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);
			
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$array_row_product = NULL;
	
	$array_row_product["donvi"] 	= array("Công Ty Gas Petro Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["diachi"] 				= array("Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["dauky"] 				= array("0",array("style"=>"text-align:center;"));
	$array_row_product["no"] 			= array("550.000",array("style"=>"text-align:center;"));
	$array_row_product["tra"] 			= array("350.000",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("200.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	$array_row_product["donvi"] 	= array("Công Ty Gas ORIGIN Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["diachi"] 				= array("Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["dauky"] 				= array("2.000.000",array("style"=>"text-align:center;"));
	$array_row_product["no"] 			= array("0",array("style"=>"text-align:center;"));
	$array_row_product["tra"] 			= array("0",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("2.000.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	$array_row_product["donvi"] 	= array("Công Ty Gas Petro Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["diachi"] 				= array("Đà Nẵng",array("style"=>"text-align:center;"));
	$array_row_product["dauky"] 				= array("0",array("style"=>"text-align:center;"));
	$array_row_product["no"] 			= array("550.000",array("style"=>"text-align:center;"));
	$array_row_product["tra"] 			= array("350.000",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("200.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	
	document.getElementById('loai').value = "<?php echo $type; ?>";
</script>
