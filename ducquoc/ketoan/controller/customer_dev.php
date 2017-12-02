<?php
class customer extends Main
{
	function manage()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Customer",$table_prefix."customers");
		$dieukien = "";
		$array_group =  NULL;
		$tim = "";
		$id_group = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			$dieukien = "(fullname LIKE '%$tim%' OR code LIKE '%$tim%' OR email LIKE '%$tim%' OR phone LIKE '%$tim%' OR address LIKE '%$tim%')";
		}
		if(isset($_POST["nhom"]))
		{
			$id_group = $_POST["nhom"];
			if($id_group != "")
			{
				if($dieukien != "") $dieukien .=" AND ";
				$dieukien .= "id_group = '$id_group'";
			}
		}

        /**
         * Đ.A: nếu tồn tại $_GET[relationship]  thì thêm điều kiện tìm relationship
         */
        if (isset($_GET['relationship']))
        {
            $relationship = $_GET['relationship'];
            if($dieukien != "") $dieukien .=" AND ";
            $dieukien .= "relationship = '$relationship'";
        }

		if(isset($this->Company->modules["ducquoc/ketoan"]["customer"]["add_group"]))
		{
			$this->loadModel("CustomerGroup",$table_prefix."customer_groups");
			$array_group = $this->CustomerGroup->find("all",array("fiedls"=>"id,name"));
			if($array_group != NULL)	array_unshift($array_group,array("","Tất cả"));
			else $array_group = array("","Tất cả");
		}
		//truy vấn dữ liệu
		$array_khachhang = $this->Customer->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));

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
							  <th>Mã Khách hàng</th>
							  <th>Khách hàng</th>
							  <th>Loại</th>
							  <th>Email</th>
							  <th>Số điện thoại</th>
							  <th>Địa chỉ</th>
							  <th>Người liên hệ</th>
						  </tr>";
				foreach($array_khachhang as $khachang)
				{
					$stt++;
					$code = $khachang['code'];
					$fullname = $khachang['fullname'];
					$type = $khachang['type'];
					if($type == 0) $type = "Cá nhân";
					else  $type = "Tổ chức";
					$email = $khachang['email'];
					$phone = $khachang['email'];
					$address = $khachang['address'];
					$contact_name = $khachang['contact_name'];

					echo "<tr>
							  <td style='text-align: center; vertical-align: middle;'>$stt</td>
							  <td style='text-align: center; vertical-align: middle;'>$code</td>
							  <td style='text-align: left; vertical-align: middle;'>$fullname</td>
							  <td style='text-align: center; vertical-align: middle;'>$type</td>
							  <td style='text-align: center; vertical-align: middle;'>$email</td>
							  <td style='text-align: center; vertical-align: middle;'>$phone</td>
							  <td style='text-align: center; vertical-align: middle;'>$address</td>
							  <td style='text-align: center; vertical-align: middle;'>$contact_name</td>
						  </tr>";
				}
				echo "</table>";
				return;
			}

		}

		$danhsach = $this->View->render('quanli_kh.php',array("array_khachhang"=>$array_khachhang,"tim"=>$tim,"id_group"=>$id_group,"array_group"=>$array_group));
		echo $danhsach;
	}
	function add($tmp_id = "")
	{
		$array_group = NULL;
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;

		//lấy ra model dữ liệu
		$this->loadModel("Customer",$table_prefix."customers");
		if(isset($this->Company->modules["ducquoc/ketoan"]["customer"]["add_group"]))
		{
			$this->loadModel("CustomerGroup",$table_prefix."customer_groups");
			$array_group = $this->CustomerGroup->find("all",array("fiedls"=>"id,name"));
		}

		$array_sua = NULL;

		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->Customer->find("all",array("conditions"=>"id = $tmp_id"));
		}
		$array_dulieu_cu = NULL;
		$array_dulieu_cu = $this->Customer->find("all",array("order"=>"id DESC"));
		$array_xeplop = NULL;
		//kiểm tra có dữ liệu từ ng` dùng không
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_sp = $_POST["data"]["customer"];
			if(isset($array_sp["birthday"]))
			{
				$array_sp["birthday"] = date("Y-m-d",strtotime($array_sp["birthday"]));
			}

            /**
             * Đ.A: nếu tồn tại $_GET[relationship] thì thêm vào, nếu không thì mặc định relationship = 0
             */
            if (isset($_GET['relationship']))
            {
                $relationship = $_GET['relationship'];
                $array_sp['relationship'] = $relationship;
            }

			if(isset($array_sp["start_date"])) $array_sp["start_date"] = date("Y-m-d",strtotime($array_sp["start_date"]));
			$array_sp["created_username"] = $this->User->username;
			$array_sp["id_created_user"] = $this->User->id;
			if($this->get_config("nhatre") == "vietkid2")
			{
				if($array_sp["id"] != "" && $array_sp["status"] == "0")
				{
					$id_customer = $array_sp["id"];
					$this->loadModel("Arrange",$table_prefix."arranges");
					$id_xeplop =  $this->Arrange->get_value(array("conditions"=>"id_fullname = '$id_customer' AND status = '1' AND type = '0'"));
					if($id_xeplop != "")
					{
						$array_xeplop["status"] = '0';
						$array_xeplop["id"] = $id_xeplop;
						
						$this->Arrange->save($array_xeplop);
					}
				}
			}

			//luu du lieu vao database
			$this->Customer->save($array_sp);

			if(isset($_GET["ajax"]))
			{
				$module_request = $_GET["ajax"];
				$this->redirect("$module_request");
			}

			$array_dulieu_cu = $this->Customer->find("all",array("order"=>"id DESC"));

			$them_sp = $this->View->render('them_kh.php',array("array_sua"=>$array_sua,"array_group"=>$array_group,"array_dulieu_cu"=>$array_dulieu_cu));
			echo $them_sp;

			return;
			//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
			//if(isset($this->User->modules["ducquoc/ketoan"]["customer"]["manage"])|| ($this->User->type == "1")) $this->redirect("/customer/manage.html");
			//else 	$this->redirect("/customer/index.html");

		}
		$su_dung_layout = true;
		if(isset($_GET["ajax"]))  $su_dung_layout = false;

		$them_sp = $this->View->render('them_kh.php',array("array_sua"=>$array_sua,"array_group"=>$array_group,"array_dulieu_cu"=>$array_dulieu_cu), $su_dung_layout);
		echo $them_sp;
	}

	function del($tmp_id = '')
	{
	
		//lấy ra model dữ liệu
		$this->loadModel("Customer","customers");

		$this->Customer->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/customer/index.html");
	}

	function del_student($tmp_id = '')
	{
	
		//lấy ra model dữ liệu
		$this->loadModel("Customer");
		$this->loadModel("Arrange");

		//truy vẫn dữ liệu id_classroom từ bảng arranges theo id, nếu học sinh đã có lớp thì không được xóa
		$array_arrange = null;
		$array_arrange = $this->Arrange->find("all",array("conditions"=>"`id_fullname`=''"));

		$this->Customer->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/customer/index.html");
	}

	function index()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Customer",$table_prefix."customers");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("Customer","customers");

		$str_conditions = "";
		if($this->User->type != "1")
		{
			//lấy quyền xem dữ liệu bảng project của user hiện tại
			$str_conditions = "(".$this->User->Customer->view_conditions.")";
		}

		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($str_conditions != "")  $str_conditions .= " AND";
			$str_conditions  .= " (`fullname` LIKE '%$tim%')";
		}

		//truy vấn dữ liệu khách hàng

		$array_khachhang = $this->Customer->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		//XUẤT EXCEL
		$output = "";
		if(isset($_POST["xuat"]))
		{
			$array_customer = $this->Customer->find("all",array("order"=>"fullname ASC"));
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
							  <th>Họ và tên</th>
							  <th>Ngày sinh</th>
							  <th>Giới tính</th>
							  <th>Họ và tên ba</th>
							  <th>Nghề nghiệp</th>
							  <th>Số điện thoại</th>
							  <th>Họ và tên mẹ</th>
							  <th>Nghề nghiệp</th>
							  <th>Số điện thoại</th>
							  <th>Địa chỉ</th>
							  <th>Ngày vào trường</th>
						  </tr>";
				foreach($array_customer as $khachang)
				{
					$stt++;
					$fullname = $khachang['fullname'];
					$birthday = date("d-m-Y",strtotime($khachang['birthday']));
					if($birthday == "01-01-1970") $birthday = "";
					$gender = $khachang['gender'];
					if($gender == 0) $gender = "Nữ";
					else  $gender = "Nam";
					$address = $khachang['address'];
					$desc = $khachang['desc'];
					$start_date = date("d-m-Y",strtotime($khachang['start_date']));
					if($start_date == "01-01-1970") $start_date = "";
					$dad_name = $khachang['dad_name'];
					$dad_job = $khachang['dad_job'];
					$dad_phone = $khachang['dad_phone'];
					$mom_name = $khachang['mom_name'];
					$mom_job = $khachang['mom_job'];
					$mom_phone = $khachang['mom_phone'];

					echo "<tr>
							  <td style='text-align: center; vertical-align: middle;'>$stt</td>
							  <td style='text-align: left; vertical-align: middle;'>$fullname</td>
							  <td style='text-align: center; vertical-align: middle;'>$birthday</td>
							  <td style='text-align: center; vertical-align: middle;'>$gender</td>
							  <td style='text-align: left; vertical-align: middle;'>$dad_name</td>
							  <td style='text-align: left; vertical-align: middle;'>$dad_job</td>
							  <td style='text-align: left; vertical-align: middle;'>$dad_phone</td>
							  <td style='text-align: left; vertical-align: middle;'>$mom_name</td>
							  <td style='text-align: left; vertical-align: middle;'>$mom_job</td>
							  <td style='text-align: left; vertical-align: middle;'>$mom_phone</td>
							  <td style='text-align: left; vertical-align: middle;'>$address</td>
							  <td style='text-align: center; vertical-align: middle;'>$start_date</td>
						  </tr>";
				}
				echo "</table>";
				return;
			}

		}

		$danhsach = $this->View->render('danhsach_kh.php',array("array_khachhang"=>$array_khachhang,"tim"=>$tim,"id_classroom"=>$id_classroom,"array_lophoc"=>$array_lophoc));
		echo $danhsach;
	}
	function add_user($tmp_id = "")
	{

		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Customer",$table_prefix."customers");
		$this->loadModel("User2",$table_prefix."users");

		$array_kh = NULL;

		if($this->User->type == "1")
		{
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Customer","customers");
			$str_conditions = $this->User->Customer->view_conditions;
			$str_conditions = "($str_conditions) AND (`type` = '1')";
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions,"order"=>"id DESC"));
		}

		$array_sua = NULL;
		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->User2->find("all",array("conditions"=>"id = $tmp_id"));
		}

		//kiểm tra có duex liệu từ ng` dùng
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_nguoilienlac = $_POST["data"]["customer_user"];
			$array_nguoilienlac["created_username"] = $this->User->username;
			$array_nguoilienlac["id_created_user"] = $this->User->id;
			$array_nguoilienlac["password"] = md5($array_nguoilienlac["password"]);
			$array_nguoilienlac["status"] = "1";
			$array_nguoilienlac["type"] = "2";

			//luu du lieu vao database
			$this->User2->save($array_nguoilienlac);

			//chuyen ve lai trang danh sách
			$this->redirect("/customer/user.html");

			return;
		}
		$them_nguoilienlac = $this->View->render('them_nguoilienlac.php',array("array_sua"=>$array_sua,"array_kh"=>$array_kh));
		echo $them_nguoilienlac;
	}
	function delete_user($tmp_id = '')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("User2",$table_prefix."users");

		$this->User2->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/customer/user.html");
	}
	function user($id = "")
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;

		$this->loadModel("Customer",$table_prefix."customers");

		//lấy ra model dữ liệu
		$this->loadModel("User2",$table_prefix."users");

		$array_kh = NULL;
		if($this->User->type == "1")
		{
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"`type` = '1'"));
		}else
		{
			//lấy dữ liệu khách hàng mà user hiện tại được phân quyền
			$this->User->get_permission("Customer","customers");

			//lấy điều kiện để xem dữ liệu bảng customer để đưa vào điều kiện truy vấn
			$str_conditions = $this->User->Customer->view_conditions;
			$str_conditions = "($str_conditions) AND (`type` = '1')";
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions,"order"=>"id DESC"));
		}

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_kh != NULL)	array_unshift($array_kh,array("","..."));
		else $array_kh = array("","...");

		//Nạp quyền truy xuất dữ liệu bảng users của user hiện tại
		$this->User->get_permission("User2","users");

		$str_conditions = "(`status` = '1') AND (`type` = '2')";

		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($str_conditions != "") $str_conditions .= " AND ";
			$str_conditions  .= " ((`fullname` LIKE '%$tim%') OR (`email` LIKE '%$tim%') OR (`phone` LIKE '%$tim%'))";
		}

		$id_customer = "";
		$array_nguoilienlac = NULL;

		//lấy id_customer từ người dùng submit lên
		if(isset($_POST["data"]) || $id != "")
		{
			//lấy id_customer
			if(isset($_POST["data"])) $id_customer = $_POST["data"]["id_customer"];
			if($id != "")  $id_customer = $id;

			//nếu id_customer có giá trị thì đưa vào câu điều kiện
			if($id_customer != "")
			{
				//kiểm tra điều kiện id_customer = $id_customer
				if($str_conditions != "") $str_conditions .= " AND ";
				$str_conditions .= " (id_customer = $id_customer)";
			}
		}
		//echo $str_conditions;
		//lấy dữ liệu người liên lạc với điều kiện trên
		$array_nguoilienlac = $this->User2->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		$danhsach = $this->View->render('danhsach_nguoilienlac.php',array("array_nguoilienlac"=>$array_nguoilienlac,"tim"=>$tim,"array_kh"=>$array_kh,"id_customer"=>$id_customer));
		echo $danhsach;
	}
	function add_group($id = "")
	{

		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("CustomerGroup",$table_prefix."customer_groups");
		$array_sua = NULL;
		//kiểm tra có id để sửa
		if($id != "")
		{
			$array_sua = $this->CustomerGroup->find("all",array("conditions"=>"id = '$id'"));
		}

		//kiểm tra có duex liệu từ ng` dùng
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_sp = $_POST["data"]["CustomerGroup"];
			$array_sp["created_username"] = $this->User->username;
			$array_sp["id_created_user"] = $this->User->id;

			//luu du lieu vao database
			$this->CustomerGroup->save($array_sp);

			$this->redirect("/customer/list_group.html");

			return;
		}
		$add_group = $this->View->render('add_group.php',array("array_sua"=>$array_sua));
		echo $add_group;
	}
	function list_group()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("CustomerGroup",$table_prefix."customer_groups");
		$dieukien = "";
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			$dieukien = "name LIKE '%$tim%' ";
		}
		//truy vấn dữ liệu
		$array_khachhang = $this->CustomerGroup->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));

		$danhsach = $this->View->render('list_group.php',array("array_khachhang"=>$array_khachhang,"tim"=>$tim));
		echo $danhsach;
	}
	function del_group($tmp_id = '')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("CustomerGroup",$table_prefix."customer_groups");

		$this->CustomerGroup->delete($tmp_id);

		//chuyen ve lai trang xem thu
		$this->redirect("/customer/list_group.html");
	}
	function detail($id = '')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//lấy ra model dữ liệu
		$this->loadModel("Customer",$table_prefix."customers");

		$array_kh = $this->Customer->find("all",array("conditions"=>"id = $id"));

		$them_sp = $this->View->render('detail.php',array("array_kh"=>$array_kh));
		echo $them_sp;

	}
	function add_customer_diary($tmp_id = "")
	{
		//lấy ra model dữ liệu
		$this->loadModel("CustomerDiary","customer_diarys");
		$this->loadModel("Customer","customers");

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

		$array_sua = NULL;
		//kiểm tra có id để sửa
		if($tmp_id != "")
		{
			$array_sua = $this->CustomerDiary->find("all",array("conditions"=>"id = $tmp_id"));
		}

		//kiểm tra có duex liệu từ ng` dùng
		if(isset($_POST["data"]))
		{
			//lấy dữ liệu từ ng` dùng đưa vào mẳng
			$array_luu = $_POST["data"]["customer_diary"];
			$array_luu["issue_date"] = date("Y-m-d",strtotime($array_luu["issue_date"]));
			$array_luu['id_created_user'] = $this->User->id;
			$array_luu['created_username'] = $this->User->username;

			//luu du lieu vao database
			$this->CustomerDiary->save($array_luu);

			//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
			$this->redirect("/customer/customer_diary.html");
			return;
		}

		$them_nhatky = $this->View->render('nhap_nhatky_khachhang.php',array("array_sua"=>$array_sua,"array_kh"=>$array_kh));
		echo $them_nhatky;
	}

	function del_customer_diary($tmp_id = '')
	{
		//lấy ra model dữ liệu
		$this->loadModel("CustomerDiary","customer_diarys");

		$this->CustomerDiary->delete($tmp_id);

		$this->redirect("/customer/customer_diary.html");
	}
	function customer_diary()
	{
		$this->loadModel("CustomerDiary","customer_diarys");
		$this->loadModel("Customer","customers");

		$this->User->get_permission("CustomerDiary","customer_diarys");

		$array_kh = NULL;
		$str_conditions = "";
		if($this->User->type == "1")
		{
			$array_kh =  $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));
		}else
		{
			$this->User->get_permission("Customer","customers");
			$str_conditions = $this->User->Customer->view_conditions;
			$array_kh = $this->Customer->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions,"order"=>"id DESC"));
		}

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_kh != NULL)	array_unshift($array_kh,array("","..."));
		else $array_kh = array("","...");

		//nếu có nội dung tìm kiếm thì cộng thêm vào diều kiện tìm kiếm
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			if($tim != "")
			{
				if($str_conditions != "") $str_conditions .= " AND";
				$str_conditions  .= " (`place` LIKE '%$tim%' OR `des` LIKE '%$tim%')";
			}

		}

		$id_customer = "";
		if(isset($_GET["id_customer"]))
		{
			$id_customer = $_GET["id_customer"];
			if($id_customer != "")
			{
				if($str_conditions != "") $str_conditions .= " AND";
				$str_conditions  .= " (`id_customer` = '$id_customer')";
			}
		}

		//truy vấn dữ liệu khách hàng
		$array_nhatky = $this->CustomerDiary->find("all",array("order"=>"id DESC","conditions"=>$str_conditions));

		$danhsach = $this->View->render('danhsach_nhatky_khachhang.php',array("array_kh"=>$array_kh,"tim"=>$tim,"id_customer"=>$id_customer,"array_nhatky"=>$array_nhatky));
		echo $danhsach;
	}
}
?>