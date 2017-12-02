<?php
class revenue extends Main
{
	function add($id='')
	{
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi","revenues");
		$this->loadModel("Classroom","classrooms");
		$this->loadModel("HocSinh","customers");
		$this->loadModel("NguoiThu","users");
		
		$array_lop_hoc = $this->Classroom->find("all",array("fields"=>"id,name","order"=>"name ASC"));
		
		$array_hocsinh = $this->HocSinh->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		
		$array_nguoithu = $this->NguoiThu->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		
		//thực hiện việc lấy dữ liệu từ form để nhớ lại sau khi người dùng submit 
		//nếu thay đổi nhóm hoặc khách hàng thì sẽ giữ lại các dữ liệu nguòi dùng nhập
		$array_thuchi = NULL;
		
		if(isset($_POST['data']))
		{
			//tạo array = du lieu tu nguoi dung nhap vao
			$array_thuchi = $_POST['data']['ThuChi'];
			$array_thuchi["issued_date"] = date("Y-m-d",strtotime($array_thuchi["issued_date"]));
			$array_thuchi["created_username"] = $this->User->username;
			$array_thuchi["id_created_user"] = $this->User->id;
			
			//khi trạng thái = 1 mới lưu dữ liệu vào				
			if($array_thuchi["trangthai"] == 1)
			{
				//thuc hien luu du lieu
				$this->ThuChi->save($array_thuchi);
				
				$this->redirect("/revenue/add.html");
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
		
		$array_quanly_thuchi = $this->ThuChi->find("all",array("order"=>"id DESC","limit"=>"1"));
		
		// Lấy kết quả từ view trả về biến hienthi.
		$hienthi = $this->View->render('nhap_thuchi.php',array("array_thuchi"=>$array_thuchi,"array_lop_hoc"=>$array_lop_hoc,"array_hocsinh"=>$array_hocsinh,"array_nguoithu"=>$array_nguoithu,"array_quanly_thuchi"=>$array_quanly_thuchi));
		echo $hienthi;
	}
	
	function del($id='')
	{
		$table_prefix = "";		
		if(isset($this->Company->table_prefix))	$table_prefix = $this->Company->table_prefix;
		// Load dữ liệu từ table thu_chis sang đối tượng HotelThuChi.
		$this->loadModel("ThuChi","revenues");
		
		// Thực hiện lệnh xóa 
		$this->ThuChi->delete($id);
		
		// Chuyển sang trang danh sách
		$this->redirect("/revenue/index.html");
		return;
	}
	
	function index()
	{
		//lấy ra model dữ liệu
		$this->loadModel("ThuChi","revenues");
		$this->loadModel("Classroom","classrooms");
		$this->loadModel("HocSinh","customers");
		$this->loadModel("NguoiThu","users");
		
		$array_lop_hoc = $this->Classroom->find("all",array("fields"=>"id,name","order"=>"name ASC"));
		
		$array_hocsinh = $this->HocSinh->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		
		$array_nguoithu = $this->NguoiThu->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		
		$dieukien = "";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			$dieukien_tim = str_replace("'","''",$tim);
			if($tim != "") $dieukien = "(`username` LIKE '%$dieukien_tim%') OR (`post_title` LIKE '%$dieukien_tim%') OR (`post_number` LIKE '%$dieukien_tim%') OR (`customer_name` LIKE '%$dieukien_tim%') OR (`project_name` LIKE '%$dieukien_tim%')";
				
		}
		
		$type = "";
		if(isset($_GET["loai"]))
		{
			$type = $_GET["loai"];
			$dieukien_type = str_replace("'","''",$type);
			if($type != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`type` = '$dieukien_type')";	
			}
		}
		
		$tungay = "";
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
		
		//truy vấn dữ liệu
		$array_thuchi = $this->ThuChi->find("all",array("order"=>"id DESC","conditions"=>"$dieukien"));
		
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
		
		$danhsach = $this->View->render('quanly_thuchi.php',array("array_thuchi"=>$array_thuchi,"array_lop_hoc"=>$array_lop_hoc,"array_hocsinh"=>$array_hocsinh,"array_nguoithu"=>$array_nguoithu,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay,"type"=>$type,"output"=>$output));
		echo $danhsach;	
	}
	
