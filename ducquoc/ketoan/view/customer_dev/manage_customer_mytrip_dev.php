
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
$str_timkiem .= " Số dòng ";
$str_timkiem .= $this->Template->load_textbox(array("name"=>"sodong","id"=>"sodong","style"=>"width:50px","value"=>$sodong));


$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

$str_save_button =  $this->Template->load_button(array("type"=>"button","id"=>"luu","value"=>"Lưu","onclick"=>"submit_customer()"),"Lưu");

$id=$this->User->id;
if($id == 1) 
{
	$str_phan_user="";
	array_unshift($array_user, array("id"=>"","name"=>"Chọn user"));
	$str_phan_user = $this->Template->load_selectbox(array("name"=>"id_user","id"=>"id_created_user","style"=>"width:180px"),$array_user);

	$str_timkiem .= "Phân cho user:&nbsp".$str_phan_user;
	$str_timkiem .= $str_save_button;
	//$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","value"=>"0"));
	//$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");

}
$link_danhsach = $this->Html->link(array("controller"=>"customer","action"=>"manage"));
$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);
echo $str_timkiem;
//*****************************************
	//END TIM KIEM
	//buoc 1: tao 1 dòng đầu tiên của table




$str_input_check_all = $this->Template->load_checkbox(array("name"=>"data[$stt][id_customer]","id"=>"check_all","class"=>"checkbox_all","style"=>"width:180px;min-height:20px; color:black;font-weight:normal; text-align:center;"));



if($id==1)
{
	$array_header_customer =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
		"fulelnam"=>array("Tên Khách Hàng",array("style"=>"text-align:left; width:10%")),
		"group_name"=>array("Nhóm Khách Hàng",array("style"=>"text-align:left; width:13%")),
		"phan_user"=>array("Chọn /Bỏ chọn".$str_input_check_all,array("style"=>"text-align:left; width:11%")),

		"nguoi_xem"=>array("Người xem",array("style"=>"text-align:left; width:10%")),
		"email"=>array("Email",array("style"=>"text-align:center; width:15%")),
		"phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
		"ngay"=>array("Ngày nhập",array("style"=>"text-align:center")),
		"nguoi_nhap"=>array("Người nhập",array("style"=>"text-align:left; width:10%")),
		"tuychon"=>array("Tùy chọn",array("style"=>"text-align:center")),
		);
}
else
{
	$array_header_customer =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
		"fulelnam"=>array("Tên Khách Hàng",array("style"=>"text-align:left; width:15%")),
		"group_name"=>array("Nhóm Khách Hàng",array("style"=>"text-align:left; width:15%")),

		"nguoi_xem"=>array("Người xem",array("style"=>"text-align:left; width:10%")),
		"email"=>array("Email",array("style"=>"text-align:center; width:15%")),
		"phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
		"ngay"=>array("Ngày nhập",array("style"=>"text-align:center")),
		"nguoi_nhap"=>array("Người nhập",array("style"=>"text-align:left; width:10%"))
		
		);
}



	//buoc 2: dung hàm load_table_header de lay template table header
$str_header_customer = $this->Template->load_table_header($array_header_customer);


	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table customer
$str_row_customer = "";
$stt = 0;

$email = "";
$phone = "";
$nguoilienlac = "";



if($array_khachhang)
{
	foreach($array_khachhang as $khachhang)
	{
		



		$array_row_customer = NULL;

		$str_input_user = $this->Template->load_checkbox(array("name"=>"data[$stt][id_customer]","value"=>$khachhang["id"],"class"=>"checkbox","style"=>"width:180px; color:black;font-weight:normal; text-align:center;"));


		$stt++;
		$array_row_customer["stt"] 		= array($stt,array("style"=>"text-align:center;"));
			//$array_row_customer["code"] 		= array($khachhang["code"],array("style"=>"text-align:center;"));
		$array_row_customer["fullname"] 	= array($khachhang["fullname"]);


		$array_row_customer["group_name"] 	= array($khachhang["group"]);



		if($id ==1)
		{
			$array_row_customer["phan_user"] 	= array($str_input_user);

		}

		$array_row_customer["nguoi_xem"] 	= array($khachhang["user_view_fullname"]);

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
			$array_row_customer["type"]  	= array($khachhang["type"],array("style"=>"text-align:center;"));*/
			$ngay = date("d-m-Y",strtotime($khachhang["created"]));
			$array_row_customer["email"]  	= array($khachhang["email"],array("style"=>"text-align:center;"));
			$array_row_customer["phone"]  	= array($khachhang["phone"],array("style"=>"text-align:center;"));
			$array_row_customer["ngay"]  	= array($ngay,array("style"=>"text-align:center;"));
			$array_row_customer["nguoi_nhap"] 	= array($khachhang["created_fullname"]);

			//$array_row_customer["contact_person"]  	= array($nguoilienlac,array("style"=>"text-align:center;"));
			if($id ==1)
			{
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
				$array_row_customer ["tuychon"]	= array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center;"));

			}
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database

			//cong don vao chuoi $str_row_customer
			$str_row_customer .= $this->Template->load_table_row($array_row_customer);

	} //foreach($array_khachhang as $khachhang)
	
} //if($array_khachhang)
else
{
	$array_row_customer["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"10"));
	$str_row_customer .= $this->Template->load_table_row($array_row_customer);
}

	//buoc 5: dung lam load_table de dữ liệu vào table
$str_table_customer =  $this->Template->load_table($str_header_customer.$str_row_customer);


	//buoc 6: tạo hidden_id_user để submit theo form

$str_hidden_id_user = $this->Template->load_hidden(array("name"=>"id_user","id"=>"hidden_id_user","value"=>""));

    // Đưa bộ lọc, thẻ table, nút lưu vào form
$str_form_customer = $this->Template->load_form(array("method"=>"POST","id"=>"form_list_customer","action"=>''),$str_table_customer.$str_hidden_id_user);
echo $str_form_customer;

$paginate_link 	= $this->Html->link(array("controller"=>"customer","action"=>"manage"));	
$paginate_link .= "?nhom=$id_group&tim=$tim&sodong=$sodong";

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
<script type="text/javascript">
	function submit_customer()
	{    

        	// lấy giá trị id_created_user gán vào hidden_id_user
        	document.getElementById('hidden_id_user').value = document.getElementById('id_created_user').value;

        	//submit form
        	document.getElementById('form_list_customer').submit();
        }
        $('document').ready(function(){
            //lua chọn hoac bo lua chon cac checkbox class='checkbox'
            $("#check_all").click(function(){

            	
            	if ($(this).is(':checked')==true) {

            		$('.checkbox').prop('checked', true);

            	} else {

            		$('.checkbox').prop('checked', false);

            	}
            });
        });
    </script>
