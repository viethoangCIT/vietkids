<style>
.table-responsive{overflow-x: inherit;}
</style>

<?php 
	
	$function_title="Chuyển Lớp giáo viên";
	echo $this->Template->load_function_header($function_title);
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:214px","onkeyup"=>"timkiem()"));
	
	//*****************************************
	//END TIM KIEM
	
	//$check_all = "<input type='checkbox' onchange='checkAll(this)' checked/>";
	
	//lấy danh sách học sinh
	$array_header_CheckList =  array("stt"=>array("STT",array("style"=>"text-align:center; width:10%")),
							"name"=>array("Họ Và Tên",array("style"=>"text-align:left; width:30%")),
							"classroom"=>array("Lớp Hiện Tại",array("style"=>"text-align:left; width:30%")),
							"change_classroom"=>array("Chuyển Lớp",array("style"=>"text-align:center; width:30%")),
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_CheckList = $this->Template->load_table_header($array_header_CheckList);
	
	//Lấy nội dung của bảng định lượng
	
	$str_row_CheckList = "";
	$stt = 0;
	
	if($array_danhsach_giaovien)
	{
		foreach($array_danhsach_giaovien as $giaovien)
		{
			//$str_form_xem = "<input type='checkbox' name='data[ChuyenLop][$stt][id]' value='".$giaovien["id"]."' checked/>";
			$id_user = $this->Template->load_hidden(array("name"=>"data[ChuyenLop][$stt][id_fullname]","value"=>$giaovien["id_fullname"]));
			$user_name = $this->Template->load_hidden(array("name"=>"data[ChuyenLop][$stt][fullname]","value"=>$giaovien["fullname"]));
			$select_classroom = $this->Template->load_selectbox(array("name"=>"data[ChuyenLop][$stt][id_classroom]","style"=>"width:100%"),$array_lop_hoc);
			$id_xeplop = $this->Template->load_hidden(array("name"=>"data[ChuyenLop][$stt][id]","value"=>$giaovien["id"]));
			$id_lophientai = $this->Template->load_hidden(array("name"=>"data[ChuyenLop][$stt][current_id_classroom]","value"=>$giaovien["id_classroom"]));
			
			$stt++;
			$array_row_CheckList = NULL;
			$array_row_CheckList["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_CheckList["name"] 				= array($giaovien["fullname"].$user_name.$id_user.$id_xeplop);
			$array_row_CheckList["classroom"] 			= array($giaovien["classroom_name"].$id_lophientai);
			$array_row_CheckList["change_classroom"] 	= array($select_classroom);
			//$array_row_CheckList["classroom_check"] 	= array($str_form_xem,array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_CheckList .= $this->Template->load_table_row($array_row_CheckList);
		}
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_row_table =  $this->Template->load_table($str_header_CheckList.$str_row_CheckList);
	//buoc 6: hien thi du lieu table ra man hinh
	
	
	
	
	
	
	$str_form_chuyenlop .= $this->Template->load_form_row(array("title"=>"Danh Sách Giáo Viên","input"=>$str_timkiem));
	
	$str_form_chuyenlop .= $this->Template->load_form_row(array("title"=>"","input"=>$str_row_table));
	
	$button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_chuyenlop .= $this->Template->load_form_row(array("title"=>"","input"=>$button));
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/classroom/change_classroom.html"),$str_form_chuyenlop);
	
	echo $str_form_nhap;
?>

<script>

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

</script>