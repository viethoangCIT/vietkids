<?php 
	$type = $array_title["type"];
	$type_account = $array_title["type_account"];
	
	$array_header_thuchi =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
								"doituong"=>array("Khách Hàng",array("style"=>"text-align:center")),
								"so_chungtu"=>array("Số chứng từ",array("style"=>"text-align:center")),
								"ngay"=>array("Ngày Chứng từ",array("style"=>"text-align:center")),
								"diengiai"=>array("Diễn giải",array("style"=>"text-align:center")),
								"tongso"=>array("Tổng số",array("style"=>"text-align:center")),
								"tuychon"=>array("Tùy chọn",array("style"=>"text-align:center;width:100px")),
					);
					
	$str_header_thuchi = $this->Template->load_table_header($array_header_thuchi);				
					
	$str_row_thuchi = "";
	$stt = 0;
	$id_created_user = "";	
	$id = "";	
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	
	if($array_list_thuchi != NULL)
	{
		foreach($array_list_thuchi as $thuchi)
		{
			$id_created_user = $thuchi["id_created_user"];
			$id = $thuchi["id"];
			
			if($thuchi["type"] == 0) $tong_thu += $thuchi["amount"];
			else $tong_chi += $thuchi["amount"];
			
			$type = $thuchi["type"];
			$group = $thuchi["group"];
			
			$stt++;
			$array_row_thuchi = NULL;
			
			$array_row_thuchi["stt"]=array($stt,array("style"=>"text-align:center;"));
			$array_row_thuchi["username_receive"] 			= array($thuchi["customer_name"],array("style"=>"text-align:center;"));
			$array_row_thuchi["num"] 			= array($thuchi["num"],array("style"=>"text-align:center;"));
			$array_row_thuchi["issued_date"] 			= array($thuchi["issued_date"],array("style"=>"text-align:center;"));
			$array_row_thuchi["desc"] 			= array($thuchi["desc"],array("style"=>"text-align:center;"));
			$array_row_thuchi["amount"] 		= array(number_format($thuchi["amount"]),array("style"=>"text-align:center;"));
			
			$link_sua = "";
			$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"add","params"=>array($thuchi["id"])));
			$link_sua .= "?type=$type&type_account=$type_account";
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			
			$link_xoa = "";
			$link_xoa 				= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($thuchi["id"])));
			$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			
			$array_row_thuchi ["tuychon"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
			
			$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
			
				
		}
	}
	else
	{
		$array_row_thuchi["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"7"));	
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);	
	}
	if($this->get_config("thuchi_tong") == "yes")
	{
		if($tong_chi < $tong_thu )$lai = $tong_thu - $tong_chi;
		if($tong_thu < $tong_chi )$lo = $tong_chi - $tong_thu;
		$lai = number_format($lai);
		$lo = number_format($lo);
		$tong_thu = number_format($tong_thu);
		$tong_chi = number_format($tong_chi);
		//thêm vào dòng tổng số dòng
		$array_row_thuchi = NULL;
		$array_row_thuchi["tongchi"] 	= array("Tổng chi: $tong_chi",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"2","id"=>"tongchi"));
		$array_row_thuchi["tongthu"] = array("Tổng thu: $tong_thu",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"2","id"=>"thu"));
		$array_row_thuchi["lai"] 	= array("Lãi: $lai",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"2","id"=>"lai"));
		$array_row_thuchi["lo"] 	= array("Lỗ: $lo",array("style"=>"text-align:center;color:yellow;font-weight:bold;","colspan"=>"1","id"=>"lo"));
		
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);		
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_thuchi =  $this->Template->load_table($str_header_thuchi.$str_row_thuchi);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_thuchi;

?>