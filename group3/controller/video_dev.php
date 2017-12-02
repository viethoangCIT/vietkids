<?php 

class video extends Main
{
	function relate_video($type = "", $id_post = "", $id_video = "")
	{
		$this->loadModel("Video","videos");

		if(isset($_POST["data"])==true)
		{
			$data = $_POST["data"];
			$this->Video->save($data);
		}

		$array_video = $this->Video->find("all",array("conditions"=>"`id_post` = '$id_post' and `type`='$type'"));

        //tao mang de dua vao form
        $array_edit_video = null;
        if($id_video != "")
        {
            $array_edit_video = $this->Video->find("all",array("conditions"=>"`id` = '$id_video'"));
        }
        
        $array_param = array(
            "array_video"=>$array_video,
            "array_edit_video"=>$array_edit_video,
            "type"=>$type,
            "id_post"=>$id_post
        );

		$html = $this->View->render("relate_video.php",$array_param);
		echo $html;
	}
	function del_video($id = "")
	{
		if($id != "")
		{
			$this->loadModel("Video","videos");
			$this->Video->delete($id);
			$this->redirect("/video/relate_video");
		}
	}
}

?>