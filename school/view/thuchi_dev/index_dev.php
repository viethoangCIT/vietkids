<?php
    //*****************************************
    //FUNCTION HEADER

    //tieu de cua ham
    $function_title=$array_title['function_title_list'];
    echo $this->Template->load_function_header($function_title);

    //END FUNCTION HEADER
    //*****************************************

    //TIM KIEM
    //*****************************************
    $str_timkiem="";
	
	
	
	$str_timkiem .= $this->Template->load_label(" Nhóm 	: ","","search_list");
    $str_timkiem .= $this->Template->load_selectbox(array("name"=>"group","style"=>"width:130px"),$array_thuchi_group,$id_group);
	
	//$array_type = array(""=>"Tất cả","0"=>"Trẻ","1"=>"Giáo viên");
	
    $str_timkiem .= $this->Template->load_label(" Từ ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"startday","autocomplete"=>"off","id"=>"startday","style"=>"width:100px","value"=>$tungay));

    $str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
    $str_timkiem .= $this->Template->load_textbox(array("name"=>"finishday","autocomplete"=>"off","id"=>"finishday","style"=>"width:100px","value"=>$denngay));
	if($this->get_config("thuchi_class") == "yes")
	{
		$str_timkiem .= $this->Template->load_label(" Lớp: ","","search_list");
		$str_timkiem .= $this->Template->load_selectbox(array("name"=>"id_classroom","style"=>"width:150px","onchange"=>"this.form.submit()"),$array_classroom,$id_classroom);
	}
	$str_customer_label = $this->get_config("thuchi_customer_label");
	if($str_customer_label == "thuchi_customer_label") $str_customer_label = "Khách Hàng ";
	$str_timkiem .= $this->Template->load_label($str_customer_label." : ","","search_list");
    $str_timkiem .= $this->Template->load_selectbox(array("name"=>"customer_name","style"=>"width:150px"),$array_customer,$id_customer);
	
    $str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm");

    $link_danhsach = $this->Html->link(array("controller"=>"thuchi","action"=>"index"));
    $str_timkiem = $this->Template->load_form(array("action"=>"","method"=>"POST","id"=>"form_timkiem"),$str_timkiem);
    echo $str_timkiem;

    //*****************************************
    //END TIM KIEM

    //*****************************************
    //FUNCTION CONTENT

	$str_group_name=$this->get_config("thuchi_group_name");
	if($str_group_name  == "thuchi_group_name") $str_group_name="";
    //Table
    //buoc 1: tao mang table header
    $array_header_attendance =  array("stt"=>array("STT",array("style"=>"text-align:center; width:3%")),
									"date"=>array("Ngày chứng từ",array("style"=>"text-align:center;")),
                                    "class"=>array($str_group_name,array("style"=>"text-align:left; width:20%")),
									"user"=>array("Người Lập phiếu",array("style"=>"text-align:center;")),
                                    "customer"=>array($str_customer_label,array("style"=>"text-align:center; width:10%")),
									"desc"=>array("Diễn giải",array("style"=>"text-align:center; width:10%")),
									"amount"=>array("Số tiền",array("style"=>"text-align:center; width:10%")),
									"chitiet"=>array("Tùy chọn",array("style"=>"text-align:center;width:10%")));

    //buoc 2: dung hàm load_table_header de lay template table header
    $str_header_attendance = $this->Template->load_table_header($array_header_attendance);

    //buoc 3: duyet du lieu tu database tra ve de dua vao bảng
    $str_row_attendance = "";
    $i = 0;
	$total_amount = 0;
    if($array_thuchi)
    {	
        foreach($array_thuchi as $thuchi)
        {	
			$id = $thuchi['id'];
			$type=$thuchi['type'];
			$type_account=$thuchi['type_account'];
			$total_amount += $thuchi['amount'];
            $array_row_attendance['stt']     = array(++$i,array("style"=>"text-align:center"));
			$array_row_attendance['date']     = array($thuchi['issued_date'],array("style"=>"text-align:center"));
			
			$str_group_value="";
			if($this->get_config("thuchi_class") == "yes")
			{
				$str_group_value=$thuchi['classroom_name']."( <span style='color:blue;font-weight:bold'>".date("m-Y",strtotime($thuchi['month_year']))."</span> )";
			}else 
			{
				if($this->get_config("thuchi_project") == "yes")
				{
					$str_group_value=$thuchi['project_name'];
				}
			}
            $array_row_attendance['class']   = array($str_group_value,array("style"=>"text-align:left"));
			$array_row_attendance['siso']   = array($thuchi['username'],array("style"=>"text-align:center"));
			$array_row_attendance['dihoc']   = array($thuchi['customer_name'],array("style"=>"text-align:center"));
			$array_row_attendance['nuabuoi']   = array($thuchi['desc'],array("style"=>"text-align:center"));
			$array_row_attendance['vang']   = array(number_format($thuchi['amount']),array("style"=>"text-align:center"));
			
			$link_sua = "";
			$link_xoa = "";
			$link_chitiet = "";
			
			$link_chitiet 	= $this->Html->link(array("controller"=>"thuchi","action"=>"chitiet","params"=>array($id)));
			$link_chitiet	= $this->Template->load_link("edit","Chi tiết",$link_chitiet);	
			
			$link_sua	= $this->Html->link(array("controller"=>"thuchi","action"=>"add","params"=>array($id)));//link:  /thuchi/add/1.html
			$link_sua    .= "?type=$type&type_account=$type_account";
			$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
			
			$link_xoa	= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa","params"=>array($id,$type,$type_account)));
			$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);	
			
			
			$array_row_attendance['chitiet'] = array($link_chitiet."<br>".$link_sua."<br>".$link_xoa,array("style"=>"text-align:center"));
			
            $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
        }
		//Tổng cộng
		$array_row_thuchi["tong"] = array("Tổng Cộng",array("style"=>"text-align:right;","colspan"=>"6"));
		$array_row_thuchi['tongsotien'] = array(number_format($total_amount),array("style"=>"text-align:left;font-weight: bold; color:blue","colspan"=>"2"));
		$str_row_attendance .= $this->Template->load_table_row($array_row_thuchi);

    }
    else
    {
        $array_row_attendance["nodata"] = array("Không có dữ liệu",array("style"=>"text-align:center;","colspan"=>"8"));
        $str_row_attendance .= $this->Template->load_table_row($array_row_attendance);
    }

    //buoc 5: dung lam load_table de dữ liệu vào table
    $str_table_attendance =  $this->Template->load_table($str_header_attendance.$str_row_attendance);

    //buoc 6: hien thi du lieu table ra man hinh
    echo $str_table_attendance;
	

    //END FUNCTION CONTENT
    //*****************************************
?>

<script type="text/javascript">
    $( function() {
        $( "#startday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
    $( function() {
        $( "#finishday" ).datepicker({dateFormat: "dd-mm-yy"});
    } );
</script>