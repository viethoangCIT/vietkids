<?php
class classroom extends Main
{
	function index()
	{
	  	$this->loadModel("Classroom");
	  
		$dieukien = "";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			if($tim != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien_tim = str_replace("'","''",$tim);
				$dieukien .= " (`name` LIKE '%$dieukien_tim%') OR (`code` LIKE '%$dieukien_tim%')";
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
				$dieukien .= " (`from` >= '$dieukien_tungay')";	
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
				$dieukien .= " (`to` <= '$dieukien_denngay')";	
			}
		}  	
		
		//lay tat ca dl tu bang classroom
		$array_classroom=$this->Classroom->find("all", array("order"=>"id DESC","conditions"=>$dieukien));
		
		//dua dl array classroom vao view 
		$html_result = $this->View->render("danh_sach_lop_hoc.php",array("array_classroom"=>$array_classroom,"arr_classroom_edit"=>$arr_classroom_edit,"tim"=>$tim,"tungay"=>$tungay,"denngay"=>$denngay));
		echo $html_result;
	}
	
	//them
	function add()
	{
		
		$this->loadModel("Classroom");
		$this->loadModel("Classroom_type");
		$arr_lop_hoc=$this->Classroom_type->find("all",array("fields"=>"id,name","order"=>"name ASC"));
		if(isset($_POST["name"]))
		{
		
			//lưu vào csdl		
			$array_classroom = NULL;
			$array_classroom["id"]=$_POST["id"];
			$array_classroom["name"]=$_POST["name"];
			$array_classroom["code"]=$_POST["code"];
			$array_classroom["year"]=$_POST["year"];
			$array_classroom["from"]=date("Y-m-d",strtotime($_POST["from"]));
			$array_classroom["to"]=date("Y-m-d",strtotime($_POST["to"]));
			$array_classroom["des"]=$_POST["des"];
			$id=$array_classroom["id"];
			
			$this->Classroom->save($array_classroom);
			
			//tạo session flash lưu thành công
			$this->Session->set_flash('save_ok', 'true');
			
			$this->redirect("/classroom/add");
			return;
		}
		
		$array_classroom = $this->Classroom->find("all", array("order"=>"id DESC","limit"=>"1"));
		
	//hien thi thong tin ra textbox
		$arr_classroom_edit = NULL;
		if(isset($_GET["id"]))
		{
			$id=$_GET["id"];
			
			//doc thong tin classroom theo id
			$arr_classroom_edit=$this->Classroom->find("all",array('conditions'=>"`id` = '$id'"));
		}
		$html_result=$this->View->render('nhap_lop_hoc.php',array('arr_classroom_edit'=>$arr_classroom_edit,'arr_lop_hoc'=>$arr_lop_hoc,'array_classroom'=>$array_classroom));
		echo $html_result;
	}
	
	//xoa
	function del()
	{	
		
		//tao model Classroom tuong ung voi bang Classroom
		$this->loadModel("Classroom");
		$this->loadModel("Arrange");
		if(isset($_GET["id"]))
		{
			$id=$_GET["id"];

			
			//kiểm tra lớp học hiện tại đã có học sinh hay chưa
			$array_arrange = null;
			$array_arrange = $this->Arrange->find("all",array("conditions"=>"`id_classroom`='$id'"));

			//nếu có lớp học so học sinh thì được xóa lớp đó
			if($array_arrange == null)
			{
				//xoa thong tin Classroom theo id
				//goi ham del trong model Classroom de xoa id
				$this->Classroom->delete($id);

				//tạo sess flass để thông báo kết quả xóa thành công
				$this->Session->set_flash("msg","del_ok");
			}
			else
			{
				//tạo sess flass để thông báo kết quả đã có học sinh trong lớp
				$this->Session->set_flash("msg","exist_student");

			}
			
			//tra ve page index
			$this->redirect("/classroom/index");
		}
	}
	
	function add_classroom_type()
	{
		$this->loadModel("Classroom_type");
		if(isset($_POST["name"]))
		{
			$array_classroom_type = NULL;
			$array_classroom_type["id"]=$_POST["id"];
			$array_classroom_type["name"]=$_POST["name"];
			$array_classroom_type["code"]=$_POST["code"];
			$array_classroom_type["des"]=$_POST["des"];
			$id=$array_classroom_type["id"];
			
			$this->Classroom_type->save($array_classroom_type);
			$this->redirect("/classroom/add_classroom_type");
			return;
		}
		
		$array_classroom_type = $this->Classroom_type->find("all", array("order"=>"id DESC","limit"=>"1"));
	
	//hien thi thong tin ra textbox
		$arr_classroom_type_edit = NULL;
		if(isset($_GET["id"]))
		{
			$id=$_GET["id"];
			
			//doc thong tin classroom theo id
			$arr_classroom_type_edit=$this->Classroom_type->find("all",array('conditions'=>"`id` = '$id'"));
		}
		$html_result=$this->View->render('nhap_loai_lop_hoc.php',array('arr_classroom_type_edit'=>$arr_classroom_type_edit,'array_classroom_type'=>$array_classroom_type));
		echo $html_result;
	}
	
	function classroom_type($id = "")
	{
	  	$this->loadModel("Classroom");
		$this->loadModel("Classroom_type");
		
		$dieukien = "";
		$tim = "";
		if(isset($_POST["tim"]))
		{
			$tim = $_POST["tim"];
			if($tim != "")
			{
				$dieukien_tim = str_replace("'","''",$tim);
				$dieukien = "(`name` LIKE '%$dieukien_tim%') OR (`code` LIKE '%$dieukien_tim%')";
			}
		}
		
		//lay tat ca dl tu bang classroom_type
		$array_classroom_type=$this->Classroom_type->find("all", array("order"=>"id DESC","conditions"=>$dieukien));
		
		//kiem tra có id de doc dl
		$arr_classroom_type_edit = NULL;
		if( $id != "")
		{
			$arr_classroom_type_edit=$this->Classroom_type->find("all",array('conditions'=>"`id` = '$id'"));
		}
		
		//dua dl array classroom_type vao view 
		$html_result = $this->View->render("danh_sach_loai_lop_hoc.php",array("array_classroom_type"=>$array_classroom_type,"arr_classroom_type_edit"=>$arr_classroom_type_edit,"tim"=>$tim));
		echo $html_result;
	}
	
	function del_classroom_type($id = "")
	{	
		
		//tao model Classroom_type tuong ung voi bang Classroom_type
		$this->loadModel("Classroom_type");
		if(isset($_GET["id"]))
		{
			$id=$_GET["id"];
		
			//xoa thong tin Classroom_type theo id
			//goi ham del trong model Classroom_type de xoa id
			$this->Classroom_type->delete($id);	
			//tra ve page index
			$this->redirect("/classroom/index");
		}
	}
	
	function arrange($id_classroom = "",$type = "")
	{
	  	$this->loadModel("HocSinh","customers");
		$this->loadModel("GiaoVien","users");
		$this->loadModel("Classroom","classrooms");
		$this->loadModel("Arrange","arranges");
		
		$ten_lop = $nam_lop = $start_date = $finish_date = "";
		if($id_classroom != "")
		{
			$array_lophoc = $this->Classroom->find("all", array("conditions"=>"`id` = '$id_classroom'")); 
			if($array_lophoc != NULL)
			{
				$ten_lop = $array_lophoc[0]["name"];
				$nam_lop = $array_lophoc[0]["year"];
				$start_date = date("Y-m-d",strtotime($array_lophoc[0]["from"]));
				$finish_date = date("Y-m-d",strtotime($array_lophoc[0]["to"]));
			}
		}
		
		if($type == "0") $array_xeplop = $this->HocSinh->find("all", array("order"=>"fullname ASC","conditions"=>"`status` = '0'"));
		else $array_xeplop = $this->GiaoVien->find("all", array("order"=>"fullname ASC","conditions"=>"(`status` = '1') AND (`type` = '0') AND (`arrange_class` = '0')"));
		
		//lưu dữ liệu
		if(isset($_POST["data"]))
		{
			$array_luu = $_POST["data"]["XepLop"];
			$array_capnhat_lop = NULL;
			foreach($array_luu as $xeplop)
			{
				if(isset($xeplop["id_fullname"]) && $xeplop["id_fullname"] != "")
				{
					$xeplop["id_classroom"] = $id_classroom;
					$xeplop["classroom_name"] = $ten_lop;
					$xeplop["year"] = $nam_lop;
					$xeplop["start_date"] = $start_date;
					$xeplop["finish_date"] = $finish_date;
					$xeplop["type"] = $type;
					$xeplop["status"] = "1";
					$xeplop["id_created_user"] = $this->User->id;
					$xeplop["created_username"] = $this->User->fullname;
					
					$this->Arrange->save($xeplop);
					
					$array_capnhat_lop["id"] = $xeplop["id_fullname"];
					if($type == "0")
					{
						$array_capnhat_lop["status"] = "1";
						$this->HocSinh->save($array_capnhat_lop);
					}
					else
					{ 
						$array_capnhat_lop["arrange_class"] = "1";
						$this->GiaoVien->save($array_capnhat_lop);
					}
					
				}
			}
			$this->redirect("/classroom/index");
		}
		
		//dua dl array classroom_type vao view 
		$html_result = $this->View->render("xep_lop.php",array("array_xeplop"=>$array_xeplop,"type"=>$type,"ten_lop"=>$ten_lop,"nam_lop"=>$nam_lop,"id_classroom"=>$id_classroom));
		echo $html_result;
	}
	
	function arrange_list()
	{
	  	$this->loadModel("ClassRoom","classrooms");
		$this->loadModel("Arrange","arranges");
		
		$array_lop_hoc = $this->ClassRoom->find("all", array("order"=>"name DESC","fields"=>"id,name"));
		if($array_lop_hoc != NULL)	array_unshift($array_lop_hoc,array("","Tất cả"));
		else $array_lop_hoc = array("","Tất cả");
		
		$dieukien = "(`status` = '1')";
		$tim = "";
		if(isset($_GET["tim"]))
		{
			$tim = $_GET["tim"];
			if($tim != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien_tim = str_replace("'","''",$tim);
				$dieukien .= " (`classroom_name` LIKE '%$dieukien_tim%') OR (`fullname` LIKE '%$dieukien_tim%')";
			}
		}
		
		$type = "";
		if(isset($_GET["type"]))
		{
			$type = $_GET["type"];
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
				$dieukien .= " (`start_date` >= '$dieukien_tungay')";	
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
				$dieukien .= " (`finish_date` <= '$dieukien_denngay')";	
			}
		}
		
		$id_classroom = "";
		if(isset($_GET["id_classroom"]))
		{
			$id_classroom = $_GET["id_classroom"];
			if($id_classroom != "")
			{
				if($dieukien != "") $dieukien .= " AND "; 
				$dieukien .= " (`id_classroom` = '$id_classroom')";	
			}
		}
		
		$array_danhsach = $this->Arrange->find("all", array("order"=>"id DESC","conditions"=>$dieukien));
		
		//XUẤT EXCEL
		$output = "";
		if(isset($_GET["xuat"]))
		{
			$output = $_GET["xuat"];
			$stt = 0;
			if($output == "1")
			{
				$file = 'danh_sach_lop.xls';

				header('Content-Description: File Transfer');
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header('Content-Disposition: attachment; filename="'.basename($file).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				
				echo "<table border='1'>
						  <tr>
							  <th>STT</th>
							  <th>Họ Và Tên</th>
							  <th>Lớp</th>
						  </tr>";
				foreach($array_danhsach as $danhsach)
				{
					$stt++;
					$fullname = $danhsach['fullname'];
					$classroom_name = $danhsach['classroom_name'];
					
					echo "<tr>
							  <td>$stt</td>
							  <td>$fullname</td>
							  <td>$classroom_name</td>
						  </tr>";
				}
				echo "</table>";
				return;
			}
			
		}//end xuất excel
		
		//dua dl array classroom_type vao view 
		$html_result = $this->View->render("danh_sach_xep_lop.php",array("array_lop_hoc"=>$array_lop_hoc,"array_danhsach"=>$array_danhsach,"tim"=>$tim,"id_classroom"=>$id_classroom,"denngay"=>$denngay,"tungay"=>$tungay,"type"=>$type));
		echo $html_result;
	}
	
	function change_classroom()
	{
	  	$this->loadModel("Arrange","arranges");
		$this->loadModel("ClassRoom","classrooms");
		
		//lưu dữ liệu
		if(isset($_POST["data"]))
		{
			$array_xeplop = $_POST["data"]["ChuyenLop"];
			$array_lop_moi = NULL;
			$array_lop_cu = NULL;
			
			foreach($array_xeplop as $chuyenlop)
			{
				$current_id_classroom = $chuyenlop["current_id_classroom"];
				$id_classroom = $chuyenlop["id_classroom"];
				
				if($id_classroom != "" && $id_classroom != $current_id_classroom)
				{
					$array_lop_cu["status"] = "0";
					$array_lop_cu["id"] = $chuyenlop["id"];
					
					$this->Arrange->save($array_lop_cu);
					
					$array_lop_moi["id_classroom"] = $id_classroom;
					$array_lop_moi["status"] = "1";
					$array_lop_moi["type"] = "1";
					$array_lop_moi["id_fullname"] = $chuyenlop["id_fullname"];
					$array_lop_moi["fullname"] = $chuyenlop["fullname"];
					
					//lấy thông tin lớp mới
					$array_new_classroom = $this->ClassRoom->find("all", array("conditions"=>"`id` = '$id_classroom'"));
					
					$array_lop_moi["classroom_name"] = $array_new_classroom[0]["name"];
					$array_lop_moi["year"] = $array_new_classroom[0]["year"];
					$array_lop_moi["start_date"] = $array_new_classroom[0]["from"];
					$array_lop_moi["finish_date"] = $array_new_classroom[0]["to"];
					$array_lop_moi["id_created_user"] = $this->User->id;
					$array_lop_moi["created_username"] = $this->User->fullname;
					
					$this->Arrange->save($array_lop_moi);
					
				}// END if(isset($lenlop["id"]) && $lenlop["id"] != "")
			}//END foreach($array_lenlop as $lenlop)
			
			$this->redirect("/classroom/arrange_list?type=1");
			return;
		}
		
		$array_lop_hoc = $this->ClassRoom->find("all", array("order"=>"id DESC","fields"=>"id,name"));
		if($array_lop_hoc != NULL)	array_unshift($array_lop_hoc,array("","..."));
		else $array_lop_hoc = array("","...");
		
		$array_danhsach_giaovien = $this->Arrange->find("all", array("conditions"=>"(`status` = '1') AND (`type` = '1')"));
		
		//dua dl array classroom_type vao view 
		$html_result = $this->View->render("chuyen_lop_giao_vien.php",array("array_danhsach_giaovien"=>$array_danhsach_giaovien,"array_lop_hoc"=>$array_lop_hoc));
		echo $html_result;
	}
	
	function level($id_classroom = "")
	{
	  	$this->loadModel("ClassRoom","classrooms");
		$this->loadModel("Arrange","arranges");
		$this->loadModel("FeeCustomer","fee_customers");
		
		//lưu dữ liệu
		if(isset($_POST["data"]))
		{
			$array_luu = $_POST["data"]["XepLop"];
			if(isset($array_luu["LenLop"])) $array_lenlop = $array_luu["LenLop"];
			$id_lop = $array_luu["id_classroom"];
			$array_lop_moi = NULL;
			
			if($array_lenlop != NULL)
			{
				foreach($array_lenlop as $lenlop)
				{
					if(isset($lenlop["id"]) && $lenlop["id"] != "")
					{
						$lenlop["status"] = "0";
						
						$this->Arrange->save($lenlop);
						
						$array_lop_moi["id_classroom"] = $id_lop;
						$array_lop_moi["classroom_name"] = $array_luu["classroom_name"];
						$array_lop_moi["status"] = "1";
						$array_lop_moi["type"] = "0";
						$array_lop_moi["id_fullname"] = $lenlop["id_fullname"];
						$array_lop_moi["fullname"] = $lenlop["fullname"];
						
						//lấy thông tin lớp mới
						$array_new_classroom = $this->ClassRoom->find("all", array("conditions"=>"`id` = '$id_lop'"));
						
						$array_lop_moi["year"] = $array_new_classroom[0]["year"];
						$array_lop_moi["start_date"] = $array_new_classroom[0]["from"];
						$array_lop_moi["finish_date"] = $array_new_classroom[0]["to"];
						$array_lop_moi["id_created_user"] = $this->User->id;
						$array_lop_moi["created_username"] = $this->User->fullname;
						
						$this->Arrange->save($array_lop_moi);
						
						//khi chuyển lớp thì update biểu phí trẻ (nếu có) sang lớp khác nếu có cùng ngày tháng
						//nếu không thì tức là lên lớp (không xử lí gì cả)
						/*$id_customer = $lenlop["id_fullname"];
						
						$array_fee_customer = $this->FeeCustomer->find("all", array("conditions"=>"`id_customer` = '$id_customer'"));
						if($array_fee_customer)
						{
							$array_capnhat_bieuphi_tre = NULL;
							$start_date = date("Y-m-d",strtotime( $array_new_classroom[0]["from"]));
							$finish_date = date("Y-m-d",strtotime( $array_new_classroom[0]["to"]));
							
							$id_fee_customer = 	$array_fee_customer[0]["id"];
							$month_year = date("Y-m-d",strtotime($array_fee_customer[0]["month_year"]));
							if((strtotime($month_year) >= strtotime($start_date)) && (strtotime($month_year) <= strtotime($finish_date)))
							{
								//chuyển biểu phí của trẻ hiện tại sang lớp khác
								$array_capnhat_bieuphi_tre["id"] = $id_fee_customer;
								$array_capnhat_bieuphi_tre["id_classroom"] = $id_lop;
								$array_capnhat_bieuphi_tre["classroom_name"] = $array_luu["classroom_name"];
								
								$this->FeeCustomer->save($array_capnhat_bieuphi_tre);
								
								//update lại biểu phí chi tiết tương ứng
								$this->loadModel("FeeCustomerDetail","fee_customer_details");
								$array_fee_customer_detail = $this->FeeCustomerDetail->find("all", array("conditions"=>"`id_fee_customer` = '$id_fee_customer'"));
								$array_capnhat_bieuphi_chitiet = NULL;
								foreach($array_fee_customer_detail as $fee_customer_detail)
								{
									$array_capnhat_bieuphi_chitiet["id"] = $fee_customer_detail["id"];
									$array_capnhat_bieuphi_chitiet["id_classroom"] = $id_lop;
									$array_capnhat_bieuphi_chitiet["classroom_name"] = $array_luu["classroom_name"];
									$array_capnhat_bieuphi_chitiet["id_classroom"] = $id_lop;
									
									$this->FeeCustomerDetail->save($array_capnhat_bieuphi_tre);
								}
							}//END chuyển biểu phí của trẻ hiện tại sang lớp khác
						}*/
						
					}// END if(isset($lenlop["id"]) && $lenlop["id"] != "")
				}//END foreach($array_lenlop as $lenlop)
			}// END if($array_lenlop != NULL)
			
			$this->redirect("/classroom/arrange_list?id_classroom=$id_lop");
			return;
		}
		
		$array_lop_hoc = $this->ClassRoom->find("all", array("order"=>"id DESC","fields"=>"id,name"));
		
		if($id_classroom != "") $array_danhsach_lop = $this->Arrange->find("all", array("conditions"=>"(`id_classroom` = '$id_classroom') AND (`type` = '0') AND (`status` = '1')"));
		
		//dua dl array classroom_type vao view 
		$html_result = $this->View->render("len_lop.php",array("array_lop_hoc"=>$array_lop_hoc,"array_danhsach_lop"=>$array_danhsach_lop));
		echo $html_result;
	}
	
	
}
?>