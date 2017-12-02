<?php 
	$function_title="Nhập Thu Chi";
	echo $this->Template->load_function_header($function_title);

	$issued_date="";
	$id="";
	$desc="";
	$id_username="";
	$username="";
	$id_student="";
	$student_name="";
	$id_classroom	="";
	$classroom_name="";
	$type = "";
	$semester	="";
	$year="";
	$month = "";
	
	// Kiểm tra xem mảng array_thuchi có dữ liệu hay không
	if($array_thuchi)
	{
		$id=$array_thuchi["id"];
		$type=$array_thuchi["type"];
		$id_username=$array_thuchi["id_username"];
		$username=$array_thuchi["username"];
		$id_student=$array_thuchi["id_student"];
		$student_name=$array_thuchi["student_name"];
		$id_classroom=$array_thuchi["id_classroom"];
		$issued_date=date("d-m-Y",strtotime($array_thuchi['issued_date']));
		$classroom_name=$array_thuchi["classroom_name"];
		$unit=$array_thuchi["unit"];
		$desc=$array_thuchi["desc"];
		$semester=$array_thuchi["semester"];
		$year=$array_thuchi["year"];
		$month=$array_thuchi["month"];
	}else{
		$unit = "VNĐ";
	}
	
	$array_type = array("0"=>"Thu", "1"=>"Chi thường", "2"=>"Chi trả tiền cho trẻ thôi học");
	$input_name = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][type]","style"=>"width:30%","onchange"=>"hienthi_nguoithuchi()","id"=>"type"),$array_type,$type);
	$str_form_thuchi = $this->Template->load_form_row(array("title"=>"Loại","input"=>$input_name));
	
	$label_nguoicongty = "<span id='span_nguoi_congty'>Tên Người Thu</span>";
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$label_nguoicongty,"input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_username]","id"=>"id_username","style"=>"width:30%"),$array_nguoithu,$id_username)));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][username]","value"=>"","id"=>"username"));
	
	$str_form_thuchi .= "<div id='hien_thu'>".$this->Template->load_form_row(array("title"=>"Chọn Lớp","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_classroom]","id"=>"id_classroom","style"=>"width:30%"),$array_lop_hoc,$id_classroom)));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][classroom_name]","value"=>$classroom_name,"id"=>"classroom_name"));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Chọn Trẻ","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_student]","id"=>"id_student","style"=>"width:30%"),$array_hocsinh,$id_student)));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][student_name]","value"=>$student_name,"id"=>"student_name"));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Kỳ Học","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][semester]","style"=>"width:80%","value"=>$semester))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Năm Học","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][year]","style"=>"width:80%","value"=>$year))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tháng","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][month]","style"=>"width:80%","value"=>$month))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Ngày","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][date]","style"=>"width:80%","value"=>""))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Tiền Thừa","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][tienthua]","style"=>"width:30%","value"=>""))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Tiền Thiếu","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][tienthua]","style"=>"width:30%","value"=>""))));
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tiền Sữa dư","input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][tienthua]","style"=>"width:30%","value"=>""))))."</div>";
	
	// text ngày
	if($issued_date == "01-01-1970") $issued_date = "";
	$input_ngay = $this->Template->load_textbox(array("name"=>"data[ThuChi][issued_date]","id"=>"issued_date","style"=>"width:80%","value"=>$issued_date));
	$doi_ngaythu_chi = "<span id='label_ngay_thuchi'>Ngày Thu</span>";
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$doi_ngaythu_chi,"input"=>$input_ngay));
	
	// text số tiền
	$input_soluong = $this->Template->load_textbox(array("name"=>"data[ThuChi][price]","style"=>"width:90%","value"=>$price));
	$str_form_thuchi .= "<div class='form-group' style='margin-left: 99px;'><div style='float:left;width:52%'>".$this->Template->load_form_row(array("title"=>"Số Tiền","input"=>$input_soluong))."</div>";
	
	// text đơn vị
	$input_donvi = $this->Template->load_textbox(array("name"=>"data[ThuChi][unit]","style"=>"width:214px","value"=>$unit));
	$str_form_thuchi .= "<div style='float:left;width:48%'>".$this->Template->load_form_row(array("title"=>"Đơn Vị","input"=>$input_donvi))."</div></div>";
	
	// text mô tả
	$input_mota = $this->Template->load_textarea(array("name"=>"data[ThuChi][desc]","style"=>"width:80%"),$desc);
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Ghi chú","input"=>$input_mota));
	
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][trangthai]","id"=>"trangthai","value"=>"0"));
	
	$str_id_thuchi = $this->Template->load_hidden(array("name"=>"data[ThuChi][id]","value"=>$id));
	
	$button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu_dulieu()"),"Lưu");
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_thuchi.$button));
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/revenue/add.html","onsubmit"=>"return kiemtra2()"),$str_form_thuchi);
	
	echo $str_form_nhap;
	
	//////////////////////////////////////////////
	//danh sách thu chi
	//buoc 1: tao 1 dòng đầu tiên của table
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"type"=>array("Loại",array("style"=>"text-align:center; width:5%")),
							"username"=>array("Người Thu",array("style"=>"text-align:center; width:10%")),	
							"classroom"=>array("Lớp",array("style"=>"text-align:center")),
							"thongtin_lop"=>array("Thông Tin Lớp",array("style"=>"text-align:center; width:11%")),
							"student_name"=>array("Tên",array("style"=>"text-align:center")),
							"issued_date"=>array("Ngày",array("style"=>"text-align:center; width:10%")),
							"price"=>array("Số Tiền",array("style"=>"text-align:center; width:10%")),
							"tuychon"=>array("Tùy Chọn",array("style"=>"text-align:center; width:8%")),											
					);
	
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);

	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	
	if($array_quanly_thuchi != NULL)
	{
		foreach($array_quanly_thuchi as $thuchi)
		{
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_product["type"] 			= array($array_type[$thuchi["type"]],array("style"=>"text-align:center;"));
			
			$array_row_product["username"] 	= array($thuchi["username"],array("style"=>"text-align:left;"));
				
			$array_row_product["classroom"] 				= array($thuchi["classroom"],array("style"=>"text-align:left;"));
			
			$thongtin_lop = "Kỳ học: ".$thuchi["semester"]."<br>Năm học: ".$thuchi["year"]."<br>Tháng: ".$thuchi["month"];
			$array_row_product["thongtin_lop"] 		= array($thongtin_lop,array("style"=>"text-align:left;"));
			$array_row_product["student_name"] 	= array($thuchi["student_name"],array("style"=>"text-align:center;"));
			
			$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
			if($issued_date == "01-01-1970") $issued_date = "";
			$array_row_product["issued_date"] 	= array($issued_date,array("style"=>"text-align:center;"));
			
			$array_row_product["price"] 		= array(number_format($thuchi["price"])." ".$thuchi["unit"],array("style"=>"text-align:center;"));
			
			
			$link_sua 	= $this->Html->link(array("controller"=>"revenue","action"=>"add","params"=>array($thuchi["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			
			$link_xoa 				= $this->Html->link(array("controller"=>"revenue","action"=>"del","params"=>array($thuchi["id"])));
			$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa);	
			
			$array_row_product ["tuychon"]  		= array($link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
			
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
		
		//buoc 5: dung lam load_table de dữ liệu vào table
		$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_thuchi"));
		//buoc 6: hien thi du lieu table ra man hinh
		echo $str_table_product;
	}
?>
<script>

$(function()
{
	$( "#issued_date" ).datepicker({dateFormat: "dd-mm-yy"})
});

function kiemtra2()
{
	document.getElementById("username").value = $("#id_username :selected").text();
	document.getElementById("student_name").value = $("#id_student :selected").text();
	document.getElementById("classroom_name").value = $("#id_classroom :selected").text();
}

function luu_dulieu()
{
	document.getElementById('trangthai').value = '1';
	document.getElementById("form_nhap").submit();
}
function hienthi_nguoithuchi()
{
	type = document.getElementById('type').value;
	if(type == "0")
	{
		document.getElementById('label_ngay_thuchi').innerHTML = 'Ngày Thu';
		document.getElementById('span_nguoi_congty').innerHTML = 'Tên Người Thu';
		document.getElementById('hien_thu').style.display = 'block';
	}
	else
	{
		document.getElementById('label_ngay_thuchi').innerHTML = 'Ngày Chi';
		document.getElementById('span_nguoi_congty').innerHTML = 'Tên Người Chi';
		document.getElementById('hien_thu').style.display = 'none';
	}
}

</script>