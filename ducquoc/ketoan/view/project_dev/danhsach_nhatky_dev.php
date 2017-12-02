<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/magnific-popup/magnific-popup.css">
<link rel="stylesheet" href="<?php echo $this->webroot;?>js/magnific-popup/magnific-popup.min.css">

<!-- jQuery 1.7.2+ or Zepto.js 1.0+
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<!-- Magnific Popup core JS file -->
<script src="<?php echo $this->webroot;?>js/magnific-popup/jquery.magnific-popup.js"></script>
<script src="<?php echo $this->webroot;?>js/magnific-popup/jquery.magnific-popup.min.js"></script>
<style>
#parent {
	min-height: 200px;
	max-height: 450px;
	height: auto;
	position: absolute;
    width: 100%;
    left: 0;
	overflow:scroll;
}

#table_tienthua {
				width: 1800px !important;
}

#table_tienthua td.selected { border: 1px solid #F00; }
</style>

<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************

	//kiem tra user hien tai co chuc nang giao viec hay khong
	$array_module = $this->User->modules;
	$chucnang_giaoviec = false;
	foreach($array_module as $module)
	{
		if(in_array("save_task", $module)) $chucnang_giaoviec = true;
	}
	////////////////////kiem tra user hien tai co chuc nang giao viec hay khong/////////////////

	//tieu de cua ham
	$function_title = "Danh Sách Nhật Ký";

	//tạo liên kết nhập tin

	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//lấy html combobox dự án
	$str_timkiem = " Khách hàng: ";
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"data[id_customer]","id"=>"id_customer","style"=>"width:300px"),$array_khachhang,$id_customer);

	$str_timkiem .= " Dự án: ";
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"data[id_project]","id"=>"id_project","style"=>"width:300px"),$array_du_an,$id_project);

	$str_timkiem .= " Người nhập: ";
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"data[id_created_user]","id"=>"id_created_user"),$array_nguoinhap,$id_created_user);

	$str_timkiem .= " Người thực hiện: ";
	$str_timkiem .= $this->Template->load_selectbox(array("name"=>"data[id_receive_user]","id"=>"id_receive_user"),$array_nguoinhap,$id_receive_user);

	$str_timkiem .= "<br> Từ ngày: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"data[tungay]","id"=>"tungay","style"=>"width:72px","value"=>$tungay));
	$str_timkiem .= " Đến ngày: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"data[denngay]","id"=>"denngay","style"=>"width:72px","value"=>$denngay));

	$str_timkiem .= " Request id: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"data[request_id]","id"=>"request_id","style"=>"width:72px","value"=>$request_id));


	$str_timkiem .= " Trạng thái: ";
	$array_trangthai = array("all"=>"Tất cả","0"=>"Chưa Tiếp Nhận","1"=>"Chưa Hoàn Thành","2"=>"Hoàn Thành","3"=>"Đã Hủy");
	$str_timkiem .= $this->Template->load_selectbox_basic(array("name"=>"data[trangthai]","id"=>"trangthai","style"=>"width:147px"),$array_trangthai,$trangthai);

	$str_timkiem .= " &nbsp;&nbsp; Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"data[tim]","id"=>"tim","style"=>"width:180px","value"=>$tim));
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm","type"=>"submit"),"Tìm");

	$str_timkiem .= $this->Template->load_hidden(array("name"=>"xuat","id"=>"xuat","style"=>"width:180px"));

	$str_timkiem .= " &nbsp;&nbsp;".$this->Template->load_button(array("id"=>"xuat_exel","style"=>"width:100px","value"=>"Xuất exel","type"=>"button","onclick"=>"exel()"),"Xuất exel");

	$str_form_product = $this->Template->load_form(array("method"=>"GET","id"=>"form_timkiem","action"=>"/project/diary.html"),$str_timkiem);

	echo $str_form_product;

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	//FUNCTION BODY
	//*****************************************

	//1: tao mang table header du_an
	$array_du_an_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width: 20px ")),
							"project"		  => array("Dự án",array("style"=>"text-align: center;")),
							"title"		  	=> array("Tên Công Việc",array("style"=>"text-align:center; width:100px")),
							"user_request" 	 => array("Người Yêu Cầu <br>---<br> Ngày yêu cầu",array("style"=>"text-align:center;  width:130px")),
							"created_username" => array("Người Nhập <br>---<br> Ngày nhập",array("style"=>"text-align:center; width:130px")),
							"username_receive" =>array("Người Làm <br>---<br> Ngày làm",array("style"=>"text-align:center;  width:130px")),
							"finish_date_expected"		=>array("Hoàn Thành <br> --- <br> (Dự Kiến/ Thực Tế)",array("style"=>"text-align:center; width:150px ")),
							"num_hour_expect"	=> array("Số Giờ<br>--- <br>(Dự Kiến / Thực Tế)",array("style"=>"text-align:center; width:130px")),

							"status"		=>array("Trạng Thái",array("style"=>"text-align:center; white-space:nowrap; width:100px"))

							);

	//2: lay html table header du_an(dong tren cung cua table)
	$str_header_du_an = $this->Template->load_table_header($array_du_an_header);


	//*****************************************************
	//3: lay du lieu du an tu Controler dua qua de xu ly
    $stt = 1;
	$str_row_du_an = "";
	$des = "";
	$group="";
	$id_created_user = "";
	$id = "";
	$so_congviec = $chua_tiep_nhan = $dang_thuc_hien = $hoanthanh = $huy = 0;

	if($array_diary != NULL)
	{
		$array_group_work=array(""=>"...","0"=>"Dịch vụ","1"=>"Môi trường Làm việc","2"=>"Nhân Sự");
		foreach($array_diary as $diary)
		{

			$group_work=$array_group_work[$diary["group_work"]];

			$id_created_user = $diary["id_created_user"];
			$id = $diary["id"];

			$start_date = date("d-m-Y",strtotime($diary["start_date"]));
			if($start_date == "01-01-1970") $start_date = "";

			$finish_date_expected = date("d-m-Y",strtotime($diary["finish_date_expected"]));
			if($finish_date_expected == "01-01-1970") $finish_date_expected = "";

			$finish_date = date("d-m-Y",strtotime($diary["finish_date"]));
			if($finish_date == "01-01-1970") $finish_date = "";

			$created = date("d-m-Y",strtotime($diary["created"]));

			$link_file	= $this->Company->file_url.$this->Company->upload_url;

			///XU LY HINH
			$str_img_dk = $diary["str_img"];
			$str_danhsach_hinh = "";
			if($str_img_dk != "" && $str_img_dk != NULL)
			{
				$str_danhsach_hinh .= "<div class='popup-gallery' style='min-height:155px'>";
				$array_img = explode(chr(8),$str_img_dk);
				if($array_img != NULL && count($array_img) > 0)
				{
					for($a = "0";$a < count($array_img);$a++)
					{
						$mota_img = "";
						$ten_img_dk = "";
						$array_img_mota =  explode(chr(7),$array_img[$a]);
						if($array_img_mota != NULL && count($array_img_mota) > 0)
						{
							if(isset($array_img_mota[1])) $mota_img = $array_img_mota[1];
							$ten_img_dk = $array_img_mota[0];
							$str_danhsach_hinh .= "<a href='".$link_file.$ten_img_dk."' class='popup-image' title='".$mota_img."'><img src='".$link_file.$ten_img_dk."' style='width:102px;float:left;margin:5px 5px'></a>";
						}
					}
				}
				$str_danhsach_hinh .= "</div>";
			}
			//END XU LY HINH

			//XU LY FILE
			$str_file_dk = $diary["str_file"];
			$str_danhsach_file = "";
			if($str_file_dk != "" && $str_file_dk != NULL)
			{
				$array_file = explode(chr(8),$str_file_dk);
				$str_danhsach_file = "<div>";
				if($array_file != NULL && count($array_file) > 0)
				{
					for($a = "0";$a < count($array_file);$a++)
					{
						$mota_file = "";
						$ten_file_dk = "";
						$array_file_mota =  explode(chr(7),$array_file[$a]);
						if($array_file_mota != NULL && count($array_file_mota) > 0)
						{
							$mota_file = $array_file_mota[1];
							$ten_file_dk = $array_file_mota[0];
							$str_link_file	= $this->Company->file_url.$this->Company->upload_url.$ten_file_dk;
							$str_danhsach_file	.= $this->Template->load_link("download",$mota_file,$str_link_file)."<br>";
						}
					}
				}
				$str_danhsach_file .= "</div>";
			}

			//END XU LY FILE

			//////////////////////////////////////////////////////////
			//Xử lý link sửa và xóa
			$link_sua = "";
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			//if(($this->User->type == "1") ||($this->User->ProjectDiary->allow_edit($id_created_user,$id))  || ($id_created_user == $this->User->id))
			//{
				$link_sua 	= $this->Html->link(array("controller"=>"project","action"=>"add_diary","params"=>array($diary["id"])));
				$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
			//}

			$link_xoa = "";
			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			if(($this->User->type == "1") ||($this->User->ProjectDiary->allow_delete($id_created_user,$id)) || ($id_created_user == $this->User->id))
			{
				$link_xoa 	= $this->Html->link(array("controller"=>"project","action"=>"delete_diary","params"=>array($diary["id"])));
				$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
			}
			////////////////////////////////////////////////////////

			$row_du_an = NULL;
			$row_du_an["stt"]				= array($stt++,array("style"=>"text-align:center;"));

			//thông tin cột dự án
			$str_project_name = $diary["project_name"]." - " .$diary["customer_name"];

			$str_module_name = $diary["module_name"];
			if($str_module_name != "" )
			{
				 $str_project_name .= "Module: ". $str_module_name . "<br>---<br>";
			}

			$str_function_name = $diary["function_name"];
			if($str_function_name != "" )
			{
				 $str_project_name .= "<br>---<br> Chức năng: ". $str_function_name ;
			}

			$row_du_an["project_name"] 		= array($str_project_name,array("style"=>"text-align:left;"));


			$des = str_replace("\n","<br>",$diary["des"]);



			//begin: title
			$title = "";

			if($diary["request_id"] != "")
			{
				if($title != "") $title .= "<br>";
				$title .= $diary["request_id"];
			}

			if($diary["title"] != "")
			{
				if($title != "") $title .= "<br>---<br>";
				$title .= $diary["title"];
			}

			if($des != "")
			{
				if($title != "") $title .= "<br>---<br>";
				$title .= $des;
			}
			if($str_danhsach_hinh != "")
			{
				if($title != "") $title .= "<br>";
				$title .= $str_danhsach_hinh;
			}
			if($str_danhsach_file != "")
			{
				if($title != "") $title .= "<br>";
				$title .= $str_danhsach_file;
			}





			$row_du_an["title"] 			= array($title,array("style"=>"text-align:left;"));
			//end: title

			$date_request = $diary["date_request"];
			$date_request = date("d-m-Y",strtotime($date_request));
			if($date_request == "01-01-1970") $date_request = "";

			$row_du_an["user_request"] 	 		= array($diary["user_request_fullname"]."<br>---<br>".$date_request,array("style"=>"text-align:center;"));

			$row_du_an["created_fullname"] 		= array($diary["created_fullname"] . "<br>---<br>" .$created,array("style"=>"text-align:center; "));

			$row_du_an["user_receive_fullname"]   = array($diary["user_receive_fullname"]. "<br>--<br>".$start_date,array("style"=>"text-align:center;"));

			$row_du_an["finish_date_expected"] 	= array($finish_date_expected ."<br> --- <br>".$finish_date,array("style"=>"text-align:center;"));

			$row_du_an["num_hour_expect"]  = array($diary["num_hour_expect"]  ."<br> --- <br>". $diary["num_hour_actual"],array("style"=>"text-align:center;"));

			//tính toán tổng số công việc
			if($diary["title"] != "") $so_congviec++;
			if($diary["status"] == "0") $chua_tiep_nhan++;
			if($diary["status"] == "1") $dang_thuc_hien++;
			if($diary["status"] == "2") $hoanthanh++;
			if($diary["status"] == "3") $huy++;


			/*if(($this->User->type == "1") || ($chucnang_giaoviec == true) && (($diary["status"] == "0") || ($diary["status"] == "")))
			{
				$task 	= $this->Html->link(array("controller"=>"project","action"=>"save_task","params"=>array($diary["id"])));
				$task	= "<br>".$this->Template->load_link("edit","Giao Việc",$task);
			}*/

			$link_quanitative = $this->Template->load_link("edit","Định Lượng","/project/quantitative/".$diary["id"].".html");
			$link = "<br>$link_quanitative<br>$link_sua<br>". $link_xoa;

			$row_du_an["status"] 			= array($array_trangthai[$diary["status"]].$link,array("style"=>"text-align:center;"));

			$str_row_du_an .= $this->Template->load_table_row($row_du_an);
		}//end for

		//thêm vào dòng tổng số công việc
			$array_du_an_header2 =  array("tongso"=>array("Tổng Số Công Việc",array("style"=>"text-align:center")),
							"chua_tiep_nhan"		=>array("Số Công Việc Chưa Tiếp Nhận",array("style"=>"text-align:center;")),
							"dang_thuc_hien"		=>array("Số Công Việc Đang Thực Hiện",array("style"=>"text-align:left;")),
							"hoanthanh"	=>array("Số Công Việc Đã Hoàn Thành",array("style"=>"text-align:center")),
							"huy"		=>array("Số Công Việc Đã Hủy",array("style"=>"text-align:center")),
							);

			//2: lay html table header du_an(dong tren cung cua table)
			$str_header_du_an2 = $this->Template->load_table_header($array_du_an_header2);


			//*****************************************************
			//3: lay du lieu du an tu Controler dua qua de xu ly
			//$str_row_du_an2 = "";

			$row_du_an2 = NULL;
			$row_du_an2["tongso"]				= array($so_congviec,array("style"=>"text-align:center;"));
			$row_du_an2["chua_tiep_nhan"]				= array($chua_tiep_nhan,array("style"=>"text-align:center;"));
			$row_du_an2["dang_thuc_hien"]				= array($dang_thuc_hien,array("style"=>"text-align:center;"));
			$row_du_an2["hoanthanh"]				= array($hoanthanh,array("style"=>"text-align:center;"));
			$row_du_an2["huy"]				= array($huy,array("style"=>"text-align:center;"));

			$str_row_du_an2 = $this->Template->load_table_row($row_du_an2);
	}//end if
	else
	{
		$row_du_an["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"9"));
		$str_row_du_an .= $this->Template->load_table_row($row_du_an);
	}

	//4: lay html cua table
	$str_du_an =  $this->Template->load_table($str_header_du_an.$str_row_du_an,array("border"=>"1","style"=>"width: 100%;"));
	$str_du_an2 =  $this->Template->load_table($str_header_du_an2.$str_row_du_an2,array("border"=>'1'));

	//5: hien thi html ra man hinh



	//*****************************************
	//END FUNCTION BODY
	//*****************************************
?>
<?php 	echo $this->Template->load_function_body($str_du_an.$str_du_an2); ?>

<script>

		  function exel()
		  {
			document.getElementById('xuat').value = '1';
			document.getElementById('form_timkiem').submit();
		  }


	//danh cho popup
	 $(document).ready(function() {
        $('.popup-gallery').magnificPopup({
          delegate: '.popup-image',
          type: 'image',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: 'Không có hình.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small></small>';
            }
          }
		})
        });
	  ////////////////////////////////////
$(function()
{
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"});
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"});
});
</script>
