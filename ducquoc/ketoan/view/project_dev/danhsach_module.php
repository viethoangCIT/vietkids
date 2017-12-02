<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Module";
	
	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//lấy html combobox dự án
	$str_timkiem = $this->Template->load_selectbox(array("name"=>"data[id_project]","id"=>"id_project","style"=>"width:30%"),$array_du_an);
	$str_timkiem .= " &nbsp;&nbsp; Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm","type"=>"submit"),"Tìm");
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Dự Án","input"=>$str_timkiem));
	
	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/project/module.html"),$str_form_product);
	
	echo $str_form_product;
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	
	//1: tao mang table header du_an
	$array_du_an_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
								"module_name"		=>array("Tên module",array("style"=>"text-align:center; width:20%")),
								"des"	=>array("Mô Tả",array("style"=>"text-align:left; width:15%")),
								"created_username"		=>array("Người Tạo",array("style"=>"text-align:center")),
								"sua"		=>array("Sửa",array("style"=>"text-align:center")),
								"xoa"		=>array("Xóa",array("style"=>"text-align:center"))
								);
											
	//2: lay html table header du_an(dong tren cung cua table)						
	$str_header_du_an = $this->Template->load_table_header($array_du_an_header);
	
	
	//*****************************************************
	//3: lay du lieu du an tu Controler dua qua de xu ly
    $stt = 1;
	$str_row_du_an = "";
	
	$id_created_user = "";	
	$id = "";	
	
	if($array_module != NULL)
	{
		foreach($array_module as $module)
		{
			$id_created_user = $module["id_created_user"];
			$id = $module["id"];
			$row_du_an = NULL;
			$row_du_an["stt"]				= array($stt++,array("style"=>"text-align:center;"));
			$row_du_an["module_name"] 		= array($module["module_name"],array("style"=>"text-align:left;"));	
			$row_du_an["des"] 				= array($module["des"],array("style"=>"text-align:left;"));	
			$row_du_an["created_username"] 	= array($module["created_username"],array("style"=>"text-align:center;"));		
			
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			$row_du_an["sua"] = "";
			if(($this->User->ProjectModule->allow_edit($id_created_user,$id)) || ($id_created_user == $this->User->id))
			{
					$link_sua 	= $this->Html->link(array("controller"=>"project","action"=>"add_module","params"=>array($module["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);	
					$row_du_an["sua"] 	= array($link_sua,array("style"=>"text-align:center;"));
			}
			
			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			$row_du_an["xoa"] = "";
			if(($this->User->ProjectModule->allow_delete($id_created_user,$id)) || ($id_created_user == $this->User->id))
			{
					$link_xoa 	= $this->Html->link(array("controller"=>"project","action"=>"delete_module","params"=>array($module["id"])));	
					$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
					$row_du_an["xoa"] = array($link_xoa,array("style"=>"text-align:center;","onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
			}
			
			$str_row_du_an .= $this->Template->load_table_row($row_du_an);
		}//end for
	}//end if
	else
	{
		$row_du_an["nodata"] 	= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"6"));	
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
<script>
		//đổi lại giá trị mặc định cho it_project
		document.getElementById('id_project').value = '<?php echo $id_project; ?>';
</script>