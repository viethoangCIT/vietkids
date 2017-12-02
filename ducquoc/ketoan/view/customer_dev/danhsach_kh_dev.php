<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	//tieu de cua ham
	if($this->get_config("nhatre") != "vietkid2") $function_title = "Danh Sách Khách Hàng";
	else $function_title = "Danh Sách Trẻ";

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	//TIM KIEM
	//*****************************************
	$str_timkiem = "";

	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));

	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");

	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");

	$link_danhsach = $this->Html->link(array("controller"=>"customer","action"=>"index"));
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	$type = "";

	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
    if($this->get_config("nhatre") == "vietkid2")
	{
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"fullname"=>array("Tên Cháu",array("style"=>"text-align:left; width:15%")),
							"birthdate"=>array("Ngày Sinh",array("style"=>"text-align:center; width:10%")),
							"gender"=>array("Giới Tính",array("style"=>"text-align:center")),
							"dad_name"=>array("Thông Tin Ba",array("style"=>"text-align:center; width:15%")),
							"mom_name"=>array("Thông Tin Mẹ",array("style"=>"text-align:center; width:15%")),
							"address"=>array("Địa Chỉ",array("style"=>"text-align:center; width:10%")),
							"desc"=>array("Ghi Chú",array("style"=>"text-align:center")),
							"tuychon"=>array("Tùy Chọn",array("style"=>"text-align:center; width:7%")),
					);
	}
    else {
		$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"code"=>array("Mã Khách Hàng",array("style"=>"text-align:center; width:10%")),
							"fullname"=>array("Tên Khách Hàng",array("style"=>"text-align:left; width:15%")),
							"type"=>array("Loại",array("style"=>"text-align:center")),
							"email"=>array("Email",array("style"=>"text-align:center")),
							"phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
							"address"=>array("Địa Chỉ",array("style"=>"text-align:center")),
							"business_areas"=>array("Nghành Nghề",array("style"=>"text-align:center")),
							"contact_person"=>array("Người Liên Lạc",array("style"=>"text-align:center; width:8%"))
					);
	}

	//buoc 2: dung hàm load_table_header de lay template table header
	$str_header_product = $this->Template->load_table_header($array_header_product);


	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;

	$id_created_user = "";
	$id = "";
	$email = "";
	$phone = "";
	$nguoilienlac = "";
	if($this->get_config("nhatre") != "vietkid2") $col_span = "9";
	else $col_span = "10";

	if($array_khachhang)
	{
		foreach($array_khachhang as $khachhang)
		{
			$id_created_user = $khachhang["id_created_user"];
			$id = $khachhang["id"];

			//kiểm tra user hiẹn tại có trg list_id_user_edit, kiểm tra id hiện tại có trg danh sách id data đc sửa hay ko
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			if(($this->User->Customer->allow_edit($id_created_user,$id)) || ($this->User->type == "1"))
			{
				$link_sua 	= $this->Html->link(array("controller"=>"customer","action"=>"add","params"=>array($khachhang["id"])));
				$link_sua	= "<br>".$this->Template->load_link("edit","Sửa",$link_sua);
			}
			//lay liên kết để xóa
			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			if(($this->User->Customer->allow_delete($id_created_user,$id)) || ($this->User->type == "1"))
			{
				$link_xoa 				= $this->Html->link(array("controller"=>"customer","action"=>"del_student","params"=>array($khachhang["id"])));
				$link_xoa				= "<br>".$this->Template->load_link("del","Xóa",$link_xoa);
			}

			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 			= array($stt,array("style"=>"text-align:center;"));
			if($this->get_config("nhatre") != "vietkid2")
			{
				$array_row_product["code"] 		= array($khachhang["code"],array("style"=>"text-align:center;"));
			}
			$array_row_product["fullname"] 			= array($khachhang["fullname"],array("style"=>"text-align:left;"));

			if($this->get_config("nhatre") != "vietkid2")
			{
				//nếu type = 0 thì gán chuỗi cá nhân cho type
				if($khachhang["type"] == 0)
				{
					$khachhang["type"] = "Cá Nhân";
					$nguoilienlac = "";
				}
				else
				{
					$khachhang["type"] = "Tổ Chức";
					$nguoilienlac = $this->Html->link(array("controller"=>"customer","action"=>"user","params"=>array($khachhang["id"])));
					$nguoilienlac = "<br>".$this->Template->load_link("edit","...",$nguoilienlac);
				}
				$array_row_product["type"]  	= array($khachhang["type"],array("style"=>"text-align:center;"));
				$array_row_product["email"]  	= array($khachhang["email"],array("style"=>"text-align:center;"));
				$array_row_product["phone"]  	= array($khachhang["phone"],array("style"=>"text-align:center;"));
				$array_row_product["address"]  	= array($khachhang["address"],array("style"=>"text-align:center;"));
				$array_row_product["business_areas"]  	= array($khachhang["business_areas"],array("style"=>"text-align:center;"));
				$array_row_product["contact_person"]  	= array($nguoilienlac.$link_sua.$link_xoa,array("style"=>"text-align:center;"));
			}else
			{
				$birthdate = date("d-m-Y",strtotime($khachhang["birthday"]));
				if($birthdate == "01-01-1970") $birthdate = "";
				$gender = $khachhang["gender"];
				if($gender == "0") $gender = "Nữ";
				else $gender = "Nam";
				$thongtin_ba = "Tên: ".$khachhang["dad_name"]."<br>"."Nghề nghiệp: ".$khachhang["dad_job"]."<br>"."Số điện thoại: ".$khachhang["dad_phone"];
				$thongtin_me = "Tên: ".$khachhang["mom_name"]."<br>"."Nghề nghiệp: ".$khachhang["mom_job"]."<br>"."Số điện thoại: ".$khachhang["mom_phone"];

				$array_row_product["birthdate"] 			= array($birthdate,array("style"=>"text-align:center;"));
				$array_row_product["gender"] 			= array($gender,array("style"=>"text-align:center;"));
				$array_row_product["dad_name"] 			= array($thongtin_ba,array("style"=>"text-align:left;"));
				$array_row_product["mom_name"] 			= array($thongtin_me,array("style"=>"text-align:left;"));
				$array_row_product["address"] 			= array($khachhang["address"],array("style"=>"text-align:left;"));
				$array_row_product["desc"] 			= array($khachhang["desc"],array("style"=>"text-align:left;"));
				$array_row_product["tuychon"] 			= array($link_sua.$link_xoa,array("style"=>"text-align:center;"));
			}

			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>$col_span));
		$str_row_product .= $this->Template->load_table_row($array_row_product);
	}
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
?>

<script>
function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();
}
</script>