<div id="main">
	<div class="title">
		<div class="title_img"></div>
		<h1>Quản lý module</h1>
	</div>
	<div class="list_view">
		<div style="float:left;text-align:left; font-family:Tahoma; font-size:12px; margin-left: 20px; border: solid 0px; color: #333  ">
				<form action="<?php echo $this->webroot;?>module.html" id="timkiem" method="post" name="timiem">
					Tên module: 	
                    <input name="search" id="search" type="text" size="20" value="<?php echo $search; ?>" /> 
					<input type="submit" value="Tìm kiếm" />
                    
                </form>
		</div>	
		<div style="float:right; margin-right:20px; margin-top:5px;" class="add">
			<a href="<?php echo $this->webroot;?>module/nhap_module.html" ><img src="images/add.png" alt="+" />Nhập module </a>
		</div>		
	</div>   
	<table class="table" cellpadding="3" cellspacing="0" border="0">
		<tr class="title_table" style="background-color:#009; color:#FFF">
			<td align="center"  width="30">Stt</td>
            <td align="center">Tiêu đề</td>
            <td align="center">Package</td>
            <td align="center">Folder</td>			
            <td align="center">Class name</td>
            <td align="center">Mô tả</td>
			<td align="center">Chức năng</td>
			<td align="center" style="width:50px">Sửa</td>
			<td align="center" style="width:50px">Xóa</td>
		</tr>
		
        <?php
			$stt=0;
        	foreach($array_module as $row)
			{
				$stt++;
		?>
        <tr class="con_table">
			<td  width="30" align="center"><?php echo $stt ;?></td>
            <td align="center"><?php echo $row["title"]; ?></td>
            <td align="center"><?php echo $row["package"]; ?></td>
            <td align="center"><?php echo $row["folder"]; ?></td>			
            <td align="center"><?php echo $row["classname"]; ?></td>			
            <td align="center"><?php echo $row["des"]; ?></td>
			<td align="center">
	         <?php 
					$link_function 	= $this->Html->link(array("controller"=>"module2","action"=>"list_function","params"=>array($row["id"])));
					$link_function	= $this->Template->load_link("edit","Function",$link_function);
					echo $link_function;	
			?>                
            </td>			
			<td align="center">
            	<?php 
					$link_sua 	= $this->Html->link(array("controller"=>"module2","action"=>"add","params"=>array($row["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
					echo $link_sua;	
				?>
            </td>
			<td align="center">
            	<?php
					//lay liên kết để xóa
					$link_xoa = $this->Html->link(array("controller"=>"module2","action"=>"delete","params"=>array($row["id"])));
					$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
					echo $link_xoa;
				?>
            </td>
		</tr>
        <?php		
			}
		?>
        </table>

	</div> 
     <script language="javascript">
		function kiemtra_xoa(id)
		{
		 	kq = confirm("Bạn có muốn xóa không?");
			if(kq == true){
				window.location.href = "<?php echo $this->webroot;?>module2/delete/"+ id +".html";
			}
		}
	 </script>
</div>