<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Quản Lý Dự Án";
	
	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	//TIM KIEM
	//*****************************************
		
	$str_timkiem = "Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	$str_timkiem .= " Từ ngày: ";	
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:80px","value"=>$tungay,"onkeyup"=>"format_date(this.id)"));
	$str_timkiem .= " Đến ngày: ";		
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:80px","value"=>$denngay,"onkeyup"=>"format_date(this.id)"));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");
	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");
	
	$link_danhsach = $this->Html->link(array("controller"=>"project","action"=>"manage"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	
	//1: tao mang table header du_an
	$array_du_an_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
				"code"		=>array("Mã dự án",array("style"=>"text-align:left; width:8%")),
				"name"		=>array("Tên dự án",array("style"=>"text-align:left; width:13%")),
				"customer_name"	=>array("Tên khách hàng",array("style"=>"text-align:left; width:15%")),
				"customer_group"	=>array("Nhóm khách hàng",array("style"=>"text-align:left; width:15%")),
                "start_date"		=>array("Ngày bắt đầu",array("style"=>"text-align:center")),
                "finish_date"	=>array("Ngày kết thúc",array("style"=>"text-align:center")),
                "desc"		=>array("Mô tả",array("style"=>"text-align:center")),
				"file"       =>array("File",array("style"=>"text-align:center")),
				"tuychon"		=>array("Tùy chọn",array("style"=>"text-align:center")),
				);
							
	//2: lay html table header du_an(dong tren cung cua table)						
	$str_header_du_an = $this->Template->load_table_header($array_du_an_header);
	
	
	//*****************************************************
	//3: lay du lieu du an tu Controler dua qua de xu ly
    $stt = 1;
	$str_row_du_an = "";
	
	$start_date = "";
	$finish_date = "";
	$open_conditions = "false";
	if($array_du_an != NULL)
	{
		$current_date = date("Y-m-d");
		$str_call_warning = "";
		foreach($array_du_an as $du_an)
		{
			$start_date = date("d-m-Y",strtotime($du_an["start_date"]));
			if($start_date == "01-01-1970") $start_date = "";
			
			$finish_date = date("d-m-Y",strtotime($du_an["finish_date"]));
			if($finish_date == "01-01-1970") $finish_date = "";
			
			//xử lý thông báo
			if(isset($du_an["remind_time"]) && $du_an["remind_time"] != "")
			{
				$warning_date =  date('Y-m-d', strtotime($du_an["created_time"]. ' + '.$du_an["remind_time"].' days'));
				if($warning_date == $current_date) 
				{
					$str_call_warning .= "<b>Dự án: ".$du_an["name"]."</b><br>Thông báo: ".$du_an["note"]."<br><br>";
					$open_conditions = "true";
				} 
			}
			
			$row_du_an = NULL;
			$row_du_an["stt"]		= array($stt++,array("style"=>"text-align:center;"));
			$row_du_an["code"] 		= array($du_an["code"],array("style"=>"text-align:left;"));	
			$row_du_an["name"] 		= array($du_an["name"],array("style"=>"text-align:left;"));	
			$row_du_an["customer_name"] 	= array($du_an["customer_name"],array("style"=>"text-align:left;"));	
			$row_du_an["customer_group"] 	= array($du_an["customer_group"],array("style"=>"text-align:left;"));	
			$row_du_an["start_date"] = array($start_date,array("style"=>"text-align:center;"));
			$row_du_an["finish_date"]= array($finish_date,array("style"=>"text-align:center;"));
			$row_du_an["desc"] 		= array($du_an["desc"],array("style"=>"text-align:center;"));	
			
			//link file
			$row_du_an["file"] 	= NULL;
			if(isset($du_an["str_file"]) && $du_an["str_file"] != "")
			{
				$link_file = "";
				$array_file = NULL;
				$array_file = explode(";",$du_an["str_file"]);
				if(count($array_file) == 1) 
				{
					$link_file 	=  $this->Company->file_url.$this->Company->upload_url.$du_an["str_file"];
					$link_file	= $this->Template->load_link("download","Tải",$link_file);	
				}
				else 
				{
					for($k=0;$k<count($array_file);$k++)
					{
						$link_file	.= $this->Template->load_link("download","Tải",$this->Company->file_url.$this->Company->upload_url.$array_file[$k])."<br>";
					}
				}
				$row_du_an["file"] 	= array($link_file,array("style"=>"text-align:center;"));
			}
			//lay link chi tiet nhom tin
			$link_chitiet 	= $this->Html->link(array("controller"=>"project","action"=>"detail","params"=>array($du_an["id"])));
			$link_chitiet	= $this->Template->load_link("edit","Chi tiết",$link_chitiet);
			
			//lay link sua nhom tin
			$link_sua 	= $this->Html->link(array("controller"=>"project","action"=>"nhap","params"=>array($du_an["id"])));
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
		
			//lay link xoa & tao the href & dua vao cell
			$link_xoa 	= $this->Html->link(array("controller"=>"project","action"=>"xoa","params"=>array($du_an["id"])));	
			$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
			
			$row_du_an["tuychon"] = array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
			
			$str_row_du_an .= $this->Template->load_table_row($row_du_an);
		}//end for
	}//end if
	else
	{
		$row_du_an["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"8"));	
		$str_row_du_an .= $this->Template->load_table_row($row_du_an);	
	}
	
	//4: lay html cua table
	$str_du_an =  $this->Template->load_table($str_header_du_an.$str_row_du_an);
	 
	//5: hien thi html ra man hinh
	echo $this->Template->load_function_body($str_du_an);
	
	//*****************************************
	//END FUNCTION BODY
	//*****************************************		
?> 
<div id="dialog" title="THÔNG BÁO">
	 <?php echo $str_call_warning; ?>
</div>
<script>
	
	$(function() {
		$( "#created" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#post_date" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#modified" ).datepicker({dateFormat: 'dd-mm-yy'});
		
		//bien the div co id=dialog thanh windows
		
		$( "#dialog" ).dialog({autoOpen: <?php echo $open_conditions ?>,show: {effect: "blind",duration:500},hide: {effect: "explode",duration: 500}});
		//tao su kien cho button id = opener hien windows
		//$( "#opener" ).click(function() {$( "#dialog" ).dialog( "open" );});
			
	});
	
</script>
<script>
 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();	
}
 $(function() {
        $( "#tungay" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#denngay" ).datepicker({dateFormat: 'dd-mm-yy'});	 
           
  });
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