	function theodoi_no()
	{
		
		//lấy ra model dữ liệu
		$this->loadModel("ThuChi","revenues");
		$this->loadModel("Arrange","arranges");
		$this->loadModel("HocSinh","customers");
		$this->loadModel("BieuPhiHocSinh","fee_customers");
		$this->loadModel("NguoiThu","users");
		$this->loadModel("LopHoc","classrooms");
		
		
		
		
		$str_dieukien_tongthu = "";
		$str_dieukien_thongke_no = "";
		$str_diekien_diemdanh = "";
		$str_diekien_tongngay_dihoc = "";
		$tim = "";
		
		
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			if($tim!="")			
			{
				if($str_dieukien_thongke_no != "") $str_dieukien_thongke_no .=" AND ";
				$str_dieukien_thongke_no .= " (customer_name LIKE '%$tim%')";
			}	
		}
		
		$tableprefix = $this->Company->table_prefix;
		
		
		
		$array_lop_hoc = NULL;
		$array_lop_hoc = $this->LopHoc->find("all",array("fields"=>"id,name","order"=>"name ASC"));
		
		
		$lop = "";
		$dieukien_lop_combo = "(`status` = '1') AND (`type` = '0')";
		$dieukien_lop = "";
		$dieukien_lop_A = "";
		if(isset($_GET["lop"]))
		{
			$lop = $_GET["lop"];
			if($lop!="")			
			{
				$dieukien_lop_A = " AND  (A.`id_classroom` = '$lop')";
				$dieukien_lop = " AND (`id_classroom` = '$lop')";
				$dieukien_lop_combo .= " AND (`id_classroom` = '$lop')";
			}	
		}
		
		$hocsinh = "";
		$dieukien_hocsinh_A = "";
		$dieukien_hocsinh = "";
		$dieukien_hocsinh_diemdanh = "";
		if(isset($_GET["hocsinh"]))
		{
			$hocsinh = $_GET["hocsinh"];
			if($hocsinh!="")			
			{
				$dieukien_hocsinh_A = " AND (A.`id_fullname` = '$hocsinh')";
				$dieukien_hocsinh = " AND (`id_customer` = '$hocsinh')";
				$dieukien_hocsinh_diemdanh = " AND (`id_user` = '$hocsinh')";
			}	
		}
		$array_hocsinh = NULL;
		$array_hocsinh = $this->Arrange->find("all",array("fields"=>"id_fullname,fullname","order"=>"fullname ASC","conditions"=>$dieukien_lop_combo));
		
		
		//lấy điều kiện ngày xem thống kê
		$tungay = date("Y-m-01");
		$denngay = date("Y-m-d");
		
