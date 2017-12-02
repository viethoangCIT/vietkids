<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Quản lý Thu Chi";
	
	$tungay = date("d-m-Y",strtotime($tungay));
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim,"onkeyup"=>"timKiem()"));
	$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
	if($this->get_config("donvi_name") == "vutico")
	{
		$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi","2"=>"Nợ phải thu","3"=>"Nợ phải trả");
	}
	$str_timkiem .= $this->Template->load_label(" Loại: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"loai","id"=>"loai","style"=>"width:100px"),$array_type);
	
	$str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label("Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay));
	
	if($this->get_config("thuchi_customer_view") != "no")
	{
		$str_timkiem .= "<br> Khách hàng: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"customer_name","id"=>"customer_name","style"=>"width:163px","value"=>$customer_name));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_customer","id"=>"id_customer","style"=>"width:120px","value"=>$id_customer));
	}
	if($this->get_config("thuchi_project_view") != "no")
	{
		$str_timkiem .= " Dự án: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"project_name","id"=>"project_name","style"=>"width:229px","value"=>$project_name));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_project","id"=>"id_project","style"=>"width:120px","value"=>$id_project));
	}
	if($this->get_config("thuchi_contract_view") != "no")
	{
		$str_timkiem .= " Hợp đồng: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"post_title","id"=>"post_title","style"=>"width:98px","value"=>$post_title));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_post","id"=>"id_post","style"=>"width:120px","value"=>$id_post));
	}
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	if($this->get_config("thuchi_excel") != "no")
	{
		$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	}
	$link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"quanly_thuchi"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	if($this->get_config("thuchi") == "0")
	{
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"type"=>array("Loại",array("style"=>"text-align:center")),
							"issued_date"=>array("Ngày",array("style"=>"text-align:center")),
							"post_number"=>array("Số Hợp Đồng",array("style"=>"text-align:center")),
							"name"=>array("Tên khoản thu - chi / Vật tư",array("style"=>"text-align:center")),
							"project_name"=>array("Tên Dự Án",array("style"=>"text-align:center")),
							"customer_name"=>array("Tên Khách Hàng",array("style"=>"text-align:center")),
							"price"=>array("Số Tiền",array("style"=>"text-align:center")),
							"quantity"=>array("Số Lượng",array("style"=>"text-align:center")),	
							"amount"=>array("Tổng Tiền",array("style"=>"text-align:center")),
								
							
							"sua"=>array("Tùy Chọn",array("style"=>"text-align:center; width:5%")),
					);
		//buoc 2: dung hàm load_table_header de lay template table header		
		$str_header_product = $this->Template->load_table_header($array_header_product);			
	}else
	{
		if($this->get_config("donvi_name") == "gaskieutram")
		{
				$array_header_product =   array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
								"type"=>array("Loại",array("style"=>"text-align:center")),
								"issued_date"=>array("Ngày",array("style"=>"text-align:center")),
								"desc"=>array("Diễn giải",array("style"=>"text-align:center")),
								"account_money_name"=>array("Tài khoản",array("style"=>"text-align:center")),
								"amount"=>array("Tổng Tiền",array("style"=>"text-align:center")),
								"sua"=>array("Tùy Chọn",array("style"=>"text-align:center; width:5%")),										
						);
		}else
		{
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"type"=>array("Loại",array("style"=>"text-align:center")),
							"issued_date"=>array("Ngày",array("style"=>"text-align:center")),	
							"project_name"=>array("Tên Dự Án",array("style"=>"text-align:center")),
							"customer_name"=>array("Tên Khách Hàng",array("style"=>"text-align:center")),
							"name"=>array("Tên",array("style"=>"text-align:center")),
							"price"=>array("Số Tiền",array("style"=>"text-align:center")),
							"quantity"=>array("Số Lượng",array("style"=>"text-align:center")),	
							"amount"=>array("Tổng Tiền",array("style"=>"text-align:center")),
							
						
							"sua"=>array("Tùy Chọn",array("style"=>"text-align:center; width:5%")),											
					);
		}
		//buoc 2: dung hàm load_table_header de lay template table header		
		$str_header_product = $this->Template->load_table_header($array_header_product);				
	}
	
	if($this->get_config("donvi_name") == "vutico")
	{
			$array_header_product =  array("ngay"=>array("Ngày",array("style"=>"text-align:center; width:100px","rowspan"=>"2")),
							"so_ct"=>array("Số chứng từ",array("style"=>"text-align:center","colspan"=>"2")),
							"diengiai"=>array("Diễn giải",array("style"=>"text-align:center","rowspan"=>"2")),	
							"sotien"=>array("Số tiền",array("style"=>"text-align:center","colspan"=>"2")),											
					);
			
			$str_header_product = $this->Template->load_table_header($array_header_product);
			$array_header_product2 =  array(
							"1"=>array("",array("style"=>"text-align:center; width:100px")),
							"ct_thu"=>array("THU",array("style"=>"text-align:center; width:100px")),
							"ct_chi"=>array("CHI",array("style"=>"text-align:center;width:100px")),
							"diengiai"=>array("",array("style"=>"text-align:center; width:300px")),
							"sotien_thu"=>array("THU",array("style"=>"text-align:center; width:150px")),	
							"sotien_chi"=>array("CHI",array("style"=>"text-align:center; width:150px")),											
					);		
			$str_header_product .= $this->Template->load_table_row($array_header_product2,array("style"=>"background-color: #2f83b7;color:white"));			
	}	
	
	
	
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	 if($this->get_config("donvi_name") == "vutico")
	{
		$array_row_product=NULL;
		$array_row_product["ct_thu"] 				= array("Tổng Nợ đầu kỳ",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
		$array_row_product["sotien_thu"] 				= array(number_format($du_no_dauky),array("style"=>"text-align:center; color:green;font-weight:bold"));
		$str_row_product .= $this->Template->load_table_row($array_row_product);
	}
	if($array_thuchi != NULL || $array_thu != NULL)
	{
		if($this->get_config("donvi_name") == "vutico")
		{
			
			if($array_thu != NULL)
			{
				$tong_thu = 0;
				foreach($array_thu as $thu)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($thu["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($thu["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($thu['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($thu["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($thu['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($thu["desc"],array("style"=>"text-align:center;"));
					if($thu["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($thu["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($thu["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($thu["amount"]),array("style"=>"text-align:center;"));
					}
					$tong_thu += $thu["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng thu",array("style"=>"text-align:center;font-weight:bold","colspan" => "4"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_thu),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_chi != "")
			{	
				$tong_chi = 0;
				foreach($array_chi as $chi)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($chi["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($chi["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($chi['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($chi["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($chi['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($chi["desc"],array("style"=>"text-align:center;"));
					if($chi["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($chi["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($chi["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($chi["amount"]),array("style"=>"text-align:center;"));
					}
					$tong_chi += $chi["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng Chi",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_chi),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_thu_no_kd != "")
			{	
				$tong_thu_no_kd = 0;
				foreach($array_thu_no_kd as $thuno)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($thuno["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($thuno["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($thuno['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($thuno["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($thuno['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($thuno["desc"],array("style"=>"text-align:center;"));
					if($thuno["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($thuno["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($thuno["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($thuno["amount"]),array("style"=>"text-align:center;"));
					} $tong_thu_no_kd += $thuno["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng nợ phải thu kinh doanh",array("style"=>"text-align:center;font-weight:bold","colspan" => "4"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_thu_no_kd),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_thu_no != "")
			{	
				$tong_thu_no = 0;
				foreach($array_thu_no as $thuno)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($thuno["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($thuno["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($thuno['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($thuno["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($thuno['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($thuno["desc"],array("style"=>"text-align:center;"));
					if($thuno["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($thuno["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($thuno["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($thuno["amount"]),array("style"=>"text-align:center;"));
					} $tong_thu_no += $thuno["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng thu nợ",array("style"=>"text-align:center;font-weight:bold","colspan" => "4"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_thu_no),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_chi_no_kd != "")
			{	
				$tong_chi_no_kd = 0;
				foreach($array_chi_no_kd as $chino)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($chino["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($chino["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($chino['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($chino["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($chino['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($chino["desc"],array("style"=>"text-align:center;"));
					if($chino["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($chino["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($chino["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($chino["amount"]),array("style"=>"text-align:center;"));
					}$tong_chi_no_kd += $chino["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng nợ phải trả kinh doanh",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_chi_no_kd),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_chi_no != "")
			{	
				$tong_chi_no = 0;
				foreach($array_chi_no as $chino)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($chino["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($chino["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($chino['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($chino["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($chino['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($chino["desc"],array("style"=>"text-align:center;"));
					if($chino["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($chino["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($chino["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($chino["amount"]),array("style"=>"text-align:center;"));
					}$tong_chi_no += $chino["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng trả nợ kinh doanh",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_chi_no),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
				
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tồn cuối kỳ",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
				$array_row_product["sotien_thu"] 				= array(number_format(($tong_thu-$tong_chi)+($tong_thu_no_kd-$tong_thu_no)-($tong_chi_no_kd-$tong_chi_no)),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
			}
			if($array_thuchi != "")
			{	$tong_thuchi = 0;
				foreach($array_thuchi as $thuchi)
				{
					$array_row_product = NULL;
					$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
					if($thuchi["type"] == 0) { 
					$array_row_product["ct_thu"] 				= array($thuchi['num'],array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array("",array("style"=>"text-align:center;"));
					}
					if($thuchi["type"] == 1) { 
					$array_row_product["ct_thu"] 				= array("",array("style"=>"text-align:center;"));
					$array_row_product["ct_chi"] 				= array($thuchi['num'],array("style"=>"text-align:center;"));
					}
					$array_row_product["diengiai"] 			= array($thuchi["desc"],array("style"=>"text-align:center;"));
					if($thuchi["type"] == 0) {
					$array_row_product["sotien_thu"] 			= array(number_format($thuchi["amount"]),array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array("",array("style"=>"text-align:center;"));
					}
					if($thuchi["type"] == 1) {
					$array_row_product["sotien_thu"] 			= array("",array("style"=>"text-align:center;"));
					$array_row_product["sotien_chi"] 			= array(number_format($thuchi["amount"]),array("style"=>"text-align:center;"));
					}$tong_thuchi += $thuchi["amount"];
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
				$array_row_product=NULL;
				$array_row_product["ct_thu"] 				= array("Tổng cộng",array("style"=>"text-align:center;font-weight:bold","colspan" => "5"));
				$array_row_product["sotien_thu"] 				= array(number_format($tong_thuchi),array("style"=>"text-align:center; color:green;font-weight:bold"));
				$str_row_product .= $this->Template->load_table_row($array_row_product);
				
			}
		}else
		{
			
			if($this->get_config("donvi_name") == "gaskieutram")
			{
				foreach($array_thuchi as $thuchi)
				{
					$stt++;
					$array_row_product = NULL;
					$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
					$array_row_product["type"] 			= array($array_type[$thuchi["type"]],array("style"=>"text-align:center;"));
					$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["issued_date"] 	= array($issued_date,array("style"=>"text-align:center;"));
					$array_row_product["desc"] 				= array($thuchi["desc"].$profile,array("style"=>"text-align:left;"));
					$array_row_product["account_money_name"] 				= array($thuchi["account_money_name"].$profile,array("style"=>"text-align:center;"));
					$array_row_product["amount"] 			= array( number_format($thuchi["amount"])." ".$thuchi["unit"],array("style"=>"text-align:center;","class"=>"amount"));	
					
					$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"nhap","params"=>array($thuchi["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
					
					$link_xoa 				= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($thuchi["id"])));
					$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
					
					$array_row_product ["sua"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
					
				
					//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
					//cong don vao chuoi $str_row_product
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
			}else
			{
				foreach($array_thuchi as $thuchi)
				{
					if($thuchi["type"] == 0) $tong_thu += $thuchi["amount"];
					else $tong_chi += $thuchi["amount"];
					
					$stt++;
					$array_row_product = NULL;
					$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
					$array_row_product["type"] 			= array($array_type[$thuchi["type"]],array("style"=>"text-align:center;"));
					
					$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$array_row_product["issued_date"] 	= array($issued_date,array("style"=>"text-align:center;"));
					
					if(isset($thuchi["post_number"])) $array_row_product["post_number"] 	= array($thuchi["post_number"],array("style"=>"text-align:center;"));
					
					$profile = "";
					if(isset($thuchi["profile"]))
					{
						if($thuchi["profile"] != "" || $thuchi["profile"] != NULL)
						{
							$link_file = $this->Company->file_url.$this->Company->upload_url;
							$profile = $link_file.$thuchi["profile"];
							$profile	= "<br>---------------------<br>".$this->Template->load_link("download","Download",$profile);
						}
					}
						
					$array_row_product["name"] 				= array($thuchi["name"].$profile,array("style"=>"text-align:center;"));
					$array_row_product["project_name"] 		= array($thuchi["project_name"],array("style"=>"text-align:center;"));
					$array_row_product["customer_name"] 	= array($thuchi["customer_name"],array("style"=>"text-align:center;"));
					$array_row_product["price"] 		= array(number_format($thuchi["price"]),array("style"=>"text-align:center;"));
					$array_row_product["quantity"] 	= array($thuchi["quantity"],array("style"=>"text-align:center;"));
					$array_row_product["amount"] 			= array( number_format($thuchi["amount"])." ".$thuchi["unit"],array("style"=>"text-align:center;","class"=>"amount"));	
					
					
					
					$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"nhap","params"=>array($thuchi["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
					
					$link_xoa 				= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($thuchi["id"])));
					$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
					
					$array_row_product ["sua"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
					
				
					//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
					//cong don vao chuoi $str_row_product
					$str_row_product .= $this->Template->load_table_row($array_row_product);
				}
			}
		}
	}else
	{
		$array_row_product = NULL;
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"12"));	
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	if($this->get_config("thuchi") == "0")
	{
		if($tong_chi < $tong_thu )$lai = $tong_thu - $tong_chi;
		if($tong_thu < $tong_chi )$lo = $tong_chi - $tong_thu;
		$lai = number_format($lai);
		$lo = number_format($lo);
		$tong_thu = number_format($tong_thu);
		$tong_chi = number_format($tong_chi);
		//thêm vào dòng tổng số dòng
		$array_row_product = NULL;
		$array_row_product["tongchi"] 	= array("Tổng chi: $tong_chi",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"3","id"=>"tongchi"));
		$array_row_product["tongthu"] = array("Tổng thu: $tong_thu",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"3","id"=>"thu"));
		$array_row_product["lai"] 	= array("Lãi: $lai",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"2","id"=>"lai"));
		$array_row_product["lo"] 	= array("Lỗ: $lo",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"2","id"=>"lo"));
		
		$str_row_product .= $this->Template->load_table_row($array_row_product);		
	}
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_thuchi"));
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
	document.getElementById('loai').value = "<?php echo $type; ?>";
</script>

 <script>
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_du_an as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["name"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#project_name" ).bind( "keydown", function( event )
	 {
		if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) 
		{
			event.preventDefault();
		}
	 }
	)
	.autocomplete({
		minLength: 0,
		source: function( request, response ) 
		{
			// delegate back to autocomplete, but extract the last term
			response( $.ui.autocomplete.filter(array_khachhang, extractLast( request.term )) );
		},
	
		//    source:projects,    
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui )
		{
			
			/*var terms = split( this.value );
			// remove the current input
			
			terms.pop();
			
			// add the selected item
			terms.push( ui.item.label );
		
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( "" );
	
			alert(terms);*/
			
			var selected_value = ui.item.value; 
			$('#id_project').val(selected_value);
			this.value = ui.item.label;
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#project_name").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#project_name").trigger(e);
	});

}); //end function
 
 
     
</script>
<script>
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_khachhang as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["code"]." ".$value["fullname"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#customer_name" ).bind( "keydown", function( event )
	 {
		if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) 
		{
			event.preventDefault();
		}
	 }
	)
	.autocomplete({
		minLength: 0,
		source: function( request, response ) 
		{
			// delegate back to autocomplete, but extract the last term
			response( $.ui.autocomplete.filter(array_khachhang, extractLast( request.term )) );
		},
	
		//    source:projects,    
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui )
		{
			
			/*var terms = split( this.value );
			// remove the current input
			
			terms.pop();
			
			// add the selected item
			terms.push( ui.item.label );
		
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( "" );
	
			alert(terms);*/
			
			var selected_value = ui.item.value; 
			$('#id_customer').val(selected_value);
			this.value = ui.item.label;
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#customer_name").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#customer_name").trigger(e);
	});

}); //end function

document.getElementById('tim').onkeydown = function(event) {
    if (event.keyCode == 13) {
       document.getElementById("form_timkiem").submit();
    }
}
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_hopdong as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["title"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#post_title" ).bind( "keydown", function( event )
	 {
		if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) 
		{
			event.preventDefault();
		}
	 }
	)
	.autocomplete({
		minLength: 0,
		source: function( request, response ) 
		{
			// delegate back to autocomplete, but extract the last term
			response( $.ui.autocomplete.filter(array_khachhang, extractLast( request.term )) );
		},
	
		//    source:projects,    
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui )
		{
			
			/*var terms = split( this.value );
			// remove the current input
			
			terms.pop();
			
			// add the selected item
			terms.push( ui.item.label );
		
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( "" );
	
			alert(terms);*/
			
			var selected_value = ui.item.value; 
			$('#id_post').val(selected_value);
			this.value = ui.item.label;
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#post_title").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#post_title").trigger(e);
	});

}); //end function
function submit_form()
{
	document.getElementById("form_timkiem").submit();
}
 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
 </script> 