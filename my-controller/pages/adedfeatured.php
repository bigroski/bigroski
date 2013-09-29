<?php  
$title = $obj->getResourceType($_GET['type']);
	echo "<h2>".ucfirst($_GET['action'])."&nbsp;".$title['category']."</h2>";
if($_GET['action']=="edit"){
	$action = "edit";
	$row = $obj->getResource($_GET['id']);
}else{
	$action = "add";
}

?>
<form method="post" enctype="multipart/form-data" action="index.php?page=act_adedfeatured&from=<?php echo $_GET['type']; ?>" name="docform" id="docform">
<table>
<tr>
<td>Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="required" title="Enter title"/></td>
</tr>
<tr>
<td></td>
<td style="color:#FF0000;">Enter &lsaquo;FULLNAME.mp3&rsaquo; of the uploaded FTP file with no spaces(e.g. something.mp3) </td>
</tr>
<tr>
<td>Select File</td>
<td><input type="text" name="file" class="required" accept="mp3" title="Only Mp3 Format Accepted" value="<?php echo $row['file']; ?>"></td>
</tr>
<?php if($row['url']!=""){ ?>
<tr>
<td></td>
<td><img src="../uploads/featured/thumbs/<?php echo $row['url']; ?>" /></td>
</tr>

<?php } ?>
<tr>
<td>Select Image</td>
<td><input type="file" name="image" /></td>
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