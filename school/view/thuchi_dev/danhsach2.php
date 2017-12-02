<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Thu Chi";
	if((isset($_GET["type"])) && ($_GET["type"] == "0"))$function_title = "BẢNG KÊ CHI TIẾT CHỨNG TỪ THU";
	if((isset($_GET["type"])) && ($_GET["type"] == "1"))$function_title = "BẢNG KÊ CHI TIẾT CHỨNG TỪ CHI";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = "Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"xem"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array(
							"ngay"=>array("Ngày",array("style"=>"text-align:center")),
							"so_ct"=>array("Số chứng từ",array("style"=>"text-align:center")),
							"hoten"=>array("Họ tên",array("style"=>"text-align:center")),
							"diengiai"=>array("Diễn giải",array("style"=>"text-align:center")),
							"sotien"=>array("Số tiền",array("style"=>"text-align:center")),
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
			$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
			if($issued_date == "01-01-1970") $issued_date = "";
			$array_row_product["ngay"] 	= array($issued_date,array("style"=>"text-align:center;"));
			$array_row_product["so_ct"] 			= array("297",array("style"=>"text-align:center;"));
			$array_row_product["hoten"] 				= array($thuchi["username"],array("style"=>"text-align:center;"));
			$array_row_product["desc"] 			= array($thuchi["desc"],array("style"=>"text-align:center;","class"=>"amount"));	
			$array_row_product["amount"] 		= array(number_format($thuchi["amount"]),array("style"=>"text-align:center;"));
			
			
			
			
			$link_sua = "";
			/*if(($this->User->ThuChi->allow_edit($id_created_user,$id)) || ($id_created_user == $this->User->id) || ($this->User->type == 1))
			{
				$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"nhap","params"=>array($thuchi["id"])));
				$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			}
			
			$link_xoa = "";
			if(($this->User->ThuChi->allow_delete($id_created_user,$id)) || ($id_created_user == $this->User->id) || ($this->User->type == 1))
			{
				$link_xoa 				= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($thuchi["id"])));
				$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			}*/
				
			//$array_row_product ["tuychon"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
		
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
			
			
			
		}
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));	
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
