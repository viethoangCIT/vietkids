<?php 
	
	$function_title="Chuyển Lớp trẻ";
	echo $this->Template->load_function_header($function_title);

	if($array_danhsach_lop)
	{
		$classroom_name = $array_danhsach_lop[0]["classroom_name"];
		//$id_classroom = $array_danhsach_lop[0]["id_classroom"];
		$start_date = date("d-m-Y",strtotime($array_danhsach_lop[0]["start_date"]));
		$finish_date = date("d-m-Y",strtotime($array_danhsach_lop[0]["finish_date"]));
	}
	
	$str_form_lenlop = $this->Template->load_form_row(array("title"=>"Lớp Hiện Tại","input"=>$classroom_name));
	
	$str_form_lenlop .= $this->Template->load_form_row(array("title"=>"Ngày","input"=>$start_date." - ".$finish_date));
	
	$str_form_lenlop .= $this->Template->load_form_row(array("title"=>"Chuyển Lớp","input"=>$this->Template->load_selectbox(array("name"=>"data[XepLop][id_classroom]","id"=>"id_classroom","style"=>"width:30%"),$array_lop_hoc)));
	$str_form_lenlop .= $this->Template->load_hidden(array("name"=>"data[XepLop][classroom_name]","id"=>"classroom_name"));
	
	//TIM KIEM
	//*****************************************
	
	$str_timkiem = $this->Template->load_label(" Tìm kiếm: ","","search_list");
	$str_timkiem .= $this->Template->load_textbox(array("name"=>"tim","id"=>"tim","style"=>"width:214px","onkeyup"=>"timkiem()"));
	
	//*****************************************
	//END TIM KIEM
	
	$check_all = "<input type='checkbox' onchange='checkAll(this)' checked/>";
	
	//lấy danh sách học sinh
	$array_header_CheckList =  array("stt"=>array("STT",array("style"=>"text-align:center; width:10%")),
							"name"=>array("Họ Và Tên",array("style"=>"text-align:left;")),
							"classroom_check"=>array("Chuyển Lớp $check_all",array("style"=>"text-align:center")),	
					);
			
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_CheckList = $this->Template->load_table_header($array_header_CheckList);
	
	//Lấy nội dung của bảng định lượng
	
	$str_row_CheckList = "";
	$stt = 0;
	
	if($array_danhsach_lop)
	{
		foreach($array_danhsach_lop as $lenlop)
		{
			$str_form_xem = "<input type='checkbox' name='data[XepLop][LenLop][$stt][id]' value='".$lenlop["id"]."' checked/>";
			$id_customer = $this->Template->load_hidden(array("name"=>"data[XepLop][LenLop][$stt][id_fullname]","value"=>$lenlop["id_fullname"]));
			$customer_name = $this->Template->load_hidden(array("name"=>"data[XepLop][LenLop][$stt][fullname]","value"=>$lenlop["fullname"]));
			
			$stt++;
			$array_row_CheckList = NULL;
			$array_row_CheckList["stt"] 				= array($stt,array("style"=>"text-align:center;"));
			$array_row_CheckList["name"] 				= array($lenlop["fullname"].$id_customer.$customer_name);
			$array_row_CheckList["classroom_check"] 	= array($str_form_xem,array("style"=>"text-align:center;"));
			
			//buoc 4: dung ham 	load_table_row de lay template table row co chua du lieu tu database
			//cong don vao chuoi $str_row_product
			$str_row_CheckList .= $this->Template->load_table_row($array_row_CheckList);
		}
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_row_table =  $this->Template->load_table($str_header_CheckList.$str_row_CheckList);
	//buoc 6: hien thi du lieu table ra man hinh
	
	
	
	
	
	
	$str_form_lenlop .= $this->Template->load_form_row(array("title"=>"Danh Sách Học Sinh","input"=>$str_timkiem));
	
	$str_form_lenlop .= $this->Template->load_form_row(array("title"=>"","input"=>$str_row_table));
	
	$button =  $this->Template->load_button(array("type"=>"submit"),"Lưu");
	$str_form_lenlop .= $this->Template->load_form_row(array("title"=>"","input"=>$button));
	$str_form_nhap = $this->Template->load_form(array("method"=>"POST","id"=>"form_nhap","action"=>"/classroom/level.html","onsubmit"=>"return kiemtra()"),$str_form_lenlop);
	
	echo $str_form_nhap;
?>
<script>
function kiemtra()
{
	document.getElementById("classroom_name").value = $("#id_classroom :selected").text();
}
 //tìm kiếm tên parseInt
 function timkiem() {
  var input, tim, table, tr, td, i;
  input = document.getElementById("tim");
  tim = input.value.toUpperCase();
  table = document.getElementById("movie-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(tim) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
} 

 function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
</script>