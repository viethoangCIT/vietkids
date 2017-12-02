
<!-- Bat dau noi dung -->
<?php
	//function header
	$function_title="Danh Sách Lớp Học";
	echo $this->Template->load_function_header($function_title);
	//end function header
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Từ ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tungay","id"=>"tungay","style"=>"width:100px","value"=>$tungay));
	
	$str_timkiem .= $this->Template->load_label(" Đến ngày: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"denngay","id"=>"denngay","style"=>"width:100px","value"=>$denngay));
	
	$str_timkiem .= $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:180px","value"=>$tim));
	
	$str_timkiem .= " ".$this->Template->load_button(array("id"=>"tim","style"=>"width:80px","value"=>"Tìm"),"Tìm","search");
	
	$link_danhsach = $this->Html->link(array("controller"=>"classroom","action"=>"index"));	
	$str_timkiem = $this->Template->load_form(array("action"=>$link_danhsach,"method"=>"get","id"=>"form_timkiem"),$str_timkiem);	
	echo $str_timkiem;	
	//*****************************************
	//END TIM KIEM
		
	$msg = $this->Session->get_flash("msg");
	if($msg=='del_ok') echo $this->Template->load_label("Xóa thành công","","success");
	if($msg=='exist_student') echo $this->Template->load_label("Lỗi","Không thể xóa vì có học sinh trong lớp","success");
		
		//lay html table header
		$array_header_table =array(
								"stt"=>array("STT"),
								"name"=>array("Tên Lớp"), 
								"code"=>array("Mã Lớp"), 
								"des"=>array("Mô Tả"),
								"year"=>array("Năm"),
								"from"=>array("Thời Gian Bắt Đầu"),
								"to"=>array("Thời Gian Kết Thúc"),
								"arrange"=>array("Xếp Lớp"),
								"edit"=>array("Tùy Chọn",array("style"=>"text-align:center; width:14%")),
							);
		$str_table_header=$this->Template->load_table_header($array_header_table);
		
		//lay html noi dung classroom 
		$str_table_content_classroom = "";
		$stt = 1;
		if($array_classroom)
		{
			foreach($array_classroom as $classroom)
			{
				$link_sua=$this->Template->load_link("edit","Sửa","/classroom/add?id=".$classroom["id"]);
				$link_xoa=$this->Template->load_link("del","Xóa","/classroom/del?id=".$classroom["id"]);
				
				$from1 = date("d-m-Y",strtotime($classroom["from"]));
				$to1 = date("d-m-Y",strtotime($classroom["to"]));
				
				$xeplop_hocsinh 	= $this->Html->link(array("controller"=>"classroom","action"=>"arrange","params"=>array($classroom["id"],"0")));
				$xeplop_hocsinh	= $this->Template->load_link("download","Trẻ ",$xeplop_hocsinh);	
				
				$xeplop_giaovien 	= $this->Html->link(array("controller"=>"classroom","action"=>"arrange","params"=>array($classroom["id"],"1")));
				$xeplop_giaovien	= $this->Template->load_link("download","Giáo viên",$xeplop_giaovien);	
				
				$ap_bieuphi_lop 	= $this->Html->link(array("controller"=>"fee","action"=>"arrange_class","params"=>array($classroom["id"])));
				$ap_bieuphi_lop	= $this->Template->load_link("download","Áp biểu phí lớp",$ap_bieuphi_lop);	
				
				$ap_bieuphi_tre 	= $this->Html->link(array("controller"=>"fee","action"=>"arrange","params"=>array($classroom["id"])));
				$ap_bieuphi_tre	= $this->Template->load_link("download","Áp biểu phí trẻ",$ap_bieuphi_tre);	
				
				$len_lop 	= $this->Html->link(array("controller"=>"classroom","action"=>"level","params"=>array($classroom["id"])));
				$len_lop	= $this->Template->load_link("edit","Chuyển lớp",$len_lop);	
				
				//tao mang noi dung classroom
				$array_classroom=array(
										"stt"=>array($stt++),
										"name"=>array($classroom["name"]),
										"code"=>array($classroom["code"],array("style"=>"text-align: center")),
										"des"=>array($classroom["des"]),
										"year"=>array($classroom["year"],array("style"=>"text-align: center")),
										"from"=>array($from1,array("style"=>"text-align: center")),
										"to"=>array($to1,array("style"=>"text-align: center")),
										"arrange"=>array($xeplop_hocsinh."<br>".$xeplop_giaovien."<br>".$len_lop),
										"edit"=>array($ap_bieuphi_lop."<br>".$ap_bieuphi_tre."<br>".$link_sua."<br>".$link_xoa));
				//lay html row classroom
				$str_table_content_classroom.=$this->Template->load_table_row($array_classroom);
			}
		}else
		{
			$array_classroom=array(
									"stt"=>array("Không tìm thấy dữ liệu !!",array("style"=>"text-align: center","colspan"=>"9"))
									);
			
			//lay html row classroom
			$str_table_content_classroom.=$this->Template->load_table_row($array_classroom);							
		}
		
		//lay html table classroom
			$str_table_classroom=$this->Template->load_table($str_table_header. $str_table_content_classroom,array("style" =>"width:100%"));
			echo $str_table_classroom;
			
		//end function content
	
?>

<!-- Ket thuc noi dung -->

<script type="text/javascript">
	$(function()
	{
		$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"});
		$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"});
		
	});
	function kiemtra()
	{
		input_name = document.getElementById("name");
		input_des = document.getElementById("des");
		input_year = document.getElementById("year");
		
		if(input_name.value == ""){
			document.getElementById("lbl_name").innerHTML = "Vui lòng nhập tên phòng";
			return;
		}
		if(input_year.value == ""){
			document.getElementById("lbl_price").innerHTML = "Vui lòng nhập năm";
			return;
		}
		document.getElementById("str_form").submit();
		
	//end function kiem tra	
	}
	
</script>

