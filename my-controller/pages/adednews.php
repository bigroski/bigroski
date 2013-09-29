<?php  
    $limitText = 255;
    if(isset($_GET['id'])){
        $action = "edit";   
        $id = (int)$_GET['id'];             
        $row = $obj->getArticle($id);
        if($row===false) $obj->redirect('?page=404');
        $type = $row['type'];
    }else{
        $action = "add";   
    }
    if(isset($_GET['type'])&&$_GET['type']!=""){
        try{
            $title = $obj->getNewsCat((int)$_GET['type']);
            $type = $title[0];
            $category_name = $title[1];
        }catch(Exception $e){
            die($e->getMessage());
        }
    }else{
        $type=0;
        $category_name = 'News';
    }
    echo '<h1>'.ucfirst($category_name).'&raquo;'.$action.'<a href="javascript:void(0)" id="rss_trigger" class="borrowNews">Rss<a></h1>';
    $cat_data = $obj->getNewsCat();
?>
<script language="javascript" type="text/javascript"> 
        function limitText(limitField, limitCount, limitNum) {
            if (limitField.value.length > limitNum) {
                limitField.value = limitField.value.substring(0, limitNum);
            } else {
                limitCount.value = limitNum - limitField.value.length;
            }
        }
 
</script>
<form method="post" enctype="multipart/form-data" action="index.php?fol=actpages&page=act_adednews" id="addnews">
<table id="dataGrid">
<tr style="border-top:1px solid #e4e4e4;">
<td width="20%"><b>Title</td>
<td><input type="text" name="title" id="title" value="<?php if(isset($row)) echo stripslashes($row['title']); ?>"/></td>
</tr>
<tr>
    <td><b>Post Under</td>
    <td>
        <select name="type">
            <?php 
                foreach($cat_data as $val){
                    echo '<option value="'.$val['id'].'" '.checkSelected($type,$val['id']).'>'.stripslashes($val['category']).'</option>';
                }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td><b>Posted By</td>
    <td><input type="text" name="caption" value="<?php if(isset($row)&&$row['caption']!="") { echo stripslashes($row['caption']); }else{  echo $user_obj->get_current_admin(); }   ?>" /></td>
</tr>
<?php  
if(isset($row) && $row['image']!=""){
?>
<tr>
<td></td>
<td><img src="../uploads/news/thumbs/<?php echo $row['image']; ?>" />
      <img src="images/trash_box.png" width="18" onclick="delete_image(<?php echo $row['id']; ?>)" style="cursor: pointer" title="Click here to Delete This image">
</td>
</tr>

<?php  }  ?>
<tr>
<td><b>Image</td>
<td><input type="file" name="image"></td>
</tr>
<?php 
    
?>

<?php 
    if($option_global[allow_article_file_uploads]=="y"){
?>
<tr>
<td><b>Select Downloadable File</td>
<td><input type="file" name="file" ></td>
</tr>
<?php } ?>
<tr>
<td><b>Short Description</td>

<td><textarea name="shortdesc" cols="40" rows="5" onkeydown="limitText(this.form.short_desc,this.form.countdown,<?php echo $limitText?>);" onkeyup="limitText(this.form.shortdesc,this.form.countdown,<?php echo $limitText?>);" class="required" title="Please Enter the short description" ><?php if(isset($row)) echo stripslashes($row['shortdesc']); ?></textarea>
      <br /><input type="text" name="countdown" size="3" value="<?php echo $limitText?>" readonly="readonly" class="normal" /> [characters left]</td>
</tr>
<tr>
<td><b>Description</td>
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
<tr>
			<td><b>Date : </td>
			<td><input id="datepicker" name="date" size="30" readonly="readonly" style="background-color:#FFFFFF;" value="<?php if(isset($row)) echo stripslashes($row['posted_on']); ?>"/></td>
		</tr>
		<?php 
		  echo Soptimizer::getSEO_fields($row[id],'tbl_news');
		?>


<tr>
<td>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="action" value="<?php echo $action; ?>">
    
</td>
<td><input type="submit" id="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('#ncat').change(function() {
          var selected = $(this).val();
          //alert(selected);
          $('input[name=type]').val(selected);
              
          });
    $("#submit").mousedown(function() {
            for (var i in CKEDITOR.instances) {
                CKEDITOR.instances[i].updateElement();
            }
        });
   
    var validator = $("#addnews").validate({
        rules: {
            title: 'required',
            shortdesc: 'required',
            description: 'required',
            date:{
                required:true,
                date:true
            }
            

            },
        messages: {
            title: "Please Enter Article Title",
            shortdesc:"Please enter short description",
            description: 'Please Enter Description'

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
                       data:{"id":image_id,"of":'news'},
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