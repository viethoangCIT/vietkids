<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Nhập Dự Án";
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************	
    
	$id = '';
	$code = '';  
    $name = '';       
    $desc = "";      
    $id_customer = "";      
    $customer_name ="";
	$start_date ="";
	$finish_date ="";
	$place = "";
	$id_manage_user = "";      
    $manage_user_name ="";
	$org = "";
	$org_address = "";
	$org_phone = "";
	
	$manager_name = "";
	$manager_phone = "";
	$manager_email = "";
	
	$created_time = "";
	$note = "";
	$remind_time = "";
	
	$str_file = $array_sua[0]['str_file'];
	
    if($array_sua)
	{
            $id = $array_sua[0]['id'];
            $name = $array_sua[0]['name'];
			$code = $array_sua[0]['code'];
            $desc = $array_sua[0]['desc'];           
            $customer_name = $array_sua[0]['customer_name']; 
			$id_customer = $array_sua[0]['id_customer'];   
			$manage_user_name = $array_sua[0]['manage_user_name']; 
			$id_manage_user = $array_sua[0]['id_manage_user'];   
			$start_date = date("d-m-Y",strtotime($array_sua[0]['start_date']));
			$finish_date = date("d-m-Y",strtotime($array_sua[0]['finish_date']));
			$place = $array_sua[0]['place']; 
	
			$org = $array_sua[0]['org']; 
			$org_address = $array_sua[0]['org_address']; 
			$org_phone = $array_sua[0]['org_phone']; 
			
			$manager_name = $array_sua[0]['manager_name']; 
			$manager_phone = $array_sua[0]['manager_phone']; 
			$manager_email = $array_sua[0]['manager_email'];
			
			$created_time = date("d-m-Y",strtotime($array_sua[0]['created_time']));
			$note = $array_sua[0]['note']; 
			$remind_time = $array_sua[0]['remind_time'];
			
			$str_file = $array_sua[0]['str_file'];
			 
    }
	//echo "-- $customer_name $id_customer";
	//$str_form_product = $this->Template->load_form_row(array("title"=>"Tên khách hàng","input"=>$this->Template->load_selectbox(array("name"=>"data[project][id_customer]","id"=>"id_customer","style"=>"width:30%"),$array_kh,$id_customer).'<input type="button" id="opener" onclick="them_doituong(\'customer/add\')" value="+">'));
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Khách hàng","input"=>$this->Template->load_textbox(array("name"=>"data[project][customer_name]","value"=>$customer_name,"style"=>"width:30%","id"=>"customer_name")).'<input type="button" id="opener" onclick="them_doituong(\'customer/add\')" value="+">'));
	$str_form_product .= $this->Template->load_hidden(array("name"=>"data[project][id_customer]","value"=>$id_customer,"id"=>"id_customer"));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mã dự án","input"=>$this->Template->load_textbox(array("name"=>"data[project][code]","value"=>$code,"style"=>"width:80%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên dự án","input"=>$this->Template->load_textbox(array("name"=>"data[project][name]","value"=>$name,"style"=>"width:80%"))));
	
	
	//$str_form_product .= $this->Template->load_hidden(array("name"=>"data[project][customer_name]","value"=>$customer_name,"id"=>"customer_name"));
	
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày bắt đầu","input"=>$this->Template->load_textbox(array("name"=>"data[project][start_date]","value"=>$start_date,"id"=>"start_date","style"=>"width:100px","onkeyup"=>"format_date(this.id)"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày kết thúc","input"=>$this->Template->load_textbox(array("name"=>"data[project][finish_date]","value"=>$finish_date,"id"=>"finish_date","style"=>"width:100px","onkeyup"=>"format_date(this.id)"))));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Người quản lý chính","input"=>$this->Template->load_selectbox(array("name"=>"data[project][id_manage_user]","id"=>"id_manage_user","style"=>"width:30%"),$array_nguoiquanly,$id_manage_user)));
	$str_form_product .= $this->Template->load_hidden(array("name"=>"data[project][manage_user_name]","value"=>$manage_user_name,"id"=>"manage_user_name"));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Địa điểm thực hiện","input"=>$this->Template->load_textbox(array("name"=>"data[project][place]","value"=>$place,"style"=>"width:80%"))));
	
	
	$str_form_product .= "<div style='width:100%;float:left'>";
	$str_form_product .= "<div style='width:40%;float:left'>";
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Đơn vị quản lý","input"=>$this->Template->load_textbox(array("name"=>"data[project][org]","value"=>$org,"style"=>"width:100%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Địa chỉ","input"=>$this->Template->load_textbox(array("name"=>"data[project][org_address]","value"=>$org_address,"style"=>"width:100%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Điện thoại","input"=>$this->Template->load_textbox(array("name"=>"data[project][org_phone]","value"=>$org_phone,"style"=>"width:100%"))));
	$str_form_product .= "</div>";
	$str_form_product .= "<div style='width:50%;float:left'>";
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Người quản lý","input"=>$this->Template->load_textbox(array("name"=>"data[project][manager_name]","value"=>$manager_name,"style"=>"width:80%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Email","input"=>$this->Template->load_textbox(array("name"=>"data[project][manager_email]","value"=>$manager_email,"style"=>"width:80%"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Điện thoại","input"=>$this->Template->load_textbox(array("name"=>"data[project][manager_phone]","value"=>$manager_phone,"style"=>"width:80%"))));
	$str_form_product .= "</div>";
	$str_form_product .= "</div>";
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Thời điểm tạo","input"=>$this->Template->load_textbox(array("name"=>"data[project][created_time]","value"=>$created_time,"id"=>"created_time","style"=>"width:80%","onkeyup"=>"format_date(this.id)"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ghi chú","input"=>$this->Template->load_textarea(array("name"=>"data[project][note]","style"=>"width:80%"),$note)));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày nhắc nhở tính từ thời điểm tạo","input"=>$this->Template->load_textbox(array("name"=>"data[project][remind_time]","value"=>$remind_time,"style"=>"width:100px"))));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mô Tả","input"=>$this->Template->load_textarea(array("name"=>"data[project][desc]","style"=>"width:80%"),$desc)));
	
	//up file
	$str_dk_file = $this->Template->load_textbox(array("name"=>"data[project][str_file]","id"=>'str_file',"value"=>$str_file,"style"=>"width:20%"));
	$str_uploadbar = $this->Template->load_upload_bar("upload_container","select_img","upload_img","list_img","result_upload");
	$str_form_product .= $this->Template->load_form_row(array("title"=>"File đính kèm","input"=>$str_dk_file.$str_uploadbar));
	
	
	$param = "";
	if(isset($_GET["ajax"])) 
	{
		$param =  "?ajax=".$_GET["ajax"]; 
	}
	
	$str_id_product = $this->Template->load_hidden(array("name"=>"data[project][id]","value"=>$id));
	$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_product.$this->Template->load_button(array("type"=>"submit"),"Lưu")));
	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/project/nhap.html$param","onsubmit"=>"return kiemtra()"),$str_form_product);
	echo $str_form_product;
	
	if($array_dulieu_cu)
	{
		$array_du_an_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
				"code"		=>array("Mã dự án",array("style"=>"text-align:left; width:10%")),
				"name"		=>array("Tên dự án",array("style"=>"text-align:left; width:13%")),
				"customer_name"	=>array("Tên khách hàng",array("style"=>"text-align:left; width:15%")),
                "start_date"		=>array("Ngày bắt đầu",array("style"=>"text-align:center")),
                "finish_date"	=>array("Ngày kết thúc",array("style"=>"text-align:center")),
				"manage_user_name"	=>array("Người quản lý chính",array("style"=>"text-align:center")),
                "desc"		=>array("Mô tả",array("style"=>"text-align:center")),
				"created_username"		=>array("Người Tạo",array("style"=>"text-align:center")),
				
				);
		//2: lay html table header du_an(dong tren cung cua table)						
		$str_header_du_an = $this->Template->load_table_header($array_du_an_header);
		
		//*****************************************************
		//3: lay du lieu du an tu Controler dua qua de xu ly
		$stt = 1;
		$str_row_du_an = "";
		
		if($array_dulieu_cu != NULL)
		{
			foreach($array_dulieu_cu as $du_an)
			{
				//lấy id của user nhập dự án, cộng thêm 2 dâu phẩy 2 đầu để ko bị lỗi khi so sanh id có trg danh sách id dự án, ví dụ số 1 và số 11	
				$id_created_user = $du_an["id_created_user"];
				
				//lấy id của dự án, cộng thêm 2 dâu phẩy 2 đầu để ko bị lỗi khi so sanh id có trg danh sách id dự án, ví dụ số 1 và số 11
				$id = ",".$du_an["id"].",";
				
				$row_du_an = NULL;
				$row_du_an["stt"]		= array($stt++,array("style"=>"text-align:center;"));
				$row_du_an["code"] 		= array($du_an["code"],array("style"=>"text-align:left;"));	
				$row_du_an["name"] 		= array($du_an["name"],array("style"=>"text-align:left;"));	
				$row_du_an["customer_name"] 	= array($du_an["customer_name"],array("style"=>"text-align:left;"));
				
				$start_date = date("d-m-Y",strtotime($du_an["start_date"]));
				if($start_date == "01-01-1970") $start_date = "";
				$finish_date = date("d-m-Y",strtotime($du_an["finish_date"]));
				if($finish_date == "01-01-1970") $finish_date = "";
					
				$row_du_an["start_date"] = array($start_date,array("style"=>"text-align:center;"));
				$row_du_an["finish_date"]= array($finish_date,array("style"=>"text-align:center;"));
				$row_du_an["manage_user_name"] 	= array($du_an["manage_user_name"],array("style"=>"text-align:center;"));
				$row_du_an["desc"] 		= array($du_an["desc"],array("style"=>"text-align:center;"));
				$row_du_an["created_username"] 		= array($du_an["created_username"],array("style"=>"text-align:center;"));		
				$str_row_du_an .= $this->Template->load_table_row($row_du_an);
			}//end for
		}//end if
		else
		{
			$row_du_an["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"7"));	
			$str_row_du_an .= $this->Template->load_table_row($row_du_an);	
		}
		
		//4: lay html cua table
		$str_du_an =  $this->Template->load_table($str_header_du_an.$str_row_du_an);
		 
		//5: hien thi html ra man hinh
		echo $this->Template->load_function_body($str_du_an);
	}
	
	
	
	
	echo $this->Template->load_upload_js("str_file","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf,txt,pdf,xls,xlsx,doc"),"1");
  
