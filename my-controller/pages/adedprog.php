<?php   
	if($_GET['action']=="edit"){
		 $action = "edit";
		$id = $_GET['id'];
		$sql = "select * from tbl_resource_sub_cat where id = ".$_GET['id'];
		$result = $obj->exec($sql);
		$row = $obj->fetch($result);
		
	}else{
		 $action = "add";
	}

?>
<form method="post" enctype="multipart/form-data" action="?page=act_adedprog&type=<?php echo $_GET['type']; ?>" id="for_program">
<table>
<tr>
<td>Program Title</td>
<td><input type="text" name="title" id="title" value="<?php echo $row['title']; ?>"/></td>
</tr>
<?php 
	if($row['image']!=""){
?>
<tr>
	<td></td>
    <td><img src="../uploads/programs/<?php echo $row['image']; ?>" width="250" />
          <img src="images/trash_box.png" width="18" onclick="delete_image(<?php echo $row['id']; ?>)" style="cursor: pointer" title = "Click here to delete this image">
        
    </td>
</tr>
<?php } ?>
<tr>
	<td>Image</td>
    <td><input type="file" name="image" /></td>
</tr>
<tr>
	<td>Short Description</td>
    <td><textarea name="shortdesc" rows="5" cols="25"><?php echo stripslashes($row['shortdesc']);?></textarea></td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
<td><input type="hidden" name="action" value="<?php echo $action; ?>"></td>
</tr>
<tr>
<td><input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" /></td>
<td><input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
<script type="text/javascript">
$(document).ready(function(){
     
  
    
    var validator = $("#for_program").validate({
        rules: {
            title: 'required',
            shortdesc: 'required'
            

            },
        messages: {
            title: "Please Audio Archive Category",
            shortdesc: 'Please Enter Shortdescription'

            },
        success: function(label) {
            // set &nbsp; as text for IE
            label.html("&nbsp;").addClass("checked");
        }
        
        })
    });
</script>
<script>
    function delete_image(image_id){
          if(confirm('Sure to perfom the action'))
    {
             $.ajax({
                       
                       url:'actpages/delete_img.php',
                       type:'post',
                       data:{"id":image_id,"of":'prog'},
                       dataType:'json',
                       success:function(response)
                        {
                            if(response.status==1)
                                {
                                    location.reload();
                                }
                        }
                    }); 
    }
    }
</script>