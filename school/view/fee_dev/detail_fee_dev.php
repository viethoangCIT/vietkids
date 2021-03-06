<?php 

	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Chi Tiết Biểu Phí";
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	

	//BEGIN: HIỂN THỊ THÔNG TIN CỦA BIỂU PHÍ
	$id = "";
	$name = "";
	$year = "";	
	$from = "";	
	$to = "";	
	$total_price = "";
	$service = "";
	$month = "";
	
	if($array_fee_info)
	{
		$id = $array_fee_info[0]["id"];
		$name = $array_fee_info[0]["name"];
		$year = $array_fee_info[0]["year"];	
		if($year == "0") $year = "";
		
		$month = $array_fee_info[0]["month"];	
		if($month == "0") $month = "";
		
		$to = date("d-m-Y",strtotime($array_fee_info[0]["to"]));
		$from = date("d-m-Y",strtotime($array_fee_info[0]["from"]));
		
		if($from == "01-01-1970") $from = "";
		if($to == "01-01-1970") $to = "";
	}
	
	$str_form_fee = $this->Template->load_form_row(array("title"=>"Tên biểu phí","input"=>$name,"style"=>"width:80%"));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Tháng","input"=>$month."/".$year));
	

	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Từ ngày","input"=>$from. "-" , $to));
	

	echo $this->Template->load_form(array("method"=>"POST"),$str_form_fee);
	//END: HIỂN THỊ THÔNG TIN CỦA BIỂU PHÍ		
	
	$array_table_detail_header = array(
									"num"				=> array("Stt",array("style"=>"width:1%;text-align:center")),
									"service_name"		=> array("Tên Dịch vụ",array("style"=>"width:1%;text-align:center")),
									"price"				=> array("Giá tiền",array("style"=>"width:1%;text-align:center")),
									"edit"			=> array("Sửa",array("style"=>"width:1%;text-align:center")),									
									"delete"			=> array("Xóa",array("style"=>"width:1%;text-align:center"))
								);

	/* gọi hàm $this->Template->load_table_header() tạo thẻ 
		<tr>
			<td thuộc tính>nội dung</td>
			<td thuộc tính>nội dung</td>
			...
		</tr> từ array_table_test_header
		và gán vào chuỗi str_table_test_header
	*/
	$str_table_detail_header = $this->Template->load_table_header($array_table_detail_header);


	$str_table_detail_row ="";
	$str_table_detail_row_combobox ="";


	$array_table_detail_row_combobox = null;



	//tao selectbox
	$str_select_service = 
		$this->Template->load_selectbox(array("name"=>"data[id_service]","style"=>"width:200px;"),$array_classroom_service);


	//tao textbox gia tien
	$str_price_service = $this->Template->load_textbox(array("name"=>"data[price]","style"=>"width:40%;"));

	//tao hidden id
	$str_hidden_id_fee = $this->Template->Load_hidden(array("name"=>"data[id_fee]","value"=>$id_fee));



	
	//tao buton luu
	$str_save_service = $this->Template->load_button(array("value"=>"Lưu","type"=>"submit"),"Lưu");


	$array_table_detail_row_combobox["num"] = array("",array("text-align:center"));
	$array_table_detail_row_combobox["service_name"] = array($str_select_service,array("text-align:center"));

	$array_table_detail_row_combobox["price"] = array($str_price_service.$str_save_service.$str_hidden_id_fee,array("text-align:center"));
	$array_table_detail_row_combobox["delete"] = array("",array("text-align:center"));


	//dua vao mang load table
	$str_table_detail_row_combobox .=  $this->Template->load_table_row($array_table_detail_row_combobox,array("align"=>"center","id"=>"table_posts"));

	//kiem tra xem co du lei khong
	if($array_detail != null)
	{	

		$stt = 0;
		foreach ($array_detail as $detail) 
		{
			$stt++;
			$array_table_detail_row = null;
			$array_table_detail_row["num"] = array($stt,array("text-align:center"));
			$array_table_detail_row["service_name"] = array($detail["service_name"],array("text-align:center"));
			$array_table_detail_row["price"] = array(number_format($detail["price"]),array("text-align:center"));

			//tạo link sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/fee/detail/".$detail["id"]."/$id_fee.html");
			$array_table_detail_row["edit"] = array($str_link_edit,array("text-align:center"));

			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/fee/del_detail/".$detail["id"]."/$id_fee.html");
			$array_table_detail_row["delete"] = array($str_link_delete,array("text-align:center"));


			//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row

			$str_table_detail_row .=  $this->Template->load_table_row($array_table_detail_row,array("align"=>"center","id"=>"table_posts"));
			
		}//end foreach ($array_question as $question) 
	}//end if($array_question != null)

	//$str_select_detail = $this->Template->load_selectbox(array("name"=>"id_test","value"=>"","style"=>"width:200px;"));
	
	
	/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_test_header</table>
		và gán vào chuỗi str_table_test
	*/
	$str_table_detail =  $this->Template->load_table($str_table_detail_header.$str_table_detail_row_combobox.$str_table_detail_row,array("align"=>"center","id"=>"table_posts"));

	$str_form_row = $this->Template->load_form(array("method"=>"POST","action"=>"/fee/detail/".$id_fee.".html"),$str_table_detail);

	echo $str_form_row;
 ?>