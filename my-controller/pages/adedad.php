<?php  
    $sqlmax = "select max(id) as max from tbl_advertisement";
    $result_max_id = $obj->exec($sqlmax);
    $row_max = $obj->fetch($result_max_id);
  // echo $row_max['max'];
    $inserted_to = ++$row_max['max'];
    
	if($_GET['action']=="edit"){
		$action = "edit";
		$row =  $obj->getAd((int)$_GET['id']);
        if($row['url']!=""){
            $url = $row['url'];
        }else{
            $url = "http://radionepal.gov.np";
        }
	}else{
		$action = "add";
        $url = "http://radionepal.gov.np";
	}
    $category_id = (int)$_GET['adCategory'];
$result_title = $obj->select("tbl_ad_category",'*',array("id"=>$category_id));
if(mysql_num_rows($result_title)!=""){
    $row_category = $obj->fetch($result_title);
    echo "<h2>".ucfirst($action)." Advertisement <span class=\"green\">(".stripslashes($row_category['category']).")</span></h2>";
}else{
    $obj->redirect("index.php");
}
?>

<form method="post" action="?fol=actpages&amp;page=act_adedad" enctype="multipart/form-data" id="ad_frm">
<table id="dataGrid" >
<Tr>
<td>Image Title</td>
<td><input type="text" name="title" value="<?php echo $row['title']; ?>"/></td>
</Tr>
<tr>
    <td>Link</td>
    <td><input type="text" name="url" value="<?php echo $row['url']; ?>"/></td>
</tr>
<?php 
	if($row['image']!=""){
?>
<tr>
	<td></td>
    <td><img src="../uploads/advertisement/thumbs/<?php echo $row['image'] ?>" />
        <img src="images/trash_box.png" width="18" onclick="delete_image(<?php echo $row['id']; ?>)" style="cursor: pointer" title="Click here to Delete Image">
    </td>
</tr>
<?php } ?>



<tr>
    <td>Select Image</td>
    <td><input type="file" name="image" /></td>
</tr>



<tr>
    <td>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
        <input type="hidden" name="action" value="<?php echo $action; ?>" />
        <input type="hidden" name="cat_id" value="<?php echo $category_id ?>" />
    </td>
    <td>
        <input type="submit" name="submit" value="Submit" />
    </td>
</tr>
</table>

</form>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      
          var validator = $("#ad_frm").validate({
        rules: {
            title: 'required',
            url:{ required:true, url:true}
            
            
        },
        messages: {
            title: "Please Advertisement Title",
            url: {
                required:"Please Enter Url ",
                  
            },
            post:"Enter Post"
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
                       data:{"id":image_id,"of":'ad'},
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