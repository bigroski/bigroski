<?php  
	if(isset($_GET['id'])){
		$action = "edit";
        $slider_id = (int)$_GET['id'];
		$row =  $obj->getSlider($slider_id);
	}else{
		$action = "add";
	}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedslider" enctype="multipart/form-data" id="slider_frm">
<table id="dataGrid">
<Tr>
<td>Image Title</td>
<td><input type="text" name="title" value="<?php if(isset($row)) echo $row['title']; ?>"/></td>
</Tr>
<tr>
<td>&nbsp;</td>
<td style="color:#FF0000">Image of '440'x'330'px is best</td>
</tr>
<?php if( isset($row) && $row['image']!=""){ ?>
<tr>
<td></td>
<td><img src="../uploads/slider/thumbs/<?php echo $row['image']; ?>">
      <img src="images/trash_box.png" width="18" onclick="delete_image(<?php echo $row['id']; ?>)" style="cursor: pointer">
</td>
</tr>
<?php  }  ?>
<Tr>
<td>Image</td>
<td><input type="file" name="image" /></td>
</Tr>
<Tr>
<td>Short Description</td>
<td>
    <textarea name="shortdesc" class="bordered"><?php if(isset($row))  echo $row['shortdesc']; ?></textarea>
    <input type="hidden" name="id" value="<?php if(isset($row))  echo $_GET['id']; ?>" />
    <input type="hidden" name="action" value="<?php echo $action; ?>" />
</td>
</Tr>


</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>
</table>

</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      
          var validator = $("#slider_frm").validate({
        rules: {
            title: 'required',
            file:{
                required:true,
                
            },
            shortdesc: 'required'
            

            },
        messages: {
            title: "Please Enter Title",
            file:{
                required:"Please Select image"
                
            },
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
                       data:{"id":image_id,"of":'slider'},
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