<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Sổ quỹ tiền mặt";
	$function_title .= "<br><i style='font-size: 15px; text-transform: initial;'>Từ ngày: $tungay  Đến ngày: $denngay</i>";
	
	echo $this->Template->load_function_header($function_title);
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = $this->Template->load_label(" Người nhập chứng từ: ","","search_list");
    $str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_user","style"=>"width:200px"),$array_user,$id_user);
	
	$str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"revenue","action"=>"soquy_tienmat"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_thuchi =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"date"=>array("Ngày",array("style"=>"text-align:center; width:10%")),
							"num"=>array("Số CT",array("style"=>"text-align:center; width:10%")),	
							"nhap_xuat"=>array("Phiếu nhập/xuất",array("style"=>"text-align:center; width:12%")),
							"user"=>array("Người nhập chứng từ",array("style"=>"text-align:center; width:15%")),
							"desc"=>array("Diễn giải",array("style"=>"text-align:center; width:25%")),
							"thu"=>array("Thu (VNĐ)",array("style"=>"text-align:center")),
							"chi"=>array("Chi (VNĐ)",array("style"=>"text-align:center")),
							"ton"=>array("Tồn (VNĐ)",array("style"=>"text-align:center")),
					);
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_thuchi = $this->Template->load_table_header($array_header_thuchi);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table thuchi
	$str_row_thuchi = "";
	$stt = 0;
	$sotien_thu = 0;
	$sotien_chi = 0;
	$sotien_ton = 0;
	$tongtien_thu = 0;
	$tongtien_chi = 0;
	$tongtien_ton = 0;
	if($array_thuchi != NULL)
	{
		$array_row_thuchi = NULL;
		$array_row_thuchi["stt"] 	= array("<b>Tồn đầu kỳ:</b> ",array("style"=>"text-align:center; color:#0db400","colspan"=>"8"));
		$array_row_thuchi["ton"] 	= array(number_format($ton_dau_ky),array("style"=>"text-align:right; font-weight:bold; color:red"));
		
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
		$sotien_ton = $ton_dau_ky;
		
		foreach($array_thuchi as $thuchi)
		{
			$stt++;
			$array_row_thuchi = NULL;
			$array_row_thuchi["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			
			$date = date("d-m-Y",strtotime($thuchi["issued_date"]));
			if($date == "01-01-1970") $date = "";
			$array_row_thuchi["date"] 			= array($date,array("style"=>"text-align:center;"));
			
			$array_row_thuchi["num"] 	= array($thuchi["num"],array("style"=>"text-align:left;"));
				
			$array_row_thuchi["nhap_xuat"] 				= array("",array("style"=>"text-align:left;"));
			
			$array_row_thuchi["user"] 	= array($thuchi["username"],array("style"=>"text-align:left;"));
			
			$array_row_thuchi["desc"] 		= array($thuchi["desc"],array("style"=>"text-align:left;"));
			
			$type = $thuchi["type"];
			
			if($type == "0")
			{
				$sotien_thu = $thuchi["amount"];
				$sotien_chi = 0;
				$tongtien_thu += $sotien_thu;
				$sotien_ton = $sotien_thu + $sotien_ton;
			}else
			{
				$sotien_thu = 0;
				$sotien_chi = $thuchi["amount"];
				$tongtien_chi += $sotien_chi;
				$sotien_ton = $sotien_ton - $sotien_chi;
			}
			
			//$sotien_conlai = $sotien_ton;
			
			$array_row_thuchi["thu"] 	= array(number_format($sotien_thu),array("style"=>"text-align:right;"));
			$array_row_thuchi["chi"] 	= array(number_format($sotien_chi),array("style"=>"text-align:right;"));
			$array_row_thuchi["ton"] 	= array(number_format($sotien_ton),array("style"=>"text-align:right;"));
			
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_thuchi
			$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
		}
		$array_row_thuchi = NULL;
		$array_row_thuchi["stt"] 	= array("",array("colspan"=>"6"));
		$array_row_thuchi["thu"] 	= array(number_format($tongtien_thu),array("style"=>"text-align:right; font-weight:bold; color:red"));
		$array_row_thuchi["chi"] 	= array(number_format($tongtien_chi),array("style"=>"text-align:right; font-weight:bold; color:red"));
		
		//$tongtien_ton = $tongtien_thu - $tongtien_chi;
		$array_row_thuchi["ton"] 	= array(number_format($sotien_ton),array("style"=>"text-align:right; font-weight:bold; color:red"));
		
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
	}else
	{
		$array_row_thuchi["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"9"));	
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);	
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_thuchi =  $this->Template->load_table($str_header_thuchi.$str_row_thuchi,array("id"=>"table_thuchi"));
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_thuchi;
?>
<script type="text/javascript">
    $( function() {
        $( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    $( function() {
        $( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
	
</script>