<?php
class user3 extends Main{
    function modules($id_user_module = "",$id_user = "")
    {
        $this->loadModel("Module","modules");
        $this->loadModel("ModuleFunction","module_functions");
        $this->loadModel("User2","users");
        $this->loadModel("UserModule","user_modules");


        if(isset($_GET["act"])==true)
        {
            $act=$_GET["act"];
            if($act == "del")
            {
                $this->UserModule->delete($id_user_module);
            }
        }

        $id_module = "";
        if(isset($_GET["data"]["id_module"])) $id_module = $_GET["data"]["id_module"];
        
        $id_function = "";
        if(isset($_GET["data"]["id_function"])) $id_function = $_GET["data"]["id_function"];

        $id_user = "";
        if(isset($_GET["data"]["id_user"])) $id_user = $_GET["data"]["id_user"];

        $status = "";
        if(isset($_GET["data"]["status"])) $status = $_GET["data"]["status"];
        if($status == 1)
        {
            $array_user_module = $_GET["data"];

            //lấy thông tin Module từ bảng modules
            //để gán thông tin modules vào biến $array_user_module
            $array_module_save = $this->Module->find("all",array("conditions"=>"`id`='$id_module'"));
            if($array_module_save != null )
            { 
                $array_user_module["id_module"] = $id_module;
                $array_user_module["module_package"] = $array_module_save[0]["package"];
                $array_user_module["module_title"] = $array_module_save[0]["title"];
                $array_user_module["module_name"]  = $array_module_save[0]["classname"];
                
            }

            //Lấy thông tin từ bảng module_functions
            //để gán thông tin function vào biến $array_user_module
            $array_module_function_save = $this->ModuleFunction->find("all",array("conditions"=>"`id` = '$id_function'"));
            if($array_module_function_save != null)
            {
                $array_user_module["id_function"]  = $id_function;
                $array_user_module["function_name"]  = $array_module_function_save[0]["name"];
                $array_user_module["function_title"]  = $array_module_function_save[0]["title"];
            }

             //truy vấn dữ liệu tên users từ bảng user theo id_user của bảng module_users
            $array_username = $this->User2->find("all",array("fields"=>"username,fullname","conditions"=>"`id`='$id_user'"));
            if($array_username != null)
            {
                $array_user_module["username"] = $array_username[0]["username"];
                $array_user_module["user_fullname"] = $array_username[0]["fullname"];
            }

            
            $this->UserModule->save($array_user_module);
        }
        //truy van du lieu từ bảng user
        $array_user = $this->User2->find("all",array("order"=>"id ASC","fields"=>"id,fullname"));

        //thêm phần tử trống vào array_user
        $array_user = array(""=>array("id"=>"","title"=>"...")) + $array_user;

        $array_module = $this->Module->find("all");

        //thêm phần tử trống vào array_module
        $array_module = array(""=>array("id"=>"","title"=>"...")) + $array_module;

        $array_module_function = $this->ModuleFunction->find("all",array("order"=>"id ASC","fields"=>"id,title","conditions"=>"`id_module`='$id_module'"));
       
        //thêm phần tử trống vào array_module_function
       // $array_module_function = array(""=>array("id"=>"","title"=>"...")) + $array_module_function;

        //kiểm tra có id_user_search không, nếu có thì 
        $id_user_search = "";
        if(isset($_GET["id_user_search"])) $id_user_search = $_GET["id_user_search"];
        if($id_user_search != "")
        {
            $array_user_module = $this->UserModule->find("all",array("conditions"=>"`id_user`='$id_user_search'"));
        }
        else{
            //truy van dữ liệu của user_modules de hien danh user_module
            $array_user_module = $this->UserModule->find("all");
        }

        
        //
        $array_param = array(
            "array_user_module"=>$array_user_module,
            "array_module"=>$array_module,
            "array_module_function"=>$array_module_function,
            "array_user"=>$array_user,
            "id_module"=>$id_module,
            "id_user"=>$id_user,
            "id_function"=>$id_function,
            "id_user_search"=>$id_user_search
        );
        $html = $this->View->render("index_module.php",$array_param);
        echo $html;
    }
    function add_module()
    {
        $this->loadModel("Module","modules");

        if(isset($_POST["data"])==true)
        {
            $array_module = $_POST["data"];

            $this->Module->save($array_module);
        }

        $html = $this->View->render("add_module.php");
        echo $html;
    }

