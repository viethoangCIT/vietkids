<?php
//*****************************************
	//FUNCTION HEADER
	//*****************************************

	//tieu de cua ham
if($this->get_config("nhatre") != "vietkid2") $function_title = "Thêm Khách Hàng";
else $function_title = "Thêm Trẻ Và Phụ Huynh";

    /**
     * Nếu tồn tại $GET[relationship] = 1 thì là nhà cung cấp
     */
    if(isset($_GET["email"]))
    {
    	?>
    	<div class=" alert alert-success">
    	<h3 style="text-align: center; color: red;"> <?php echo "email đã tồn tại" ?></h3>
    	</div>
    	<?php
    }
    if (isset($_GET['relationship']))
    {
    	if ($_GET['relationship'] == 1) $function_title = "Nhập Nhà Cung Cấp";
    }

    echo $this->Template->load_function_header($function_title);
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************

    $id = "";
    $fullname = "";
    $code = "";
    $gender = "";
    $birthdate = "";
    $email = "";



    $phone = "";
    $address = "";
    $company = "";
    $type = "";
    $id_group = "";
    $group = "";
    $deputy = "";
    $contact_name = "";
    $contact_phone = "";
    $contact_email = "";
    $business_areas = "";
    $dad_name = $dad_job = $dad_phone = "";
    $mom_name = $mom_job = $mom_phone = "";
    $desc = "";
    $start_date = "";
    $tax_code = "";
    $status = "";
    if($array_sua)
    {
    	$id = $array_sua[0]["id"];
    	$fullname = $array_sua[0]["fullname"];
    	$code = $array_sua[0]["code"];
    	$gender = $array_sua[0]["gender"];
    	$birthdate = date("d-m-Y",strtotime($array_sua[0]["birthday"]));
    	$email = $array_sua[0]["email"];
    	$phone = $array_sua[0]["phone"];
    	$address = $array_sua[0]["address"];
    	$type = $array_sua[0]["type"];
    	$company = $array_sua[0]["company"];
    	$id_group = $array_sua[0]["id_group"];
    	$group = $array_sua[0]["group"];
    	$business_areas = $array_sua[0]["business_areas"];
    	$deputy = $array_sua[0]["deputy"];
    	$contact_name  = $array_sua[0]["contact_name"];
    	$contact_phone = $array_sua[0]["contact_phone"];
    	$contact_email = $array_sua[0]["contact_email"];
    	$start_date = date("d-m-Y",strtotime($array_sua[0]["start_date"]));
    	$dad_name  = $array_sua[0]["dad_name"];
    	$dad_job = $array_sua[0]["dad_job"];
    	$dad_phone = $array_sua[0]["dad_phone"];
    	$mom_name  = $array_sua[0]["mom_name"];
    	$mom_job = $array_sua[0]["mom_job"];
    	$mom_phone = $array_sua[0]["mom_phone"];
    	$desc  = $array_sua[0]["desc"];
    	$tax_code = $array_sua[0]["tax_code"];
    	$status = $array_sua[0]["status"];
    }

    $str_form_product = "";
    if (isset($_GET['relationship']))
    {
    	if ($_GET['relationship'] == 1)
    	{
    		$str_form_product = $this->Template->load_form_row(array("title"=>"Mã Nhà Cung Cấp","input"=>$this->Template->load_textbox(array("name"=>"data[customer][code]","value"=>$code,"style"=>"width:80%"))));
    		$ten_khachhang = "Tên Nhà Cung Cấp";
    	}
    }
    else if($this->get_config("nhatre") != "vietkid2")
    {
    	$str_form_product = $this->Template->load_form_row(array("title"=>"Mã Khách Hàng","input"=>$this->Template->load_textbox(array("name"=>"data[customer][code]","value"=>$code,"style"=>"width:80%"))));
    	$ten_khachhang = "Tên Khách Hàng";
    }else {
    	$ten_khachhang = "Họ Và Tên Cháu";
    }

    $str_form_product .= $this->Template->load_form_row(array("title"=>$ten_khachhang,"input"=>$this->Template->load_textbox(array("name"=>"data[customer][fullname]","value"=>$fullname,"style"=>"width:80%"))));

    if($this->get_config("nhatre") == "vietkid2")
    {
    	if($birthdate == "01-01-1970") $birthdate = "";
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày Sinh","input"=>$this->Template->load_textbox(array("name"=>"data[customer][birthday]","value"=>$birthdate,"id"=>"birthdate","style"=>"width:30%"))));

    	$array_gt = array("0"=>"Nữ", "1"=>"Nam");
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Giới Tính","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[customer][gender]","style"=>"width:10%"),$array_gt,$gender)));

    	if($start_date == "01-01-1970") $start_date = "";
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ngày Vào Trường","input"=>$this->Template->load_textbox(array("name"=>"data[customer][start_date]","value"=>$start_date,"id"=>"start_date","style"=>"width:30%"))));

    	$array_trangthai = array("0"=>"Chưa xếp lớp","1"=>"Đang học","2"=>"Nghỉ hè","3"=>"Đã ra trường");
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Trạng Thái","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[customer][status]","style"=>"width:15%"),$array_trangthai,$status)));

    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Họ Và Tên Ba","input"=>$this->Template->load_textbox(array("name"=>"data[customer][dad_name]","value"=>$dad_name,"style"=>"width:80%"))));
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Nghề Nghiệp","input"=>$this->Template->load_textbox(array("name"=>"data[customer][dad_job]","value"=>$dad_job,"style"=>"width:80%"))));
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại","input"=>$this->Template->load_textbox(array("name"=>"data[customer][dad_phone]","value"=>$dad_phone,"style"=>"width:80%"))));

    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Họ Và Tên Mẹ","input"=>$this->Template->load_textbox(array("name"=>"data[customer][mom_name]","value"=>$mom_name,"style"=>"width:80%"))));
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Nghề Nghiệp","input"=>$this->Template->load_textbox(array("name"=>"data[customer][mom_job]","value"=>$mom_job,"style"=>"width:80%"))));
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại","input"=>$this->Template->load_textbox(array("name"=>"data[customer][mom_phone]","value"=>$mom_phone,"style"=>"width:80%"))));
    }

    if($this->get_config("nhatre") != "vietkid2")
    {
    	if($this->get_config("donvi_name") != "vutico") $str_form_product .= $this->Template->load_form_row(array("title"=>"Email","input"=>$this->Template->load_textbox(array("name"=>"data[customer][email]","value"=>$email,"style"=>"width:80%"))));
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại","input"=>$this->Template->load_textbox(array("name"=>"data[customer][phone]","value"=>$phone,"style"=>"width:80%"))));
    }

    $str_form_product .= $this->Template->load_form_row(array("title"=>"Địa Chỉ","input"=>$this->Template->load_textbox(array("name"=>"data[customer][address]","value"=>$address,"style"=>"width:80%"))));

    if (isset($_GET['relationship']))
    {
    	if ($_GET['relationship'] == 1)
    	{

    	}
    }
    else if($this->get_config("nhatre") != "vietkid2")
    {
    	$ten_nhom = "Nhóm";
    	if($this->get_config("donvi_name") == "vutico") $ten_nhom = "Quan hệ";

    	$str_form_product .= $this->Template->load_form_row(array("title"=>$ten_nhom,"input"=>$this->Template->load_selectbox(array("name"=>"data[customer][id_group]","id"=>"id_group","style"=>"width:30%"),$array_group,$id_group)));
    	$str_form_product .= $this->Template->load_hidden(array("name"=>"data[customer][group]","value"=>$group,"id"=>"group"));

    	if($this->get_config("donvi_name") == "vutico") $str_form_product .=$this->Template->load_form_row(array("title"=>"Mã số thuế","input"=>$this->Template->load_textbox(array("name"=>"data[customer][tax_code]","value"=>$tax_code,"style"=>"width:80%"))));

    	if($this->get_config("donvi_name") != "vutico")
    	{
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Lĩnh Vực Kinh Doanh","input"=>$this->Template->load_textbox(array("name"=>"data[customer][business_areas]","value"=>$business_areas,"style"=>"width:80%"))));

    		$array_loai = array("0"=>"Cá nhân", "1"=>"Tổ chức");
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Loại","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[customer][type]","style"=>"width:10%","onchange"=>"hienthi_canhan_tochuc()","id"=>"loai"),$array_loai,$type)));

    		$str_form_product .= "<div id='canhan'>";
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Đơn Vị Công Tác","input"=>$this->Template->load_textbox(array("name"=>"data[customer][company]","value"=>$company,"style"=>"width:80%"))));
    		$str_form_product .= "</div>";

    		$str_form_product .= "<div id='tochuc'>";
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Người đại diện","input"=>$this->Template->load_textbox(array("name"=>"data[customer][deputy]","value"=>$deputy,"style"=>"width:80%"))));
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Người liên hệ","input"=>$this->Template->load_textbox(array("name"=>"data[customer][contact_name]","value"=>$contact_name,"style"=>"width:80%"))));
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Email liên hệ","input"=>$this->Template->load_textbox(array("name"=>"data[customer][contact_email]","value"=>$contact_email,"style"=>"width:80%"))));
    		$str_form_product .= $this->Template->load_form_row(array("title"=>"Số Điện Thoại liên hệ","input"=>$this->Template->load_textbox(array("name"=>"data[customer][contact_phone]","value"=>$contact_phone,"style"=>"width:80%"))));
    		$str_form_product .= "</div>";

    	}
    }else
    {
    	$str_form_product .= $this->Template->load_form_row(array("title"=>"Ghi Chú","input"=>$this->Template->load_textarea(array("name"=>"data[customer][desc]","style"=>"width:80%"),$desc)));
    }

    $str_id_product = $this->Template->load_hidden(array("name"=>"data[customer][id]","value"=>$id));
    $id_user = $this->User->id;
     $str_id_user = $this->Template->load_hidden(array("name"=>"data[customer][id_user]","value"=>$id_user));


    $str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_user.$str_id_product.$this->Template->load_button(array("type"=>"submit"),"Lưu")));

    /**
     * Đ.A: nếu tồn tại $_GET[relationship] thì thêm link
     */
    $link_add = '/customer/add';
    if (isset($_GET['relationship']))
    {
    	$relationship = $_GET['relationship'];
    	$link_add .= "?relationship=$relationship";
    }

    $str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"$link_add","onsubmit"=>"return kiemtra()"),$str_form_product);

    echo $str_form_product;

    if($this->get_config("nhap_kh_hienthi_ds") == "yes")
    {
    	$array_header_product =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
    		"code"=>array("Mã Khách Hàng",array("style"=>"text-align:center; width:10%")),
    		"fullname"=>array("Tên Khách Hàng",array("style"=>"text-align:left; width:15%")),
    		"address"=>array("Địa Chỉ",array("style"=>"text-align:left")),
    		"phone"=>array("Số Điện Thoại",array("style"=>"text-align:center")),
    		"tax_code"=>array("MST",array("style"=>"text-align:center")),
    		"group"=>array("Quan hệ",array("style"=>"text-align:center; width:8%")),
    		"tuychon"=>array("Tùy Chọn",array("style"=>"text-align:center; width:7%")),
    		);
    	$str_header_product = $this->Template->load_table_header($array_header_product);
    	$stt = 0;
    	$str_row_product = "";
    	if($array_dulieu_cu)
    	{
    		foreach($array_dulieu_cu as $khachhang)
    		{
    			$stt++;
    			$array_row_product = NULL;
    			$array_row_product["stt"] 			= array($stt,array("style"=>"text-align:center;"));
    			$array_row_product["code"]  	= array($khachhang["code"],array("style"=>"text-align:center;"));
    			$array_row_product["fullname"]  	= array($khachhang["fullname"],array("style"=>"text-align:left;"));
    			$array_row_product["address"]  	= array($khachhang["address"],array("style"=>"text-align:left;"));
    			$array_row_product["phone"]  	= array($khachhang["phone"],array("style"=>"text-align:center;"));
    			$array_row_product["tax_code"]  	= array($khachhang["tax_code"],array("style"=>"text-align:left;"));
    			$array_row_product["group"]  	= array($khachhang["group"],array("style"=>"text-align:center;"));

    			$link_sua 	= $this->Html->link(array("controller"=>"customer","action"=>"add","params"=>array($khachhang["id"])));
    			$link_sua	= "<br>".$this->Template->load_link("edit","Sửa",$link_sua);

    			$link_xoa 				= $this->Html->link(array("controller"=>"customer","action"=>"del","params"=>array($khachhang["id"])));
    			$link_xoa				= "<br>".$this->Template->load_link("del","Xóa",$link_xoa);

    			$array_row_product["tuychon"] 			= array($link_sua.$link_xoa,array("style"=>"text-align:center;"));


    			$str_row_product .= $this->Template->load_table_row($array_row_product);
    		}
    	}else
    	{
    		$array_row_product["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"7"));
    		$str_row_product .= $this->Template->load_table_row($array_row_product);
    	}
		//buoc 5: dung lam load_table de dữ liệu vào table
    	$str_table_product =  $this->Template->load_table($str_header_product.$str_row_product);
		//buoc 6: hien thi du lieu table ra man hinh
    	echo $str_table_product;
    }


    ?>
    <script>
    	<?php
    	if($this->get_config("nhatre") != "vietkid2")
    	{
    		?>
    		function kiemtra()
    		{
    			document.getElementById("group").value = $("#id_group :selected").text();
    		}

    		function hienthi_canhan_tochuc()
    		{
	//lấy giá trị combobook loại
	loai = document.getElementById('loai').value;
	if(loai == "0")
	{
		//hiện cá nhân
		document.getElementById('canhan').style.display = 'block';
		document.getElementById('tochuc').style.display = 'none';
	}
	else
	{
		//che cá nhân
		document.getElementById('canhan').style.display = 'none';
		document.getElementById('tochuc').style.display = 'block';

	}
}
hienthi_canhan_tochuc();
<?php
}
?>
$(function()
{
	$( "#birthdate" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#start_date" ).datepicker({dateFormat: "dd-mm-yy"})
});

</script>
