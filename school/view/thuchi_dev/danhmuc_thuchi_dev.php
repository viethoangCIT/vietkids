<?php
    // Phần Title
    $function_title =  "DANH MỤC THU-CHI";
    echo $this->Template->load_function_header($function_title);
    // Kết thúc phần Title
	
	$code="";
	$name="";
	$tinh_kd="";
	$link_sua="";
	$link_xoa="";
	$id="";
	if($array_thuchi)
	{
		$code=$array_thuchi[0]["code"];
		$name=$array_thuchi[0]["name"];
		$tinh_kd=$array_thuchi[0]["tinh_kd"];
		$id=$array_thuchi[0]["id"];
	}
	
    // Phần Content
    $str_form_row='';
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Mã","input"=>$this->Template->load_textbox(array("name"=>"data[code]","style"=>"width:40%","value"=>$code))));                              																																
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Mục Thu-Chi","input"=>$this->Template->load_textbox(array("name"=>"data[name]","style"=>"width:40%","value"=>$name))));
	$str_form_row .= $this->Template->load_form_row(array("title"=>"Tính KD","input"=>$this->Template->load_textarea(array("name"=>"data[tinh_kd]","style"=>"width:200px"),$tinh_kd))).$this->Template->load_hidden(array("name"=>"data[id]","id"=>"id_project","style"=>"width:120px","value"=>$id));
	$str_form_row .= $this->Template->load_form_row(array("title"=>"","input"=>$this->Template->load_button(array("type"=>"submit",'style'=>'margin-top:-6px; margin-left:5px'),"Lưu")));
	echo $this->Template->load_form(array('method'=>'POST','action'=>"/thuchi/danhmuc_thuchi"),$str_form_row);
	
	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"code"=>array("Mã",array("style"=>"text-align:left; width:10%")),
							"name"=>array("Mục Thu-Chi",array("style"=>"text-align:center; width:35%")),
							"tinh"=>array("Tính KD",array("style"=>"text-align:left")),
							"tuychon"=>array("Tùy Chọn",array("style"=>"text-align:center; width:100px")),
					);
	$str_header_product = $this->Template->load_table_header($array_header_product);	
	$str_row_CheckList = "";
	$stt = 1;
	$i = 0;
	foreach($array_danhmuc_thuchi as $thuchi)
	{		
			$code=$thuchi["code"];
			$name=$thuchi["name"];
			$tinh_kd=$thuchi["tinh_kd"];
			
			$str_link_edit = $this->Template->load_link('edit','','/thuchi/danhmuc_thuchi/'.$thuchi["id"]);
			//$str_link_del = $this->Template->load_link('del','','/thuchi/xoa_danhmuc/'.$thuchi["id"]);
			
			$array_row_thuchi = array(
										
										"stt"=>array($stt++),
										"code"=>array($code),
										"name"=>array($name),
										"tinh"=>array($tinh_kd),
										"tuychon"=>array($str_link_edit.$str_link_del),
										
									);
			$array_content_thuchi.=$this->Template->load_table_row($array_row_thuchi);
			$i++;
			

	}
	$str_table_product =  $this->Template->load_table($str_header_product.$array_content_thuchi);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
						

?>
