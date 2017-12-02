<?php

	$function_title="Nhập Dịch Vụ";
	echo $this->Template->load_function_header($function_title);
	
	//neu co id thi lay thong tin classroom_service
	$name = "";
    $des = "";
	$price = "";
	$id = "";
	$order_number = "0";
	$code = "";
	if($arr_classroom_service_edit != NULL)
	{
		$name = $arr_classroom_service_edit[0]["name"];
		$order_number = $arr_classroom_service_edit[0]["order_number"];
		$des = $arr_classroom_service_edit[0]["des"];
		$price = $arr_classroom_service_edit[0]["price"];
		$id = $arr_classroom_service_edit[0]["id"];
		$code = $arr_classroom_service_edit[0]["code"];
		
	}
	
	//tên dịch vụ
    $str_input_name = $this->Template->load_textbox(array("name"  => "name","id" => "name", "style" => "width:80%", "value" => $name))."<span id='lbl_name'></span>";
    $str_row_classroom_service = $this->Template->load_form_row(array( "title" => "Tên Dịch Vụ","input" => $str_input_name));
			
	//giá
    $str_input_price = $this->Template->load_textbox(array("name"  => "price","id" => "price", "style" => "width:80%", "value" => $price))."<span id='lbl_price'></span>";
    $str_row_classroom_service .= $this->Template->load_form_row(array( "title" => "Giá","input" => $str_input_price));		
																
	//mô tả
	$str_input_des = $this->Template->load_textarea(array("name"  =>"des","id"=>"des","style" =>"width:80%"),$des);
    $str_row_classroom_service .= $this->Template->load_form_row(array( "title"=>"Mô Tả","input"=>$str_input_des));
	
	//số thứ tự
    $str_input_order_number = $this->Template->load_textbox(array("name"  => "order_number","id" => "order_number", "style" => "width:80%", "value" => $order_number))."<span id='lbl_order_number'></span>";
    $str_row_classroom_service .= $this->Template->load_form_row(array( "title" => "Số Thứ Tự","input" => $str_input_order_number));
	
	
	//mã dịch vụ
    $str_input_service_code = $this->Template->load_textbox(array("name"  => "code","id" => "code", "style" => "width:80%", "value" => $code))."<span id='lbl_code'></span>";
    $str_row_classroom_service .= $this->Template->load_form_row(array( "title" => "Mã dịch vụ","input" => $str_input_service_code));
		
	$str_input_classroom_service_name = $this->Template->load_hidden(array("name"  => "id","value" => $id));
 															
	$str_input_classroom_service_btn_add = $this->Template->load_button(array("type"  =>"button","name"  =>"btn_them", 'onclick' => 'kiemtra()'), "Lưu");
  	$str_row_classroom_service .= $this->Template->load_form_row(array("title" => "", "input"=>$str_input_classroom_service_btn_add. $str_input_classroom_service_name ));
																
	$array_form = array("method"=>"POST","action"=>"/classroom_service/add", "id"=>"str_form");
   	$str_form = $this->Template->load_form($array_form,$str_row_classroom_service);
	echo  $str_form;
	
	//lay html table header
	$array_header_table =array(
							"stt"=>array("STT"),
							"name"=>array("Tên Dịch Vụ"), 
							"des"=>array("Mô Tả"),
							"price"=>array("Giá"),
							"code"=>array("Mã dịch vụ"),							
							"edit"=>array("Sửa",array("style"=>"text-align:center; width:7%")),
							"del"=>array("Xóa",array("style"=>"text-align:center; width:7%")),
						);
	$str_table_header=$this->Template->load_table_header($array_header_table);
	
	//lay html noi dung classroom_service 
	$str_table_content_classroom_service = "";
	$stt = 1;
	$tongcong = 0;
	foreach($array_classroom_service as $classroom_service)
	{
		$link_sua=$this->Template->load_link("edit","Sửa","/classroom_service/add?id=".$classroom_service["id"]);
		$link_xoa=$this->Template->load_link("del","Xóa","/classroom_service/del?id=".$classroom_service["id"]);
	
		//tao mang noi dung classroom_service
		$array_classroom_service=array(
								"stt"=>array($stt++,array("style"=>"text-align:center;")),
								"name"=>array($classroom_service["name"]),
								"des"=>array($classroom_service["des"]),
								"price"=>array(number_format($classroom_service["price"]),array("style"=>"text-align:center;")),
								"code"=>array($classroom_service["code"]),								
								"edit"=>array($link_sua),
								"del"=>array($link_xoa)
								);
		
		$tongcong += $classroom_service["price"];						
								
		//lay html row classroom_service
		$str_table_content_classroom_service.=$this->Template->load_table_row($array_classroom_service);
	}
	
	
	
	//lay html table classroom_service
		$str_table_classroom_service=$this->Template->load_table($str_table_header. $str_table_content_classroom_service,array("style" =>"width:100%"));
		echo $str_table_classroom_service;
		
	//end function content
?>


<script type="text/javascript">
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

	function kiemtra()
	{
		input_name = document.getElementById("name");
		input_des = document.getElementById("des");
		input_price = document.getElementById("price");
		

		 if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập tên dịch vụ";
			return;
		}
		if(input_price.value == ""){
			document.getElementById("lbl_price").innerHTML = "Vui lòng nhập giá";
			return;
		}
		
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
	
	
	
</script>
