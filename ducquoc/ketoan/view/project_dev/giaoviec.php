<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Giao Việc";
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************	
    
	$id_user_receive = "";
	$username_receive = "";
	$id_user_approval = "";
	$user_name_approval = "";
	$start_date_expected = "";
	$finish_date_expected = ""; 
	$status = "";
	$start_date_kiemtra = "";
	$finish_date_kiemtra = ""; 
	$lam_ngay_le = "";
	$lam_ngay_nghi = ""; 
	
	$str_form_task = $this->Template->load_form_row(array("title"=>"Tên Công Việc","input"=>$name));
	
	if($des != "" || $des != NULL)
	{
		$des = str_replace("\n","<br>",$des);
		$str_form_task .= $this->Template->load_form_row(array("title"=>"Mô Tả Công Việc","input"=>$des));
	}
	
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Tên Người Nhận","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_user_receive]","id"=>"id_user_receive","style"=>"width:30%"),$array_user,$id_user_receive)));
	$str_form_task .= $this->Template->load_hidden(array("name"=>"data[project_diary][username_receive]","value"=>$username_receive,"id"=>"username_receive"));
	
	if($start_date_expected == "01-01-1970") $start_date_expected = "";
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Ngày Bắt Đầu Dự Kiến","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][start_date_expected]","value"=>$start_date_expected,"id"=>"start_date","style"=>"width:30%"))));
	
	if($finish_date_expected == "01-01-1970") $finish_date_expected = ""; 
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Ngày Kết Thúc Dự Kiến","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][finish_date_expected]","value"=>$finish_date_expected,"id"=>"finish_date","style"=>"width:30%"))));
	
	$array_ngay_lamviec = array("0"=>"Không", "1"=>"Có");
	
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Làm Ngày Nghỉ","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][lam_ngay_nghi]","style"=>"width:10%"),$array_ngay_lamviec,$lam_ngay_nghi)));
	
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Làm Ngày Lễ","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[ThuChi][lam_ngay_le]","style"=>"width:10%"),$array_ngay_lamviec,$lam_ngay_le)));
	
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Tên Người Kiểm Tra","input"=>$this->Template->load_selectbox(array("name"=>"data[project_diary][id_user_approval]","id"=>"id_user_approval","style"=>"width:30%"),$array_nguoiduyet,$id_user_approval)));
	$str_form_task .= $this->Template->load_hidden(array("name"=>"data[project_diary][user_name_approval]","value"=>$user_name_approval,"id"=>"user_name_approval"));
	
	if($start_date_kiemtra == "01-01-1970") $start_date_kiemtra = "";
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Ngày Bắt Đầu Kiểm Tra Công Việc","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][start_date_kiemtra]","value"=>$start_date_kiemtra,"id"=>"start_date_kiemtra","style"=>"width:30%"))));
	
	if($finish_date_kiemtra == "01-01-1970") $finish_date_kiemtra = "";
	$str_form_task .= $this->Template->load_form_row(array("title"=>"Ngày Kết Thúc Kiểm Tra Công Việc","input"=>$this->Template->load_textbox(array("name"=>"data[project_diary][finish_date_kiemtra]","value"=>$finish_date_kiemtra,"id"=>"finish_date_kiemtra","style"=>"width:30%"))));
	
	$str_id_task = $this->Template->load_hidden(array("name"=>"data[project_diary][id]","value"=>$id));
	
	$str_form_task .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_task.$this->Template->load_button(array("type"=>"submit"),"Lưu")));
	
	$str_form_task = $this->Template->load_form(array("method"=>"POST","action"=>"/project/save_task/$tmp_id.html","onsubmit"=>"return kiemtra()"),$str_form_task);
	
	echo $str_form_task;
?>
<script>
document.getElementById("id_user_receive").value = '<?php echo $this->User->id; ?>';
function kiemtra()
{
	document.getElementById("username_receive").value = $("#id_user_receive :selected").text();	
	if(document.getElementById("id_user_approval") != null) document.getElementById("user_name_approval").value = $("#id_user_approval :selected").text();	
}
$(function()
{
	$( "#start_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#finish_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#start_date_kiemtra" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#finish_date_kiemtra" ).datepicker({dateFormat: "dd-mm-yy"});
});

</script>
  



