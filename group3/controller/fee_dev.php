<?php
class fee extends Main
{
	function index()
	{
		//lấy ra model dữ liệu
		$this->loadModel("Fee","fees");
		
		//truy vấn dữ liệu
		$array_bieuphi = $this->Fee->find("all",array("order"=>"id DESC"));
		
		$danhsach = $this->View->render('ds_bieuphi.php',array("array_bieuphi"=>$array_bieuphi));
		echo $danhsach;	
	}
	
	function detail($id_fee = "")
	{
		// tao doi tuong ClassroomService
		$this->loadModel("FeeDetail","fee_details");
		$this->loadModel("ClassroomService","classroom_services");

		if(isset($_POST["data"])==true)
		{
			$data = $_POST["data"];

			//lay service_name tu id_service

			$array_tmp_service = 
					$this->ClassroomService->find("all",array("fields"=>"name,price","conditions"=>"`id` = '".$data['id_service']."' "));
			$service_name = "";
			if($array_tmp_service != null)
			{
				$service_name = $array_tmp_service[0]['name'];
				if($data['price']=="") $data['price'] =  $array_tmp_service[0]['price'];
			}

			//luu vao bang fee_detail
			$data["service_name"] = $service_name;
			$this->FeeDetail->save($data);
		}

		//su dung ham find de load du lieu tu bang fee_detail hien thi ra danh sach dich vu cua bieu phi
		$array_detail = $this->FeeDetail->find("all",array("conditions"=>"`id_fee` = '$id_fee'"));


		//dung find de lay du lieu tu bang Classroom_service de hien thi len selecbox
		$array_classroom_service = $this->ClassroomService->find("all",array("order"=>"id ASC","fields"=>"id,name"));

		//dùng hàm render của đối tượng View để truy cập tới file danh sách cau hoi: .php, trả kết quả về biến html
		$array_param = array(
						"array_detail"=>$array_detail,
						"array_classroom_service"=>$array_classroom_service,
						"id_fee"=>$id_fee
						);
		$html = $this->View->render("detail_fee.php",$array_param);
		//,array("array_detil"=>$array_detail)
		echo $html;
	}

	function del_detail($id = "",$id_fee = "")
	{
		if($id != "")
		{
			$this->loadModel("FeeDetail","fee_details");
			$this->FeeDetail->delete($id);
			$this->redirect("/fee/detail/$id_fee.html");
		}
	}
	
	function add($tmp_id = "")
	{
		//lấy ra model dữ liệu
		$this->loadModel("Fee","fees");
		$this->loadModel("FeeDetail","fee_details");
		$this->loadModel("ClassroomService","classroom_services");
		
		$array_sua = NULL;
		
		//kiểm tra có duex liệu từ ng` dùng 
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_luu = $_POST["data"]["fee"];
			$array_luu["from"] = date("Y-m-d",strtotime($array_luu["from"]));
			$array_luu["to"] = date("Y-m-d",strtotime($array_luu["to"]));
			$array_luu["created_username"] = $this->User->username;
			$array_luu["id_created_user"] = $this->User->id;
			
			$array_fee_detal = NULL;
			$array_fee_detal = $_POST["data"]["fee_detail"];
			
			$total_price = 0;
			$str_service = "";
			
			$kitu = chr(8);
			$kitu_dong = chr(9);
			
			if($array_fee_detal != NULL)
			{
				$price = 0;
				for($i = 0; $i < count($array_fee_detal); $i++)
				{
					if(isset($array_fee_detal[$i]["select"]))
					{
						$price = str_replace(",","",$array_fee_detal[$i]["price"]);
						if($price > 0) $total_price += $price;
						$id_service = $array_fee_detal[$i]["id_service"];
						
						//lấy code dịch vụ để đưa vào chuỗi str_service
						$code_service = $this->ClassroomService->get_value(array("fields"=>"code","conditions"=>"`id` = '$id_service'"));
						
						$str_service .= $array_fee_detal[$i]["service_name"].$kitu.$price.$kitu.$id_service.$kitu.$code_service.$kitu_dong;
					}
				}
			}
			
			$array_luu["str_service"] = $str_service;
			$array_luu["total_price"] = $total_price;
			
			//luu du lieu vao database
			$this->Fee->save($array_luu);
			
			$last_id_fee = "";
			if(isset($array_luu["id"]) && $array_luu["id"] == "")
			{
				$last_id_fee = $this->Fee->get_value(array("fields"=>"MAX(id)"));
			}else
			{
				$last_id_fee = $array_luu["id"];
			}
			
			for($i = 0;$i < count($array_fee_detal);$i++)
			{
				if(isset($array_fee_detal[$i]["select"]))
				{
					$array_fee_detal[$i]["id_fee"] = $last_id_fee;
					
					$array_fee_detal[$i]["price"] = str_replace(",","",$array_fee_detal[$i]["price"]);
					
					$array_fee_detal[$i]["from"] = $array_luu["from"];
					$array_fee_detal[$i]["to"] = $array_luu["to"];
					$array_fee_detal[$i]["month"] = $array_luu["month"];
					$array_fee_detal[$i]["year"] = $array_luu["year"];
					$array_fee_detal[$i]["created_username"] = $array_luu["created_username"];
					$array_fee_detal[$i]["id_created_user"] = $array_luu["id_created_user"];
					
					$this->FeeDetail->save($array_fee_detal[$i]);
				}
			}
			
			$this->redirect("/fee/index.html");
			return;	
		}
		
