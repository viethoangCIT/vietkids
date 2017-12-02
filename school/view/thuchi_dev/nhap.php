<?php 
	$group="";
	$name="";
	$id_user_receive="";
	$accounts="";
	$debit_account="";
	$issued_date="";
	$amount="";
	$id="";
	$desc="";
	$id_user="";
	$username="";
	$id_customer="";
	$customer_name="";
	$id_project	="";
	$project_name="";
	$id_customer_user = "";
	$type = "";
	$list_user_view = "";
	$id_post = "";
	$post_title = "";
	$id_account_money	="";
	$account_money_name="";
	// Kiểm tra xem mảng array_thuchi có dữ liệu hay không
	if($array_thuchi)
	{
		$id=$array_thuchi["id"];
		$type=$array_thuchi["type"];
		$group=$array_thuchi["group"];
		$name=$array_thuchi["name"];
		$id_user_receive=$array_thuchi["id_user_receive"];
		$accounts=$array_thuchi["accounts"];
		$debit_account=$array_thuchi["debit_account"];
		$issued_date=date("d-m-Y",strtotime($array_thuchi['issued_date']));
		$amount=$array_thuchi["amount"];
		$unit=$array_thuchi["unit"];
		$desc=$array_thuchi["desc"];
		$id_user=$array_thuchi["id_user"];
		$username=$array_thuchi["username"];
		$id_customer=$array_thuchi["id_customer"];
		$customer_name=$array_thuchi["customer_name"];
		$id_project	=$array_thuchi["id_project"];
		$project_name=$array_thuchi["project_name"];
		$id_customer_user = $array_thuchi["id_customer_user"];
		$report = $array_thuchi["report"];
		$list_user_view = $array_thuchi["list_user_view"];
		$id_post = $array_thuchi["id_post"];
		$post_title = $array_thuchi["post_title"];
		$id_account_money	=$array_thuchi["id_account_money"];
		$account_money_name=$array_thuchi["account_money_name"];
	}else{
		$unit = "VNĐ";
		$report = "1";
		
	}
	if($this->get_config("thuchi") == "0") $group = "1";
	$array_type = array("0"=>"Thu", "1"=>"Chi");
	$input_name = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][type]","style"=>"width:10%","onchange"=>"hienthi_nguoithuchi()","id"=>"type"),$array_type,$type);
	$str_form_thuchi = $this->Template->load_form_row(array("title"=>"Loại","input"=>$input_name));
	
	if($this->get_config("thuchi") != "0")
	{
		$array_group = array("0"=>"Nội Bộ", "1"=>"Bên Ngoài");
		$input_group = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][group]","style"=>"width:10%","onchange"=>"hienthi_nhom()","id"=>"group"),$array_group,$group);
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Nhóm","input"=>$input_group));
	}
	//người công ty
	
	$label_nguoicongty = "<span id='span_nguoi_congty'>Tên Người Thu</span>";
	
	if($this->get_config("thuchi") != "0")
	{
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$label_nguoicongty,"input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_user]","id"=>"id_user","style"=>"width:30%"),$array_user,$id_user)));
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][username]","value"=>$username,"id"=>"username"));
	}else
	{
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$label_nguoicongty,"input"=>$this->Template->load_textbox(array("name"=>"data[ThuChi][username]","style"=>"width:30%","value"=>$username))));	
		
	}
	$nguoi_nhan = "<span id='span_nguoinhan'>Tên Người Nộp</span>";
	//$input_name_nguoinhan = "<div id='div_nguoinhan'><input type='text'></div>";
	
	//nếu nội bộ 
	if($group =="" || $group == "0")
	{
		//tên người nhận hoặc nộp lấy từ array_user
		$input_name_nguoinhan = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_user_receive]","id"=>"id_user_receive","style"=>"width:30%"),$array_user,$id_user_receive);
		$input_name_nguoinhan .= $this->Template->load_hidden(array("name"=>"data[ThuChi][name]","id"=>"name","value"=>$name));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$nguoi_nhan,"input"=>$input_name_nguoinhan));
	}else
	{
		//nếu bên ngoài thì lấy danh sách khách hàng và dự án
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tên Khách Hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_customer]","id"=>"id_customer","style"=>"width:30%","onchange"=>"thaydoi_khachhang()"),$array_khachhang,$id_customer)));
		$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][customer_name]","value"=>$customer_name,"id"=>"customer_name"));
		
		if($this->get_config("thuchi_project_view") != "no")
		{
			$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tên Dự Án","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_project]","id"=>"id_project","style"=>"width:30%"),$array_du_an,$id_project)));
			$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][project_name]","value"=>$project_name,"id"=>"project_name"));
		}
		if($this->get_config("thuchi_contract_view") != "no")
		{
			$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Hợp Đồng","input"=>$this->Template->load_selectbox(array("name"=>"data[ThuChi][id_post]","id"=>"id_post","style"=>"width:30%"),$array_hopdong,$id_post)));
			$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][post_title]","value"=>$post_title,"id"=>"post_title"));
		}
		//nếu khách hàng là tổ chức thì tên ngươi nhận hoặc nộp lấy từ arrray nguoilienlac 
		//echo "lọai: ".$loai_khachhang;
		if($loai_khachhang == "1")
		{
			//echo "123";
			//lấy dữ liệu ngươi liên lạc từ bảng nguoi liên lạc
			$input_name_nguoikhachhang = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_customer_user]","id"=>"id_customer_user","style"=>"width:30%"),$array_nguoilienlac,$id_customer_user);
			$input_name_nguoikhachhang .= $this->Template->load_hidden(array("name"=>"data[ThuChi][name]","id"=>"name","value"=>$name));
			$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$nguoi_nhan,"input"=>$input_name_nguoikhachhang));
		}
	}
	
	
	// text ngày
	if($issued_date == "01-01-1970") $issued_date = "";
	$input_ngay = $this->Template->load_textbox(array("name"=>"data[ThuChi][issued_date]","id"=>"issued_date","style"=>"width:80%","value"=>$issued_date));
	$doi_ngaythu_chi = "<span id='label_ngay_thuchi'>Ngày Thu</span>";
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$doi_ngaythu_chi,"input"=>$input_ngay));
	
	// text số lượng
	$input_soluong = $this->Template->load_textbox(array("name"=>"data[ThuChi][amount]","style"=>"width:90%","value"=>$amount));
	$str_form_thuchi .= "<div class='control-group'><div style='float:left;width:30%'>".$this->Template->load_form_row(array("title"=>"Số Tiền","input"=>$input_soluong))."</div>";
	
	// text đơn vị
	
	$input_donvi = $this->Template->load_textbox(array("name"=>"data[ThuChi][unit]","style"=>"width:100px","value"=>$unit));
	$str_form_thuchi .= "<div style='float:left;width:70%'>".$this->Template->load_form_row(array("title"=>"Đơn Vị","input"=>$input_donvi))."</div></div>";
	
	// text mô tả
	$input_mota = $this->Template->load_textarea(array("name"=>"data[ThuChi][desc]","style"=>"width:80%"),$desc);
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Ghi chú","input"=>$input_mota));
	
	if($this->get_config("thuchi") != "0")
	{
		$input_name_taikhoan = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_account_money]","id"=>"id_account_money","style"=>"width:30%"),$array_taikhoan,$id_account_money);
		$input_name_taikhoan .= $this->Template->load_hidden(array("name"=>"data[ThuChi][account_money_name]","id"=>"name","value"=>$account_money_name));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tài Khoản","input"=>$input_name_taikhoan));
		
		$taikhoan_co = "Có";
		$taikhoan_no = "Nợ";
	}else
	{
		$taikhoan_co = "Tài Khoản Có";
		$taikhoan_no = "Tài Khoản Nợ";
	}
	
	
	$input_name_taikhoanco = $this->Template->load_textbox(array("name"=>"data[ThuChi][accounts]","style"=>"width:80%","value"=>$accounts));
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$taikhoan_co,"input"=>$input_name_taikhoanco));
	
	$input_name_taikhoanno = $this->Template->load_textbox(array("name"=>"data[ThuChi][debit_account]","style"=>"width:80%","value"=>$debit_account));
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$taikhoan_no,"input"=>$input_name_taikhoanno));
	
	$array_report = array("0"=>"Không", "1"=>"Có");
	
	$input_name_baocao = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][report]","style"=>"width:10%","id"=>"report"),$array_report,$report);
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Báo Cáo Tài Chính","input"=>$input_name_baocao));
	
	if($this->get_config("thuchi") != "0")
	{
		//tao dong hinh dai dien
		$str_input = $this->Template->load_textbox(array("name"=>"data[ThuChi][profile]","id"=>"profiletxt","value"=>$profile));
		$str_input .=$this->Template->load_upload_bar("profile","select_hinhanh1","upload_hinhanh1","list_hinhanh1","ketqua_upload1");
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Files","input" =>$str_input));
	}
	
	if($this->get_config("thuchi") != "0" && $this->get_config("thuchi_nguoixem") != "no")
	{
	
	$array_header_CheckList =  array("stt"=>array("STT",array("style"=>"text-align:center; width:10%")),
							"str_username"=>array("Tên Người Xem",array("style"=>"text-align:left; width:60%")),
							"list_user_view"=>array("Quyền Xem",array("style"=>"text-align:center; width:25%")),	
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_CheckList = $this->Template->load_table_header($array_header_CheckList);
	
	//Lấy nội dung của bảng định lượng
	
	$str_row_CheckList = "";
	$stt = 0;
	$i = 0;
	
	if($array_user_view)
	{
		foreach($array_user_view as $user_view)
		{
			$str_check_view = "";
			$id_user = ",".$user_view['id'].",";
			
			if(strpos($list_user_view, $id_user) !== false) $str_check_view = "checked";
			
			$str_form_xem = "<input type='checkbox' name='data[ThuChi][check_list][$i][list_user_view]' value='".$user_view['id']."' $str_check_view/>";
			
			$stt++;
			$array_row_CheckList = NULL;
			$array_row_CheckList["stt"] 					= array($stt,array("style"=>"text-align:center;"));
			$array_row_CheckList["str_username"] 				= array($user_view["fullname"]);
			$array_row_CheckList["list_user_view"] 				= array($str_form_xem,array("style"=>"text-align:center;"));
			$i++;
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_CheckList .= $this->Template->load_table_row($array_row_CheckList);
		}
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_row_CheckList =  $this->Template->load_table($str_header_CheckList.$str_row_CheckList,array("style"=>"width:99%;margin-top: 0px;"));
	//buoc 6: hien thi du lieu table ra man hinh
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Danh Sách Người Xem","input"=>$str_row_CheckList));
	}
	
	
	
	$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][trangthai]","id"=>"trangthai","value"=>"0"));
	
	$str_id_thuchi = $this->Template->load_hidden(array("name"=>"data[ThuChi][id]","value"=>$id));
	
	$button =  $this->Template->load_button(array("type"=>"submit","onclick"=>"luu_dulieu()"),"Lưu");
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_thuchi.$button));
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/thuchi/nhap.html","onsubmit"=>"return kiemtra2()"),$str_form_thuchi);
	
	echo $str_form_nhap;
