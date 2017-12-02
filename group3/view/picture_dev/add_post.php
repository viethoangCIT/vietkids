<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	
	
	$function_title = "Nhập Bài Viết ";
	//print_r( $this->User->modules);
	//echo $this->get_config("mo");
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	$id 			= "";
	$code 		  = "";
	$url_key 	   = "";
	$title 		 = "";
	$desc 		  = "";
	$img 		   = "";
	$address       = "";
	$content       = "";
	$id_post_group = "";
	$group_key      = "";
	$price_from      = "";
	$price_to        = "";
	$number 	    = "";
	$num_star 	  = "";
	$id_city 		 = "";
	$city_name 	   = "";
	$city_code 	 = "";
	$state_code 	= "";
	$country_code  = "";
	$lang 		  = "";
	$hot 		   = "";
	$list_relate_pic = "";
	$list_relate_id = "";
	$tags 		  = "";
	$num_view 	  = "";
	$num_like      = "";
	$approved      = "";
	$sale_off        = "";
	$sale_off_value = "";	
	$producer = "";
	$producer_img = "";
	$unit = "";
	$made_in = "";
	$title_en = "";
	$desc_en  = "";
	$content_en = "";
	$str_file = "";
	$id_user 	   = "";
	$hotel_rooms   = "";
	$restautant_foods = "";
	$name_post_group = "";
	$id_org = "";
	$org_name = "";
	$post_date = "";
	$order_number = "";
	$dathang = "";
	$video ="";
	$product_content = "";
	
	$title_tag = "";
	$desc_tag = "";
	$keyword_tag = "";
	$list_id_dieuhanh_user_view = "";
	$list_id_dieuhanh_user_approval = "";
	
	$str_file_dk = "";
	if($array_post)
	{
		if(isset($array_post[0]["dathang"])) 	$dathang = $array_post[0]["dathang"];
		$id 			  = $array_post[0]["id"];
		$code 		    = $array_post[0]["code"];
		$url_key 	     = $array_post[0]["url_key"];
		$title		   = $array_post[0]["title"];
		$desc 		    = $array_post[0]["desc"];
		$img 			 = $array_post[0]["img"];
		$address         = $array_post[0]["address"];
		$content         = $array_post[0]["content"];
		$id_post_group   = $array_post[0]["id_post_group"];
		$name_post_group = $array_post[0]["name_post_group"];
		$group_key        = $array_post[0]["group_key"];
		
		$price_from           = $array_post[0]["price_from"];
		$price_to           = $array_post[0]["price_to"];
		
		$producer	= $array_post[0]["producer"];
		if(isset($array_post[0]["producer_img"]))	$producer_img = $array_post[0]["producer_img"];
		$unit		= $array_post[0]["unit"];
		$made_in	= $array_post[0]["made_in"];
		
		$number          = $array_post[0]["number"];
		$num_star	    = $array_post[0]["num_star"];
		$id_city 		 = $array_post[0]["id_city"];
		$city_name 	   = $array_post[0]["city_name"];
		$city_code       = $array_post[0]["city_code"];
		$state_code      = $array_post[0]["state_code"];
		$country_code    = $array_post[0]["country_code"];
		$lang 		    = $array_post[0]["lang"];
		$hot 			 = $array_post[0]["hot"];
		$list_relate_pic = $array_post[0]["list_relate_pic"];
		$list_relate_id  = $array_post[0]["list_relate_id"];
		$tags 			= $array_post[0]["tags"];
		$num_view 		= $array_post[0]["num_view"];
		$num_like 		= $array_post[0]["num_like"];
		$approved 		= $array_post[0]["approved"];
		$sale_off 		  = $array_post[0]["sale_off"];
		$sale_off_value 		  = $array_post[0]["sale_off_value"];
		$id_user         = $array_post[0]["id_user"];
		$user_name	   = $array_post[0]["user_name"];
		$hotel_rooms 	 = $array_post[0]["hotel_rooms"];
		$restautant_foods  = $array_post[0]["restautant_foods"];
		$id_org 			= $array_post[0]["id_org"];
		$org_name 		  = $array_post[0]["org_name"];
		$post_date         =  $array_post[0]["post_date"];//date("d-m-Y", strtotime($array_post[0]["post_date"]));
		$order_number = $array_post[0]["order_number"];
		
		if(isset($array_post[0]["video"])) $video = $array_post[0]["video"];
		if(isset($array_post[0]["product_content"])) $product_content = $array_post[0]["product_content"];
		//$title_en = $array_post[0]['title_en'];
		//$desc_en  = $array_post[0]['desc_en'];
		//$content_en = $array_post[0]['content_en'];	
		$title_tag =  $array_post[0]["title_tag"];
		$desc_tag =  $array_post[0]["desc_tag"];
		$keyword_tag =  $array_post[0]["keyword_tag"];
		
		$list_id_dieuhanh_user_view = $array_post[0]["list_id_dieuhanh_user_view"];
		$list_id_dieuhanh_user_approval = $array_post[0]["list_id_dieuhanh_user_approval"];
		
		$str_file_dk = $array_post[0]["str_file"];
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	//KIỂM TRA CÓ NGÔN NGỮ HAY KHÔNG
	if($this->Company->langs != "")
	{ 
		$tmp_ngonngu = explode("|",$this->Company->langs);
		$array_lang = NULL;
		for($i = 0;$i<= count($tmp_ngonngu);$i++)
		{
			if(isset($tmp_ngonngu[$i]))
			{
				$ngonngu_item = $tmp_ngonngu[$i];
				$tmp_array_ngonngu_item = explode(":",$ngonngu_item);
			}
			//neu co du gia tri thi dua vao mang ngon ngu
			if(isset($tmp_array_ngonngu_item[0])) if(isset($tmp_array_ngonngu_item[1]))	$array_lang[$tmp_array_ngonngu_item[0]] = $tmp_array_ngonngu_item[1];

		}
		if(isset($_GET['giatri']))  $lang = $_GET['giatri'];
		
		//$array_lang = array("vn"=>"Tiếng Việt","en"=>"English","jp"=>"Tiếng Nhật","cn"=>"Tiếng Trung");
		$str_form_post = $this->Template->load_form_row(array("title"=>" Ngôn Ngữ ","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[Post][lang]","style"=>"width:90%",
		"onchange"=>"thaydoi()","id"=>"chonngonngu"),$array_lang,$lang)));	
	}
	
	// KET THUC KIEM TRA NGON NGU
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//KIEM TRA CO THANH PHO HAY KHONG
	if($array_city)
	{
		$str_combo_city = $this->Template->load_selectbox(array("name"=>"data[Post][id_city]","value"=>$id_city,"style"=>"width:30%","id"=>"nhom_city","onchange"=>"xem()"),$array_city,$tmp_id_city);
		$str_button_xem = $this->Template->load_button(array("name"=>"xem_city","onclick"=>"xem()"),"XEM");
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Tỉnh Thành ","input"=>$str_combo_city.$str_button_xem));
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//KET THUC KIEM TRA THANH PHO
	
	$str_button_cat = $str_button_xem = $this->Template->load_button(array("id"=>"opener","type"=>"button"),"CHỌN NHÓM");
	$str_textbox_cat = $this->Template->load_textbox(array("name"=>"data[Post][name_post_group]","value"=>$name_post_group,"style"=>"width:40%","id"=>"nhom"));
	$str_form_post .= $this->Template->load_form_row(array("title"=>" Thuộc Nhóm ","input"=>$str_textbox_cat.$str_button_cat));
	$str_label_tieude = 'Tiêu Đề ';
	//echo "--".$this->get_key('label_noidung')."--";
	if($this->get_key('label_tieude') != "" && $this->get_key('label_tieude') != NULL && $this->get_key('label_tieude') != 'label_tieude') 
	{
		$str_label_tieude = $this->get_key('label_tieude');
	}
	$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_tieude,"input"=>$this->Template->load_textbox(array("name"=>"data[Post][title]","id"=>"title","value"=>$title,"style"=>"width:90%"))));
	$str_form_post .= $this->Template->load_form_row(array("title"=>"URL Key ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][url_key]","value"=>$url_key,"id"=>"url_key","style"=>"width:90%"))));

	$str_form_post .= $this->Template->load_form_row(array("title"=>"Mã ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][code]","value"=>$code,"style"=>"width:90%"))));
	//up load hinh
	$str_img = $this->Template->load_hidden(array("name"=>"data[Post][img]","id"=>'img',"value"=>$img,"style"=>"width:20%"));
	$str_uploadbar = $this->Template->load_upload_bar("upload_container","select_img","upload_img","list_img","result_upload");
	$img_tag = "<img src='' style='width:200px' id='hinh_minhhoa'>";
	$str_form_post .= $this->Template->load_form_row(array("title"=>"Hình Minh Họa","input"=>$str_img.$img_tag.$str_uploadbar));
	$str_form_post .= $this->Template->load_form_row(array("title"=>" Mô Tả ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][desc]","style"=>"width:90%"),$desc)));
	
	
	
	
	
	
	
	//*******************************************************************************************************************//
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// XU LY LOAI BAI VIET
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//nếu loại bài viết là article
	if($post_type == "article")
	{
		$str_uploadbar_noidung =$this->Template->load_upload_bar("upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung");
		$text_noidung = "Upload Hình:".$str_uploadbar_noidung;
	
		$str_label_noidung = 'Nội Dung';
		//echo "--".$this->get_key('label_noidung')."--";
		if($this->get_key('label_noidung') != "" && $this->get_key('label_noidung') != NULL && $this->get_key('label_noidung') != 'label_noidung') 
		{
			$str_label_noidung = $this->get_key('label_noidung');
		}
		$text_noidung .= $this->Template->load_textarea(array("name"=>"data[Post][content]","id"=>"content23"),$content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_noidung,"input"=>$text_noidung));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Bài Viết Liên Quan","input"=>$this->Template->load_textbox(array("name"=>"data[Post][list_relate_id]","value"=>$list_relate_id,"style"=>"width:90%"))));
		
	}
	//kết thúc loại bài viết là article
	
	//nếu loại bài viết là tin tức
	if($post_type == "news")
	{
		$str_uploadbar_noidung =$this->Template->load_upload_bar("upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung");
		$text_noidung = "Upload Hình:".$str_uploadbar_noidung;

		$str_label_noidung = 'Nội Dung';
	//echo "--".$this->get_key('label_noidung')."--";
		if($this->get_key('label_noidung') != "" && $this->get_key('label_noidung') != NULL && $this->get_key('label_noidung') != 'label_noidung') 
		{
			$str_label_noidung = $this->get_key('label_noidung');
		}
		$text_noidung .= $this->Template->load_textarea(array("name"=>"data[Post][content]","id"=>"content23"),$content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_noidung,"input"=>$text_noidung));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Bài Viết Liên Quan","input"=>$this->Template->load_textbox(array("name"=>"data[Post][list_relate_id]","value"=>$list_relate_id,"style"=>"width:90%"))));
	}
	//kết thúc loại bài viết là tin tức
	
	
	//nếu loại bài viết là sản phẩm
	if($post_type == "product")
	{
		$str_uploadbar_noidung =$this->Template->load_upload_bar("upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung");
		$text_noidung = "Upload Hình:".$str_uploadbar_noidung;

		$str_label_noidung = 'Nội Dung';
	//echo "--".$this->get_key('label_noidung')."--";
		if($this->get_key('label_noidung') != "" && $this->get_key('label_noidung') != NULL && $this->get_key('label_noidung') != 'label_noidung') 
		{
			$str_label_noidung = $this->get_key('label_noidung');
		}
		$text_noidung .= $this->Template->load_textarea(array("name"=>"data[Post][content]","id"=>"content23"),$content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_noidung,"input"=>$text_noidung));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Thấp Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_from]","value"=>$price_from,"style"=>"width:90%","id"=>"id5"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Cao Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_to]","value"=>$price_to,"style"=>"width:90%","id"=>"id6"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Đơn Vị Tính","input"=>$this->Template->load_textbox(array("name"=>"data[Post][unit]","value"=>$unit,"style"=>"width:90%"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Nhà Sản Xuất ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][producer]","value"=>$producer,"style"=>"width:90%"))));
		
		
		$str_img2 = $this->Template->load_textbox(array("name"=>"data[Post][producer_img]","id"=>'img2',"value"=>$producer_img,"style"=>"width:20%"));
		$str_uploadbar2 =$this->Template->load_upload_bar("upload_container3","select_img3","upload_img3","list_img3","result_upload3");
		$str_img3 = "<img src='' id='hinh_logo' width='100px' height='100px' style='margin-left:10px'/>";
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Hình Của Nhà Sản Xuất","input"=>$str_img2.$str_img3.$str_uploadbar2));
		
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Xuất Xứ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][made_in]","value"=>$made_in,"style"=>"width:90%"))));
		
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Số Lượng ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][number]","value"=>$number,"style"=>"width:90%"))));
		
		$str_uploadbar_thongsokythuat =$this->Template->load_upload_bar("upload_container_thongsokythuat","select_img_thongsokythuat","upload_img_thongsokythuat","list_img_thongsokythuat","result_upload_thongsokythuat");
		$text_thongsokythuat = "Upload Hình:".$str_uploadbar_thongsokythuat;
	
		$str_label_motachitiet = ' Mô tả chi tiết sản phẩm ';
		if($this->get_key('label_thongsokythuat') != "" && $this->get_key('label_thongsokythuat') != NULL && $this->get_key('label_thongsokythuat') != 'label_thongsokythuat') 
		{
			$str_label_motachitiet = $this->get_key('label_thongsokythuat');
		}
	
		$text_thongsokythuat .= $this->Template->load_textarea(array("name"=>"data[Post][product_content]","id"=>"content_thongsokythuat"),$product_content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_motachitiet,"input"=>$text_thongsokythuat));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$array_yesno = array("0"=>"Không","1"=>"Có");
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Khuyến Mãi","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[Post][sale_off]"),$array_yesno,$sale_off)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Khuyến Mãi Bao Nhiêu","input"=>$this->Template->load_textbox(array("name"=>"data[Post][sale_off_value]","value"=>		$sale_off_value,"style"=>"width:90%"))));
		$array_yesno = array("0"=>"Không","1"=>"Có");
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Đặt Hàng ","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[Post][dathang]"),$array_yesno,$dathang)));
	
	
	}
	//kết thúc loại bài viết là sản phẩm
	
	//nếu loại bài viết là dịch vụ
	if($post_type == "service")
	{
		$str_uploadbar_noidung =$this->Template->load_upload_bar("upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung");
		$text_noidung = "Upload Hình:".$str_uploadbar_noidung;

		$str_label_noidung = 'Nội Dung';
	//echo "--".$this->get_key('label_noidung')."--";
		if($this->get_key('label_noidung') != "" && $this->get_key('label_noidung') != NULL && $this->get_key('label_noidung') != 'label_noidung') 
		{
			$str_label_noidung = $this->get_key('label_noidung');
		}
		$text_noidung .= $this->Template->load_textarea(array("name"=>"data[Post][content]","id"=>"content23"),$content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_noidung,"input"=>$text_noidung));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Thấp Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_from]","value"=>$price_from,"style"=>"width:90%","id"=>"id5"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Cao Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_to]","value"=>$price_to,"style"=>"width:90%","id"=>"id6"))));
		
	}
	//kết thúc loại bài viết là dịch vụ
	
	//nếu loại bài viết là khách sạn
	if($post_type == "hotel")
	{
		$str_uploadbar_noidung =$this->Template->load_upload_bar("upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung");
		$text_noidung = "Upload Hình:".$str_uploadbar_noidung;

		$str_label_noidung = 'Nội Dung';
	//echo "--".$this->get_key('label_noidung')."--";
		if($this->get_key('label_noidung') != "" && $this->get_key('label_noidung') != NULL && $this->get_key('label_noidung') != 'label_noidung') 
		{
			$str_label_noidung = $this->get_key('label_noidung');
		}
		$text_noidung .= $this->Template->load_textarea(array("name"=>"data[Post][content]","id"=>"content23"),$content);
		$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_noidung,"input"=>$text_noidung));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Địa Chỉ ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][address]","value"=>$address,"style"=>"width:90%"))));
	
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Số Sao ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][num_star]","value"=>$num_star,"style"=>"width:90%"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Số Phòng Khách Sạn ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][hotel_rooms]","value"=>$hotel_rooms,"style"=>"width:90%"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Thấp Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_from]","value"=>$price_from,"style"=>"width:90%","id"=>"id5"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Cao Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_to]","value"=>$price_to,"style"=>"width:90%","id"=>"id6"))));
	}
	//kết thúc loại bài viết là khách sạn
	
	//nếu loại bài viết là nhà hàng
	if($post_type == "restaurant")
	{
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Video ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][video]","style"=>"width:90%"),$video)));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Địa Chỉ ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][address]","value"=>$address,"style"=>"width:90%"))));
	
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Thực Đơn ","input"=>$this->Template->load_textbox(array("name"=>"data[Post][restautant_foods]","value"=>$restautant_foods,"style"=>"width:90%"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Thấp Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_from]","value"=>$price_from,"style"=>"width:90%","id"=>"id5"))));
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Giá Cao Nhất","input"=>$this->Template->load_textbox(array("name"=>"data[Post][price_to]","value"=>$price_to,"style"=>"width:90%","id"=>"id6"))));
	}
	//kết thúc loại bài viết là nhà hàng
	
	//nếu loại bài viết là thư viện ảnh
	if($post_type == "album")
	{
		
	}
	//kết thúc loại bài viết là thư viện ảnh
	
	//nếu loại bài viết là tài liệu
	if($post_type == "document")
	{
		
	}
	//kết thúc loại bài viết là tài liệu
	
	//*******************************************************************************************************************//
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//KET THUC XU LY LOAI BAI VIET
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//*******************************************************************************************************************//

	
	if($array_post_org)
	{
		$str_form_post .= $this->Template->load_form_row(array("title"=>" Nhà Cung Ứng ","input"=>$this->Template->load_selectbox(array("name"=>"data[Post][id_org]","value"=>$id_org,"style"=>"width:90%","id"=>"nhom2"),$array_post_org,$id_org," "," ")));
	}
	//up load hinh
	$str_img2 = $this->Template->load_hidden(array("name"=>"data[Post][list_relate_pic]","id"=>'other_pic',"value"=>$list_relate_pic,"style"=>"width:20%"));
	$str_uploadbar =$this->Template->load_upload_bar("upload_container2","select_img2","upload_img2","list_img2","result_upload2");
	$str_img3 = "<img src='' id='hinh_logo' width='100px' height='100px' style='margin-left:10px'/>";
	
	$str_label_hinhanhlienquan = 'Hình Ảnh Liên Quan';
	if($post_type == "album") $str_label_hinhanhlienquan = 'Hình Ảnh thuộc Album';
	if($this->get_key('label_hinhanhlienquan') != "" && $this->get_key('label_hinhanhlienquan') != NULL && $this->get_key('label_hinhanhlienquan') != 'label_hinhanhlienquan') 
	{
		$str_label_hinhanhlienquan = $this->get_key('label_hinhanhlienquan');
	}
	$str_ds_hinhanh_lienquan = "<table id='ds_hinhanh_lienquan' class='rwd-table' align='center'><tr><td>STT</td><td>Hình Ảnh</td><td>Mô tả ảnh</td><td>Xóa</td></tr></table>";
	$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_hinhanhlienquan,"input"=>$str_img2.$str_img3.$str_uploadbar.$str_ds_hinhanh_lienquan));
	

	$str_form_post .= $this->Template->load_form_row(array("title"=>"Ngày Đăng","input"=>$this->Template->load_textbox(array("name"=>"data[Post][post_date]","value"=>$post_date,"id"=>"post_date"))));
	$str_form_post .= $this->Template->load_form_row(array("title"=>"Số Thứ Tự","input"=>$this->Template->load_textbox(array("name"=>"data[Post][order_number]","value"=>$order_number,"style"=>"width:90%","id"=>"order_number"))));
	
	$array_yesno = array("0"=>"Không","1"=>"Có");
	$str_form_post .= $this->Template->load_form_row(array("title"=>" HOT ","input"=>$this->Template->load_selectbox_basic(array("name"=>"data[Post][hot]"),$array_yesno,$hot)));
	
	///upload file đính kèm
	$str_file = $this->Template->load_hidden(array("name"=>"data[Post][str_file]","id"=>'file_dinhkem',"value"=>$str_file_dk,"style"=>"width:20%"));
	$str_uploadbar =$this->Template->load_upload_bar("upload_container_file","select_file","upload_file","list_file","result_upload_file");
	
	$str_label_file_dinhkem = 'File Đính kèm';
	
	$str_ds_file_dinhkem = "<table id='ds_file' class='rwd-table' align='center'><tr><td>STT</td><td>File</td><td>Mô file</td><td>Xóa</td></tr></table>";
	$str_form_post .= $this->Template->load_form_row(array("title"=>$str_label_file_dinhkem,"input"=>$str_file.$str_uploadbar.$str_ds_file_dinhkem));
	//end file đính kèm
	
	$str_form_post .= $this->Template->load_form_row(array("title"=>" THẺ TITLE ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][title_tag]","style"=>"width:90%"),$title_tag)));
	$str_form_post .= $this->Template->load_form_row(array("title"=>" THẺ DESCRIPTION ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][desc_tag]","style"=>"width:90%"),$desc_tag)));
	$str_form_post .= $this->Template->load_form_row(array("title"=>" THẺ KEYWORD ","input"=>$this->Template->load_textarea(array("name"=>"data[Post][keyword_tag]","style"=>"width:90%"),$keyword_tag)));
	
	
	if(isset($_GET["user"]))
	{
		if($_GET["user"] == "dieuhanh")
		{
			$str_form_post .= $this->Template->load_form_row(array("title"=>"Người được xem ","input"=>$this->Template->load_textbox(array("value"=>"","style"=>"width:90%","id"=>"chon_nguoi_xem"))));
			$str_form_post .= $this->Template->load_hidden(array("name"=>"data[Post][list_id_dieuhanh_user_view]","id"=>"value_nguoi_dc_xem","value"=>$list_id_dieuhanh_user_view));
			$str_form_post .= $this->Template->load_form_row(array("title"=>"","input"=>"<div id='tab-nguoi_dc_xem' style='margin-top: 10px;margin-bottom: 10px;'></div>"));
			
			$str_form_post .= $this->Template->load_form_row(array("title"=>"Người duyệt ","input"=>$this->Template->load_textbox(array("value"=>"","style"=>"width:90%","id"=>"chon_nguoi_duyet"))));
			$str_form_post .= $this->Template->load_hidden(array("name"=>"data[Post][list_id_dieuhanh_user_approval]","id"=>"value_nguoi_dc_duyet","value"=>$list_id_dieuhanh_user_approval));
			$str_form_post .= $this->Template->load_form_row(array("title"=>"","input"=>"<div id='tab-nguoi_dc_duyet' style='margin-top: 10px;margin-bottom: 10px;'></div>"));
		}
	}
	
	$str_post_group_ten=  $this->Template->load_hidden(array("name"=>"data[Post][id_post_group]","id"=>"id_post_group","value"=>$id_post_group));
	$str_org_name=  $this->Template->load_hidden(array("name"=>"data[Post][org_name]","id"=>"id_org","value"=>""));
	$str_city_name=  $this->Template->load_hidden(array("name"=>"data[Post][city_name]","id"=>"id_city","value"=>""));
	$str_type_post =  $this->Template->load_hidden(array("name"=>"data[Post][type]","id"=>"type","value"=>$post_type));
	
	//*********************************
	//begin: Duyệt, Chưa Duyệt
	//mục đích: Hiển thị dòng duyệt bài hoặc chưa duyệt bài
	echo "duyet::".$this->get_config("post_approved"); 
	if($this->get_config("post_approved")=="yes")
	{
		$array_yesno = array("0"=>"Chưa Duyệt","1"=>"Duyệt");
		$str_combo_approved = $this->Template->load_selectbox_basic(array("name"=>"data[Post][approved]"),$array_yesno,$approved);
		$str_form_post .= $this->Template->load_form_row(array("title"=>"Duyệt","input"=>$str_combo_approved));
	}
	//end: Duyệt, Chưa Duyệt
	//*********************************
	
	$str_id  = $this->Template->load_hidden(array("name"=>"data[Post][id]","value"=>"$id"));
	
	$str_form_post .= $this->Template->load_form_row(array("title"=>"","input"=>$str_city_name.$str_org_name.$str_post_group_ten.$str_id.$str_type_post.$this->Template->load_button(array("type"=>"submit","onclick"=>"kiemtra()"),"Lưu")));
	
	
	
	
	$str_form_post = $this->Template->load_form(array("method"=>"POST","action"=>"/post/add/$param_submit"),$str_form_post);
	$str_form_post = $this->Template->load_function_body($str_form_post);
	echo $str_form_post;

