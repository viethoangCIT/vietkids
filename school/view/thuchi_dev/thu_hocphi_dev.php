<style>
/*.ui-datepicker-calendar {display: none;}*/
.ui-widget-header{color: #333333 !important}
</style>

<?php
	$str_row_classroom = "";
	$customer_name = "";
	$month_year = "";
	//$id_customer = "";
	
	if($array_thuchi != NULL)
	{	
		
		$id_classroom = $array_thuchi["id_classroom"];
		$id_customer = $array_thuchi["id_customer"];
		$month_year = date("m-Y",strtotime($array_thuchi["month_year"]));
		$customer_name =  $array_thuchi["customer_name"];
		if($id_classroom == "0") $id_classroom = "";
		
	}
	
	if(isset($_POST['data']['ThuChi']['id_classroom'])) $id_classroom=$_POST['data']['ThuChi']['id_classroom'];

	//Phần chọn lớp học
	$str_hidden_classroom_name = $this->Template->load_hidden(array("name"=>"data[ThuChi][classroom_name]","id"=>"classroom_name"));
	$str_combo_classroom = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_classroom]","id"=>"id_classroom","style"=>"width:200px"),$array_lophoc,$id_classroom);
	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"Lớp học","input"=>$str_combo_classroom.$str_hidden_classroom_name));


	//Phần chọn tháng, năm thu học phí
	$songay_dihoc_dukien=22;
		
	if(isset($_POST['data']['ThuChi']['month_year'])) $month_year=$_POST['data']['ThuChi']['month_year'];
	
	$input_thang_nam = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][month_year]","style"=>"width:131px","id"=>"month_year","onchange"=>"this.form.submit();"),$array_month_year_current_class,$month_year);
	$input_songay = $this->Template->load_textbox(array("name"=>"data[ThuChi][day_number]","style"=>"width:185px","value"=>$songay_dihoc_dukien));
	
	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"Tháng/ Năm học","input"=>$input_thang_nam." <label class='control-label' style='margin:0px 10px'>Số ngày đi học Dự kiến: </label>".$input_songay));

	
	
	
	
	
	//Chọn học sinh		
	if($id_classroom != "" )
	{
		$str_hidden_student_name = $this->Template->load_hidden(array("name"=>"data[ThuChi][customer_name]","id"=>"customer_name"));
		$str_combo_student = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_customer]","id"=>"id_customer","style"=>"width:200px","onchange"=>"this.form.submit()"),$array_hocsinh,$id_customer);
		$str_row_classroom .= $this->Template->load_form_row(array("title"=>$array_title["customer_title"],"input"=>$str_combo_student.$str_hidden_student_name));
	}
	else
	{ 
		$str_row_classroom .= $this->Template->load_hidden(array("name"=>"data[ThuChi][id_customer]","value"=>$id_customer));
	 	$str_row_classroom .= $this->Template->load_form_row(array("title"=>"Tên người nộp","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][customer_name]","value"=>$customer_name))));
	}

	
	//Danh sách biểu phí của học sinh
	if($array_fee_customers != NULL)
	{
		//lấy thông tin dịch vụ của học sinh
		$fee_customer_service = $array_fee_customers[0]["str_service"];
		$array_tmp_fee_customer_service = explode(chr(9),$fee_customer_service);
		$student_service_name = "";
		$student_service_price = "";
		$student_id_service = "";
		$total_price = 0;
		$str_student_service = "<table data-role='table' id='movie-table' data-mode='reflow' class='ui-responsive table table-bordered table-striped' style='border-top:1px solid #dcdcdc;'><thead class='v_mid'>";
		$str_row_student_service = "";
		$str_row_student_service_price = "";
		$col_span = count($array_tmp_fee_customer_service)- 2;
		
		
		//lấy tất cả các dịch vụ học sinh
		
		for($j=0;$j<(count($array_tmp_fee_customer_service)- 1);$j++)
		{
			$tmp_service = $array_tmp_fee_customer_service[$j];
			$array_tmp_service = explode(chr(8),$tmp_service);
			if(isset($array_tmp_service[0])) $student_service_name = $array_tmp_service[0];
			if(isset($array_tmp_service[1])) $student_service_price = $array_tmp_service[1];
			
			$str_row_student_service .= "<th style='text-align: center'>".$student_service_name."</th>";
			
			$str_row_student_service_price .= "<td style='text-align: center;'>".$student_service_price."</td>";
			
			$price = str_replace(",","",$student_service_price);
			$total_price += $price;
		}
		
		$str_student_service .= "<tr>$str_row_student_service</tr></thead>";
		$str_student_service .= "<tbody class='body_mid'><tr>$str_row_student_service_price</tr>";
		$str_student_service .= "<tr><th colspan=$col_span style='color:green'>Tổng tiền:</th><th style='color:red'>".number_format($total_price)."</th></tr></tbody>";
		$str_student_service .= "</table>";
		
		$str_row_classroom .= $str_student_service;
	}
	
	
	
	
	echo $str_row_classroom;


?>

<script>


	//lấy customer name theo id_customer
	 $( "#customer_name" ).val($("#id_customer :selected").text());
	$( "#id_customer" ).change(function() {  $( "#customer_name" ).val($("#id_customer :selected").text());	});
	

	//lấy class room name theo id_classroom
	$( "#classroom_name" ).val($("#id_classroom :selected").text());
	$( "#id_classroom" ).change(function() {  $( "#classroom_name" ).val($("#id_classroom :selected").text());  $( "#form_nhap" ).submit(); 	});
	
	



function thongtin_thu(month_year)
{
	id_customer = $( "#id_customer" ).val();
	id_classroom =  $( "#id_classroom" ).val();
	
	$.ajax({  method: "GET",  url: "/thuchi/add.html",  data: { type: "ajax", act: "thongtin_thu" ,"id_customer": id_customer,"id_classroom":id_classroom,"month_year":month_year,"debug":"code"}})
	.done(function( msg ) {
    	document.getElementById("thongtin_thu").innerHTML = msg;
	});
}

 if(document.getElementById("id_customer").value!='') thongtin_thu(document.getElementById("month_year").value);
</script>