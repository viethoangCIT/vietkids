<?php 
$module_package = str_replace("/","-----",$module_package);
?>
<div id="main">
	<div class="title">
		<div class="title_img"></div>
		<h1>Danh sách Bảng của chức năng</h1>
	</div>
	<div class="list_view">
		<div style="float:right; margin-right:20px; margin-top:5px;" class="add">
			<a href="<?php echo $this->webroot;?>module/add_csdl/<?php echo $id_module."//".$module_name."/".$module_package;?>.html" ><img src="images/add.png" alt="+" />Nhập CSDL</a>
		</div>		
	</div>   
	<table class="table" cellpadding="3" cellspacing="0" border="0">
		<tr class="title_table">
			<td align="center"  width="30">Stt</td>
            <td align="center">Module Name</td>
            <td align="center">Module Package</td>
            <td align="center">Table Name</td>
            <td align="center">Table Title</td>
            <td align="center">SQL</td>			
            <td align="center">Cột đại diện</td>
            <td align="center">Quản lý column</td>
			<td align="center">Sửa</td>
			<td align="center">Xóa</td>
		</tr>
		
        <?php
		if($array_csdl)
		{
			$stt=0;
        	foreach($array_csdl as $row)
			{
				$stt++;
		?>
        <tr class="con_table">
			<td  width="30" align="center"><?php echo $stt ;?></td>
            <td align="center"><?php echo $row["module_name"]; ?></td>
            <td align="center"><?php echo $row["module_package"]; ?></td>
            <td align="center"><?php echo $row["table_name"]; ?></td>
             <td align="center"><?php echo $row["table_title"]; ?></td>
            <td align="center"><?php echo $row["sql_created"]; ?></td>			
            <td align="center"><?php echo $row["data_col"]; ?></td>
            <td align="center"><a href="<?php echo $this->webroot;?>module/set_table_column/<?php echo $id_module."/".$row["table_name"];?>.html" class="edit"></a></td>			
			<td align="center"><a href="<?php echo $this->webroot;?>module/add_csdl/<?php echo $id_module."/".$row["id"]."/".$module_name."/".$module_package;?>.html" class="edit"></a></td>
			<td align="center"><a href="<?php echo $this->webroot;?>module/del_csdl/<?php echo $id_module."/".$row["id"];?>.html" class="del"></a></td>
		</tr>
        <?php		
			}
		}else
		{
			echo "<tr><td colspan='10' align='center'>Không có dữ liệu</td></tr>";
		}
		?>
        </table>

	</div> 
     <script language="javascript">
		function kiemtra_xoa(id)
		{
		 	kq = confirm("Bạn có muốn xóa không?");
			if(kq == true){
				window.location.href = "<?php echo $this->webroot;?>linhvuc/xoa/"+ id +".html";
			}
		}
	 </script>
</div>