?>
<form method="post" action="<?php echo $this->webroot;?>post/add" id="tmp_frm" >
	<input type="hidden" name="tmp_id_city" id="tmp_id_city"/>

    
</form>
<div id="dialog" title="Basic dialog">
 <?php 
 ///////////////////////////////////////////////////Xử lý tree category
 	$ngonngu = "";
 	if(isset($_GET['giatri'])) 
	{	
		if($_GET['giatri'] == 'en')
		$ngonngu = '_en';
	}
	$str_tree_cat = "";
	$tmp_level = "";
	$so_lan_mo = 0;
	$tmp_id_post_group = "";
 	if($array_post_cat)
	{
		//echo $array_post_cat[0]["title"] ;
		foreach($array_post_cat as $post_group)
		{
				$title2 = $post_group["title$ngonngu"];
				$tmp_id_post_group = $post_group["id"];;
				//if($post_group["url_key"] == $url_key) //$active2 = "active";
				
				//truong hop di vao cap con
				if($tmp_level < $post_group["level"])
				{
					$str_tree_cat .= "<ul><li>";
					$so_lan_mo++;
					
				}else
				{
					//truong hop = cap
					if($tmp_level == $post_group["level"]) $str_tree_cat .= "</li><li>";
					else 
					{
						//$tmp_level > $post_group["level"]
						//truong hop lớn hơn cấp
						for($i =$post_group["level"];$i <$tmp_level;$i++) $str_tree_cat .= "</li></ul>";	
						
						$str_tree_cat .= "</li><li>";
						$so_lan_mo--;	
					}
					
					
				}
				$str_tree_cat .= "<a href='javascript:void(0)' onclick='chon_nhom(\"$title2\",\"$tmp_id_post_group\")'>$title2</a>";
				$tmp_level = $post_group["level"];
				
			}//end for
		
			//dong the ul,li cuoi cung
			for($i = 1; $i<= $tmp_level ;$i++) $str_tree_cat .= "</li></ul>";	
			
	}
	echo $str_tree_cat;
	
	////////////////////////////////////////////////
 ?>
