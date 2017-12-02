<?php
class thuchi extends Main
{
	function index()
	{
		$dieukien="";
		$type="";
		$type_account="";
		$tungay="";
		$denngay="";
		$id_classroom="";
		$id_customer="";


		if (isset($_GET['type'])) $type = $_GET['type'];
        if (isset($_GET['type_account'])) $type_account = $_GET['type_account'];
		$dieukien.=" type = '$type' AND type_account = '$type_account'";
		if (isset($_POST['group']))
        {
            $id_group  = $_POST['group'];
            if($id_group != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " id_group ='$id_group'";

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
				$dieukien .= " (`issued_date` >= '$dieukien_tungay')";
			}
        }else
		{
			if($dieukien != "") $dieukien .= " AND ";
			$dieukien .= "  (`issued_date` >= '".date("Y-m-01",strtotime($tungay))."')";
		}
		$denngay = date("t-m-Y");
        if (isset($_POST['finishday']))
        {
            $denngay = $_POST['finishday'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`issued_date` <= '$dieukien_denngay')";
			}
        }else
		{
			if($dieukien != "") $dieukien .= " AND ";
			$dieukien .= "  (`issued_date` <= '".date("Y-m-t",strtotime($denngay))."')";
		}
		if (isset($_POST['customer_name']))
        {
            $id_customer  = $_POST['customer_name'];
            if($id_customer != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (id_customer = '$id_customer')";
			}
        }

		if (isset($_POST['id_classroom']))
        {
            $id_classroom  = $_POST['id_classroom'];
            if($id_classroom != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (id_classroom = '$id_classroom')";
			}
        }

		//lấy tiều đề hàm và tiêu đề người thực hiện
		$array_title = $this->get_title($type,$type_account);

		$this->loadModel("Thuchi","thu_chis");
		$this->loadModel("ThuchiGroup","thuchi_groups");



		//Xử lý nếu thu_chi có lớp học
		$this->loadModel("Classroom","classrooms");
		$array_classroom = NULL;
		if($this->get_config("thuchi_class") == "yes")
		{

			$array_classroom= $this->Classroom->find("all",array("fields"=>"id,name"));
			array_unshift($array_classroom,array("","..."));
		}

		//Xử lý nếu thu_chi có khách hàng
		//nếu thu chi có lớp thì lấy học sinh theo lớp
		//không có lớp thì lấy hết tất cả học sinh
		$array_customer = NULL;
		if($this->get_config("thuchi_customer") == "yes")
		{
			if($id_classroom != "")
			{
				$this->loadModel("Customer","arranges");
				$array_customer= $this->Customer->find("all",array("fields"=>"id_fullname,fullname","conditions"=>"id_classroom = $id_classroom"));
			}else
			{
				$this->loadModel("Customer","customers");
				$array_customer= $this->Customer->find("all",array("fields"=>"id,fullname"));
			}
			array_unshift($array_customer,array("","..."));
		}
		//kết thúc phẩn xử lý khách hàng
		/////////////////////////////////////////////////////////////

		//Lấy danh sach nhóm thu chi
		$array_thuchi_group= $this->ThuchiGroup->find("all",array("fields"=>"id,name","conditions"=>"`type`='$type' AND type_account= '$type_account'"));
		array_unshift($array_thuchi_group,array("","..."));

