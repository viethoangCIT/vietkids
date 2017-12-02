<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Quản Lý Bài Thi";

	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	
	//table bài this

	$array_table_test_header =  array(
								"num"				=> array("Stt",array("style"=>"width:1%;text-align:center")),
								"name"				=> array("Tên bài thi",array("style"=>"text-align:left")),
								"desc" 				=> array("Mô tả",array("style"=>"text-align:left")),
								"day_start"			=> array("Ngày bắt đầu",array("style"=>"text-align:left")),
								"day_finish"		=> array("Ngày kết thúc",array("style"=>"text-align:left")),
								"hour_start"		=>array("Giờ bắt đầu",array("style"=>"text-align:left")),
								"hour_finish"		=>array("Giời kết thúc",array("style"=>"text-align:center")),	
								"created"		=>array("Ngày nhập",array("style"=>"text-align:center")),
								"edit"				=>array("Sửa",array("style"=>"text-align:center")),
								"delete"			=>array("Xóa",array("style"=>"text-align:center"))
								);
	/* gọi hàm $this->Template->load_table_header() tạo thẻ 
		<tr>
			<td thuộc tính>nội dung</td>
			<td thuộc tính>nội dung</td>
			...
		</tr> từ array_table_test_header
		và gán vào chuỗi str_table_test_header
	*/
	 $str_table_test_header = $this->Template->load_table_header($array_table_test_header);
	 
	
	
	//lấy dữ liệu array_test đưa vào table
	$str_table_test_row = "";
	if($array_test != null)
	{
		$stt = 0;
		foreach($array_test as $test)
		{
			$stt++;
			$array_table_test_row = null;
			$array_table_test_row["num"] = array($stt,array("text-align:center"));
			$array_table_test_row["name"] = array($test["name"],array("text-align:center"));
			$array_table_test_row["desc"] = array($test["desc"],array("text-align:center"));
			$array_table_test_row["day_start"] = array($test["day_start"],array("text-align:center"));
			$array_table_test_row["day_finish"] = array($test["day_finish"],array("text-align:center"));
			$array_table_test_row["hour_start"] = array($test["hour_start"],array("text-align:center"));
			$array_table_test_row["hour_finish"] = array($test["hour_finish"],array("text-align:center"));
			$array_table_test_row["created"] = array($test["created"],array("text-align:center"));
			
			//tạo linh sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/test/add/".$test["id"].".html");
			$array_table_test_row["edit"] = array($str_link_edit,array("text-align:center"));
			
			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/test/del/".$test["id"].".html");
			$array_table_test_row["option"] = array($str_link_delete,array("text-align:center"));
			
			
			//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row
			$str_table_test_row .=  $this->Template->load_table_row($array_table_test_row,array("align"=>"center","id"=>"table_posts"));
		}//end foreach($array_test as $test)
	}//end if($array_test != null)
	
	/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_test_header</table> 
		và gán vào chuỗi str_table_test
	*/
	$str_table_test =  $this->Template->load_table($str_table_test_header.$str_table_test_row,array("align"=>"center","id"=>"table_posts"));
	echo $str_table_test;
	
?>