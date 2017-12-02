<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Nhập Biểu Phí";
			
	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	$id = "";
	$name = "";
	$year = "";	
	$from = "";	
	$to = "";	
	$total_price = "";
	$service = "";
	$month = "";
	
	if($array_sua)
	{
		$id = $array_sua[0]["id"];
		$name = $array_sua[0]["name"];
		$year = $array_sua[0]["year"];	
		if($year == "0") $year = "";
		
		$month = $array_sua[0]["month"];	
		if($month == "0") $month = "";
		
		$to = date("d-m-Y",strtotime($array_sua[0]["to"]));
		$from = date("d-m-Y",strtotime($array_sua[0]["from"]));
		
		if($from == "01-01-1970") $from = "";
		if($to == "01-01-1970") $to = "";
	}
	
	$str_form_fee = $this->Template->load_form_row(array("title"=>"Tên biểu phí","input"=>$this->Template->load_textbox(array("name"=>"data[fee][name]","value"=>$name,"style"=>"width:80%"))));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Tháng","input"=>$this->Template->load_textbox(array("name"=>"data[fee][month]","value"=>$month,"style"=>"width:80%"))));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Năm","input"=>$this->Template->load_textbox(array("name"=>"data[fee][year]","value"=>$year,"style"=>"width:80%"))));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Từ ngày","input"=>$this->Template->load_textbox(array("name"=>"data[fee][from]","value"=>$from,"id"=>"from","style"=>"width:30%"))));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Đến ngày","input"=>$this->Template->load_textbox(array("name"=>"data[fee][to]","value"=>$to,"id"=>"to","style"=>"width:30%"))));
	
	//**************************************************************************************
	//lấy danh sách dịch vụ
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_fee =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:5%")),
							"name"=>array("Dịch vụ",array("style"=>"text-align:center;")),
							"price"=>array("Giá",array("style"=>"text-align:center; width:20%")),
							"select"=>array("Áp dụng",array("style"=>"text-align:center; width:10%"))
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_fee = $this->Template->load_table_header($array_header_fee);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table fee
	$str_row_fee = "";
	$stt = 0;
	
	if($array_service)
	{
		foreach($array_service as $service)
		{
			$array_row_fee = NULL;
			$str_form_id = $str_checked = "";
			$service_price = $service["price"];
			$id_service = $service["id"];
			$service_name = $service["name"];
			if(is_numeric($service_price)) $service_price = number_format($service_price);
			else $service_price =  0;
			
			if($array_sua)
			{
				$service_name = $service["service_name"];
				$id_service = $service["id_service"];
				$str_form_id = $this->Template->load_hidden(array("name"=>"data[fee_detail][$stt][id]","value"=>$service["id"]));
				$str_checked = "checked";
			}
			
			$str_form_gia = $this->Template->load_textbox(array("name"=>"data[fee_detail][$stt][price]","value"=>$service_price,"style"=>"width:80%","onkeyup"=>"this.value=FormatNumber(this.value)"));
			$str_form_check = "<input type='checkbox' name=data[fee_detail][$stt][select]' $str_checked>";
			$str_form_id_service = $this->Template->load_hidden(array("name"=>"data[fee_detail][$stt][id_service]","value"=>$id_service));
			$str_form_id_service .= $this->Template->load_hidden(array("name"=>"data[fee_detail][$stt][service_name]","value"=>$service_name));
						
			$stt++;
			$array_row_fee = NULL;
			$array_row_fee["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_fee["name"] 		= array($service_name.$str_form_id_service.$str_form_id,array("style"=>"text-align:left;"));	
			$array_row_fee["price"]  	= array($str_form_gia,array("style"=>"text-align:center;"));
			$array_row_fee["select"]  	= array($str_form_check,array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			
			//cong don vao chuoi $str_row_fee
			$str_row_fee .= $this->Template->load_table_row($array_row_fee);
		}	
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_fee =  $this->Template->load_table($str_header_fee.$str_row_fee);


	
	//**************************************************************************************
	//end lấy danh sách dịch vụ
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"Danh mục","input"=>$str_table_fee));
		
	$str_id_fee = $this->Template->load_hidden(array("name"=>"data[fee][id]","value"=>$id));
	
	$str_form_fee .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_fee.$this->Template->load_button(array("type"=>"submit"),"Lưu")));

	$str_form_fee = $this->Template->load_form(array("method"=>"POST","action"=>"/fee/add.html?debug=code"),$str_form_fee);
	
	echo $str_form_fee;
	
?>
<script>
//khi ấn enter thì xuóng dòng
$('body').on('keydown', 'input, select, textarea', function(e) {
    var self = $(this)
      , form = self.parents('form:eq(0)')
      , focusable
      , next
      ;
    if (e.keyCode == 13) {
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } else {
            form.submit();
        }
        return false;
    }
});
$(function()
{
	$( "#to" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#from" ).datepicker({dateFormat: "dd-mm-yy"})
});

//chuyển giá thành số có ,
var inputnumber = 'Giá trị nhập vào không phải là số';
function FormatNumber(str) {
	var strTemp = GetNumber(str);
	if (strTemp.length <= 3)
		return strTemp;
	strResult = "";
	for (var i = 0; i < strTemp.length; i++)
		strTemp = strTemp.replace(",", "");
	var m = strTemp.lastIndexOf(".");
	if (m == -1) {
		for (var i = strTemp.length; i >= 0; i--) {
			if (strResult.length > 0 && (strTemp.length - i - 1) % 3 == 0)
				strResult = "," + strResult;
			strResult = strTemp.substring(i, i + 1) + strResult;
		}
	} else {
		var strphannguyen = strTemp.substring(0, strTemp.lastIndexOf("."));
		var strphanthapphan = strTemp.substring(strTemp.lastIndexOf("."),
				strTemp.length);
		var tam = 0;
		for (var i = strphannguyen.length; i >= 0; i--) {

			if (strResult.length > 0 && tam == 4) {
				strResult = "," + strResult;
				tam = 1;
			}

			strResult = strphannguyen.substring(i, i + 1) + strResult;
			tam = tam + 1;
		}
		strResult = strResult + strphanthapphan;
	}
	return strResult;
}

function GetNumber(str) {
	var count = 0;
	for (var i = 0; i < str.length; i++) {
		var temp = str.substring(i, i + 1);
		if (!(temp == "," || temp == "." || (temp >= 0 && temp <= 9))) {
			alert(inputnumber);
			return str.substring(0, i);
		}
		if (temp == " ")
			return str.substring(0, i);
		if (temp == ".") {
			if (count > 0)
				return str.substring(0, ipubl_date);
			count++;
		}
	}
	return str;
}

function IsNumberInt(str) {
	for (var i = 0; i < str.length; i++) {
		var temp = str.substring(i, i + 1);
		if (!(temp == "." || (temp >= 0 && temp <= 9))) {
			alert(inputnumber);
			return str.substring(0, i);
		}
		if (temp == ",") {
			return str.substring(0, i);
		}
	}
	return str;
}
</script>