		$array_thuchi= $this->Thuchi->find("all",array("conditions" =>$dieukien,"order"=>"id DESC"));
		$html_result = $this->View->render("index.php",array("array_title"=>$array_title,"array_thuchi"=>$array_thuchi,"array_classroom"=>$array_classroom,"id_classroom"=>$id_classroom,"array_thuchi_group"=>$array_thuchi_group,"type"=>$type,"type_account"=>$type_account,"array_customer"=>$array_customer,"id_customer"=>$id_customer,"tungay"=>$tungay,"denngay"=>$denngay,"id_group"=>$id_group));
        echo $html_result;
	}
	function xem2()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi",$table_prefix."thu_chis");

		// Thực hiện câu truy vấn csdl trong table thu_chis vào mảng array_thuchi.
		$array_thuchi = $this->ThuChi->find("all");

		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('danhsach2.php',array("array_thuchi"=>$array_thuchi));

		// Xuất dữ liệu
		echo $hienthi;
	}
	function thuyetminh_bctc()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('thuyetminh_bctc.php');

		// Xuất dữ liệu
		echo $hienthi;
	}
	function quyettoan_thue_tndn()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('quyettoan_thue_tndn.php');

		// Xuất dữ liệu
		echo $hienthi;
	}

		function candoi_ketoan()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('candoi_ketoan.php');

		// Xuất dữ liệu
		echo $hienthi;
	}
		function taikhoan()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		$this->loadModel("TaiKhoan",$table_prefix."accountant_items");
		$array_taikhoan= $this->TaiKhoan->find("all",array("order"=>"code asc"));
		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$desktop = $this->View->render('taikhoan.php',array("array_taikhoan"=>$array_taikhoan));
		// Xuất dữ liệu
		echo $desktop;
	}
		function kqkd()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('kqkd.php');

		// Xuất dữ liệu
		echo $hienthi;
	}


	function candoi_phatsinh()
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		$this->loadModel("TaiKhoan",$table_prefix."taikhoan");
		$array_taikhoan= $this->TaiKhoan->find("all");
		$desktop = $this->View->render('candoi_phatsinh.php',array("array_taikhoan"=>$array_taikhoan));
		// Xuất dữ liệu
		echo $desktop;
	}
	function candoi_duno()
	{
		$table_prefix = "";
		//if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		//$this->loadModel("TaiKhoan",$table_prefix."taikhoan");
		//$array_taikhoan= $this->TaiKhoan->find("all");

		$desktop = $this->View->render('candoi_duno.php',array("array_taikhoan"=>$array_taikhoan));
		echo $desktop;
	}

	function xem()
	{
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi","thu_chis");

		//Nạp quyền truy xuất dữ liệu bảng projects của user hiện tại
		$this->User->get_permission("ThuChi","thu_chis");

		//lấy quyền xem dữ liệu bảng project của user hiện tại
		$dieukien = "";
		if($this->User->type != 1) $dieukien = $this->User->ThuChi->view_conditions;

		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			$dieukien = "($dieukien) AND (name LIKE '%$tim%')";
		}

		$type = "";
		if(isset($_POST["loai"]))
		{
			$type = $_POST["loai"];
			if($type != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`type` = '$type')";
			}
		}

		$id_user = $this->User->id;

		//thêm điều kiện id_user hiên tại có trong list_user_view ko
		//$dieukien = "($dieukien) OR (`list_user_view` LIKE '%,$id_user,%')";

		// Thực hiện câu truy vấn csdl trong table thu_chis vào mảng array_thuchi.
		$array_thuchi = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>$dieukien));

		// Đưa array_thuchi vào trong view danhsach.php và lấy kết quả trả về biến hienthi
		$hienthi = $this->View->render('danhsach.php',array("array_thuchi"=>$array_thuchi,"dieukien"=>$dieukien,"type"=>$type,"tim"=>$tim));

		// Xuất dữ liệu
		echo $hienthi;
	}


	function nhap($id='')
	{
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi","thu_chis");
		$this->loadModel("User2","users");
		$this->loadModel("Customer","customers");
		if($this->get_config("thuchi_project") != "no") $this->loadModel("Project","projects");
		$this->loadModel("CustomerUser","users");
		$this->loadModel("Post","posts");

		//thực hiện việc lấy dữ liệu từ form để nhớ lại sau khi người dùng submit
		//nếu thay đổi nhóm hoặc khách hàng thì sẽ giữ lại các dữ liệu nguòi dùng nhập
		$array_thuchi = NULL;
		$loai_khachhang = "";
		$id_customer = "";
		$array_du_an = NULL;
		$array_taikhoan = NULL;
		$array_nguoilienlac = NULL;
		$list_user_view = "";

		if($this->get_config("thuchi") != "0")
		{
			$this->loadModel("AccountMoney","account_moneys");
			$array_taikhoan = $this->AccountMoney->find("all",array("fields"=>"id,name","order"=>"id DESC"));

			//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
			if($array_taikhoan != NULL)	array_unshift($array_taikhoan,array("","..."));
			else $array_taikhoan = array("","...");
		}
		if(isset($_POST['data']))
		{
			//tạo array = du lieu tu nguoi dung nhap vao
			$array_thuchi = $_POST['data']['ThuChi'];
			$array_thuchi["issued_date"] = date("Y-m-d",strtotime($array_thuchi["issued_date"]));
			$array_thuchi["created_username"] = $this->User->username;
			$array_thuchi["id_created_user"] = $this->User->id;

			//lấy danh sách id user được chọn có quyền xem dữ liệu này
			$array_kiemtra = $array_thuchi["check_list"];
			foreach($array_kiemtra as $kiemtra)
			{
				if($list_user_view != "") $list_user_view .= ",";
				$list_user_view .= $kiemtra["list_user_view"];
			}

			if($list_user_view != "") $list_user_view = ",".$list_user_view.",";
			$array_thuchi["list_user_view"] = $list_user_view;

			//khi trạng thái = 1 mới lưu dữ liệu vào
			if($array_thuchi["trangthai"] == 1)
			{
				//thuc hien luu du lieu
				$this->ThuChi->save($array_thuchi);

				// Tạo giá trị save_ok cho Session msg
				$this->Session->set_flash('msg','save_ok');

				//chuyen ve lai trang index
				//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
				if(isset($this->User->modules["ducquoc/ketoan"]["thuchi"]["quanly_thuchi"])|| ($this->User->type == "1")) $this->redirect("/thuchi/quanly_thuchi.html");
				else 	$this->redirect("/thuchi/xem.html");
				return;
			}
		}else
		{
			//nếu ko có dũ liệu từ form kiểm tra có id không
			if ($id!="")
			{
				$array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id'"));

				//nếu có dữ liệu
				if(isset($array_thuchi[0])) $array_thuchi = $array_thuchi[0];
			}
		}

		//lấy id_customer của khách hàng được chọn
		if(isset($array_thuchi["id_customer"]))	$id_customer = $array_thuchi["id_customer"];

		$array_customer = $this->Customer->find("all",array("conditions"=>"`id` = '$id_customer'"));
		$loai_khachhang = $array_customer[0]["type"];

		//lấy hợp đồng khách hàng
		$array_hopdong = NULL;
		if($this->get_config("thuchi") == "0") $array_hopdong = $this->Post->find("all",array("fields"=>"id,title","conditions"=>"`id_customer` = '$id_customer'"));

		if($this->get_config("thuchi_project") != "no") $array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>"`id_customer` = '$id_customer'","order"=>"id DESC"));

		if($this->get_config("thuchi") != "0")
		{

			$array_nguoilienlac = $this->CustomerUser->find("all",array("fields"=>"id,fullname","conditions"=>"(`id_customer` = '$id_customer') AND (`status` = '1') AND (`type` = '2')","order"=>"id DESC"));
		}
		//lấy dữ liệu khách hàng từ bảng customer
		$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_khachhang != NULL)	array_unshift($array_khachhang,array("","..."));
		else $array_khachhang = array("","...");


		$array_user = NULL;
		if($this->User->type == "1")
		{
			$array_user =  $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));

		}else
		{
			//Nạp quyền truy xuất dữ liệu bảng users của user hiện tại
			$this->User->get_permission("User2","users");

			//lấy quyền xem dữ liệu bảng users của user hiện tại
			$str_conditions = $this->User->User2->view_conditions;

			$array_user =  $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>$str_conditions,"order"=>"id DESC"));

		}

		$array_user_view = NULL;
		$array_user_view =  $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"`status` = '1'"));

		// Lấy kết quả từ view trả về biến hienthi.
		$hienthi = $this->View->render('nhap.php',array("array_thuchi"=>$array_thuchi,"array_user"=>$array_user,"array_khachhang"=>$array_khachhang,"array_du_an"=>$array_du_an,"array_nguoilienlac"=>$array_nguoilienlac,"loai_khachhang"=>$loai_khachhang,"array_user_view"=>$array_user_view,"array_hopdong"=>$array_hopdong,"array_taikhoan"=>$array_taikhoan));
		echo $hienthi;
	}

	function chitiet($id='')
	{
		$this->loadModel("ThuChi","thu_chis");

		$array_thuchi=NULL;
		$type = "";
		if($id!="")
		{
			$array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id' "));
			$type = $array_thuchi[0]["type"];
			$group_code = $array_thuchi[0]["group_code"];
			$id_customer = $array_thuchi[0]["id_customer"];
			$id_classroom = $array_thuchi[0]["id_classroom"];
			$month_year = $array_thuchi[0]["month_year"];
		}

		$array_bieuphi = NULL;
		if($type == 0 && $group_code == "hocphi")
		{
			$this->loadModel("FeeCustomer","fee_customers");
			$array_bieuphi = $this->FeeCustomer->find("all",array("conditions"=>"`id_customer` = '$id_customer' AND `id_classroom` = '$id_classroom' AND `month_year` = '$month_year'"));
			if($array_bieuphi == NULL)
			{
				$this->loadModel("FeeClassroom","fee_classrooms");
				$array_bieuphi = $this->FeeClassroom->find("all",array("conditions"=>"`id_classroom` = '$id_classroom' AND `month_year` = '$month_year'"));
			}
		}
		
		$desktop = $this->View->render('chitiet_thuchi.php',array("array_thuchi"=>$array_thuchi,"type"=>$type,"array_bieuphi"=>$array_bieuphi,"group_code"=>$group_code));
		echo $desktop;
	}
	function xoa($id='',$type="",$type_account="",$return_function="")
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi",$table_prefix."thu_chis");

		// Thực hiện lệnh xóa
		$this->ThuChi->delete($id);

		// Chuyển sang trang danh sách
			$this->redirect("/thuchi/".$return_function."?type=".$type."&type_account=".$type_account);
		return;
	}	
	function xoa_taikhoan($id='')
	{
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("TaiKhoan",$table_prefix."accountant_items");

		// Thực hiện lệnh xóa
		$this->loadModel->delete($id);

		// Chuyển sang trang danh sách
		$this->redirect("/thuchi/xem.html?msg=del_ok");
		return;
	}
	function quanly_thuchi()
	{
		
		
		//lấy ra model dữ liệu
		$this->loadModel("ThuChi","thu_chis");
		$this->loadModel("Post","posts");
		$this->loadModel("Customer","customers");
		$this->loadModel("Project","projects");
		$array_du_an = NULL;
		$array_hopdong = NULL;
		$dieukien = "";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			$dieukien_tim = str_replace("'","''",$tim);
			if($tim != "") 
			{
				$dieukien = "(`username` LIKE '%$dieukien_tim%') OR (`post_title` LIKE '%$dieukien_tim%') OR (`post_number` LIKE '%$dieukien_tim%') OR (`customer_name` LIKE '%$dieukien_tim%') OR (`project_name` LIKE '%$dieukien_tim%')";
				if($this->get_config("thuchi_num") == "yes") 
				{ 
					if($dieukien != "") $dieukien .= " OR ";
					$dieukien .= "  (num = '$tim')";
				}
			}
		}

		$type = "";
		$dieukien_type= "";
		if(isset($_GET["loai"]))
		{
			$type = $_GET["loai"];
			$dieukien_type = str_replace("'","''",$type);
			if($type != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				if($this->get_config("donvi_name") == "vutico")
				{
					
					if($dieukien_type == 0 || $dieukien_type == 1) $dieukien .= " (`type` = '$dieukien_type' AND `type_account` = 0)";
					if($dieukien_type == 2 ) $dieukien .= " (`type` = 0 AND `type_account` = 1)";
					if($dieukien_type == 3 ) $dieukien .= " (`type` = 1 AND `type_account` = 1)";
				}else $dieukien .= " (`type` = '$dieukien_type' )";
			}
		}
		
		$tungay = "";
		if($this->get_config("khoaso") != "khoaso" && $this->get_config("khoaso")  != "" ) $tungay =  $this->get_config("khoaso");
		if(isset($_GET["tungay"]))
		{
			$tungay = $_GET["tungay"];
			 
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`issued_date` >= '$dieukien_tungay')";
			}
		}

		$denngay = "";
		if(isset($_GET["denngay"]))
		{
			$denngay = $_GET["denngay"];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`issued_date` <= '$dieukien_denngay')";
			}
		}

		$array_khachhang = $this->Customer->find("all",array("order"=>"id DESC"));

		$id_customer = "";
		if(isset($_GET["id_customer"]))
		{
			$id_customer = $_GET["id_customer"];
			$dieukien_id_customer = str_replace("'","''",$id_customer);
			if($dieukien_id_customer != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id_customer` = '$dieukien_id_customer')";
			}
		}

		$id_post = "";
		if(isset($_GET["id_post"]))
		{
			$id_post = $_GET["id_post"];
			$dieukien_id_post = str_replace("'","''",$id_post);
			if($dieukien_id_post != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id_post` = '$dieukien_id_post')";
			}
		}

		if($this->get_config("thuchi") == "0") $array_du_an = $this->Project->find("all",array("order"=>"id DESC"));
		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");


		$id_project = "";
		if(isset($_GET["id_project"]))
		{
			$id_project = $_GET["id_project"];
			$dieukien_id_project = str_replace("'","''",$id_project);
			if($dieukien_id_project != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id_project` = '$dieukien_id_project')";
			}
		}
		
		if(isset($_GET["customer_name"])) $customer_name = $_GET["customer_name"];
		if(isset($_GET["project_name"])) $project_name = $_GET["project_name"];
		if(isset($_GET["post_title"])) $post_title = $_GET["post_title"];
		//truy vấn dữ liệu
		if($this->get_config("donvi_name") == "vutico")
		{
			if($dieukien_type != "")
			{
					
				$array_thuchi = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));
			
			}else 
				{
					
					if($dieukien != "") $dieukien .= " AND ";
					$array_thu = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 0 AND `type_account` =0 "));
					$array_chi = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 1 AND `type_account` =0 "));
					$array_thu_no_kd = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 0 AND `type_account` =0 AND `id_group` = 32"));
					$array_thu_no = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 0 AND `type_account` =0 AND `id_group` = 38 "));
					
					//echo "$dieukien"."`type` = 1 AND `type_account` =0 AND  `id_group` = 34 ";
					$array_chi_no_kd = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 1 AND `type_account` =0 AND  `id_group` = 34 "));
					$array_chi_no = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"."`type` = 1 AND `type_account` =0 AND  `id_group` = 40 "));
					
					if(isset($_GET["tungay"])) $tungay = $dieukien_tungay; 
					$arr_thuchi_dauky = $this->ThuChi->find("all",array("conditions"=>" `issued_date` < '$tungay'"));
					
					$du_no_dauky = 0;
					if ($arr_thuchi_dauky != NULL)
					{
						foreach ($arr_thuchi_dauky  as $thuchi)
						{
										
								if ($thuchi['id_group'] == 32) $du_no_dauky += $thuchi['amount']; // 32: khách hàng nợ kinh doanh
								if ($thuchi['id_group'] == 34) $du_no_dauky -= $thuchi['amount']; // 38: khách hàng trả nợ
								if ($thuchi['id_group'] == 38) $du_no_dauky -= $thuchi['amount'];
								if ($thuchi['id_group'] == 40) $du_no_dauky += $thuchi['amount']; // 34: chi kinh doanh
								
							
						}
					}
					
				}
				
		}else $array_thuchi = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));
		
		//xuất excel
		$output = "";
		if(isset($_GET["xuat"]))
		{
			$output = $_GET["xuat"];
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
							  <th>Loại</th>
							  <th>Ngày</th>
							  <th>Số hợp đồng</th>
							  <th>Tên khoản thu - chi / Vật tư	</th>
							  <th>Tên Dự Án</th>
							  <th>Tên Khách Hàng</th>
							  <th>Số tiền</th>
							  <th>Số Lượng</th>
							  <th>Tổng Tiền</th>
						  </tr>";
				$tong_thu = 0;
				$tong_chi = 0;
				foreach($array_thuchi as $thuchi)
				{
					if($thuchi["type"] == 0) $tong_thu += $thuchi["amount"];
					else $tong_chi += $thuchi["amount"];
					$stt++;
					$array_type = array(""=>"...","0"=>"Thu","1"=>"Chi");
					$type = $array_type[$thuchi["type"]];
					$issued_date = date("d-m-Y",strtotime($thuchi["issued_date"]));
					if($issued_date == "01-01-1970") $issued_date = "";
					$post_number = $thuchi["post_number"];
					$name = $thuchi["name"];
					$project_name = $thuchi["project_name"];
					$customer_name = $thuchi["customer_name"];
					$price = number_format($thuchi["price"]);
					$quantity = $thuchi["quantity"];
					$amount = number_format($thuchi["amount"]);

					echo "<tr>
							  <td style='text-align: center; vertical-align: middle;'>$stt</td>
							  <td style='text-align: center; vertical-align: middle;'>$type</td>
							  <td style='text-align: center; vertical-align: middle;'>$issued_date</td>
							  <td style='text-align: center; vertical-align: middle;'>$post_number</td>
							  <td style='text-align: center; vertical-align: middle;'>$name</td>
							  <td style='text-align: center; vertical-align: middle;'>$project_name</td>
							  <td style='text-align: center; vertical-align: middle;'>$customer_name</td>
							  <td style='text-align: center; vertical-align: middle;'>$price</td>
							  <td style='text-align: center; vertical-align: middle; $stype_lailo'>$quantity</td>
							  <td style='text-align: center; vertical-align: middle;'>$amount</td>
						  </tr>";
				}
				$lai = 0;
				$lo = 0;
				if($tong_chi < $tong_thu )$lai = $tong_thu - $tong_chi;
				if($tong_thu < $tong_chi )$lo = $tong_chi - $tong_thu;
				$lai = number_format($lai);
				$lo = number_format($lo);
				$tong_thu = number_format($tong_thu);
				$tong_chi = number_format($tong_chi);

				echo "<tr style='font-weight:bold'>";
				echo "<td colspan='3'>Tổng chi: $tong_chi</td>";
				echo "<td colspan='3'>Tổng thu: $tong_thu</td>";
				echo "<td colspan='2'>Lãi: $lai</td>";
				echo "<td colspan='2'>Lỗ: $lo</td>";
				echo "<td>";
				echo "</tr>";
				echo "</table>";
				return;
			}

		}

		if($this->get_config("thuchi") == "0") $array_hopdong = $this->Post->find("all",array("order"=>"id DESC"));
		$danhsach = $this->View->render('quanly_thuchi.php',array("du_no_dauky"=>$du_no_dauky,"array_chi_no_kd"=>$array_chi_no_kd,"array_thu_no_kd"=>$array_thu_no_kd,"array_thu"=>$array_thu,"array_chi"=>$array_chi,"array_thu_no"=>$array_thu_no,"array_chi_no"=>$array_chi_no,"array_thuchi"=>$array_thuchi,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay,"array_khachhang"=>$array_khachhang,"array_du_an"=>$array_du_an,"type"=>$type,"id_customer"=>$id_customer,"id_project"=>$id_project,"post_title"=>$post_title,"project_name"=>$project_name,"customer_name"=>$customer_name,"array_hopdong"=>$array_hopdong,"output"=>$output));
		echo $danhsach;
	}
	function baocao_lailo()
	{
		//lấy ra model dữ liệu
		$table_prefix = "";
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		$this->loadModel("ThuChi","thu_chis");
		$this->loadModel("Post","posts");
		$this->loadModel("Customer","customers");
		$this->loadModel("Project","projects");
		$array_thuchi = NULL;
		$type = "";


		$dieukien = "";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			$dieukien_tim = str_replace("'","''",$tim);
			if($tim != "") $dieukien = "((`document_number` LIKE '%$dieukien_tim%') OR (`document_code` LIKE '%$dieukien_tim%') OR (`customer_name` LIKE '%$dieukien_tim%') OR (`project_name` LIKE '%$dieukien_tim%'))";

		}
		$tungay = "";
		if(isset($_GET["tungay"]))
		{
			$tungay = $_GET["tungay"];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`document_created` >= '$dieukien_tungay')";
			}
		}

		$denngay = "";
		if(isset($_GET["denngay"]))
		{
			$denngay = $_GET["denngay"];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`document_created` <= '$dieukien_denngay')";
			}
		}
		$id_customer = "";
		if(isset($_GET["id_customer"]))
		{
			$id_customer = $_GET["id_customer"];
			$dieukien_id_customer = str_replace("'","''",$id_customer);
			if($dieukien_id_customer != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id_customer` = '$dieukien_id_customer')";
			}
		}
		$id_post = "";
		if(isset($_GET["id_post"]))
		{
			$id_post = $_GET["id_post"];
			$dieukien_id_post = str_replace("'","''",$id_post);
			if($dieukien_id_post != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id` = '$dieukien_id_post')";
			}
		}
		$id_project = "";
		if(isset($_GET["id_project"]))
		{
			$id_project = $_GET["id_project"];
			$dieukien_id_project = str_replace("'","''",$id_project);
			if($dieukien_id_project != "")
			{
				if($dieukien != "") $dieukien .= " AND ";
				$dieukien .= " (`id_project` = '$dieukien_id_project')";
			}
		}
	    $customer_name = "";
	    $project_name = "";
	    $post_title = "";
		if(isset($_GET["customer_name"])) $customer_name = $_GET["customer_name"];
		if(isset($_GET["project_name"])) $project_name = $_GET["project_name"];
		if(isset($_GET["post_title"])) $post_title = $_GET["post_title"];

		//truy vấn dữ liệu
		$array_khachhang = $this->Customer->find("all",array("order"=>"id DESC"));
		$array_du_an = $this->Project->find("all",array("order"=>"id DESC"));
		$array_hopdong = $this->Post->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));
		$array_dulieu = NULL;

		$i = 0;
		$table_name = $table_prefix."thu_chis";
		foreach($array_hopdong as $hopdong_value)
		{
			$sql_get_thuchi = "SELECT SUM(CASE WHEN type = '0' AND id_post='".$hopdong_value["id"]."' THEN `amount` ELSE 0 END) AS tong_thu,
  									  SUM(CASE WHEN type = '1' AND id_post='".$hopdong_value["id"]."' THEN `amount` ELSE 0 END) AS tong_chi FROM $table_name";
			$array_get_thuchi = $this->DB->query($sql_get_thuchi);
			$array_dulieu[$i]["tong_thu"] = 0;
			$array_dulieu[$i]["tong_chi"] = 0;
			if($array_get_thuchi != NULL)
			{
				$array_dulieu[$i]["tong_thu"] = $array_get_thuchi[0]["tong_thu"];
				$array_dulieu[$i]["tong_chi"] = $array_get_thuchi[0]["tong_chi"];
			}

			$array_dulieu[$i]["document_number"] = $hopdong_value["document_number"];
			$array_dulieu[$i]["document_created"] = $hopdong_value["document_created"];
			$array_dulieu[$i]["document_expired"] = $hopdong_value["document_expired"];
			$array_dulieu[$i]["document_status"] = $hopdong_value["document_status"];
			$array_dulieu[$i]["customer_name"] = $hopdong_value["customer_name"];
			$array_dulieu[$i]["project_name"] = $hopdong_value["project_name"];
			$i++;
		}
		//print_r($array_dulieu);

		//xuất excel
		$output = "";
		if(isset($_GET["xuat"]))
		{
			$output = $_GET["xuat"];
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
							  <th>Số hợp đồng</th>
							  <th>Ngày ký</th>
							  <th>Ngày hết hạn</th>
							  <th>Khách hàng</th>
							  <th>Dự án</th>
							  <th>Đã thu</th>
							  <th>Đã chi</th>
							  <th>lãi - Lỗ</th>
							  <th>Trạng thái</th>
						  </tr>";
				foreach($array_dulieu as $dulieu)
				{
					$stt++;
					$document_number = $dulieu["document_number"];
					$document_created = date("d-m-Y",strtotime($dulieu["document_created"]));
					if($document_created == "01-01-1970") $document_created = "";
					$document_expired = date("d-m-Y",strtotime($dulieu["document_expired"]));
					if($document_expired == "01-01-1970") $document_expired = "";
					$customer_name = $dulieu["customer_name"];
					$project_name = $dulieu["project_name"];
					$tong_thu = number_format($dulieu["tong_thu"]);
					$tong_chi = number_format($dulieu["tong_chi"]);
					$lai_lo = $dulieu["tong_thu"] - $dulieu["tong_chi"];
					$stype_lailo = "";
					if($dulieu["tong_chi"] > $dulieu["tong_thu"]) $stype_lailo = "font-weight:bold; color:red";
					$lai_lo = number_format($lai_lo);
					$document_status = $dulieu["document_status"];

					echo "<tr>
							  <td style='text-align: center; vertical-align: middle;'>$stt</td>
							  <td style='text-align: center; vertical-align: middle;'>$document_number</td>
							  <td style='text-align: center; vertical-align: middle;'>$document_created</td>
							  <td style='text-align: center; vertical-align: middle;'>$document_expired</td>
							  <td style='text-align: center; vertical-align: middle;'>$customer_name</td>
							  <td style='text-align: center; vertical-align: middle;'>$project_name</td>
							  <td style='text-align: center; vertical-align: middle;'>$tong_thu</td>
							  <td style='text-align: center; vertical-align: middle;'>$tong_chi</td>
							  <td style='text-align: center; vertical-align: middle; $stype_lailo'>$lai_lo</td>
							  <td style='text-align: center; vertical-align: middle;'>$document_status</td>
						  </tr>";
				}
				echo "</table>";
				return;
			}

		}

		$danhsach = $this->View->render('baocao_lailo.php',array("array_thuchi"=>$array_thuchi,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay,"array_khachhang"=>$array_khachhang,"array_du_an"=>$array_du_an,"type"=>$type,"id_customer"=>$id_customer,"id_project"=>$id_project,"id_post"=>$id_post,"post_title"=>$post_title,"project_name"=>$project_name,"customer_name"=>$customer_name,"array_hopdong"=>$array_hopdong,"array_dulieu"=>$array_dulieu,"output"=>$output));
		echo $danhsach;
	}

	function add($id='')
	{
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi","thu_chis");
		$this->loadModel("ThuChiGroup","thuchi_groups");
		$this->loadModel("User2","users");
		$this->loadModel("Customer","customers");
		$this->loadModel("Project","projects");
		$this->loadModel("CustomerUser","users");
		$this->loadModel("Post","posts");
		$this->loadModel("FeeCustomer","fee_customers");


		//********************************************************************************
		//Xử lý phần hiển thị số tiền đã nộp ở phần thu tiền học phí
		//**********************************************************************************
		if(isset($_GET['type'])&&($_GET['type']=='ajax')&&($_GET['act']=='thongtin_thu'))
		{
			$id_customer_thuchi = $_GET['id_customer'];
			//echo $id_customer_thuchi;
			$id_classroom_thuchi = $_GET['id_classroom'];

			//vì month_year chỉ có giá trị tháng năm, thêm ngày 01 vào đầu để thành kiểu ngày tháng
			$month_year="01-".$_GET['month_year'];
			$month_year_thuchi=date("Y-m-d",strtotime($month_year));

			//tạo câu điều kiện truy vấn theo lớp hs ,tháng năm
			$dieukien= "id_customer = '$id_customer_thuchi' AND id_classroom = '$id_classroom_thuchi' AND  month_year = '$month_year_thuchi'";
			$sotien_danop = $this->ThuChi->get_value(array("fields"=>"SUM(amount)","conditions"=>$dieukien));

			//truy vấn tổng tiền từ bảng fee_customer
			$dk_tongtien = "`id_customer`='$id_customer_thuchi' AND `id_classroom`='$id_classroom_thuchi' AND `month_year`='$month_year_thuchi'";
			$tong_tien_dukien = $this->FeeCustomer->get_value(array("conditions"=>$dk_tongtien,"fields"=>"total_amount"));
			// echo "tong tien:".$tong_tien_thuchi."VND";

			$sotien_conlai = $tong_tien_dukien - $sotien_danop;

			
			$this->loadModel("CustomerDebt","customer_debts");
			$tong_butru = $this->CustomerDebt->get_value(array("fields"=>"tong_butru","conditions"=>"id_customer='$id_customer_thuchi' AND id_classroom='$id_classroom_thuchi'","order"=>"month_year DESC","limit"=>1));

			echo "<br/><br/>Tổng tiền tháng $month_year : <span style='color:blue; font-weight:bold'>".number_format($tong_tien_dukien)."</span><br>";

			echo "Số tiền đã nộp $month_year : <span style='color:blue; font-weight:bold'>".number_format($sotien_danop)."</span> <br/>";

			if($sotien_conlai>0) echo "Số tiền phải nộp : <span style='color:red; font-weight:bold'>".number_format($sotien_conlai)."</span> &nbsp;&nbsp;&nbsp;";			
			if($sotien_conlai<0) echo "Số tiền thừa đang có : <span style='color:green; font-weight:bold'>".number_format(abs($sotien_conlai))."</span> &nbsp;&nbsp;&nbsp;";			

			return;
		}
		//********************************************************************************
		//Xử lý phần hiển thị số tiền đã nộp ở phần thu tiền học phí
		//**********************************************************************************



		//********************************************************************************
		//Xác định đây là loại phiếu thu hay phiếu chi
		//**********************************************************************************

		$array_thuchi = NULL;

		//xử lý phần loại thu chi
		$type="";
		if(isset($_GET["type"])) $type =$_GET["type"];
		if($type=="") $type="0";
		//END xử lý phần loại thu chi


		//xử lý loại tài khoản thu hoặc chi
		//0: thu chi thường, 1: nợ, 2: tạm ứng, 3: dự kiến
		$type_account=0;
		if(isset($_GET["type_account"])) $type_account =$_GET["type_account"];
		//********************************************************************************
		//Xác định đây là loại phiếu thu hay phiếu chi
		//**********************************************************************************



		//********************************************************************************
		//Xử lý lưu dữ liệu khi có submit data từ form
		//**********************************************************************************

		//kiểm tra có tham số data người dùng nhập vào để lưu vào bảng thu chi
		$trangthai="";
		if(isset($_POST['data']['ThuChi']['trangthai'])) $trangthai=$_POST['data']['ThuChi']['trangthai'];

		if($trangthai=="save")
		{
			//tạo array = du lieu tu nguoi dung nhap vao
			$array_thuchi = $_POST['data']['ThuChi'];
			$array_thuchi["issued_date"] = date("Y-m-d",strtotime($array_thuchi["issued_date"]));
			$array_thuchi["created_username"] = $this->User->username;
			$array_thuchi["id_created_user"] = $this->User->id;
			$array_thuchi["type"] = $type;
			$array_thuchi["amount"] = str_replace(",","",$array_thuchi["amount"]);

			$array_thuchi["group_code"] = "";
			$array_thuchi["group_name"] = "";
			
			$id_group=$array_thuchi["id_group"];

			//lấy code group từ bản thu chi group
			$array_tmp_thuchi_group = $this->ThuChiGroup->find("all",array("conditions"=>"id='$id_group'"));
			if($array_tmp_thuchi_group)
			{
				$array_thuchi["group_code"] = $array_tmp_thuchi_group[0]['code'];
				$array_thuchi["group_name"] = $array_tmp_thuchi_group[0]['name'];
			}

			//kiểm tra có danh sách phần quyền người xem
			if($this->get_config("thuchi_user_view ") == "yes")
			{
				//lấy danh sách id user được chọn có quyền xem dữ liệu này
				$array_kiemtra = $array_thuchi["check_list"];
				foreach($array_kiemtra as $kiemtra)
				{
					if($list_user_view != "") $list_user_view .= ",";
					$list_user_view .= $kiemtra["list_user_view"];
				}

				if($list_user_view != "") $list_user_view = ",".$list_user_view.",";
				$array_thuchi["list_user_view"] = $list_user_view;
			}

			//nếu có tháng năm thu
			if(isset($array_thuchi["month_year"])){
				 $array_thuchi["month_year"]="01-".$array_thuchi["month_year"];
				 $array_thuchi["month_year"]=date("Y-m-d",strtotime($array_thuchi["month_year"]));
			}
			//khi trạng thái = 1 mới lưu dữ liệu vào
			//thuc hien luu du lieu
			
			if(isset($array_thuchi['id_classroom']) && $array_thuchi['id_classroom'] == "")
			{
				//lưu tên trẻ nếu không có lớp
				$array_save_customer = NULL;
				$id_save_customer = $array_thuchi["id_customer"];
				
				if($this->get_config("thuchi_save_customer") == "yes")
				{
					$array_save_customer["fullname"] = $array_thuchi["customer_name"];
					$array_save_customer["status"] = "0";
					$array_save_customer["id"] = $id_save_customer;
					
					$this->Customer->save($array_save_customer);
					if($id_save_customer == "")
					{
						$id_save_customer = $this->Customer->get_value(array("fields"=>"MAX(id)"));
						$array_thuchi["id_customer"] = $id_save_customer;
					}
				}
			}
			$this->ThuChi->save($array_thuchi);
			//
			
			//nếu đây là thu học phí thì cập nhật lại công nợ
			if($array_thuchi["group_code"]=="hocphi")
			{
			
			
				$this->loadModel("Thuchi","thu_chis");
				$this->loadModel("Arrange","arranges");
				$this->loadModel("Attendance","attendancies");
				$this->loadModel("Classroom");
				
				$this->loadModel("CustomerDebt","customer_debts");
				$this->loadModel("FeeCustomer","fee_customers");
				$this->loadModel("FeeClassroom","fee_classrooms");
		
				//require ($this->root_folder."modules_dev/school/controller/attendance_dev.php");
				//$this->tmpAt = new attendance();	

				//Cập nhật tiền thừa cho tất cả các tháng từ đây trở về sau
				//lấy danh sách tháng của lớp hiện tại
				$current_month_year =  strtotime(date("Y-m-01",strtotime($array_thuchi["month_year"])));
				$id_classroom = $array_thuchi["id_classroom"];
				
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
						
						// copy the example() method from the Foo class to the Bar class, as baz()
						//runkit_method_copy('App', 'update_debt', 'attendance', 'update_debt');
						$this->update_debt($array_thuchi["id_customer"],$array_thuchi["customer_name"],$array_thuchi["id_classroom"],$array_thuchi["classroom_name"],date("Y-m-01",$month_from),$current_month_year);
					}
				}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
				
				//dựa vào thông tin điểm danh, lưu thông tin nợ hoặc tiền thừa của trẻ trong lớp và tháng hiện tại
			}
			//*********************
			//kết thúc phần cập nhật công nợ
			
			$id_thuchi_moinhat = "";
			//Lấy id thu chi mới nhất để sau khi lưu thì chuyển sang trang chi tiết
			if($this->get_config("thuchi_detail") == "yes")
			{
				$id_thuchi_moinhat = $this->ThuChi->get_value(array("fields"=>"MAX(id)"));
			}
			
			// Tạo giá trị save_ok cho Session msg để hiển thị thông báo
			$this->Session->set_flash('msg','save_ok');

			//kiểm tra có tham số group
			//nếu có tham số group thì bổ sung vào tham số trong form
			$str_param_group = "";
			if(isset($_GET["group"])) $str_param_group .= "&group=".$_GET["group"];
					
			//kiểm tra chuyển về trang hiện tại hay trang danh sách
			if($this->get_config("thuchi_list") == "yes") $this->redirect("/thuchi/add?type=".$type."&type_account=".$type_account.$str_param_group);
			else
			{
				if($id_thuchi_moinhat != "") $this->redirect("/thuchi/chitiet/$id_thuchi_moinhat");
				//chuyen ve lai trang index
				//kiểm tra user hiện tại có chức năng quản lý dự án hay ko, //chuyen ve lai trang danh sách
				else
				{
					
				
	
					 $this->redirect("/thuchi/index.html?type=".$type."&type_account=".$type_account.$str_param_group);
				}
				return;
			}
		}

		//********************************************************************************
		//Xử lý lưu dữ liệu khi có submit data từ form
		//**********************************************************************************



		//********************************************************************************
		//Xử lý form nhập liệu thu chi
		//**********************************************************************************
		

		//kiểm tra có tham số id không, nếu có thì đọc dữ liệu thu chi theo id để hiển thị dữ liệu lên form để sửa
		if ($id!="")
		{
			$array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id'"));
			//nếu có dữ liệu
			if(isset($array_thuchi[0])) $array_thuchi = $array_thuchi[0];
		}
	

		//kiểm tra có tham số nhóm không, nếu có thì lấy code của nhóm để xác định tiêu đề và các trường khác 
		$group = "";
		$group_code = "";
		if(isset($_GET["group"]))
		{
			 $group = $_GET["group"];
			 $group_code = $this->ThuChiGroup->get_value(array("fields"=>"code","conditions"=>"id='$group'"));
			 //echo $group_code;
		}
		
		//lấy tiều đề hàm và tiêu đề người thực hiện
		$array_title = $this->get_title($type,$type_account,$group_code);


		//lấy nhóm thu chi
		$array_thuchi_group = NULL;
		$str_thuchi_group_code = "";
		$str_thuchi_group_id = "";
		$str_doituong_thu = "";
		if($this->get_config("thuchi_group") == "yes")
		{
			$this->loadModel("ThuChiGroup","thuchi_groups");

			//nếu có điều kiện type thì thêm điều kiện type
			$str_thuchi_group_condition = "";
			if($type != "") $str_thuchi_group_condition .= "(type = '$type')";

			//nếu có điều kiện type_account thì thêm điều kiện type_account
			if($type_account != "")
			{
				if($str_thuchi_group_condition != "") $str_thuchi_group_condition .= " AND";
				$str_thuchi_group_condition .= " (type_account = '$type_account')";
			}

			if(isset($_GET["group"]))
			{
				$param_group = $_GET["group"];
				if($param_group!= "")
				{
					if($str_thuchi_group_condition != "") $str_thuchi_group_condition .= " AND";
					$str_thuchi_group_condition .= " (id IN ($param_group))";	
				}	
			}
			//lấy loại thu chi tương ứng với type và type_account
			$array_thuchi_group = $this->ThuChiGroup->find("all",array("fields"=>"id,name","conditions"=>$str_thuchi_group_condition));

			///////////////////////////////////////////////////////////
			// XỬ LÝ MÃ CỦA LOẠI HÌNH PHIẾU THU, CHI
			//CÁC MÃ NHÓM HIỆN CÓ:
			//1.Nội bộ (noibo): đối tượng sẽ thu là người nội bộ
			//2.Học phí (hocphi): đối tượng sẽ thu là lớp, học sinh
			//3.Kinh doanh (kinhdoanh): đối tượng sẽ thu là khách hàng, người liên hệ khách hàng, dự án, hợp đồng
			//4.Khác (khac): hiển thị textbox để nhập
			//
			/////////////////////////////////////////////////////////////////

			//kiểm tra có id group từ form gởi lên ,
			if(isset($_POST['data']['ThuChi']['id_group'])) $str_thuchi_group_id=$_POST['data']['ThuChi']['id_group'];
			else
			{
				//kiểm tra dữ liệu khi sửa dữ liệu
				if(isset($array_thuchi['id_group'])) $str_thuchi_group_id = $array_thuchi['id_group'];
				else
				{
					//nếu không có thì lấy dòng đầu tiên trong nhóm
					if(isset($array_thuchi_group[0]["id"])) $str_thuchi_group_id = $array_thuchi_group[0]["id"];
				}
			}
			//nếu có id_group thì lấy code
			if($str_thuchi_group_id != "") $str_thuchi_group_code = $this->ThuChiGroup->get_value(array("fields"=>"code","conditions"=>"id = '$str_thuchi_group_id'"));



			//Lấy đối tượng thu dựa vào mã nhóm
			//code =  noibo thi tra ve ket qua đối tượng thu là combobox user
			//code= kinhdoanh thi tra ve ket qua danh sach khách hàng hoặc người liên lạc
			//nếu code = hocphi thì kết quả trả về sẽ là lớp, học sinh, biểu phí,học kỳ,tháng
			//nếu code = dukien thì trả về khách hàng ,dịch vụ,từ ngày đến ngày,
			//nếu code = thukhac....
			$str_doituong_thu = $this->get_doituong_thu($str_thuchi_group_code,$array_title,$array_thuchi);


			////////////////////////////////////////////////////////////////////
		}
		//END lấy nhóm thu chi


		//thực hiện việc lấy dữ liệu từ form để nhớ lại sau khi người dùng submit
		//nếu thay đổi nhóm hoặc khách hàng thì sẽ giữ lại các dữ liệu nguòi dùng nhập

		$loai_khachhang = "";
		$id_customer = "";
		$array_du_an = NULL;
		$array_taikhoan = NULL;
		$array_nguoilienlac = NULL;
		$list_user_view = "";

		//kiểm tra cấu hình thu chi có combobox tài khoản tiền gửi
		if($this->get_config("thuchi_account_money") == "yes")
		{
			$this->loadModel("AccountMoney","account_moneys");
			$array_taikhoan = $this->AccountMoney->find("all",array("fields"=>"id,name","order"=>"id DESC"));

			//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
			if($array_taikhoan != NULL)	array_unshift($array_taikhoan,array("","..."));
			else $array_taikhoan = array("","...");
		}
		///////////////////////
		
		
		
		//lấy id_customer của khách hàng được chọn
		if(isset($array_thuchi["id_customer"]))	$id_customer = $array_thuchi["id_customer"];

		$array_customer = $this->Customer->find("all",array("conditions"=>"`id` = '$id_customer'"));
		$loai_khachhang = $array_customer[0]["type"];
		/*$customer_tax=$array_customer[0]["tax_code"];
		$customer_phone=$array_customer[0]["phone"];
		$customer_address=$array_customer[0]["address"];
		$customer_id_group=$array_customer[0]["id_group"];
		$customer_group=$array_customer[0]["group"];*/


		//lấy hợp đồng khách hàng nếu có
		$array_hopdong = NULL;
		if($this->get_config("thuchi_post") == "yes") $array_hopdong = $this->Post->find("all",array("fields"=>"id,title","conditions"=>"`id_customer` = '$id_customer'"));

		if($this->get_config("thuchi_project") == "yes") $array_du_an = $this->Project->find("all",array("fields"=>"id,name","conditions"=>"`id_customer` = '$id_customer'","order"=>"id DESC"));

		$array_nguoilienlac=NULL;
		if($this->get_config("thuchi_customer_user") == "yes") $array_nguoilienlac = $this->CustomerUser->find("all",array("fields"=>"id,fullname","conditions"=>"(`id_customer` = '$id_customer') AND (`status` = '1') AND (`type` = '2')","order"=>"fullname ASC"));

		//lấy dữ liệu khách hàng từ bảng customer
		$array_khachhang = $this->Customer->find("all",array("fields"=>"id,fullname","order"=>"id DESC"));

		//nếu có dữ liệu dự án thì chèn thêm phần tử rỗng đầu tiên, nếu ko có dữ liệu thì array_du_an =  array("","...");
		if($array_khachhang != NULL)	array_unshift($array_khachhang,array("","..."));
		else $array_khachhang = array("","...");



		//lấy danh sách nhân viên
		$array_user =  $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>" (status = '1') AND (type IN (0,1))","order"=>"fullname ASC"));

		//kiểm tra nếu có tham số list thu chi thì đưa danh sách thu chi vào form nhập
		$array_list_thuchi = NULL;
		$view_thuchi_list = "";
		if($this->get_config("thuchi_list")=="yes")
		{
			
			//kiểm tra có lọc điều kiện nhóm thu chi không
			if(isset($_GET["group"]))
			{
				$str_list_thuchi_group_condition = "";
				$param_group_list_thuchi = $_GET["group"];
				if($param_group_list_thuchi != "")
				{
					$str_list_thuchi_group_condition .= " AND (id_group IN ($param_group_list_thuchi))";	
				}	
			}
			
			$sql_condition_list_thuchi = "type = '$type' AND type_account = '$type_account' $str_list_thuchi_group_condition ";
			
			//echo $sql_condition_list_thuchi;
			$array_list_thuchi = $this->ThuChi->find("all",array("conditions"=>$sql_condition_list_thuchi,"order"=>"id DESC"));
			
			$view_thuchi_list =  $this->get_thuchi_list($str_thuchi_group_code,$array_title,$array_thuchi,$array_list_thuchi);

		}
		$num = "";
		if($this->get_config("thuchi_num") == "yes")
		{
			$num_max=$this->ThuChi->find("all",array("fields"=>"MAX(`num`) as `num` ","conditions"=>"`type` = '$type' AND `type_account` = '$type_account' "));
			$num=$num_max[0]['num'];
			
			$num++;
		}
		$array_user_view = NULL;
		$array_user_view =  $this->User2->find("all",array("fields"=>"id,fullname","order"=>"id DESC","conditions"=>"`status` = '1'"));

		// Lấy kết quả từ view trả về biến hienthi.
		$hienthi = $this->View->render('add.php',array("array_title"=>$array_title,"type_account"=>$type_account,"array_thuchi"=>$array_thuchi,"array_user"=>$array_user,"array_user_view"=>$array_user_view,"array_taikhoan"=>$array_taikhoan,"array_list_thuchi"=>$array_list_thuchi,"num"=>$num,"array_thuchi_group"=>$array_thuchi_group,"str_doituong_thu"=>$str_doituong_thu,"array_khachhang"=>$array_khachhang,"array_customer"=>$array_customer,"view_thuchi_list"=>$view_thuchi_list));
		echo $hienthi;
	}
	function danhmuc_thuchi($id="")
	{
		$this->loadModel("DanhMucThuChi","thuchi_groups");
		 if($id != "")
        {
            $array_thuchi = $this->DanhMucThuChi->find("all",array("conditions"=>"id =$id"));
        }
		if(isset($_POST['data']))
		{
			$array_thuchi=$_POST['data'];
			$this->DanhMucThuChi->save($array_thuchi);
		}
		$array_danhmuc_thuchi = $this->DanhMucThuChi->find("all",array("order"=>"id DESC"));
		$hienthi = $this->View->render('danhmuc_thuchi.php',array("array_danhmuc_thuchi"=>$array_danhmuc_thuchi,"array_thuchi"=>$array_thuchi));
		echo $hienthi;
	}
	function xoa_danhmuc($id="")
	{
		 if($id != "")
        {
            $this->loadModel("DanhMucThuChi","thuchi_groups");
            $this->DanhMucThuChi->delete($id);
            $this->redirect('/thuchi/danhmuc_thuchi');
        }
	}
	function tonghop_tamhoan_ung()
	{
		$hienthi = $this->View->render('tonghop_tamhoan_ung.php',array(""));
		echo $hienthi;
	}

	function chitiet_tamhoan_ung()
	{
		$hienthi = $this->View->render('chitiet_tamhoan_ung.php',array(""));
		echo $hienthi;
	}
	function tonghop_no()
	{
		$hienthi = $this->View->render('tonghop_no.php',array(""));
		echo $hienthi;
	}
	function chitiet_no()
	{
		$this->loadModel("Customer","customers");
		$this->loadModel("Thuchi","thu_chis");
		$str_dieukien = "";
		//kiem tra co dieu kien noidung
		$noidung 	= "";
		$tungay 	= "";
		$denngay 	= "";
		$str_dieukien1 = "";

		if(isset($_POST["customer"]))
		{

			$customer = $_POST["customer"];

			if($customer!="") {$str_dieukien .= "(id_customer = $customer )";$str_dieukien1 .= "(id_customer = $customer )"; }
		}

		//kiem tra co dieu kien tungay
		if(isset($_POST["tungay"]))
		{

			$tungay = $_POST["tungay"];

			if($tungay!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tmp_tungay = date("Y-m-d",strtotime($tungay));
				if($str_dieukien!="")
				{
				$str_dieukien .= " AND " ;
				$str_dieukien .= " (issued_date  >= '$tmp_tungay')  ";
				$str_dieukien1 .= " AND " ;
				$str_dieukien1 .= " (issued_date  < '$tmp_tungay')  ";

				}

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

				if($str_dieukien!="")
				$str_dieukien .= " AND " ;
				$str_dieukien .= " (issued_date  <= '$tmp_denngay') ";

			}
		}
		if(isset($_GET['type']))
		{
			$type = $_GET['type'];
			if($type!="")
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL


				if($str_dieukien!="")
				{
					$str_dieukien .= " AND " ;
					$str_dieukien .= " type = $type AND `type_account` =1";
					$str_dieukien1 .= " AND " ;
					$str_dieukien1 .= " type = $type AND `type_account` =1";
				}

			}
		}

		$array_thuchi = $this->Thuchi->find('all',array("conditions"=>"$str_dieukien","order"=>"id DESC"));
		$array_max = $this->Thuchi->find('all',array("fields"=>"SUM(amount)","conditions"=>"$str_dieukien1",));
		$max_amount=$array_max[0]['SUM(amount)'];
		echo $max_amount;
		$array_customer=$this->Customer->find("all",array("fields"=>"id,fullname"));
		$hienthi = $this->View->render('chitiet_no.php',array("array_customer"=>$array_customer,"array_thuchi"=>$array_thuchi,
		"customer"=>$customer,"tungay"=>$tungay,"denngay"=>$denngay,"max_amount"=>$max_amount));
		echo $hienthi;
	}

	function get_title($type = "",$type_account = "",$group_code = "")
	{
		//tieu de cuget_titlea ham
		//xử lý người thực hiện
		//đối phiếu thu: người thực hiện là người thu
		//đối phiếu chi: người thực hiện là người chi
		//đối phiếu ghi nợ: người thực hiện là người nhập
		//đối phiếu nợ phải trả: người thực hiện là người nhập
		//đối phiếu tạm ứng: người thực hiện là người chi
		//đối phiếu hoàn ứng: người thực hiện là người thu
		//đối phiếu dự kiến thu: người thực hiện là người nhập

		$function_title = "";
		$str_tennguoi_thuchien_label = "";
		$str_tennguoi_giaodich_label = "";
		$function_title_list = "";
		if($type == "0")
		{
			if($type_account == "0")
			{
				$function_title = "Tạo Phiếu Thu";
				if($group_code == "nokinhdoanh") $function_title = "Tạo Phiếu Thu Nợ Kinh Doanh";
				
				$str_tennguoi_thuchien_label = "Người thu";
				$str_tennguoi_giaodich_label = "Người nộp";
				$function_title_list = "Danh Sách Thu";
			}
			if($type_account == "1")
			{
				$function_title = "Tạo Phiếu Thu Nợ";
				$str_tennguoi_thuchien_label = "Người nhập";
				$str_tennguoi_giaodich_label = "Người nợ";
				$function_title_list = "Danh Sách Nợ Phải Thu";
			}
			if($type_account == "2")
			{
				$function_title = "Tạo Phiếu Thu Hoàn Ứng";
				$str_tennguoi_thuchien_label = "Người thu";
				$str_tennguoi_giaodich_label = "Người nộp";
				$function_title_list = "Danh Sách  Hoàn Ứng";
			}
			if($type_account == "3")
			{
				$function_title = "Tạo Phiếu Dự Kiến Thu";
				$str_tennguoi_thuchien_label = "Người thu";
				$str_tennguoi_giaodich_label = "Khách hàng";
				$function_title_list = "Danh Sách Dự Kiến Thu";
			}
		}

		if($type == "1")
		{
			if($type_account == "0")
			{
				$function_title = "Tạo Phiếu Chi";
				if($group_code == "nokinhdoanh") $function_title = "Tạo Phiếu Chi Nợ Kinh Doanh";				
				$str_tennguoi_thuchien_label = "Người chi";
				$str_tennguoi_giaodich_label = "Người nhận";
				$function_title_list = "Danh Sách  Chi";
			}
			if($type_account == "1")
			{
				$function_title = "Tạo Phiếu Ghi Nợ Phải Trả";
				$str_tennguoi_thuchien_label = "Người nhập";
				$str_tennguoi_giaodich_label = "Khách hàng";
				$function_title_list = "Danh Sách  Nợ Phải Trả";
			}
			if($type_account == "2")
			{
				$function_title = "Tạo Phiếu Chi Tạm Ứng";
				$str_tennguoi_thuchien_label = "Người chi";
				$str_tennguoi_giaodich_label = "Người nhận";
				$function_title_list = "Danh Sách  Chi Tạm Ứng ̉";
			}
			if($type_account == "3")
			{
				$function_title = "Tạo Phiếu Dự Kiến Chi";
				$str_tennguoi_thuchien_label = "Người chi";
				$str_tennguoi_giaodich_label = "Người nhận";
				$function_title_list = "Danh Sách Dự Kiến Chi";
			}
		}
		return array("function_title"=>$function_title,"user_title"=>$str_tennguoi_thuchien_label,"customer_title"=>$str_tennguoi_giaodich_label,"function_title_list"=>$function_title_list,"type"=>$type,"type_account"=>$type_account);
	}

	function thuchi_hocphi($code = "",$array_title = NULL,$array_thuchi = NULL)
	{
		///////////////////////////////////////
		//1. lấy danh sách lớp

		$this->loadModel("Classroom","classrooms");

		$array_lophoc = $this->Classroom->find('all',array("fields"=>"id,name","order"=>"id DESC"));
		if($array_lophoc != NULL)	array_unshift($array_lophoc,array("","..."));
		else $array_lophoc = array("","...");
		// kết thúc lấy danh sách lớp


			//2. Lấy danh sách học sinh
			$array_hocsinh = NULL;
			$id_classroom = "";
			$id_customer ="";

			//kiểm tra dữ liệu id_classroom từ array_thuchi thì nó lấy array học sinh theo id_classroom
			if($array_thuchi != NULL)
			{
				 $id_classroom = $array_thuchi['id_classroom'];
				 $id_customer = $array_thuchi['id_customer'];
			}

			//kiểm tra id_clasroom từ form không (khi người dùng thay đổi lớp học)
			if(isset($_POST['data']['ThuChi']['id_classroom'])) $id_classroom =$_POST['data']['ThuChi']['id_classroom'];


			//nếu có id_classroom thì lấy danh sách học sinh của lớp đó trong bảng xếp lớp Arrange
			$array_month_year_current_class = NULL;
			$array_current_class_info = NULL;
			if($id_classroom != "")
			{
				$this->loadModel("Arrange","arranges");
				$array_hocsinh = $this->Arrange->find('all',array("fields"=>"id_fullname,fullname","order"=>"fullname ASC","conditions"=>"`type` = '0' AND `id_classroom` = '$id_classroom' AND `status` = '1'"));

				//lấy thông tin của lớp hiện tại
				$array_current_class_info = $this->Classroom->find('all',array("conditions"=>" `id` = '$id_classroom'"));
				
				$str_class_room_from = "";
				$str_class_room_to = "";				
				if($array_current_class_info)
				{
					$str_class_room_from = $array_current_class_info[0]["from"];
					$str_class_room_to = $array_current_class_info[0]["to"];
					
					
					$month_from = strtotime(date("Y-m-01",strtotime($str_class_room_from)));
					$month_to =   strtotime(date("Y-m-01",strtotime($str_class_room_to)));;
					$num_month =0;
					do {
						$str_class_month = date("m-Y",$month_from);
						$array_month_year_current_class[$str_class_month] = $str_class_month;
					}while (($month_from = strtotime("+1 MONTH", $month_from)) <= $month_to);
						
				} //end if array_current_class_info
			}//end if id_classroom
			
			
			if($array_hocsinh != NULL)	array_unshift($array_hocsinh,array("","..."));
			else $array_hocsinh = array("","...");

			//lấy id học sinh đang chọn

			if(isset($_POST['data']['ThuChi']['id_customer'])) $id_customer =$_POST['data']['ThuChi']['id_customer'];




			//Lấy biểu phí học sinh từ fee_customers theo id_customer
			//kiểm tra học sinh đó có thêm dịch vụ khác không
			$array_fee_customers = NULL;
			if($id_customer != "")
			{
				$this->loadModel("FeeCustomer","fee_customers");
				
				
				$month_year = "";
				$str_dk_month_year = "";
				if(isset($_POST['data']['ThuChi']['month_year'])) $month_year =$_POST['data']['ThuChi']['month_year'];
				if($month_year!="")
				{	
					//echo "1:".$month_year;
					$month_year = "01-".$month_year;
					$month_year = date("Y-m-01",strtotime($month_year));
					$str_dk_month_year = " AND month_year = '$month_year'";	
				}

				
				//echo "`id_customer` = '$id_customer' AND `id_classroom` = '$id_classroom' $str_dk_month_year";
				//nếu có thì lấy biểu phí của học sinh đó trong bảng FeeCustomer
				$array_fee_customers = $this->FeeCustomer->find('all',array("conditions"=>"`id_customer` = '$id_customer' AND `id_classroom` = '$id_classroom' $str_dk_month_year"));

				//nếu học sinh đó không sử dụng dịch vụ thêm thì lấy biểu phí chung của lớp trong bảng Fee
				if($array_fee_customers == NULL)
				{
					$this->loadModel("FeeClassroom","fee_classrooms");

					//lấy id fee từ bảng FeeClassroom để lấy biểu phí chung của lớp trong bảng Fee
					$id_fee = $this->FeeClassroom->get_value(array("fields"=>"id_fee","conditions"=>"`id_classroom` = '$id_classroom'"));
					if($id_fee != "")
					{
						$this->loadModel("Fee","fees");
						$array_fee_customers = $this->Fee->find('all',array("conditions"=>"`id` = '$id_fee'"));
					}
				}
			}
			//END kiểm tra học sinh đó có thêm dịch vụ khác không
			 return $this->View->render('thu_hocphi.php',array("array_title"=>$array_title,"array_lophoc"=>$array_lophoc,"array_hocsinh"=>$array_hocsinh,"id_classroom"=>$id_classroom,"array_fee_customers"=>$array_fee_customers,"id_customer"=>$id_customer,"array_thuchi"=>$array_thuchi,"array_month_year_current_class"=>$array_month_year_current_class),false);

		/////////////////////////////////
		//End function
	}
	
	
	function thuchi_kinhdoanh($code = "",$array_title = NULL,$array_thuchi = NULL)
	{

		$this->loadModel("Customer","customers");
		$id_customer = "";
		$array_customer = NULL;
		$type = "";

		if(isset($_POST['data']['ThuChi']['id_customer']))	$id_customer = $_POST['data']['ThuChi']['id_customer'];
		if($array_thuchi) $id_customer = $array_thuchi['id_customer'];
		$array_customer_detail = $this->Customer->find("all",array("conditions"=>"`id` = '$id_customer'"));


		//lấy type và accountype
		if(isset($_GET['type'])) $type = $_GET['type'];


		// Lấy khách hàng theo thu chi nợ theo config
		$str_condition_customer = $this->get_config("thuchi_customer_$type");
		if($str_condition_customer != "thuchi_customer_$type")
		{
			$str_condition_customer = "id_group IN ($str_condition_customer)";

		}else $str_condition_customer = "";
		
		// Lấy người liên lạc theo thu chi nợ theo config
		//$str_condition_customer = $this->get_config("thuchi_customer_$type");
		$array_nguoilienlac = NULL;
		if($this->get_config("thuchi_customer_nguoilienlac") == "yes")
		{
			$this->loadModel("User2","users");
			$array_nguoilienlac = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"(`id_customer` = '$id_customer') AND (`status` = '1') AND (`type` = '2') "));
			
		}

		$array_customer = $this->Customer->find("all",array("fields"=>"id,concat(code, ' - ',fullname)","order"=>"id DESC","conditions"=>$str_condition_customer));
		return $this->View->render('thu_kinhdoanh.php',array("array_title"=>$array_title,"array_nguoilienlac"=>$array_nguoilienlac,"array_customer_detail"=>$array_customer_detail,"id_customer"=>$id_customer,"array_customer"=>$array_customer,"array_thuchi"=>$array_thuchi),false);
	}
	

	function thuchi_nokinhdoanh($code = "",$array_title = NULL,$array_thuchi = NULL)
	{


		$this->loadModel("Customer","customers");
		$id_customer = "";
		$array_customer = NULL;
		$type = "";

		//nếu có biến id_customer từ form submit lên thì lấy để nhớ lại thông tin khách hàng đã chọn
		if(isset($_POST['data']['ThuChi']['id_customer']))	$id_customer = $_POST['data']['ThuChi']['id_customer'];
		if($array_thuchi) $id_customer = $array_thuchi['id_customer'];
		$array_customer_detail = $this->Customer->find("all",array("conditions"=>"`id` = '$id_customer'"));


		//lấy type và accountype
		if(isset($_GET['type'])) $type = $_GET['type'];


		// Lấy khách hàng theo thu chi nợ theo config
		$str_condition_customer = $this->get_config("thuchi_customer_$type");
		if($str_condition_customer != "thuchi_customer_$type")
		{
			$str_condition_customer = "id_group IN ($str_condition_customer)";

		}else $str_condition_customer = "";
		
		// Lấy người liên lạc theo thu chi nợ theo config
		//$str_condition_customer = $this->get_config("thuchi_customer_$type");
		$array_nguoilienlac = NULL;
		if($this->get_config("thuchi_customer_nguoilienlac") == "yes")
		{
			$this->loadModel("User2","users");
			$array_nguoilienlac = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"(`id_customer` = '$id_customer') AND (`status` = '1') AND (`type` = '2') "));
			
		}

		//lấy danh sách khách hàng từ bảng khách hàng
		$array_customer = $this->Customer->find("all",array("fields"=>"id,concat(code,' - ',fullname)","order"=>"id DESC","conditions"=>$str_condition_customer));
		return $this->View->render('thuchi_nokinhdoanh.php',array("array_title"=>$array_title,"array_nguoilienlac"=>$array_nguoilienlac,"array_customer_detail"=>$array_customer_detail,"id_customer"=>$id_customer,"array_customer"=>$array_customer,"array_thuchi"=>$array_thuchi),false);
	}
	
	function get_doituong_thu($code = "",$array_title = NULL,$array_thuchi=NULL)
	{

		if($code == "hocphi") return $this->thuchi_hocphi($code ,$array_title,$array_thuchi);

		if($code == "kinhdoanh") return $this->thuchi_kinhdoanh($code ,$array_title,$array_thuchi);
		if($code == "nokinhdoanh") return $this->thuchi_nokinhdoanh($code ,$array_title,$array_thuchi);

		if($code == "khac")
		{
			return $this->View->render('thu_khac.php',array("array_title"=>$array_title,"array_thuchi"=>$array_thuchi),false);
		}
		if($code == "noibo") 
		{
			$str_doituong_thu = "noibo";
			$this->loadModel("User2","users");
			$array_user_noibo = $this->User2->find("all",array("fields"=>"id,fullname","conditions"=>"(`status` = '1') AND (`type` = '0' OR `type` = '1') "));
			
			return $this->View->render('thu_noibo.php',array("array_title"=>$array_title,"array_user_noibo"=>$array_user_noibo,"array_thuchi"=>$array_thuchi),false);
		}
	}
	function get_thuchi_list($code = "",$array_title = NULL,$array_thuchi=NULL,$array_list_thuchi = NULL)
	{
		//trường hợp thu
		if($array_title["type"] == 0)
		{
			//danh sách thu 
			if($array_title["type_account"] == 0)  return $this->View->render("thuchi_list_thu.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 1)  return $this->View->render("thuchi_list_thu_no.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 2)  return $this->View->render("thuchi_list_thu_hoanung.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 3)  return $this->View->render("thuchi_list_thu_dukien.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
		}
		
		//trường hợp chi
		if($array_title["type"] == 1)
		{
			//danh sách chi 
			if($array_title["type_account"] == 0)  return $this->View->render("thuchi_list_chi.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 1)  return $this->View->render("thuchi_list_chi_no.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 2)  return $this->View->render("thuchi_list_chi_hoanung.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
			if($array_title["type_account"] == 3)  return $this->View->render("thuchi_list_chi_dukien.php",array("array_list_thuchi"=>$array_list_thuchi,"array_title"=>$array_title),false);
		}
		
		
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
		   
		   					   
		   $songay_dihoc = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND `date`>= '$ngay_dauthang' AND `date`<= '$ngay_cuoithang' AND	sat =0"));
		   $songay_dihoc_theobuoi = $this->Attendance->get_value(array("fields"=>" SUM( CASE WHEN full_day =1 THEN 1 ELSE 0.5 END ) as songay_theobuoi ","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND `date`>= '$ngay_dauthang' AND `date`<= '$ngay_cuoithang' AND	sat =0"));
		   
		   $songay_dihoc_thu7 = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND date>= '$ngay_dauthang' AND date<= '$ngay_cuoithang' AND	sat =1"));
		   $songay_antoi   = $this->Attendance->get_value(array("fields"=>" COUNT(id) as songay_dihoc","conditions"=>" id_user = '$id_customer' AND id_classroom = '$id_classroom' AND date>= '$ngay_dauthang' AND date<= '$ngay_cuoithang' AND antoi = 1 "));

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
	
}
?>