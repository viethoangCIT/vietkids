<?php 

class picture extends Main
{

	function index($type = "", $id_post = "", $id_picture = "")
	{
		//khoi tao doi tuong Model Picture lien ket toi bang pictures
		$this->loadModel("Picture","pictures");

		if(isset($_POST["data"])==true)
		{
			$data = $_POST["data"];
			$this->Picture->save($data);
		}
		// //truy van du lieu tu bang pictures
		$array_picture = $this->Picture->find("all",array("conditions"=>"`id_post` = '$id_post' and `type`='$type'"));

		//tao mang de dua vao form luu
		$array_edit_picture = null;
		if($id_picture != "")
		{	
			$array_edit_picture =  $this->Picture->find("all",array("conditions"=>"`id` = $id_picture"));

		}

		//dung ham render de lay du lieu tu trang...	
		$array_param = array(
			"array_picture"=>$array_picture,
			"array_edit_picture"=>$array_edit_picture,
			"type"=>$type,
			"id_post"=>$id_post
		);
		$html = $this->View->render("index_picture.php",$array_param);
		echo $html;
	}
	function del($id = "")
	{
		if($id != "")
		{
			$this->loadModel("Picture","pictures");
			$this->Picture->delete($id);
			$this->redirect("/picture/index");
		}
	}
}

?>