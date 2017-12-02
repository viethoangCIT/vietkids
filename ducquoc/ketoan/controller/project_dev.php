<?php
class project extends Main
{
	function index()
	{

		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;

		//lấy ra model dữ liệu
		$this->loadModel("Project",$table_prefix."projects");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("Project","projects");
		$str_conditions = "";

		if($this->User->type != "1")
		{
			//lấy quyền xem dữ liệu bảng project của user hiện tại
			$str_conditions = $this->User->Project->view_conditions;
		}
		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm
		$tim = "";
		$tungay = "";
		$denngay = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($str_conditions!="")
				$str_conditions .= " AND " ;
			$str_conditions  = "(customer_name LIKE '%$tim%' OR name LIKE '%$tim%')";
		}
		//kiem tra co dieu kien tungay
		if(isset($_POST["tungay"]))
		{
			$tungay = $_POST["tungay"];
			if($tungay!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tmp_tungay = date("Y-m-d",strtotime($tungay));
				if($str_conditions!="")
					$str_conditions .= " AND " ;
				$str_conditions .= " (start_date >= '$tmp_tungay')  ";

			}
		}
		//kiem tra co dieu kien tungay
		if(isset($_POST["denngay"]))
		{
			$denngay = $_POST["denngay"];
			if($denngay!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tmp_denngay = date("Y-m-d",strtotime($denngay));

				if($str_conditions!="")
					$str_conditions .= " AND " ;
				$str_conditions .= " (start_date <= '$tmp_denngay')  ";


			}
		}

