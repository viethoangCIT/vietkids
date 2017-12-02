<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Nhập Câu hỏi";

	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	$array_table_question_header = array(
									"num"				=> array("Stt",array("style"=>"width:1%;text-align:center")),
									"name"				=> array("Tên",array("style"=>"width:1%;text-align:center")),
									"id_test"			=> array("Id bài test",array("style"=>"width:1%;text-align:center")),
									"test_name"			=> array("Tên bài test",array("style"=>"width:1%;text-align:center")),
									"created"			=> array("Ngày tạo",array("style"=>"width:1%;text-align:center")),
									"id_created_user"	=> array("Id user",array("style"=>"width:1%;text-align:center")),
									"edit"				=>array("Sửa",array("style"=>"width:1%;text-align:center")),
									"delete"			=>array("Xóa",array("style"=>"width:1%;text-align:center"))
									);
									
	
	/* gọi hàm $this->Template->load_table_header() tạo thẻ 
		<tr>
			<td thuộc tính>nội dung</td>
			<td thuộc tính>nội dung</td>
			...
		</tr> từ array_table_test_header
		và gán vào chuỗi str_table_test_header
	*/
	$str_table_question_header = $this->Template->load_table_header($array_table_question_header);
	
	//lay du lieu dua tu array_question dua vao table

	$str_table_question_row ="";

	//kiem tra xem co du lei khong
	if($array_question != null)
	{
		$stt = 0;
		foreach ($array_question as $question) 
		{
			$stt++;
			$array_table_question_row = null;
			$array_table_question_row["num"] = 
				array($stt,array("text-align:center"));
			$array_table_question_row["name"] = 
				array($question["name"],array("text-align:center"));
			$array_table_question_row["id_test"] = 
				array($question["id_test"],array("text-align:center"));
			$array_table_question_row["test_name"] = 
				array($question["test_name"],array("text-align:center"));
			$array_table_question_row["created"] = 
				array($question["created"],array("text-align:center"));
			$array_table_question_row["id_created_user"] = 
				array($question["id_created_user"],array("text-align:center"));
				
			//tạo linh sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/test/add_question/".$question["id"].".html");
			$array_table_question_row["edit"] = array($str_link_edit,array("text-align:center"));

			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/test/del_question/".$question["id"].".html");
			$array_table_question_row["option"] = array($str_link_delete,array("text-align:center"));


			//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row
			$str_table_question_row .=  $this->Template->load_table_row($array_table_question_row,array("align"=>"center","id"=>"table_posts"));
			
		}//end foreach ($array_question as $question) 
	}//end if($array_question != null)

	/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_test_header</table> 
		và gán vào chuỗi str_table_test
	*/
	$str_table_question =  $this->Template->load_table($str_table_question_header.$str_table_question_row,array("align"=>"center","id"=>"table_posts"));

	echo $str_table_question;

	
?>