<?php 
if($_GET['action']=="edit"){
	$row = $obj->getResource((int)$_GET['id']);
    $action = "edit";
}else{
	$action = "add";
}
?>
<form method="post" action="index.php?&fol=actpages&amp;page=act_addvideo&from=<?php echo $_GET['type']; ?>" name="vidform" id="vidform" enctype="multipart/form-data">
<table>
<tr>
<td>Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="required" title="Enter video Title"/></td>
</tr>
<tr>
</tr>
<tr>
<td>Url</td>
<td><input type="text" name="url" value="<?php if($row['url']!=""){ echo revertVideo($row['url']);} ?>"></td>
</tr>

<tr>
<td>Short Description</td>
<td><textarea name="shortdesc" cols="30" rows="10"><?php echo $row['shortdesc']; ?></textarea></td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
<td><input type="hidden" name="action" value="<?php echo $action; ?>"></td>
</tr>
<tr>
<td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>