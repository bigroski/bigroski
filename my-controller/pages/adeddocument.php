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
<form method="post" enctype="multipart/form-data" action="index.php?fol=actpages&amp;page=act_adeddoc&from=<?php echo $_GET['type']; ?>" name="docform" id="docform">
<table>
<tr>
<td>Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" class="required" title="Enter title"/></td>
</tr>
<?php 
    if(isset($row)&&$row['url']!=""){
?>
<tr>
<td></td>
<td><img src="../uploads/documents/thumbs/<?php echo $row['url']; ?>" />
      
</td>
</tr>
<?php } ?>
<tr>
    <td>Image</td>
    <td><input type="file" name="image" /></td>
</tr>
<tr>
<td>Select Downloadable File</td>
<td><input type="file" name="file" ></td>
</tr>
<?php 
    if(isset($row)&&$row['file']!=""){
?>
<tr>
    <td>Current File</td>
    <td><?php echo $row['file'] ?></td>
</tr>
<?php } ?>
<tr>
<td>Short Description</td>
<td><textarea name="shortdesc" cols="30" rows="10"><?php echo $row['shortdesc']; ?></textarea></td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"></td>
<td><input type="hidden" name="action" value="<?php echo $action; ?>">
<input type="hidden" name="sub_type" value="<?php echo $_GET['sub_type']; ?>" />
</td>
</tr>
<tr>
<td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>"></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      
          var validator = $("#docform").validate({
        rules: {
            title: 'required',
            
            shortdesc: 'required'
            

            },
        messages: {
            title: "Please Enter Title",
            
            shortdesc: 'Please Enter Shortdescription'

            },
        success: function(label) {
            // set &nbsp; as text for IE
            label.html("&nbsp;").addClass("checked");
        }
        
        })
    });
</script>