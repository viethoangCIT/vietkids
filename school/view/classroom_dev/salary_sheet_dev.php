<style>
table{ width: 50%}

tr:hover td, tr.hover td { background-color: #F90 }
td.selected { background-color: green; } 
tr:hover td.selected { background-color: lime; }

#search_bar
{
	left: 0;
	position: absolute;
	margin-left: 5px;
	width: 100%;
	float: left;
	
}
#parent {
	min-height: 200px;
	max-height: 450px;
	height: auto;
	position: absolute;
    width: 100%;
    left: 0;
	margin-left:5px;
	overflow:scroll;
	margin-top: 70px;
	
}
			
#table_salary {
				width: 1800px !important;
}

#table_salary td.selected { border: 1px solid #F00; }
</style>
<?php
 $function_title = "Phiếu Lương";
    echo $this->Template->load_function_header($function_title);



 	$arrray_deparment =array(""=>"...","0"=>"BGĐ-Ban giám đốc", "1"=>"ISO-Quy trình", "3"=>"PRO-Sản xuất","4"=>"HR-Nhân sự", "5"=>"QC-Chất lượng", "6"=>"PE-Kỹ thuật", "7"=>"PUR-Mua hàng","8" =>"SALE-Kinh doanh", "9"=>"WH-Kho");    
    $str_select_department = $this->Template->load_selectbox_basic(array("name"=>"department","autocomplete"=>"off","value"=>"","id"=>"department"),$arrray_deparment);

                // lọc theo nhà máy
    $arrray_factory=  array(""=>"...","0"=>"SCM1", "1"=>"SCM2", "2"=>"SCM3");
    $str_select_factory    =  $this->Template->load_selectbox_basic(array("name"=>"factory","autocomplete"=>"off","value"=>"","id"=>"factory","style"=>"width:100px"),$arrray_factory);

                // lọc theo công việc
    $array_work =array(""=>"...","0"=>"Giám sát", "1"=>"Quản lý", "3"=>"Phụ trách","4"=>"Tính lương", "5"=>"Báo giá", "6"=>"Khai thuế", "7"=>"Lắp ráp","8" =>"Toàn kiểm", "9"=>"Kiểm hàng","10"=>"Đứng máy");
    $str_select_work = $this->Template->load_selectbox_basic(array("name"=>"work","autocomplete"=>"off","value"=>"","id"=>"work"),$array_work);

                // lọc theo chức vụ
    $array_position =array(""=>"...","0"=>"Giám đốc", "1"=>"P.Giám đốc", "3"=>"Trưởng phòng","4"=>"Phó phòng", "5"=>"Trưởng bộ phận", "6"=>"NV phụ trách", "7"=>"Tổ trưởng","8" =>"Tổ phó", "9"=>"Trưởng ca","10"=>"Phó ca","11"=>"Nhân viên","12"=>"Công dân"); 
    $str_select_position = $this->Template->load_selectbox_basic(array("name"=>"position","autocomplete"=>"off","value"=>"","id"=>"position"),$array_position);

            // lọc theo phân xưởng
    $arrray_part =array(""=>"...","0"=>"Anten 1", "1"=>"Molding 1", "3"=>"Solar","4"=>"Silicon", "5"=>"Electronic", "6"=>"Anten 2", "7"=>"Molding 2");
    $str_select_part = $this->Template->load_selectbox_basic(array("name"=>"part","autocomplete"=>"off","value"=>"","id"=>"part"),$arrray_part);
    // nhập mã nhân viên
    $str_input_staffcode = $this->Template->load_textbox(array("name"=>"staffcode","autocomplete"=>"off","value"=>"","id"=>"staffcode", "class"=>"day","style"=>"width:90px;"));

    $str_input_from = $this->Template->load_textbox(array("name"=>"salary_from","autocomplete"=>"off","value"=>"","id"=>"salary_from", "class"=>"day","style"=>"width:90px;"));
    $str_input_to = $this->Template->load_textbox(array("name"=>"salary_to","autocomplete"=>"off","value"=>"","id"=>"salary_to", "class"=>"day","style"=>"width:90px;"));

    $str_btn_save = $this->Template->load_button(array("type"=>"submit"),"Tìm kiếm");
	
	$str_label_from = $this->Template->load_label("Từ ngày: ","","search_list");
	$str_label_to = $this->Template->load_label("Đến ngày: ","","search_list");
	$str_label_department = $this->Template->load_label("Phòng ban: ","","search_list");
	$str_label_position = $this->Template->load_label("Chức vụ: ","","search_list");		
	$str_label_job = $this->Template->load_label("Công việc: ","","search_list");		
	$str_label_factory = $this->Template->load_label("Nhà máy: ","","search_list");		
	$str_label_manufactory = $this->Template->load_label("Phân xưởng: ","","search_list");
    $str_label_staffcode = $this->Template->load_label("Mã nhân viên: ","","search_list");		

   	
    $str_input_attendance_day ="$str_label_from $str_input_from $str_label_to $str_input_to $str_label_department   $str_select_department $str_label_position  $str_select_position $str_label_job $str_select_work <br>$str_label_factory $str_select_factory $str_label_manufactory $str_select_part $str_input_staffcode $str_btn_save";
   

   echo $str_input_attendance_day;
    //tạo nút tìm
  

 $str_table_row_salary="";
