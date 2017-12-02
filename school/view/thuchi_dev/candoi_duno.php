<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "BẢNG CÂN ĐỐI NỢ";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	//*****************************************
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim,"onkeyup"=>"timKiem()"));
	
	$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
	
	$str_timkiem .= $this->Template->load_label(" Loại: ","","search_list");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"loai","id"=>"loai","style"=>"width:80px"),$array_type);
	
	$str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label("Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay));
	
	if($this->get_config("thuchi_customer_view") != "no")
	{
		$str_timkiem .= "<br> Khách hàng: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"customer_name","id"=>"customer_name","style"=>"width:163px","value"=>$customer_name));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_customer","id"=>"id_customer","style"=>"width:120px","value"=>$id_customer));
	}
	if($this->get_config("thuchi_project_view") != "no")
	{
		$str_timkiem .= " Dự án: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"project_name","id"=>"project_name","style"=>"width:229px","value"=>$project_name));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_project","id"=>"id_project","style"=>"width:120px","value"=>$id_project));
	}
	if($this->get_config("thuchi_contract_view") != "no")
	{
		$str_timkiem .= " Hợp đồng: ";
		$str_timkiem .= $this->Template->load_textbox(array("name"=>"post_title","id"=>"post_title","style"=>"width:98px","value"=>$post_title));
		$str_timkiem .= $this->Template->load_hidden(array("name"=>"id_post","id"=>"id_post","style"=>"width:120px","value"=>$id_post));
	}
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	if($this->get_config("thuchi_excel") != "no")
	{
		$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	}
	$link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"quanly_thuchi"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array("ngay"=>array("Ngày",array("style"=>"text-align:center; width:100px")),
					"so_ct"=>array("Loại - Số chứng từ",array("style"=>"text-align:center; width:100px","colspan"=>"2")),
					"diengiai"=>array("Diễn giải",array("style"=>"text-align:center")),	
					"sotien_thu"=>array("Phần phải thu",array("style"=>"text-align:center","colspan"=>"2")),
					"sotien_tra"=>array("Phần phải trả",array("style"=>"text-align:center","colspan"=>"2")),
					"du_no"=>array("Dư nợ",array("style"=>"text-align:center")),												
			);
	
	$str_header_product = $this->Template->load_table_header($array_header_product);
	$array_header_product2 =  array(
					"ngay"=>array("",array("style"=>"text-align:center; width:100px")),
					"so_ct"=>array("",array("style"=>"text-align:center; width:300px","colspan"=>"2")),
					"diengiai"=>array("",array("style"=>"text-align:center;width:300px")),
					"thu_no"=>array("NỢ",array("style"=>"text-align:center; width:100px")),
					"thu_co"=>array("CÓ",array("style"=>"text-align:center; width:100px")),	
					"tra_no"=>array("NỢ",array("style"=>"text-align:center; width:100px")),
					"tra_co"=>array("CÓ",array("style"=>"text-align:center; width:100px")),	
					"du_no"=>array("",array("style"=>"text-align:center; width:150px")),												
			);		
	$str_header_product .= $this->Template->load_table_row($array_header_product2,array("style"=>"background-color: #2f83b7;color:white"));			
		
	
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	$tong_chi = 0;
	$tong_thu = 0;
	$lai = 0;
	$lo = 0;
	$array_row_product = NULL;
	
	$array_row_product["ngay"] 	= array("18-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["so_ct"] 				= array("Nợ phải thu - d808.1",array("style"=>"text-align:center;","colspan"=>"2"));
	$array_row_product["diengiai"] 				= array("Bán hàng",array("style"=>"text-align:center;"));
	$array_row_product["thu_no"] 			= array("424.000",array("style"=>"text-align:center;"));
	$array_row_product["thu_co"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["tra_no"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["tra_co"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("1.250.000",array("style"=>"text-align:center;"));
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	$array_row_product["ngay"] 	= array("17-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["so_ct"] 				= array("Nợ phải thu - d808.2",array("style"=>"text-align:center;","colspan"=>"2"));
	$array_row_product["diengiai"] 				= array("Bán hàng",array("style"=>"text-align:center;"));
	$array_row_product["thu_no"] 			= array("-424.000",array("style"=>"text-align:center;"));
	$array_row_product["thu_co"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["tra_no"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["tra_co"] 			= array("",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("850.000",array("style"=>"text-align:center;"));
	
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
				echo "label: '".$value["title"]."'";
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
function submit_form()
{
	document.getElementById("form_timkiem").submit();
}
 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
 </script> 