<?php 	
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "Nhập Module";
	
	echo $this->Template->load_function_header($function_title);

	//*****************************************
	//END FUNCTION HEADER
	//*****************************************
	
	//*****************************************
	//FUNCTION BODY
	//*****************************************	
    
	$id = '';
	$id_project = "";
    $module_name = '';       
    $des = "";      
    $project_name ="";
	
    if($array_sua)
	{
            $id = $array_sua[0]['id'];
            $module_name = $array_sua[0]['module_name'];
            $des = $array_sua[0]['des'];           
            $id_project = $array_sua[0]['id_project']; 
			$project_name = $array_sua[0]['project_name'];   
    }
	
	$str_form_product = $this->Template->load_form_row(array("title"=>"Dự Án","input"=>$this->Template->load_selectbox(array("name"=>"data[project_module][id_project]","id"=>"id_project","style"=>"width:30%"),$array_du_an)));
	$str_form_product .= $this->Template->load_hidden(array("name"=>"data[project_module][project_name]","value"=>$project_name,"id"=>"project_name"));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"Tên Module","input"=>$this->Template->load_textbox(array("name"=>"data[project_module][module_name]","value"=>$module_name,"style"=>"width:80%"))));

	$str_form_product .= $this->Template->load_form_row(array("title"=>"Mô Tả","input"=>$this->Template->load_textarea(array("name"=>"data[project_module][des]","style"=>"width:80%"),$des)));
	
	$str_id_product = $this->Template->load_hidden(array("name"=>"data[project_module][id]","value"=>$id));
	
	$str_form_product .= $this->Template->load_form_row(array("title"=>"","input"=>$str_id_product.$this->Template->load_button(array("type"=>"submit"),"Lưu")));
	
	$str_form_product = $this->Template->load_form(array("method"=>"POST","action"=>"/project/add_module.html","onsubmit"=>"return kiemtra()"),$str_form_product);
	
	echo $str_form_product;
?>
<script>
function kiemtra()
{
	document.getElementById("project_name").value = $("#id_project :selected").text();	
}
</script>
  