$array_table_header_salary =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                    "code"=>array("Mã nhân viên",array("style"=>"text-align:center")),
                                    "name"=>array("Họ tên",array("style"=>"text-align:center")),
                                    
                                    "main_salary"=>array("LƯƠNG HÀNH CHÁNH",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary3"=>array("PHỤ CẤP",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_150"=>array("LƯƠNG TĂNG CA 150%",array("style"=>"text-align:center;width:10%")),
                                    "sub_salary_200"=>array("LƯƠNG TĂNG CA 200%",array("style"=>"text-align:center;width:10%")),
                                    "productivity_salary"=>array("THƯỞNG ĐẠT CHẤT LƯỢNG",array("style"=>"text-align:center;width:10%")),
                                    "salary_1"=>array("CHUYÊN CÂN",array("style"=>"text-align:center")),
                                     "salary_2"=>array("TRỢ CẤP XE ĐI LẠI NHÀ Ở",array("style"=>"text-align:center")),
                                    "salary_4"=>array("TRÁCH NHIỆM",array("style"=>"text-align:center")),
                                    "salary_5"=>array("PHỤ CẤP LƯƠNG",array("style"=>"text-align:center")),
                                    "salary_3"=>array("LƯƠNG PHÉP NĂM HÀNG THÁNG",array("style"=>"text-align:center")),
                                    "salary_3"=>array("LƯƠNG NGHỈ LỄ",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TIỀN XĂNG ĐI CÔNG TÁC",array("style"=>"text-align:center")),
                                    "salary_10"=>array("ĐIỀU CHỈNH THÁNG TRƯỚC",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TRỪ TIỀN ĐỒNG PHỤC-THẺ",array("style"=>"text-align:center")),
                                    "salary_10"=>array("LƯƠNG GỐI ĐẦU",array("style"=>"text-align:center")),
                                    "salary_10"=>array("VI PHẠM NÔI QUY",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TRỪ TIỀN NG",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TIỀN KPCĐ",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TIỀN BHXH",array("style"=>"text-align:center")),
                                    "salary_10"=>array("TRỪ TIỀN BKT",array("style"=>"text-align:center")),
                                    "salary_10"=>array("THỰC LÃNH",array("style"=>"text-align:center")),

                                     );
 
                                  
    //$str_table_row_salary .= $this->Template->load_table_row($array_table_salary);


     $str_table_row_salary = "";
     $array_table_salary =  array( "LƯƠNG HÀNH CHÁNH"=>array("STT",array("style"=>"text-align:center; width:3%")),
                                   "code"=>array("Mã nhân viên",array("style"=>"text-align:center")),
                                    "name"=>array("Họ tên",array("style"=>"text-align:center")),
                                    "main_salary"=>array("LƯƠNG HÀNH CHÁNH",array("style"=>"text-align:center;width:10%"));

	 $str_table_row_salary .= $this->Template->load_table_row($array_table_salary);
     $str_table_salary =  $this->Template->load_table($str_table_row_salary );
 	

	echo "<br><br>";
   echo $str_table_salary; 
  ?>
    
<script language="javascript">
    $( function() {
        $( "#salary_from" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#salary_to" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
   
</script>