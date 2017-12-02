<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title = "Điểm danh trẻ";


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
    //*****************************************	
		
		
    //***TABLE
    $array_header_attendance = "";
    //buoc 1: tao mang table header
    $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "name"=>array("Họ tên",array("style"=>"text-align:center")),
									"half_day"=>array("Học nửa buổi",array("style"=>"text-align:center;width:13%")),
                                    "status"=>array("Đi học",array("style"=>"text-align:center;width:10%")),
									"vang"=>array("Vắng",array("style"=>"text-align:center;width:10%"))
									);

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_header_attendance = $this->Template->load_table_header($array_header_attendance);

    //bước 3: duyet du lieu tu database tra ve de dua vao bảng
    $str_table_attendance = "";
    $i = 0;
	$sodong = 0;
    if ($array_list_customer != NULL)
    {
        $str_content_attendance = "";
		$sodong = count($array_list_customer);
        $array_status_service = array("0"=>"Không","1"=>"Có");
        $array_status_service_antoi = array("1"=>"Có");
        
        foreach ($array_list_customer as $customer)
        {
            // lay du lieu cho tung row
            $str_hidden_id_customer = $this->Template->load_hidden(array("name"=>"attendance[$i][id_user]","value"=>$customer['id_fullname']));
            //$str_checked = $this->Template->load_hidden(array("name"=>"attendance[$i][checked]"));
            $str_checkbox = "<input type='checkbox' name='attendance[$i][status]' checked class='chk_$i'>";
			$str_half_day = "<input type='checkbox' name='attendance[$i][half_day]' class='chk_$i'>";
            $str_vang = "<input type='checkbox' name='attendance[$i][vang]' class='chk_$i'>";
            
            
            $str_select_dichvu = $this->Template->load_selectbox_basic(array("name"=>"attendance[$i][antoi]"),$array_status_service);
            if($customer["service_code"]=="antoi")
            {
                $str_select_dichvu = $this->Template->load_hidden(array("name"=>"attendance[$i][antoi]","value"=>"1"));
            }
			//lấy danh sách dịch vụ có điểm danh
			foreach($array_dichvu as $dichvu)
			{
                $ten_dichvu = $dichvu["name"];
                
                $diemdanh_dichvu = $ten_dichvu.": ".$str_select_dichvu;
			}
            
            $diemdanh_dichvu = "<span style='float:right'>$diemdanh_dichvu</span>";
            if($customer["service_code"]=="antoi")
            {
                $diemdanh_dichvu = "<span style='float:right; display:none;'>$diemdanh_dichvu</span>";
            }
			
            $arr_row_attendance['stt'] = array(++$i,array("style"=>"text-align:center"));
            $arr_row_attendance['name'] = array($customer['fullname'].$str_hidden_id_customer.$diemdanh_dichvu,array("style"=>"text-align:left"));
			$arr_row_attendance['half_day'] = array($str_half_day,array("style"=>"text-align:center"));
            $arr_row_attendance['status'] = array($str_checkbox,array("style"=>"text-align:center"));
			$arr_row_attendance['vang'] = array($str_vang,array("style"=>"text-align:center"));

            // Lay html cho row
            $str_content_attendance .= $this->Template->load_table_row($arr_row_attendance);
        }

        //bước 4: Lưu
        $str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Lưu");
        $array_row_attendance =  array("stt"=>array($str_btn_save,array("style"=>"text-align:right","colspan"=>"5")));
        $str_content_attendance .= $this->Template->load_table_row($array_row_attendance);

        //buoc 5: dung ham load_table đưa dữ liệu vào table
        $str_table_attendance =  $this->Template->load_table($str_header_attendance.$str_content_attendance);
    }
    //***END TABLE

    //***FORM
    //tạo string chứa nội dung form
    $str_form_attendance ="";
    $str_selectbox_classroom = $this->Template->load_selectbox(array("name"=>"id_classroom","onchange"=>'changeclassroom()',"style"=>"width:80%"),$array_list_classroom,$id_classroom);

    $change_classroom = $this->Template->load_hidden(array("name"=>"change_classroom","id"=>"change_classroom","value"=>"0"));
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"Lớp",
                                                                 "input"=>$str_selectbox_classroom.$change_classroom));

    $day = date('d-m-Y');
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"Ngày điểm danh",
                                                                 "input"=>$this->Template->load_textbox(array("name"=>"day","autocomplete"=>"off","value"=>"$day","id"=>"day"))));
    $str_form_attendance .= $this->Template->load_form_row(array("title"=>"Danh sách trẻ",
                                                                 "input"=>$str_timkiem));
	$str_form_attendance .= $this->Template->load_form_row(array("title"=>"",
                                                                 "input"=>$str_table_attendance));															 

    // dùng hàm load_form để lấy html cho form
    $str_form_attendance = $this->Template->load_form(array("action"=>"/attendance/add.html?debug=code","method"=>"post","id"=>"form_diemdanh"),$str_form_attendance);

    // Hiển thị ra trình duyệt
    echo $str_form_attendance;

    //END FUNCTION CONTENT
    //*****************************************
?>
<script type="text/javascript">
    $( function() {
        $( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );

    function changeclassroom()
    {
        document.getElementById("change_classroom").value = 1;
        document.getElementById("form_diemdanh").submit();
    }
	 $( function() {
        $( "#day" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
 //tìm kiếm tên 
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
	//chỉ đc check 1 ô
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