<!-- Bat dau noi dung -->
<?php
 
	$function_title="Nhập Loại Lớp Học";
	echo $this->Template->load_function_header($function_title);
	
	//neu co id thi lay thong tin classroom_type
	$name = "";
	$code = "";
    $des = "";
	$id = "";
	if($arr_classroom_type_edit != NULL)
	{
		$name = $arr_classroom_type_edit[0]["name"];
		$des = $arr_classroom_type_edit[0]["des"];
		$code = $arr_classroom_type_edit[0]["code"];
		$id = $arr_classroom_type_edit[0]["id"];
		
	}
	
	//tên loại phòng
    $str_input_name = $this->Template->load_textbox(array("name"  => "name","id" => "name", "style" => "width:80%", "value" => $name))."<span id='lbl_name'></span>";
    $str_row_classroom = $this->Template->load_form_row(array( "title" => "Tên Loại","input" => $str_input_name));
	
	//mã 
    $str_input_code = $this->Template->load_textbox(array("name"  => "code","id" => "code", "style" => "width:80%", "value" => $code))."<span id='lbl_code'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array( "title" => "Mã","input" => $str_input_code));
																
	//mô tả
	$str_input_des = $this->Template->load_textarea(array("name"  =>"des","id"=>"des","style" =>"width:80%"),$des);
    $str_row_classroom .= $this->Template->load_form_row(array( "title"=>"Mô Tả","input"=>$str_input_des));
	
	
	$str_input_classroom_name = $this->Template->load_hidden(array("name"  => "id","value" => $id));
 															
	$str_input_classroom_btn_add = $this->Template->load_button(array("type"  =>"button","name"  =>"btn_them", 'onclick' => 'kiemtra()'), "Lưu");
  	$str_row_classroom .= $this->Template->load_form_row(array("title" => "", "input"=>$str_input_classroom_btn_add. $str_input_classroom_name ));
																
	$array_form = array("method"=>"POST","action"=>"/classroom/add_classroom_type", "id"=>"str_form");
   	$str_form = $this->Template->load_form($array_form,$str_row_classroom);
	echo  $str_form;
	
	//lấy danh sách loại lớp học
	//lay html table header
	$array_header_table =array(
							"stt"=>array("STT"),
							"name"=>array("Tên Lớp"), 
							"code"=>array("Mã Lớp"), 
							"des"=>array("Mô Tả"),
							"edit"=>array("Sửa",array("style"=>"width: 7%")),
							"del"=>array("Xóa",array("style"=>"width: 7%")),
						);
	$str_table_header=$this->Template->load_table_header($array_header_table);
	
	//lay html noi dung classroom_type 
	$str_table_content_classroom_type = "";
	$stt = 1;
	foreach($array_classroom_type as $classroom_type)
	{
		$link_sua=$this->Template->load_link("edit","Sửa","/classroom/add_classroom_type?id=".$classroom_type["id"]);
		$link_xoa=$this->Template->load_link("del","Xóa","/classroom/del_classroom_type?id=".$classroom_type["id"]);
		//tao mang noi dung classroom_type
		$array_classroom_type=array(
								"stt"=>array($stt++,array("style"=>"text-align: center")),
								"name"=>array($classroom_type["name"]),
								"code"=>array($classroom_type["code"],array("style"=>"text-align: center")),
								"des"=>array($classroom_type["des"]),
								"edit"=>array($link_sua),
								"del"=>array($link_xoa)
								);
		//lay html row classroom_type
		$str_table_content_classroom_type.=$this->Template->load_table_row($array_classroom_type);
	}
	
	//lay html table classroom
	$str_table_classroom_type=$this->Template->load_table($str_table_header. $str_table_content_classroom_type,array("style" =>"width:100%"));
	echo $str_table_classroom_type;
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
		
		if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập";
			return;
		}
		
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
</script>