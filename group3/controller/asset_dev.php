<?php
class asset extends Main
{
	function index()
	{
		//khoi tao doi tuong model Asset lien ket voi bang asset
		$this->loadModel("Asset");

		//dung ham find de truy van du lieu
		$array_asset = $this->Asset->find("all");

		$html = $this->View->render("index_asset.php",array("array_asset"=>$array_asset));
		echo $html;
	}


	function del($id = "")
	{
		if($id != "")
		{
			//dung ham delete của model để xóa
			$this->loadModel("Asset");
			$this->Asset->delete($id);
			$this->redirect("/asset/index");
		}
	}
	
	
	function add($id = "")
	{
		$this->loadModel("Asset");

		//kiem tra co tham so post hay khong, neu co thi lay gia tri cua tham so 
		//muc dich: luu vao bang tests
		if(isset($_POST["data"])==true)
		{
			//gan du lieu bai test vao bien array_test de dua vao ham save
			$array_asset = $_POST["data"];
			
			//chuyen date_input ve year-month-day
			$array_asset["date_input"] = date("Y-m-d",strtotime($array_asset["date_input"])); 

			//dùng hàm save của model Test để lưu
			$this->Asset->save($array_asset);
			
			//dùng hàm redirect của đối tượng $this, ($this->redirect()) để chuyển về trang danh sách bài thi
			$this->redirect("/asset/index");
				
		}

		//kiểm tra tham số id có giá trị không, nếu có thì đọc dữ liệu bài thi từ giá trị tham số id
		//muc dich: hien thi du lieu len ra from add bai thi de cap nhat du lieu
		$array_asset = null;
		
		if($id != "")
		{
			$array_asset  = $this->Asset->find("all",array("conditions"=>"id = '$id'"));
		
		}

		//dùng hàm render của đối tượng View để truy cập tới file danh sách bài test: add_test.php
		$html = $this->View->render("add_asset.php",array("array_asset"=>$array_asset));
		echo $html;

	}

	
}
?>