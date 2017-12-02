<?php 

		//*****************************************
	//FUNCTION HEADER
	//*****************************************
	$function_title = "Xem Câu Trả Lời";

	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

	$array_table_answer_header = array(
									"num"				=> array("Stt",array("style"=>"width:1%;text-align:center")),
									"name"				=> array("Tên",array("style"=>"width:1%;text-align:center")),
									"id_question"		=> array("Id câu hỏi",array("style"=>"width:1%;text-align:center")),
									"question_name"		=> array("Tên câu hỏi",array("style"=>"width:1%;text-align:center")),
									"id_test"			=> array("ID bài test",array("style"=>"width:1%;text-align:center")),
									"test_name"			=> array("Tên câu hỏi",array("style"=>"width:1%;text-align:center")),
									"id_created_user"			=> array("ID user",array("style"=>"width:1%;text-align:center")),
									"created_username"			=> array("Tên",array("style"=>"width:1%;text-align:center")),
									"created_fullname"			=> array("Họ và tên",array("style"=>"width:1%;text-align:center")),
									"created"			=> array("Ngày tạo",array("style"=>"width:1%;text-align:center")),
									"edit"				=>array("Sửa",array("style"=>"width:1%;text-align:center")),
									"delete"			=>array("Xóa",array("style"=>"width:1%;text-align:center"))
									);
									
	/* gọi hàm $this->Template->load_table_header() tạo thẻ 
		<tr>
			<td thuộc tính>nội dung</td>
			<td thuộc tính>nội dung</td>
			...
		</tr> từ array_table_test_header
		và gán vào chuỗi str_table_answer_header
	*/

	$str_table_answer_header = $this->Template->load_table_header($array_table_answer_header);

	//lấy dư liệu từ $str_table_answer_header đưa vào table
	$str_table_answer_row ="";
	if($array_answer != null)
	{
		$stt = 0;
		foreach ($array_answer as $answer) 
		{
			$stt++;
			$array_table_answer_row = null;
			$array_table_answer_row["num"] = 
				array($stt,array("text-align:center"));

			$array_table_answer_row["name"] = 
				array($answer["name"],array("text-align:center"));

			$array_table_answer_row["id_question"] = 
				array($answer["id_question"],array("text-align:center"));

			$array_table_answer_row["question_name"] = 
				array($answer["question_name"],array("text-align:center"));

			$array_table_answer_row["id_test"] = 
				array($answer["id_test"],array("text-align:center"));

			$array_table_answer_row["test_name"] = 
				array($answer["test_name"],array("text-align:center"));

			$array_table_answer_row["id_created_user"] = 
				array($answer["id_created_user"],array("text-align:center"));

			$array_table_answer_row["created_username"] = 
				array($answer["created_username"],array("text-align:center"));

			$array_table_answer_row["created_fullname"] = 
				array($answer["created_fullname"],array("text-align:center"));

			$array_table_answer_row["created"] = 
				array($answer["created"],array("text-align:center"));


			//tạo linh sửa
			$str_link_edit = $this->Template->load_link("edit","Sửa","/test/add_answer/".$answer["id"].".html");
			$array_table_answer_row["edit"] = array($str_link_edit,array("text-align:center"));

			//tạo link xóa
			$str_link_delete = $this->Template->load_link("del","Xóa","/test/del_answer/".$answer["id"].".html");
			$array_table_answer_row["option"] = array($str_link_delete,array("text-align:center"));

			//gọi hàm $this->Template->load_table_row để tạo cặp thẻ <tr><td></td></tr> từ mảng $array_table_test_row
			$str_table_answer_row .=  $this->Template->load_table_row($array_table_answer_row,array("align"=>"center","id"=>"table_posts"));
		}
	}

	/* gọi hàm $this->Template->load_table() tạo <table>nội dung là giá trị của biến str_table_test_header</table> 
		và gán vào chuỗi str_table_test
	*/
	$str_table_answer =  $this->Template->load_table($str_table_answer_header.$str_table_answer_row,array("align"=>"center","id"=>"table_posts"));

	echo $str_table_answer;

 ?>