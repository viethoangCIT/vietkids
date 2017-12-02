<?php
class module2 extends Main{
	
	function index()
	{
		
		$this->loadModel("Module");
		$str_dieukien='';
		$search='';
		
		if(isset($_POST['search']))
		{
			$search=$_POST['search'];
			$str_dieukien = " modules.title LIKE '%$search%' OR classname LIKE '%$search%'";
		}
			
		$sql="Select * From modules $str_dieukien";

		$rs=$this->Module->find("all",array("conditions"=>$str_dieukien));
		$ds_module = $this->View->render('index_module2.php',array("array_module"=>$rs,"search"=>$search));


		echo $ds_module;	
	}
	
	function nhap_module($id='')
	{	
		$this->loadModel("Module");
		if(isset($_POST["module"]))
		{
				
			//lay thong tin tu form nhap san pham
			$array_module = $_POST["module"];			

			//luu vao database 
			$this->Module->save($array_module);
		
			//quay ve trang danh sach san pham
			$this->redirect("module.html");
			
			return;
		}
		
		$array_module = NULL;
		
		//kiểm tra có id trên tham số hay không
		if($id!= "")
		{
			//đọc thông tin tức từ Database
			$array_module = $this->Module->find("all",array("conditions" => "(id='$id')"));	
		}
		
		//load giao dien form nhap san pham
		$form_module = $this->View->render('nhap_module.php',array("array_module"=>$array_module));
		echo $form_module;
		return;
	}
		
	function xoa($id='')
	{
		$this->loadModel("Module");			
		if($id!='')
		{
			$this->Module->delete($id);
			$this->redirect("module.html");
			return;
		}	
	//end function	
	}
	

	function delete_function($id='',$id_module="")
	{
	
		$this->loadModel("Function","module_functions");		
		if($id!='')
		{
			$this->Function->delete($id);
			$this->redirect("module/list_function/$id_module.html");
			return;
		}	
		
	}
		
	
	function list_function($id_module="",$id_function="")
	{
		
		$this->loadModel("Function","module_functions");
		$this->loadModel("Module");
		
		
		//kiểm tra có dữ liệu submit để lưu
		if(isset($_POST["data"]))
		{
			$array_function = $_POST["data"]["function"];
			$this->Function->save($array_function);
			$this->redirect('module/list_function/'.$_POST["data"]["function"]["id_module"]);
			return;
		}
		
		//lay thong tin cua module
		$array_module  = $this->Module->find("all",array("conditions"=>"id='$id_module'"));
				
		//truy vấn tất function theo module
		$array_function  =  $this->Function->find("all",array("conditions"=>"id_module='$id_module'"));

		//lấy module hiện tại để sửa
		$array_tmp_function = NULL;
		if($id_function!="") $array_tmp_function  	= $this->Function->find("all",array("condtions"=>"id='$id_function'"));	

		$ds_function = $this->View->render('ds_function.php',array("array_function"=>$array_function,"array_module"=>$array_module,"array_tmp_function"=>$array_tmp_function));		
		echo $ds_function;	
	}
	function list_csdl($id_module=''){
			
		$this->loadModel("Module");
		$this->loadModel("ModuleTable","module_tables");
		$array_module = $this->Module->find("all",array("conditions"=>"id = '$id_module'"));
		$array_csdl = NULL;
		$module_name = "";
		$module_package = "";
		
		if($array_module)
		{
			
			$module_name = $array_module[0]["link"];
			$module_package = $array_module[0]["package"];
			$array_csdl = $this->ModuleTable->find("all",array("conditions"=>"module_name = '$module_name' AND module_package = '$module_package'"));
		}
		//echo "module_name = '$module_name' AND module_package = '$module_package'";
		//print_r($array_csdl);
		//dua du vao view
		$danhsach = $this->View->render('list_csdl.php',array("array_csdl"=>$array_csdl,"module_name"=>$module_name,"module_package"=>$module_package,"id_module"=>$id_module));
		echo $danhsach;		
	}
	
