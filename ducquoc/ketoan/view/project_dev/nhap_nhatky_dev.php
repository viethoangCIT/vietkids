<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	//tieu de cua ham
	$function_title = "Nhập Nhật Ký";

	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

	//*****************************************
	//FUNCTION BODY
	//*****************************************
  $array_group_work=array(""=>"...","0"=>"Dịch vụ","1"=>"Môi trường Làm việc","2"=>"Nhân Sự");
  $id = "";
  $id_customer = "";
  $customer_name = "";
  $id_module = "";
  $module_name = "";
  $function_name  = "";
	$request_id = "";

  $request_issue = "";
  $request_content = "";
  $issue_cause = "";
  $request_solution = "";

  $impacted_files = "";
  $impacted_tables = "";

  $issue_date = "";

  $title = "";
  $des = "";
  $id_project = "";
  $project_name = "";
  $id_customer = "";
  $customer_name = "";
  $img = "";

  $status = "";

  $group_work = "";

  $start_date = "";

  $finish_date_expected = "";
  $finish_date = "";
  $str_file_dk = "";
  $str_img_dk = "";
  $num_hour_expect = "";
  $num_hour_actual = "";

  $date_request = "";
  $id_user_request = "";
  $user_request_fullname = "";

  $id_user_receive = "";

  $id_user_check = "";
  $user_fullname_check  = "";
  $date_check  	 = "";
  $check_status   = "";
  $check_des  	= "";

  if($array_sua)
  {
      $id = $array_sua['id'];

			$id_customer = $array_sua['id_customer'];
			$customer_name = $array_sua['customer_name'];

			$id_module = $array_sua['id_module'];
      $module_name = $array_sua['module_name'];
      $function_name = $array_sua['function_name'];
			$request_id = $array_sua['request_id'];

			$request_issue = $array_sua['request_issue'];
			$request_content = $array_sua['request_content'];
			$issue_cause = $array_sua['issue_cause'];
			$request_solution = $array_sua['request_solution'];

			$impacted_files = $array_sua['impacted_files'];
			$impacted_tables = $array_sua['impacted_tables'];

			$title = $array_sua['title'];

      $des = $array_sua['des'];
			$group_work = $array_sua['group_work'];
      $id_project = $array_sua['id_project'];
			$project_name = $array_sua['project_name'];

			$id_user_receive = $array_sua['id_user_receive'];

			$id_user_request = $array_sua['id_user_request'];
			$user_request_fullname = $array_sua['user_request_fullname'];

			$date_request = $array_sua['date_request'];
			$start_date = date("d-m-Y",strtotime($array_sua['date_request']));
			if($date_request == "01-01-1970") $date_request = "";

			$img = $array_sua['str_img'];


			$status = $array_sua['status'];

			$start_date = date("d-m-Y",strtotime($array_sua['start_date']));
			if($start_date == "01-01-1970") $start_date = "";


			$finish_date_expected = date("d-m-Y",strtotime($array_sua['finish_date_expected']));
			$finish_date = date("d-m-Y",strtotime($array_sua['finish_date']));
			$str_file_dk = $array_sua['str_file'];
			$str_img_dk = $array_sua['str_img'];

			$num_hour_expect = $array_sua['num_hour_expect'];
			$num_hour_actual = $array_sua['num_hour_actual'];


			//lấy thông tin kiểm tra
			$id_user_check = $array_sua['id_user_check'];
			$user_fullname_check  = $array_sua['user_fullname_check'];
			$date_check  	 = $array_sua['date_check'];
			$check_status   = $array_sua['check_status'];
			$check_des  	= $array_sua['check_des'];

    }

	$id_user = $this->User->id;

	$str_form_project_dairy = $this->Template->load_form_row(array("title"=>"Loại công việc","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[project_diary][group_work]","style"=>"width:30%"),$array_group_work,$group_work)));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Khách hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_customer]","id"=>"id_customer","style"=>"width:30%","onchange"=>"thaydoi_kh()"),$array_khachhang,$id_customer)));
	$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][customer_name]","value"=>$customer_name,"id"=>"customer_name"));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Dự Án","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_project]","id"=>"id_project","style"=>"width:30%","onchange"=>"thaydoi_du_an()"),$array_projects,$id_project)));
	$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][project_name]","value"=>$project_name,"id"=>"project_name"));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Module","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_module]","id"=>"id_module","style"=>"width:30%"),$array_module,$id_module)));
	$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][module_name]","value"=>$module_name,"id"=>"module_name"));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Chức năng","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][function_name]","id"=>"function_name","style"=>"width:30%","value"=>$function_name))));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Request ID","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][request_id]","id"=>"request_id","style"=>"width:30%","value"=>$request_id))));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Người Yêu Cầu","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_user_request]","id"=>"id_user_request","style"=>"width:30%"),$array_user_request,$id_user_request)));
	$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][user_request_fullname]","value"=>$user_request_fullname,"id"=>"user_request_fullname"));


	$str_input_date_request = $this->Template->load_textbox(array("name"=>"data[project_diary][date_request]","value"=>$date_request,"id"=>"date_request","style"=>"width:100px"));
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Ngày Yêu Cầu","input"=> $str_input_date_request));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Mô tả vấn đề","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][request_issue]","style"=>"width:80%"),$request_issue)));
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Nội dung yêu cầu","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][title]","style"=>"width:80%"),$title)));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Mô tả chi tiết yêu cầu","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][des]","style"=>"width:80%"),$des)));


	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Nguyên nhân","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][issue_cause]","style"=>"width:80%"),$issue_cause)));
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Mô tả kỹ thuật","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][request_solution]","style"=>"width:80%"),$request_solution)));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"File xử lý","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][impacted_files]","style"=>"width:80%"),$impacted_files)));
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Bảng dữ liệu","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][impacted_tables]","style"=>"width:80%"),$impacted_tables)));

	//begin: ngày thực hiện và người thực hiện công việc
	$str_input_user_receive = $this->Template->load_selectbox(array("name"=>"data[project_diary][id_user_receive]","id"=>"id_user_receive"),$array_nguoi_thuchien,$id_user_receive);

	$str_input_date_start = $this->Template->load_textbox(array("name"=>"data[project_diary][start_date]","value"=>$start_date,"id"=>"start_date","style"=>"width:100px"));
	$str_content_start_date =  $str_input_date_start. " Người Thực Hiện Công Việc: ".$str_input_user_receive;
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Ngày Bắt Đầu Làm","input"=> $str_content_start_date));
	//end: ngày thực hiện và người thực hiện công việc

	if($finish_date_expected == "01-01-1970") $finish_date_expected = "";
	$str_input_finish_date_expect = $this->Template->load_textbox(array("name"=>"data[project_diary][finish_date_expected]","value"=>$finish_date_expected,"id"=>"finish_date_expected","style"=>"width:100px"));




	$str_input_num_hour_expect = $this->Template->load_textbox(array("name"=>"data[project_diary][num_hour_expect]","value"=>$num_hour_expect,"id"=>"num_hour_expect","style"=>"width: 100px"));
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Số Giờ Làm Dự Kiến","input"=>$str_input_num_hour_expect. " Ngày Hoàn Thành Dự Kiến: ".$str_input_finish_date_expect));



	$str_input_num_hour_actual = $this->Template->load_textbox(array("name"=>"data[project_diary][num_hour_actual]","value"=>$num_hour_actual,"id"=>"num_hour_actual","style"=>"width: 100px"));

	if($finish_date == "01-01-1970") $finish_date = "";
	$str_input_finish_date = $this->Template->load_textbox(array("name"=>"data[project_diary][finish_date]","value"=>$finish_date,"id"=>"finish_date","style"=>"width:100px"));


	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Số Giờ Làm Thực Tế","input"=> $str_input_num_hour_actual. " Ngày Hoàn Thành Thực Tế: ".$str_input_finish_date));



	if($id != "")
	{

		$array_status = array("0"=>"Chưa Tiếp Nhận","1"=>"Chưa Hoàn Thành","2"=>"Hoàn Thành","3"=>"Đã Hủy");
		$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Trạng Thái","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[project_diary][status]","style"=>"width:13%"),$array_status,$status)));
	}else
	{
		$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][trangthai]","id"=>"trangthai","value"=>"0"));
	}


	//begin: người kiểm tra và ngày kiểm tra
	$str_input_user_check = $this->Template->load_selectbox(array("name"=>"data[project_diary][id_user_check]","id"=>"id_user_check"),$array_nguoi_thuchien,$id_user_check);
	$str_input_user_check .= $this->Template->load_hidden(array("name"=>"data[project_diary][user_fullname_check]","id"=>"user_fullname_check","value"=>$user_fullname_check));

	$date_check = date("d-m-Y",strtotime($date_check));
	if($date_check == "01-01-1970") $date_check = "";

	$str_input_date_check = $this->Template->load_textbox(array("name"=>"data[project_diary][date_check]","value"=>$date_check,"id"=>"date_check","style"=>"width:100px"));
	$str_content_check =  $str_input_date_check. " Người Kiểm Tra &nbsp;&nbsp; : ".$str_input_user_check ;
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Ngày kiểm tra","input"=> $str_content_check));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Ghi chú kiểm tra","input"=>$this->Template->load_textarea(array("name"=>"data[project_diary][check_des]","style"=>"width:80%"),$check_des)));

	$array_check_status = array("0"=>"Chưa Đạt", "1"=>"Đạt");
	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"Kết quả kiểm tra","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[project_diary][check_status]","style"=>"width:13%"),$array_check_status,$check_status)));

	//end: ngày thực hiện và người thực hiện công việc

	$str_form_project_dairy .= $this->Template->load_hidden(array("name"=>"data[project_diary][trangthai_luu]","id"=>"trangthai_luu","value"=>"0"));

	$str_id_product = $this->Template->load_hidden(array("name"=>"data[project_diary][id]","value"=>$id));

	$str_form_project_dairy .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_product.$this->Template->load_button(array("type"=>"submit","onclick"=>"luu_dulieu()"),"Lưu")));

	$str_form_project_dairy = $this->Template->load_form(array("method"=>"POST","id"=>"form_luu","action"=>"/project/add_diary.html","onsubmit"=>"return kiemtra()"),$str_form_project_dairy);

	echo $str_form_project_dairy;