</div>
<!-- up load hinh -->
<script type="text/javascript" src="<?php echo $this->webroot;?>js/uploadfile/js/plupload.full.min.js">
</script>
<?php

$luuhinh = $this->Company->file_url.$this->Company->upload_url;

   echo $this->Template->load_upload_js("img2","upload_container3","select_img3","upload_img3","list_img3","result_upload3","uploader3",array("Image Files"=>"jpg,png,jpeg,gif"),"5");
   
   echo $this->Template->load_upload_js("img","upload_container","select_img","upload_img","list_img","result_upload","uploader",array("Image Files"=>"jpg,png,jpeg,gif,pdf"),"1","xem_hinh_minhhoa");
   echo $this->Template->load_upload_js("other_pic","upload_container2","select_img2","upload_img2","list_img2","result_upload2","uploader2",array("Image Files"=>"jpg,png,jpeg,gif"),"20","hienthi_hinh_lienquan");
   echo $this->Template->load_upload_js("abc","upload_container_noidung","select_img_noidung","upload_img_noidung","list_img_noidung","result_upload_noidung","uploader_noidung",array("Image Files"=>"jpg,png,jpeg,gif"),"20","hienthi");
   echo $this->Template->load_upload_js("file_dinhkem","upload_container_file","select_file","upload_file","list_file","result_upload_file","uploader_file",array("Image Files"=>"txt,pdf,xls,xlsx,doc"),"20","hienthi_file");
   
   echo $this->Template->load_upload_js("abc2","upload_container_thongsokythuat","select_img_thongsokythuat","upload_img_thongsokythuat","list_img_thongsokythuat","result_upload_thongsokythuat","uploader_thongsokythuat",array("Image Files"=>"jpg,png,jpeg,gif"),"20","hienthi2");
