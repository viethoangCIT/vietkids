<?php
class test extends Main
{
	function index()
	{
		//tao doi tuong model Test lien ket voi bang tests
		$this->loadModel("Test");
		
		//su dung ham find cua doi tuong model Test de truy van du lieu,gan du lieu truy van cho bien array_test
		$array_test = $this->Test->find("all");
		
		//dùng hàm render của đối tượng View để truy cập tới file danh sách bài test: index_test.php, trả kết quả về biến html
		$html = $this->View->render("index_test.php",array("array_test"=>$array_test));
		
		//trả html về trình duyệt
		echo $html;
		
	}
	
	
	function add_question($id = "")
	{
		$this->loadModel("Question");

		
		
		//kiem tra co gia tri tham so post hay khong, neu co thi lay gia tri cua tham so post
		//muc dich: luu vao bang Questions
		if(isset($_POST["name"])==true)
		{
			//lấy các giá trị bài test từ FORM submit lên
			$name = $_POST["name"];
			$id_test = $_POST["id_test"];
			$created = $_POST["created"];
			$id_created_user = $_POST["id_created_user"];
			
			
			//dùng hàm save của model Question để lưu vao bang questions
			$array_question = null;
			$array_question["name"]=$name;
			$array_question["id_test"]=$id_test;
			$array_question["created"]=$created;
			$array_question["id_created_user"]=$id_created_user;

			
			//dung ham save cua doi tuong Question luu tat ca cac gia tri cua bien array_question vao bang questions
			$this->Question->save($array_question);

		
			//dùng hàm redirect của đối tượng $this, ($this->redirect()) để chuyển về trang danh sách cau hoi
			$this->redirect("/test/question");
				
		}
		
		//kiểm tra tham số id có giá trị không, nếu có thì đọc dữ liệu bài thi từ giá trị tham số id
		//muc dich: de hien thi gia tri cua bai thi ra form sua
		$array_question = null;
		if($id != "")
		{
			$array_question  = $this->Question->find("all",array("conditions"=>"id = '$id'"));
		
		}

		//tao doi tuong model Test lien ket voi bang tests
		$this->loadModel("Test");

		//lay tat ca du lieu cua bai thi
		//muc dich: hien thi du lieu ra form add_question
		$array_test = $this->Test->find("all");
			
			
		//dùng hàm render của đối tượng View để truy cập tới file danh cau hoi: add_question.php
		$html = $this->View->render("add_question.php",array("array_question"=>$array_question,"array_test"=>$array_test));

		
		echo $html;
	}
	
	function question()
	{
		//tao doi tuong model Test lien ket voi bang tests
		$this->loadModel("Question");
		
		//su dung ham find de load du lieu
		$array_question = $this->Question->find("all");
		
		//dùng hàm render của đối tượng View để truy cập tới file danh sách cau hoi: question_test.php, trả kết quả về biến html
		$html = $this->View->render("question_test.php",array("array_question"=>$array_question));
		echo $html;
	}
	
	function del($id = "")
	{
		if($id != "")
		{
			//dung ham delete của model để xóa
			$this->loadModel("Test");
			$this->Test->delete($id);
			$this->redirect("/test/index");
		}
	}

	function del_question($id = "")
	{
		if($id != "")
		{
			$this->loadModel("Question");
			$this->Question->delete($id);
			$this->redirect("/test/question");
		}
	}

	function del_answer($id = "")
	{
		if($id != "")
		{
			$this->loadModel("Answer");
			$this->Answer->delete($id);
			$this->redirect("/test/answer");
		}
	}
	
