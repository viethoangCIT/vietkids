<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh sách nhóm Khách Hàng";
	
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
		
	$str_timkiem = "Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	$link_danhsach = $this->Html->link(array("controller"=>"customer","action"=>"list_group"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"name"=>array("Tên nhóm",array("style"=>"text-align:center; width:20%")),
							"desc"=>array("Mô tả",array("style"=>"text-align:left;")),
							"edit"=>array("Sửa",array("style"=>"text-align:center; width:10%")),
							"del"=>array("Xóa",array("style"=>"text-align:center; width:10%"))												
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	if($array_khachhang)
	{
		foreach($array_khachhang as $khachhang)
		{
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 	 = array($stt,array("style"=>"text-align:center;"));
			$array_row_product["name"] 	= array($khachhang["name"],array("style"=>"text-align:center;"));	
			$array_row_product["desc"] 	= array($khachhang["desc"]);
			
			//lay liên kết để sửa
			$link_sua 	= $this->Html->link(array("controller"=>"customer","action"=>"add_group","params"=>array($khachhang["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			$array_row_product ["edit"]  		= array($link_sua,array("style"=>"text-align:center;"));
			
			//lay liên kết để xóa
			$link_xoa 				= $this->Html->link(array("controller"=>"customer","action"=>"del_group","params"=>array($khachhang["id"])));
			$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			$array_row_product ["del"]	= array($link_xoa,array("style"=>"text-align:center;","onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
		
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}	
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"5"));	
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	echo $str_table_product;
?>

