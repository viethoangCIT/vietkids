
<div id="main">
	<div class="title">
		<div class="title_img"></div>
		<h1>Nhập CSDL</h1>
	</div>


	<div class="form">
		<?php
			$id='';
			$table_name='';
			$table_title = '';
			$sql_created = '';
			$data_col='';
							
			if($array_csdl)
			{
				$id          = $array_csdl['0']['id'];
				$table_name  = $array_csdl['0']['table_name'];
				$table_title = $array_csdl['0']['table_title'];
				$sql_created = $array_csdl['0']['sql_created'];				
				$data_col    = $array_csdl['0']['data_col'];
			}
			$module_package = str_replace("/","-----",$module_package);
		?>
        <div class="box-content">
		<form action="<?php echo $webroot; ?>module/add_csdl/<?php echo $id_module."//".$module_name."/".$module_package;?>" class="form-horizontal" method="post" accept-charset="utf-8">
			
			<div class="form_row">
				<div class="form_row_left">Tên Bảng:</div>
				<div class="form_row_right">
					<input name="data[CSDL][table_name]" size="72" type="text" value="<?php echo $table_name;?>"/>
                    <input name="data[CSDL][id]" type="hidden" value="<?php echo $id;?>"/>
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert"></div>
			</div>
            
            <div class="form_row">
				<div class="form_row_left">Tiêu Đề Bảng:</div>
				<div class="form_row_right">
					<input name="data[CSDL][table_title]" size="72" type="text" value="<?php echo $table_title;?>"/>
                    
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert"></div>
			</div>
            
             <div class="form_row">
				<div class="form_row_left">Lệnh SQL:</div>
				<div class="form_row_right">
					<textarea name="data[CSDL][sql_created]" id="sql_created" size="72"><?php echo $sql_created;?></textarea>									
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>
            
             <div class="form_row">
				<div class="form_row_left">Data Col:</div>
				<div class="form_row_right">
					<textarea name="data[CSDL][data_col]" id="sql_created" size="72"><?php echo $data_col;?></textarea>									
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>
            
			
           
            
			
           <div class="add_but2">
			<div style="float:left">
				<button type="submit" class="btn btn-primary">Lưu</button>
			</div>
			<div style="float:left; margin-left:20px">
				<a href="<?php echo $webroot; ?>ds_module.html">Hủy</a></div>
			</div>
			</div>
			</br>
			</br>
								
		</form>
		</div>	
	</div>			  
</div>
																

</div>