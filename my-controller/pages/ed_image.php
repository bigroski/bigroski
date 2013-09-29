<?php 
	$row = $obj->getImgContent($_GET['id']);
	 $location1 = "../uploads/images/".$row['image'];
	 $location2 = "../uploads/images/thumbs/".$row['image'];
?>
<form method="post" enctype="multipart/form-data" action="?fol=actpages&amp;page=act_edimage&type=<?php echo $_GET['type']; ?>">
<table id="dataGrid">
<tr>
<td>Image Title</td>
<td><input type="text" name="title" value="<?php echo $row['title']; ?>" /></td>
</tr>
<tr>
<td>Caption</td>
<td><input type="text" name="caption" value="<?php echo $row['caption']; ?>"></td>
</tr>
<tr>
<td>Image</td>
<td><img src="<?php echo $location2 ?>" /></td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
<td>Select new image to change or leave it empty</td>
</tr>
<tr>
<td>Image </td>
<td><input type="file" name="image" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>
</form>