		//lấy danh sách dịch vụ
		$this->loadModel("Classroom_service");
		$array_service = $this->Classroom_service->find("all",array("order"=>"`order_number` DESC"));
		
		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->Fee->find("all",array("conditions"=>"id = '$tmp_id'"));
			$array_service = $this->FeeDetail->find("all",array("conditions"=>"`id_fee` = $tmp_id"));
		}
		
		$them_sp = $this->View->render('nhap_bieuphi.php',array("array_sua"=>$array_sua,"array_service"=>$array_service));
		echo $them_sp;		
	}

	
	function del($tmp_id = '')
	{
		$table_prefix = "";		
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		$this->loadModel("Fee","fees");
		$this->loadModel("FeeDetail","fee_details");
		
		$this->Fee->delete($tmp_id);
		
		$sql = "DELETE FROM ".$table_prefix."fee_details WHERE `id_fee` = '$tmp_id'";
		$this->FeeDetail->excute($sql);
		
		//chuyen ve lai trang xem thu
		$this->redirect("/fee/index.html");
	}
	
	function arrange_class($id_classroom = "")
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Fee","fees");
		$this->loadModel("ClassRoom","classrooms");
		$this->loadModel("FeeClass","fee_classrooms");
		$this->loadModel("FeeClassDetail","fee_classroom_details");
		
		//truy vấn dữ liệu
		$array_lop_hoc = $this->ClassRoom->find("all",array("conditions"=>"`id` = '$id_classroom'"));
		
		//Tính tổng  số tháng giữa ngày bắt đầu và ngày kết thúc	
		$start    = new DateTime($array_lop_hoc[0]['from']);
		$start->modify('first day of this month');
		$end      = new DateTime($array_lop_hoc[0]['to']);
		$end->modify('first day of next month');
		$interval = DateInterval::createFromDateString('1 month');
		$period   = new DatePeriod($start, $interval, $end);
		
		$id_fee = "";
		$fee_name = "";
		$str_service = "";
		$array_fee_detail = NULL;
		if(isset($_GET["id_fee"]))
		{
			$id_fee = $_GET["id_fee"];
			$array_selected_fee = $this->Fee->find("all",array("conditions"=>"`id` = '$id_fee'"));
			if($array_selected_fee != NULL)
			{
				$fee_name = $array_selected_fee[0]["name"];
				$str_service = $array_selected_fee[0]["str_service"];
				$total_price = $array_selected_fee[0]["total_price"];
			}
			
			$this->loadModel("FeeDetail","fee_details");
			$array_fee_detail = $this->FeeDetail->find("all",array("conditions"=>"`id_fee` = '$id_fee'"));
		}
		
		if(isset($_GET["trangthai"]) && $_GET["trangthai"] == "1" && $id_fee != "")
		{
			//kiểm tra lớp hiện tại đã có áp biểu phí hay chưa
			$array_bieuphi_lop = $this->FeeClass->find("all",array("conditions"=>"`id_classroom` = '$id_classroom'"));
			if($array_bieuphi_lop)
			{
				//nếu có thì xóa hết biểu phí lớp và các chi tiết liên quan trong bang fee_class_detail
				$sql_xoa_bieuphi_lop = "DELETE FROM ".$table_prefix."fee_classrooms WHERE `id_classroom` = '$id_classroom'";
				$this->FeeClass->excute($sql_xoa_bieuphi_lop);
				
				$sql_xoa_bieuphi_lop_chitiet = "DELETE FROM ".$table_prefix."fee_classroom_details WHERE `id_classroom` = '$id_classroom'";
				$this->FeeClassDetail->excute($sql_xoa_bieuphi_lop_chitiet);
			}
			
			$array_apbieuphi = NULL;
			$array_fee_classroom_detail = NULL;
			$array_month=NULL;
			$i = 0;
				
			foreach ($period as $dt) 
			{
				$array_month[$i] = $dt->format("Y-m-01") ;
				
				//lấy số ngày trong tháng
				/*$get_month = date("m",strtotime($array_month[$i]));
				$get_Year = date("Y",strtotime($array_month[$i]));
				$num_day = cal_days_in_month(CAL_GREGORIAN,$get_month,$get_Year);
				$num_day -= 8;*/
				
				$array_apbieuphi["id_classroom"] = $id_classroom;
				$array_apbieuphi["classroom_name"] = $array_lop_hoc[0]["name"];
				$array_apbieuphi["id_fee"] = $id_fee;
				$array_apbieuphi["fee_name"] = $fee_name;
				$array_apbieuphi["total_price"] = $total_price;
				$array_apbieuphi["month_year"] = $array_month[$i];
				$array_apbieuphi["num_day"] = "22";
				$array_apbieuphi["str_service"] = $str_service;
				$array_apbieuphi["id_created_user"] = $this->User->id;
				$array_apbieuphi["created_username"] = $this->User->fullname;
				
				$this->FeeClass->save($array_apbieuphi);
				
				//lấy id mới nhất của FeeClassroom để lưu vào bảng fee_classroom_detail
				$id_fee_classroom = $this->FeeClass->get_value(array("fields"=>"MAX(id)"));
				
				//lưu dịch vụ vào bảng FeeClassroom detail
				foreach($array_fee_detail as $fee_classroom_detail)
				{
					$array_fee_classroom_detail = $array_apbieuphi;
					$array_fee_classroom_detail["id_fee_classroom"] = $id_fee_classroom;
					$array_fee_classroom_detail["id_service"] = $fee_classroom_detail["id_service"];
					$array_fee_classroom_detail["service_name"] = $fee_classroom_detail["service_name"];
					$array_fee_classroom_detail["price"] = $fee_classroom_detail["price"];
					
					$this->FeeClassDetail->save($array_fee_classroom_detail);
				}
				
				$i++;
			}
			
			$this->redirect("/fee/arrange_class/$id_classroom.html");
			return;	
		}
		
		$array_bieuphi = $this->Fee->find("all",array("order"=>"id DESC","fields"=>"id,name"));
		array_unshift($array_bieuphi,array('id'=>'','value'=>'...'));
		
		//đọc dữ liệu củ để kiểm tra lớp này đã áp biểu phí này chưa
		$array_bieuphi_lop = $this->FeeClass->find("all",array("conditions"=>"`id_classroom` = '$id_classroom'","order"=>"month_year ASC"));
	
		$danhsach = $this->View->render('ap_bieuphi_lop.php',array("array_bieuphi"=>$array_bieuphi,"array_lop_hoc"=>$array_lop_hoc,"id_classroom"=>$id_classroom,"array_lop_hoc"=>$array_lop_hoc,"array_fee_detail"=>$array_fee_detail,"array_bieuphi_lop"=>$array_bieuphi_lop));
		echo $danhsach;	
	}
	
	function arrange_class_edit($id_fee_classroom = "")
	{
		//lấy ra model dữ liệu
		$this->loadModel("FeeClassDetail","fee_classroom_details");
		
		//đọc dữ liệu củ để kiểm tra lớp này đã áp biểu phí này chưa
		$array_bieuphi_lop_chitiet = $this->FeeClassDetail->find("all",array("conditions"=>"`id_fee_classroom` = '$id_fee_classroom'"));
		
		///lấy danh sách id dịch vụ để check vào dịch vụ đã có khi sửa
		$list_id_service = "";
			
		//lấy list dịch vụ
		foreach($array_bieuphi_lop_chitiet as $bieuphi_lop_chitiet)
		{
			if($list_id_service != "") $list_id_service .= ",";
			$list_id_service .= $bieuphi_lop_chitiet["id_service"];
		}
		
		
		//lấy danh sách dịch vụ để sửa
		$array_dichvu = NULL;
		$this->loadModel("ClassroomService","classroom_services");
		if($list_id_service != "")
		{
			$array_dichvu = $this->ClassroomService->find("all",array("conditions"=>"`id` NOT IN ($list_id_service)"));
		}
		
		if(isset($_POST["data"]))
		{
			$array_bieuphi_lop = $_POST["data"]["fee"];
			$array_capnhat_bieuphi_lop = NULL;
			$str_service = "";
			foreach($array_bieuphi_lop as $bieuphi_lop)
			{
				if(isset($bieuphi_lop["id_service"]) && $bieuphi_lop["id_service"] != "")
				{
					$bieuphi_lop["price"] = str_replace(",","",$bieuphi_lop["price"]);
					
					$bieuphi_lop["id_fee_classroom"] = $id_fee_classroom;
					$bieuphi_lop["id_fee"] = $array_bieuphi_lop_chitiet[0]["id_fee"];
					$bieuphi_lop["fee_name"] = $array_bieuphi_lop_chitiet[0]["fee_name"];
					$bieuphi_lop["id_classroom"] = $array_bieuphi_lop_chitiet[0]["id_classroom"];
					$bieuphi_lop["classroom_name"] = $array_bieuphi_lop_chitiet[0]["classroom_name"];
					$bieuphi_lop["month_year"] = $array_bieuphi_lop_chitiet[0]["month_year"];
					$bieuphi_lop["num_day"] = $array_bieuphi_lop["num_day"];
					$bieuphi_lop["id_created_user"] = $this->User->id;
					$bieuphi_lop["created_username"] = $this->User->fullname;
					
					//lấy code dịch vụ để đưa vào chuỗi str_service
					$code_service = $this->ClassroomService->get_value(array("fields"=>"code","conditions"=>"`id` = '".$bieuphi_lop["id_service"]."'"));
					
					//lấy chuỗi service để cập nhật vào bảng FeeClass
					$str_service .= $bieuphi_lop["service_name"].chr(8).$bieuphi_lop["price"].chr(8).$bieuphi_lop["id_service"].chr(8).$code_service.chr(9);
					
					$this->FeeClassDetail->save($bieuphi_lop);
				}
			}
			
			if($str_service != "")
			{
				$array_capnhat_bieuphi_lop["str_service"] = $str_service;
				$array_capnhat_bieuphi_lop["id"] = $id_fee_classroom;
				$array_capnhat_bieuphi_lop["num_day"] = $array_bieuphi_lop["num_day"];
				
				$this->loadModel("FeeClass","fee_classrooms");
				$this->FeeClass->save($array_capnhat_bieuphi_lop);
			}
			
			$this->redirect("/fee/arrange_class/".$array_bieuphi_lop_chitiet[0]["id_classroom"].".html");
			return;	
		}
		
		$danhsach = $this->View->render('sua_bieuphi_lop.php',array("array_dichvu"=>$array_dichvu,"list_id_service"=>$list_id_service,"array_bieuphi_lop_chitiet"=>$array_bieuphi_lop_chitiet));
		echo $danhsach;	
	}
	
	function xoa_bieuphi_hocsinh($id_classroom = "")
	{
		$action = $_GET["action"];
		if($action == "del")
		{
			$id_customer = $_GET["id_customer"];
			$id_service = $_GET["id_service"];
			$id_fee_customer = $_GET["id_fee_customer"];
			
			//chuyển đổi về datetime 
			$month_year ="01-".$_GET["month"];
			$month_year = date("Y-m-d",strtotime($month_year));
			
			//lấy id_fee_customer_detail và tiến hành xóa dữ liệu từ FeeCustomerDetail
			$id_fee_customer_detail = $this->FeeCustomerDetail->get_value(array("conditions"=>"(`id_customer` = '$id_customer') AND (`id_service` = '$id_service') AND (`id_classroom` = '$id_classroom') AND (month_year = '$month_year')"));
			if($id_fee_customer_detail != "") $this->FeeCustomerDetail->delete($id_fee_customer_detail);
			
			//kiểm tra có còn dịch vụ trong biểu phí học sinh trong bảng FeeCustomerDetail không
			//nếu hết thì xóa biểu phí học sinh trong bảng FeeCustomer
			$so_bieuphi_hocsinh = $this->FeeCustomerDetail->get_value(array("fields"=>"id","conditions"=>"(`id_customer` = '$id_customer') AND (`id_classroom` = '$id_classroom') AND (`id_fee_customer` = '$id_fee_customer') AND (month_year = '$month_year')"));
			if($so_bieuphi_hocsinh == "") $this->FeeCustomer->delete($id_fee_customer);
			else
			{
				//lấy chuỗi str_service mới từ bảng FeeCustomerDetail
				$array_fee_customer_details = $this->FeeCustomerDetail->find("all",array("conditions"=>"(`id_customer` = '$id_customer') AND (`id_classroom` = '$id_classroom') AND (month_year = '$month_year')"));
				
				$kitu = chr(8);
				$kitu_dong = chr(9);
				$str_service = "";
				$this->loadModel("ClassroomService","classroom_services");
				
				foreach($array_fee_customer_details as $fee_customer_details)
				{
					$service_name = $fee_customer_details["service_name"];
					$price = $fee_customer_details["price"];
					$id_service = $fee_customer_details["id_service"];
					
					//lấy code dịch vụ để đưa vào chuỗi str_service
					$code_service = $this->ClassroomService->get_value(array("fields"=>"code","conditions"=>"`id` = '$id_service'"));
					
					//nối chuỗi service để cập nhật vào bảng FeeCustomer
					$str_service .= $service_name.$kitu.$price.$kitu.$id_service.$kitu.$code_service.$kitu_dong;
					//echo $str_service."<br>*********";
					
				}
				
				//END lấy chuỗi str_service mới từ bảng FeeCustomerDetail
				/////////////////////////////////////////////////
				
				//////////////////////////////////////////////////////////
				//cập nhật vào bảng FeeCustomer
				$array_fee_customer = NULL;
				if($id_fee_customer != "")
				{
					$array_fee_customer["str_service"] = $str_service;
					$array_fee_customer["id"] = $id_fee_customer;
					
					//lưu vào bảng FeeCustomerDetail
					$this->FeeCustomer->save($array_fee_customer);
				}
				//////////////////////////////////////////////////////////
				//END cập nhật vào bảng FeeCustomer
			} //END nếu hết thì xóa biểu phí học sinh trong bảng FeeCustomer
			
			//chuyen ve lai trang xem thu
			$month = $_GET['month'];
			$this->redirect("/fee/arrange/$id_classroom.html?month=$month");
			return;
		}//end if($action == "del")
		
	//END function	
	}
	
	function count_num_sat($month = "")
	{
		$get_month = date("m",strtotime($month));
		$get_Year = date("Y",strtotime($month));
		$songay=cal_days_in_month(CAL_GREGORIAN,$get_month,$get_Year);
		
		$songay_dihoc =0;
		$songay_thu7=0;
		for($i=0; $i<$songay; $i++)
		{
			$ngaydem = strtotime("$i day",strtotime($month) ); 
			
			if(date("N",$ngaydem)== "6" ) $songay_thu7++;
			
			if(date("N",$ngaydem) != "7" && date("N",$ngaydem) != "6") $songay_dihoc++;
			
		}
		
		$array_songay=array("thu7"=> $songay_thu7,"dihoc"=>$songay_dihoc);
		return  $array_songay;
	}
	
	function saochep_bieuphi_hocsinh($id_classroom)
	{
		$id_customer_source = $_GET["id_customer"];
		$month_year_source = $_GET["month_year"];
		$month_year_source = date("Y-m-d",strtotime("01-$month_year_source"));
		
		//lấy thông tin biểu phí học sinh đã chọn từ FeeCustomer và FeeCustomerDetail
		$str_condition_bieuphi_dachon = "id_customer ='$id_customer_source' AND id_classroom ='$id_classroom'  AND month_year ='$month_year_source'";
		$array_customer_fee_source = $this->FeeCustomer->find('all',array("conditions"=>$str_condition_bieuphi_dachon));
		
		$array_customer_fee_detail_source = $this->FeeCustomerDetail->find('all',array("conditions"=>$str_condition_bieuphi_dachon));
		
		//echo "fee customer detail";
		//print_r($array_customer_fee_detail_source);
		
		//lấy tất cả các biểu phí học sinh còn lại
		
		if($array_customer_fee_source!=NULL)
		{
			//lấy thông tin của lớp hiện tại, và danh sách các tháng
			$this->loadModel("Classroom");
			$array_current_class_info = $this->Classroom->find('all',array("conditions"=>" `id` = '$id_classroom'"));
			$str_class_room_from = "";
			$str_class_room_to = "";		
			$array_month_year_current_class =  NULL;		
			if($array_current_class_info)
			{
				$str_class_room_from = $array_current_class_info[0]["from"];
				$str_class_room_to = $array_current_class_info[0]["to"];
				
				
				$month_from = strtotime(date("Y-m-01",strtotime($str_class_room_from)));
				$month_to =   strtotime(date("Y-m-01",strtotime($str_class_room_to)));;
				$num_month =0;
				do {
					$str_class_month = date("Y-m-01",$month_from);
					$array_month_year_current_class[$str_class_month] = $str_class_month;
				}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
					
			} //end if array_current_class_info
			 
			 //duyệt từng tháng để lưu dữ liệu của tháng đó
			 foreach($array_month_year_current_class as $month_year_customer_fee)
			 {
				 //kiểm tra tháng hiện tại có trùng với tháng đang  chọn hay không
				 if( $month_year_customer_fee != $month_year_source)
				 {
					 //thiết lập thông tin biểu phí tháng hiện tại bằng biểu phí tháng đã chọn
					 $array_customer_fee_month_year_info = $array_customer_fee_source[0] ;
					 
					//kiểm tra phiểu phí tháng đã chọn  đã có chưa, nếu có rồi thì update vào bảng FeeCustomer, nếu chưa có thì lưu
					$str_condition_bieuphi_dachon = "id_customer ='$id_customer_source' AND id_classroom ='$id_classroom'  AND month_year ='$month_year_customer_fee'";
					$array_customer_fee_month_year_info["id"]  = $this->FeeCustomer->get_value(array("fields"=>"id","conditions"=>$str_condition_bieuphi_dachon));
					
					$array_customer_fee_month_year_info["month_year"] = $month_year_customer_fee;
					 
					//print_r($array_customer_fee_month_year_info);
					 $this->FeeCustomer->save( $array_customer_fee_month_year_info);
					
					//lấy giá trị id từ bảng FeeCustomer vừa nhập	
					if($array_customer_fee_month_year_info["id"]=="") $array_customer_fee_month_year_info["id"] = $this->FeeCustomer->get_value(array("fields"=>"MAX(id)"));
					
					
					//lưu thông tin biểu phí chi tiết FeeCustomerDetail
					$array_customer_fee_detail = NULL;	
					$str_condition_customer_fee_detail = "";
					$tmp_id_service = "";
					foreach($array_customer_fee_detail_source as $customer_fee_detail_source )
					{
						$array_customer_fee_detail = $customer_fee_detail_source;
						$tmp_id_service = $customer_fee_detail_source["id_service"];
						$str_condition_customer_fee_detail = "id_customer ='$id_customer_source' AND id_classroom ='$id_classroom'  AND month_year ='$month_year_customer_fee' AND  id_service ='$tmp_id_service'";
						
						$array_customer_fee_detail["id"] = $this->FeeCustomerDetail->get_value(array("fields"=>"id","conditions"=>$str_condition_customer_fee_detail));
						$array_customer_fee_detail["month_year"] = $month_year_customer_fee;	
						$array_customer_fee_detail["id_fee_customer"] = $array_customer_fee_month_year_info["id"];
						$this->FeeCustomerDetail->save($array_customer_fee_detail);		
					}
				 }//end if( $month_year_customer_fee != $month_year_source)
			}//end  foreach(
			// print_r($array_month_year_current_class);
			
			//echo "tháng hiện tại $str_condition_bieuphi_dachon";
			//print_r($array_customer_fee_source);
			echo "Đã sao chép";	
		}
	//end function
	}
	function arrange($id_classroom = "")
	{
		//lấy ra model dữ liệu
		$this->loadModel("Fee","fees");
		$this->loadModel("ClassRoom","classrooms");
		$this->loadModel("HocSinh","arranges");
		$this->loadModel("Classroom_service");
		$this->loadModel("FeeClass","fee_classrooms");
		$this->loadModel("FeeCustomer","fee_customers");
		$this->loadModel("FeeCustomerDetail","fee_customer_details");
		
		////////////////////////////////////////////////
		//kiểm tra có yêu cầu xóa dịch vụ trong biểu phí của học sinh không
		$action = $id_customer = $id_service = $id_fee_customer = "";
		
		if(isset($_GET["action"])) $action = $_GET["action"];
		if($action == "del") $this->xoa_bieuphi_hocsinh($id_classroom);
		if($action == "copy") $this->saochep_bieuphi_hocsinh($id_classroom);

		////////////////////////////////////////////////
		//END kiểm tra xóa dịch vụ trong biểu phí
		
		
		$month = "";
		
		
		//truy vấn dữ liệu
		$array_lop_hoc = $this->ClassRoom->find("all",array("order"=>"name ASC","conditions"=>"id= '$id_classroom'"));
		
		$array_dichvu = $this->Classroom_service->find("all",array("order"=>"name ASC","fields"=>"id,name"));
		if($array_dichvu != NULL)	array_unshift($array_dichvu,array("","..."));
		else $array_dichvu = array("","...");
		
		
		if(isset($_POST["data"]))
		{
			//lấy service của lớp
			$arrray_class_service = $_POST["data"]["class_service"];
			$arrray_student_service = $_POST["data"]["student_service"];
						
			//tạo bảng array_customer_fee để lưu bảng customer_fee
			$array_customer_fee = NULL;
			$array_customer_fee["id_fee"] = $arrray_student_service["id_fee"];
			$array_customer_fee["fee_name"] = $arrray_student_service["fee_name"];
			$array_customer_fee["month_year"] = date("Y-m-d",strtotime("01-".$arrray_student_service["month_year"]));
			$month = $array_customer_fee["month_year"];
			$array_customer_fee["num_day"] = $arrray_student_service["num_day"];
			$array_customer_fee["id_classroom"] = $arrray_student_service["id_classroom"];
			$array_customer_fee["classroom_name"] = $arrray_student_service["classroom_name"];
			$array_customer_fee["id_customer"] = $arrray_student_service["id_customer"];		
			$array_customer_fee["customer_name"] = $arrray_student_service["customer_name"];
			$id_customer = $array_customer_fee["id_customer"];
			$id_fee = $array_customer_fee["id_fee"];
			$num_day = $array_customer_fee["num_day"];
			/////////////////////////////////////////////////////////////////////////
			//lấy danh sách dịch vụ để cập nhật vào cột str_service
			//lưu thông tin dịch vụ gồm tên, giá, id
			$str_service = "";
			
			$kitu = chr(8);
			$kitu_dong = chr(9);
			
			$total_amount=0;
			
			//lấy thông tin tất cả các dịch vụ
			for($i=0; $i<count($arrray_class_service); $i++)
			{
				$arrray_class_service[$i]["price"] = str_replace(",","",$arrray_class_service[$i]["price"]);
				
				//lấy code dịch vụ để đưa vào chuỗi str_service
				$code_service = $this->Classroom_service->get_value(array("fields"=>"code","conditions"=>"`id` = '".$arrray_class_service[$i]["id_service"]."'"));
				
				$str_service .= $arrray_class_service[$i]["service_name"].$kitu.$arrray_class_service[$i]["price"].$kitu.$arrray_class_service[$i]["id_service"].$kitu.$code_service.$kitu_dong;
				$total_amount += $arrray_class_service[$i]["price"];
			}
			
			$tmp_id_customer_fee_detail = "";
			$id_student_service = "";
			 
			
			//kiểm tra có dịch vụ thêm không
			if(isset($_POST["data"]["student_service"]["id_service"]))
			{
				//lay id_service
				$id_student_service = $arrray_student_service["id_service"];
				$code_student_service = $this->Classroom_service->get_value(array("fields"=>"code","conditions"=>"`id` = '$id_student_service'"));
				/*if($code_student_service == "tienthu7")
				{	
					$array_songay = $this->count_num_sat($month);
					$num_day += $array_songay["thu7"];
					$array_customer_fee["num_day"] = $num_day;
			
				}*/
				$student_service_name =  $arrray_student_service["service_name"];
				
				//lấy id_service của học sinh hiện tại trong bảng FeeCustomerDetail
				//nếu đã có rôi thì không dồn  vào str_service_id nữa
				$tmp_id_customer_fee_detail = $this->FeeCustomerDetail->get_value(array("fields"=>"id","conditions"=>"id_fee = '$id_fee' AND id_service = '$id_student_service' AND id_classroom = '$id_classroom' AND `id_customer` = '$id_customer' AND `month_year` = '".$array_customer_fee["month_year"]."'"));
				
				if($tmp_id_customer_fee_detail == "")
				{	
					
					//kiểm tra có dịch vụ thêm vào không
					if($id_student_service != "")
					{
						//nếu có lấy tên dịch vụ, giá đưa vaof chuỗi str_service_id,str_service
						$student_service_price = $this->Classroom_service->get_value(array("fields"=>"`price`","conditions"=>"`id` = '$id_student_service'"));
					
						$str_service .= $student_service_name.$kitu.$student_service_price.$kitu.$id_student_service.$kitu.$code_student_service.$kitu_dong;
						$total_amount += $student_service_price;
					}
				}//END //nếu đã có rôi thì không cộng dồn  vào str_service_id nữa
			}
			
			$array_customer_fee["str_service"] = $str_service;
			//////////////////////////////////////////////////////////////////////
			
			
			
			//lưu tổng số tiền biểu phí
			$array_customer_fee["total_amount"] = $total_amount;
			
			
			//kiểm tra học sinh này đã có biểu phí chưa, nếu có rồi thì update
			$current_id_fee_customer =  $this->FeeCustomer->get_value(array("fields"=>"`id`","conditions"=>"`id_customer` = '$id_customer' AND `id_fee` = '$id_fee' AND `month_year`='$month'"));
			$array_customer_fee["id"] = $current_id_fee_customer;
			
			
			//lưu vào bảng FeeCustomer
			$this->FeeCustomer->save($array_customer_fee);
			
			//kiểm tra đã có id_customer_fee trong bảng fee_customer_detail chưa
			//nếu có rồi thì update, nếu chưa có thì lấy max(id) để lưu
			if($current_id_fee_customer == "")
			{
				//lấy id_customer_fee mới nhất
				$id_fee_customer = $this->FeeCustomer->get_value(array("fields"=>"MAX(id)"));
			}else $id_fee_customer = $current_id_fee_customer;
			
			//lưu thông tin dịch vụ của lớp vào bảng fee customer detail
			for($i=0; $i<count($arrray_class_service); $i++)
			{
				
				//kiểm tra dịch vụ này đã có trong biểu phí học sinh chưa, nếu có rồi thì update
				$id_fee_customer_detail = $this->FeeCustomerDetail->get_value(array("fields"=>"id","conditions"=>"id_customer = '$id_customer' AND id_service = '".$arrray_class_service[$i]["id_service"]."' AND id_classroom = '$id_classroom' AND id_fee = '$id_fee'")); 
				$arrray_class_service[$i]["id"] = $id_fee_customer_detail;			

				$arrray_class_service[$i]["id_fee_customer"] = $id_fee_customer;	
				
				$arrray_class_service[$i]["id_fee"] = $arrray_student_service["id_fee"];
				$arrray_class_service[$i]["fee_name"] = $arrray_student_service["fee_name"];
				$arrray_class_service[$i]["id_classroom"] = $arrray_student_service["id_classroom"];
				$arrray_class_service[$i]["classroom_name"] = $arrray_student_service["classroom_name"];
				$arrray_class_service[$i]["id_customer"] = $arrray_student_service["id_customer"];		
				$arrray_class_service[$i]["customer_name"] = $arrray_student_service["customer_name"];
				$arrray_class_service[$i]["month_year"] = $month;
				
				
				//lấy service code từ id_service
				$arrray_class_service[$i]["service_code"] = $this->Classroom_service->get_value(array("fields"=>"code","conditions"=>"`id` = '".$arrray_class_service[$i]["id_service"]."'"));
			
				
				$this->FeeCustomerDetail->save($arrray_class_service[$i]);
				//print_r($arrray_class_service[$i]);
			}
			
			
			
			//***************************************************************************************
			//Khi thay đổi combobox dịch vụ khác thì lấy giá trị id service được chọn để lưu vào bảng FeeCustomerDetail
			//lấy service của học sinh từ combobox
			if(isset($_POST["data"]["student_service"]))
			{
				
				//nếu có id_student_service thi lấy thông tin dịch vụ thêm vào để lưu vào FeeCustomerDetail
				if($id_student_service != "")
				{
					
					//kiểm tra dịch vụ đang chọn đã có trong bảng FeeCustomerDetail chưa
					//kiểm tra lần 2 vì lần đầu tiên chưa có
					//nếu có rồi thì không lưu nữa
					$tmp_id_customer_fee_detail = $this->FeeCustomerDetail->get_value(array("fields"=>"id","conditions"=>"id_fee = '$id_fee' AND id_service = '$id_student_service' AND id_classroom = '$id_classroom' AND `id_customer` = '$id_customer' AND `month_year`='$month'"));

					if($tmp_id_customer_fee_detail == "")
					{
						
						$arrray_student_service["id_fee_customer"] = $id_fee_customer;
						$arrray_student_service["month_year"] = $month;
						
						$arrray_student_service["price"] = $this->Classroom_service->get_value(array("fields"=>"`price`","conditions"=>"`id` = '$id_student_service'"));
						$arrray_student_service["service_code"] = $this->Classroom_service->get_value(array("fields"=>"code","conditions"=>"`id` = '$id_student_service'"));
						
						//lưu vào bảng FeeCustomerDetail
						$this->FeeCustomerDetail->save($arrray_student_service);
					}//end if ($tmp_id_customer_fee_detail == ""
				} //end if if($id_student_service != "")
			}//end if if(isset($_POST["data"]["student_service"]))
			//***********************************************************************************
			
			//$this->redirect("/classroom/index.html");
			//print_r($arrray_student_service);
		}
		
		
		
		
		
		//kiểm tra dữ liệu month từ onchange từ combobox tháng
		if(isset($_GET['month_year']))
		{
			$month= $_GET['month_year'];
			$month = "01-".$month;
			$month = date("Y-m-d",strtotime($month)); 
		}
		
		
		
		
		
		
		
		//nếu dữ liệu month từ get hoặc post thì lấy dữ liệu tháng đầu tiên
		if($month == "")
		{
			$month=date("Y-m-01",strtotime($array_lop_hoc[0]['from']));
		}
		
		$array_fee_class = $this->FeeClass->find("all",array("conditions"=>"`id_classroom` = '$id_classroom' AND `month_year` = '$month'"));
		
		$classroom_name = $fee_name = $id_fee = "";
		$total_price = 0;
		$array_fee = NULL;
		$str_fee_detail = "";
		if($array_fee_class != NULL)
		{
			$fee_name = $array_fee_class[0]["fee_name"];
			$classroom_name = $array_fee_class[0]["classroom_name"];
			$total_price = $array_fee_class[0]["total_price"];
			$id_fee = $array_fee_class[0]["id_fee"];
			
			$str_fee_detail = $this->FeeClass->get_value(array("fields"=>"str_service","conditions"=>"`id_classroom` = '$id_classroom' AND `month_year` = '$month'"));
			
			
		}
		
		
		
		
		//truy vấn dữ liệu biểu phí bảng feecustomer theo tháng		
		$array_fee_customer = $this->FeeCustomer->find("all",array("order"=>"id ASC","conditions"=>"`id_classroom` = '$id_classroom' AND `month_year`='$month'"));

		///kiểm tra có danh sach sbiểu phí của trẻ chưa		
		$str_id_customer = "";
		foreach($array_fee_customer as $tmp_fee_customer)
		{
			if($tmp_fee_customer["id_customer"] != "")	
			{
				if($str_id_customer != "") $str_id_customer .= ",";
				$str_id_customer .= $tmp_fee_customer["id_customer"];
			}
		}
		
		$str_condition_id_customer = "";
		if($str_id_customer) $str_condition_id_customer = " AND (`id_fullname` NOT IN ($str_id_customer))";
		
		$array_hocsinh = $this->HocSinh->find("all",array("order"=>"fullname ASC","fields"=>"id_fullname,fullname","conditions"=>"(`id_classroom` = '$id_classroom') AND (`type` = '0') AND (`status` = '1') $str_condition_id_customer"));
		
		$danhsach = $this->View->render('ap_bieuphi_hocsinh.php',array("month"=>$month,"array_hocsinh"=>$array_hocsinh,"array_lop_hoc"=>$array_lop_hoc,"array_dichvu"=>$array_dichvu,"classroom_name"=>$classroom_name,"fee_name"=>$fee_name,"total_price"=>$total_price,"str_fee_detail"=>$str_fee_detail,"id_classroom"=>$id_classroom,"id_fee"=>$id_fee,"array_fee_customer"=>$array_fee_customer));
		echo $danhsach;	
	}
}
?>