?>
<div id="dialog" title="THÊM MỚI">
	<div id='form_them'></div>
</div>
<script>
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_kh as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["code"]." ".$value["fullname"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#customer_name" ).bind( "keydown", function( event )
	 {
		if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) 
		{
			event.preventDefault();
		}
	 }
	)
	.autocomplete({
		minLength: 0,
		source: function( request, response ) 
		{
			// delegate back to autocomplete, but extract the last term
			response( $.ui.autocomplete.filter(array_khachhang, extractLast( request.term )) );
		},
	
		//    source:projects,    
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui )
		{
			
			/*var terms = split( this.value );
			// remove the current input
			
			terms.pop();
			
			// add the selected item
			terms.push( ui.item.label );
		
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( "" );
	
			alert(terms);*/
			
			var selected_value = ui.item.value; 
			$('#id_customer').val(selected_value);
			this.value = ui.item.label;
			
			return false;
		}
	});
	$("#customer_name").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#customer_name").trigger(e);
	});

}); //end function
 </script> 
<script>

function kiemtra()
{
	
	document.getElementById("manage_user_name").value = $("#id_manage_user :selected").text();	
}
$(function()
{
	$( "#start_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#finish_date" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#created_time" ).datepicker({dateFormat: "dd-mm-yy"});
	
	//bien the div co id=dialog thanh windows
	$( "#dialog" ).dialog({autoOpen: false,show: {effect: "blind",duration:500},hide: {effect: "explode",duration: 500},width: "25%",});
	//tao su kien cho button id = opener hien windows
	$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
	});
	$( "#dialog" ).dialog({
		minWidth: 380,
		width:'90%',
		 modal: false,
	});
		
			
	
});
function them_doituong(doituong)
	{
		var param_ajax =  "<?php echo $this->webroot;?>"+doituong+"?ajax=project/nhap";
		
		//truy vấn các khách sạn theo title vừa đánh 
		$.ajax({  method: "GET",  url: param_ajax,  data: {}})
		.done(function( msg ) {
			 document.getElementById("form_them").innerHTML = msg;
		});
		return;
	}
