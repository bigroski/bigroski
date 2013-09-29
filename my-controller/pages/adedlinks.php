<?php 
echo "<h2>".ucfirst($_GET['action'])."Links</h2>";
if($_GET['action']=="edit"){
	$row = $obj->getResource($_GET['id']);
}else{

}
?>
<form method="post" action="?page=act_adedlinks">
<table>
<tr>
<td>Title</td>
<td><input type="text" name="title" value="<?php echo $row['title']; ?>" /></td>
</tr>
<tr>
<td>URL</td>
<td><input type="text" name="url" value="<?php echo $row['url']; ?>" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td style="color:#000099;">Enter full URL [eg.www.something.com]</td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" /></td>
<td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" /></td>
</tr>
<tr>
<td><input type="hidden" name="action" value="<?php echo $_GET['action'];  ?>" /></td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>

</table>
</form>