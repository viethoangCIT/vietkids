<style>
.btn_icon_download{float:right !important}
</style>
<?php
	//*****************************************
	//FUNCTION HEADER
	//*****************************************
	
	//tieu de cua ham
	$function_title = "CHI TIẾT $type";
	
	echo $this->Template->load_function_header($function_title);
	
	
	//*****************************************
	//END FUNCTION HEADER
	//*****************************************	
	
	if($array_thuchi)
	{
		$customer_name = $array_thuchi[0]["customer_name"];
		$classroom_name = $array_thuchi[0]["classroom_name"];
		$group_name = $array_thuchi[0]["group_name"];
		$month_year  = $array_thuchi[0]["month_year"];
		if($month_year != "") $month_year = "tháng ".date("m/ Y",strtotime($array_thuchi[0]["month_year"]));
		$username  = $array_thuchi[0]["username"];
		$amount  = $array_thuchi[0]["amount"];
		$desc  = $array_thuchi[0]["desc"];
		$unit  = $array_thuchi[0]["unit"];
		$issued_date  = date("d-m-Y",strtotime($array_thuchi[0]["issued_date"]));
		if($issued_date == "01-01-1970") $issued_date = "";
		$num  = $array_thuchi[0]["num"];
		$id  = $array_thuchi[0]["id"];
	}
	
	$str_thongtin = "<h4><b style='color:#2f83b7'>Số chứng từ:</b> $num &nbsp;&nbsp;&nbsp; <b style='color:#2f83b7'>Ngày chứng từ: </b>$issued_date </h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Người chứng từ:</b> $username</h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Loại:</b> $group_name $month_year </h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Họ và tên:</b> $customer_name</h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Lớp:</b> $classroom_name</h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Số tiền:</b> $amount $unit</h4>";
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Diễn giải:</b> $desc</h4>";
	
	$phieuthu 	= $this->Html->link(array("controller"=>"revenue","action"=>"phieu_thu","params"=>array($id)));
	$phieuthu	= $this->Template->load_link("download","In phiếu thu",$phieuthu);
	
	$str_thongtin .= "<h4><b style='color:#2f83b7'>Biểu phí:</b> $phieuthu</h4><br>";
	
	echo $str_thongtin;
	//buoc 1: tao 1 dòng đầu tiên của table
	
	$array_header_thuchi =  array(
							"stt"=>array("STT",array("style"=>"text-align:center")),
							"service"=>array("Dịch vụ",array("style"=>"text-align:center")),
							"price"=>array("Giá",array("style"=>"text-align:center;")),
				);
	//buoc 2: dung hàm load_table_header de lay template table header		
	$str_header_thuchi = $this->Template->load_table_header($array_header_thuchi);
			
	
	//buoc 3: duyet du lieu tu database tra ve de dua vao bảng
	//load row table thuchi
	$str_row_thuchi = "";
	
	if($array_bieuphi != NULL)
	{
		$str_service = $array_bieuphi[0]["str_service"];
		$array_dichvu = explode(chr(9),$str_service);
		$ten_dichvu = "";
		$gia_dichvu = "";
		$tong_gia_dichvu = 0;
		for($i = 0;$i < (count($array_dichvu) - 1);$i++)
		{
			$array_chitiet_dichvu = explode(chr(8),$array_dichvu[$i]);
			$ten_dichvu = $array_chitiet_dichvu[0];
			$gia_dichvu = $array_chitiet_dichvu[1];
			$tong_gia_dichvu += $gia_dichvu;
		
			$array_row_thuchi = NULL;
			$array_row_thuchi["stt"] 	= array($i+1,array("style"=>"text-align:center;"));
			$array_row_thuchi["service"] = array($ten_dichvu,array("style"=>"text-align:left;"));
			$array_row_thuchi["price"] 	= array(number_format($gia_dichvu),array("style"=>"text-align:right;"));
			
			$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
		}
		
		$array_row_thuchi = NULL;
		$array_row_thuchi["stt"] 	= array("<b>Tổng tiền</b>",array("style"=>"text-align:center; color:#0db400","colspan"=>"2"));
		$array_row_thuchi["price"] 	= array(number_format($tong_gia_dichvu),array("style"=>"text-align:right; color:red; font-weight:bold"));
		
		$str_row_thuchi .= $this->Template->load_table_row($array_row_thuchi);
	}
	
	//buoc 5: dung lam load_table de dữ liệu vào table
	$str_table_thuchi =  $this->Template->load_table($str_header_thuchi.$str_row_thuchi);
	//buoc 6: hien thi du lieu table ra man hinh
	echo $str_table_thuchi;
?>
<script>
	
	
$(function()
{
	
	$( "#tungay" ).datepicker({dateFormat: "dd-mm-yy"})
	$( "#denngay" ).datepicker({dateFormat: "dd-mm-yy"})
});
</script>
