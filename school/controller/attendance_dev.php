<?php
class attendance extends Main
{
    function index($type = "")
    {
		$this->loadModel("Attendance","attendancies");
		 
        $dieukien = "(`approve` = '1') AND (`type` = '$type')";
		$id_classroom = "";
        if (isset($_POST['id_classroom']))
        {
            $id_classroom  = $_POST['id_classroom'];
            if($id_classroom != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_classroom` = '$id_classroom')";
			}
        }
		
		$tungay = date("01-m-Y");
        if (isset($_POST['startday']))
        {
            $tungay = $_POST['startday'];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` >= '$dieukien_tungay')";	
			}
        }else $dieukien .= " AND (`date` >= '".date("Y-m-01",strtotime($tungay))."')";	
		
		$denngay = date("t-m-Y");
        if (isset($_POST['finishday']))
        {
            $denngay = $_POST['finishday'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` <= '$dieukien_denngay')";	
			}
        }else $dieukien .= " AND (`date` <= '".date("Y-m-t",strtotime($denngay))."')";	
		
		$array_customer = NULL;
		if($id_classroom != "")
		{
			//lấy danh sách trẻ
			$this->loadModel("Arrange","arranges");
			$array_customer = $this->Arrange->find("all", array("fields"=>"id_fullname,fullname","conditions"=>"`id_classroom` = '$id_classroom' AND `status` = '1' AND `type` = '0'"));
		}
		array_unshift($array_customer,array('id'=>'','value'=>'...'));
		
		$id_customer = "";
		$array_diemdanh_tre = NULL;
        if (isset($_POST['id_customer']))
        {
            $id_customer  = $_POST['id_customer'];
            if($id_customer != "")
			{ 
				$array_diemdanh_tre = $this->Attendance->find("all", array("conditions"=>"$dieukien AND (`id_user` = '$id_customer')"));
			}
        }
		
		$group = "GROUP BY DATE_FORMAT( `date` , '%d-%m-%Y' )";
		if($type == 0) $group = "GROUP BY  `id_classroom` , DATE_FORMAT( `date` , '%d-%m-%Y' )";
       
        //lay tat ca dl tu bang Attendance
        $array_attendance = $this->Attendance->find("all",array("fields"=>"`id_classroom` , `classroom_name` , DATE_FORMAT(  `date` , '%d-%m-%Y' ) AS ngaydiemdanh , COUNT( id ) AS siso , SUM(IF( status =  '1' AND full_day = '1', 1, 0 ))  AS dihoc,   SUM(IF( status =  '1' AND full_day = '0', 1, 0 ))  AS nuabuoi,   SUM(IF( status =  '0',1, 0 ))  AS vang, SUM(antoi) AS antoi","conditions" =>"$dieukien $group","order"=>"`date` DESC"));
		
        // lay danh sach classroom cho select box
        $this->loadModel("Classroom","classrooms");
        $array_list_classroom = $this->Classroom->find("all", array("fields"=>"id,name"));
        array_unshift($array_list_classroom,array('id'=>'','value'=>'Tất cả'));
		
        //dua dl array classroom vao view
        $html_result = $this->View->render("index.php",array("array_attendance"=>$array_attendance,'array_list_classroom'=>$array_list_classroom,'id_classroom'=>$id_classroom,'denngay'=>$denngay,'tungay'=>$tungay,'type'=>$type,'group'=>$group,'array_customer'=>$array_customer,'array_diemdanh_tre'=>$array_diemdanh_tre,'id_customer'=>$id_customer));
        echo $html_result;
    }
	
	function attendance_list()
    {
		$this->loadModel("Attendance","attendancies");
		$this->loadModel("Arrange","arranges");
		
		 // lay danh sach classroom cho select box
        $this->loadModel("Classroom","classrooms");
        $array_list_classroom = $this->Classroom->find("all", array("fields"=>"id,name"));
		 
        $dieukien = "(`approve` = '1') AND (`type` = '0')";
		$dieukien_tre = "";
		$id_classroom =  $array_list_classroom[0]["id"];
        if (isset($_POST['id_classroom']))
        {
            $id_classroom  = $_POST['id_classroom'];
            if($id_classroom != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_classroom` = '$id_classroom')";
			}
        }else $dieukien .= " AND (`id_classroom` = '$id_classroom')";
		
		$tungay = date("01-m-Y");
        if (isset($_POST['startday']))
        {
            $tungay = $_POST['startday'];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` >= '$dieukien_tungay')";	
			}
        }else $dieukien .= " AND (`date` >= '".date("Y-m-01",strtotime($tungay))."')";	
		
		$denngay = date("t-m-Y");
        if (isset($_POST['finishday']))
        {
            $denngay = $_POST['finishday'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` <= '$dieukien_denngay')";	
			}
        }else $dieukien .= " AND (`date` <= '".date("Y-m-t",strtotime($denngay))."')";	
		
		$array_customer = NULL;
		if($id_classroom != "")
		{
			//lấy danh sách trẻ
			$array_customer = $this->Arrange->find("all", array("fields"=>"id_fullname,fullname","conditions"=>"`id_classroom` = '$id_classroom' AND `status` = '1' AND `type` = '0'"));
		}
		array_unshift($array_customer,array('id'=>'','value'=>'...'));
		
		$id_customer = "";
        if (isset($_POST['id_customer']))
        {
            $id_customer  = $_POST['id_customer'];
            if($id_customer != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_user` = '$id_customer')";	
				$dieukien_tre = " AND `id_fullname` = '$id_customer'";	
			}
        }
       	
		//lấy danh sách trẻ
		$array_tre = $this->Arrange->find("all", array("fields"=>"id_fullname,fullname","conditions"=>"`id_classroom` = '$id_classroom' AND `status` = '1' AND `type` = '0' $dieukien_tre"));
		
        //lay tat ca dl tu bang Attendance
        $array_attendance = $this->Attendance->find("all",array("conditions" =>$dieukien,"order"=>"date ASC"));
		
		 //lay thời gian tu bang Attendance
        $array_thoigian_diemdanh = $this->Attendance->find("all",array("fields"=>"DISTINCT date","conditions" =>$dieukien));
		
        //array_unshift($array_list_classroom,array('id'=>'','value'=>'...'));
		
        //dua dl array classroom vao view
        $html_result = $this->View->render("xem_diemdanh_theolich.php",array("array_attendance"=>$array_attendance,'array_list_classroom'=>$array_list_classroom,'id_classroom'=>$id_classroom,'denngay'=>$denngay,'tungay'=>$tungay,'array_customer'=>$array_customer,'id_customer'=>$id_customer,'array_tre'=>$array_tre,'array_thoigian_diemdanh'=>$array_thoigian_diemdanh));
        echo $html_result;
    }
	
	function attendance_list_user()
    {
		$this->loadModel("Attendance","attendancies");
		$this->loadModel("User2","users");
		
        $dieukien = "(`approve` = '1') AND (`type` = '1')";
		$dieukien_giaovien = "";
		
		$tungay = date("01-m-Y");
        if (isset($_POST['startday']))
        {
            $tungay = $_POST['startday'];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` >= '$dieukien_tungay')";	
			}
        }else $dieukien .= " AND (`date` >= '".date("Y-m-01",strtotime($tungay))."')";	
		
		$denngay = date("t-m-Y");
        if (isset($_POST['finishday']))
        {
            $denngay = $_POST['finishday'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` <= '$dieukien_denngay')";	
			}
        }else $dieukien .= " AND (`date` <= '".date("Y-m-t",strtotime($denngay))."')";	
		
		//lấy danh sách giáo viên
		$array_user = $this->User2->find("all", array("fields"=>"id,fullname","conditions"=>"`status` = '1'","order"=>"fullname ASC"));
		
		array_unshift($array_user,array('id'=>'','value'=>'...'));
		
		$id_user = "";
        if (isset($_POST['id_user']))
        {
            $id_user  = $_POST['id_user'];
            if($id_user != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_user` = '$id_user')";	
				$dieukien_giaovien = " AND `id` = '$id_user'";	
			}
        }
       	
		//lấy danh sách giáo viên
		$array_giaovien = $this->User2->find("all", array("fields"=>"id,fullname","conditions"=>"`status` = '1' $dieukien_giaovien"));
		
        //lay tat ca dl tu bang Attendance
        $array_attendance = $this->Attendance->find("all",array("conditions" =>$dieukien,"order"=>"date ASC"));
		
		 //lay thời gian tu bang Attendance
        $array_thoigian_diemdanh = $this->Attendance->find("all",array("fields"=>"DISTINCT date","conditions" =>$dieukien));
		
        //array_unshift($array_list_classroom,array('id'=>'','value'=>'...'));
		
        //dua dl array classroom vao view
        $html_result = $this->View->render("xem_diemdanh_theolich_giaovien.php",array("array_attendance"=>$array_attendance,'denngay'=>$denngay,'tungay'=>$tungay,'array_user'=>$array_user,'id_user'=>$id_user,'array_giaovien'=>$array_giaovien,'array_thoigian_diemdanh'=>$array_thoigian_diemdanh));
        echo $html_result;
    }

    function add()
    {
        $array_list_customer = "";
        $id_classroom 	= "";
		$classroom_name  = "";
		
        if (isset($_POST['change_classroom']))
        {
            $this->loadModel("Arrange","arranges");
			$this->loadModel("Attendance","attendancies");
			$this->loadModel("Customer");
			$this->loadModel("Classroom");
			
			$this->loadModel("CustomerDebt","customer_debts");
			$this->loadModel("Thuchi","thu_chis");
			$this->loadModel("FeeCustomer","fee_customers");
			$this->loadModel("FeeClassroom","fee_classrooms");
			
			
			

            // lay danh sach customer dua theo classroom
            $id_classroom = $_POST['id_classroom'];
			$date = date('Y-m-d',strtotime($_POST['day']));

            // Nếu POST change_classroom = 1 thì lấy danh sách học sinh dựa vào id_classroom
            // Nếu POST change_classroom = 0 thì lưu điểm danh
            if ($_POST['change_classroom'] == 1 && $id_classroom != "")
            {
				//
				$sql_hocsinh ="SELECT * FROM  `vietkid2_arranges` WHERE  `id_classroom` =  '3'AND  `type` =  '0' AND  `status` =  '1'";
				$sql_dichvu = "SELECT * FROM  `vietkid2_fee_customer_details` WHERE  `service_code` =  'antoi'AND  `month_year` =  '2016-09-01'";
				$sql_diemdanh = "SELECT A.id_fullname, A.fullname, B.service_code FROM ($sql_hocsinh) AS A
								LEFT JOIN ($sql_dichvu) AS B ON A.`id_fullname` = B.`id_customer`";

				$array_list_customer = $this->Arrange->query($sql_diemdanh);

                //$array_list_customer = $this->Arrange->find("all",array("conditions"=>"`id_classroom` = '$id_classroom' AND `type` = '0' AND `status` = '1'"));
			}
            else if ($_POST['change_classroom'] == 0)
            {
                $array_attendance = NULL;
                //$siso = $sl_di = $sl_vang = 0;
				$current_date = date("Y-m-d");
				$id_diem_danh = "";
				
				//kiểm tra ngày hôm đó đã có điểm danh hay chưa
				$id_diem_danh = $this->Attendance->get_value(array("conditions"=>"`id_classroom` = '$id_classroom' AND `type` = '0' AND `date` = '$date'"));
				
				if($id_diem_danh == "")
				{
					foreach ($_POST['attendance'] as $attendance)
					{
						$id_user = $attendance['id_user'];
						
	
						$classroom_name = "";
						$customer_name = "";
						
						//Lấy thông tin từng trẻ dựa theo id_customer
						$arr_customer = $this->Arrange->find("all",array("conditions"=>"`id_fullname`= '$id_user' AND `type` = '0' AND `status` = '1'"));
						
						if($arr_customer)
						{
							$classroom_name =  $arr_customer[0]['classroom_name'];
							$array_attendance['classroom_name'] = $arr_customer[0]['classroom_name'];
							$array_attendance['fullname']   = $arr_customer[0]['fullname'];
							$customer_name   				 = $arr_customer[0]['fullname'];
						}
						
						$array_attendance['id_classroom']   = $id_classroom;
						$array_attendance['id_user']     = $id_user;
	
						$array_attendance['date'] = $date;
						$array_attendance['type'] = "0";
						
						//kiểm tra ngày điểm danh có phải là thứ 7 hay không?
						if(date('w', strtotime($array_attendance['date'])) == 6)
						{
							$array_attendance['sat'] = 1;
						}
						
						//điểm danh ăn tối
						$array_attendance['antoi'] = $attendance["antoi"];
						
						
						$array_attendance['approve']	= "1";
						
						//if($date == $current_date) $array_attendance['approve']	= "1";
						//else $array_attendance['approve'] = "0";
						
						if(isset($attendance['status']) && $attendance['status'] == "on")
						{ 
							$array_attendance['status'] = 1;
							$array_attendance['full_day'] = 1;
						}
						if(isset($attendance['half_day']) && $attendance['half_day'] == "on")
						{
							$array_attendance['status'] = 1;
							$array_attendance['full_day'] = 0;
						}
						if(isset($attendance['vang']) && $attendance['vang'] == "on") $array_attendance['status'] = 0;
						
						$array_attendance['id_created_user'] =  $this->User->id;
						$array_attendance['created_username']    =  $this->User->fullname;
						
						//Lưu thông tin điểm danh
						$this->Attendance->save($array_attendance);
						
						//xử lsy thông tin ngày tháng để lấy ngày đầu tháng
						$month_year =  date("Y-m-01",strtotime($array_attendance['date']));
						
						//$this->update_debt($id_user,$customer_name,$id_classroom,$classroom_name,$month_year);						
						//Cập nhật tiền thừa cho tất cả các tháng từ đây trở về sau
						//lấy danh sách tháng của lớp hiện tại
						
						$current_month_year =  strtotime(date("Y-m-01",strtotime($array_attendance['date'])));
						
						$str_month_from = $this->Classroom->get_value(array("fields"=>"`from`","conditions"=>"id ='$id_classroom'"));
						$str_month_to = $this->Classroom->get_value(array("fields"=>"`to`","conditions"=>"id ='$id_classroom'"));

						$month_from = strtotime(date("Y-m-01",strtotime($str_month_from)));
						$month_to =   strtotime(date("Y-m-01",strtotime($str_month_to)));;
						$num_month =0;
						do {
							
							//chỉ cập nhật những tháng từ đây trở về sau
							if($month_from>=$current_month_year)
							{
								//echo "cập nhật $customer_name: ".date("Y-m-01",$month_from);
								//echo "str_month_from: $str_month_from - $str_month_to - $num_month -". date("Y-m-d",$month_from)."<br>";
								
								//$this->update_debt($id_user,$customer_name,$id_classroom,$classroom_name,date("Y-m-01",$month_from),$month_year);
							}
						}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
						
						//dựa vào thông tin điểm danh, lưu thông tin nợ hoặc tiền thừa của trẻ trong lớp và tháng hiện tại
						
					
					}//end for
				
					//chuyển sang trang danh sách
					$this->redirect("/attendance/index/0");

				}
				else
				{
					//chuyển về trang danh sách thông báo đã điểm danh rồi
					$this->redirect("/attendance/index?msg=exist_data");
				}
				
		
				
                return;
            }
        }

        // lay danh sach classroom cho select box
        $this->loadModel("Classroom","classrooms");
        $array_list_classroom = $this->Classroom->find("all", array("fields"=>"id,name"));
        array_unshift($array_list_classroom,array('id'=>'','value'=>'...'));
		
		//lấy danh sách dịch vụ có điểm danh
		$this->loadModel("ClassroomService","classroom_services");
		$array_dichvu =  $this->ClassroomService->find("all", array("fields"=>"id,name","conditions"=>"diem_danh = '1'"));

        //dua dl array classroom vao view
        $html_result = $this->View->render("add.php",array('array_list_classroom'=>$array_list_classroom,
                                                        'array_list_customer'=>$array_list_customer,
														'array_dichvu'=>$array_dichvu,
                                                        'id_classroom'=>$id_classroom));
        echo $html_result;
    }
	
	
	function update_debt($id_customer="",$customer_name="",$id_classroom="",$class_name = "",$month_year = "",$current_month_year = "")
	{
		
		
		//kiem tra học sinh tháng này đã có thông tin trong bảng CustomerDebts chưa, nếu có rồi thì update
		$id_customer_debt = $this->CustomerDebt->get_value(array("fields"=>"id","conditions"=>"id_customer='$id_customer' AND id_classroom = '$id_classroom' AND month_year = '$month_year'"));
		
		//echo "hs: $id_customer, $customer_name,$id_customer_debt, $month_year : $current_month_year  ";
		//nếu học sinh chưa có thông tin nợ, thừa($id_customer_debt=="") và tháng cần cập nhật khác với tháng hiện tại thì thoát
		if(($id_customer_debt=="") && ($month_year != $current_month_year) )
		{
			//echo "Chưa có, không phải tháng hiện tại, kết thúc <br>***<br>";
			return;
			 
		}

		
		//echo "Có rồi $id_customer_debt cập nhật hoặc tạo mới <br>***<br>";
		
		//nếu chưa có thì tạo mới giá trị nợ, nếu có rồi thì lấy id để update giá trị nợ tháng này			
		$arr_customer_debt = NULL;
		
		if($id_customer_debt!="")
		{
			$arr_customer_debt["id"]     = $id_customer_debt;
			//echo "Có rồi, cập nhật <br>*********<br>";	
		}
		else
		{
			//echo "Chưa có, đang là tháng điểm danh, tạo mới <br>*********<br>";	
		}
	  	//tính toán tổng số tiền cuối cùng trẻ đang nợ tiền hay đang dư tiền để lưu vào bảng nợ
	  
		  //1. lấy tổng số tiền đã nộp của học sinh trong lớp và trong tháng
		  $tong_danop =$this->Thuchi->get_value(array("fields"=>" SUM( `amount` ) AS tongtien","conditions"=>" `id_classroom` = '$id_classroom' AND `id_customer` = '$id_customer' AND `month_year` = '$month_year'"));
		  if($tong_danop=="") $tong_danop = 0;
		  
		  
		  //2. lấy số tiền dự kiến nộp trong bảng biểu phí của trẻ, nếu không có thì lấy tiền biểu phí của lớp
		  $tong_dukien = $this->FeeCustomer->get_value(array("fields"=>"total_amount","conditions"=>" `id_classroom` = '$id_classroom' AND `id_customer` = '$id_customer' AND `month_year` = '$month_year'"));
		  if($tong_dukien=="" || $tong_dukien =="0") $tong_dukien = $this->FeeClassroom->get_value(array("fields"=>"total_price","conditions"=>" `id_classroom` = '$id_classroom' AND `month_year` = '$month_year'"));
		  if($tong_dukien=="") $tong_dukien = 0;
		  
	
		   //3. lấy danh sách dịch vụ dự kiến thu của học sinh 
			$str_customer_service = $this->FeeCustomer->get_value(array("fields"=>"str_service","conditions"=>"  id_customer  = '$id_customer' AND  id_classroom  = '$id_classroom' AND `month_year` = '$month_year'"));
			if($str_customer_service=="") $str_customer_service = $this->FeeClassroom->get_value(array("fields"=>"str_service","conditions"=>" id_classroom  = '$id_classroom' AND `month_year` = '$month_year'"));
		   $array_dukien_thu = $this->solieu_dukien_thu($str_customer_service );
		  
		  
		   //4. Lấy số ngày đi học của trẻ trong tháng và số ngày đi học thứ 7 của trẻ trong tháng
		   $ngay_dauthang = $month_year;
		   $ngay_cuoithang = date("Y-m-t", strtotime($month_year));
		   
		   					   
		   $songay_dihoc = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND `date`>= '$ngay_dauthang' AND `date`<= '$ngay_cuoithang' AND	sat =0 AND status=1"));
		   $songay_dihoc_theobuoi = $this->Attendance->get_value(array("fields"=>" SUM( CASE WHEN full_day =1 THEN 1 ELSE 0.5 END ) as songay_theobuoi ","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND `date`>= '$ngay_dauthang' AND `date`<= '$ngay_cuoithang' AND	sat =0 AND status=1"));
		   
		   $songay_dihoc_thu7 = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND date>= '$ngay_dauthang' AND date<= '$ngay_cuoithang' AND	sat =1 AND status=1"));
		   $songay_antoi   = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND date>= '$ngay_dauthang' AND date<= '$ngay_cuoithang' AND antoi = 1 AND status=1"));

		   //5. Lấy tổng số bù trừ tháng trước đó
		   //$thangtruoc =  date("Y-m-01",strtotime("$month_year -1 month"));
		   $tong_butru_thangtruoc = $this->CustomerDebt->get_value(array("fields"=>"tong_butru","conditions"=>"id_customer='$id_customer' AND id_classroom = '$id_classroom' AND month_year < '$month_year'",'order'=>"month_year DESC",'limit'=>"1"));
		   if($tong_butru_thangtruoc=="") $tong_butru_thangtruoc = "0";
			//echo " tong_butru_thangtruoc: $tong_butru_thangtruoc id_customer='$id_customer' AND id_classroom = '$id_classroom' AND month_year=' $thangtruoc'";
		   		   
		   //6.tính các khoản tiền thừa
		   $array_tienthua  = $this->tinh_tong_tienthua($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi);
		   $tong_tienthua  =  0;
		   if(isset($array_tienthua["tong_tienthua"])) $tong_tienthua = $array_tienthua["tong_tienthua"];		
		  
		   //7.tính các  khoản số truy thu
		   $array_truythu = $this->tinh_tong_truythu($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi);
		  $tong_truythu  =  0;
		  if(isset($array_truythu["tong_truythu"])) $tong_truythu = $array_truythu["tong_truythu"];	
	
		   //tính các  khoản số truy thu
		  
		  //8. lấy giá trị tổng truy thu
		  	//echo "8: du kien thu";
			//print_r($array_dukien_thu);
			//echo "<br>";
	   	 $array_tien_sudung = $this->tinh_tong_sudung($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi);
		  
		  $tong_sudung  =  0;
		  if(isset($array_tien_sudung["tong_sudung"])) $tong_sudung = $array_tien_sudung["tong_sudung"];	
				  
		  //9. Tính tổng giá trị bù trừ
		  $tong_butru = ($tong_tienthua - $tong_truythu) - ($tong_dukien - $tong_danop) ;
			
		

		//echo "hs $customer_name: du kien $tong_tien_dukien, da nop: $tongtien_danop id:  $id_customer_debt dk: id_customer='$id_customer' AND id_classroom = '$id_classroom' AND month_year = '$month_year'<br>";
		
		$customer_birthday = $this->Customer->get_value(array("fields"=>"birthday","conditions"=>"id='$id_customer'"));
		
		//echo "<br>bd: $customer_birthday <br> ********<br>";
		//lưu thông tin phần đầu trong bảng thống kê tiền thừa
		$arr_customer_debt["id_customer"]     	 = $id_customer;
		$arr_customer_debt["customer_name"]   	   = $customer_name;
		$arr_customer_debt["customer_birthday"]   = $customer_birthday;

		$arr_customer_debt["id_classroom"] 	= $id_classroom;
		$arr_customer_debt["classroom_name"]   = $class_name;
		$arr_customer_debt["month_year"]      = $month_year;
		
		$arr_customer_debt["songay_dukien"]      	= 22;
		$arr_customer_debt["songay_dihoc"]      	 = $songay_dihoc;
		$arr_customer_debt["songay_dihoc_theobuoi"]      	 = $songay_dihoc_theobuoi;
		
		$arr_customer_debt["songay_nghi"]       	  = 22 - $songay_dihoc;
		$arr_customer_debt["songay_antoi"]         = $songay_antoi;
		$arr_customer_debt["songay_dihoc_thu7"]    = $songay_dihoc_thu7;
		$arr_customer_debt["tong_danop"]      	 = $tong_danop;
		
		//lưu thông tin các cột dự kiến
		$arr_customer_debt["dukien_hocphi"]     	 	=  $array_dukien_thu["dukien_hocphi"];
		$arr_customer_debt["dukien_tienan"]     	 	=  $array_dukien_thu["dukien_tienan"];
		$arr_customer_debt["dukien_bantru_phuphi"]     =  $array_dukien_thu["dukien_bantru_phuphi"];
		$arr_customer_debt["dukien_tiensua"]     	   =  $array_dukien_thu["dukien_tiensua"];
		$arr_customer_debt["dukien_an_toi"]     	 	=  $array_dukien_thu["dukien_an_toi"];
		$arr_customer_debt["dukien_phuphi_toi"]     	=  $array_dukien_thu["dukien_phuphi_toi"];
		$arr_customer_debt["dukien_dichvu_khac"]       =  $array_dukien_thu["dukien_dichvu_khac"];
		$arr_customer_debt["dukien_thu7"]     	 	  =  $array_dukien_thu["dukien_thu7"];
		$arr_customer_debt["dukien_sinhnhat"]     	  =  $array_dukien_thu["dukien_sinhnhat"];
		$arr_customer_debt["dangky_antoi"]     	 	 =  $array_dukien_thu["dangky_antoi"];
		$arr_customer_debt["dangky_thu7"]     	 	  =  $array_dukien_thu["dangky_thu7"];
		$arr_customer_debt["tong_dukien"]  	  		  = $tong_dukien;

		
		//lưu thông tin các cột sử dụng
		$arr_customer_debt["sudung_hocphi"]     	 	  =  $array_tien_sudung["sudung_hocphi"];
		$arr_customer_debt["sudung_tienan"]     	 	  =  $array_tien_sudung["sudung_tienan"];
		$arr_customer_debt["sudung_bantru_phuphi"]       =  $array_tien_sudung["sudung_bantru_phuphi"];
		$arr_customer_debt["sudung_tien_sua"]     	 	=  $array_tien_sudung["sudung_tien_sua"];
		$arr_customer_debt["sudung_antoi_phuphi_toi"]    =  $array_tien_sudung["sudung_antoi_phuphi_toi"];
		$arr_customer_debt["sudung_dichvu_khac"]     	 =  $array_tien_sudung["sudung_dichvu_khac"];
		$arr_customer_debt["sudung_thu7"]     	 	  =  $array_tien_sudung["sudung_thu7"];
		$arr_customer_debt["tong_sudung"]     	 	  =  $array_tien_sudung["tong_sudung"];
		
			
		//lưu thông tin các cột tiền thừa
		$arr_customer_debt["tienthua_hocphi"]     	 	=  $array_tienthua["tienthua_hocphi"];
		$arr_customer_debt["tienthua_tienan"]      		=  $array_tienthua["tienthua_tienan"];
		$arr_customer_debt["tienthua_bantru_phuphi"]     =  $array_tienthua["tienthua_bantru_phuphi"];
		$arr_customer_debt["tienthua_tiensua"]      	   =  $array_tienthua["tienthua_tiensua"];
		$arr_customer_debt["tienthua_anto_phuphi_toi"]   =  $array_tienthua["tienthua_anto_phuphi_toi"];
		$arr_customer_debt["tienthua_dichvu_khac"]       =  $array_tienthua["tienthua_dichvu_khac"];
		$arr_customer_debt["tienthua_thu7"]      		  =  $array_tienthua["tienthua_thu7"];
		$arr_customer_debt["tienthua_thangtruoc"]        =  $array_tienthua["tienthua_thangtruoc"];
		$arr_customer_debt["tong_tienthua"]      		  = $tong_tienthua;


		//lưu thông tin các cột truy thu
		$arr_customer_debt["truythu_tienan"]     	  =  $array_truythu["truythu_tienan"];
		$arr_customer_debt["truythu_tiensua"]     	 =  $array_truythu["truythu_tiensua"];
		$arr_customer_debt["truythu_antoi"]     	   =  $array_truythu["truythu_antoi"];
		$arr_customer_debt["truythu_thu7"]     	 	=  $array_truythu["truythu_thu7"];
		$arr_customer_debt["truythu_dichvu_khac"]     =  $array_truythu["truythu_dichvu_khac"];
		$arr_customer_debt["truythu_no_thangtruoc"]   =  $array_truythu["truythu_no_thangtruoc"];
		$arr_customer_debt["tong_truythu"]       		= $tong_truythu;	




		//lưu thông tin các cột tổng cộng		
					
		$arr_customer_debt["tong_butru"]         = $tong_butru;
		
		if($tong_butru>0) $arr_customer_debt["type"]      = 0;
		else $arr_customer_debt["type"]      = 1;
		
		$arr_customer_debt[" id_created_user"]      = $this->User->id;
		$arr_customer_debt[" created_username "]    = $this->User->username;
					
		//print_r($arr_customer_debt);			
		$this->CustomerDebt->save($arr_customer_debt);	
	}
	
	//tính tổng tiền thừa
	function tinh_tong_sudung($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi)
	{
	
		//1.tính số tiền sử dụng học phí
		
		$sudung_hocphi =0;
		
		//echo "so ngay di học $songay_dihoc"; 
		//print_r($array_dukien_thu);
		//echo "<br>";
		
		if($songay_dihoc<=11) $sudung_hocphi = $array_dukien_thu["dukien_hocphi"]/22*$songay_dihoc;
		else $sudung_hocphi = $array_dukien_thu["dukien_hocphi"];

		// kết thúc phần sử dụng học phí
				
		//2.tính số sử dụng tiền ăn
		$sudung_tienan = $array_dukien_thu["dukien_tienan"]/22*$songay_dihoc;
		
	
	
	
	
		//3.tính số sử dụng bán trú và phụ phí
		$sudung_bantru_phuphi = 0;
		if($songay_dihoc<=11) $sudung_bantru_phuphi = $array_dukien_thu["dukien_bantru_phuphi"]/22*$songay_dihoc;
		else $sudung_bantru_phuphi = $array_dukien_thu["dukien_bantru_phuphi"];
		
	// kết thúc phần sử dụng bán trú và phụ phí
				
				
		//4.tính số sử dụng tiền sữa
		$sudung_tien_sua = $array_dukien_thu["dukien_tiensua"]/22*$songay_dihoc_theobuoi;
		
		// kết thúc phần sử dụng tiền sữa	
		
		//5.tính số sử dụng ăn tối và phụ phí tối
		$sudung_antoi_phuphi_toi = 0;
		if($array_dukien_thu["dangky_antoi"]==false) $sudung_antoi_phuphi_toi = 0;
		else
		{

			if($songay_antoi<=11) $sudung_antoi_phuphi_toi	= ($array_dukien_thu["dukien_an_toi"] + $array_dukien_thu["dukien_phuphi_toi"])/22*$songay_antoi;
			else $sudung_antoi_phuphi_toi = $array_dukien_thu["dukien_an_toi"]/22*$songay_antoi + $array_dukien_thu["dukien_phuphi_toi"];
			
		}


		//6.tính số sử dụng dịch vụ khác
		$sudung_dichvu_khac = 0;
		
		if($array_dukien_thu["dangky_dichvu_khac"]==true)
		{	
			if($songay_dihoc<=0) $sudung_dichvu_khac = 0;
			else
			{
				if($songay_dihoc<=11) $sudung_dichvu_khac = $array_dukien_thu["dukien_dichvu_khac"]/2;
				else $sudung_dichvu_khac = $array_dukien_thu["dukien_dichvu_khac"];	
			}
		}
		// kết thúc phần sử dụng tiền  dịch vụ khác		
	

		//7.tính số sử dụng thứ 7
		$sudung_thu7 = 0;
		if($array_dukien_thu["dangky_thu7"]==true)
		{
			//lấy số ngày đi học thứ 7 từ điểm danh	
			$sudung_thu7 = $songay_dihoc_thu7*($array_dukien_thu["dukien_thu7"]/4);
			
		}
		// kết thúc phần sử dụng thứ 7
					
		//8.tính số tiền đã sử dụng
		$tong_sudung = $sudung_hocphi + $sudung_tienan + $sudung_bantru_phuphi + $sudung_tien_sua + $sudung_antoi_phuphi_toi +$sudung_dichvu_khac + $sudung_thu7;
		
		
		$array_tien_sudung = NULL;

		$array_tien_sudung["sudung_hocphi"] = $sudung_hocphi;
			
		$array_tien_sudung["sudung_tienan"] = $sudung_tienan;		
		$array_tien_sudung["sudung_bantru_phuphi"] = $sudung_bantru_phuphi;
			
		$array_tien_sudung["sudung_tien_sua"] = $sudung_tien_sua;		
		$array_tien_sudung["sudung_antoi_phuphi_toi"] = $sudung_antoi_phuphi_toi;
		
		$array_tien_sudung["sudung_dichvu_khac"] = $sudung_dichvu_khac;
		$array_tien_sudung["sudung_thu7"] = $sudung_thu7;		
		$array_tien_sudung["tong_sudung"] = $tong_sudung;
			
		//echo "<br> tsd:";			
		//print_r($array_tien_sudung);	
		//echo "<br> tsd:";					
		
		return $array_tien_sudung;
	// kết thúc phần stính số tiền đã sử dụng		
	
	}
	//tính tổng tiền thừa
	function tinh_tong_tienthua($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi)
	{
	
	  	   //1. tính tiền thừa học phí
		  $tienthua_hocphi = 0;
		  if($songay_dihoc<=11) $tienthua_hocphi = $array_dukien_thu["dukien_hocphi"]/22*(22-$songay_dihoc);
		  
		  //2. Tính tiền thừa tiền ăn
		  $tienthua_tienan 	= 0;
		  if($songay_dihoc<22) $tienthua_tienan 	= $array_dukien_thu["dukien_tienan"]/22*(22-$songay_dihoc);
		  
		  //3. Tính tiền thừa bán trú, phụ phí
		  $tienthua_bantru_phuphi = 0;
		  if($songay_dihoc<=11) $tienthua_bantru_phuphi = $array_dukien_thu["dukien_bantru_phuphi"]/22*(22-$songay_dihoc);
				
		  //4. Tính tiền thừa tiền sữa
		  $tienthua_tiensua = 0;
		  if($songay_dihoc<=22) $tienthua_tiensua = $array_dukien_thu["dukien_tiensua"]/22*(22-$songay_dihoc_theobuoi);
				  

		  //5. Tính tiền thừa bán trú, phụ phí
		  $tienthua_anto_phuphi_toi = 0;
		  if($array_dukien_thu["dangky_antoi"]==true)
		  {
			 $tienthua_anto_phuphi_toi =  $array_dukien_thu["dukien_an_toi_phuphi_toi"]/22*(22-$songay_antoi);
		  }


		  //6. Tính tiền thừa dịch vụ khác
		  $tienthua_dichvu_khac = 0;
		  if($songay_dihoc<=11) $tienthua_dichvu_khac = $array_dukien_thu["dukien_dichvu_khac"]/2;
		  	
		  //7. Tính tiền thừa thứ 7
		  $tienthua_thu7 = 0;
		  $sudung_thu7 = $songay_dihoc_thu7*($array_dukien_thu["dukien_thu7"]/4);
		  if($array_dukien_thu["dangky_thu7"]==true) $tienthua_thu7 =  $array_dukien_thu["dukien_thu7"] - $sudung_thu7;
	
		  //8. Tính tiền thừa tháng trước	
		  $tienthua_thangtruoc 		= 0;
		  if($tong_butru_thangtruoc >0 ) $tienthua_thangtruoc = $tong_butru_thangtruoc; 
		  
		  //9. Tính ra tổng tiền thừa
		  $tong_tienthua = $tienthua_hocphi + $tienthua_tienan + $tienthua_bantru_phuphi + $tienthua_tiensua + $tienthua_anto_phuphi_toi + $tienthua_dichvu_khac + $tienthua_thu7 +$tienthua_thangtruoc;
		  
		  
		  //10. Đưa vào mảng và trả về kết quả hàm
		  $array_tienthua = NULL;
		  $array_tienthua["tienthua_hocphi"] 		= $tienthua_hocphi;
		  $array_tienthua["tienthua_tienan"] 		= $tienthua_tienan;
		  
		  $array_tienthua["tienthua_bantru_phuphi"] = $tienthua_bantru_phuphi;
		  
		  $array_tienthua["tienthua_tiensua"]         = $tienthua_tiensua;
		  $array_tienthua["tienthua_anto_phuphi_toi"] = $tienthua_anto_phuphi_toi;
		  $array_tienthua["tienthua_dichvu_khac"] 	 = $tienthua_dichvu_khac;
		  $array_tienthua["tienthua_thu7"] 			= $tienthua_thu7;
		  $array_tienthua["tienthua_thangtruoc"] 	  = $tienthua_thangtruoc;
		  $array_tienthua["tong_tienthua"] 	  		= $tong_tienthua;
		  return $array_tienthua; 	

	}
	
	//lấy số liệu các khoản dự kiến
	function tinh_tong_truythu($array_dukien_thu,$songay_dihoc,$songay_dihoc_thu7,$tong_butru_thangtruoc,$songay_antoi,$songay_dihoc_theobuoi)
	{
		$array_truythu = NULL;
		
		//1.tính truy thu tiền ăn
		$truythu_tienan = 0;
		if($songay_dihoc>22) $truythu_tienan = $array_dukien_thu["dukien_tienan"]/22*($songay_dihoc-22);				

		//2.tính truy thu tiền sữa
		$truythu_tiensua = 0;
		if($songay_dihoc>22) $truythu_tiensua = $array_dukien_thu["dukien_tiensua"]/22*($songay_dihoc_theobuoi-22);
		
				  
				  
		//3.tính truy thu tiền ăn tối
		$truythu_antoi = 0;
		if($array_dukien_thu["dangky_antoi"]==true)
		{
			 //nếu có đăng ký ăn tối
			 if($songay_antoi>22) $truythu_antoi = $array_dukien_thu["dukien_an_toi_phuphi_toi"]/22*($songay_antoi-22);	
		}else
		{
			
			//nếu không có đăng ký ăn tối thì lấy số tiền dự kiến ăn tối trong bảng dịch vụ
			//if($songay_antoi>11) $truythu_antoi = $array_dukien_thu["dichvu_dukien_antoi"]/22*$songay_antoi + $dichvu_dukien_phuphitoi;
			//else 
			//{
				$truythu_antoi = 364000/22*$songay_antoi;
			//}
		}

			  
							  

		//4. Truy thu tiền thứ 7
		$truythu_thu7 = 0;
		if($array_dukien_thu["dangky_thu7"]==true)
		{
			//nếu có đăng ký thứ 7 và đi học nhiều hơn 4 ngày
			if($songay_dihoc_thu7>4) $truythu_thu7 =  ($array_dukien_thu["dukien_thu7"]/4)*($songay_dihoc_thu7-4);	
		}else
		{
			  
			  //nếu không có đăng ký thứ 7
			  $truythu_thu7 =  (308000/4)*($songay_dihoc_thu7);
		}
		// kết thúc tính truy thu thứ 7	
			  

		//5. Truy thu tiền dịch vụ khác
		$truythu_dichvu_khac = 0;
		
		//6. Truy thu tiền nợ
	 	 $truythu_no_thangtruoc = 0;
		 if($tong_butru_thangtruoc<0)   $truythu_no_thangtruoc = abs($tong_butru_thangtruoc);
		 

 		//7. Tính tổng truy thu
		$tong_truythu = $truythu_tiensua + $truythu_tiensua + $truythu_antoi + $truythu_thu7 + $truythu_dichvu_khac + $truythu_no_thangtruoc ;
		
		//Đưa về mảng để trả về kết quả hàm
		$array_truythu["truythu_tienan"] 		 = $truythu_tienan;
		$array_truythu["truythu_tiensua"] 		= $truythu_tiensua;
		$array_truythu["truythu_antoi"]	 	  = $truythu_antoi;
		$array_truythu["truythu_thu7"] 		   = $truythu_thu7;
		$array_truythu["truythu_dichvu_khac"]    = $truythu_dichvu_khac;		 
 		$array_truythu["truythu_no_thangtruoc"]  = $truythu_no_thangtruoc;
		$array_truythu["tong_truythu"] 		   = $tong_truythu;
		return $array_truythu;
	}	
	
	//lấy số liệu các khoản dự kiến
	function solieu_dukien_thu($str_service = "")
	{
		$array_dukien = NULL;
		
		$array_dukien["dukien_hocphi"]  = 0;
		$array_dukien["dukien_tienan"] = 0;		
		$array_dukien["dukien_bantru_phuphi"] = 0;
		$array_dukien["dukien_tiensua"] = 0;				
		$array_dukien["dukien_an_toi"] = 0;				
		$array_dukien["dukien_phuphi_toi"] = 0;	
		$array_dukien["dukien_an_toi_phuphi_toi"] = 0;	
		
				
		$array_dukien["dukien_dichvu_khac"] = 0;	
		$array_dukien["dukien_thu7"] = 0;
		$array_dukien["dukien_sinhnhat"] = 0;	
		
		
		//đăng ký thứ 7 và đăng ký ăn tối
		$array_dukien["dangky_antoi"] = false;						
		$array_dukien["dangky_thu7"] = false;						
		$array_dukien["dangky_dichvu_khac"] = false;

		$array_str_service = explode(chr(9),$str_service);


		for($i = 0;$i < (count($array_str_service)-1);$i++)
		{
			  $array_service = explode(chr(8),$array_str_service[$i]);
			  if(isset($array_service[0])) $ten_dichvu = $array_service[0];
			  if(isset($array_service[1])) $gia_dichvu = $array_service[1];
			  if(isset($array_service[3])) $code_dichvu = $array_service[3];
			  
			  //echo "ten dv: ".$ten_dichvu."-";
			  //echo "gia_dichvu: ".$gia_dichvu."-";
			  //echo "code_dichvu: ".$code_dichvu."<br>";
			  
		  
				  if($code_dichvu == "hocphi") $array_dukien["dukien_hocphi"] = $gia_dichvu;
				  if($code_dichvu == "tienan") $array_dukien["dukien_tienan"]  = $gia_dichvu;
				  
				  if($code_dichvu == "bantru_phuphi") $array_dukien["dukien_bantru_phuphi"]  = $gia_dichvu;
				  if($code_dichvu == "sua") $array_dukien["dukien_tiensua"]   = $gia_dichvu;
				  

				  if($code_dichvu == "antoi") 
				  {
					  $array_dukien["dangky_antoi"] = true;
					  $array_dukien["dukien_an_toi"] = $gia_dichvu;
				  }
				  if($code_dichvu == "phuphitoi") 
				  {
					  $array_dukien["dukien_phuphi_toi"] = $gia_dichvu;
					  
					   $array_dukien["dangky_antoi"] = true;
				  }
				  
				  if($code_dichvu == "khac"){
					  
					  $array_dukien["dukien_dichvu_khac"] += $gia_dichvu;
					  $array_dukien["dangky_dichvu_khac"] = true;					  
					  					  
				  }

				  if($code_dichvu == "tienthu7")
				  {
					   $array_dukien["dukien_thu7"] = $gia_dichvu;
					   $array_dukien["dangky_thu7"] = true;
				  }
				  if($code_dichvu == "sinhnhat") $array_dukien["dukien_sinhnhat"] =  $gia_dichvu;
				  
				  
				  if($code_dichvu == "phihoc_daunam") $array_dukien["tien_phihoc_daunam"]  = $gia_dichvu;

						
		}//end for
		
		$array_dukien["dukien_an_toi_phuphi_toi"] = $array_dukien["dukien_an_toi"] + $array_dukien["dukien_phuphi_toi"];	
		return $array_dukien;
					
	//kết thúc hàm lấy số liệu các khoản dự kiến		
	}
	
	 function detail($id_classroom = "",$day = "",$type = "")
    {
        $this->loadModel("Attendance","attendancies");
		
		if($day != "") $day = date('Y-m-d',strtotime($day));
		
		if($type == 1) $dieukien = "(`date` = '$day') AND (`type` = '$type')";
		else $dieukien = "(`id_classroom` = '$id_classroom') AND (`date` = '$day') AND (`type` = '$type')";
		
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($tim != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien_tim = str_replace("'","''",$tim);
				$dieukien .= " (`fullname` LIKE '%$dieukien_tim%')";
			}
		}
		
		$status = "";
		/*if(isset($_POST["status"]))
		{
			$status = $_POST["status"];
			if($status != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`status` = '$dieukien_status')";	
			}
		}*/
		
        //lay tat ca dl tu bang Attendance
        $array_attendance = $this->Attendance->find("all",array("conditions" => $dieukien,"order"=>"`fullname` ASC"));
		$classroom_name = "";
		if($array_attendance != NULL) $classroom_name = $array_attendance[0]["classroom_name"];

        //dua dl array classroom vao view
        $html_result = $this->View->render("detail.php",array("array_attendance"=>$array_attendance,"day"=>$day,"tim"=>$tim,"status"=>$status,"id_classroom"=>$id_classroom,"classroom_name"=>$classroom_name,"type"=>$type));
        echo $html_result;
    }
	
	function teacher()
    {
        $this->loadModel("Arrange","arranges");
		$this->loadModel("Attendance","attendancies");
		$this->loadModel("User","users");
		
		if (isset($_POST['data']))
        {
			$array_luu = $_POST['data']['DiemDanh'];
			$date = date('Y-m-d',strtotime($array_luu['date']));
			
			$array_attendance = NULL;
          	if(isset($array_luu["GiaoVien"])) $array_attendance = $array_luu["GiaoVien"];
			$array_diemdanh_giaovien = NULL;
			$current_date = date("Y-m-d");
			$id_diem_danh = "";
				
			//kiểm tra ngày hôm đó đã có điểm danh hay chưa
			$id_diem_danh = $this->Attendance->get_value(array("conditions"=>"`type` = '1' AND `date` = '$date'"));
			
			if($id_diem_danh == "")
			{
				if($array_attendance != NULL)
				{
					foreach ($array_attendance as $attendance)
					{
						$id_user = $attendance["id_user"];
						
						//Lấy thông tin từng giáo viên dựa theo id_giaovien
						$arr_giaovien = $this->Arrange->find("all",array("conditions"=>"(`id_fullname` = '$id_user') AND (`type` = '1') AND (`status` = '1')"));
						$id_classroom = "";
						$classroom_name = "";
						if($arr_giaovien != NULL)
						{
							$id_classroom = $arr_giaovien[0]["id_classroom"];
							$classroom_name = $arr_giaovien[0]["classroom_name"];
						}
						
						$array_diemdanh_giaovien['id_classroom']   = $id_classroom;
						$array_diemdanh_giaovien['classroom_name'] = $classroom_name;
						$array_diemdanh_giaovien['id_user']     = $id_user;
						$array_diemdanh_giaovien['fullname']   = $attendance["fullname"];
						
						$array_diemdanh_giaovien['date'] = $date;
						
						//kiểm tra ngày điểm danh có phải là thứ 7 hay không?
						if(date('w', strtotime($array_diemdanh_giaovien['date'])) == 6)
						{
							$array_diemdanh_giaovien['sat'] = 1;
						}
						
						if($array_diemdanh_giaovien['date'] == $current_date) $array_diemdanh_giaovien['approve'] = "1";
						else $array_diemdanh_giaovien['approve'] = "0";
		
						if(isset($attendance['status']) && $attendance['status'] == "on")
						{
							$array_diemdanh_giaovien['status'] = 1;
							$array_diemdanh_giaovien['full_day'] = 1;
						}
						if(isset($attendance['half_day']) && $attendance['half_day'] == "on")
						{
							$array_diemdanh_giaovien['status'] = 1;
							$array_diemdanh_giaovien['full_day'] = 0;
						}
						if(isset($attendance['vang']) && $attendance['vang'] == "on") $array_diemdanh_giaovien['status'] = 0;
						
						$array_diemdanh_giaovien['type'] =  "1";
						$array_diemdanh_giaovien['id_created_user'] =  $this->User->id;
						$array_diemdanh_giaovien['created_username'] =  $this->User->fullname;
					
						//Lưu
						$this->Attendance->save($array_diemdanh_giaovien);
					}
					
				}
				$this->redirect("/attendance/index/1");
				return;
			}
		}
		
		$array_giaovien = $this->User->find("all",array("order"=>"`type` ASC"));

        //dua dl array classroom vao view
        $html_result = $this->View->render("diemdanh_giaovien.php",array(
                                                        'array_giaovien'=>$array_giaovien
                                                        ));
        echo $html_result;
    }
	
	function edit($id_classroom = "",$date = "",$type = "")
    {
        $this->loadModel("Arrange","arranges");
		$this->loadModel("Attendance","attendancies");
		$this->loadModel("Customer");
		$this->loadModel("Classroom");
			
		$this->loadModel("CustomerDebt","customer_debts");
		$this->loadModel("Thuchi","thu_chis");
		$this->loadModel("FeeCustomer","fee_customers");
		$this->loadModel("FeeClassroom","fee_classrooms");		
		
		
		//echo "update 22222:";
		if (isset($_POST['data']))
        {
			$ngay_diem_danh = $_POST['data']['date'];
			if(isset($_POST['data']['DiemDanh'])) $array_attendance = $_POST['data']['DiemDanh'];
			
			$array_diemdanh = NULL;
			
			//echo "update 3333";
			
			if($array_attendance != NULL)
			{
				
				$str_month_from 	= "";
				$str_month_to 	  = "";
				$classroom_name 	= "";
				$array_class_room  = $this->Classroom->find("all",array("fields"=>"`from`,`to`,`name`","conditions"=>"id ='$id_classroom'"));
				
				//echo "class info:";
				//print_r($array_class_room);
				if($array_class_room)
				{
					$str_month_from 	= $array_class_room[0]["from"];
					$str_month_to 	  = $array_class_room[0]["to"];
					$classroom_name 	= $array_class_room[0]["name"];
					
				}
					
				for($i = 0; $i < count($array_attendance); $i++)
				{
					$array_diemdanh['id']   = $array_attendance[$i]['id'];
					$array_diemdanh['date']   = date("Y-m-d",strtotime($ngay_diem_danh));
					
					$id_user = $array_attendance[$i]['id_user'];
					
					//kiểm tra ngày điểm danh có phải là thứ 7 hay không?
					if(date('w', strtotime($array_diemdanh['date'])) == 6)
					{
						$array_diemdanh['sat'] = 1;
					}
					
					//kiểm tra điểm danh dịch vụ ăn tối
					if(isset($array_attendance[$i]['antoi'])) $array_diemdanh['antoi'] = $array_attendance[$i]['antoi'];
					
					if(isset($array_attendance[$i]['status']) && $array_attendance[$i]['status'] == "on")
					{
						$array_diemdanh['status'] = 1;
						$array_diemdanh['full_day'] = 1;
					}
					if(isset($array_attendance[$i]['half_day']) && $array_attendance[$i]['half_day'] == "on")
					{
						$array_diemdanh['status'] = 1;
						$array_diemdanh['full_day'] = 0;
					}
					if(isset($array_attendance[$i]['vang']) && $array_attendance[$i]['vang'] == "on") $array_diemdanh['status'] = 0;
					
					//$array_diemdanh['id_created_user'] =  $this->User->id;
					//$array_diemdanh['created_username'] =  $this->User->fullname;
					
					//Lưu
					$this->Attendance->save($array_diemdanh);
					
					
					//******************************************
					// CẬP NHẬT PHẦN THỐNG KÊ TIỀN THỪA
					//***********************************************
					
					// lấy ngày đầu tháng của tháng đang điểm danh
					$month_year =  date("Y-m-01",strtotime($ngay_diem_danh));
					//echo "cập nhật tháng này: $month_year<br>";
					
					//lấy tháng đang điểm danh kiểu datetime	
					$current_month_year =  strtotime(date("Y-m-01",strtotime($ngay_diem_danh)));
						
					

					$month_from = strtotime(date("Y-m-01",strtotime($str_month_from)));
					$month_to =   strtotime(date("Y-m-01",strtotime($str_month_to)));
					$num_month =0;
					do {
							
							//chỉ cập nhật những tháng từ đây trở về sau
							if($month_from>=$current_month_year)
							{
								$id_user 		= $array_attendance[$i]['id_user'];
								$customer_name  = $array_attendance[$i]['customer_name'];

								//echo "cập nhật trẻ $customer_name: $id_classroom, $classroom_name: ".date("Y-m-01",$month_from);
								//echo "str_month_from: $str_month_from - $str_month_to - $num_month -". date("Y-m-d",$month_from)."<br>";
								
								$this->update_debt($id_user,$customer_name,$id_classroom,$classroom_name,date("Y-m-01",$month_from),$month_year);
							}
					}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
						
						//******************************************
						// CẬP NHẬT PHẦN THỐNG KÊ TIỀN THỪA
						//***********************************************
				
					///
					
						
				} //end for($i = 0; $i < count($array_attendance); $i++)
			} //end if($array_attendance != NULL)
			
				
			
			$this->redirect("/attendance/index/$type");
			return;
		}
		
		$date = date("Y-m-d",strtotime($date));
		
		$dieukien_tre = "";
		if($type == 0) $dieukien_tre = "(`id_classroom` = '$id_classroom') AND";
		$array_diemdanh = $this->Attendance->find("all",array("conditions" =>"$dieukien_tre (`date` = '$date') AND (`type` = '$type')","order"=>"`fullname` ASC"));
		
		$classroom_name = $array_diemdanh[0]["classroom_name"];
		
        //dua dl array classroom vao view
        $html_result = $this->View->render("sua_diemdanh.php",array(
                                                        'array_diemdanh'=>$array_diemdanh,
														'date'=>$date,
														'id_classroom'=>$id_classroom,
														'type'=>$type,
														'classroom_name'=>$classroom_name
                                                        ));
        echo $html_result;
    }
	
	function duyet($type = "")
    {
        $dieukien = "(`approve` = '0')";
		$id_classroom = $tungay = $denngay = "";
        if (isset($_POST['id_classroom']))
        {
            $id_classroom  = $_POST['id_classroom'];
            if($id_classroom != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_classroom` = '$id_classroom')";
			}
        }
        if (isset($_POST['startday']))
        {
            $tungay = $_POST['startday'];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` >= '$dieukien_tungay')";	
			}
        }
        if (isset($_POST['finishday']))
        {
            $denngay = $_POST['finishday'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`date` <= '$dieukien_denngay')";	
			}
        }
		
		if($type == "") $type = "0";
		if (isset($_POST['type']))
        {
            $type  = $_POST['type'];
            if($type != "")
			{ 
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`type` = '$type')";
			}
        }else $dieukien .= " AND (`type` = '$type')";
		
		$group = " GROUP BY DATE_FORMAT( `date` , '%d-%m-%Y' )";
		if($type == 0) $group = "GROUP BY  `id_classroom` , DATE_FORMAT( `date` , '%d-%m-%Y' )";
      
        $this->loadModel("Attendance","attendancies");
		
        //lay tat ca dl tu bang Attendance
        $array_attendance = $this->Attendance->find("all",array("fields"=>"`id_classroom` , `classroom_name` , DATE_FORMAT(  `date` , '%d-%m-%Y' ) AS ngaydiemdanh , COUNT( id ) AS siso , SUM(IF( status =  '1' AND full_day = '1', 1, 0 ))  AS dihoc,   SUM(IF( status =  '1' AND full_day = '0', 1, 0 ))  AS nuabuoi,   SUM(IF( status =  '0',1, 0 ))  AS vang, SUM(antoi) AS antoi","conditions" =>"$dieukien $group","order"=>"`date` DESC"));
		
        // lay danh sach classroom cho select box
        $this->loadModel("Classroom","classrooms");
        $array_list_classroom = $this->Classroom->find("all", array("fields"=>"id,name"));
        array_unshift($array_list_classroom,array('id'=>'','value'=>'Tất cả'));

        //dua dl array classroom vao view
        $html_result = $this->View->render("danhsach_duyet.php",array("array_attendance"=>$array_attendance,'array_list_classroom'=>$array_list_classroom,'id_classroom'=>$id_classroom,'denngay'=>$denngay,'tungay'=>$tungay,'type'=>$type,'group'=>$group));
        echo $html_result;
    }

	function approve($id_classroom = "",$date = "",$type = "")
    {
		$table_prefix = "";		
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		
		$this->loadModel("Attendance","attendancies");
		
		if($id_classroom != "" && $date != "" && $table_prefix != "")
		{
			$date = date("Y-m-d",strtotime($date));
			$dieukien_tre = "";
			if($type == 0) $dieukien_tre = "`id_classroom` = '$id_classroom' AND";
			$sql_update = "UPDATE ".$table_prefix."attendancies SET `approve` = '1' WHERE $dieukien_tre `date` = '$date' AND `type` = '$type'";
			$this->Attendance->excute($sql_update);
		}
		
		$this->redirect("/attendance/duyet/$type");
		return;
    }
	
	function del($id_classroom = "",$date = "",$type = "")
    {
		$table_prefix = "";		
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		
		$this->loadModel("Attendance","attendancies");
		$this->loadModel("Classroom");
		
		$this->loadModel("Arrange","arranges");
		$this->loadModel("Customer");
		
		$this->loadModel("CustomerDebt","customer_debts");
		$this->loadModel("Thuchi","thu_chis");
		$this->loadModel("FeeCustomer","fee_customers");
		$this->loadModel("FeeClassroom","fee_classrooms");
		
		
		if($id_classroom != "" && $date != "" && $table_prefix != "")
		{
			$date = date("Y-m-d",strtotime($date));
			$dieukien_tre = "";
			if($type == 0) $dieukien_tre = "`id_classroom` = '$id_classroom' AND";
			$sql_update = "DELETE FROM ".$table_prefix."attendancies WHERE $dieukien_tre `date` = '$date' AND `type` = '$type'";
			$this->Attendance->excute($sql_update);
			
			
			
			//sau khi xoa xong thi cap nhat lai bang cong no tien thua
			
			//lấy string ngày đầu tháng
			$month_year =  date("Y-m-01",strtotime($date));
			
			//$this->update_debt($id_user,$customer_name,$id_classroom,$classroom_name,$month_year);						
			//Cập nhật tiền thừa cho tất cả các tháng từ đây trở về sau
			//lấy danh sách tháng của lớp hiện tại
			
			
			
			//echo "Ngày cần xóa 2222: $date <br>";
			
			//lấy ngày đầu tháng
			$current_month_year =  strtotime(date("Y-m-01",strtotime($date)));
			
			//lấy tháng đầu tiên của lớp
			$str_month_from = $this->Classroom->get_value(array("fields"=>"`from`","conditions"=>"id ='$id_classroom'"));
			//echo "Tháng đầu tiên của lớp $str_month_from <br>";
			
			//lấy tháng cuối cùng của lớp
			$str_month_to = $this->Classroom->get_value(array("fields"=>"`to`","conditions"=>"id ='$id_classroom'"));
			//echo "Tháng cuối cùng của lớp $str_month_to <br>";

			$month_from_goc = strtotime(date("Y-m-01",strtotime($str_month_from)));
			$month_to =   strtotime(date("Y-m-01",strtotime($str_month_to)));
			
			
			$num_month =0;
			
			//lấy danh sách học sinh trong lớp
			$array_custormer = 	 $this->Arrange->find("all",array("fields"=>"id_fullname,fullname,classroom_name","conditions" =>"id_classroom = '$id_classroom'"));
			//print_r($array_custormer);

			//cập nhật công nợ của học sinh từ tháng hiện tại trở về sau
			foreach($array_custormer as $custormer)
			{
				
				$month_from = $month_from_goc;
				do {
					
					//chỉ cập nhật những tháng từ đây trở về sau
					if($month_from>=$current_month_year)
					{
						//echo "cập nhật $customer_name: ".date("Y-m-01",$month_from);
						//echo "Tháng: ". date("Y-m-d",$month_from)." - học sinh:". $custormer["fullname"]. "-".  $custormer["classroom_name"] ."<br>";
						
						$this->update_debt($custormer["id_fullname"],$custormer["fullname"],$id_classroom,$custormer["classroom_name"],date("Y-m-01",$month_from),$month_year);
					}
				}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
			}
						//dựa vào thông tin điểm danh, lưu thông tin nợ hoặc tiền thừa của trẻ trong lớp và tháng hiện tại	
			
			// ket thuc xu ly cong no tien thua
		}
		
		$this->redirect("/attendance/index/$type");
		return;
    }
}
?>