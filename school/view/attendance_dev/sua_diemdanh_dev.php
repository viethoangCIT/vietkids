<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    if($type == 0) $function_title = "Chỉnh Sửa Điểm Danh trẻ";
	else $function_title = "Chỉnh Sửa Điểm Danh giáo viên";
	
    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************

    //*****************************************
    //FUNCTION CONTENT
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:214px","onkeyup"=>"timkiem()"));
	
	//*****************************************
	//END TIM KIEM
	
	//***TABLE
    $array_header_attendance = "";
    //buoc 1: tao mang table header
    $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "name"=>array("Họ và tên",array("style"=>"text-align:center")),
									"half_day"=>array("Nửa buổi",array("style"=>"text-align:center;")),
                                    "status"=>array("Có mặt",array("style"=>"text-align:center;")),
									"vang"=>array("Vắng",array("style"=>"text-align:center;"))
									);

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_header_attendance = $this->Template->load_table_header($array_header_attendance);

    //bước 3: duyet du lieu tu database tra ve de dua vao bảng
    $str_table_attendance = "";
    $i = 0;
	$sodong = 0;
    if ($array_diemdanh != NULL)
    {
        $str_content_attendance = "";
		$sodong = count($array_diemdanh);
		$array_status_service = array("0"=>"Không","1"=>"Có");
        foreach ($array_diemdanh as $diemdanh)
        {
			$str_check_vang = $str_check_dihoc = $str_check_nuabuoi = "";
			$status = $diemdanh['status'];
			$full_day = $diemdanh['full_day'];
			
			if($status == 1)
			{
				if($full_day == 1) $str_check_dihoc = "checked";
				else $str_check_nuabuoi = "checked";
			}
			else $str_check_vang = "checked";
			
            // lay du lieu cho tung row
            $str_hidden_id_diemdanh = $this->Template->load_hidden(array("name"=>"data[DiemDanh][$i][id]","value"=>$diemdanh['id']));
			
            $str_checkbox = "<input type='checkbox' name='data[DiemDanh][$i][status]' $str_check_dihoc class='chk_$i'>";
			$str_half_day = "<input type='checkbox' name='data[DiemDanh][$i][half_day]' $str_check_nuabuoi class='chk_$i'>";
			$str_vang = "<input type='checkbox' name='data[DiemDanh][$i][vang]' $str_check_vang class='chk_$i'>";
            $str_id_user = "<input type='hidden' name='data[DiemDanh][$i][id_user]' value='".$diemdanh['id_user']."'>";
			$str_username = "<input type='hidden' name='data[DiemDanh][$i][customer_name]' value='".$diemdanh['fullname']."'>";			
			
			$diemdanh_dichvu = "";
			if($type == 0)
			{
				$antoi = $diemdanh["antoi"];
				$str_select_dichvu = $this->Template->load_selectbox_basic(array("name"=>"data[DiemDanh][$i][antoi]"),$array_status_service,$antoi);
				$diemdanh_dichvu = "<span style='float:right'>Ăn tối: $str_select_dichvu</span>";
			}
			
            $arr_row_attendance['stt'] = array(++$i,array("style"=>"text-align:center"));
            $arr_row_attendance['name'] = array($diemdanh['fullname'].$str_hidden_id_diemdanh.$str_id_user.$diemdanh_dichvu.$str_username,array("style"=>"text-align:left"));
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
	$str_form_attendance = $this->Template->load_form_row(array("title"=>"Lớp",
   																"input"=>$classroom_name));
																
	$date = date("d-m-Y",strtotime($date));														
																
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"Ngày điểm danh",
                                                                 "input"=>$this->Template->load_textbox(array("name"=>"data[date]","autocomplete"=>"off","value"=>$date,"id"=>"date"))));
																
    
	
	$str_form_attendance .= $this->Template->load_form_row(array("title"=>"Danh Sách","input"=>$str_timkiem));
   
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_table_attendance));

    // dùng hàm load_form để lấy html cho form
    $str_form_attendance = $this->Template->load_form(array("action"=>"/attendance/edit/$id_classroom/$date/$type?debug=code","method"=>"post","id"=>"form_diemdanh"),$str_form_attendance);

    // Hiển thị ra trình duyệt
    echo $str_form_attendance;

    //END FUNCTION CONTENT
    //*****************************************
?>
<script type="text/javascript">
$( function() {
        $( "#date" ).datepicker({dateFormat: "dd-mm-yy"});
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