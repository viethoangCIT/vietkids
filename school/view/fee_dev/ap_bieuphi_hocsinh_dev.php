<style>
#id_customer_chosen{width: 144px !important;}
.table-responsive{overflow-x: inherit;}
.btn_icon_xoa{margin-top:10px !important}
</style>

<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Áp Biểu Phí Cho Trẻ";
	
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	$ngay_batdau=strtotime($array_lop_hoc[0]['from']);
	$ngay_ketthuc=strtotime($array_lop_hoc[0]['to']);
	
	$from=date("d-m-Y",$ngay_batdau);
	$to=date("d-m-Y",$ngay_ketthuc);
	//lấy thông tin biểu phí, lớp, tổng tiền
	$str_form_fee = $this->Template->load_form_row(array("title"=>"Lớp","input"=>$classroom_name));
	
	
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Từ Ngày","input"=>$from));
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Đến  Ngày","input"=>$to));
	
	//thêm số tiền sau biể phí
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Tên biểu phí","input"=>$fee_name."Tổng tiền biểu phí : ".number_format($total_price)." VNĐ"));
	
	
	//Tính tổng  số tháng giữa ngày bắt đầu và ngày kết thúc	
	$start    = new DateTime($array_lop_hoc[0]['from']);
	$start->modify('first day of this month');
	$end      = new DateTime($array_lop_hoc[0]['to']);
	$end->modify('first day of next month');
	$interval = DateInterval::createFromDateString('1 month');
	$period   = new DatePeriod($start, $interval, $end);
	$array_month=NULL;
	foreach ($period as $dt) 
	{
		$array_month[$dt->format("m-Y")] = $dt->format("m-Y") ;
	}
	
	//tạo combobox tháng
	$current_month = date("m-Y",strtotime($month));
	/*$get_month = date("m",strtotime($month));
	$get_Year = date("Y",strtotime($month));
	$num_day=cal_days_in_month(CAL_GREGORIAN,$get_month,$get_Year);*/
	
	
	$songay_dihoc =22;
	/*$songay_thu7=0;
	for($i=0; $i<$num_day; $i++)
	{
			$ngaydem = strtotime("$i day",strtotime($month) ); 
			
			if(date("N",$ngaydem)== "6" ) $songay_thu7++;
			
			if(date("N",$ngaydem) != "7" && date("N",$ngaydem) != "6") $songay_dihoc++;
			
	}*/
		
		
	$str_combo_thang=$this->Template->load_selectbox_basic(array("name"=>"month_year","id"=>"month_year","onchange"=>"xem(this.value)","style"=>"width:100px;"),$array_month,$current_month);
	
	
	$str_button_copy_fee_arrange = $this->Template->load_button(array("type"=>"button","onclick"=>"saochep_bieuphi(tmp_id_customer_fee)"),"Copy cho tất cả các tháng");
	//$str_button_copy_fee_arrange = "<div style='float:right'>$str_button_copy_fee_arrange</div>";
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Tháng","input"=>$str_combo_thang));
	
	
	$str_form_fee = $this->Template->load_form(array("method"=>"GET","action"=>"","id"=>"form_hientai"),$str_form_fee);
	
	echo $str_form_fee;
	
	/////////////////////////////////////////////
	//END lấy thông tin biểu phí, lớp, tổng tiền 
	
	
	//*****************************************
	//tạo table danh sách biẻu phí
	//*****************************************
	//
	$array_header_fee =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:5%")),
								"fullname"=>array("Tên trẻ",array("style"=>"text-align:center;width: 15%")),
								"service"=>array("Dịch vụ",array("style"=>"text-align:center")),
								
						);
				
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_fee = $this->Template->load_table_header($array_header_fee);
	
	//*****************************************
	//END tạo table danh sách biẻu phí
	//*****************************************
	
	//lấy dữ liệu biểu phí của trẻ từ bảng fee_customer
		//load row table fee
		$str_row_fee = "";
		$stt = 0;
		$sodong = 0;
		foreach($array_fee_customer as $fee_customer)
		{
			$stt++;
			$sodong++;
			
		
			
			$array_row_fee = NULL;
			$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_fee["fullname"] 		= array($fee_customer["customer_name"],array("style"=>"text-align:left;"));	
			
			/*thay thê str_tmp_student = stt
			$str_student_service = str_replace("str_tmp_student",$stt,$str_service);
			$str_student_service = str_replace("tmp_str_customer_name",$fee_customer["customer_name"],$str_student_service);
			$str_student_service = str_replace("tmp_str_id_customer",$fee_customer["id_customer"],$str_student_service);*/
			
			//lấy thông tin dịch vụ của học sinh
			
			
			$fee_customer_service = $fee_customer["str_service"];
			$array_tmp_fee_customer_service = explode(chr(9),$fee_customer_service);
			$student_service_name = "";
			$student_service_price = "";
			$student_id_service = "";
			$str_student_service = "<table>";
			$str_row_student_service = "";
			$str_row_student_service_price = "";
			
			
			//lấy tất cả các dịch vụ học sinh
			for($j=0;$j<(count($array_tmp_fee_customer_service)- 1);$j++)
			{
				$tmp_service = $array_tmp_fee_customer_service[$j];
				$array_tmp_service = explode(chr(8),$tmp_service);
				if(isset($array_tmp_service[0])) $student_service_name = $array_tmp_service[0];
				if(isset($array_tmp_service[1])) $student_service_price = $array_tmp_service[1];
				
				if(is_numeric($student_service_price)) $student_service_price = number_format($student_service_price);
				if(isset($array_tmp_service[2])) $student_id_service = $array_tmp_service[2];
				
				//nếu có đi học thứ bảy thì tăng số ngày đi học
				/*$num_day_fee_customer = $songay_dihoc;
				if($student_id_service == "8") $num_day_fee_customer=$songay_dihoc+$songay_thu7;*/
				$num_day_fee_customer = $songay_dihoc;
				//nếu có cơ sở dữ liệu thì lấy theo cơ sở giữ liệu
				if($fee_customer['num_day'] != "") $num_day_fee_customer=$fee_customer['num_day'];
			
				
			
				$str_row_student_service .= "<td style='text-align: left;font-weight: bold;padding-right: 15px;'>".$student_service_name."</td>";
				//$str_row_student_service_price .= "<td style='text-align: left;color:#4173f4'>".$student_service_price."</td>";
			
				//lấy các thông tin lien quan đến dịch vụ như: tên biểu phí, id biểu phí...
				$str_hidden_service_name = $this->Template->load_hidden(array("name"=>"data[class_service][$j][service_name]","value"=>$student_service_name));
				$str_hidden_id_service = $this->Template->load_hidden(array("name"=>"data[class_service][$j][id_service]","value"=>$student_id_service));
				
				 	
				//lấy textbox giá
				$str_textbox_price = $this->Template->load_textbox(array("name"=>"data[class_service][$j][price]","value"=>$student_service_price,"style"=>"width: 100px;margin-right: 10px;"));
				
				//lay liên kết để xóa
				$link_xoa_dichvu = $this->Html->link(array("controller"=>"fee","action"=>"arrange"));
				$link_xoa_dichvu .= "/$id_classroom.html?action=del&id_customer=".$fee_customer["id_customer"]."&id_service=$student_id_service&id_fee_customer=".$fee_customer["id"]."&month=".$current_month;
				$link_xoa_dichvu = $this->Template->load_link("del","Xóa",$link_xoa_dichvu,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');","style"=>"margin-top: 10px;"));	
				
				$str_content = $str_textbox_price.$str_hidden_service_name.$str_hidden_id_service;
				
				$str_row_student_service_price .= "<td style='text-align: left;'>".$str_content."<br>".$link_xoa_dichvu."</td>";
			}
			
			$str_hidden_num_day = $this->Template->load_textbox(array("name"=>"data[student_service][num_day]","value"=>$num_day_fee_customer,"style"=>"width:40px"));

			//thêm dòng số ngày đi học
			$str_row_student_service .= "<td>Số ngày</td>";
			$str_row_student_service_price .= "<td style='vertical-align:top !important'>$str_hidden_num_day</td>";
			
			
			//lấy id_fee, fee_name, classname, id_customer, customer_name
			$str_hidden_id_fee = $this->Template->load_hidden(array("name"=>"data[student_service][id_fee]","value"=>$id_fee));
			$str_hidden_fee_name = $this->Template->load_hidden(array("name"=>"data[student_service][fee_name]","value"=>$fee_name));
			$str_hidden_classroom_name = $this->Template->load_hidden(array("name"=>"data[student_service][classroom_name]","value"=>$classroom_name));
			$str_hidden_id_classroom = $this->Template->load_hidden(array("name"=>"data[student_service][id_classroom]","value"=>$id_classroom));
			$str_hidden_id_customer = $this->Template->load_hidden(array("name"=>"data[student_service][id_customer]","value"=>$fee_customer["id_customer"]));
			$str_hidden_month_year = $this->Template->load_hidden(array("name"=>"data[student_service][month_year]","id"=>"month_year_$stt","value"=>""));
			$str_hidden_customer_name = $this->Template->load_hidden(array("name"=>"data[student_service][customer_name]","value"=>$fee_customer["customer_name"]));
			$str_hidden_fee = $str_hidden_id_fee.$str_hidden_fee_name.$str_hidden_classroom_name.$str_hidden_id_classroom.$str_hidden_id_customer.$str_hidden_customer_name.$str_hidden_month_year;
			
			
			$str_combo_student_service = $this->Template->load_selectbox(array("name"=>"data[student_service][id_service]","id"=>"student_id_service_$sodong","onchange"=>" them_dichvu(this,'service_name_$sodong','$sodong')"),$array_dichvu);
			$str_combo_student_service .= $this->Template->load_hidden(array("name"=>"data[student_service][service_name]","id"=>"service_name_$sodong"));
			
			$str_student_service_button_luu = $this->Template->load_button(array("type"=>"submit"),"Lưu");
			
			$str_row_student_service .= "<td style='text-align: left;font-weight: bold;padding-right: 15px;'>Khác</td>";
			$str_row_student_service_price .= "<td style='text-align: left;'>$str_combo_student_service $str_hidden_fee $str_student_service_button_luu </td>";
			
			$str_student_service .= "<tr>$str_row_student_service</tr>";
			$str_student_service .= "<tr>$str_row_student_service_price</tr>";
			
			
			$str_button_copy = str_replace("tmp_id_customer_fee",$fee_customer["id_customer"],$str_button_copy_fee_arrange);

			$str_student_service .= "<tr><td colspan='4'>$str_button_copy</td></tr>";			
			
			$str_student_service .= "</table>";
			
			$str_student_service = $this->Template->load_form(array("method"=>"POST","action"=>"/fee/arrange/$id_classroom.html","id"=>"form_student_service_$j","onsubmit"=>"return submit_form(this,'service_name_$sodong','$sodong')"),$str_student_service);
			
			//thay thê str_tmp_student = stt
			$str_student_service = str_replace("str_tmp_student",$stt,$str_student_service);
			
			$array_row_fee["service"]  	= array($str_student_service,array("style"=>"text-align:left"));

			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			
			//cong don vao chuoi $str_row_fee
			$str_row_fee .= $this->Template->load_table_row($array_row_fee,array("style"=>"background-color:#7bef6b"));
		}
		
		
		
	
     //*****************************************
	//t//lấy danh sách biểu phí của lớp
	//*****************************************
	//lấy các thông tin dịch vụ từ bảng fee_customer
	
		
		
		//Cắt chuỗi theo kí tự dòng
		$kitu_dong = chr(9);
		$array_str_fee_detail = explode($kitu_dong,$str_fee_detail);
		
		$str_service = "<table>";
		$str_row_service = "";
		$str_row_price = "";
		
		$char_seperate = chr(8);
		$so_dichvu = 0;
		
		for($i=0;$i<(count($array_str_fee_detail) - 1);$i++)
		{
			
			//lấy thông tn dịch vụ học sinh
			$tmp_str_service = $array_str_fee_detail[$i];
			
			//cắt thông tin dịch vụ thành mảng
			$array_str_service = explode(chr(8),$tmp_str_service);
			$service_name = "";
			$service_price = 0;
			$id_service = "";
			$service_name = "";
			if(isset($array_str_service[0])) $service_name = $array_str_service[0];
			if(isset($array_str_service[1])) $service_price = $array_str_service[1];
			if(is_numeric( $service_price)) $service_price=number_format($service_price);
			
			if(isset($array_str_service[2])) $id_service = $array_str_service[2];
			$str_row_service .= "<td style='text-align: left;font-weight: bold;padding-right: 15px;'>".$service_name."</td>";
			
			//lấy các thông tin lien quan đến dịch vụ như: tên biểu phí, id biểu phí...
			$str_hidden_service_name = $this->Template->load_hidden(array("name"=>"data[class_service][$i][service_name]","value"=>$service_name));
			$str_hidden_id_service = $this->Template->load_hidden(array("name"=>"data[class_service][$i][id_service]","value"=>$id_service));
			
			//lấy textbox giá
			$str_textbox_price = $this->Template->load_textbox(array("name"=>"data[class_service][$i][price]","value"=>$service_price,"style"=>"width: 100px;margin-right: 10px;"));
			
			
			$str_row_price .= "<td style='text-align: left;'>$str_textbox_price $str_hidden_service_name $str_hidden_id_service</td>";
		}
		$str_hidden_num_day = $this->Template->load_textbox(array("name"=>"data[student_service][num_day]","value"=>$songay_dihoc,"style"=>"width:40px"));

		//thêm dòng số ngày đi học
		$str_row_service .= "<td>Số ngày</td>";
		$str_row_price .= "<td style='vertical-align:top'>$str_hidden_num_day</td>";
		
		$str_hidden_id_fee = $this->Template->load_hidden(array("name"=>"data[student_service][id_fee]","value"=>$id_fee));
		$str_hidden_fee_name = $this->Template->load_hidden(array("name"=>"data[student_service][fee_name]","value"=>$fee_name));
		$str_hidden_classroom_name = $this->Template->load_hidden(array("name"=>"data[student_service][classroom_name]","value"=>$classroom_name));
		$str_hidden_id_classroom = $this->Template->load_hidden(array("name"=>"data[student_service][id_classroom]","value"=>$id_classroom));
		$str_hidden_id_customer = $this->Template->load_hidden(array("name"=>"data[student_service][id_customer]","value"=>"tmp_str_id_customer"));
		$str_hidden_customer_name = $this->Template->load_hidden(array("name"=>"data[student_service][customer_name]","value"=>"tmp_str_customer_name"));
		$str_hidden_month_year = $this->Template->load_hidden(array("name"=>"data[student_service][month_year]","id"=>"month_year_tmp_str_stt","value"=>""));
			
		//lấy dịch vụ khác
		
		$str_hidden_student_service = $str_hidden_id_fee.$str_hidden_fee_name.$str_hidden_classroom_name.$str_hidden_id_classroom.$str_hidden_id_customer.$str_hidden_customer_name.$str_hidden_month_year;
			
		$str_combo_service = $this->Template->load_selectbox(array("name"=>"data[student_service][id_service]","id"=>"id_service_str_tmp_student","onchange"=>" them_dichvu(this,'service_name_str_tmp_student','tmp_str_stt')"),$array_dichvu);
		$str_combo_service .= $this->Template->load_hidden(array("name"=>"data[student_service][service_name]","id"=>"service_name_str_tmp_student"));
		
		$str_button_luu = $this->Template->load_button(array("type"=>"submit"),"Lưu");
		
		
		
		$str_row_service .= "<td style='text-align: left;font-weight: bold;padding-right: 15px;'>Khác</td>";
		$str_row_price .= "<td style='text-align: left;'>$str_combo_service $str_hidden_student_service $str_button_luu</td>";
		
		$str_service .= "<tr>$str_row_service</tr>";
		$str_service .= "<tr>$str_row_price</tr>";
		$str_service .= "</table>";
		
		$str_service = $this->Template->load_form(array("method"=>"POST","action"=>"/fee/arrange/$id_classroom.html","id"=>"form_luu_str_tmp_student","onsubmit"=>"return submit_form(this,'service_name_str_tmp_student','tmp_str_stt')"),$str_service);
		
	//////////////////////////////////////////
	
	
	//////////////////////////////////////////////////
	
	///lấy danh sách học sinh
	
	

	
	
	//Lấy danh sách dịch vụ
	//******************************************************************************
	//buoc 1: tao 1 dòng đầu tiên của table
	$str_class_fee = "";
	if($array_hocsinh)
	{
	
		foreach($array_hocsinh as $hocsinh)
		{
			$stt++;
			$sodong++;
			$array_row_fee = NULL;
			$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_fee["fullname"] 		= array($hocsinh["fullname"],array("style"=>"text-align:left;"));	
			
			//thay thê str_tmp_student = stt
			$str_student_service = str_replace("str_tmp_student",$sodong,$str_service);
			$str_student_service = str_replace("tmp_str_customer_name",$hocsinh["fullname"],$str_student_service);
			$str_student_service = str_replace("tmp_str_id_customer",$hocsinh["id_fullname"],$str_student_service);
			$str_student_service = str_replace("tmp_str_stt",$sodong,$str_student_service);
			
			$array_row_fee["service"]  	= array($str_student_service,array("style"=>"text-align:center"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			
			//cong don vao chuoi $str_row_fee
			$str_class_fee .= $this->Template->load_table_row($array_row_fee);
		}
		
		//buoc 5: dung lam load_table de dữ liệu vào table
		//$str_class_fee =  $this->Template->load_table($str_header_fee.$str_row_fee);
	}
	
	//END Lấy danh sách dịch vụ
	//**********************************************************************************
	
	
	$str_table_fee =  $this->Template->load_table($str_header_fee.$str_row_fee.$str_class_fee);
	echo $str_table_fee;
	
	


	
?>
<form id="form_saochep" action="<?php echo $this->webroot;?>fee/arrange/<?php echo $id_classroom?>.html" method="get">
<input type="hidden" name="id_customer" id="id_customer_source" />
<input type="hidden" name="month_year" id="month_year_source" />
<input type="hidden" name="action" value="copy" />

</form>
<script>
function xem()
{
	document.getElementById("form_hientai").submit();
}
function them_dichvu(selectbox,service_name,stt)
{
	
	id_select = selectbox.id;
	document.getElementById(service_name).value = $("#"+id_select+" :selected").text();
	document.getElementById("month_year_"+stt).value=document.getElementById("month_year").value;
	selectbox.form.submit();
	
}
function submit_form(selectbox,service_name,stt)
{
	
	id_select = selectbox.id;
	
	document.getElementById(service_name).value = $("#"+id_select+" :selected").text();
	document.getElementById("month_year_"+stt).value=document.getElementById("month_year").value;
	return true;
}

function saochep_bieuphi(id_customer_source)
{
	month_year = document.getElementById("month_year").value;
	if(confirm("Bạn có muốn chắc chắn copy biểu phí tháng " + month_year + " cho tất cả các tháng khác không? Nhấn OK để đồng ý!"))
	{
		 document.getElementById("month_year_source").value = month_year; 
		 document.getElementById("id_customer_source").value = id_customer_source; 		 
		 
		 document.getElementById("form_saochep").submit();
		
	}
	
	
}
</script>
