<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Biểu Phí";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
		
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	
	$link_danhsach = $this->Html->link(array("controller"=>"fee","action"=>"index"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_fee =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"name"=>array("Tên Biểu Phí",array("style"=>"text-align:center; width:15%")),
							"from"=>array("Từ Ngày",array("style"=>"text-align:center; width:10%")),
							"to"=>array("Đến Ngày",array("style"=>"text-align:center; width:10%")),
							"year"=>array("Năm",array("style"=>"text-align:center; width:10%")),
							"service"=>array("Danh mục",array("style"=>"text-align:center; width:20%")),
							"total_price"=>array("Tổng cộng",array("style"=>"text-align:center; width:10%")),
							"tuychon"=>array("Tùy chọn",array("style"=>"text-align:center; width:7%")),
							"chitiet"=>array("Chi tiết",array("style"=>"text-align:center; width:10%"))
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_fee = $this->Template->load_table_header($array_header_fee);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table fee
	$str_row_fee = "";
	$stt = 0;
	
	if($array_bieuphi)
	{
		foreach($array_bieuphi as $bieuphi)
		{
			$stt++;
			$array_row_fee = NULL;
			$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_fee["name"] 		= array($bieuphi["name"],array("style"=>"text-align:left;"));	
			
			$from = date("d-m-Y",strtotime($bieuphi["from"]));
			if($from == "01-01-1970") $from = "";
			
			$to = date("d-m-Y",strtotime($bieuphi["to"]));
			if($to == "01-01-1970") $to = "";
			
			$array_row_fee["from"]  	= array($from,array("style"=>"text-align:center;"));
			$array_row_fee["to"]  	= array($to,array("style"=>"text-align:center;"));
			
			$year = $bieuphi["year"];
			if($year == "0") $year = "";
			
			$array_row_fee["year"]  	= array($year,array("style"=>"text-align:center;"));
			
			$tmp_str_service = $bieuphi["str_service"];
			if($tmp_str_service != "") $array_service_bieuphi_lop = explode(chr(9),$tmp_str_service);
			$str_service = "";
			if($array_service_bieuphi_lop != NULL)
			{
				$str_service = "<table style='width: 100%;'>";
				$array_tmp_str_service = NULL;
				for($k=0;$k<(count($array_service_bieuphi_lop) - 1);$k++)
				{
					$array_tmp_str_service = explode(chr(8),$array_service_bieuphi_lop[$k]);
					if(isset($array_tmp_str_service[0])) $ten_dichvu = $array_tmp_str_service[0];
					if(isset($array_tmp_str_service[1])) $gia_dichvu = $array_tmp_str_service[1];
					$str_service .= "<tr><td>$ten_dichvu</td> <td style='text-align:right'>: ".number_format($gia_dichvu)."</td>";
				}
				
				$str_service .= "</table>";
			}
			
			$array_row_fee["service"]  	= array($str_service,array("style"=>"text-align:left;"));
			$array_row_fee["total_price"]  	= array(number_format($bieuphi["total_price"]),array("style"=>"text-align:center;color: red; font-weight: bold"));
			
			$link_sua 	= $this->Html->link(array("controller"=>"fee","action"=>"add","params"=>array($bieuphi["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			
			//lay liên kết để xóa
			$link_xoa = $this->Html->link(array("controller"=>"fee","action"=>"del","params"=>array($bieuphi["id"])));
			$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));	
			
			$array_row_fee ["tuychon"]	= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));

			$link_chitiet	= $this->Template->load_link("edit","Chi tiết","/fee/detail/".$bieuphi["id"].".html");
			$array_row_fee ["chitiet"]	= array($link_chitiet,array("style"=>"text-align:center;"));
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			
			//cong don vao chuoi $str_row_fee
			$str_row_fee .= $this->Template->load_table_row($array_row_fee);
		}	
	}else
	{
		$array_row_fee["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"8"));	
		$str_row_fee .= $this->Template->load_table_row($array_row_fee);	
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_fee =  $this->Template->load_table($str_header_fee.$str_row_fee);


	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_fee;
?>

</script>
