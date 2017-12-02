<!-- ckeditor -->
<script type="text/javascript" src="<?php echo $webroot;?>js/ckeditor/ckeditor.js"></script>
<script>
      $(function() {
         $(".datepicker").datepicker();
                        
      });			
</script>
<!-- End Datepicker -->
<div id="main">
	<div class="title">
		<div class="title_img"></div>
		<h1>Quản lý module</h1>
	</div>


	<div class="form">
        <div class="box-header well" data-original-title>
              <h2><i class="icon-edit"></i> Nhập module</h2>
              <hr /><br /><br />
        </div>
		
		<?php
			$id='';
			$title='';
			$link='';
			$package='';
			$folder = '';
			$classname='';				
			$mota='';
			$id_group='';
			$group='';
			$sql_created = '';
			$table_name = '';
			if($array_module!=NULL)
			{
				$id=$array_module['0']['id'];
				$title=$array_module['0']['title'];
				$link=$array_module['0']['link'];
				$package=$array_module['0']['package'];
				$folder=$array_module['0']['folder'];				
				$classname=$array_module['0']['classname'];								
				$mota=$array_module['0']['mota'];
				$id_group=$array_module['0']['id_group'];
				$group=$array_module['0']['group'];
				$sql_created = $array_module['0']['sql_created'];
				$table_name = $array_module['0']['table_name'];
			}
		?>
        <div class="box-content">
		<form action="<?php echo $webroot; ?>module/nhap_module" id="AddForm" class="form-horizontal" method="post" accept-charset="utf-8">
			
			<div class="form_row">
				<div class="form_row_left">Tiêu đề:</div>
				<div class="form_row_right">
					<input id="td" name="module[title]" size="72" type="text" value="<?php echo $title;?>"/>
                    <input name="module[id]" type="hidden" value="<?php echo $id;?>"/>
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert"></div>
			</div>
			<div class="form_row">
				<div class="form_row_left">Package:</div>
				<div class="form_row_right">
					<input name="module[package]" id="package" type="text" size="72" value="<?php echo $package;?>"/>										
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_package"></div>
			</div>
			<div class="form_row">
				<div class="form_row_left">Folder:</div>
				<div class="form_row_right">
					<input name="module[folder]" id="folder" type="text" size="72" value="<?php echo $folder;?>"/>										
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_package"></div>
			</div>			
			<div class="form_row">
				<div class="form_row_left">Class name:</div>
				<div class="form_row_right">
					<input name="module[classname]" id="classname" type="text" size="72" value="<?php echo $classname;?>"/>										
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_package"></div>
			</div>			

			
			<div class="form_row">
				<div class="form_row_left">Mô tả:</div>
				<div class="form_row_right">
					<textarea name="module[des]" id="mota" size="72"><?php echo $mota;?></textarea>									
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>

			
           <div class="add_but2">
			<div style="float:left">
				<button type="button" class="btn btn-primary" onclick="submit_form()">Lưu</button>
			</div>
			<div style="float:left; margin-left:20px">
				<a href="<?php echo $webroot; ?>ds_module.html">Hủy</a></div>
			</div>
			</div>
			</br>
			</br>
			<input name="act" type="hidden" id="act" value=""/>					
			<input name="act" type="hidden" id="id" value=""/>								
		</form>
		</div>	
	</div>			  
</div>
																
<script>

    function submit_form(){
			
		var value = document.getElementById('td').value;
			if(value == ''){
				document.getElementById('alert').innerHTML = '<div class="alert-error"><strong>Lỗi !</strong> Xin vui lòng tiêu đề vào.</div>';
				document.getElementById('td').focus();
				return false;
				
			}
			
			
			
			
			document.getElementById('AddForm').submit();	
		}
</script>
<script language="javascript">
	document.getElementById("ds_module").className = "active";	
</script>	
	
</div>