<?php
if($array_thuchi)
{
	$ngay = date("d",strtotime($array_thuchi[0]["issued_date"]));
	$thang = date("m",strtotime($array_thuchi[0]["issued_date"]));
	$nam = date("Y",strtotime($array_thuchi[0]["issued_date"]));
	$username_receive = $array_thuchi[0]["name"];
	$amount  = $array_thuchi[0]["amount"];
	$desc  = $array_thuchi[0]["desc"];
	$unit  = $array_thuchi[0]["unit"];
	$num  = $array_thuchi[0]["num"];
}
?>
<div style="width:100%">
	<div style="padding:15px 15px">
    	<div style="width:100%; height:80px">
            <div style="width:55%; float:left">
                <div style="width:20%; float:left">
                    <img src="http://dieuhanh.khietlong.vn/files/khietlong/khietlong_logo.png" style="width:65px"/>
                </div>
                <div style="width:80%; float:left">
                    <b>TRƯỜNG MẦM NON VIETKIDS</b><br>
                    <b>Lô 04 đường 15m Nại Hiên Đông, ĐN</b><br>
                    <b>ĐT: 0236.918586. Fax: 3918587</b><br>
                </div>
            </div>
            
            <div style="width:45%; float:left; text-align:center">
            	<div style="width:95%; float:right">
                    <b>Mẫu số: 02 TT</b><br>
                    <b>Ban hành theo QĐ số 15/2006 QĐ-BTC ngày 20/03/2006 của Bộ trưởng BTC</b>
                </div>    
            </div>
        </div>    
        
        <div style="width:100%">
        	<h2 style="text-align:center; margin-top:40px; margin-bottom:10px">PHIẾU CHI</h2>
            <div style="text-align:center; margin-bottom:30px">Ngày <?php echo $ngay; ?> tháng <?php echo $thang; ?> năm <?php echo $nam; ?></div>
            <p>Họ và tên người nhận tiền: <?php echo $username_receive; ?></p>
            <p>Lí do chi: <?php echo $desc; ?></p>
            <p>Số tiền: <?php echo number_format($amount)." ".$unit; ?></p>
            <p id="chuyentien_thanhchu">Viết bằng chữ: </p>
            
            <br>
            <p style="text-align:right">Đà Nẵng, ngày.....tháng.....năm 20.....</p>
            <br>
            <table style="width:100%">
            	<tr>
                	<th style="text-align:left; padding-left: 20px;">Người chi tiền</th>
                	<th style="text-align:right; padding-right: 13px;">Người nhận tiền</th>
                </tr>
               
            	<tr>
                	<td>(Ký và ghi rõ hộ tên)</td>
                	<td style="text-align:right">(Ký và ghi rõ hộ tên)</td>
                </tr>
            </table>
            <!--<p style="margin-top:100px">Đã nhận đủ số tiền (viết bằng chữ): ..............................................................</p>
           
            <p>+ Tỷ giá ngoại tệ (vàng, bạc, đá quý): ....................................................................................</p>
            <p>+ Số tiền quy đổi: ........................................................................................................</p>
            <b>(Liên gửi ra ngoài phải đóng dấu)</b>-->
        </div>
        
    </div>
</div>
<script>

    window.print();
var ChuSo=new Array(" không "," một "," hai "," ba "," bốn "," năm "," sáu "," bảy "," tám "," chín ");
var Tien=new Array( "", " nghìn", " triệu", " tỷ", " nghìn tỷ", " triệu tỷ");

