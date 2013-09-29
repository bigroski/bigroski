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
if($_GET['id']==1){
    $limitText = 1000;
}else{
    $limitText = 355;
}
    
    if(isset($_GET['id'])){
        $pg = (int)$_GET['id'];
        $row = $obj->getpage($pg);
        if($row['parent_id']!=""){
            $parent_id = $row['parent_id'];
        }
        $has_subpage = $row['has_subpage'];
    }else{
    	$url = "index.php";
        if(isset($_GET['parent_id'])&&$_GET['parent_id']!=""){
            $parent_id = (int)$_GET['parent_id'];
        }else{
            $parent_id = '';
        }
        $has_subpage="n";
    	//$obj->redirect($url);
    }
    
?>
<form method="post" action="index.php?fol=actpages&amp;page=act_adedpage" enctype="multipart/form-data" id="pagefrm">
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
        echo '<tr><td></td><td><img src="../uploads/pages/thumbs/'.$row['image'].'">
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
        width:'800px',
        toolbar : 'MyToolbar' ,
         filebrowserBrowseUrl : '<?php echo ADMIN_URL;  ?>ckfinder/ckfinder.html',
        filebrowserUploadUrl : '<?php echo ADMIN_URL; ?>ckfinder/userfiles/'
    } );
</script>
</td>
</tr>
<?php 
    if($previlage['super']=='yes'){
?>
<tr>
    <td>Has Subpage</td>
    <td>
        
        <label><input type="radio" name="has_subpage" value="y" <?php if($has_subpage=='y') echo ' checked="checked"'; ?> />Yes</label><br/>
        <label><input type="radio" name="has_subpage" value="n" <?php if($has_subpage=='n') echo ' checked="checked"'; ?> />No</label>
        
    </td>
</tr>
<tr>
    <td>Posted Under</td>
    <td>
        <?php 
            //$result_parents = $obj->get_all_parents_page('tbl_page','*',array('has_subpage'=>'y'));
            $result_parents = $obj->select('tbl_page','*',array('has_subpage'=>'y'));
            if(mysql_num_rows($result_parents)!=""){
                echo '<select name="parent_id">';
                echo '<option value="0">Select A Parent</option>';
                while($row_parents = $obj->fetch($result_parents)){
                    echo '<option value="'.$row_parents['id'].'" '.((isset($parent_id)&&$parent_id==$row_parents['id'])?' selected="selected"': '').'>'.stripslashes($row_parents['pagelabel']).'</option>';
                }
                echo '</select>';
            }
        ?>
    </td>
</tr>
<?php } ?>
<tr>
<td>
    <?php 
        if(isset($pg)&&$pg!=""){
            echo '<input type="hidden" name="id" value="'.$pg.'" /></td>';
        }
        if(isset($_GET['parent_id'])&&$_GET['parent_id']!=""){
            echo '<input type="hidden" name="parent_id" value="'.(int)$_GET['parent_id'].'" /></td>';
        }
    ?>
    
<td><input type="submit" name="submit" value="submit">
    <?php if(isset($_GET['id'])){?>
    <input type="button" value="Delete" onclick="window.location='index.php?fol=actpages&page=act_delete&per=page&to_delete=<?php echo $_GET['id'] ?>'"/>
    <?php } ?>
</td>
</tr>
</table>
</form>
<script>
    function delete_image(image_id){
          if(confirm('Sure to perfom the action'))
    {
             $.ajax({
                       
                       url:'actpages/delete_img.php',
                       type:'post',
                       data:{"id":image_id,"of":'page'},
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