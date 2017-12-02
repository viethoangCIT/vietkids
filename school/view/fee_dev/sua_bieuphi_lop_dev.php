<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Chỉnh sửa Biểu Phí";
			
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	if($array_bieuphi_lop_chitiet)
	{
		$id_fee_classroom = $array_bieuphi_lop_chitiet[0]["id_fee_classroom"];
		$classroom_name = $array_bieuphi_lop_chitiet[0]["classroom_name"];
		$month_year = date("m-Y",strtotime($array_bieuphi_lop_chitiet[0]["month_year"]));	
		$num_day = $array_bieuphi_lop_chitiet[0]["num_day"];	
	}
	
	$str_form_fee = $this->Template->load_form_row(array("title"=>"Lớp","input"=>$classroom_name));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Tháng/ Năm","input"=>$month_year));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Số ngày dự kiến","input"=>$this->Template->load_textbox(array("name"=>"data[fee][num_day]","value"=>$num_day,"style"=>"width:10%"))));
	
	//**************************************************************************************
	//lấy danh sách dịch vụ
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_fee =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:5%")),
							"name"=>array("Dịch vụ",array("style"=>"text-align:center;")),
							"price"=>array("Giá",array("style"=>"text-align:center; width:20%")),
							"select"=>array("Áp dụng",array("style"=>"text-align:center; width:10%"))
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_fee = $this->Template->load_table_header($array_header_fee);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table fee
	$str_row_fee = "";
	$stt = 0;
	
	foreach($array_bieuphi_lop_chitiet as $bieuphi_lop_chitiet)
	{
		$price = number_format($bieuphi_lop_chitiet["price"]);
		//$id_service = $bieuphi_lop_chitiet["id_service"];
		
		//$str_checked = "";
		//$id_user = ",".$user_view['id'].",";
		
		//if(strpos($list_id_service, $id_service) !== false) $str_checked = "checked";
		
		$str_form_gia = $this->Template->load_textbox(array("name"=>"data[fee][$stt][price]","value"=>$price,"style"=>"width:80%","onkeyup"=>"format_textbox_to_currency(this)"));
		$str_form_check = "<input type='checkbox' name='data[fee][$stt][id_service]' checked value='".$bieuphi_lop_chitiet["id_service"]."'>";
		$str_form_id .= $this->Template->load_hidden(array("name"=>"data[fee][$stt][id]","value"=>$bieuphi_lop_chitiet["id"]));
		$str_form_name .= $this->Template->load_hidden(array("name"=>"data[fee][$stt][service_name]","value"=>$bieuphi_lop_chitiet["service_name"]));		
					
		$stt++;
		$array_row_fee = NULL;
		$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
		$array_row_fee["name"] 		= array($bieuphi_lop_chitiet["service_name"].$str_form_name.$str_form_id,array("style"=>"text-align:left;"));	
		$array_row_fee["price"]  	= array($str_form_gia,array("style"=>"text-align:center;"));
		$array_row_fee["select"]  	= array($str_form_check,array("style"=>"text-align:center;"));
		
		//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
		
		//cong don vao chuoi $str_row_fee
		$str_row_fee .= $this->Template->load_table_row($array_row_fee);
	}
	
	$str_classroom_service = "";
	
	//lấy dánh sách dịch vụ
	foreach($array_dichvu as $dichvu)
	{
		$gia = number_format($dichvu["price"]);
		
		$str_form_gia_dichvu = $this->Template->load_textbox(array("name"=>"data[fee][$stt][price]","value"=>$gia,"style"=>"width:80%","onkeyup"=>"format_textbox_to_currency(this)"));
		$str_form_check_dichvu = "<input type='checkbox' name='data[fee][$stt][id_service]' value='".$dichvu["id"]."'>";
		$str_form_service_name .= $this->Template->load_hidden(array("name"=>"data[fee][$stt][service_name]","value"=>$dichvu["name"]));
					
		$stt++;
		$array_row_fee = NULL;
		$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
		$array_row_fee["name"] 		= array($dichvu["name"].$str_form_service_name,array("style"=>"text-align:left;"));	
		$array_row_fee["price"]  	= array($str_form_gia_dichvu,array("style"=>"text-align:center;"));
		$array_row_fee["select"]  	= array($str_form_check_dichvu,array("style"=>"text-align:center;"));
		
		//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
		
		//cong don vao chuoi $str_row_fee
		$str_classroom_service .= $this->Template->load_table_row($array_row_fee);
	}	
	
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_fee =  $this->Template->load_table($str_header_fee.$str_row_fee.$str_classroom_service);


	
	//**************************************************************************************
	//end lấy danh sách dịch vụ
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Danh mục","input"=>$str_table_fee));
		
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit"),"Lưu")));

	$str_form_fee = $this->Template->load_form(array("method"=>"POST","action"=>"/fee/arrange_class_edit/$id_fee_classroom.html"),$str_form_fee);
	
	echo $str_form_fee;
	
?>
<script>
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function format_textbox_to_currency(textbox_obj)
{
	sotien =  textbox_obj.value ;
	sotien = sotien.replace(/,/g , "");
	if (sotien == null) sotien=0;
	if (sotien == '') sotien=0;
	if (sotien == 'NaN') sotien=0;
	sotien = parseFloat(sotien);
	textbox_obj.value = numberWithCommas(parseFloat(sotien));
}
</script>