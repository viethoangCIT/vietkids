<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Áp Biểu Phí Cho Lớp";
			
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	if($array_lop_hoc != NULL)
	{
		$classroom_name = $array_lop_hoc[0]["name"];
		$from = date("d-m-Y",strtotime($array_lop_hoc[0]["from"]));
		if($from == "01-01-1970") $from = "";
		$to = date("d-m-Y",strtotime($array_lop_hoc[0]["to"]));
		if($to == "01-01-1970") $to = "";
	}
	
	$str_form_fee = $this->Template->load_form_row(array("title"=>"Lớp","input"=>$classroom_name));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Thời gian lớp","input"=>"$from - $to"));
	
	$id_fee = "";
	if(isset($_GET["id_fee"])) $id_fee = $_GET["id_fee"];
	else if($array_bieuphi_lop) $id_fee = $array_bieuphi_lop[0]["id_fee"];
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Biểu phí","input"=>$this->Template->load_selectbox(array("name"=>"id_fee","style"=>"width:30%","onchange"=>"thaydoi_bieuphi()"),$array_bieuphi,$id_fee)));
	
	
	//Lấy danh sách dịch vụ
	//*****************************************
	//buoc 1: tao 1 dòng đầu tiên của table
	$str_row_bieuphi = "";
	if($array_fee_detail)
	{
		$array_header_bieuphi =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:5%")),
								"name"=>array("Dịch vụ",array("style"=>"text-align:center")),
								"price"=>array("Giá",array("style"=>"text-align:center; width:15%")),
						);
				
		//buoc 2: dung hàm load_table_header de lay template table header		
		$str_header_bieuphi = $this->Template->load_table_header($array_header_bieuphi);
	
		
		//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
		//load row table fee
		$str_row_bieuphi = "";
		$stt = 0;
	
		foreach($array_fee_detail as $bieuphi)
		{
			$stt++;
			$array_row_bieuphi = NULL;
			$array_row_bieuphi["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_bieuphi["name"] 		= array($bieuphi["service_name"],array("style"=>"text-align:left;"));	
			$array_row_bieuphi["price"]  	= array(number_format($bieuphi["price"]),array("style"=>"text-align:center"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			$total_price += $bieuphi["price"];
			
			//cong don vao chuoi $str_row_fee
			$str_row_bieuphi .= $this->Template->load_table_row($array_row_bieuphi);
		}
		
		$array_row_bieuphi = NULL;
		$array_row_bieuphi["stt"]  	= array("Tổng cộng",array("style"=>"text-align:center","colspan"=>"2"));
		$array_row_bieuphi["price"]  	= array(number_format($total_price),array("style"=>"text-align:center; color: red; font-weight: bold"));	
		$str_row_bieuphi .= $this->Template->load_table_row($array_row_bieuphi);
	
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_bieuphi =  $this->Template->load_table($str_header_bieuphi.$str_row_bieuphi);
		
	//END Lấy danh sách dịch vụ
	//*****************************************
	}
	
	//******************************************************************************************
	//lấy danh sách biểu phí đã áp của lớp
	if($array_bieuphi_lop)
	{
		$array_header_fee =  array("stt"=>array("Stt",array("style"=>"text-align:center;")),
								"month_year"=>array("Tháng/ Năm",array("style"=>"text-align:center;")),
								"num_day"=>array("Số ngày dự kiến",array("style"=>"text-align:center;")),
								"str_service"=>array("Dịch vụ",array("style"=>"text-align:center; width:30%")),
								"edit"=>array("Sửa",array("style"=>"text-align:center; width:7%")),
						);
				
		//buoc 2: dung hàm load_table_header de lay template table header		
		$str_header_fee = $this->Template->load_table_header($array_header_fee);
	
		
		//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
		//load row table fee
		$str_row_fee = "";
		$stt = 0;
	
		foreach($array_bieuphi_lop as $bieuphi)
		{
			$stt++;
			$array_row_fee = NULL;
			$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_fee["month_year"] = array(date("m-Y",strtotime($bieuphi["month_year"])),array("style"=>"text-align:center;"));	
			$array_row_fee["num_day"]  	= array($bieuphi["num_day"],array("style"=>"text-align:center"));
			
			$tmp_str_service = $bieuphi["str_service"];
			if($tmp_str_service != "") $array_service_bieuphi_lop = explode(chr(9),$tmp_str_service);
			$str_service = "";
			$tong_gia = 0;
			if($array_service_bieuphi_lop != NULL)
			{
				$str_service = "<table style='width: 100%;'>";
				$array_tmp_str_service = NULL;
				for($k=0;$k<(count($array_service_bieuphi_lop) - 1);$k++)
				{
					$array_tmp_str_service = explode(chr(8),$array_service_bieuphi_lop[$k]);
					if(isset($array_tmp_str_service[0])) $ten_dichvu = $array_tmp_str_service[0];
					if(isset($array_tmp_str_service[1])) $gia_dichvu = $array_tmp_str_service[1];
					$tong_gia += $gia_dichvu;
					$str_service .= "<tr><td>$ten_dichvu</td> <td style='text-align:right'>: ".number_format($gia_dichvu)."</td>";
				}
				
				$str_service .= "<tr><td><b style='color:blue'>Tổng cộng</b></td><td style='text-align:right; color:blue'><b>".number_format($tong_gia)."</b></td></tr>";
				$str_service .= "</table>";
			}
			
			$array_row_fee["str_service"]  	= array($str_service,array("style"=>"text-align:left"));
			
			$link_sua	= $this->Html->link(array("controller"=>"fee","action"=>"arrange_class_edit","params"=>array($bieuphi["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
			
			$array_row_fee["edit"]  = array($link_sua,array("style"=>"text-align:center"));
			
			//cong don vao chuoi $str_row_fee
			$str_row_fee .= $this->Template->load_table_row($array_row_fee);
		}
		
		//buoc 5: dung lam load_table de dữ liệu vào table
		$str_table_fee =  $this->Template->load_table($str_header_fee.$str_row_fee);
	}
	
	//*****************************************************************************************
	//END lấy danh sách biểu phí đã áp của lớp 
	
	if($array_fee_detail)
	{
		$str_form_fee .= $this->Template->load_form_row(array("title"=>"Danh mục dịch vụ","input"=>$str_table_bieuphi));
		$str_form_fee .= $this->Template->load_hidden(array("name"=>"trangthai","value"=>"0","id"=>"trangthai"));
		$str_form_fee .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"button","onclick"=>"ap_bieuphi()"),"Lưu")));
	}
	
	if($array_bieuphi_lop) $str_form_fee .= $this->Template->load_form_row(array("title"=>"Danh mục biểu phí","input"=>$str_table_fee));
	
	$str_form_fee = $this->Template->load_form(array("method"=>"GET","action"=>"/fee/arrange_class/$id_classroom.html","id"=>"form_bieuphi"),$str_form_fee);
	
	echo $str_form_fee;
	
?>
<script>

function ap_bieuphi()
{
	if (confirm("Bạn muốn thay đổi biểu phí cho lớp này !!") == true) {
        document.getElementById("trangthai").value = "1";	
		document.getElementById("form_bieuphi").submit();
    }
	return false;
}

function thaydoi_bieuphi()
{
	document.getElementById("form_bieuphi").submit();	
}


</script>
