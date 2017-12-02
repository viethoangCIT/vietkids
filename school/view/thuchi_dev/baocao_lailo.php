<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Báo cáo Lãi - Lỗ";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = "Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim,"onkeyup"=>"timKiem()"));
	
	$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
	
	$str_timkiem .= " Từ ngày: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay,"onkeyup"=>"format_date(this.id)"));
	
	$str_timkiem .= " Đến ngày: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay,"onkeyup"=>"format_date(this.id)"));
	
	$str_timkiem .= "<br> Khách hàng: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"customer_name","id"=>"customer_name","style"=>"width:163px","value"=>$customer_name));
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_customer","id"=>"id_customer","style"=>"width:120px","value"=>$id_customer));
	
	$str_timkiem .= " Dự án: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"project_name","id"=>"project_name","style"=>"width:113px","value"=>$project_name));
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_project","id"=>"id_project","style"=>"width:120px","value"=>$id_project));
	
	$str_timkiem .= " Hợp đồng: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"post_title","id"=>"post_title","style"=>"width:98px","value"=>$post_title));
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_post","id"=>"id_post","style"=>"width:120px","value"=>$id_post));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	
	$link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"baocao_lailo"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"document_number"=>array("Số Hợp Đồng",array("style"=>"text-align:center")),
							"document_created"=>array("Ngày ký",array("style"=>"text-align:center")),
							"document_expired"=>array("Ngày hết hạn",array("style"=>"text-align:center")),
							"customer_name"=>array("Khách hàng",array("style"=>"text-align:left")),
							"project_name"=>array("Dự án",array("style"=>"text-align:left")),
							"tong_thu"=>array("Đã thu",array("style"=>"text-align:center")),	
							"tong_chi"=>array("Đã chi",array("style"=>"text-align:center")),
							"lai_lo"=>array("Lãi - Lỗ",array("style"=>"text-align:center")),
							"document_status"=>array("Trạng thái",array("style"=>"text-align:center")),
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
	
	if($array_dulieu != NULL)
	{
		foreach($array_dulieu as $dulieu)
		{
			 $tong_thu += $dulieu["tong_thu"];
			 $tong_chi += $dulieu["tong_chi"];
			
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_product["document_number"] 	    = array($dulieu["document_number"],array("style"=>"text-align:center;"));
			
			$document_created = date("d-m-Y",strtotime($dulieu["document_created"]));
			if($document_created == "01-01-1970") $document_created = "";
			$array_row_product["document_created"]   = array($document_created,array("style"=>"text-align:center;"));
			
			$document_expired = date("d-m-Y",strtotime($dulieu["document_expired"]));
			if($document_expired == "01-01-1970") $document_expired = "";
			$array_row_product["document_expired"]  = array($document_expired,array("style"=>"text-align:center;"));
			
			$array_row_product["customer_name"] 	= array($dulieu["customer_name"],array("style"=>"text-align:left;"));
			$array_row_product["project_name"] 		= array($dulieu["project_name"],array("style"=>"text-align:left;"));
			$array_row_product["tong_thu"] 	= array(number_format($dulieu["tong_thu"]),array("style"=>"text-align:center;"));
			$array_row_product["tong_chi"] 		= array(number_format($dulieu["tong_chi"]),array("style"=>"text-align:center;"));
			
			$lai_lo = $dulieu["tong_thu"] - $dulieu["tong_chi"];
			$stype_lailo = "";
			if( $dulieu["tong_chi"] > $dulieu["tong_thu"]) $stype_lailo = "font-weight:bold;color:red";
			$array_row_product["lai_lo"] 	= array(number_format($lai_lo),array("style"=>"text-align:center;font-size:15px;$stype_lailo"));
			$array_row_product["document_status"] 		= array($dulieu["document_status"],array("style"=>"text-align:center;"));
			
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"12"));	
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	
	$tong_lai_lo = $tong_thu - $tong_chi;
	$tong_lai_lo = number_format($tong_lai_lo);
	if($tong_thu < $tong_chi ) $style_tongcong = "red";
	else $style_tongcong = "yellow";
	if($tong_chi < $tong_thu )$lai = $tong_thu - $tong_chi;
	if($tong_thu < $tong_chi )$lo = $tong_chi - $tong_thu;
	$lai = number_format($lai);
	$lo = number_format($lo);
	$tong_thu = number_format($tong_thu);
	$tong_chi = number_format($tong_chi);
	//thêm vào dòng tổng số dòng
	$array_row_product = NULL;
	$array_row_product["stt"] 	= array("",array("style"=>"text-align:center;font-weight:bold;color:yellow","colspan"=>"6"));
	$array_row_product["tongthu"] = array("$tong_thu",array("style"=>"text-align:center;font-weight:bold;color:yellow;font-size:20px","colspan"=>"1","id"=>"thu"));
	$array_row_product["tongchi"] 	= array("$tong_chi",array("style"=>"text-align:center;font-weight:bold;color:yellow;font-size:20px","colspan"=>"1","id"=>"tongchi"));
	$array_row_product["lai_lo"] 	= array(" $tong_lai_lo",array("style"=>"text-align:center;color:$style_tongcong;font-weight:bold;font-size:20px","colspan"=>"1","id"=>"lai"));
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);	
	
		
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product,array("id"=>"table_thuchi"));
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
	document.getElementById('loai').value = "<?php echo $type; ?>";
</script>

 <script>
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_du_an as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["name"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#project_name" ).bind( "keydown", function( event )
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
			
			var selected_value = ui.item.value; 
			$('#id_project').val(selected_value);
			this.value = ui.item.label;
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#project_name").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#project_name").trigger(e);
	});

}); //end function
 
 
     
</script>
<script>
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_khachhang as $value)
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
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#customer_name").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#customer_name").trigger(e);
	});

}); //end function

document.getElementById('tim').onkeydown = function(event) {
    if (event.keyCode == 13) {
       document.getElementById("form_timkiem").submit();
    }
}
$(function() {
	function split( val ) {return val.split( /,\s*/ );}
	function extractLast( term ) {return split( term ).pop();}
	var array_khachhang = [
	
		<?php 
			foreach($array_hopdong as $value)
			{
				echo "{";
				echo "value: '".$value["id"]."',";
				echo "label: '".$value["document_number"]."'";
				echo "},";
			}
		?>
	
	];
	
	$( "#post_title" ).bind( "keydown", function( event )
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
			$('#id_post').val(selected_value);
			this.value = ui.item.label;
			document.getElementById("form_timkiem").submit();
			return false;
		}
	});
	$("#post_title").click(function() {
  		var e = jQuery.Event("keydown");
		e.which = 65; // # Some key code value
		$("#post_title").trigger(e);
	});

}); //end function
function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
function submit_form()
{
	document.getElementById("form_timkiem").submit();
}

 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
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