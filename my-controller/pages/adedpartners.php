<?php

	if($_GET['action']=="edit"){
		 $action = "edit";
		$id = $_GET['id'];
		$row = $obj->getPartner($_GET['id']);
	}else{
		 $action = "add";
	}

?>
<form method="post" enctype="multipart/form-data" action="?fol=actpages&amp;page=act_adedpartner">
<table id= "dataGrid">
    
<tr>
<td>*Title: </td>
<td><input type="text" name="name" id="name" value="<?php echo $row['name']; ?>"/></td>
</tr>

<?php  
if($row['logo']!=""){
?>
<tr>
<td>&nbsp;</td>
<td><img src="../uploads/partner/thumbs/<?php echo $row['logo']; ?>" /></td>
</tr>
<?php } ?>
<tr>
<td>Url</td>
<td><input type="text" name="url" value="<?php echo $row['url']; ?>"></td>
</tr>
<tr>
<td></td>
<td style="color:#FF0000;">(E.G www.something.com)</td>
</tr>
<tr>
    <td>Shortdescription</td>
    <td><textarea name="shortdesc" cols="40" rows="5" class="required" title="Please Enter the short description" ><?php if(isset($row)) echo stripslashes($row['shortdesc']); ?></textarea>
      </td>
</tr>
<tr>
<td>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" />
    <input type="hidden" name="action" value="<?php echo $action; ?>">    
</td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>