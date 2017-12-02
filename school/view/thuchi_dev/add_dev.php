	<?php 
	$id="";
	
	$type = "";
	$username_receive="";
	$id_user_receive="";
	$accounts="";
	$debit_account="";
	$issued_date="";
	$amount="";
	$desc="";
	$profile="";
	
	$id_user="";
	if(isset($_POST['data']['ThuChi']['id_user'])) $id_user=$_POST['data']['ThuChi']['id_user'];
	
	$username="";
	$id_customer="";
	$customer_name="";
	$id_project	="";
	$project_name="";
	$id_customer_user = "";
	$list_user_view = "";
	$id_post = "";
	$post_title = "";
	$id_account_money	="";
	$account_money_name="";
	$issued_date=date("d-m-Y");
	
	
	$id_thuchi_group="";
	if(isset($_POST['data']['ThuChi']['id_group'])) $id_thuchi_group=$_POST['data']['ThuChi']['id_group']; 
	
	
	array_unshift($array_user,"...");
	
	
	
	// Kiểm tra xem mảng array_thuchi có dữ liệu hay không
	if($array_thuchi)
	{
		$id=$array_thuchi["id"];
		$num=$array_thuchi["num"];
		$type=$array_thuchi["type"];
		$id_thuchi_group=$array_thuchi["id_group"];
		$group_name=$array_thuchi["group_name"];
		$type_account=$array_thuchi["type_account"];
		$username_receive=$array_thuchi["username_receive"];
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
	//echo "array";
	//print_r($array_thuchi);
	
	
	
	//có nội dung thu chi số chứng từ không
	$str_form_thuchi="";
	if($this->get_config("thuchi_num") == "yes")
	{
		$input_sochungtu = $this->Template->load_textbox(array("name"=>"data[ThuChi][num]","id"=>"num","value"=>$num,"style"=>"width:200px"));
		$input_ngay = $this->Template->load_textbox(array("name"=>"data[ThuChi][issued_date]","id"=>"issued_date","style"=>"width:113px","value"=>$issued_date));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số chứng từ","input"=>$input_sochungtu." <label class='control-label' style='margin:0px 10px'>Ngày Chứng từ: </label>".$input_ngay));
		
		$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][type_account]","id"=>"type_account","value"=>$type_account));
		
	
	}
	//end kiểm tra số chứng từ
	//////////////////////////////////////////////////
	
	
	$str_param = "";
	
	//********************************************************
	//kiểm tra có tham số type hay không
	  $str_hidden_loai_thuchi = "";
	  $loai_thuchi = "";
	  $is_get_type = false;
	  if(isset($_GET["type"]))
	  {
		  //nếu có thì ẩn loại thu chi, tạo trường hidden làm giá trị mặc định
		  if($_GET["type"] == "0" || $_GET["type"] == "1")
		  {
			  $loai_thuchi = $_GET["type"];	
			  $is_get_type = true;
			  $str_param = "type=$loai_thuchi";
		  }
	  }else
	  {
		  //nếu không có tham số thì lấy giá trị từ CSDL
		  if($id != "") $loai_thuchi = $type;
	  }
	  
	  if($is_get_type == true)
	  {
		  $str_hidden_loai_thuchi = $this->Template->load_hidden(array("name"=>"data[ThuChi][type]","id"=>"type","value"=>$loai_thuchi));	
	  }
	  else
	  {
		  //nếu không có thì hiện loại thu chi
		  $array_type = array("0"=>"Thu", "1"=>"Chi");
		  $input_name = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][type]","style"=>"width:10%","onchange"=>"hienthi_nguoithuchi()","id"=>"type"),$array_type,$loai_thuchi);
		  $str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Loại Phiếu","input"=>$input_name));
	  }
	
		
			
	//kết thúc phần xử lý tham số type
	//*****************************************************************************************
	
	
	
	
	//xử lý có nhóm thu chi hay không
	if($this->get_config("thuchi_group") == "yes")
	{
		$str_select_group = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_group]","style"=>"width:300px","id"=>"id_thuchi_group","onchange"=>"hienthi_nhom()"),$array_thuchi_group,$id_thuchi_group);
		$thuchi_group_label = $this->get_config("thuchi_group_label");
		if($thuchi_group_label == "thuchi_group_label") $thuchi_group_label = "Nhóm ";
		
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$thuchi_group_label,"input"=>$str_select_group));
		$str_form_thuchi .= $this->Template->load_hidden(array("name"=>"data[ThuChi][group_name]","id"=>"group_name"));
	}
	//END xử lý có nhóm thu chi hay không
	////////////////////////////////////////
	
	$type_account = "";
	if(isset($_GET["type_account"])) $type_account = $_GET["type_account"];
	if($type_account!="")
	{
		if($str_param != "") $str_param .= "&";
		
	 	$str_param.= "type_account=$type_account";
		
	}
	
	
	$type = "";
	if(isset($_GET['type'])) $type=$_GET['type'];
	
	
	//nếu có tham số group thì bổ sung vào tham số trong form
	if(isset($_GET["group"]))
	{
		if($str_param != "") $str_param .= "&";
		$str_param.= "group=".$_GET["group"];
	}
	
	
	echo $this->Template->load_function_header($array_title["function_title"]);
	//******************
	//kết thúc phần xử lý tiêu đề vào người thục hiện
	///////////////////////////////////////////////////////////////////////////////////////////////

	
	
	//hiển thị người thực hiện
	$str_hidden_username = $this->Template->load_hidden(array("name"=>"data[ThuChi][username]","value"=>$username,"id"=>"username"));
	$str_combo_user = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_user]","id"=>"id_user","style"=>"width:200px"),$array_user,$id_user);
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$array_title["user_title"],"input"=>$str_combo_user.$str_hidden_username));
	

	//hiển thị người giao dịch
	////////////////////////////////////////////////////////////////
	// XỬ LÝ MÃ CỦA LOẠI HÌNH PHIẾU THU, CHI
	//CÁC MÃ NHÓM HIỆN CÓ: 
	//1.Nội bộ (noibo): đối tượng sẽ thu là người nội bộ 
	//2.Học phí (hocphi): đối tượng sẽ thu là lớp, học sinh
	//3.Kinh doanh (kinhdoanh): đối tượng sẽ thu là khách hàng, người liên hệ khách hàng, dự án, hợp đồng
	//4.Khác (khac): hiển thị textbox để nhập
	//
	/////////////////////////////////////////////////////////////////
	
	$str_form_thuchi .= $str_doituong_thu;
	
	//KẾT THÚC PHẦN ĐỐI TƯỢNG THU
	//////////////////////////////////////////////////////////////
	
	// text số tiền
	$input_sotien = $this->Template->load_textbox(array("name"=>"data[ThuChi][amount]","style"=>"width:200px","value"=>number_format(+$amount),"onkeyup"=>"format_textbox_to_currency(this)","id"=>"amount"));
	//$str_form_thuchi .= "<div class='form-group' style='margin-left:99px'><div style='float:left;width:52%'>".$this->Template->load_form_row(array("title"=>"Số Tiền","input"=>$input_soluong))."</div>";
	
	// text đơn vị
	$input_donvi = $this->Template->load_textbox(array("name"=>"data[ThuChi][unit]","style"=>"width:70px","value"=>$unit));
	//$str_form_thuchi .= "<div style='float:left;width:48%'>".$this->Template->load_form_row(array("title"=>"Đơn Vị","input"=>$input_donvi))."</div></div>";
	
	if($this->get_config("thuchi_add_dvt") != "no") 	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Tiền","input"=>$input_sotien." <label class='control-label' style='margin:0px 10px'>Đơn Vị: </label>".$input_donvi."<span id='thongtin_thu'></span>"));
	else $str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Tiền","input"=>$input_sotien));
	
	// text mô tả
	$input_mota = $this->Template->load_textarea(array("name"=>"data[ThuChi][desc]","style"=>"width:446px"),$desc);
	
	$str_thuchi_desc_label = $this->get_config("thuchi_desc");
	if($str_thuchi_desc_label == "thuchi_desc") $str_thuchi_desc_label = "Diễn giải";
	
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$str_thuchi_desc_label,"input"=>$input_mota));
	
	if($this->get_config("thuchi_account_money") == "yes")
	{
		$input_name_taikhoan = $this->Template->load_selectbox(array("name"=>"data[ThuChi][id_account_money]","id"=>"id_account_money","style"=>"width:30%"),$array_taikhoan,$id_account_money);
		$input_name_taikhoan .= $this->Template->load_hidden(array("name"=>"data[ThuChi][account_money_name]","id"=>"name","value"=>$account_money_name));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Tài Khoản","input"=>$input_name_taikhoan));
	}
	
	
	if($this->get_config("thuchi_account_debt") == "yes")
	{	
		$taikhoan_co = "Có";
		$taikhoan_no = "Nợ";
		$input_name_taikhoanco = $this->Template->load_textbox(array("name"=>"data[ThuChi][accounts]","style"=>"width:80%","value"=>$accounts));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$taikhoan_co,"input"=>$input_name_taikhoanco));
		
		$input_name_taikhoanno = $this->Template->load_textbox(array("name"=>"data[ThuChi][debit_account]","style"=>"width:80%","value"=>$debit_account));
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$taikhoan_no,"input"=>$input_name_taikhoanno));
	}
	
	if($this->get_config("thuchi_report") == "yes")
	{
		$report_label = "Báo Cáo Tài Chính";
		$thuchi_report_label = $this->get_config("thuchi_report_label");
		if($thuchi_report_label != "thuchi_report_label") $report_label = $thuchi_report_label;
		
		$array_report = array("0"=>"Không", "1"=>"Có");
		
		$input_name_baocao = $this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][report]","style"=>"width:10%","id"=>"report"),$array_report,$report);
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>$report_label,"input"=>$input_name_baocao));
	}
	
	if($this->get_config("thuchi_upload") == "yes")
	{
		//tao dong hinh dai dien
		$str_input = $this->Template->load_textbox(array("name"=>"data[ThuChi][profile]","id"=>"profiletxt","value"=>$profile));
		$str_input .=$this->Template->load_upload_bar("profile","select_hinhanh1","upload_hinhanh1","list_hinhanh1","ketqua_upload1");
		$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Files","input" =>$str_input));
	}
	
	if($this->get_config("thuchi_user_view ") == "yes")
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
	
	$str_hidden = $str_id_thuchi.$str_hidden_loai_thuchi;
	
	$button =  $this->Template->load_button(array("type"=>"button","onclick"=>"kiemtra()"),"Lưu");
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"","input"=>$button.$str_hidden));
	
	
	if($str_param != "") $str_param = "?$str_param";
	
	
	$str_param_id="";
	if($id != "") $str_param_id="/".$id;
		 
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/thuchi/add".$str_param_id.".html$str_param"),$str_form_thuchi);
	
	echo $str_form_nhap;
	
	
	//*********************************************************************************
	//danh sách thu chi
	if($this->get_config("thuchi_list") == "yes")
	{
		echo $view_thuchi_list;
		if($loai_thuchi == 0)
		{
			if($account_type == "debt")
			{ 
				$timkiem_nguoithuchi = "Người thu";
				$timkiem_nguoinhan = "Người nợ";
			}
			if($account_type == "deposit")
			{ 
				$timkiem_nguoithuchi = "Người chi";
				$timkiem_nguoinhan = "Người tạm ứng";
			}
		}
		else
		{
			if($account_type == "debt")
			{ 
				$timkiem_nguoithuchi = "Người nhập";
				$timkiem_nguoinhan = "Người nhận";
			}
			if($account_type == "deposit")
			{ 
				$timkiem_nguoithuchi = "Người thu";
				$timkiem_nguoinhan = "Người hoàn ứng";
			}
		}
		
	}//thu chi list
	
