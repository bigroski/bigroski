<?php 
if(isset($_GET['id'])&&(int)$_GET['id']!=""){
	$row = $obj->getStaffType($_GET['id']);
	
}
if(isset($_POST['submit']) && !empty($_POST['submit'])){
	if(isset($_POST['id'])&&(int)$_POST['id']!=""){
		$obj->table_name = STAFF_CAT;
		$obj->val = array("category"=>$_POST['category']);
		$obj->cond = array("id"=>$_POST['id']);
		$obj->update();
		$obj->alert("Associates Category successfully updated","index.php");
	}else{
		$obj->table_name = STAFF_CAT;
		$obj->val = array("category"=>$_POST['category']);
		$obj->insert();
		$obj->alert("New Associates Category successfully Added","index.php");
	}
}
 ?>
<table id="dataGrid">
<thead>
<tr>
<td>Add New Category</td>
<td></td>
</tr>
</thead>
<tbody>
<form id="category" name="category" method="post" action="">
<tr>
<td>Enter Staff Category</td>
<td><input type="text" name="category" class="required" value="<?php echo stripslashes($row['category']); ?>" /></td>
</tr>
<tr>
<td>
<?php 
	if(isset($_GET['id'])&&(int)$_GET['id']!=""){
?>
<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
<?php }?>
</td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</form>
</tbody>
</table>