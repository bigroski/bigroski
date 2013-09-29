<?php 
	echo "<h2>Add Edit horoscope</h2>";
?>
<table>
	<tr>
    	<td>Select Date</td>
        <td><input id="date" class="required" name="date" size="30" readonly="readonly" style="background-color:#FFFFFF;" value="<?php echo stripslashes($row['date']); ?>"/></td>
    </tr>
    <tr>
    	<td>तिथि</td>
        <td><input type="text" name="tithi" value="<?php echo stripslashes($row['tithi']);?>" /></td>
    </tr>
    <?php 
		$sql_sign = "select * from tbl_shine";
		$result_sign = $obj->exec($sql_sign);
		if(mysql_num_rows($result_sign)!=""){
			while($row_sign = $obj->fetch($result_sign)){
	?>
    <tr>
    	<td><?php echo stripslashes($row_sign['sign']); ?></td>
        <td><textarea name="description[]" rows="10" cols="20"></textarea></td>
    </tr>
    <?php }} ?>
</table>