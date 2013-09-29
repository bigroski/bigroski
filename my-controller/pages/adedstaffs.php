<?php
    $cat = (int)$_GET['type'];
    $traverse_category = $obj->travese_categories('tbl_staff_cat', $cat);
    $exp = explode(',',$traverse_category);
    if(count($exp)>1){
        $all_titles = $obj->find_category_titles('tbl_staff_cat',$exp);
    }else{
        $all_titles  = NULL;
    }
    $title = $obj->getStaffType($cat); 
	if($_GET['action']=="edit"){
		 $action = "edit";
		$id = (int)$_GET['id'];
        $result = $obj->select(STAFF_TBL,'*',array('id'=>$id));
        if(mysql_num_rows($result)!=""){
            $row = $obj->fetch($result);
        }
		
        if($row == ""){
            $obj->redirect('index.php');
        }		
	}else{
		 $action = "add";
	}

echo "<h2>".ucfirst($action)." &raquo; $title[category]</h2>";
?>
<form method="post" enctype="multipart/form-data" action="?fol=actpages&amp;page=act_adedstaffs&type=<?php echo $_GET['type']; ?>" id="staffform">
<table id="dataGrid">
<tr>
<td>*Firstname</td>
<td><input type="text" name="firstname" id="firstname" value="<?php echo $row['firstname']; ?>"/></td>
</tr>
<tr>
<td>Middlename</td>
<td><input type="text" name="middlename" value="<?php echo $row['middlename']; ?>"></td>
</tr>
<tr>
<td>Lastname</td>
<td><input type="text" name="lastname" value="<?php echo $row['lastname']; ?>" /></td>
</tr>

<?php 
    if($cat!=1){
?>
<tr>
<td>Post</td>
<td>
    <textarea name="post"><?php echo $row['post']; ?></textarea>
    
</tr>
<tr>
<td>Email</td>
<td><input type="text" name="email" value="<?php echo $row['email']; ?>"></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" name="address" value="<?php echo $row['address']; ?>" /></td>
</tr>

<tr>
<td>Contact No</td>
<td><input type="text" name="contact" value="<?php echo $row['contact']; ?>" /></td>
</tr>
<tr>
    <?php } ?>
<td>Info</td>
<td>
    <textarea name="about"><?php echo $row['about']; ?></textarea>
    
</td>
</tr>
<?php /*?>
<tr>
<td>Contact No</td>
<td><input type="text" name="contact" value="<?php echo $row['contact']; ?>" /></td>
</tr>
<tr>
<td>Date of birth</td>
<td><select name="month" id="month" class="required" title="Select Month">
<option value="">Select Month</option>
<?php echo $monthOptions; ?>
</select>

<select name="day" id="day" class="required" title="Select Day">
<option value="">Select Day</option>
<?php echo $dayOptions; ?>
</select>

<select name="year" id="year" class="required" title="Select Year" >
<option value="">Select Year</option>
<?php echo $yearOptions; ?>
</select></td>
</tr><?php */?>
<?php if($row['image']!=""){ ?>
<tr>
<td></td>
<td><img src="../uploads/staffs/thumbs/<?php echo $row['image']; ?>"  />
     <img src="images/trash_box.png" width="18" onclick="delete_image(<?php echo $row['id']; ?>)" style="cursor: pointer" title="Click here to Delete Image">
</td>
</tr>

<?php  } ?>
<tr>
<td></td>
<td style="color:red;">Select Picture of size 140X185</td>
</tr>
<tr>
<td>Photo</td>
<td><input type="file" name="image"></td>
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
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $('#check_screencast').click(function(){
            if($(this).is(':checked')){
                $('#img').hide();
            }else{
                $('#img').show();
            }
        });
      
          var validator = $("#staffform").validate({
        rules: {
            firstname: 'required',
            lastname: {
                required:true,
               
            },
            
        },
        messages: {
            firstname: "Please First Name",
            lastname:{
                required:"Enter Last Name",
               
            },
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
                       data:{"id":image_id,"of":'staffs'},
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