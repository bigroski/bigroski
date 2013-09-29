<?php   
	$resultBanner = $obj->select("tbl_banner",'*');
    if($resultBanner!=""){
        $rowBanner = $obj->fetch($resultBanner);
    }

?>
<form method="post" enctype="multipart/form-data" action="?page=act_banner">
<table>
<?php  
	if($rowBanner['image']!=""){
?>
<tr>
<td>Current Image</td>
<td><img src="../uploads/banner/thumbs/<?php echo $rowBanner['image'] ?>" /></td>
</tr>
<?php  } ?>
<tr>
    <td colspan="2">Image size of 147 X 80 px</td>
</tr>
<tr>
<td>Select New Banner Image</td>
<td><input type="file" name="file"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>