<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Dự Án";
	
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
	
	$link_danhsach = $this->Html->link(array("controller"=>"project","action"=>"index"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post"),$str_timkiem);	
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	
	//1: tao mang table header du_an
	$array_du_an_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
				"code"		=>array("Mã dự án",array("style"=>"text-align:left; width:10%")),
				"name"		=>array("Tên dự án",array("style"=>"text-align:left; width:13%")),
				"customer_group"	=>array("Nhóm khách hàng",array("style"=>"text-align:left; width:15%")),
				"customer_name"	=>array("Tên khách hàng",array("style"=>"text-align:left; width:15%")),
                "start_date"		=>array("Ngày bắt đầu",array("style"=>"text-align:center")),
                "finish_date"	=>array("Ngày kết thúc",array("style"=>"text-align:center")),
				"manage_user_name"	=>array("Người quản lý chính",array("style"=>"text-align:center")),
                "desc"		=>array("Mô tả",array("style"=>"text-align:center")),
				"file"       =>array("File",array("style"=>"text-align:center")),
				"tuychon"		=>array("Tùy chọn",array("style"=>"text-align:center; width:10%")),
				
				);
							
	//2: lay html table header du_an(dong tren cung cua table)						
	$str_header_du_an = $this->Template->load_table_header($array_du_an_header);
	
	
	//*****************************************************
	//3: lay du lieu du an tu Controler dua qua de xu ly
    $stt = 1;
	$str_row_du_an = "";
	
	//lấy id user hiện tại để so sánh user này đc sửa bìa và xóa bìa hay ko
	$current_id_user = $this->User->id;
	$id_created_user = "";	
	$id = "";	
	
	//cộng 2 dấu phẩy 2 đầu để so sánh chuỗi, ko bị lỗi so sánh số 1 và sô 11
	/*$list_id_user_edit =",".$list_id_user_edit.",";
	$list_id_data_edit =",".$list_id_data_edit.",";
	
	$list_id_user_delete =",".$list_id_user_delete.",";
	$list_id_data_delete =",".$list_id_data_delete.",";*/
	$open_conditions = "false";
	if($array_du_an != NULL)
	{
		$str_call_warning = "";
		foreach($array_du_an as $du_an)
		{
			$current_date = date("Y-m-d");
			
			
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
			
			
			//lấy id của user nhập dự án, cộng thêm 2 dâu phẩy 2 đầu để ko bị lỗi khi so sanh id có trg danh sách id dự án, ví dụ số 1 và số 11	
			$id_created_user = $du_an["id_created_user"];
			
			//lấy id của dự án, cộng thêm 2 dâu phẩy 2 đầu để ko bị lỗi khi so sanh id có trg danh sách id dự án, ví dụ số 1 và số 11
			$id = ",".$du_an["id"].",";
			
			$row_du_an = NULL;
			$row_du_an["stt"]		= array($stt++,array("style"=>"text-align:center;"));
			$row_du_an["code"] 		= array($du_an["code"],array("style"=>"text-align:left;"));	
			$row_du_an["name"] 		= array($du_an["name"],array("style"=>"text-align:left;"));	
			$row_du_an["customer_group"] 	= array($du_an["customer_group"],array("style"=>"text-align:left;"));
			$row_du_an["customer_name"] 	= array($du_an["customer_name"],array("style"=>"text-align:left;"));
			
			$start_date = date("d-m-Y",strtotime($du_an["start_date"]));
			if($start_date == "01-01-1970") $start_date = "";
			$finish_date = date("d-m-Y",strtotime($du_an["finish_date"]));
			if($finish_date == "01-01-1970") $finish_date = "";
				
			$row_du_an["start_date"] = array($start_date,array("style"=>"text-align:center;"));
			$row_du_an["finish_date"]= array($finish_date,array("style"=>"text-align:center;"));
			
			$row_du_an["manage_user_name"] 	= array($du_an["manage_user_name"],array("style"=>"text-align:center;"));
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
				
			//lay link sua nhom tin
			$link_sua 	= "";
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			if($this->User->Project->allow_edit($id_created_user,$id) || $this->User->type == 1)
			{
					$link_sua 	= $this->Html->link(array("controller"=>"project","action"=>"nhap","params"=>array($du_an["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
			}

			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			$link_xoa	= "";
			if($this->User->Project->allow_delete($id_created_user,$id)|| $this->User->type == 1)
			{
					$link_xoa 				= $this->Html->link(array("controller"=>"project","action"=>"xoa","params"=>array($du_an["id"])));	
					$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
			}
			$link_chitiet 	= $this->Html->link(array("controller"=>"project","action"=>"detail","params"=>array($du_an["id"])));
			$link_chitiet	= $this->Template->load_link("edit","Xem",$link_chitiet);
			
			$row_du_an["tuychon"] = array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));
			
			
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