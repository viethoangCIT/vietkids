<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Danh Sách Nhật Ký Khách Hàng";
	
	//tạo liên kết nhập tin
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	
	//lấy html combobox dự án
	$str_timkiem = $this->Template->load_selectbox(array("name"=>"id_customer","id"=>"id_customer","style"=>"width:250px"),$array_kh,$id_customer);
	
	$str_timkiem .= " &nbsp;&nbsp; Tìm kiếm: ";
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm","type"=>"submit"),"Tìm");
	
	$str_form_diary = $this->Template->load_form_row(array("title"=>"Khách Hàng","input"=>$str_timkiem));
	
	$str_form_diary = $this->Template->load_form(array("method"=>"GET","id"=>"form_timkiem","action"=>"/customer/customer_diary.html"),$str_form_diary);
	
	echo $str_form_diary;

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	//FUNCTION BODY
	//*****************************************
	
	//1: tao mang table header nhật ký
	$array_diary_header =  array("stt"=>array("Stt",array("style"=>"text-align:center; width:3%")),
							"customer_name"		=>array("Tên Khách Hàng",array("style"=>"text-align:center; width:10%")),
							"des"	=>array("Nội Dung",array("style"=>"text-align:center; width:25%")),
							"str_img"	=>array("File",array("style"=>"text-align:center; width:20%")),
							"issue_date" =>array("Ngày Gặp",array("style"=>"text-align:center;")),
							"place" =>array("Địa Điểm",array("style"=>"text-align:center;")),
							"created_username"		=>array("Người Nhập",array("style"=>"text-align:center")),
							"tuychon"		=>array("Tùy Chọn",array("style"=>"text-align:center")),
							);
							
	//2: lay html table header diary(dong tren cung cua table)						
	$str_header_diary = $this->Template->load_table_header($array_diary_header);
	
	
	//*****************************************************
	//3: lay du lieu du an tu Controler dua qua de xu ly
    $stt = 1;
	$str_row_diary = "";
	$id_created_user = "";	
	$id = "";	
	
	if($array_nhatky != NULL)
	{
		foreach($array_nhatky as $diary)
		{
			$id_created_user = $diary["id_created_user"];
			$id = $diary["id"];
			
			$issue_date = date("d-m-Y",strtotime($diary["issue_date"]));
			if($issue_date == "01-01-1970") $issue_date = "";
			
			$link_file	= $this->Company->file_url.$this->Company->upload_url;
			
			///XU LY HINH 
			$str_img_dk = $diary["str_img"];
			$str_danhsach_hinh = "";
			if($str_img_dk != "" && $str_img_dk != NULL)
			{
				$str_danhsach_hinh .= "<div class='popup-gallery'>";
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
							$mota_img = $array_img_mota[1];
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
			
			$row_diary = NULL;
			$row_diary["stt"]				= array($stt++,array("style"=>"text-align:center;"));
			$row_diary["customer_name"] 		= array($diary["customer_name"],array("style"=>"text-align:center;"));	
			
			$des = str_replace("\n","<br>",$diary["des"]);
			$row_diary["des"] 			= array($des,array("style"=>"text-align:left;"));
			
			$row_diary["str_img"] 				= array($str_danhsach_hinh."<br>".$str_danhsach_file,array("style"=>"text-align:center;"));
			$row_diary["issue_date"] 	= array($issue_date,array("style"=>"text-align:center;"));	
			$row_diary["place"] 	= array($diary["place"],array("style"=>"text-align:center;"));	
			$row_diary["created_username"] 		= array($diary["created_username"],array("style"=>"text-align:center;"));	
			
			$link_sua = "";		
			//kiểm tra user hiện tại có được sửa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được sửa dòng dữ liệu với id này không?
			if(($this->User->CustomerDiary->allow_edit($id_created_user,$id))  || ($id_created_user == $this->User->id))
			{
				$link_sua 	= $this->Html->link(array("controller"=>"customer","action"=>"add_customer_diary","params"=>array($diary["id"])));
				$link_sua	= "<br>".$this->Template->load_link("edit","Sửa",$link_sua);	
			}
			
			$link_xoa = "";
			//kiểm tra user hiện tại có được xóa dòng dữ liệu được tạo ra bởi id_created_user hoặc có quyền được xóa dòng dữ liệu với id này không?
			if(($this->User->CustomerDiary->allow_delete($id_created_user,$id)) || ($id_created_user == $this->User->id))
			{
				$link_xoa 	= $this->Html->link(array("controller"=>"customer","action"=>"del_customer_diary","params"=>array($diary["id"])));	
				$link_xoa	= "<br>".$this->Template->load_link("del","Xóa",$link_xoa);
			}
			
			$row_diary["tuychon"] 			= array($link_sua.$link_xoa,array("style"=>"text-align:center;"));	
			
			$str_row_diary .= $this->Template->load_table_row($row_diary);
		}//end for
		
	}//end if
	else
	{
		$row_diary["nodata"] 		= array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"8"));	
		$str_row_diary .= $this->Template->load_table_row($row_diary);	
	}
	
	//4: lay html cua table
	$str_diary =  $this->Template->load_table($str_header_diary.$str_row_diary,array("style"=>"width:100%"));
	 
	//5: hien thi html ra man hinh
	echo $this->Template->load_function_body($str_diary);
	
	
	//*****************************************
	//END FUNCTION BODY
	//*****************************************		
?> 
<script>
		 
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
		  
</script>