<?php 
	echo "<h2>Manage Horoscope</h2>";
	$sql = "select * from tbl_horoscope";
	$result = $obj->exec($sql);
	if(isset($_POST['btn_submit'])&&$_POST['btn_submit']!=""){
//		print "<pre>";
	//	print_r($_POST);
		//print "</pre>";
		$obj->table_name = "tbl_zodiac_group";
		$obj->val = array("posted_date"=>$_POST['date'],"tithi"=>$_POST['tithi']);
		$obj->cond = array("id"=>1);
		$obj->update();
		$count = 0;
			foreach($_POST['description'] as $val){
				++$count;			
				$obj->table_name = "tbl_horoscope";
				$obj->val = array("description"=>$val);
				$obj->cond = array("id"=>$count);
				$obj->update();
			}
		}
	
?>
<form action="" name="zodiac" method="post">
<table>
	<?php 
		$sql_group = "select * from tbl_zodiac_group";
		$result_group = $obj->exec($sql_group);
		if(mysql_num_rows($result_group)!=""){
			$row = $obj->fetch($result_group);	
		}
	?>
	<tr>
    	<td>Select Date</td>
        <td><input id="datepicker" class="required" name="date" size="30" readonly="readonly" style="background-color:#FFFFFF;" value="<?php echo stripslashes($row['posted_date']); ?>"/></td>
    </tr>
    <tr>
    	<td>तिथि</td>
        <td><input type="text" name="tithi" value="<?php echo stripslashes($row['tithi']);?>" /></td>
    </tr>
    <?php 
		$sql_sign = "select * from tbl_shine";
		$result_sign = $obj->exec($sql_sign);
		if(mysql_num_rows($result_sign)!=""){
			$count = 0;
			while($row_sign = $obj->fetch($result_sign)){
	?>
    <tr>
    	<td><?php echo ++$count.". ".stripslashes($row_sign['shine']); ?></td>
        <?php 
			$sql_desc = "select description from tbl_horoscope where shine = ".$row_sign['id'];
			$result_desc = $obj->exec($sql_desc);
			if(mysql_num_rows($result_desc)!=""){
				$description = $obj->fetch($result_desc);
			}
		?>
        <td><textarea name="description[]" rows="5" cols="40"><?php echo $description['description']; ?></textarea></td>
    </tr>
    <?php }} ?>
    <tr>
    	<td></td>
          <td><input type="submit" name="btn_submit" value="Submit" /></td>
    </tr>
</table>
</form>