?>

<?php 
if($this->get_config("thuchi_upload") == "yes")
{
	echo $this->Template->load_upload_js("profiletxt","profile","select_hinhanh1","upload_hinhanh1","list_hinhanh1","ketqua_upload1","uploader1");
}
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

//lấy group name theo giá trị id_group
	
	$( "#group_name" ).val($("#id_thuchi_group :selected").text());
	$( "#id_thuchi_group" ).change(function() {  $( "#group_name" ).val($("#id_thuchi_group :selected").text());	});

//lấy user name theo giá trị của id_user
	
	$( "#username" ).val($("#id_user :selected").text());
	$( "#id_user" ).change(function() {  $( "#username" ).val($("#id_user :selected").text());	});
$(function()
{
	$( "#issued_date" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
});

function kiemtra()
{
	
	document.getElementById('trangthai').value = 'save';
	
	document.getElementById("form_nhap").submit();

}


function hienthi_nguoithuchi()
{
	if(document.getElementById('type') != null) type = document.getElementById('type').value;
	if(type == "0")
	{
		document.getElementById('label_ngay_thuchi').innerHTML = 'Ngày Thu';
		if(document.getElementById('span_nguoi_congty') != null) document.getElementById('span_nguoi_congty').innerHTML = 'Tên Người Thu';
		if(document.getElementById('span_nguoinhan') != null) document.getElementById('span_nguoinhan').innerHTML = 'Tên Người Nộp';
	}
	else
	{
		document.getElementById('label_ngay_thuchi').innerHTML = 'Ngày Chi';
		if(document.getElementById('span_nguoi_congty') != null) document.getElementById('span_nguoi_congty').innerHTML = 'Tên Người Chi';
		if(document.getElementById('span_nguoinhan') != null) document.getElementById('span_nguoinhan').innerHTML = 'Tên Người Nhận';
	}
}
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function format_textbox_to_currency(textbox_obj)
{
	sotien =  textbox_obj.value ;
	sotien = sotien.replace(/,/g , "");
	if (sotien == null) sotien=0;
	if (sotien == '') sotien=0;
	if (sotien == 'NaN') sotien=0;
	sotien = parseFloat(sotien);
	textbox_obj.value = numberWithCommas(parseFloat(sotien));
}

function laythongtin()
{
	document.getElementById("form_nhap").submit();
}
function hienthi_nhom()
{
	document.getElementById("form_nhap").submit();
}

//hienthi_nguoithuchi();

</script>