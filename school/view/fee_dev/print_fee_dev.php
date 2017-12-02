<?php
        $hocphi = "";
		$tienan = "";
		$antoi = "";
        $hocphi_daunam = "";
        $tienhoc_thu7 = "";
		$sinhnhat = "";
		$thua_thangtruoc = "";
		$thieu_thangtruoc ="";
		$tongcong = "";

        $bangchu = "";
        $fullname = "";
        $lop = "";
        $tien_thu = "";
        $thang = "";

        $str_service = "";
        if($fee)
        {
            $fullname = $fee["customer_name"];
            $lop = $fee["classroom_name"];
            $tien_thu = $fee["total_amount"];
            $thang = strtotime($fee["month_year"]);

            $thang = date("d-m-Y",$thang);

            $str_service = $fee["str_service"];
            //echo $str_service;
            //cắt chuỗi dịch vụ thành các dòng, mỗi dòng cách nhau bằng kí tự chr(9)
            $array_service = explode(chr(9),$str_service);
            //print_r($array_service);

        }
?>

<style>
    .pagebreak { page-break-before: always; }
</style>
<div style="width:21cm;">
	<div style="padding:15px 15px">
    	<div style="width:350px; height:80px; margin-left:auto; margin-right:auto">
        	<div style="width:25%; float:left">
            	<img src="http://dieuhanh.khietlong.vn/files/khietlong/khietlong_logo.png" style="width:65px"/>
            </div>
            <div style="width:75%; float:left">
            	<b>TRƯỜNG MẦM NON VIETKIDS</b><br>
                <b>Lô 04 đường 15m Nại Hiên Đông, ĐN</b><br>
                <b>ĐT: 0236.918586. Fax: 3918587</b><br>
                <b style="padding-left:80px">*****</b>
            </div>
        </div>
        
        <div style="width:100%">
            <h2 style="text-align:center">Thông báo học phí</h2>
            <p>Họ tên trẻ: <?php echo $fullname; ?> </p>
            <p>Lớp: <?php echo $lop ?></p>
			<p>Tháng: <?php echo $thang; ?></p>
            <p>Số tiền thu: <?php echo number_format($tien_thu);?> VNĐ</p>
            <p>Chi tiết: </p>
            <table style="width:40%; margin-left: 30px">
            <?php
                $tienhoc_thu7 = 0;
                $hocphi = 0;
                $bantru_phuphi = 0;
                $tienan = 0;
                $tiensua = 0;

                $tienan_thu7 = 0;
                $tong_hocphi = 0;
                $tong_tienan = 0;
                $tien_antoi = 0;

                $phihoc_daunam = 0;
                $sinhnhat = 0;
                $thua_thangtruoc = 0;
                $thieu_thangtruoc = 0;
                for($i = 0 ; $i < count($array_service); $i++)
                {
                    //cắt chuỗi service thành 3 phần: 1.Tên dịch vụ, 2.Số tiền, 3.Mã dịch vụ
                    //Mỗi phần cách nhau bằng kí tự chr(8)
                    // echo $array_service[$i];
                    $array_service_item = explode(chr(8),$array_service[$i]);
                    //print_r($array_service_item);
                    $ten_dichvu = "";
                    $tien_dichvu = "";
                    $ma_dichvu = "";
                    
                    if(isset($array_service_item[0]))   $ten_dichvu = $array_service_item[0];
                    if(isset($array_service_item[1]))   $tien_dichvu = $array_service_item[1];
                    if(isset($array_service_item[3]))   $ma_dichvu = $array_service_item[3];

                    if($ma_dichvu == "tienhoc_thu7") $tienhoc_thu7 = $tien_dichvu;
                    if($ma_dichvu == "hocphi") $hocphi = $tien_dichvu;
                    if($ma_dichvu == "bantru_phuphi") $bantru_phuphi = $tien_dichvu;

                    if($ma_dichvu == "tienan") $tienan = $tien_dichvu;
                    if($ma_dichvu == "sua") $tiensua = $tien_dichvu;
                    if($ma_dichvu == "tienan_thu7") $tienan_thu7 = $tien_dichvu;

                    if($ma_dichvu == "antoi") $tien_antoi = $tien_dichvu;
                    if($ma_dichvu == "phihoc_daunam") $phihoc_daunam = $tien_dichvu;
                    if($ma_dichvu == "sinhnhat") $sinhnhat = $tien_dichvu;

                    if($ma_dichvu == "thua") $phihoc_daunam = $tien_dichvu;
                    if($ma_dichvu == "phihoc_daunam") $phihoc_daunam = $tien_dichvu;

                    if($ma_dichvu == "thua_thangtruc") $thua_thangtruoc = $tien_dichvu;
                    if($ma_dichvu == "thieu_thangtruoc") $thieu_thangtruoc = $tien_dichvu;

            
                }//END: foreach($array_service as $service)

                $tong_hocphi = $hocphi + $tienhoc_thu7 + $bantru_phuphi;
                $tong_tienan = $tienan + $tiensua + $tienan_thu7;

            ?>
                <tr>
                    <td>Học phí:</td>
                    <td style="text-align:right"><?php echo number_format($tong_hocphi);?></td>
                </tr>
                <tr>
                    <td>Tiền ăn:</td>
                    <td style="text-align:right"><?php echo number_format($tong_tienan) ;?></td>
                </tr>
                <tr>
                    <td>Ăn tối:</td>
                    <td style="text-align:right"><?php echo number_format($tien_antoi) ;?></td>
                </tr>
            <?php 
                if($phihoc_daunam != 0)
                {

                
            ?>
                <tr>
                    <td>Học phí đầu năm:</td>
                    <td style="text-align:right"><?php echo number_format($phihoc_daunam) ;?></td>
                </tr>
            <?php
                }
            ?>

            <?php 
                if($sinhnhat != 0)
                {  
            ?>
                <tr>
                    <td>Sinh nhật:</td>
                    <td style="text-align:right"><?php echo number_format($sinhnhat) ;?></td>
                </tr>
            <?php 
                }
            ?>

            <?php 
                if($thua_thangtruoc != 0)
                {

                
            ?>
                <tr>
                    <td>Thừa tháng trước:</td>
                    <td style="text-align:right"><?php echo number_format($thua_thangtruoc) ;?></td>
                </tr>
            <?php 
                }
            ?>

            <?php 
                if($thieu_thangtruoc != 0)
                {

                
            ?>
                <tr>
                    <td>Thiếu tháng trước:</td>
                    <td style="text-align:right"><?php echo number_format($thieu_thangtruoc) ;?></td>
                </tr>
            <?php 
                }
            ?>
            </table>
            <p id="chuyentien_thanhchu">Bằng chữ: <?php echo $bangchu;?></p>
            <br>
            <p style="text-align:right">Đà Nẵng, ngày.....tháng.....năm 20.....</p>
            <br>
            <table style="width:100%">
            	<tr>
                	<th style="text-align:left; padding-left: 20px;">Người nộp tiền</th>
                	<th style="text-align:right; padding-right: 20px;">Người thu tiền</th>
                </tr>
               
            	<tr>
                	<td>(Ký và ghi rõ hộ tên)</td>
                	<td style="text-align:right">(Ký và ghi rõ hộ tên)</td>
                </tr>
            </table>
        </div>
        
    </div>
</div>
<div class="pagebreak"> </div>
