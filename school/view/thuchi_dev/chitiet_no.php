<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "CHI TIẾT NỢ";
	if((isset($_GET["type"])) && ($_GET["type"] == "0"))$function_title = "CHI TIẾT NỢ PHẢI THU";
	if((isset($_GET["type"])) && ($_GET["type"] == "1"))$function_title = "CHI TIẾT NỢ PHẢI TRẢ";
	if($denngay=="") $denngay=date("d-m-Y");
	if($tungay=="") $tungay=date("d-m-Y",strtotime($this->get_config("khoaso")));
	echo $this->Template->load_function_header($function_title);
	
	
	array_unshift($array_customer,"...");
	$input_customer = $this->Template->load_selectbox(array("name"=>"customer","style"=>"width:300px","id"=>"id_customer"),$array_customer,$customer);
	$input_from=$this->Template->load_textbox(array("name"=>"tungay","style"=>"width:100px","id"=>"tungay","value"=>$tungay));
	$input_to=$this->Template->load_textbox(array("name"=>"denngay","style"=>"width:100px","id"=>"denngay","value"=>$denngay));
	$input_button=$this->Template->load_button(array("type"=>"submit"),"Xem");
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Khách hàng","input"=>$input_customer."<lable id='span_nguoinhan'>Từ Ngày</lable>".$input_from."<lable id='span_nguoinhan'>Đến Ngày</lable>".$input_to.$input_button));
	$str_form_thuchi .= $this->Template->load_form_row(array("title"=>"Số Dư Đầu Kỳ ","input"=>$max_amount));
	
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>""),$str_form_thuchi);
	
	echo $str_form_nhap;
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	//TIM KIEM
	
	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_product =  array(
							"donvi"=>array("Ngày",array("style"=>"text-align:center")),
							"diachi"=>array("Loại",array("style"=>"text-align:center")),
							"so_ct"=>array("Số chứng từ",array("style"=>"text-align:center;")),
							"dauky"=>array("Diễn giải",array("style"=>"text-align:center;")),
							"no"=>array("Nợ",array("style"=>"text-align:center;")),
							"tra"=>array("Trả",array("style"=>"text-align:center;")),
							"du_no"=>array("Dư nợ",array("style"=>"text-align:center;")),
				);
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);
			
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$array_row_product = NULL;
	
	$array_row_product["donvi"] 	= array("19-05-2017",array("style"=>"text-align:center;"));
	$array_row_product["diachi"] 				= array("",array("style"=>"text-align:center;"));
	$array_row_product["so_ct"] 				= array("001",array("style"=>"text-align:center;"));
	$array_row_product["dauky"] 				= array("Trả nợ mua hàng",array("style"=>"text-align:center;"));
	$array_row_product["no"] 			= array("550.000",array("style"=>"text-align:center;"));
	$array_row_product["tra"] 			= array("350.000",array("style"=>"text-align:center;"));
	$array_row_product["du_no"] 			= array("200.000",array("style"=>"text-align:center;"));
	
	
	$str_row_product .= $this->Template->load_table_row($array_row_product);
	
	
	
	
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
	
	
$(function()
{
	
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
});
</script>