	function add($id = "")
	{
		// tao doi tuong model Test để liên ket voi bang tests
		$this->loadModel("Test");

		
		//kiem tra co tham so post hay khong, neu co thi lay gia tri cua tham so 
		//muc dich: luu vao bang tests
		if(isset($_POST["data"])==true)
		{
			
			
			
			//gan du lieu bai test vao bien array_test de dua vao ham save
			$array_test = $_POST["data"];
			
			
			//dùng hàm save của model Test để lưu
			$this->Test->save($array_test);
			
			//dùng hàm redirect của đối tượng $this, ($this->redirect()) để chuyển về trang danh sách bài thi
			$this->redirect("/test/index");
				
		}
		
		//kiểm tra tham số id có giá trị không, nếu có thì đọc dữ liệu bài thi từ giá trị tham số id
		//muc dich: hien thi du lieu len ra from add bai thi de cap nhat du lieu
		$array_test = null;
		
		if($id != "")
		{
			$array_test  = $this->Test->find("all",array("conditions"=>"id = '$id'"));
		
		}

		//dùng hàm render của đối tượng View để truy cập tới file danh sách bài test: add_test.php
		$html = $this->View->render("add_test.php",array("array_test"=>$array_test));
		
		echo $html;
	}


	function answer()
	{
		//tao doi tuong model Test lien ket voi bang answer
		$this->loadModel("Answer");
		
		//su dung ham find de load du lieu
		$array_answer= $this->Answer->find("all");
		
		//dùng hàm render của đối tượng View để truy cập tới file danh sách cau hoi: question_test.php, trả kết quả về biến html
		$html = $this->View->render("answer_test.php",array("array_answer"=>$array_answer));
		echo $html;
	}

	function add_answer($id = "")
	{
		//khoi tao doi tuong model Answer lien ket voi bang answers
		$this->loadModel("Answer");

		//lay tham so truyen lên qua phuong thuc POST

		//kiem tra xem co tham so POST hay khong, nếu có thì lấy gia trị tham so
		//muc dich: luu vao bang answer

		if(isset($_POST["name"])==true)
		{

			//lay cac gia tri cua tham so cau tra loi tu form answer submit len
			$name 				= $_POST["name"];
			$id_question		= $_POST["id_question"];
			$question_name		= $_POST["question_name"];
			$id_test 			= $_POST["id_test"];
			$test_name			= $_POST["test_name"];
			$id_created_user	= $_POST["id_created_user"];
			$created_username	= $_POST["created_username"];
			$created_fullname	= $_POST["created_fullname"];
			$created 			= $_POST["created"];


			//gan gia tri tham so vao bien array_answer de dua vao ham save
			$array_answer = null;
			$array_answer["name"] = $name;
			$array_answer["id_question"] = $id_question;
			$array_answer["question_name"] = $question_name;
			$array_answer["id_test"] = $id_test;
			$array_answer["test_name"] = $test_name;
			$array_answer["id_created_user"] = $id_created_user;
			$array_answer["created_username"] = $created_username;
			$array_answer["created_fullname"] = $created_fullname;
			$array_answer["created"] = $created;


			//dùng hàm redirect của đối tượng $this, ($this->redirect()) để chuyển về trang danh sách bài thi
			$this->redirect("/test/answer");

		}

		//kiểm tra tham số id có giá trị không, nếu có thì đọc dữ liệu bài thi từ giá trị tham số id
		//muc dich: hien thi du lieu len ra from add bai thi de cap nhat du lieu
		$array_answer = null;
		if($id != "")
		{
			$array_answer  = $this->Answer->find("all",array("conditions"=>"id = '$id'"));
		}

		//khoi tao doi tuong model Question lien ket toi bang tests
		$this->loadModel("Question");
		
		//dung ham find cua doi tuong Question de load du lieu va dan cho bien $array_question
		$array_question = $this->Question->find("all");

		//dùng hàm save của model Test để lưu
		$this->Answer->save($array_answer);

		//dùng hàm render của đối tượng View để truy cập tới file danh sách bài test: add_test.php
		$html = $this->View->render("add_answer.php",array("array_answer"=>$array_answer,"array_question"=>$array_question));
			
		echo $html;
	}
}
?>