?>

<?php 
if($this->get_config("thuchi") != "0")
{
	echo $this->Template->load_upload_js("profiletxt","profile","select_hinhanh1","upload_hinhanh1","list_hinhanh1","ketqua_upload1","uploader1");
}
?>

<script>

$(function()
{
	$( "#issued_date" ).datepicker({dateFormat: "dd-mm-yy"})
});
<?php
if($this->get_config("thuchi") != "0")
	{
 ?>
function kiemtra2()
{
	document.getElementById("username").value = $("#id_user :selected").text();
	if(document.getElementById("group").value == "0")
	{
		document.getElementById("name").value = $("#id_user_receive :selected").text();
	}else
	{
		document.getElementById("customer_name").value = $("#id_customer :selected").text();
		document.getElementById("project_name").value = $("#id_project :selected").text();
		document.getElementById("name").value = $("#id_customer_user :selected").text();
		document.getElementById("post_title").value = $("#id_post :selected").text();
		document.getElementById("account_money_name").value = $("#id_account_money :selected").text();
	}
	
}
<?php }else
{
?>
function kiemtra2()
{
	
		document.getElementById("customer_name").value = $("#id_customer :selected").text();
		document.getElementById("project_name").value = $("#id_project :selected").text();
		document.getElementById("post_title").value = $("#id_post :selected").text();
	
	
}


<?php 
	
} ?>

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
		if(document.getElementById('span_nguoinhan') != null) document.getElementById('span_nguoinhan').innerHTML = 'Tên Người Nộp';
	}
	else
	{
		document.getElementById('label_ngay_thuchi').innerHTML = 'Ngày Chi';
		document.getElementById('span_nguoi_congty').innerHTML = 'Tên Người Chi';
		if(document.getElementById('span_nguoinhan') != null) document.getElementById('span_nguoinhan').innerHTML = 'Tên Người Nhận';
	}
}
function thaydoi_khachhang()
{
	id_customer = document.getElementById('id_customer').value;
	document.getElementById("form_nhap").submit();
	
}
function hienthi_nhom()
{
	//document.getElementById('nhom').style.display = 'block'; 
	document.getElementById("form_nhap").submit();
	
}
hienthi_nguoithuchi();

</script>