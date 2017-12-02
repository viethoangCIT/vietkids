<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Nhập Nhật Ký Khách Hàng";
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************	
   
  $id = "";
  $des = "";      
  $id_customer = "";
  $customer_name = ""; 
  $place = "";
  $issue_date = "";
  $str_file_dk = "";
  $str_img_dk = "";
   
    if($array_sua)
	{
            $id = $array_sua[0]['id'];
            $des = $array_sua[0]['des'];           
			$place = $array_sua[0]['place'];   
			$id_customer = $array_sua[0]['id_customer'];   
			$customer_name = $array_sua[0]['customer_name'];   
			$issue_date = date("d-m-Y",strtotime($array_sua[0]["issue_date"]));  
			$str_file_dk = $array_sua[0]['str_file'];  
			$str_img_dk = $array_sua[0]['str_img'];  
    }
	
	$str_form_diary = $this->Template->load_form_row(array("title"=>"Tên Khách Hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[customer_diary][id_customer]","id"=>"id_customer","style"=>"width:30%"),$array_kh,$id_customer)));
	$str_form_diary .= $this->Template->load_hidden(array("name"=>"data[customer_diary][customer_name]","value"=>$customer_name,"id"=>"customer_name"));

	$str_form_diary .= $this->Template->load_form_row(array("title"=>"Nội Dung","input"=>$this->Template->load_textarea(array("name"=>"data[customer_diary][des]","style"=>"width:80%"),$des)));
	
	
	///upload hinh đính kèm
	$str_img = $this->Template->load_hidden(array("name"=>"data[customer_diary][str_img]","id"=>'img_dinhkem',"value"=>$str_img_dk,"style"=>"width:20%"));
	$str_uploadbar_img =$this->Template->load_upload_bar("upload_container_img","select_img","upload_img","list_img","result_upload_img");
	$str_label_img_dinhkem = 'Hình Đính kèm';
	$str_ds_img_dinhkem = "<table id='ds_img' class='rwd-table' align='left'><tr><td>STT</td><td>Hình</td><td>Mô tả Hình</td><td style='width:100px'>Xóa</td></tr></table>";
	$str_form_diary .= $this->Template->load_form_row(array("title"=>$str_label_img_dinhkem,"input"=>$str_img.$str_uploadbar_img.$str_ds_img_dinhkem));
	//end hinh đính kèm
	
	///upload file đính kèm
	$str_file = $this->Template->load_hidden(array("name"=>"data[customer_diary][str_file]","id"=>'file_dinhkem',"value"=>$str_file_dk,"style"=>"width:20%"));
	$str_uploadbar =$this->Template->load_upload_bar("upload_container_file","select_file","upload_file","list_file","result_upload_file");
	$str_label_file_dinhkem = 'File Đính kèm';
	$str_ds_file_dinhkem = "<table id='ds_file' class='rwd-table' align='left'><tr><td>STT</td><td>File</td><td>Mô tả file</td><td>Xóa</td></tr></table>";
	$str_form_diary .= $this->Template->load_form_row(array("title"=>$str_label_file_dinhkem,"input"=>$str_file.$str_uploadbar.$str_ds_file_dinhkem));
	//end file đính kèm
	
	if($issue_date == "01-01-1970") $issue_date = "";
	$str_form_diary .= $this->Template->load_form_row(array("title"=>"Ngày Gặp","input"=>$this->Template->load_textbox(array("name"=>"data[customer_diary][issue_date]","value"=>$issue_date,"id"=>"issue_date","style"=>"width:30%"))));
	
	$str_form_diary .= $this->Template->load_form_row(array("title"=>"Địa Điểm","input"=>$this->Template->load_textbox(array("name"=>"data[customer_diary][place]","value"=>$place,"style"=>"width:80%"))));
	
	$str_id_diary = $this->Template->load_hidden(array("name"=>"data[customer_diary][id]","value"=>$id));
	
	$str_form_diary .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_diary.$this->Template->load_button(array("type"=>"submit"),"Lưu")));
	
	$str_form_diary = $this->Template->load_form(array("method"=>"POST","id"=>"form_luu","action"=>"/customer/add_customer_diary.html","onsubmit"=>"return kiemtra()"),$str_form_diary);
	
	echo $str_form_diary;
?>
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>
<?php
	$luuhinh = $this->Company->file_url.$this->Company->upload_url;
   echo $this->Template->load_upload_js("img","upload_container_img","select_img","upload_img","list_img","result_upload_img","uploader_img",array("Image Files"=>"jpg,png,jpeg,gif"),"20","hienthi_img");
   
   echo $this->Template->load_upload_js("file_dinhkem","upload_container_file","select_file","upload_file","list_file","result_upload_file","uploader_file",array("Image Files"=>"txt,pdf,xls,xlsx,doc"),"20","hienthi_file");
?>

<script>
function kiemtra()
{
	document.getElementById("customer_name").value = $("#id_customer :selected").text();	
}
$(function()
{
	$( "#issue_date" ).datepicker({dateFormat: "dd-mm-yy"});
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

