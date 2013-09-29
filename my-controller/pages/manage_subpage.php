<script language="javascript" type="text/javascript"> 
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }
 
</script>
<?php  
    $limitText = 355;
    if(isset($_GET['id'])){
        $action = "edit";
        $row = $obj->getpage((int)$_GET['id']);
        $type = $row['parent_id'];
    }elseif(isset($_GET['type'])){
    	$action = "add";
    	 $type = (int)$_GET['type'];    
    }else{
    	$obj->redirect('index.php');
    }
?>
<form method="post" action="index.php?&fol=actpages&amp;page=act_adedsubpage" enctype="multipart/form-data" id="subpage">
    <table cellspacing="10" id="dataGrid">
<tr>
    <td>Page Label</td>
    <td><input type="text" name="pagelabel" value="<?php if(isset($row)) echo stripslashes($row['pagelabel']) ?>"/></td>
</tr>
<tr>
<td>Page Title</td>
<td><input type="text" name="heading" id="heading" value="<?php if(isset($row)) echo stripslashes($row['heading']); ?>" /></td>
</tr>
<tr>
<td>Short Description</td>

<td><textarea name="shortdesc" cols="40" rows="5" onkeydown="limitText(this.form.short_desc,this.form.countdown,<?php echo $limitText?>);" onkeyup="limitText(this.form.shortdesc,this.form.countdown,<?php echo $limitText?>);" class="required" title="Please Enter the short description" ><?php if(isset($row)) echo stripslashes($row['shortdesc']); ?></textarea>
      <br /><input type="text" name="countdown" size="3" value="<?php echo $limitText?>" readonly="readonly" class="normal" /> [characters left]</td>
</tr>
<?php 
    if(isset($row)&&$row['image']!="")
    {
        echo '<tr><td></td><td><img src="../uploads/subpage/thumbs/'.$row['image'].'">
                   <img src="images/trash_box.png" width="18" onclick="delete_image('.$row['id'].')" title="Delete This Image" style="cursor:pointer">
        </td></tr>';
    }
?>
<tr>
<td>Image</td>
<td><input type="file" name="image" id="image"></td>
</tr>

<tr>
<td>Page Description</td>
<td width="600">
<textarea id="description" name="description"><?php echo isset($row)?stripslashes($row['description']):""; ?></textarea>
<script type="text/javascript">
    CKEDITOR.replace( 'description',{
        toolbar : 'MyToolbar' ,
         filebrowserBrowseUrl : '<?php echo SITE_URL;  ?>nmefn-controller/ckfinder/ckfinder.html',
        filebrowserUploadUrl : '<?php echo SITE_URL; ?>nmefn-controller/ckfinder/userfiles/'
    } );
</script>
</td>
</tr>
<tr>
<td><input type="hidden" name="id" value="<?php echo (int)$_GET['id']; ?>" /></td>
<td><input type="hidden" name="action" value="<?php echo $action ?>" /></td>
</tr>
<tr>
<td><input type="hidden" name="type" value="<?php echo $type; ?>" /></td>
<td><input type="submit" name="submit" value="Submit" id="submit" />
<?php if(isset($_GET['id'])){?>
<input type="submit" name="submit2" id ="submit2" value="Delete" />
<?php } ?>
</td>
</tr>
</table>

</form>
<script type="text/javascript">
$(document).ready(function(){
     
     
     
    $("#submit").mousedown(function() {
            for (var i in CKEDITOR.instances) {
                CKEDITOR.instances[i].updateElement();
            }
        });
   
    var validator = $("#subpage").validate({
        rules: {
            pagename: 'required',
            description: 'required'
            

            },
        messages: {
            title: "Please Enter Page Title",
            description: 'Please Enter Page Description'

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
                       data:{"id":image_id,"of":'subpage'},
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