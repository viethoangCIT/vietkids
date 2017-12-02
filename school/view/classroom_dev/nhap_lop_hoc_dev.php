<!-- Bat dau noi dung -->
<?php
 
	$function_title="Nhập Lớp Học";
	echo $this->Template->load_function_header($function_title);
	
	//neu co id thi lay thong tin classroom
	$name = "";
	$code = "";
	$year = "";
    $des = "";
	$from = "";
	$to = "";
	$id = "";
	$id_classroom = "";
	$classroom_name = "";
	if($arr_classroom_edit != NULL)
	{
		$name = $arr_classroom_edit[0]["name"];
		$des = $arr_classroom_edit[0]["des"];
		$year = $arr_classroom_edit[0]["year"];
		$code = $arr_classroom_edit[0]["code"];
		$id = $arr_classroom_edit[0]["id"];
		$from = $arr_classroom_edit[0]["from"];
		$to = $arr_classroom_edit[0]["to"];
		$id_classroom = $arr_classroom_edit[0]["id_classroom"];
		$classroom_name = $arr_classroom_edit[0]["classroom_name"];
		
	}
	
	if($this->Session->get_flash('save_ok')=='true') echo $this->Template->load_label("Lưu thành công","","success");
	
	$str_row_classroom = $this->Template->load_form_row(array("title"=>" Loại Lớp ","input"=>$this->Template->load_selectbox(array("name"=>"id_classroom","value"=>$id_classroom,"style"=>"width:80%","id"=>"id_classroom"),$arr_lop_hoc,$id_classroom)));
	$str_row_classroom .=  $this->Template->load_hidden(array("name"=>"classroom_name","id"=>"classroom_name","value"=>$classroom_name));
	
	//tên phòng
    $str_input_name = $this->Template->load_textbox(array("name"  => "name","id" => "name", "style" => "width:80%", "value" => $name))."<span id='lbl_name'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array( "title" => "Tên Lớp","input" => $str_input_name));
	
	//mã phòng
    $str_input_code = $this->Template->load_textbox(array("name"  => "code","id" => "code", "style" => "width:80%", "value" => $code))."<span id='lbl_code'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array( "title" => "Mã Lớp","input" => $str_input_code));
																
	//mô tả
	$str_input_des = $this->Template->load_textarea(array("name"  =>"des","id"=>"des","style" =>"width:80%"),$des);
    $str_row_classroom .= $this->Template->load_form_row(array( "title"=>"Mô Tả","input"=>$str_input_des));
	
	//năm
    $str_input_year = $this->Template->load_textbox(array("name"  => "year","id" => "year", "style" => "width:80%", "value" => $year))."<span id='lbl_year'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array( "title" => "Năm","input" => $str_input_year));
	
	//ngay bat dau
	$str_input_from = $this->Template->load_textbox(array("name"  =>"from","id"=>"from", "style" =>"width:80%","value" => $from))."<span id='lbl_from'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array("title"=>"Ngày Bắt Đầu","input"=>$str_input_from)); 
																
	//ngay ket thuc
	$str_input_to = $this->Template->load_textbox(array("name"  =>"to","id"=>"to","style" =>"width:80%","value" => $to))."<span id='lbl_to'></span>";
    $str_row_classroom .= $this->Template->load_form_row(array("title"=>"Ngày Kết Thúc","input"=>$str_input_to));
	
	$str_input_classroom_name = $this->Template->load_hidden(array("name"  => "id","value" => $id));
 															
	$str_input_classroom_btn_add = $this->Template->load_button(array("type"  =>"button","name"  =>"btn_them", 'onclick' => 'kiemtra()'), "Lưu");
  	$str_row_classroom .= $this->Template->load_form_row(array("title" => "", "input"=>$str_input_classroom_btn_add. $str_input_classroom_name ));
																
	$array_form = array("method"=>"POST","action"=>"/classroom/add", "id"=>"str_form");
   	$str_form = $this->Template->load_form($array_form,$str_row_classroom);
	echo  $str_form;
	
	//danh sách lớp học
	//lay html table header
	$array_header_table =array(
							"stt"=>array("STT"),
							"name"=>array("Tên Lớp"), 
							"code"=>array("Mã Lớp"), 
							"des"=>array("Mô Tả"),
							"year"=>array("Năm"),
							"from"=>array("Thời Gian Bắt Đầu"),
							"to"=>array("Thời Gian Kết Thúc"),
							"arrange"=>array("Xếp Lớp"),
							"edit"=>array("Tùy Chọn",array("style"=>"text-align:center; width:11%")),
						);
	$str_table_header=$this->Template->load_table_header($array_header_table);
	
	//lay html noi dung classroom 
	$str_table_content_classroom = "";
	$stt = 1;
	foreach($array_classroom as $classroom)
	{
		$link_sua=$this->Template->load_link("edit","Sửa","/classroom/add?id=".$classroom["id"]);
		$link_xoa=$this->Template->load_link("del","Xóa","/classroom/del?id=".$classroom["id"]);
		$from1 = date("d-m-Y",strtotime($classroom["from"]));
		$to1 = date("d-m-Y",strtotime($classroom["to"]));
		
		$xeplop_hocsinh 	= $this->Html->link(array("controller"=>"classroom","action"=>"arrange","params"=>array($classroom["id"],"tre")));
		$xeplop_hocsinh	= $this->Template->load_link("download","Trẻ ",$xeplop_hocsinh);	
		
		$xeplop_giaovien 	= $this->Html->link(array("controller"=>"classroom","action"=>"arrange","params"=>array($classroom["id"],"giaovien")));
		$xeplop_giaovien	= $this->Template->load_link("download","Giáo viên",$xeplop_giaovien);	
		
		$ap_bieuphi 	= $this->Html->link(array("controller"=>"fee","action"=>"arrange_class","params"=>array($classroom["id"])));
		$ap_bieuphi	= $this->Template->load_link("download","Áp biểu phí",$ap_bieuphi);	
		
		//tao mang noi dung classroom
		$array_classroom=array(
								"stt"=>array($stt++),
								"name"=>array($classroom["name"]),
								"code"=>array($classroom["code"],array("style"=>"text-align: center")),
								"des"=>array($classroom["des"]),
								"year"=>array($classroom["year"],array("style"=>"text-align: center")),
								"from"=>array($from1,array("style"=>"text-align: center")),
								"to"=>array($to1,array("style"=>"text-align: center")),
								"arrange"=>array($xeplop_hocsinh."<br>".$xeplop_giaovien),
								"edit"=>array($ap_bieuphi."<br>".$link_sua."<br>".$link_xoa));
		//lay html row classroom
		$str_table_content_classroom.=$this->Template->load_table_row($array_classroom);
	}
	
	//lay html table classroom
	$str_table_classroom=$this->Template->load_table($str_table_header. $str_table_content_classroom,array("style" =>"width:100%"));
	echo $str_table_classroom;
	
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
	
	$(function()
	{	
		//đoạn java script biến input có id=from, khi click vào sẽ hiển thị datepicker
		$( "#from" ).datepicker({dateFormat: "dd-mm-yy"});
		
		//đoạn java script biến input có id=to, khi click vào sẽ hiển thị datepicker
		$( "#to" ).datepicker({dateFormat: "dd-mm-yy"});
		
	});
	function kiemtra()
	{
		input_name = document.getElementById("name");
		input_from = document.getElementById("from");
		input_to = document.getElementById("to");
		
		if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập tên lớp";
			return;
		}
		if(input_from.value == ""){
			document.getElementById("lbl_from").innerHTML = "Vui lòng nhập ngày bắt đầu";
			return;
		}
		if(input_to.value == ""){
			document.getElementById("lbl_to").innerHTML = "Vui lòng nhập ngày kết thúc";
			return;
		}
		document.getElementById("classroom_name").value=$("#id_classroom :selected").text();
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
</script>