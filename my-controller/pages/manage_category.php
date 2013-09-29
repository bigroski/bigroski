<?php 
	switch($_GET['category']){
			case 1:
				$table = "tbl_news_type";
				break;
			case 2:
				$table = "tbl_staff_cat";
				break;
		}
 ?>
 
 <table id="passGrid">
	<?php if(isset($_GET['category'])&$_GET['category']!=""){ $category = "";}else{ $category = "<h3>Please Select a category</h3>";} ?>
 	<thead>
		<tr>
			<td><?php echo $category; ?></td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="2">What do You Want to Edit???</td>
			<td>
			<select name="category" onChange="window.location='index.php?page=manage_category&category='+this.value">
				<option value="">Select A category</option>
				<?php /*?><option value="1" <?php if($_GET['category']==1){ echo "selected" ; } ?>>News Category</option><?php */?>
				<option value="2" <?php if($_GET['category']==2){ echo "selected" ; } ?>>Staff Category</option>
			</select>
			</td>
		</tr>
	</tbody>
	</table>
	<?php 
		if(isset($_GET['category'])&&$_GET['category']!=""){
	 ?>
	<table id="dataGrid">
	<thead>
		<tr>
			<td>Sno</td>
			<td>Category</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
		<?php 
			$sql = "Select * from $table";	
			$result = $obj->exec($sql);
			if(mysql_num_rows($result)!=""){
				while($row =  $obj->fetch($result)){
		?>
		<tr>
			<td><?php   echo   ++$sn;  ?></td>
			<td><?php echo $row['category']; ?></td>
			<td><a href="actpages/delcat.php?type=<?php echo $_GET['category'] ?>&id=<?php echo $row['id']; ?>"><img src="images/delete.png" />Delete</a></td>
		</tr>
		<?php  
			} }
		?>
	</tbody>
	<?php  }  ?>
 </table>