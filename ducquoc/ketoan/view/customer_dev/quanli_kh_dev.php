<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	//tieu de cua ham
	$function_title = "Quản Lí Khách Hàng";
    if (isset($_GET['relationship']))
    {
        if ($_GET['relationship'] == 1) $function_title = "Danh sách Nhà Cung Cấp";
    }

	echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	//TIM KIEM
	//*****************************************

	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	if($array_group)
	{
		$str_timkiem .= " Nhóm: ";
		$str_timkiem .= $this->Template->load_selectbox(array("name"=>"nhom","id"=>"nhom","style"=>"width:230px"),$array_group,$id_group);
	}

	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

	//$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	//$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");

	$link_danhsach = $this->Html->link(array("controller"=>"customer","action"=>"manage"));
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"post","id"=>"form_timkiem"),$str_timkiem);
	echo $str_timkiem;

	//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table
    if (isset($_GET['relationship']))
    {
        if ($_GET['relationship'] == 1)
        {
            $array_header_product = array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
                            "code"=>array("Mã Nhà Cung Cấp",array("style"=>"text-align:center; width:10%")),
                            "fullname"=>array("Tên Nhà Cung Cấp",array("style"=>"text-align:left; width:15%")),
                            "type"=>array("Loại",array("style"=>"text-align:center")),
                            "email"=>array("Email",array("style"=>"text-align:center")),
                            "phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
                            "address"=>array("Địa Chỉ",array("style"=>"text-align:center")),
                            "contact_person"=>array("Người Liên hệ",array("style"=>"text-align:center")),
                            "tuychon"=>array("Tùy chọn",array("style"=>"text-align:center")),);
        }
    }
    else
    {
        $array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
                            "fullname"=>array("Tên Khách Hàng",array("style"=>"text-align:left; width:15%")),
                            "email"=>array("Email",array("style"=>"text-align:center")),
                            "phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
                            "address"=>array("Địa Chỉ",array("style"=>"text-align:center")),
                            "tuychon"=>array("Tùy chọn",array("style"=>"text-align:center")),
                    );
    }


	//buoc 2: dung hàm load_table_header de lay template table header
	$str_header_product = $this->Template->load_table_header($array_header_product);


	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table product
	$str_row_product = "";
	$stt = 0;

	$email = "";
	$phone = "";
	$nguoilienlac = "";

	if($array_khachhang)
	{
		foreach($array_khachhang as $khachhang)
		{
			$stt++;
			$array_row_product = NULL;
			$array_row_product["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			//$array_row_product["code"] 		= array($khachhang["code"],array("style"=>"text-align:center;"));
			$array_row_product["fullname"] 	= array($khachhang["fullname"]);

			/*
			//nếu type = 0 thì gán chuỗi cá nhân cho type
			if($khachhang["type"] == 0)
			{
				$khachhang["type"] = "Cá Nhân";
				$nguoilienlac = "";
			}
			else
			{
				$khachhang["type"] = "Tổ Chức";
				if(isset($this->Company->modules["ducquoc/ketoan"]["customer"]["add_user"]))
				{
					$nguoilienlac = $this->Html->link(array("controller"=>"customer","action"=>"user","params"=>array($khachhang["id"])));
					$nguoilienlac = $this->Template->load_link("edit","...",$nguoilienlac);
				}else
				{
					$nguoilienlac = $khachhang["contact_name"];
				}
			}
			$array_row_product["type"]  	= array($khachhang["type"],array("style"=>"text-align:center;"));*/
			$array_row_product["email"]  	= array($khachhang["email"],array("style"=>"text-align:center;"));
			$array_row_product["phone"]  	= array($khachhang["phone"],array("style"=>"text-align:center;"));
			$array_row_product["address"]  	= array($khachhang["address"],array("style"=>"text-align:center;"));

			//$array_row_product["contact_person"]  	= array($nguoilienlac,array("style"=>"text-align:center;"));

			$link_chitiet 	= $this->Html->link(array("controller"=>"customer","action"=>"detail","params"=>array($khachhang["id"])));
			$link_chitiet	= $this->Template->load_link("edit","Chi tiết",$link_chitiet);

			$link_sua 	= $this->Html->link(array("controller"=>"customer","action"=>"add","params"=>array($khachhang["id"])));
            if (isset($_GET['relationship']))
            {
                $relationship = $_GET['relationship'];
                $link_sua   = $this->Html->link(array("controller"=>"customer","action"=>"add/".$khachhang["id"]."?relationship=$relationship"));
            }
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);

			//lay liên kết để xóa
			$link_xoa 				= $this->Html->link(array("controller"=>"customer","action"=>"del","params"=>array($khachhang["id"])));
			$link_xoa				= $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
			$array_row_product ["tuychon"]	= array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));


			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database

			//cong don vao chuoi $str_row_product
			$str_row_product .= $this->Template->load_table_row($array_row_product);
		}
	}else
	{
		$array_row_product["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"10"));
		$str_row_product .= $this->Template->load_table_row($array_row_product);
	}

	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);


	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_product;
	
	$paginate_link 	= $this->Html->link(array("controller"=>"customer","action"=>"manage"));	
	$paginate_link .= "?id_group=$id_group&tim=$tim";
	
	if(isset($_GET["valid_email"]))
	{
		 $valid_email = $_GET["valid_email"];
		 $paginate_link .= "&valid_email=$valid_email";	
	
	}
	$phantrang = $this->Lib->paginate($paginate_link,$pagination["page"], $pagination["total_pages"]);
	echo $phantrang. " Tổng cộng: ". $pagination["total_row"]. " dòng";
?>
 
<script>
 function exel()
{
  document.getElementById('xuat').value = '1';
  document.getElementById('form_timkiem').submit();
}
</script>