?>

<!-- thu vien ckeditor -->
<script language="javascript" src="<?php echo $this->webroot;?>js/ckeditor/ckeditor.js"></script>
<script language="javascript"> 
    CKEDITOR.replace( 'content23' );
</script>
<script language="javascript"> 
    CKEDITOR.replace( 'content_thongsokythuat' );
</script>

<?php 
		$str = $_SERVER['REQUEST_URI'];
		//echo "HELLO".$str."----";
		$str = ltrim($str, '/');
		$str = str_replace('?giatri=en','',$str);
		$str = str_replace('?giatri=vn','',$str);
		$str = $this->webroot.$str;
		//echo "HELLO".$str;
		
?>
<script>
	function thaydoi()
	{
		var giatri = document.getElementById('chonngonngu').value;
		var duongdan = '<?php echo $str;?>?giatri='+giatri;
		window.location.href = duongdan;
	}
	<!-- thu vien ngay -->
	$(function() {
		$( "#created" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#post_date" ).datepicker({dateFormat: 'dd-mm-yy'});
		$( "#modified" ).datepicker({dateFormat: 'dd-mm-yy'});
		
		//bien the div co id=dialog thanh windows
		$( "#dialog" ).dialog({autoOpen: false,show: {effect: "blind",duration:500},hide: {effect: "explode",duration: 500}});
		//tao su kien cho button id = opener hien windows
		$( "#opener" ).click(function() {$( "#dialog" ).dialog( "open" );});
			
	});
	<!-- thu vien url_key -->
	$("#title").change(function()
	{
   		 $( "#url_key").val(remove_unicode($( "#title").val()));
	});
	
	 function kiemtra()
	 {
		 //document.getElementById("id_post_group").value=$("#nhom :selected").text();
		 document.getElementById("id_org").value=$("#nhom2 :selected").text();
		 document.getElementById("id_city").value=$("#nhom_city :selected").text();
	
	 }
 	function xem()
	{	
		document.getElementById("tmp_id_city").value = document.getElementById("nhom_city").value;
		document.getElementById("tmp_frm").submit();
		
	}
	
	xem_hinh_bandau();
	function xem_hinh_bandau()
	{
		var ten_hinh = '<?php echo $img ?>';
		if(ten_hinh != "")  xem_hinh_minhhoa(ten_hinh);
	}
	function xem_hinh_minhhoa(data)
	{
		str_img = "<?php echo $luuhinh;?>" + data ;
		document.getElementById("hinh_minhhoa").src = str_img;
		document.getElementById("img").src = data;
	}
	function hienthi(data)
	{
		str_img = "<img src='<?php echo $luuhinh;?>" + data + "'>"
		CKEDITOR.instances['content23'].insertHtml(str_img);
	}
	function hienthi2(data)
	{
		str_img = "<img src='<?php echo $luuhinh;?>" + data + "'>"
		CKEDITOR.instances['content_thongsokythuat'].insertHtml(str_img);
	}
	var stt_hinh = 0;
	<?php 
		if($list_relate_pic != "")
		{
			$array_list = explode(chr(8),$list_relate_pic);
			if($array_list != NULL && count($array_list) > 0)
			{
				for($a = "0";$a < count($array_list);$a++)
				{
					$mota_hinh = "";
					$ten_hinh = "";
					$array_hinh_mota =  explode(chr(7),$array_list[$a]);
					if($array_hinh_mota != NULL && count($array_hinh_mota) > 0)
					{
						$mota_hinh = $array_hinh_mota[1];
						$ten_hinh = $array_hinh_mota[0];
	?>
						hienthi_hinh_lienquan("<?php echo $ten_hinh ?>","<?php echo $mota_hinh ?>");
	<?php					
					}
				}
			}
		}
	?>
	
	
	function hienthi_hinh_lienquan(data,mota)
	{
		if(mota == null) mota = "vui lòng nhập mô tả";
		stt_hinh++;
		str_stt = "<td>"+stt_hinh+"<input type='hidden' id='ten_hinh_"+stt_hinh+"' value='"+data+"'></td>";
		
		str_img = "<td><img src='<?php echo $luuhinh;?>" + data + "' style='margin-left:10px;height:200px'></td>";
		
		str_input = "<td><textarea style='width:600px;height:100px' class='text_mota_hinh' id='text_mota_anh_"+stt_hinh+"'>"+mota+"</textarea></td>";
		str_xoa = "<td><a class='btn-icon-rotate' title='Xóa' onclick='xoa_anh_lienquan("+stt_hinh+")' ><i class='icon-remove'></i> Xóa</a></td>";
		
		str_row = str_stt + str_img + str_input + str_xoa;
			
		document.getElementById("ds_hinhanh_lienquan").innerHTML += "<tr id='row_"+stt_hinh+"'>"+str_row+"</tr>";
		//alert(stt_hinh);
		
		$( ".text_mota_hinh" ).keyup(function() {
			capnhat_mota_hinh();
  		
		});
		
	}
	var str_mota = "";
	
	function capnhat_mota_hinh()
	{
		var kytu_noi_hinh_va_mota =  String.fromCharCode(7);
		var kytu_noi_dong = String.fromCharCode(8);
		text_hinh = "";
		ten_hinh = "";
		mota_hinh = "";
		for(i=1;i<=stt_hinh;i++)
		{
			if(document.getElementById("text_mota_anh_"+i) != null)
			{
				ten_hinh = document.getElementById("ten_hinh_"+i).value;
				mota_hinh = document.getElementById("text_mota_anh_"+i).value;
				if(text_hinh == "") text_hinh += ten_hinh + kytu_noi_hinh_va_mota + mota_hinh;
				else text_hinh +=  kytu_noi_dong + ten_hinh + kytu_noi_hinh_va_mota + mota_hinh ;
			
			}
			
		}
		document.getElementById("other_pic").value = text_hinh;
	}
	
	function xoa_anh_lienquan(sothutu_hinh)
	{
		var table_hinhlienquan = document.getElementById("ds_hinhanh_lienquan");
    	table_hinhlienquan.removeChild(table_hinhlienquan.childNodes[sothutu_hinh]);
		stt_hinh--;
		capnhat_mota_hinh();
	}
	
	var stt_file = 0;
	<?php 
		if($str_file_dk != "" && $str_file_dk != NULL)
		{
			$array_file = explode(chr(8),$str_file_dk);
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
	?>
						hienthi_file("<?php echo $ten_file_dk; ?>","<?php echo $mota_file ?>");
	<?php					
					}
				}
			}
		}
	?>
	function hienthi_file(data,mota)
	{
		stt_file++;
		if(mota == null) mota = "vui lòng nhập mô tả";
		str_stt = "<td>"+stt_file+"<input type='hidden' id='ten_file_"+stt_file+"' value='"+data+"'></td>";
		
		str_img = "<td><a href='<?php echo $luuhinh;?>" + data + "' style='color:yellow' target='_blank'><i class='icon-download-alt'></i>"+data+"</a></td>";
		
		str_input = "<td><textarea style='width:800px;height:30px' class='text_mota_file' id='text_file_"+stt_file+"'>"+mota+"</textarea></td>";
		str_xoa = "<td><a class='btn-icon-rotate' title='Xóa' onclick='xoa_anh_lienquan("+stt_file+")' ><i class='icon-remove'></i> Xóa</a></td>";
		
		str_row = str_stt + str_img + str_input + str_xoa;
			
		document.getElementById("ds_file").innerHTML += "<tr id='row_"+stt_file+"'>"+str_row+"</tr>";
		//alert(stt_hinh);
		
		$( ".text_mota_file" ).keyup(function() {
			capnhat_mota_file();
  		
		});
		
	}
	function capnhat_mota_file()
	{
		var kytu_noi_hinh_va_mota =  String.fromCharCode(7);
		var kytu_noi_dong = String.fromCharCode(8);
		text_hinh = "";
		ten_hinh = "";
		mota_hinh = "";
		for(i=1;i<=stt_file;i++)
		{
			if(document.getElementById("text_file_"+i) != null)
			{
				ten_hinh = document.getElementById("ten_file_"+i).value;
				mota_hinh = document.getElementById("text_file_"+i).value;
				if(text_hinh == "") text_hinh += ten_hinh + kytu_noi_hinh_va_mota + mota_hinh;
				else text_hinh +=  kytu_noi_dong + ten_hinh + kytu_noi_hinh_va_mota + mota_hinh ;
			
			}
			
		}
		document.getElementById("file_dinhkem").value = text_hinh;
	}
	
	
	
	
	function chon_nhom(title,id_post_group)
	{
		document.getElementById('nhom').value = title;
		document.getElementById('id_post_group').value = id_post_group;
		$( "#dialog" ).dialog( "close" );

		
	}
	
	
 </script>  
 <?php
 if(isset($_GET["user"]))
	{
		if($_GET["user"] == "dieuhanh")
		{
 
 
 ?>
 <script>
$(function() {
	function split( val ) {
		return val.split( /,\s*/ );
	}
	function extractLast( term ) {
		return split( term ).pop();
	}

	var array_user = [
	<?php 
		foreach($array_user_dieuhanh as $user_dieuhanh)
		{
			echo "{";
			echo "value: '".$user_dieuhanh["id"]."',";
			echo "label: '".$user_dieuhanh["fullname"]."'";
			echo "},";
		}
	?>
	];
	//quyền xem
	$( "#chon_nguoi_xem" )
	 // don't navigate away from the field on tab when selecting an item
	.bind( "keydown", function( event ) {
	if ( event.keyCode === $.ui.keyCode.TAB &&
	$( this ).autocomplete( "instance" ).menu.active ) {
	event.preventDefault();
	}
	})
	.autocomplete({
	minLength: 0,
	source: function( request, response ) {
	// delegate back to autocomplete, but extract the last term
	response( $.ui.autocomplete.filter(
	array_user, extractLast( request.term ) ) );
	},
	
	//    source:projects,    
	focus: function() {
	// prevent value inserted on focus
	return false;
	},
	select: function( event, ui ) {
	var terms = split( this.value );
	// remove the current input
	terms.pop();
	// add the selected item
	terms.push( ui.item.value );
	// add placeholder to get the comma-and-space at the end
	terms.push( "" );
	
	this.value = terms.join( ", " );
	
		var selected_label = ui.item.label;
		var selected_value = ui.item.value;
	
		var values = $('#value_nguoi_dc_xem').val();
	
		if(values == "")
		{
			$('#value_nguoi_dc_xem').val(selected_value);
		}
		else    
		{
			$('#value_nguoi_dc_xem').val(values+","+selected_value);
			
		} 
		$( "#tab-nguoi_dc_xem" ).append("<span class='tag label label-info' id='label_id_user_"+selected_value+"' style='margin-right:10px;padding:5px;background-color:green'><span>"+ selected_label +"</span><a style='color:white' onclick='xoa_the_user("+selected_value+")'><i class='icon-remove'></i></a></span>");  
		 
	return false;
	}
	}); 
	
	//quyền duyệt
	$( "#chon_nguoi_duyet" )
	 // don't navigate away from the field on tab when selecting an item
	.bind( "keydown", function( event ) {
	if ( event.keyCode === $.ui.keyCode.TAB &&
	$( this ).autocomplete( "instance" ).menu.active ) {
	event.preventDefault();
	}
	})
	.autocomplete({
	minLength: 0,
	source: function( request, response ) {
	// delegate back to autocomplete, but extract the last term
	response( $.ui.autocomplete.filter(
	array_user, extractLast( request.term ) ) );
	},
	
	//    source:projects,    
	focus: function() {
	// prevent value inserted on focus
	return false;
	},
	select: function( event, ui ) {
	var terms = split( this.value );
	// remove the current input
	terms.pop();
	// add the selected item
	terms.push( ui.item.value );
	// add placeholder to get the comma-and-space at the end
	terms.push( "" );
	
	this.value = terms.join( ", " );
	
		var selected_label = ui.item.label;
		var selected_value = ui.item.value;
	
		var values = $('#value_nguoi_dc_duyet').val();
	
		if(values == "")
		{
			$('#value_nguoi_dc_duyet').val(selected_value);
		}
		else    
		{
			$('#value_nguoi_dc_duyet').val(values+","+selected_value);
			
		} 
		$( "#tab-nguoi_dc_duyet" ).append("<span class='tag label label-info' id='label_id_user_duyet_"+selected_value+"' style='margin-right:10px;padding:5px;background-color:green'><span>"+ selected_label +"</span><a style='color:white' onclick='xoa_the_user_duyet("+selected_value+")'><i class='icon-remove'></i></a></span>");  
		 
	return false;
	}
	});
	
	//vẽ 
	var list_id_dieuhanh_user_view = "<?php if($array_post) echo $array_post[0]["list_id_dieuhanh_user_view"]; ?>";
	var list_id_dieuhanh_user_approval = "<?php if($array_post) echo $array_post[0]["list_id_dieuhanh_user_approval"]; ?>";
	
	
	array_list_id_view = list_id_dieuhanh_user_view.split(",");
	array_list_id_approval = list_id_dieuhanh_user_approval.split(",");
	
	
	for(i=0;i<array_user.length;i++)
	{
		var id_user = array_user[i]["value"];
		var user_name = array_user[i]["label"];
		for(j=0;j<array_list_id_view.length;j++)
		{
			if(id_user == array_list_id_view[j])
			{
				$( "#tab-nguoi_dc_xem" ).append("<span class='tag label label-info' id='label_id_user_"+id_user+"' style='margin-right:20px'><span>"+ user_name +"</span><a style='color:white' onclick=\"xoa_the_user("+id_user+",'view')\"><i class='icon-remove'></i></a></span>"); 
			}
		}//end for array_list_id
		
		for(j=0;j<array_list_id_approval.length;j++)
		{
			if(id_user == array_list_id_approval[j])
			{
				$( "#tab-nguoi_dc_duyet" ).append("<span class='tag label label-info' id='label_id_user_duyet_"+id_user+"' style='margin-right:20px'><span>"+ user_name +"</span><a style='color:white' onclick=\"xoa_the_user_duyet("+id_user+",'edit')\"><i class='icon-remove'></i></a></span>"); 
			}
		}//end for array_list_id
		
		
		
	}//end for array_user
	
});

function xoa_the_user(id_user)
{
	//xóa label trên HTML
	$( "#label_id_user_"+id_user ).remove();
	
	//xóa id_user_da_chon tren hidden input luu 
	var str_list_id_user = document.getElementById("value_nguoi_dc_xem").value;
	
	//cộng 2 dấu phẩy 2 đầu để tránh lỗi xóa user có số ký tự dài hơn ( 1 và 21 hoặc 11)
	id_user = ","+id_user+",";
	str_list_id_user = ","+str_list_id_user+",";
	
	//xóa id_user_da_chon
	str_list_id_user = str_list_id_user.replace(id_user, ",");
	
	//xoa tất cả ký tự có 2 dấu phẩy cho phần từ đầu và phần tử cuối
	str_list_id_user = str_list_id_user.replace(",,", ",");
	
	//xóa ký tự đầu tiên và cuối cùng
	str_list_id_user = str_list_id_user.substr(1);
	str_list_id_user = str_list_id_user.substr(0, str_list_id_user.length-1); 
	
	document.getElementById("value_nguoi_dc_xem").value = str_list_id_user;
	
}
function xoa_the_user_duyet(id_user)
{
	//xóa label trên HTML
	$( "#label_id_user_duyet_"+id_user ).remove();
	
	//xóa id_user_da_chon tren hidden input luu 
	var str_list_id_user = document.getElementById("value_nguoi_dc_duyet").value;
	
	//cộng 2 dấu phẩy 2 đầu để tránh lỗi xóa user có số ký tự dài hơn ( 1 và 21 hoặc 11)
	id_user = ","+id_user+",";
	str_list_id_user = ","+str_list_id_user+",";
	
	//xóa id_user_da_chon
	str_list_id_user = str_list_id_user.replace(id_user, ",");
	
	//xoa tất cả ký tự có 2 dấu phẩy cho phần từ đầu và phần tử cuối
	str_list_id_user = str_list_id_user.replace(",,", ",");
	
	//xóa ký tự đầu tiên và cuối cùng
	str_list_id_user = str_list_id_user.substr(1);
	str_list_id_user = str_list_id_user.substr(0, str_list_id_user.length-1); 
	
	document.getElementById("value_nguoi_dc_duyet").value = str_list_id_user;
	
}
	  
</script> 


<?php
		}
	}
?>