function format_date(id_doituong)
    {
    	var dulieu = document.getElementById(id_doituong).value;
        dulieu = dulieu.replace(/-/g , "");
        var ketqua = dulieu;
        for(var i=0;i<=dulieu.length;i++)
        {
        	if(i==3) ketqua = dulieu[0] + dulieu[1] +"-"+ dulieu[2];
            if(i==4) ketqua = dulieu[0] + dulieu[1] +"-"+ dulieu[2] + dulieu[3];
            if(i==5) ketqua = dulieu[0] + dulieu[1] +"-"+ dulieu[2] + dulieu[3] + "-" + dulieu[4];
            if(i>5) ketqua += dulieu[i-1]
            
        }
       document.getElementById(id_doituong).value = ketqua;
        
    }
</script>
  
<script type="text/javascript">
		function hienthi_canhan_tochuc()
		{
			if(document.getElementById('loai'))
			{
				//lấy giá trị combobook loại
				loai = document.getElementById('loai').value;
				if(loai == "0") 
				{
					//hiện cá nhân
					document.getElementById('canhan').style.display = 'block';
					document.getElementById('tochuc').style.display = 'none'; 	 	
				}
				else 
				{
					//che cá nhân
					document.getElementById('canhan').style.display = 'none';
					document.getElementById('tochuc').style.display = 'block'; 	 
					
				}
			}
		}
		 hienthi_canhan_tochuc();
 </script>


