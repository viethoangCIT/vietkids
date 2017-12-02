<script src="/js/jquery.floatThead.js"></script> 
<style>
.hover-row:hover{background-color:#ffd028 !important}
</style>
<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title = "Xem điểm danh theo lịch nhân viên";

    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************

    //TIM KIEM
    //*****************************************
    $str_timkiem="";
	
    $str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"startday","autocomplete"=>"off","id"=>"startday","style"=>"width:100px","value"=>$tungay));

    $str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"finishday","autocomplete"=>"off","id"=>"finishday","style"=>"width:100px","value"=>$denngay));

	$str_timkiem .= $this->Template->load_label(" Nhân viên: ","","search_list");
    $str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_user","style"=>"width:200px","onchange"=>"thaydoi_user()"),$array_user,$id_user);	

    $str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

    $link_danhsach = $this->Html->link(array("controller"=>"attendance","action"=>"attendance_list_user"));
    $str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);
    echo $str_timkiem;

    //*****************************************
    //END TIM KIEM
	
    //*****************************************
    //FUNCTION CONTENT
	
		
	//$array_status = array("0"=>"Vắng","1"=>"Đi học","2"=>"Nửa buổi");
		
    //Table
	$str_table_attendance = "<div style='overflow: auto; margin-top: 30px; height: 315px'><table data-role='table' id='movie-table' data-mode='reflow' class='ui-responsive table table-bordered table-striped' style='border-top:1px solid #dcdcdc;'><thead class='v_mid'>";

 	$str_table_attendance .= "<tr><th>Họ và tên</th>";
	
	foreach($array_thoigian_diemdanh as $thoigian_diemdanh)
	{
		$date = date("d-m-Y",strtotime($thoigian_diemdanh["date"]));
		$color = "";
		$chuthich_ngay = "";
		if(date('w', strtotime($date)) == 6)
		{
			$color = "style='background-color: #0db400'";
			$chuthich_ngay = "(T7)";
		}
		if(date('w', strtotime($date)) == 0)
		{
			$color = "style='background-color: #958d96'";
			$chuthich_ngay = "(CN)";
		}
		
		$str_table_attendance .= "<th nowrap $color>$date $chuthich_ngay</th>";
	}
	
	$str_table_attendance .= "<th nowrap>Tổng số ngày đi làm</th>";
	$str_table_attendance .= "<th nowrap>Tổng số ngày làm nửa buổi</th>";
	$str_table_attendance .= "<th nowrap>Tổng số ngày vắng</th>";
	/*$str_table_attendance .= "<th nowrap>Tổng số ngày vắng thứ 7</th>";
	$str_table_attendance .= "<th nowrap>Tổng số ngày ăn tối</th>";*/
	
	$str_table_attendance .= "</tr></thead><tbody class='body_mid'>";
	
	foreach($array_giaovien as $danhsach_giaovien)
	{
		$fullname = $danhsach_giaovien["fullname"];
		$id_user = $danhsach_giaovien["id"];
		
		$str_table_attendance .= "<tr class='hover-row' title='$fullname'><td nowrap>$fullname</td>";
		
		$tong_ngay_dilam = $tong_ngay_vang = $tong_ngay_nuabuoi = 0;
		
		foreach($array_attendance as $diem_danh)
		{
			$status = $diem_danh["status"];
			$full_day = $diem_danh["full_day"];
			$sat = $diem_danh["sat"];
			$check = "";
			
			if($diem_danh["id_user"] == $id_user)
			{
				if($status == "1")
				{
					if($full_day == "1")
					{
						$check = "1";
						$chuthich_diemdanh = "Đi làm";
						$tong_ngay_dilam++;
					}else
					{
						$check = "0.5";
						$chuthich_diemdanh = "Làm nửa buổi";
						$tong_ngay_nuabuoi++;
					}
				}else
				{
					$check = "0";
					$chuthich_diemdanh = "Vắng";
					$tong_ngay_vang++;
				}
				
				$str_table_attendance .= "<td style='text-align:center' title='$fullname: $chuthich_diemdanh'>$check</td>";
			}
		}
		$str_table_attendance .= "<th>$tong_ngay_dilam</th><th>$tong_ngay_nuabuoi</th><th>$tong_ngay_vang</th>";
		$str_table_attendance .= "</tr>";
	}
	
	$str_table_attendance .= "</tbody></table></div>";
   
    //buoc 6: hien thi du lieu table ra man hinh
    echo $str_table_attendance;

    //END FUNCTION CONTENT
    //*****************************************
	
?>

<script type="text/javascript">
    $( function() {
        $( "#startday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    $( function() {
        $( "#finishday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
	$('table').floatThead({
    position: 'absolute',
    scrollContainer: true
});
	function thaydoi_user()
	{
		document.getElementById('form_timkiem').submit();
	}
</script>