<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "CHI TIẾT TẠM / HOÀN ỨNG";
	
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array(
							"maso"=>array("Ngày",array("style"=>"text-align:center")),
							"doituong"=>array("Số chứng từ",array("style"=>"text-align:center","colspan"=>"2")),
							"diengiai"=>array("Diễn giải",array("style"=>"text-align:center")),
							"sotien"=>array("Số tiền",array("style"=>"text-align:center;","colspan"=>"2")),
				);
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);
	$array_header_product2 =  array(
					"maso"=>array("",array("style"=>"text-align:center; width:100px")),
					"ct_tamung"=>array("Tạm Ứng",array("style"=>"text-align:center; width:150px")),
					"ct_hoanung"=>array("Hoàn Ứng",array("style"=>"text-align:center; width:150px")),
					"diengiai"=>array("",array("style"=>"text-align:center;width:300px")),
					"sotien_tamung"=>array("Tạm Ứng",array("style"=>"text-align:center; width:150px")),
					"sotien_hoanung"=>array("Hoàn Ứng",array("style"=>"text-align:center; width:150px")),												
			);		
	$str_header_product .= $this->Template->load_table_row($array_header_product2,array("style"=>"background-color: #2f83b7;color:white"));			
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$array_row_product = NULL;
	
	$array_row_product["maso"] 	= array("17-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["ct_tamung"] 				= array("3",array("style"=>"text-align:center;"));
	$array_row_product["ct_hoanung"] 				= array("0",array("style"=>"text-align:center;"));
	$array_row_product["diengiai"] 			= array("Đầu kỳ",array("style"=>"text-align:center;"));
	$array_row_product["sotien_tamung"] 			= array("570.000",array("style"=>"text-align:center;"));
	$array_row_product["sotien_hoanung"] 			= array("",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	$array_row_product["maso"] 	= array("18-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["ct_tamung"] 				= array("0",array("style"=>"text-align:center;"));
	$array_row_product["ct_hoanung"] 				= array("3",array("style"=>"text-align:center;"));
	$array_row_product["diengiai"] 			= array("Hoàn ứng",array("style"=>"text-align:center;"));
	$array_row_product["sotien_tamung"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["sotien_hoanung"] 			= array("57.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	$array_row_product["maso"] 	= array("19-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["ct_tamung"] 				= array("0",array("style"=>"text-align:center;"));
	$array_row_product["ct_hoanung"] 				= array("3",array("style"=>"text-align:center;"));
	$array_row_product["diengiai"] 			= array("Hoàn ứng",array("style"=>"text-align:center;"));
	$array_row_product["sotien_tamung"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["sotien_hoanung"] 			= array("57.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	
	document.getElementById('loai').value = "<?php echo $type; ?>";
</script>