	function table($id_function = "", $id_function_table = "")
	{

		$this->loadModel("SystemTable","system_tables");
		$this->loadModel("FunctionTable","function_tables");
		$this->loadModel("ModuleFunction","module_functions");
		$this->loadModel("UserData","user_datas");

        if(isset($_GET["act"])==true){
			$act = $_GET["act"];
			if($act =="del")
			{
				$this->FunctionTable->delete($id_function_table);
			}
            
        }

        

        //nếu có dữ liệu truyền lên theo phương thức POST,
        //thì lưu dữ liệu vào bảng function_tables
        if(isset($_POST["data"])==true)
        {
			$array_function = $this->FunctionTable->find("all",array("conditions"=>"`id_function`='$id_function'"));
            $array_function_table = $_POST["data"];
            $array_function_table_save = $this->SystemTable->find("all",array("conditions"=>"`id`='".$array_function_table['id_table']."'"));
            
            if($array_function_table_save != null){
				$array_function_table["id_function"] = $id_function;
                $array_function_table["table_name"] = $array_function_table_save[0]["table_name"];
                $array_function_table["table_col"] = $array_function_table_save[0]["data_col"];
                $array_function_table["sql"]        =$array_function_table_save[0]["sql_created"];
            }
			$this->FunctionTable->save($array_function_table);
			$this->UserData->save($array_function_table);

        }

		//$id_function = 
		//,array("conditions"=>"`id`=''")
		
        //truy vấn dữ liệu từ bảng function_tables để hiển thị ra table bảng của chức năng function
        $array_function = $this->FunctionTable->find("all",array("conditions"=>"`id_function`='$id_function'"));

        //lấy dữ liệu từ bản system_tables để đưa vào selecbox tên bảng.
        $array_table = $this->SystemTable->find("all");

		//lấy function name để hiển thị tên chức năng đang chọn  
		$array_function_name = $this->ModuleFunction->find("all",array("conditions"=>"`id`='$id_function'"));
        $array_param = array(
            "array_table"   =>$array_table,
			"array_function"=>$array_function,
			"array_function_name" 	=>$array_function_name,
			"id_function"=>$id_function
        );
        $html = $this->View->render("table_module.php",$array_param);
        echo $html;
	//end function
	}


	function add_csdl($id_module = '',$id='',$module_name='',$module_package=''){
			
		$this->loadModel("Module");
		$this->loadModel("ModuleTable","module_tables");
		if(isset($_POST["data"]))
		{
			$array_module = $this->Module->find("all",array("conditions"=>"id = '$id_module'"));
			if($array_module)
			{
				
				$array_csdl = 	$_POST['data']['CSDL'];
				
				//lay id user hien tai
				$array_csdl['id_user'] = $this->User->id;
				$array_csdl['username'] = $this->User->username;
				
				$array_csdl['module_package'] = str_replace("-----","/",$module_package);;
				$array_csdl['module_name'] = $module_name;
				$array_csdl['module_title'] = $array_module[0]["title"];
				//print_r($array_csdl);
				
				//luu du lieu vao database
				$this->ModuleTable->save($array_csdl);
				
				//chuyen ve lai trang theo doi
				$this->redirect("/module/list_csdl/$id_module.html");
			}
			return;
			
		}
		$array_csdl = NULL;
		//echo $id;
		if($id)
		{
			$array_csdl = $this->ModuleTable->find("all",array("conditions"=>"id = '$id'"));
		}
		
		
		//dua du vao view
		$danhsach = $this->View->render('add_csdl.php',array("array_csdl"=>$array_csdl,"module_name"=>$module_name,"module_package"=>$module_package,"id_module"=>$id_module));
		echo $danhsach;		
	}
	function del_csdl($id_module = '',$id = '')
	{
		//ket noi toi CSDL, table kehoach
		// su dung model Kehoach
		$this->loadModel("ModuleTable","module_tables");
		
		//lay du lieu tu model bang chi ra array
		$this->ModuleTable->delete($id);
		
		//chuyen ve lai trang xem thu
		$this->redirect("/module/list_csdl/$id_module.html");

	}
	
	function set_table_column($id_module='',$table_name='',$id='')
	{
		$array_dulieu = NULL;
		$array_sua = NULL;
		$this->loadModel("TableColumn","table_columns");
		if(isset($_POST["data"]))
		{
			$array_luu = $_POST["data"]["TableColumn"];
			$array_luu["table_name"] = $table_name;
			
			$array_luu["id_created_user"] = $this->User->id;
			$array_luu["created_username"] = $this->User->username;
			
			//luu du lieu vao database
			$this->TableColumn->save($array_luu);

		}
		if($id != '')
		{
			$array_sua = $this->TableColumn->find("all",array("conditions"=>"id = '$id'"));
		}
		
		$array_dulieu = $this->TableColumn->find("all",array("conditions"=>"table_name = '$table_name'","order"=>"order_number ASC"));
		//print_r($array_dulieu);
		
		$danhsach = $this->View->render('set_table_column.php',array("array_sua"=>$array_sua,"array_dulieu"=>$array_dulieu,"id_module"=>$id_module,"table_name"=>$table_name));
		echo $danhsach;
	}	
	function delete_table_column($id_module='',$table_name='',$id='')
	{
		//ket noi toi CSDL, table kehoach
		// su dung model Kehoach
		$this->loadModel("TableColumn","table_columns");
		
		//lay du lieu tu model bang chi ra array
		$this->TableColumn->delete($id);
		
		//chuyen ve lai trang xem thu
		$this->redirect("/module/set_table_column/$id_module/$table_name.html");

	}
	
}
?>