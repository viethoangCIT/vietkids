<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Thu Chi";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = "Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
	
	$str_timkiem .= " Loại: ";
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"loai","id"=>"loai","style"=>"width:80px"),$array_type);
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"xem"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"type"=>array("Loại",array("style"=>"text-align:center")),
							"accounts"=>array("Tài Khoản Có",array("style"=>"text-align:center")),
							"debit_account"=>array("Tài Khoản Nợ",array("style"=>"text-align:center")),
							"username"=>array("Tên Người Thu<br>(Tên Người Chi)",array("style"=>"text-align:center")),
							"name"=>array("Tên Người Nộp<br>(Tên Người Nhận)",array("style"=>"text-align:center")),
							"customer_name"=>array("Tên Khách Hàng",array("style"=>"text-align:center")),
							"project_name"=>array("Tên Dự Án",array("style"=>"text-align:center")),
							"issued_date"=>array("Ngày",array("style"=>"text-align:center")),	
							"amount"=>array("Số Tiền",array("style"=>"text-align:center")),
							"unit"=>array("Đơn Vị",array("style"=>"text-align:center")),				
							"desc"=>array("Mô tả",array("style"=>"text-align:center")),
							"tuychon"=>array("Tùy chọn",array("style"=>"text-align:center")),
				);
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	
	$id_created_user = "";	
	$id = "";	
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	
	if($array_thuchi != NULL)
	{
		foreach($array_thuchi as $thuchi)
		{
			$id_created_user = $thuchi["id_created_user"];
			$id = $thuchi["id"];
			
			if($thuchi["type"] == 0) $tong_thu += $thuchi["amount"];
			else $tong_chi += $thuchi["amount"];
			
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_product["type"] 			= array($array_type[$thuchi["type"]],array("style"=>"text-align:center;"));
			$array_row_product["accounts"] 			= array($thuchi["accounts"],array("style"=>"text-align:center;"));
			$array_row_product["debit_account"] 			= array($thuchi["debit_account"],array("style"=>"text-align:center;"));
			
			
			$array_row_product["username"] 				= array($thuchi["username"],array("style"=>"text-align:center;"));
			$array_row_product["name"] 				= array($thuchi["name"],array("style"=>"text-align:center;"));
			$array_row_product["customer_name"] 	= array($thuchi["customer_name"],array("style"=>"text-align:center;"));
			$array_row_product["project_name"] 		= array($thuchi["project_name"],array("style"=>"text-align:center;"));
			
			
			
			$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
			if($issued_date == "01-01-1970") $issued_date = "";
			$array_row_product["issued_date"] 	= array($issued_date,array("style"=>"text-align:center;"));
			if($thuchi["price"] == "") $thuchi["price"] = 0;
			$array_row_product["amount"] 		= array(number_format($thuchi["amount"]),array("style"=>"text-align:center;"));
			$array_row_product["unit"] 	= array($thuchi["unit"],array("style"=>"text-align:center;"));
			
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
			
			$array_row_product["desc"] 			= array($thuchi["desc"].$profile,array("style"=>"text-align:center;","class"=>"amount"));	
			
			$link_sua = "";
			if(($this->User->ThuChi->allow_edit($id_created_user,$id)) || ($id_created_user == $this->User->id) || ($this->User->type == 1))
			{
				$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"nhap","params"=>array($thuchi["id"])));
				$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			}
			
			$link_xoa = "";
			if(($this->User->ThuChi->allow_delete($id_created_user,$id)) || ($id_created_user == $this->User->id) || ($this->User->type == 1))
			{
				$link_xoa 				= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($thuchi["id"])));
				$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			}
				
			$array_row_product ["tuychon"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
		
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
			
			
			
		}
	}else
	{
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
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	
	document.getElementById('loai').value = "<?php echo $type; ?>";
</script>