		//kiem tra co dieu kien tungay
		if(isset($_GET["tungay"]))
		{
			$tungay = $_GET["tungay"];
			if($tungay!="")			
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tungay = date("Y-m-01",strtotime($tungay));
			}else
			{
				$tungay = date("Y-m-01");
			}
		}		
		//kiem tra co dieu kien tungay
		if(isset($_GET["denngay"]))
		{
			$denngay = $_GET["denngay"];
			if($denngay!="")			
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$denngay = date("Y-m-d",strtotime($denngay));
			}else
			{
				$denngay = date("Y-m-d");
			}	
		}
		
		$dieukien = "AND (C.`month_year` >= '$tungay') AND (C.`month_year` <= '$denngay')";
		
		$sql_colum_ABC = " AB.* , IF( AB.`month_year` IS NULL , C.`month_year` , AB.`month_year` ) AS thang, IF(AB.`total_amount` IS NULL, C.`total_price`,AB.`total_amount`) AS `sotien_dukien`, IF(AB.`num_day` IS NULL, C.`num_day`,AB.`num_day`) AS songay_dukien, IF( AB.`str_service` IS NULL , C.`str_service` , AB.`str_service` ) AS dichvu";
		$sql_colum_AB = "A.`classroom_name` , A.`id_classroom` , A.`fullname` , A.`id_fullname` , B.`month_year`, B.`total_amount`, B.`num_day`,B.`str_service`";
		$sql_hocsinh = "SELECT $sql_colum_ABC FROM 
							(SELECT 	$sql_colum_AB
							FROM `".$tableprefix."arranges` AS A
							LEFT JOIN 
								(SELECT `month_year`, `total_amount`, `num_day`, `id_classroom`, `id_customer`,`str_service` FROM `".$tableprefix."fee_customers` WHERE   `month_year` >=  '$tungay' AND  `month_year` <=  '$denngay' $dieukien_lop $dieukien_hocsinh) AS B
						   		 ON ( A.`id_classroom` = B.`id_classroom` ) AND (A.`id_fullname` = B.`id_customer`)	
							WHERE (A.`type` =  '0') AND (A.`status` =  '1') $dieukien_lop_A $dieukien_hocsinh_A) AS AB
						LEFT JOIN  (
							SELECT `total_price` ,`num_day`,`month_year`, `id_classroom`, `str_service`
							FROM  `".$tableprefix."fee_classrooms` 
							WHERE  `month_year` >=  '$tungay' AND  `month_year` <=  '$denngay' $dieukien_lop
							) AS C ON AB.`id_classroom` = C.`id_classroom`
		 ";
		
			//echo $sql_hocsinh;

		$dieukien_sotien_dathu = "(`type` =  '0') AND (`type_account` =  '0') AND (`month_year` >= '$tungay') AND (`month_year` <= '$denngay') $dieukien_lop $dieukien_hocsinh";
			
		$sql_sothien_dathu = "SELECT SUM(  `amount` ) AS sotien_danop,  `id_classroom` AS id_classroom_2 ,  `id_customer` AS id_customer_2 
							FROM ".$tableprefix."thu_chis
							WHERE $dieukien_sotien_dathu
							GROUP BY  `id_classroom` ,  `id_customer` ,  `month_year` ";
							
		$sql_tienthua_sotien_dathu = "SELECT D.*,E.* FROM ($sql_hocsinh) AS D 
									  LEFT JOIN ($sql_sothien_dathu) AS E ON (D.`id_classroom` = E.`id_classroom_2`) AND (D.`id_fullname` = E.`id_customer_2`) ";						
		
		//echo $sql_sothien_dathu;
		$sql_col_diemdanh = " `id_user` ,  `id_classroom` , SUM( IF( `status` = 1 AND `sat` = 0, 1, 0 ) ) AS songay_dihoc, SUM( IF(`status` = 0 AND `sat` = 0, 1, 0 ) ) AS songay_nghi , SUM(IF(`status` =1 AND `sat` =1, 1, 0 )) AS songay_dihoc_thu7, SUM(IF(`status` =1 AND `antoi` =1, 1, 0 )) AS songay_antoi";
		
		$sql_diemdanh = "SELECT $sql_col_diemdanh FROM  `".$tableprefix."attendancies` WHERE `approve` =  '1' AND type = 0 $dieukien_lop $dieukien_hocsinh_diemdanh
				AND  `date` >=  '$tungay'
				AND  `date` <=  '$denngay'
				 GROUP BY  `id_user` , `id_classroom`
				";
				
		//echo $sql_diemdanh;		
		
		$sql_tienno = "SELECT dathu.*, diemdanh.* FROM ($sql_tienthua_sotien_dathu) AS dathu 
						LEFT JOIN ($sql_diemdanh) AS diemdanh
						ON dathu.id_classroom = diemdanh.id_classroom AND dathu.id_fullname = diemdanh.id_user";
		//echo $sql_tienthua;
		$array_thongke_tienno = $this->BieuPhiHocSinh->query($sql_tienno);
		
		
		
		$danhsach = $this->View->render('theodoi_congno.php',array("lop"=>$lop,"hocsinh"=>$hocsinh,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay,"array_lop_hoc"=>$array_lop_hoc,"array_hocsinh"=>$array_hocsinh,"array_thongke_tienno"=>$array_thongke_tienno));
		echo $danhsach;	
			
	}


	function theodoi_thua2()
	{

		$this->loadModel("LopHoc","classrooms");
		$this->loadModel("HocSinh","customers");

	}
	
	function theodoi_thua()
	{
		
		//lấy ra model dữ liệu
		$this->loadModel("ThuChi","revenues");
		$this->loadModel("Arrange","arranges");
		$this->loadModel("HocSinh","customers");
		$this->loadModel("BieuPhiHocSinh","fee_customers");
		$this->loadModel("NguoiThu","users");
		$this->loadModel("LopHoc","classrooms");
		
		
		$str_dieukien_tim = "";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			if($tim!="")			
			{
				if($str_dieukien_tim != "") $str_dieukien_tim .=" AND ";
				$str_dieukien_tim .= " (customer_name LIKE '%$tim%')";
			}	
		}
		
		
		
		
		$array_lop_hoc = NULL;
		$array_lop_hoc = $this->LopHoc->find("all",array("fields"=>"id,name","order"=>"name ASC"));
		
		
		$lop = "";
		$dieukien_lop_combo = "(`status` = '1') AND (`type` = '0')";
		if(isset($_GET["lop"]))
		{
			$lop = $_GET["lop"];
			if($lop!="")			
			{
				$dieukien_lop_combo .= " AND (`id_classroom` = '$lop')";
				
				if($str_dieukien_tim != "") $str_dieukien_tim .=" AND ";
				$str_dieukien_tim .= " (`id_classroom` = '$lop')";
			}	
		}
		
		$hocsinh = "";
		if(isset($_GET["hocsinh"]))
		{
			$hocsinh = $_GET["hocsinh"];
			if($hocsinh!="")
			{
				if($str_dieukien_tim != "") $str_dieukien_tim .=" AND ";
				$str_dieukien_tim .= " (`id_customer` = '$hocsinh')";			
			}
		}
		$array_hocsinh = NULL;
		$array_hocsinh = $this->Arrange->find("all",array("fields"=>"id_fullname,fullname","order"=>"fullname ASC","conditions"=>$dieukien_lop_combo));
		
		
		//lấy điều kiện ngày xem thống kê
		$tungay = date("Y-m-01");
		$denngay = date("Y-m-d");
		
		//kiem tra co dieu kien tungay
		if(isset($_GET["tungay"]))
		{
			$tungay = $_GET["tungay"];
			if($tungay!="")			
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$tungay = date("Y-m-01",strtotime($tungay));
			}else
			{
				$tungay = date("Y-m-01");
			}
			
			if($str_dieukien_tim != "") $str_dieukien_tim .=" AND ";
			$str_dieukien_tim .= " (month_year >= '$tungay')";			
		}		
		//kiem tra co dieu kien tungay
		if(isset($_GET["denngay"]))
		{
			$denngay = $_GET["denngay"];
			if($denngay!="")			
			{
				//chuyen ve lai dinh dang Y-m-d de tim kiem trong SQL
				$denngay = date("Y-m-d",strtotime($denngay));
			}else
			{
				$denngay = date("Y-m-d");
			}	

			if($str_dieukien_tim != "") $str_dieukien_tim .=" AND ";
			$str_dieukien_tim .= " (month_year <= '$denngay')";			
		}		
			
		
			
		
		
		
		//echo $str_dieukien_tim;
		
		$this->loadModel("CustomerDebt","customer_debts");
		
		$array_thongke_tienthua = $this->CustomerDebt->find('all',array("conditions"=>$str_dieukien_tim,"order"=>" month_year ASC, id_customer ASC"));
		
		$this->loadModel("ClassroomService","classroom_services");
	
		//lấy thông tin ăn tối, phụ phí ăn tối trong bảng dịch vụ cho trường hợp truy thu
		$dichvu_dukien_antoi = $this->ClassroomService->get_value(array("fields"=>"price","conditions"=>"code='antoi'"));
		$dichvu_dukien_phuphitoi = $this->ClassroomService->get_value(array("fields"=>"price","conditions"=>"code='phuphitoi'"));
		$dichvu_dukien_thu7 = $this->ClassroomService->get_value(array("fields"=>"price","conditions"=>"code='tienthu7'"));		
		
		$danhsach = $this->View->render('theodoi_tienthua.php',array("lop"=>$lop,"hocsinh"=>$hocsinh,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay,"array_lop_hoc"=>$array_lop_hoc,"array_hocsinh"=>$array_hocsinh,"array_thongke_tienthua"=>$array_thongke_tienthua,
								"dichvu_dukien_antoi"=>$dichvu_dukien_antoi,"dichvu_dukien_phuphitoi"=>$dichvu_dukien_phuphitoi,
								"dichvu_dukien_thu7"=>$dichvu_dukien_thu7
								));
		echo $danhsach;	
			
	}
	
	function soquy_tienmat()
	{
		//lấy ra model dữ liệu
		$this->loadModel("ThuChi","thu_chis");
		
		$dieukien = "(`type_account` = '0')";
		$dieukien_ton_dau_ky = "(`type_account` = '0')";
			
		$id_user = "";
        if(isset($_GET['id_user']))
        {
            $id_user = $_GET['id_user'];
			if($id_user != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_user` = '$id_user')";	
				$dieukien_ton_dau_ky .= " AND (`id_user` = '$id_user')";	
			}
        }	
			
		$tungay = date("01-m-Y");
        if(isset($_GET['tungay']))
        {
            $tungay = $_GET['tungay'];
			$dieukien_tungay = date("Y-m-d",strtotime($tungay));
			if($dieukien_tungay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`issued_date` >= '$dieukien_tungay')";	
				$dieukien_ton_dau_ky .= " AND (`issued_date` < '$dieukien_tungay')";	
			}
        }else
		{ 
			$dieukien .= " AND (`issued_date` >= '".date("Y-m-d",strtotime($tungay))."')";
			$dieukien_ton_dau_ky .= " AND (`issued_date` < '".date("Y-m-d",strtotime($tungay))."')";
		}
		
		$denngay = date("t-m-Y");
        if(isset($_GET['denngay']))
        {
            $denngay = $_GET['denngay'];
			$dieukien_denngay = date("Y-m-d",strtotime($denngay));
			if($dieukien_denngay != "1970-01-01")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`issued_date` <= '$dieukien_denngay')";	
			}
        }else $dieukien .= " AND (`issued_date` <= '".date("Y-m-d",strtotime($denngay))."')";
		
		//truy vấn dữ liệu
		$array_thuchi = $this->ThuChi->find("all",array("order"=>"issued_date ASC","conditions"=>$dieukien));
		
		//lấy ra danh sách user
		$this->loadModel("NguoiNhapChungTu","users");
		$array_user = $this->NguoiNhapChungTu->find("all",array("fields"=>"id,fullname","order"=>"fullname ASC"));
		if($array_user != NULL)	array_unshift($array_user,array("","..."));
		else $array_user = array("","...");
		
		$ton_dau_ky = $this->ThuChi->get_value(array("fields"=>"SUM(IF(type = '0', amount , 0 )) - SUM(IF(type = '1', amount , 0 ))","conditions"=>$dieukien_ton_dau_ky));
		if($ton_dau_ky == "") $ton_dau_ky = 0;
	
		$danhsach = $this->View->render('soquy_tienmat.php',array("array_thuchi"=>$array_thuchi,"tungay"=>$tungay,"denngay"=>$denngay,"id_user"=>$id_user,"array_user"=>$array_user,"ton_dau_ky"=>$ton_dau_ky));
		echo $danhsach;	
	}
	
	function phieu_thu_hoc_phi($id = "")
	{
		$this->loadModel("ThuChi","thu_chis");
		
		$array_thuchi=NULL;
		$type = "";
		if($id!="")
		{ 
			$array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id' "));
			
			$id_customer = $array_thuchi[0]["id_customer"];
			$id_classroom = $array_thuchi[0]["id_classroom"];
			$month_year = $array_thuchi[0]["month_year"];
		}
		
		$array_bieuphi = NULL;
		if($this->get_config("thuchi_chitiet_bieuphi") == "yes")
		{
			$this->loadModel("FeeCustomer","fee_customers");
			$array_bieuphi = $this->FeeCustomer->find("all",array("conditions"=>"`id_customer` = '$id_customer' AND `id_classroom` = '$id_classroom' AND `month_year` = '$month_year'"));
			if($array_bieuphi == NULL)
			{
				$this->loadModel("FeeClassroom","fee_classrooms");
				$array_bieuphi = $this->FeeClassroom->find("all",array("conditions"=>"`id_classroom` = '$id_classroom' AND `month_year` = '$month_year'"));
				
			}
		}
		
		$html_result = $this->View->render("phieu_thu_hoc_phi.php",array("array_thuchi"=>$array_thuchi,"array_bieuphi"=>$array_bieuphi),false);
		echo $html_result;
	}
	
	function phieu_thu_khac($id = "")
	{
		$this->loadModel("ThuChi","thu_chis");
		
		$array_thuchi=NULL;
		if($id != "") $array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id' "));
		
		$html_result = $this->View->render("phieu_thu_khac.php",array("array_thuchi"=>$array_thuchi),false);
		echo $html_result;
	}
	
	function phieu_chi($id = "")
	{
		$this->loadModel("ThuChi","thu_chis");
		
		$array_thuchi=NULL;
		if($id != "") $array_thuchi = $this->ThuChi->find("all",array("conditions"=>"id = '$id' "));
		
		$html_result = $this->View->render("phieu_chi.php",array("array_thuchi"=>$array_thuchi),false);
		echo $html_result;
	}
	
}
?>