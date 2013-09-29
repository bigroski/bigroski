<?php   
	if($_GET['action']=="edit"){
		 $action = "edit";
		$id = $_GET['id'];
		$row = $obj->getResource($_GET['id']);
	}else{
		 $action = "add";
	}

?>
<h1><?php echo ucfirst($action) ?> Gallery</h1>
<form method="post" enctype="multipart/form-data" action="?fol=actpages&amp;page=act_adedgallery&type=<?php echo $_GET['type']; ?>">
<table id="dataGrid">
<tr>
<td>Gallery Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>"/></td>
</tr>
<tr>
<td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="action" value="<?php echo $action; ?>" />
</td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>