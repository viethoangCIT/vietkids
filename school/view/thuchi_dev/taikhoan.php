<?php 
	$function_title = "Xem thu chi";
	echo $this->Template->load_function_header($function_title);
	
	$str_top	= "<div style='float:left;width:50%;text-align:left;'><b>Công Ty Cổ Phần Khiết Long</b>
	<br/>109 Hoàng Sỹ Khải, Phường An Hải Bắc, Quận Sơn Trà, TP. Đà Nẵng
	<br/>Điện thoại: 0511.393.5775</div>";
	$str_top	.= "<div style='float:right;width:30%;text-align:center;'><b>Mẫu số B 01-DN</b>
	<br/>(Ban hành theo QĐ số 15/2006/QĐ-BTC<br/>
	ngày 20/03/2006 của Bộ trưởng BTC)</div><p style='clear:both'></p>";
	$str_top	.= "<h2 style='text-align:center;width:100%'>QUẢN LÝ TÀI TÀI KHOẢN</h2>
	<div style='text-align:center;width:100%;margin-top:-15px;'>(Theo QĐ số 15/2006/QĐ-BTC ngày 20/03/2006)</div>";
	/// table 1
	
	$array_tbl_top = array(
								"sohieu"=>array("Mã TK",array("style"=>"font-weight:bold;text-align:center;border:1px solid;")),
								"maso"=>array("Tên tài khoản",array("style"=>"font-weight:bold;text-align:center;border:1px solid;border-left:0px;")),
								"sua"=>array("Sửa",array("style"=>"text-align:center;border:1px solid;border-left:0px")),
								"xoa"=>array("Xóa",array("style"=>"text-align:center;border:1px solid;border-left:0px"))				
								
							 );
	$str_tbl_top = $this->Template->load_table_row($array_tbl_top);
	foreach ($array_taikhoan as $row)
	{
	$link_sua 	= $this->Html->link(array("controller"=>"thuchi","action"=>"taikhoan","params"=>array($row["ma"])));
	$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
	$link_xoa 	= $this->Html->link(array("controller"=>"thuchi","action"=>"xoa_taikhoan","params"=>array($row["ma"])));
	$link_xoa	= $this->Template->load_link("del","Xóa",$link_xoa);
	$array_tbl_row = array(
								"1"=>array($row["code"],array("style"=>"text-align:center;border:1px dotted;border-top:0px;border-left:1px solid;border-right:1px solid;")),
								"2"=>array($row["des"],array("style"=>"border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"edit"=>array($link_sua,array("style"=>"border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								"del"=>array($link_xoa,array("style"=>"border:1px dotted;border-top:0px;border-left:0px;border-right:1px solid;")),
								);
	$str_tbl_row .= $this->Template->load_table_row($array_tbl_row);
	}
	
	$str_tbl =  $this->Template->load_table($str_tbl_top.$str_tbl_row);	
	$str_body =  $this->Template->load_function_body($str_top.$str_tbl);	
	echo $str_body;
?>