    function data($id_user_module = "",$id_user = "")
    {
        $this->loadModel("Module","modules");
        $this->loadModel("ModuleFunction","module_functions");
        $this->loadModel("User2","users");
        $this->loadModel("UserModule","user_modules");
        $this->loadModel("FunctionTable","function_tables");
        $this->loadModel("SystemTable","system_tables");

        if(isset($_GET["act"])==true)
        {
            $act=$_GET["act"];
            if($act == "del")
            {
                $this->UserModule->delete($id_user_module);
            }
        }

        $id_module = "";
        if(isset($_GET["data"]["id_module"])) $id_module = $_GET["data"]["id_module"];
        
        $id_function = "";
        if(isset($_GET["data"]["id_function"])) $id_function = $_GET["data"]["id_function"];

        $id_user = "";
        if(isset($_GET["data"]["id_user"])) $id_user = $_GET["data"]["id_user"];
        
       

        //truy van du lieu
        $array_user = $this->User2->find("all",array("order"=>"id ASC","fields"=>"id,fullname"));
        
        //thêm phần tử trống
        $array_user = array(""=>array("id"=>"","fullname"=>"...")) +$array_user;


        $array_module = $this->UserModule->find("all",array("fields"=>"DISTINCT id_module, module_title","conditions"=>"`id_user`='$id_user'"));
        $array_module_function = $this->UserModule->find("all",array("order"=>"id ASC","fields"=>"id_function, function_title","conditions"=>"`id_module`='$id_module' AND `id_user`='$id_user'"));

        //lấy dữ liệu từ bảng function_tables để hiển thị ra selectbox danh sách table
        $array_function_table = $this->FunctionTable->find("all",array("order"=>"id ASC","fields"=>"id_table,table_name","conditions"=>"`id_function`='$id_function'"));

        //lấy tất cả dữ liệu từ bảng function table để đưa vào bảng danh sách table
        //$array_table = $this->FunctionTable->find("all",array("conditions"=>"`id_function`='$id_function'"));
        
         //lấy tên bảng từ id_table
         $id_table = "";
         if(isset($_GET["data"]["id_table"])) $id_table = $_GET["data"]["id_table"];
 
         //truy vấn dữ liệu table từ id_table 
 
        $array_table = $this->SystemTable->find("all",array("conditions"=>"`id`='$id_table'"));
        $table_prefix = $this->Company->table_prefix;
        $str_table_name = "";
        $str_colum_name = "";
        $array_data = null;
        if($array_table != null)
        {

            $str_table_name = $array_table[0]["table_name"];
            $str_colum_name = $array_table[0]["data_col"];
            if($str_table_name != "")
            {
                $str_table_name = $table_prefix.$str_table_name;
                $array_data = $this->SystemTable->query("SELECT id, $str_colum_name as data_title FROM $str_table_name");

                
            }
        }
        //Đưa qua view
        $array_param = array(
            "array_module"=>$array_module,
            "array_module_function"=>$array_module_function,
            "array_user"=>$array_user,
            "id_module"=>$id_module,
            "id_function"=>$id_function,
            "id_user"=>$id_user,
            "array_function_table"=>$array_function_table,
            "array_data"=>$array_data,
            "id_table"=>$id_table

        );
        $html = $this->View->render("data_module.php",$array_param);
        echo $html;
    }

    function tables($id = "")
    {
        $this->loadModel("SystemTable","system_tables");
        $this->loadModel("FunctionTable","function_tables");

        if(isset($_GET["act"])==true){
            $act = $_GET["table"];
            $this->FunctionTable->delete($id);
        }

        

        //nếu có dữ liệu truyền lên theo phương thức POST,
        //thì lưu dữ liệu vào bảng function_tables
        if(isset($_POST["data"])==true)
        {
            $array_function_table = $_POST["data"];
            $array_function_table_save = $this->SystemTable->find("all",array("conditions"=>"`id`='".$array_function_table['id_table']."'"));
            
            if($array_function_table_save != null){
                $array_function_table["table_name"] = $array_function_table_save[0]["table_name"];
                $array_function_table["table_col"]  = $array_function_table_save[0]["data_col"];
                $array_function_table["sql"]        =$array_function_table_save[0]["sql_created"];
            }
            $this->FunctionTable->save($array_function_table);

        }

        //truy van du lieu tu bang function_table de hien thi ra table
        $array_function = $this->FunctionTable->find("all");

        //lấy dữ liệu từ bản system_tables để đưa vào selecbox tên bảng.
        $array_table = $this->SystemTable->find("all");

        $array_param = array(
            "array_table"   =>$array_table,
            "array_function"=>$array_function
        );
        $html = $this->View->render("user3_table.php",$array_param);
        echo $html;
    }

    function add($id = "")
    {
        $this->loadModel("User2","users");

        //kiểm tra nếu có dữ liệu truyền lên theo phương thức POST
        //thì lưu dữ liệu vào bảng users

        if(isset($_POST["data"])==true)
        {
            $array_user = $_POST["data"];
            $array_user["birthday"] = date("Y-m-d",strtotime($array_user["birthday"]));
            $array_user["date_of_issue"] = date("Y-m-d",strtotime($array_user["date_of_issue"]));
            $array_user["start_date"] = date("Y-m-d",strtotime($array_user["start_date"]));
            $this->User2->save($array_user);
            $this->redirect("/user3/index");
        }

        $array_user = null;
		if($id != "")
		{
			$array_user  = $this->User2->find("all",array("conditions"=>"id = '$id'"));
		
		}

        $html = $this->View->render("add_user3.php",array("array_user"=>$array_user));
        echo $html;
    }

    function index($id = "")
    {
        $this->loadModel("User2","users");
        if(isset($_GET["act"])==true)
        {
            $act=$_GET["act"];
            if($act == "del")
            {
                $this->User2->delete($id);
            }
        }

        $search = "";
        $array_user = null;
        if(isset($_POST["search"])==true) $search = $_POST["search"];
        if($search != "")
        {
            $array_user = $this->User2->find("all",array("conditions"=>"username LIKE '%$search%' OR fullname LIKE '%$search%'"));
           // $array_user = $this->User2->query("SELECT * FROM kietlong_users WHERE username LIKE '%$search%'");
        }
        else{
            $array_user = $this->User2->find("all");
        }

       
        

        $html = $this->View->render("index_user.php",array("array_user"=>$array_user));
        echo $html;
    }
    
}
?>