?>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>
<?php
	$luuhinh = $this->Company->file_url.$this->Company->upload_url;
   echo $this->Template->load_upload_js("img","upload_container_img","select_img","upload_img","list_img","result_upload_img","uploader_img",array("Image Files"=>"jpg,png,jpeg,gif"),"20","hienthi_img");

   echo $this->Template->load_upload_js("file_dinhkem","upload_container_file","select_file","upload_file","list_file","result_upload_file","uploader_file",array("Image Files"=>"txt,pdf,xls,xlsx,doc"),"20","hienthi_file");
?>

<script>
function thaydoi_kh()
{
	document.getElementById("form_luu").submit();
}
function thaydoi_du_an()
{
	document.getElementById("form_luu").submit();
}
function luu_dulieu()
{

	document.getElementById("trangthai_luu").value = '1';
	document.getElementById("form_luu").submit();
}
function kiemtra()
{
	document.getElementById("project_name").value = $("#id_project :selected").text();
	document.getElementById("module_name").value = $("#id_module :selected").text();
	document.getElementById("user_request_fullname").value = $("#id_user_request :selected").text();
	document.getElementById("customer_name").value = $("#id_customer :selected").text();
}
$(function()
{
	$( "#start_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#finish_date_expected" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#finish_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#date_request" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#date_check" ).datepicker({dateFormat: "dd-mm-yy"});

});
var stt_file = 0;
<?php
		if($str_file_dk != "" && $str_file_dk != NULL)
		{
			$array_file = explode(chr(8),$str_file_dk);
			if($array_file != NULL && count($array_file) > 0)
			{
				for($a = "0";$a < count($array_file);$a++)
				{
					$mota_file = "";
					$ten_file_dk = "";
					$array_file_mota =  explode(chr(7),$array_file[$a]);
					if($array_file_mota != NULL && count($array_file_mota) > 0)
					{
						$mota_file = $array_file_mota[1];
						$ten_file_dk = $array_file_mota[0];
	?>
						hienthi_file("<?php echo $ten_file_dk; ?>","<?php echo $mota_file ?>");
	<?php
					}
				}
			}
		}
	?>


function hienthi_file(data,mota)
	{
		stt_file++;
		if(mota == null) mota = data;
		str_stt = "<td>"+stt_file+"<input type='hidden' id='ten_file_"+stt_file+"' value='"+data+"'></td>";

		str_img = "<td><a href='<?php echo $luuhinh;?>" + data + "' style='color:yellow' target='_blank'><i class='icon-download-alt'></i>"+data+"</a></td>";

		str_input = "<td><textarea style='width:200px;height:30px' class='text_mota_file' id='text_file_"+stt_file+"'>"+mota+"</textarea></td>";
		str_xoa = "<td><a class='btn-icon-rotate' title='Xóa' onclick='xoa_file_dk("+stt_file+")' ><i class='icon-remove'></i> Xóa</a></td>";

		str_row = str_stt + str_img + str_input + str_xoa;

		document.getElementById("ds_file").innerHTML += "<tr id='row_"+stt_file+"'>"+str_row+"</tr>";
		//alert(stt_hinh);

		$( ".text_mota_file" ).keyup(function() {
			capnhat_mota_file();

		});
		capnhat_mota_file();
	}
	function capnhat_mota_file()
	{
		var kytu_noi_hinh_va_mota =  String.fromCharCode(7);
		var kytu_noi_dong = String.fromCharCode(8);
		text_hinh = "";
		ten_hinh = "";
		mota_hinh = "";
		for(i=1;i<=stt_file;i++)
		{
			if(document.getElementById("text_file_"+i) != null)
			{
				ten_hinh = document.getElementById("ten_file_"+i).value;
				mota_hinh = document.getElementById("text_file_"+i).value;

				if(text_hinh == "") text_hinh += ten_hinh + kytu_noi_hinh_va_mota + mota_hinh;
				else text_hinh +=  kytu_noi_dong + ten_hinh + kytu_noi_hinh_va_mota + mota_hinh ;

			}

		}
		document.getElementById("file_dinhkem").value = text_hinh;
	}
	function xoa_file_dk(sothutu_file)
	{
		var table_file_dk = document.getElementById("ds_file");
    	table_file_dk.removeChild(table_file_dk.childNodes[sothutu_file]);
		stt_file--;
		capnhat_mota_file();
	}
//end upload file

	//upload hinh

	var stt_img = 0;
<?php
		if($str_img_dk != "" && $str_img_dk != NULL)
		{
			$array_img = explode(chr(8),$str_img_dk);
			if($array_img != NULL && count($array_img) > 0)
			{
				for($a = "0";$a < count($array_img);$a++)
				{
					$mota_img = "";
					$ten_img_dk = "";
					$array_img_mota =  explode(chr(7),$array_img[$a]);
					if($array_img_mota != NULL && count($array_img_mota) > 0)
					{
						$mota_img = $array_img_mota[1];
						$ten_img_dk = $array_img_mota[0];
	?>
						hienthi_img("<?php echo $ten_img_dk; ?>","<?php echo $mota_img ?>");
	<?php
					}
				}
			}
		}
	?>


function hienthi_img(data,mota)
	{
		stt_img++;
		if(mota == null) mota = data;
		str_stt = "<td>"+stt_img+"<input type='hidden' id='ten_img_"+stt_img+"' value='"+data+"'></td>";

		str_img = "<td><img src='<?php echo $luuhinh;?>" + data + "' style='width:200px'></td>";

		str_input = "<td><textarea style='width:200px;height:30px' class='text_mota_img' id='text_img_"+stt_img+"'>"+mota+"</textarea></td>";
		str_xoa = "<td><a class='btn-icon-rotate' title='Xóa' onclick='xoa_img_dk("+stt_img+")' ><i class='icon-remove'></i> Xóa</a></td>";

		str_row = str_stt + str_img + str_input + str_xoa;

		document.getElementById("ds_img").innerHTML += "<tr id='row_"+stt_img+"'>"+str_row+"</tr>";
		//alert(stt_hinh);

		$( ".text_mota_img" ).keyup(function() {
			capnhat_mota_img();

		});
		capnhat_mota_img();
	}
	function capnhat_mota_img()
	{
		var kytu_noi_hinh_va_mota =  String.fromCharCode(7);
		var kytu_noi_dong = String.fromCharCode(8);
		text_hinh = "";
		ten_hinh = "";
		mota_hinh = "";
		for(i=1;i<=stt_img;i++)
		{
			if(document.getElementById("text_img_"+i) != null)
			{
				ten_hinh = document.getElementById("ten_img_"+i).value;
				mota_hinh = document.getElementById("text_img_"+i).value;

				if(text_hinh == "") text_hinh += ten_hinh + kytu_noi_hinh_va_mota + mota_hinh;
				else text_hinh +=  kytu_noi_dong + ten_hinh + kytu_noi_hinh_va_mota + mota_hinh ;

			}

		}
		document.getElementById("img_dinhkem").value = text_hinh;
	}
	function xoa_img_dk(sothutu_img)
	{
		var table_img_dk = document.getElementById("ds_img");
    	table_img_dk.removeChild(table_img_dk.childNodes[sothutu_img]);
		stt_img--;

		capnhat_mota_img();
	}
</script>
