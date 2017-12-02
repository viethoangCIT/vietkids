<!-- Bat dau noi dung -->
<?php
 	if($type == "0") $function_title="Xếp Lớp Trẻ";
	else $function_title="Xếp Lớp Giáo Viên";
	
	echo $this->Template->load_function_header($function_title);
	
	
	$str_row_classroom = $this->Template->load_form_row(array("title"=>" Lớp ","input"=>$ten_lop));
	
	//học kỳ
    //$str_row_classroom .= $this->Template->load_form_row(array( "title" => "Học Kỳ","input" =>"1"));
	
	$str_row_classroom .= $this->Template->load_form_row(array( "title" => "Năm","input" =>$nam_lop));
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:214px","onkeyup"=>"timkiem()"));
	
	$str_timkiem .= $this->Template->load_label(" Sinh từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","onchange"=>"timkiem_tungay()"));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","onchange"=>"timkiem_tungay()"));
	//$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	//*****************************************
	//END TIM KIEM
	
	
	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"Danh Sách Xếp Lớp","input"=>$str_timkiem));
	
	
	//lấy danh sách học sinh
	$array_header_CheckList =  array("stt"=>array("STT",array("style"=>"text-align:center; width:10%")),
							"name"=>array("Họ Và Tên",array("style"=>"text-align:left;")),
							"birthdate"=>array("Ngày Sinh",array("style"=>"text-align:center")),
							"classroom_check"=>array("Xếp Lớp",array("style"=>"text-align:center")),	
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_CheckList = $this->Template->load_table_header($array_header_CheckList);
	
	//Lấy nội dung của bảng định lượng
	
	$str_row_CheckList = "";
	$stt = 0;
	
	if($array_xeplop)
	{
		foreach($array_xeplop as $xeplop)
		{
			$str_check_view = "";
			/*$id_user = ",".$user_view['id'].",";
			
			if(strpos($list_user_view, $id_user) !== false) $str_check_view = "checked";*/
			
			$str_form_xem = "<input type='checkbox' name='data[XepLop][$stt][id_fullname]' value='".$xeplop["id"]."'/>";
			$str_fullname = $this->Template->load_hidden(array("name"=>"data[XepLop][$stt][fullname]","value"=>$xeplop["fullname"]));
			
			$ngaysinh = date("d-m-Y",strtotime($xeplop["birthday"]));
			if($ngaysinh == "01-01-1970") $ngaysinh = "";
			
			$stt++;
			$array_row_CheckList = NULL;
			$array_row_CheckList["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_CheckList["name"] 				= array($xeplop["fullname"].$str_fullname);
			$array_row_CheckList["birthdate"] 				= array($ngaysinh,array("style"=>"text-align:center;"));
			$array_row_CheckList["classroom_check"] 	= array($str_form_xem,array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_CheckList .= $this->Template->load_table_row($array_row_CheckList);
		}
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_row_table =  $this->Template->load_table($str_header_CheckList.$str_row_CheckList);
	//buoc 6: hien thi du lieu table ra man hinh
	
	
	
	
	
	
	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"","input"=>$str_row_table));
	
	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit"),"Lưu")));

	$str_form_classroom = $this->Template->load_form(array("method"=>"POST","action"=>"/classroom/arrange/$id_classroom/$type.html"),$str_row_classroom);
	
	echo $str_form_classroom;
	
?>
<script>
 $(function() {
		//$( "#ngayvaotruong" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#tungay" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#denngay" ).datepicker({dateFormat: 'dd-mm-yy'});
  });
  
 //tìm kiếm tên parseInt
 function timkiem() {
  var input, tim, table, tr, td, i;
  input = document.getElementById("tim");
  tim = input.value.toUpperCase();
  table = document.getElementById("movie-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(tim) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 

//tìm kiếm từ ngày sinh 
 function timkiem_tungay() {
  var input_tungay, tungay, input_denngay, denngay, table, tr, td, i;
  input_tungay = document.getElementById("tungay");
  tungay = input_tungay.value;
  input_denngay = document.getElementById("denngay");
  denngay = input_denngay.value;
  table = document.getElementById("movie-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
		var dateParts = td.innerHTML.split("-");
		var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]);
		
		dateObject_tungay = "";
		if(tungay != ""){
		var parts_tungay = tungay.split("-");
		var dateObject_tungay = new Date(parts_tungay[2], parts_tungay[1] - 1, parts_tungay[0]);
		}
		
		dateObject_denngay = new Date();
		if(denngay != ""){
		var parts_denngay = denngay.split("-");
		var dateObject_denngay = new Date(parts_denngay[2], parts_denngay[1] - 1, parts_denngay[0]);
		}
		
      if(dateObject >= dateObject_tungay && dateObject <= dateObject_denngay) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 

 </script>