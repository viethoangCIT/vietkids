<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Người Liên Lạc";
	

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	
	//lấy html combobox loại
	$str_timkiem = $this->Template->load_selectbox(array("name"=>"data[id_customer]","id"=>"id_customer","style"=>"width:30%"),$array_kh);
	$str_timkiem .= " &nbsp;&nbsp; Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm","type"=>"submit"),"Tìm");
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Khách Hàng","input"=>$str_timkiem));
	
	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/customer/user.html"),$str_form_product);
	
	echo $str_form_product;
	
	//*****************************************	
	//*****************************************
	//END TIM KIEM
	
	//buoc 1: tao 1 dòng đầu tiên của table
	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"fullname"=>array("Tên Người Liên Lạc",array("style"=>"text-align:left; width:15%")),
							"gender"=>array("Giới Tính",array("style"=>"text-align:center")),					
							"email"=>array("Email",array("style"=>"text-align:center")),
							"phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
							"position"=>array("Chức Vụ",array("style"=>"text-align:center")),
							"username"=>array("Tên Đăng Nhập",array("style"=>"text-align:center")),
							"des"=>array("Mô Tả",array("style"=>"text-align:center")),
							"edit"=>array("Sửa",array("style"=>"text-align:center")),
							"del"=>array("Xóa",array("style"=>"text-align:center"))												
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_product = $this->Template->load_table_header($array_header_product);
	
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;
	
	$id_created_user = "";	
	$id = "";	
	
	if($array_nguoilienlac)
	{
		foreach($array_nguoilienlac as $nguoilienlac)
		{
			$stt++;
			$id_created_user = $nguoilienlac["id_created_user"];
			$id = $nguoilienlac["id"];
			$array_row_product = NULL;
			$array_row_product["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			$array_row_product["fullname"] 	= array($nguoilienlac["fullname"]);	
			if($nguoilienlac["gender"] == 0) $nguoilienlac["gender"] = "Nữ";
			else $nguoilienlac["gender"] = "Nam";
			$array_row_product["gender"]  	= array($nguoilienlac["gender"],array("style"=>"text-align:center;"));
			$array_row_product["email"]  	= array($nguoilienlac["email"],array("style"=>"text-align:center;"));
			$array_row_product["phone"]  	= array($nguoilienlac["phone"],array("style"=>"text-align:center;"));
			$array_row_product["position"]  = array($nguoilienlac["position"],array("style"=>"text-align:center;"));
			$array_row_product["username"]  = array($nguoilienlac["username"],array("style"=>"text-align:center;"));
			$array_row_product["des"]  		= array($nguoilienlac["desc"],array("style"=>"text-align:center;"));
			
			$array_row_product ["edit"] = NULL;
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			if(($this->User->User2->allow_edit($id_created_user,$id)) || ($id_created_user = $this->User->id))
			{
				$link_sua = $this->Html->link(array("controller"=>"customer","action"=>"add_user","params"=>array($nguoilienlac["id"])));
				$link_sua = $this->Template->load_link("edit","Sửa",$link_sua);	
				$array_row_product ["edit"] = array($link_sua,array("style"=>"text-align:center;"));
			}
			
			$array_row_product ["del"] = NULL;
			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			if(($this->User->User2->allow_delete($id_created_user,$id)) || ($id_created_user = $this->User->id))
			{
				$link_xoa = $this->Html->link(array("controller"=>"customer","action"=>"delete_user","params"=>array($nguoilienlac["id"])));
				$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa);	
				$array_row_product ["del"] = array($link_xoa,array("style"=>"text-align:center;"));
			}
		
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"11"));	
		$str_row_product .= $this->Template->load_table_row($array_row_product);	
	}
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>
<script>
		//đổi lại giá trị mặc định cho id_customer
		document.getElementById('id_customer').value = '<?php echo $id_customer; ?>';
		
</script>