//1. Hàm đọc số có ba chữ số;
function DocSo3ChuSo(baso)
{
    var tram;
    var chuc;
    var donvi;
    var KetQua="";
    tram=parseInt(baso/100);
    chuc=parseInt((baso%100)/10);
    donvi=baso%10;
    if(tram==0 && chuc==0 && donvi==0) return "";
    if(tram!=0)
    {
        KetQua += ChuSo[tram] + " trăm ";
        if ((chuc == 0) && (donvi != 0)) KetQua += " linh ";
    }
    if ((chuc != 0) && (chuc != 1))
    {
            KetQua += ChuSo[chuc] + " mươi";
            if ((chuc == 0) && (donvi != 0)) KetQua = KetQua + " linh ";
    }
    if (chuc == 1) KetQua += " mười ";
    switch (donvi)
    {
        case 1:
            if ((chuc != 0) && (chuc != 1))
            {
                KetQua += " mốt ";
            }
            else
            {
                KetQua += ChuSo[donvi];
            }
            break;
        case 5:
            if (chuc == 0)
            {
                KetQua += ChuSo[donvi];
            }
            else
            {
                KetQua += " lăm ";
            }
            break;
        default:
            if (donvi != 0)
            {
                KetQua += ChuSo[donvi];
            }
            break;
        }
    return KetQua;
}

//2. Hàm đọc số thành chữ (Sử dụng hàm đọc số có ba chữ số)

function DocTienBangChu(SoTien)
{
    var lan=0;
    var i=0;
    var so=0;
    var KetQua="";
    var tmp="";
    var ViTri = new Array();
    if(SoTien<0) return "Số tiền âm !";
    if(SoTien==0) return "Không đồng !";
    if(SoTien>0)
    {
        so=SoTien;
    }
    else
    {
        so = -SoTien;
    }
    if (SoTien > 8999999999999999)
    {
        //SoTien = 0;
        return "Số quá lớn!";
    }
    ViTri[5] = Math.floor(so / 1000000000000000);
    if(isNaN(ViTri[5]))
        ViTri[5] = "0";
    so = so - parseFloat(ViTri[5].toString()) * 1000000000000000;
    ViTri[4] = Math.floor(so / 1000000000000);
     if(isNaN(ViTri[4]))
        ViTri[4] = "0";
    so = so - parseFloat(ViTri[4].toString()) * 1000000000000;
    ViTri[3] = Math.floor(so / 1000000000);
     if(isNaN(ViTri[3]))
        ViTri[3] = "0";
    so = so - parseFloat(ViTri[3].toString()) * 1000000000;
    ViTri[2] = parseInt(so / 1000000);
     if(isNaN(ViTri[2]))
        ViTri[2] = "0";
    ViTri[1] = parseInt((so % 1000000) / 1000);
     if(isNaN(ViTri[1]))
        ViTri[1] = "0";
    ViTri[0] = parseInt(so % 1000);
  if(isNaN(ViTri[0]))
        ViTri[0] = "0";
    if (ViTri[5] > 0)
    {
        lan = 5;
    }
    else if (ViTri[4] > 0)
    {
        lan = 4;
    }
    else if (ViTri[3] > 0)
    {
        lan = 3;
    }
    else if (ViTri[2] > 0)
    {
        lan = 2;
    }
    else if (ViTri[1] > 0)
    {
        lan = 1;
    }
    else
    {
        lan = 0;
    }
    for (i = lan; i >= 0; i--)
    {
       tmp = DocSo3ChuSo(ViTri[i]);
       KetQua += tmp;
       if (ViTri[i] > 0) KetQua += Tien[i];
       if ((i > 0) && (tmp.length > 0)) KetQua += ',';//&& (!string.IsNullOrEmpty(tmp))
    }
   if (KetQua.substring(KetQua.length - 1) == ',')
   {
        KetQua = KetQua.substring(0, KetQua.length - 1);
   }
   KetQua = KetQua.substring(1,2).toUpperCase()+ KetQua.substring(2);
   return KetQua;//.substring(0, 1);//.toUpperCase();// + KetQua.substring(1);
   
}
var sotien_canchuyen = <?php echo $amount; ?> 
document.getElementById("chuyentien_thanhchu").innerHTML = "Bằng chữ: " + DocTienBangChu(sotien_canchuyen) + " Việt Nam Đồng.";
</script>