		$array_du_an = $this->Project->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		$danhsach = $this->View->render('index.php',array("array_du_an"=>$array_du_an,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay));
		echo $danhsach;
	}

	function nhap($tmp_id="")
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Project",$table_prefix."projects");
		$this->loadModel("Customer",$table_prefix."customers");
		$this->loadModel("User2",$table_prefix."users");

		$array_kh = NULL;

		if($this->User->type == "1")
		{
			$array_kh =  $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Customer","customers");
			$str_conditions = $this->User->Customer->view_conditions;
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions,"order"=>"id DESC"));
		}

		$array_nguoiquanly = NULL;

		if($this->User->type == "1")
		{
			$array_nguoiquanly =  $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"`status` = '1' AND `type` <> '2'"));
		}else
		{
			$this->User->get_permission("User2","users");
			$str_conditions_quanly = $this->User->User2->view_conditions;
			$array_nguoiquanly = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"($str_conditions_quanly) AND (`status` = '1') AND (`type` <> '2')","order"=>"id DESC"));
		}
		if($array_nguoiquanly!=NULL) $array_nguoiquanly = array(""=>array("id"=>"","fullname"=>"...")) + $array_nguoiquanly;
		else $array_nguoiquanly = array(""=>array("id"=>"","fullname"=>"..."));

		$array_sua = NULL;
		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->Project->find("all",array("conditions"=>"id = $tmp_id"));
		}

		//kiểm tra có duex liệu từ ng` dùng
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_duan = $_POST["data"]["project"];
			$array_duan["start_date"] = date("Y-m-d",strtotime($array_duan["start_date"]));
			$array_duan["finish_date"] = date("Y-m-d",strtotime($array_duan["finish_date"]));
			$array_duan["created_time"] = date("Y-m-d",strtotime($array_duan["created_time"]));
			$array_duan['customer_group'] = "";
			$arrray_get_group_customer = $this->Customer->find("all",array("conditions"=>"id = '".$array_duan['id_customer']."'"));
			if($arrray_get_group_customer) $array_duan['customer_group'] = $arrray_get_group_customer[0]["group"];

			$array_duan['id_created_user'] = $this->User->id;
			$array_duan['created_username'] = $this->User->username;

			//luu du lieu vao database
			$this->Project->save($array_duan);

			if(isset($_GET["ajax"]))
			{
				$module_request = $_GET["ajax"];
				$this->redirect("/contract/add.html");
			}

			$array_dulieu_cu = $this->Project->find("all",array("order"=>"id DESC"));
			$them_duan = $this->View->render('nhap.php',array("array_sua"=>$array_sua,"array_kh"=>$array_kh,"array_dulieu_cu"=>$array_dulieu_cu));
			echo $them_duan;
			//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
			//if(isset($this->User->modules["ducquoc/ketoan"]["project"]["manage"])|| ($this->User->type == 1)) $this->redirect("/project/manage.html");
			//else 	$this->redirect("/project/index.html");

			return;
		}
		$su_dung_layout = true;
		if(isset($_GET["ajax"]))  $su_dung_layout = false;

		$them_duan = $this->View->render('nhap.php',array("array_sua"=>$array_sua,"array_kh"=>$array_kh,"array_nguoiquanly"=>$array_nguoiquanly),$su_dung_layout);
		echo $them_duan;
	}

	function xoa($tmp_id="")
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Project",$table_prefix."projects");

		$this->Project->delete($tmp_id);

		//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
		if(isset($this->User->modules["ducquoc/ketoan"]["project"]["manage"])|| ($this->User->type == 1)) $this->redirect("/project/manage.html");
		else 	$this->redirect("/project/index.html");
	}
	function manage()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Project",$table_prefix."projects");
		$str_conditions = "";
		$tim = "";
		$tungay = "";
		$denngay = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($tim!="") $str_conditions .= "(customer_name LIKE '%$tim%' OR name LIKE '%$tim%' OR code LIKE '%$tim%')";
		}
		//kiem tra co dieu kien tungay
		if(isset($_POST["tungay"]))
		{
			$tungay = $_POST["tungay"];
			if($tungay!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tmp_tungay = date("Y-m-d",strtotime($tungay));
				if($str_conditions!="") $str_conditions .= " AND " ;
				$str_conditions .= " (start_date >= '$tmp_tungay')  ";

			}
		}
		//kiem tra co dieu kien tungay
		if(isset($_POST["denngay"]))
		{
			$denngay = $_POST["denngay"];
			if($denngay!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tmp_denngay = date("Y-m-d",strtotime($denngay));

				if($str_conditions!="")$str_conditions .= " AND " ;
				$str_conditions .= " (start_date <= '$tmp_denngay')  ";


			}
		}

		//truy vấn dữ liệu
		$array_du_an = $this->Project->find("all",array("order"=>"id DESC","conditions"=>"$str_conditions"));

		//XUẤT EXCEL
		$output = "";
		if(isset($_POST["xuat"]))
		{
			$output = $_POST["xuat"];
			$stt = 0;
			if($output == "1")
			{
				$file = 'exel.xls';

				header('Content-Description: File Transfer');
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');

				echo "<table border='1'>
				<tr>
				<th>STT</th>
				<th>Mã Dự án</th>
				<th>Dự án</th>
				<th>Khách hàng</th>
				<th>Ngày bắt đầu</th>
				<th>Ngày kết thúc</th>
				<th>Mô tả</th>
				</tr>";
				foreach($array_du_an as $du_an)
				{
					$stt++;
					$code = $du_an['code'];
					$name = $du_an['name'];
					$customer_name = $du_an['customer_name'];

					$start_date = date("d-m-Y",strtotime($du_an['start_date']));
					if($start_date == "01-01-1970") $start_date = "";

					$finish_date = date("d-m-Y",strtotime($du_an['finish_date']));
					if($finish_date == "01-01-1970") $finish_date = "";

					$desc = $du_an['desc'];
					echo "<tr>
					<td style='text-align: center; vertical-align: middle;'>$stt</td>
					<td style='text-align: center; vertical-align: middle;'>$code</td>
					<td style='text-align: center; vertical-align: middle;'>$name</td>
					<td style='text-align: center; vertical-align: middle;'>$customer_name</td>
					<td style='text-align: center; vertical-align: middle;'>$start_date</td>
					<td style='text-align: center; vertical-align: middle;'>$finish_date</td>
					<td style='text-align: center; vertical-align: middle;'>$desc</td>
					</tr>";
				}
				echo "</table>";
				return;
			}

		}


		$danhsach = $this->View->render('quanly.php',array("array_du_an"=>$array_du_an,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay));
		echo $danhsach;
	}
	function module()
	{

		$this->loadModel("Project","projects");

		$array_du_an = NULL;
		if($this->User->type == "1")
		{
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC"));
		}else
		{
			//lấy quyền truy xuất bảng project user hiện tại
			$this->User->get_permission("Project","projects");
			$str_conditions = $this->User->Project->view_conditions;
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>$str_conditions,"order"=>"id DESC"));
		}

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_du_an != NULL)	array_unshift($array_du_an,array("","..."));
		else $array_du_an = array("","...");

		//lấy ra model dữ liệu
		$this->loadModel("ProjectModule","project_modules");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("ProjectModule","project_modules");

		$str_conditions = "";
		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			$str_conditions  = "(module_name LIKE '%$tim%')";
		}

		$id_project = "";
		$array_module = NULL;

		//lấy id_project từ người dùng submit lên
		if(isset($_POST["data"]))
		{
			$id_project = $_POST["data"]["id_project"];

			//nếu id_project có giá trị thì đưa vào câu điều kiện
			if($id_project != "")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (id_project = $id_project)";
			}
		}

		$array_module = $this->ProjectModule->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		//đưa $array_du_an, $array_module, $tim, $id_project qua view
		//đưa array_du_an qua view để đưa vào selectbox
		//đưa array_module qua view để đưa vào table danh sách module
		//đưa $tim qua view để đưa gía trị của $tim vào input
		//đưa id_project để nhớ lại giá trị người dùng
		$danhsach = $this->View->render('danhsach_module.php',array("array_module"=>$array_module,"tim"=>$tim,"array_du_an"=>$array_du_an,"id_project"=>$id_project));
		echo $danhsach;
	}
	function add_module($tmp_id = "")
	{

		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("ProjectModule",$table_prefix."project_modules");
		$this->loadModel("Project",$table_prefix."projects");

		$array_du_an = NULL;
		if($this->User->type == "1")
		{
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Project","projects");
			$str_conditions = $this->User->Project->view_conditions;
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>$str_conditions));
		}

		$array_sua = NULL;
		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->ProjectModule->find("all",array("conditions"=>"id = $tmp_id"));
		}

		//kiểm tra có duex liệu từ ng` dùng
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_module = $_POST["data"]["project_module"];
			$array_module["created_username"] = $this->User->username;
			$array_module["id_created_user"] = $this->User->id;

			//luu du lieu vao database
			$this->ProjectModule->save($array_module);

			//chuyen ve lai trang danh sách
			$this->redirect("/project/module.html");

			return;
		}
		$them_module = $this->View->render('nhap_module.php',array("array_sua"=>$array_sua,"array_du_an"=>$array_du_an));
		echo $them_module;
	}
	function delete_module($tmp_id = '')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("ProjectModule",$table_prefix."project_modules");

		$this->ProjectModule->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/project/module.html");
	}


	function diary($id = "")
	{

		$id_customer 		 = "";
		$id_project 		  = "";
		$id_created_user     = "";
		$tungay 	 		  = "";
		$denngay 			 = "";
		$request_id = "";
		$tim 				 = "";
		$trangthai 		   = "";
		$id_receive_user = "";


		//lấy id_project từ người dùng submit lên
		if(isset($_GET["data"]))
		{
			$id_project 		 = $_GET["data"]["id_project"];
			$id_customer 		= $_GET["data"]["id_customer"];
			$id_created_user 	= $_GET["data"]["id_created_user"];
			$id_receive_user = $_GET["data"]["id_receive_user"];
			$tungay 	 = $_GET["data"]["tungay"];
			$denngay 	= $_GET["data"]["denngay"];
			$request_id = $_GET["data"]["request_id"];
			$trangthai  = $_GET["data"]["trangthai"];

			$tim 		= $_GET["data"]["tim"];
		}

		$this->loadModel("Customer","customers");

		$array_khachhang = NULL;
		$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));



		if($array_khachhang != NULL)	array_unshift($array_khachhang,array("","..."));
		else $array_khachhang = array("","...");

		$str_cond_project = "";
		if($id_customer!="") $str_cond_project = " id_customer = '$id_customer' ";
		$this->loadModel("Project","projects");

		$array_du_an = NULL;
		$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC","conditions"=>$str_cond_project));
		if($array_du_an != NULL)	array_unshift($array_du_an,array("","..."));
		else $array_du_an = array("","...");
		/*if($this->User->type == "1")
		{
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Project","projects");
			$str_conditions = $this->User->Project->view_conditions;
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>$str_conditions,"order"=>"id DESC"));
		}
		*/
		$this->loadModel("User2","users");

		$array_nguoinhap = NULL;
		if($this->User->type == "1")
		{
			$array_nguoinhap = $this->User2->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC","conditions"=>"`status` = '1' AND `type` IN (0,1)"));
		}else
		{
			$this->User->get_permission("User2","users");
			$str_conditions_nguoinhap = $this->User->User2->view_conditions;
			$array_nguoinhap = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"($str_conditions_nguoinhap) AND (`status` = '1') AND (`type` IN (0,1))","order"=>"fullname ASC"));
		}

		if($array_nguoinhap != NULL)	array_unshift($array_nguoinhap,array("","..."));
		else $array_nguoinhap = array("","...");

		//lấy ra model dữ liệu
		$this->loadModel("ProjectDiary","project_diarys");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("ProjectDiary","project_diarys");

		$str_conditions = "";
		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm



		if($id_customer != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`id_customer` = '$id_customer')";
		}

		//nếu id_project có giá trị thì đưa vào câu điều kiện
		if($id_project != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`id_project` = $id_project)";
		}


		if($id_created_user != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`id_created_user` = $id_created_user)";
		}

		if($tungay != "")
		{
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (`created` >= '$dieukien_tungay')";
			}
		}

		if($denngay != "" )
		{
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (`created` <= '$dieukien_denngay')";
			}
		}

		if($request_id != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`request_id` LIKE '%$request_id%')";
		}


		if($trangthai != "" && $trangthai != "all")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`status` = '$trangthai')";
		}

		if($tim != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions  .= " (`module_name` LIKE '%$tim%' OR `customer_name` LIKE '%$tim%' OR `title` LIKE '%$tim%')";
		}


		$str_condition_project_diary = $this->User->ProjectDiary->view_conditions;
		if($this->User->type != "1")
		{
			if($str_condition_project_diary != "")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " ($str_condition_project_diary)";
			}
		}
		//echo $str_conditions." - dk";
		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");


		$array_diary = NULL;
		$array_diary = $this->ProjectDiary->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		//echo "str_conditions: ".$str_conditions;
		$output = "";
		if(isset($_POST["xuat"]))
		{
			$output = $_POST["xuat"];
			$stt = 0;
			if($output == "1")
			{
				$file = 'exel.xls';


				header('Content-Description: File Transfer');
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');

				echo "<table border='1'>
				<tr>
				<th>STT</th>
				<th>Chức năng</th>
				<th>Tên công việc</th>
				<th>Mô tả</th>
				<th>Người yêu cầu</th>
				<th>Ngày yêu cầu</th>
				<th>Tính chất yêu cầu</th>
				<th>Trạng thái</th>
				</tr>";
				foreach($array_diary as $diary)
				{
					$stt++;
					$module_name = $diary['module_name'];
					$title = $diary['title'];
					$des = $diary['des'];
					$status = $diary['status'];
					$customer_name = $diary['customer_name'];
					$issue_date = date("d-m-Y",strtotime($diary['issue_date']));

					if($status == "0") $status = "Chưa Hoàn Thành";
					else $status = "Hoàn Thành";
					echo "<tr>
					<td style='text-align: center; vertical-align: middle;'>$stt</td>
					<td style='text-align: center; vertical-align: middle;'>$module_name</td>
					<td style='text-align: left'>$title</td>
					<td style='text-align: left'>$des</td>
					<td style='text-align: center; vertical-align: middle;'>$customer_name</td>
					<td style='text-align: center; vertical-align: middle;'>$issue_date</td>
					<td></td>
					<td style='text-align: center; vertical-align: middle;'>$status</td>
					</tr>";
				}
				echo "</table>";
				return;
			}

		}

		$array_param = array(
										"array_diary"=>$array_diary,
										"tim"=>$tim,"array_du_an"=>$array_du_an,
										"id_project"=>$id_project,
										"trangthai"=>$trangthai,
										"array_khachhang"=>$array_khachhang,
										"tungay"=>$tungay,
										"denngay"=>$denngay,
										"id_customer"=>$id_customer,
										"id_created_user"=>$id_created_user,
										"array_nguoinhap"=>$array_nguoinhap,
										"request_id"=>$request_id,
										"id_receive_user"=>$id_receive_user
									);

		$danhsach = $this->View->render('danhsach_nhatky.php',$array_param);
		echo $danhsach;
	}


	function my_task()
	{

		$id_customer 		 = "";
		$id_project 		  = "";
		$id_created_user     = "";
		$tungay 	 		  = "";
		$denngay 			 = "";
		$tim 				 = "";
		$trangthai 		   = "";


		//lấy id_project từ người dùng submit lên
		if(isset($_GET["data"]))
		{
			$id_project 		 = $_GET["data"]["id_project"];
			$id_customer 		= $_GET["data"]["id_customer"];
			$id_created_user 	= $_GET["data"]["id_created_user"];

			$tungay 	 = $_GET["data"]["tungay"];
			$denngay 	= $_GET["data"]["denngay"];
			$trangthai  = $_GET["data"]["trangthai"];

			$tim 		= $_GET["data"]["tim"];
		}

		$this->loadModel("Customer","customers");

		$array_khachhang = NULL;
		$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));

		/*if($this->User->type == "1")
		{
			$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		}else
		{
			$this->User->get_permission("Customer","customers");
			$str_conditions_khachhang = $this->User->Customer->view_conditions;
			$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions_khachhang,"order"=>"fullname ASC"));
		}*/

		if($array_khachhang != NULL)	array_unshift($array_khachhang,array("","..."));
		else $array_khachhang = array("","...");

		$str_cond_project = "";
		if($id_customer!="") $str_cond_project = " id_customer = '$id_customer' ";
		$this->loadModel("Project","projects");

		$array_du_an = NULL;
		$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC","conditions"=>$str_cond_project));
		if($array_du_an != NULL)	array_unshift($array_du_an,array("","..."));
		else $array_du_an = array("","...");
		/*if($this->User->type == "1")
		{
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Project","projects");
			$str_conditions = $this->User->Project->view_conditions;
			$array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>$str_conditions,"order"=>"id DESC"));
		}
		*/
		$this->loadModel("User2","users");

		$array_nguoinhap = NULL;
		if($this->User->type == "1")
		{
			$array_nguoinhap = $this->User2->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC","conditions"=>"`status` = '1' AND `type` IN (0,1)"));
		}else
		{
			$this->User->get_permission("User2","users");
			$str_conditions_nguoinhap = $this->User->User2->view_conditions;
			$array_nguoinhap = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"($str_conditions_nguoinhap) AND (`status` = '1') AND (`type` IN (0,1))","order"=>"fullname ASC"));
		}

		if($array_nguoinhap != NULL)	array_unshift($array_nguoinhap,array("","..."));
		else $array_nguoinhap = array("","...");

		//lấy ra model dữ liệu
		$this->loadModel("ProjectDiary","project_diarys");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("ProjectDiary","project_diarys");

		$str_conditions = "";
		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm



		if($id_customer != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`id_customer` = '$id_customer')";
		}

		//nếu id_project có giá trị thì đưa vào câu điều kiện
		if($id_project != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (id_project = $id_project)";
		}



		if($id_created_user != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`id_created_user` = $id_created_user)";
		}

		if($tungay != "")
		{
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (`issue_date` >= '$dieukien_tungay')";
			}
		}

		if($denngay != "" )
		{
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (`issue_date` <= '$dieukien_denngay')";
			}
		}

		if($trangthai != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions .= " (`status` = '$trangthai')";
		}

		if($tim != "")
		{
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions  .= " (`module_name` LIKE '%$tim%' OR `customer_name` LIKE '%$tim%' OR `title` LIKE '%$tim%')";
		}


		$str_condition_project_diary = $this->User->ProjectDiary->view_conditions;
		if($this->User->type != "1")
		{
			if($str_condition_project_diary != "")
			{
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " ($str_condition_project_diary)";
			}
		}
		//echo $str_conditions." - dk";
		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");


		$array_diary = NULL;
		$array_diary = $this->ProjectDiary->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		//echo "str_conditions: ".$str_conditions;
		$output = "";
		if(isset($_POST["xuat"]))
		{
			$output = $_POST["xuat"];
			$stt = 0;
			if($output == "1")
			{
				$file = 'exel.xls';


				header('Content-Description: File Transfer');
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');

				echo "<table border='1'>
				<tr>
				<th>STT</th>
				<th>Chức năng</th>
				<th>Tên công việc</th>
				<th>Mô tả</th>
				<th>Người yêu cầu</th>
				<th>Ngày yêu cầu</th>
				<th>Tính chất yêu cầu</th>
				<th>Trạng thái</th>
				</tr>";
				foreach($array_diary as $diary)
				{
					$stt++;
					$module_name = $diary['module_name'];
					$title = $diary['title'];
					$des = $diary['des'];
					$status = $diary['status'];
					$customer_name = $diary['customer_name'];
					$issue_date = date("d-m-Y",strtotime($diary['issue_date']));

					if($status == "0") $status = "Chưa Hoàn Thành";
					else $status = "Hoàn Thành";
					echo "<tr>
					<td style='text-align: center; vertical-align: middle;'>$stt</td>
					<td style='text-align: center; vertical-align: middle;'>$module_name</td>
					<td style='text-align: left'>$title</td>
					<td style='text-align: left'>$des</td>
					<td style='text-align: center; vertical-align: middle;'>$customer_name</td>
					<td style='text-align: center; vertical-align: middle;'>$issue_date</td>
					<td></td>
					<td style='text-align: center; vertical-align: middle;'>$status</td>
					</tr>";
				}
				echo "</table>";
				return;
			}

		}

		$danhsach = $this->View->render('danhsach_nhatky.php',array("array_diary"=>$array_diary,"tim"=>$tim,"array_du_an"=>$array_du_an,"id_project"=>$id_project,"trangthai"=>$trangthai,"array_khachhang"=>$array_khachhang,"tungay"=>$tungay,"denngay"=>$denngay,"id_customer"=>$id_customer,"id_created_user"=>$id_created_user,"array_nguoinhap"=>$array_nguoinhap));
		echo $danhsach;
	}

	function add_diary($tmp_id = "")
	{

		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("ProjectDiary",$table_prefix."project_diarys");
		$this->loadModel("Project",$table_prefix."projects");
		$this->loadModel("ProjectModule",$table_prefix."project_modules");
		$this->loadModel("CustomerUser","users");
		$this->loadModel("Customer",$table_prefix."customers");

		$array_sua = NULL;
		$trangthai_luu = "";

		//nếu ko có dũ liệu từ form kiểm tra có id không
		if ($tmp_id!="")
		{
			$array_sua = $this->ProjectDiary->find("all",array("conditions"=>"id = '$tmp_id'"));

			//nếu có dữ liệu
			if(isset($array_sua[0])) $array_sua = $array_sua[0];
		}

		//kiểm tra có dữ liệu nhật ký submit từ form để lưu vào bảnng project_diarys
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_sua = $_POST["data"]["project_diary"];
			$array_sua["start_date"] = date("Y-m-d",strtotime($array_sua["start_date"]));
			$array_sua["finish_date_expected"] = date("Y-m-d",strtotime($array_sua["finish_date_expected"]));
			$array_sua["finish_date"] = date("Y-m-d",strtotime($array_sua["finish_date"]));
			$array_sua["date_request"] = date("Y-m-d",strtotime($array_sua["date_request"]));

			if($array_sua["id"] == "") $array_sua["status"] = "0";
			//$array_sua["title"] = str_replace("\"","'",$array_sua["title"]);

			$trangthai_luu = $array_sua["trangthai_luu"];
			if($array_sua["trangthai_luu"] == "1")
			{
				if($array_sua["id"] == "")
				{
					$array_sua["created_username"] = $this->User->username;
					$array_sua["id_created_user"] = $this->User->id;
					$array_sua["created_fullname"] = $this->User->fullname;

				}else
				{
					$array_sua["edit_username"] = $this->User->username;
					$array_sua["id_edit_user"] = $this->User->id;
					$array_sua["edit_fullname"] = $this->User->fullname;
				}

				//lấy thông tin user từ id_user_receive
				$id_user_receive = $array_sua["id_user_receive"];
				$array_user_receive = $this->CustomerUser->find("all",array("conditions"=>"id='$id_user_receive'"));
				if($array_user_receive)
				{
					$array_sua["username_receive"] = $array_user_receive[0]["username"];
					$array_sua["user_receive_fullname"] = $array_user_receive[0]["fullname"];
				}

				//luu du lieu vao database
				$this->ProjectDiary->save($array_sua);

				//chuyen ve lai trang danh sách
				$this->redirect("/project/diary.html");

				return;
			}
		}
		//kết thúc phần lưu dữ liệu vào bảng project_diarys


		$id_customer = "";
		if(isset($array_sua["id_customer"])) $id_customer = $array_sua["id_customer"];

	///////////////////////////////////////////////////
	//1. lấy dữ liệu khách hàng
	///////////////////////////////////////////////////
		$array_khachhang = NULL;
		if($this->User->type == "1")
		{
			$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Customer","customers");
			$str_conditions_khach = $this->User->Customer->view_conditions;
			$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions_khach,"order"=>"id DESC"));
		}

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");

		if($array_khachhang != NULL)	array_unshift($array_khachhang,array("","..."));
		else $array_khachhang = array(0,array(""=>"..."));
	///////////////////////////////////////////////////
	//kết thúc lấy dữ liệu khách hàng
	//////////////////////////////////////////////////////

	////////////////////////////////////////////////////
	//2. lấy dữ liệu dự án
	//////////////////////////////////////////////////
		$array_projects = NULL;
		if($id_customer != "")
		{
			if($this->User->type == "1")
			{
				$array_projects = $this->Project->find("all",array("fields"=>"id,name","order"=>"id DESC","conditions"=>"`id_customer` = '$id_customer'"));
			}
			else
			{
				//lấy điều kiện dự án theo phân quyền
				$this->User->get_permission("Project","projects");
				$str_conditions = $this->User->Project->view_conditions;
				$array_projects = $this->Project->find("all",array("fields"=>"id,name","conditions"=>"($str_conditions) AND `id_customer` = $id_customer","order"=>"id DESC"));
			}
		}

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_projects != NULL)	array_unshift($array_projects,array("","..."));
		else $array_projects = array("0",array("","..."));

	//////////////////////////////////////////
	//kết thúc lấy dữ liệu dự án
	///////////////////////////////////////////

	//////////////////////////////////////////////////////
	//3. lấy các module của dự án
	/////////////////////////////////////////////////////
		$array_module = NULL;
		if(isset($array_sua["id_project"]))
		{
			$id_project = $array_sua["id_project"];
			$array_module = $this->ProjectModule->find("all",array("fields"=>"id,module_name","conditions"=>"`id_project` = '$id_project'","order"=>"id DESC"));

		}
		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_module != NULL)	array_unshift($array_module,array("","..."));
		else $array_module = array("0",array(""=>"..."));

	//////////////////////////////////////////////
	// Kết thúc lấy các module của dự án
	////////////////////////////////////////////////

	//////////////////////////////////////////////////////
	//4. lấy dữ liệu người yêu cầu dự án, người yêu cầu là danh sách người liên lạc của khách hàng
	/////////////////////////////////////////////////////
		$array_user_request = $this->CustomerUser->find("all",array("fields"=>"id,fullname","conditions"=>"(status = 1) AND (`id_customer` = '$id_customer') "));

		//nếu có dữ liệu thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_user_request != NULL)	array_unshift($array_user_request,array("","..."));
		else $array_user_request = array("","...");

	//////////////////////////////////////////////
	// Kết thúc lấy danh sách người liên lạc
	////////////////////////////////////////////////


		$array_nguoi_thuchien = $this->CustomerUser->find("all",array("fields"=>"id,fullname","conditions"=>"status=1 AND type=0"));
		if($array_nguoi_thuchien) $array_nguoi_thuchien = array(""=>array("id"=>"","fullname"=>"...")) + $array_nguoi_thuchien;
		else $array_nguoi_thuchien = array(""=>array("id"=>"","fullname"=>"..."));

		$them_diary = $this->View->render('nhap_nhatky.php',array("array_sua"=>$array_sua,"array_projects"=>$array_projects,"array_module"=>$array_module,"array_user_request"=>$array_user_request,"trangthai_luu"=>$trangthai_luu,"array_khachhang"=>$array_khachhang,"array_nguoi_thuchien"=>$array_nguoi_thuchien));
		echo $them_diary;
	}
	function delete_diary($tmp_id = '')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("ProjectDiary",$table_prefix."project_diarys");

		$this->ProjectDiary->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/project/diary.html");
	}
	function save_task($tmp_id = '')
	{
		$this->loadModel("ProjectDiary","project_diarys");
		$this->loadModel("Project","projects");
		$this->loadModel("Task","tasks");
		$this->loadModel("CustomerUser","users");
		$this->loadModel("User2","users");

		$name = $id_project = $project_name = $id_module = $module_name = $des = $id_customer = $customer_name = $img = $id_user_approval = $user_name_approval = "";

		$array_diary = $this->ProjectDiary->find("all",array("conditions"=>"`id` = $tmp_id"));
		$img = $array_diary[0]["img"];

		$id_nguoilienlac = "";
		$id_nguoilienlac = $array_diary[0]["id_customer"];
		$array_customer_user = NULL;
		$array_customer_user = $this->CustomerUser->find("all",array("conditions"=>"(`id` = '$id_nguoilienlac') AND (`status` = '1') AND (`type` = '2')"));
		$id_customer = $array_customer_user[0]["id_customer"];
		$customer_name = $array_customer_user[0]["customer_name"];
		$name = $array_diary[0]["title"];
		$id_project = $array_diary[0]["id_project"];
		$project_name = $array_diary[0]["project_name"];
		$id_module = $array_diary[0]["id_module"];
		$module_name = $array_diary[0]["module_name"];
		$des = $array_diary[0]["des"];

		$array_user = NULL;
		if($this->User->type == "1")
		{
			$array_user = $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"(`status` = '1') AND ((`type` = '0') OR (`type` = '1'))"));
			$array_nguoiduyet = $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"(`status` = '1') AND ((`type` = '0') OR (`type` = '1'))"));
		}else
		{
			$this->User->get_permission("User2","users");
			$str_conditions = $this->User->User2->view_conditions;
			$array_user = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"($str_conditions) AND (`status` = '1') AND ((`type` = '0') OR (`type` = '1'))","order"=>"id DESC"));
			$array_nguoiduyet = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"($str_conditions) AND (`status` = '1') AND ((`type` = '0') OR (`type` = '1'))","order"=>"id DESC"));
		}

		if($array_nguoiduyet != NULL)	array_unshift($array_nguoiduyet,array("","..."));
		else $array_nguoiduyet = array("","...");

		//kiểm tra có dữ liệu từ ng` dùng để lưu công việc
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_task = $_POST["data"]["project_diary"];

			//lấy id người kiểm tra và tên người kiểm tra
			$id_user_approval = $array_task["id_user_approval"];
			$user_name_approval = $array_task["user_name_approval"];

			//lưu công việc cho người được giao
			$array_task["start_date_expected"] = date("Y-m-d",strtotime($array_task["start_date_expected"]));
			$array_task["finish_date_expected"] = date("Y-m-d",strtotime($array_task["finish_date_expected"]));
			$array_task["created_username"] = $this->User->fullname;
			$array_task["id_created_user"] = $this->User->id;
			$array_task["id_customer"] = $id_customer;
			$array_task["customer_name"] = $customer_name;
			$array_task["name"] = $name;
			$array_task["id_project"] = $id_project;
			$array_task["project_name"] = $project_name;
			$array_task["id_module"] = $id_module;
			$array_task["module_name"] = $module_name;
			$array_task["des"] = $des;
			$array_task["img"] = $img;
			$array_task["id_diary"] = $tmp_id;
			$array_task["diary_name"] = $name;
			$array_task["status"] = "0";
			$array_task["approval_status"] = "0";
			$array_task["check"] = "0";
			$array_task["check_id_task"] = "0";
			$array_task["checked_status"] = "0";

			//luu công việc đã giao vao database
			$this->Task->save($array_task);

			if($id_user_approval != "")
			{
				//lấy id_task mới nhất
				$last_id_task = $this->Task->get_value(array("fields"=>"MAX(id)"));

				//lưu công việc cho người kiểm tra
				$array_congviec_nguoikiemtra = NULL;
				$array_congviec_nguoikiemtra["name"] = "Kiểm tra công việc ".$name;
				$array_congviec_nguoikiemtra["start_date_expected"] = date("Y-m-d",strtotime($array_task["start_date_kiemtra"]));
				$array_congviec_nguoikiemtra["finish_date_expected"] = date("Y-m-d",strtotime($array_task["finish_date_kiemtra"]));
				$array_congviec_nguoikiemtra["created_username"] = $this->User->fullname;
				$array_congviec_nguoikiemtra["id_created_user"] = $this->User->id;
				$array_congviec_nguoikiemtra["id_customer"] = $id_customer;
				$array_congviec_nguoikiemtra["customer_name"] = $customer_name;
				$array_congviec_nguoikiemtra["id_project"] = $id_project;
				$array_congviec_nguoikiemtra["project_name"] = $project_name;
				$array_congviec_nguoikiemtra["id_module"] = $id_module;
				$array_congviec_nguoikiemtra["module_name"] = $module_name;
				$array_congviec_nguoikiemtra["des"] = $des;
				$array_congviec_nguoikiemtra["id_diary"] = $tmp_id;
				$array_congviec_nguoikiemtra["diary_name"] = $name;
				$array_congviec_nguoikiemtra["status"] = "0";
				$array_congviec_nguoikiemtra["id_user_receive"] = $id_user_approval;
				$array_congviec_nguoikiemtra["username_receive"] = $user_name_approval;
				$array_congviec_nguoikiemtra["check"] = "1";
				$array_congviec_nguoikiemtra["check_id_task"] = $last_id_task;
				$array_congviec_nguoikiemtra["checked_status"] = "0";
				$array_congviec_nguoikiemtra["approval_status"] = "0";
				$array_congviec_nguoikiemtra["id_user_approval"] = $id_user_approval;
				$array_congviec_nguoikiemtra["user_name_approval"] = $user_name_approval;

				//luu du lieu vao database
				$this->Task->save($array_congviec_nguoikiemtra);
			}

			$array_update_diary["status"] = "1";
			$array_update_diary["id"] = $tmp_id;
			$this->ProjectDiary->save($array_update_diary);

			//lấy giá trị id_user_receive và id_created_user
			$array_user_email = NULL;
			$id_user_receive = $id_created_user = $email_receive = $email_approval = $email_from = "";
			$id_user_receive = $array_task["id_user_receive"];
			$id_created_user = $array_task["id_created_user"];
			$fullname_sender = $this->User->fullname;

			$array_task["start_date_expected"] = date("d-m-Y",strtotime($array_task["start_date_expected"]));
			$array_task["finish_date_expected"] = date("d-m-Y",strtotime($array_task["finish_date_expected"]));
			if($array_task["start_date_expected"] == "01-01-1970") $array_task["start_date_expected"] = "";
			if($array_task["finish_date_expected"] == "01-01-1970") $array_task["finish_date_expected"] = "";

			$this->loadLib("Email");
			$email_from = $this->get_config("system_email");
			if($email_from == "system_email") $email_from = "no_reply@khietlong.vn";

			//lấy email từ người nhận và người giao
			$email_receive = $this->User2->get_value(array("fields"=>"email","conditions"=>"`id` = '$id_user_receive'"));

			if($email_receive != "")
			{

				//gui email, nếu người gửi và người nhận khác nhau thì gửi email thông báo
				if($id_user_receive != $id_created_user)
				{
					$content = "Xin Chào ".$array_task["username_receive"].", <br>";
					$content .= "Bạn có công việc mới <br>";
					$content .= "Tên công việc: ".$array_task["name"]."<br>";
					$content .= "Ngày giao: ".date("H:i d-m-Y")."<br>";
					$content .= "Người giao việc: ".$fullname_sender."<br>";
					$content .= "Ngày bắt đầu dự kiến: ".$array_task["start_date_expected"]."<br>";
					$content .= "Ngày kết thúc dự kiến: ".$array_task["finish_date_expected"]."<br>";
					$title = "Hệ Thống Điều Hành Khiết Long - Nhận Công Việc".date("H:i:s d-m-Y");
					$array_content 	=	array("title"=>$title,"content"=>$content);
					$array_from 	=	array("email"=>$email_from,"name"=>"Hệ Thống Điều Hành Khiết Long");
					$array_to 		=	array(
						array("email"=>$email_receive,"name"=>$array_task["username_receive"]),
					);

					$this->Email->send($array_content,$array_from,$array_to);
				}
			}
			$email_approval = $this->User2->get_value(array("fields"=>"email","conditions"=>"`id` = '$id_user_approval'"));

			if($email_approval != "")
			{
				if($id_created_user != $id_user_approval)
				{
					$content2 = "Xin Chào ".$array_task["user_name_approval"].", <br>";
					$content2 .= "Bạn có công việc mới chờ kiểm tra<br>";
					$content2 .= "Tên công việc: ".$array_congviec_nguoikiemtra["name"]."<br>";
					$content2 .= "Ngày giao: ".date("H:i:s d-m-Y")."<br>";
					$content2 .= "Người thực hiện công việc: ".$array_task["username_receive"]."<br>";
					$content2 .= "Ngày bắt đầu dự kiến: ".$array_task["start_date_expected"]."<br>";
					$content2 .= "Ngày kết thúc dự kiến: ".$array_task["finish_date_expected"]."<br>";
					$title = "Hệ Thống Điều Hành Khiết Long - Kiểm Tra Công Việc".date("H:i:s d-m-Y");
					$array_content 	=	array("title"=>$title,"content"=>$content2);
					$array_from	 =	array("email"=>$email_from,"name"=>"Hệ Thống Điều Hành Khiết Long");
					$array_to		=	array(
						array("email"=>$email_approval,"name"=>$array_task["user_name_approval"]),
					);

					$this->Email->send($array_content,$array_from,$array_to);
				}
			}

			//chuyen ve lai trang xem thu
			$this->redirect("/task/index.html");

			return;
		}

		$giaoviec = $this->View->render('giaoviec.php',array("tmp_id"=>$tmp_id,"array_user"=>$array_user,"array_nguoiduyet"=>$array_nguoiduyet,"name"=>$name,"des"=>$des));
		echo $giaoviec;
	}
	function detail($id='')
	{
		$this->loadModel("Project","projects");

		$array_sua = $this->Project->find('all',array("conditions"=>"id = '$id'"));

		echo $this->View->render('detail.php',array("array_sua"=>$array_sua));

	}

	function milestone()
	{
        /**
         * GET AJAX
         */
        if (isset($_GET['ajax']))
        {
            /**
             * AJAX SAVE
             */
            if ($_GET['ajax'] == "save")
            {
            	$arr_milestone = $_GET['data'];
            	if ($arr_milestone['start'] == "") $arr_milestone['start'] = NULL;
            	else $arr_milestone['start'] = date("Y-m-d",strtotime($arr_milestone['start']));

            	if ($arr_milestone['finish'] == "") $arr_milestone['finish'] = NULL;
            	else $arr_milestone['finish'] = date("Y-m-d",strtotime($arr_milestone['finish']));

            	if ($arr_milestone['start_actual'] == "") $arr_milestone['start_actual'] = NULL;
            	else $arr_milestone['start_actual'] = date("Y-m-d",strtotime($arr_milestone['start_actual']));

            	if ($arr_milestone['finish_actual'] == "") $arr_milestone['finish_actual'] = NULL;
            	else $arr_milestone['finish_actual'] = date("Y-m-d",strtotime($arr_milestone['finish_actual']));

                //tìm tên dự án
            	$id_project = $arr_milestone['id_project'];
            	$this->loadModel("Project","projects");
            	$arr_project = $this->Project->find("all",array("conditions"=>"id = '$id_project'","limit"=>1));
            	if ($arr_project != NULL)
            	{
            		$arr_milestone['name_project'] = $arr_project[0]['name'];
            	}

            	$arr_milestone['id_user_created'] = $this->User->id;
            	$arr_milestone['user_created'] = $this->User->fullname;

            	$this->loadModel("Milestone","project_milestones");
            	$this->Milestone->save($arr_milestone);
            	return;
            }

            /**
             * AJAX VIEW
             */
            if ($_GET['ajax'] == "view")
            {

            	$dieukien="id IS NOT NULL";
            	if (isset($_GET['id_project']))
            	{
            		if ($_GET['id_project'] != "")
            		{
            			$id_project = $_GET['id_project'];
            			$dieukien .= " AND `id_project` = '$id_project'";
            		}
            		if ($_GET['tungay'] != "")
            		{
            			$tungay = date("Y-m-d",strtotime($_GET['tungay']));
            			$dieukien .= " AND `start` >= '$tungay'";
            		}
            		if ($_GET['denngay'] != "")
            		{
            			$denngay = date("Y-m-d",strtotime($_GET['denngay']));
            			$dieukien .= " AND `finish` <= '$denngay'";
            		}
            	}
            	$this->loadModel("Milestone","project_milestones");
            	$arr_milestone = $this->Milestone->find("all",array("conditions"=>"$dieukien","order" => "ID ASC"));

            	echo $this->View->render('milestone_ajax_view.php',array("arr_milestone" => $arr_milestone),false);
            	return;
            }

            /**
             * AJAX DELETE
             */
            if ($_GET['ajax'] == "delete")
            {
            	$id_milestone = $_GET['id_milestone'];

            	$this->loadModel("Milestone","project_milestones");
            	$this->Milestone->delete($id_milestone);
            	return;
            }
        }

        /**
         * Load Model
         */
        $this->loadModel("Milestone","project_milestones");
        $this->loadModel("Project","projects");
        /**
         * VIEW
         */
        $arr_milestone = $this->Milestone->find("all",array("order" => "ID ASC"));
        $arr_project   = $this->Project->find("all",array("fields"  => "id,concat(name, ' - ' ,customer_name) as name"));

        echo $this->View->render('milestone.php',array(
        	"arr_milestone" => $arr_milestone,
        	"arr_project"   => $arr_project));
    }



    function quantitative($id_project_diary = "",$id_project_quantitative = "")
    {
    	$this->loadModel("User2","users");
    	$this->loadModel("ProjectQuantitative","project_quantitatives");
    	$this->loadModel("ProjectDiary","project_diarys");


		//********************************************
		//BEGIN: DELETE Project Quantitative
    	if(isset($_GET["act"]))
    	{
			//lấy thông tin định lượng từ form
    		$act = $_GET["act"];
    		if($act=="del") $this->ProjectQuantitative->delete($id_project_quantitative);

    	}
		//END: DELETE Project Quantitative
		//********************************************

		//********************************************
		//BEGIN: SAVE Project Quantitative
    	if(isset($_POST["data"]))
    	{
			//lấy thông tin định lượng từ form
    		$data = $_POST["data"];

			//lấy id_user, fullname của user hiện tại
    		$data["id_user_created"] = $this->User->id;
    		$data["user_fullname_created"] = $this->User->fullname;


    		$this->ProjectQuantitative->save($data);

    	}
		//END: SAVE Project Quantitative
		//********************************************



		//lấy tiêu đề của task name hiện tại
    	$task_name = $this->ProjectDiary->get_value(array("fields"=>"title","conditions"=>"id='$id_project_diary'"));

		//lấy tất cả thông tin định lượng của task hiện tại
    	$array_quantitative = $this->ProjectQuantitative->find("all",array("conditions"=>"id_task='$id_project_diary'"));


		//lấy danh sách người tham gia định lượng, là những người đang đi làm(status=1), và nhân viên của công ty type = 2
    	$array_user = $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"`status` = '1' AND `type` = '0'"));

    	$array_edit_quantitative = NULL;
    	if($id_project_quantitative != "") $array_edit_quantitative = $this->ProjectQuantitative->find("all",array("conditions"=>"id='$id_project_quantitative'"));

    	$array_param_in_view = array(
    		"array_user" => $array_user,
    		"id_project_diary" => $id_project_diary,
    		"task_name" => $task_name,
    		"array_quantitative" => $array_quantitative,
    		"array_edit_quantitative" => $array_edit_quantitative
    	);
    	echo $this->View->render('quantitative_project.php',$array_param_in_view);

    }
    function import_diary()
    {
    	$this->loadmodel('Project_diary',"project_diarys");
    	$this->loadmodel('Customer');
    	$this->loadmodel('Project');
    	$this->loadmodel('User2','users');

    	$id_customer = "";
    	$id_project = "";

		// kiểm tra có tồn tại giá trị $_GET["file"] là tên file submit từ form
    	if(isset($_GET["file"]))
    	{

			// gán giá trị tên file cho $file;
    		$file = $_GET["file"];


			$id_customer = $_GET["id_customer"];
			$id_project = $_GET["id_project"];


			if($file != "")
			{
				//tạo đối tượng đọc excel
	    		$this->loadLib("Excel","excel");

				//mở file excel
	    		$excel_file = $this->root_folder."files/".$this->Company->upload_folder."/".$file;
	    		$data = $this->Excel->open($excel_file);

				// lay so hang cua sheet
	    		$rowsnum = $data->rowcount($sheet_index=0);

				// lay so cot cua sheet
	    		$colsnum =  $data->colcount($sheet_index=0);






				// duyệt từng dòng của file excel
	    		for ($i=2;$i<=$rowsnum;$i++)
	    		{

	    			$array_luu = NULL;
					$array_luu["id_customer"] = $id_customer;
					$array_luu["id_project"] 	= $id_project;

					// lấy tên khách hàng theo id_project để lưu vào bảng project_diarys
					$customer = $this->Customer->get_value(array("fields"=>"fullname","conditions"=>"`id` = '$id_customer'"));

					// lấy tên dự án theo id_customer để lưu vào bảng project_diarys
					$project = $this->Project->get_value(array("fields"=>"name","conditions"=>"`id` = '$id_project'"));
					$project_code = $this->Project->get_value(array("fields"=>"code","conditions"=>"`id` = '$id_project'"));

	    			$array_luu["customer_name"] = $customer;
	    			$array_luu["project_name"] 	= $project;
	    			$array_luu["project_code"] 	= $project_code;

	    			// lấy họ tên người nhập theo người đăng nhập hiện tại
					$array_luu["created_fullname"] 	= $this->User->fullname;

					// lấy id người nhập
					$array_luu["id_created_user"] 	= $this->User->id;

					// lấy username người nhập
					$array_luu["created_username"] 	= $this->User->username;

					$array_luu["status"] 	= '0';

	    			$array_luu["module_name"] 	= $data->val($i,2);
	    			$array_luu["function_name"] = $data->val($i,3);

	    			$request_id	= $data->val($i,4);
	    			$$array_luu["request_id"] = $request_id;

	    			$array_luu["request_issue"] = $data->val($i,5);
	    			//$array_luu["request_content"] 	= $data->val($i,6);
					$array_luu["title"] 	= $data->val($i,6);

	    			//lấy họ tên người yêu cầu
	    			$user_request_fullname = $data->val($i,7);
	    			$user_request_fullname = trim($user_request_fullname);
	    			$array_luu["user_request_fullname"] = $user_request_fullname;

	    			// lấy id_user từ tên người yêu cầu.
	    			$id_user_request = $this->User2->get_value(array("fields"=>"id","conditions"=>"`type` = '2' AND `id_customer`='$id_customer' AND `fullname`='$user_request_fullname'"));

	    			$array_luu["id_user_request"] = $id_user_request;

					//ngày yêu cầu
	    			$date_request = $data->val($i,8);
	    			$array_luu["date_request"] = date("Y-m-d",strtotime($date_request));

					//trạng thái
	    			$reuqest_status = $data->val($i,9);
					if($reuqest_status == "Hoàn thành") $array_luu["status"] = 2;
					else $array_luu["status"] = 0;

	    			//ngày bắt đầu làm
					$start_date = $data->val($i,10);
					$start_date = date("Y-m-d",strtotime($start_date));
					$array_luu["start_date"] = $start_date;

	    			//ngày hoàn thành dự kiến
					$finish_date_expected = $data->val($i,11);
					$finish_date_expected = date("Y-m-d",strtotime($finish_date_expected));
					$array_luu["finish_date_expected"] = $finish_date_expected;

					//người thực hiện
					$user_receive_fullname = $data->val($i,12);
					$array_luu["user_receive_fullname"] = $user_receive_fullname;

	    			// lấy id_user_receive
	    			$id_user_receive = $this->User2->get_value(array("fields"=>"id","conditions"=>"`type`=0 AND `fullname`='$user_receive_fullname'"));
					$array_luu["id_user_receive"] = $id_user_receive;


					//nguyên nhân
					$issue_cause = $data->val($i,13);
					$array_luu["issue_cause"] = $issue_cause;

					//nội dung xử lý
					$solution = $data->val($i,14);
					$array_luu["request_solution"] = $solution;

					//file xử lý
					$impacted_files = $data->val($i,15);
					$array_luu["impacted_files"] = $impacted_files;

					//file xử lý
					$impacted_tables = $data->val($i,16);
					$array_luu["impacted_tables"] = $impacted_tables;


	    			// Nếu mã công việc khác rỗng thì mới lưu vào bảng project_diarys
	    			if($request_id != "")
	    			{

	    				// kiểm tra giá code đã có trong bảng project_diary chưa, nếu chưa thì lưu
						$array_code = $this->Project_diary->find("all", array("fields"=>"id","conditions"=>"`request_id` = '$request_id'"));
	    				if($array_code == NULL) $this->Project_diary->save($array_luu);


	    			} //end if($array_luu["code"] != "")

	    		}//end for ($i=2;$i<=$rowsnum;$i++)
	    	} // end if($file != "")

    	}// end if(isset($_POST["file"]))


    	// lấy tất cả tất cả khách hàng
    	$array_customer = $this->Customer->find("all",array("fields"=>"id,fullname"));
    	$array_customer = array(""=>array("id"=>"","fullname"=>"...")) + $array_customer;

    	// lấy tất cả dự án của khách hàng được chọn
    	$array_project = $this->Project->find("all",array("fields"=>"id,name", "conditions"=>" `id_customer` = '$id_customer'"));

    	$array_param = array(
    						"array_project"=>$array_project,
    						"array_customer"=>$array_customer,
    						"id_customer"=>$id_customer
    					);

    	echo $this->View->render('import_diary_project.php',$array_param);
	}//end function

}
?>
