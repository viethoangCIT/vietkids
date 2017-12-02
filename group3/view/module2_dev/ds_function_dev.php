<style>
input
{
	color: #333;
}

</style>
<div id="main">
	<div class="title">
		<div class="title_img"></div>
		<h1>Quản lý chức năng</h1>
	</div>
	<div class="list_view">
		<div style="float:left;text-align:left; font-family:Tahoma; font-size:12px; margin-left: 20px; border: solid 0px;  ">
				<form action="<?php echo $this->webroot;?>module/list_function.html" id="frmFunction" method="post" name="frmFunction">
					
					<?php
					$id_module = "";
					$module_name = "";
					$module_title = "";
					$module_folder = "";
					$module_package = "";					
					
					$id_function = "";
					$name = "";
					$title = "";
					$description = "";
					$require_login = "0";
					if($array_module)
					{
						$id_module 		= $array_module[0]["id"];
						$module_name	= $array_module[0]["classname"];
						$module_title	= $array_module[0]["title"];
						$module_folder = $array_module[0]["folder"];
						$module_package = $array_module[0]["package"];						
					}
					
					if($array_tmp_function)
					{
					
						$id_function	= $array_tmp_function[0]["id"];
						$name			= $array_tmp_function[0]["name"];
						$title			= $array_tmp_function[0]["title"];						
						$description	= $array_tmp_function[0]["description"];												
						$require_login	= $array_tmp_function[0]["require_login"];																		
					
					}
					?>
					<span>Module: </span><span style="color:#009900; font-weight:bold"> <?php echo $module_title;?> - <?php echo $module_name;?></span>					
					&nbsp; | &nbsp;
					Tên: 						
                    <input name="data[function][title]" id="title" type="text" size="15" value="<?php echo $title;?>" /> 
					Tên hàm: 	
                    <input name="data[function][name]" id="name" type="text" size="10" value="<?php echo $name;?>" /> 
					Mô tả: 	
                    <input name="data[function][description]" id="description" type="text" size="20" value="<?php echo $description; ?>" /> 

					<script language="javascript">
						document.getElementById("require_login").value = "<?php echo $require_login;?>";
					</script>
					
                    <input name="data[function][id_module]" id="id_module" type="hidden" value="<?php echo $id_module; ?>"  /> 
                    <input name="data[function][module]" id="module" type="hidden" value="<?php echo $module_name; ?>"  /> 					
                    <input name="data[function][module_name]" id="module_name" type="hidden" value="<?php echo $module_name; ?>"  /> 
                    <input name="data[function][module_package]" id="module_package" type="hidden" value="<?php echo $module_package; ?>"  />                <input name="data[function][module_title]" id="module_title" type="hidden" value="<?php echo $module_title; ?>"  /> 															
                    <input name="data[function][module_folder]" id="module_folder" type="hidden" value="<?php echo $module_folder; ?>"  />
                    <input name="data[function][id]" id="id" type="hidden" value="<?php echo $id_function; ?>" /> 										
					<input type="submit" value="Lưu" />
                    
                </form>
		</div>	

	</div>   

	<table class="table" cellpadding="3" cellspacing="0" border="1">
		<tr class="title_table" style="background-color:#009; color:#FFF">
			<td  width="30" align="center">Stt</td>
            <td width="150">Tên chức năng</td>
            <td width="150">Tên hàm</td>
            <td width="200">Mô tả</td>
			<td align="center" style="width:50px">Sử Dụng Dữ liệu</td>
			<td align="center" style="width:50px">Sửa</td>
			<td align="center" style="width:50px">Xóa</td>

		</tr>
		
        <?php
		$stt=0;
		
		$array_login = array("0"=>"Không","1"=>"Có");
		if($array_function)	
		{
        	foreach($array_function as $row)
			{
				$stt++;
		?>
        <tr class="con_table">
			<td  width="30" align="center"><?php echo $stt ;?></td>
            <td><?php echo $row["title"]; ?></td>
            <td><?php echo $row["name"]; ?>()</td>
            <td><?php echo $row["description"]; ?></td>
			<td align="center">
            	<?php 
					$link_sua 	= $this->Html->link(array("controller"=>"module2","action"=>"table","params"=>array($row["id"])));
					$link_sua	= $this->Template->load_link("edit","Tables",$link_sua);
					echo $link_sua;	
				?>
            </td>			
			<td align="center">
            	<?php 
					$link_sua 	= $this->Html->link(array("controller"=>"module2","action"=>"list_function","params"=>array($row["id"])));
					$link_sua	= $this->Template->load_link("edit","Sửa",$link_sua);
					echo $link_sua;	
				?>
            </td>
			<td align="center">
            	<?php
					//lay liên kết để xóa
					$link_xoa = $this->Html->link(array("controller"=>"module2","action"=>"delete_function","params"=>array($row["id"],$row["id_module"])));
					$link_xoa = $this->Template->load_link("del","Xóa",$link_xoa,array("onclick"=>"return confirm('Bạn có chắc chắn muốn xóa không?');"));
					echo $link_xoa;
				?>
            </td>			
		</tr>
        <?php		
			}
		}	
		else
		{
		?>
        <tr class="con_table">
			<td colspan="5" align="center">Chưa có chức năng</td>
		</tr>		
		<?php
		}	
		?>
        </table>

	</div> 
</div>