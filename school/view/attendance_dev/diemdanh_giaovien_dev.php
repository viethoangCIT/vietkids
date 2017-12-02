<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title = "Điểm danh giáo viên";

    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:214px","onkeyup"=>"timkiem()"));
	
	//*****************************************
	//END TIM KIEM
    //*****************************************
    //FUNCTION CONTENT

    //***TABLE
    $array_header_attendance = "";
    //buoc 1: tao mang table header
    $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "name"=>array("Họ tên",array("style"=>"text-align:center")),
									"type"=>array("Loại",array("style"=>"text-align:center")),
									"half_day"=>array("Làm nửa buổi",array("style"=>"text-align:center;width:13%")),
                                    "status"=>array("Đi làm",array("style"=>"text-align:center;width:10%")),
									"vang"=>array("Vắng",array("style"=>"text-align:center;width:10%"))
									);

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_header_attendance = $this->Template->load_table_header($array_header_attendance);

    //bước 3: duyet du lieu tu database tra ve de dua vao bảng
    $str_table_attendance = "";
    $i = 0;
	$sodong = 0;
    if ($array_giaovien != NULL)
    {
        $str_content_attendance = "";
		$sodong = count($array_giaovien);
		$array_type = array("0"=>"Giáo viên","1"=>"Người quản trị","2"=>"Bảo vệ","3"=>"Khối văn phòng");
        foreach ($array_giaovien as $giaovien)
        {
            // lay du lieu cho tung row
            $str_hidden_id_giaovien = $this->Template->load_hidden(array("name"=>"data[DiemDanh][GiaoVien][$i][id_user]","value"=>$giaovien['id']));
			$str_hidden_fullname_giaovien = $this->Template->load_hidden(array("name"=>"data[DiemDanh][GiaoVien][$i][fullname]","value"=>$giaovien['fullname']));
			
            $str_checkbox = "<input type='checkbox' name='data[DiemDanh][GiaoVien][$i][status]' checked class='chk_$i'>";
			$str_half_day = $this->Template->load_checkbox(array("name"=>"data[DiemDanh][GiaoVien][$i][half_day]","class"=>"chk_$i"));
			$str_vang = $this->Template->load_checkbox(array("name"=>"data[DiemDanh][GiaoVien][$i][vang]","class"=>"chk_$i"));
            
            $arr_row_attendance['stt'] = array(++$i,array("style"=>"text-align:center"));
            $arr_row_attendance['name'] = array($giaovien['fullname'].$str_hidden_id_giaovien.$str_hidden_fullname_giaovien,array("style"=>"text-align:left"));
			$arr_row_attendance['type'] = array($array_type[$giaovien["type"]],array("style"=>"text-align:center"));
			$arr_row_attendance['half_day'] = array($str_half_day,array("style"=>"text-align:center"));
            $arr_row_attendance['status'] = array($str_checkbox,array("style"=>"text-align:center"));
			$arr_row_attendance['vang'] = array($str_vang,array("style"=>"text-align:center"));

            // Lay html cho row
            $str_content_attendance .= $this->Template->load_table_row($arr_row_attendance);
        }

        //bước 4: Lưu
        $str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Lưu");
        $array_row_attendance =  array("stt"=>array($str_btn_save,array("style"=>"text-align:right","colspan"=>"6")));
        $str_content_attendance .= $this->Template->load_table_row($array_row_attendance);

        //buoc 5: dung ham load_table đưa dữ liệu vào table
        $str_table_attendance =  $this->Template->load_table($str_header_attendance.$str_content_attendance);
    }
    //***END TABLE

    //***FORM
    //tạo string chứa nội dung form
    $date = date('d-m-Y');
    $str_form_attendance = $this->Template->load_form_row(array("title"=>"Ngày điểm danh",
                                                                 "input"=>$this->Template->load_textbox(array("name"=>"data[DiemDanh][date]","autocomplete"=>"off","value"=>"$date","id"=>"day"))));
	
	$str_form_attendance .= $this->Template->load_form_row(array("title"=>"Danh sách giáo viên","input"=>$str_timkiem));
   
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_table_attendance));
   
    // dùng hàm load_form để lấy html cho form
    $str_form_attendance = $this->Template->load_form(array("action"=>"/attendance/teacher","method"=>"post","id"=>"form_diemdanh"),$str_form_attendance);

    // Hiển thị ra trình duyệt
    echo $str_form_attendance;

    //END FUNCTION CONTENT
    //*****************************************
?>
<script type="text/javascript">
    $( function() {
        $( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
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
<?php
if($sodong > 0)
{
	for($a=0;$a<$sodong;$a++)
	{
	?>
		$('input.chk_<?php echo $a; ?>').on('change', function() {
			$('input.chk_<?php echo $a; ?>').not(this).prop('checked', false);  
		});
	<?php
	}
}
	?>
</script>