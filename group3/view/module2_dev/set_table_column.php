	<div class="title">
		<div class="title_img"></div>
		<h1>Quản lý cột <?php echo $table_name ?></h1>
	</div>
    <div class="form">
    	<div class="box-content">
		<form action="<?php echo $webroot; ?>module/set_table_column/<?php echo $id_module."/".$table_name;?>" class="form-horizontal" method="post" accept-charset="utf-8">
        	<?php 
				$id = "";
        		$ten_cot = "";
				$tieude_cot = "";
				$kieu = "";
				$dodai = "";
				$mota = "";
				$sapxep = "";
				if($array_sua)
				{
					$id = $array_sua[0]["id"];
					$ten_cot = $array_sua[0]["column_name"];
					$tieude_cot = $array_sua[0]["column_title"];
					$kieu = $array_sua[0]["column_type"];
					$dodai = $array_sua[0]["column_size"];
					$mota = $array_sua[0]["des"];
					$sapxep = $array_sua[0]["order_number"];
					
				}
			?>
			<div class="form_row">
				<div class="form_row_left">Tên Cột:</div>
				<div class="form_row_right">
					<input name="data[TableColumn][column_name]" size="72" type="text" value="<?php echo $ten_cot;?>"/>
                    <input name="data[TableColumn][id]" type="hidden" value="<?php echo $id;?>"/>
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert"></div>
			</div>
            
            <div class="form_row">
				<div class="form_row_left">Kiểu</div>
				<div class="form_row_right">
                    <select name="data[TableColumn][column_type]" id="column_type" value="<?php echo $kieu;?>"  style="width: 189px;">
                            <option value="VARCHAR">VARCHAR</option>
                            <option value="TINYINT">TINYINT</option>
                            <option value="TEXT">TEXT</option>
                            <option value="DATE">DATE</option>
                            <option value="SMALLINT">SMALLINT</option>
                            <option value="MEDIUMINT">MEDIUMINT</option>
                            <option value="INT">INT</option>
                            <option value="BIGINT">BIGINT</option>
                            <option value="FLOAT">FLOAT</option>
                            <option value="DOUBLE">DOUBLE</option>
                            <option value="DECIMAL">DECIMAL</option>
                            <option value="DATETIME">DATETIME</option>
                            <option value="TIMESTAMP">TIMESTAMP</option>
                            <option value="TIME">TIME</option>
                            <option value="YEAR">YEAR</option>
                            <option value="CHAR">CHAR</option>
                            <option value="TINYBLOB">TINYBLOB</option>
                            <option value="TINYTEXT">TINYTEXT</option>
                            <option value="BLOB">BLOB</option>
                            <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                            <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                            <option value="LONGBLOB">LONGBLOB</option>
                            <option value="LONGTEXT">LONGTEXT</option>
                            <option value="ENUM">ENUM</option>
                            <option value="SET">SET</option>
                            <option value="BOOL">BOOL</option>
                            <option value="BINARY">BINARY</option>
                            <option value="VARBINARY">VARBINARY</option>
    			</select>
                <input name="data[TableColumn][column_size]" size="40" type="text" value="<?php echo $dodai;?>"/>			
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert"></div>
			</div>
            
             <div class="form_row">
				<div class="form_row_left">Tiêu Đề Cột:</div>
				<div class="form_row_right">
					<input name="data[TableColumn][column_title]" size="72" type="text" value="<?php echo $tieude_cot;?>"/>							
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>
             <div class="form_row">
				<div class="form_row_left">Thứ tự:</div>
				<div class="form_row_right">
					<input name="data[TableColumn][order_number]" size="72" type="text" value="<?php echo $sapxep;?>"/>							
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>
             <div class="form_row">
				<div class="form_row_left">Mô Tả:</div>
				<div class="form_row_right">
					<textarea name="data[TableColumn][des]" id="sql_created" size="72"><?php echo $mota;?></textarea>									
				</div>
				<div class="form_row_left"></div>
				<div class="form_row_right" id="alert_mt"></div>
			</div>
            
			
           
            
			
           <div class="add_but2">
                <div style="float:left">
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
			</div>
		</form>
		</div>
    </div>
      </br></br>
		<table class="table" cellpadding="3" cellspacing="0" border="0" style="margin-top:235px">
            <tr class="title_table">
                <td align="center"  width="30">Stt</td>
				<td align="center">Tiêu đề cột</td>
                <td align="center">Tên cột</td>
                <td align="center">kiểu</td>
                <td align="center">Mô tả</td>
                <td align="center">Sửa</td>
                <td align="center">Xóa</td>
            </tr>
            <?php 
			if($array_dulieu)
			{
				$stt=0;
				foreach($array_dulieu as $dulieu)
				{
					$stt++;
					$str_kieu = "";
					if($dulieu["column_type"] == "VARCHAR") $str_kieu = "(".$dulieu["column_size"].")";
			?>
            	<tr class='con_table'>
                    <td width="30" align="center"><?php echo $stt ;?></td>
                    <td align="center"><?php echo $dulieu["column_title"]; ?></td>
                    <td align="center"><?php echo $dulieu["column_name"]; ?></td>
                    <td align="center"><?php echo $dulieu["column_type"].$str_kieu; ?></td>
                    <td align="center"><?php echo $dulieu["des"]; ?></td>
                    <td align="center"><a href="<?php echo $this->webroot;?>module/set_table_column/<?php echo $id_module."/".$dulieu["table_name"]."/".$dulieu["id"];?>.html" class="edit"></a></td>			
                    <td align="center"><a href="<?php echo $this->webroot;?>module/delete_table_column/<?php echo $id_module."/".$dulieu["table_name"]."/".$dulieu["id"];?>.html" class="del"></a></td>
                </tr>
            <?php		
				}
			}
			else
			{
				echo "<tr class='con_table'><td colspan='7' style='text-align:center'>Không có dữ liệu</td></tr>";
			}
			
			?>
        </table>		
