<?php  
if(isset($_POST['submit'])){		//-----------image adding Process start-----------------
	//print_r($_POST);
	if($_FILES['image']['error']==0){
            $config['directory'] = '../uploads/images/';
            $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
            $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
            $image_obj  =  ImageManipulation::generateClass($config);
            $imageResult = $image_obj  ->  upload_image($_FILES['image']);
            
    }else{
            $imageResult = "";
    }
	$obj->table_name = IMAGE_TBL;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"caption"=>$_POST['caption'],'image'=>$imageResult);
    $id = $obj->insert();

        
}			//-------------Image Addition end-----------
echo "<h2>Manage Images in Gallery</h2>";
$url1 = "?page=aded_gallery&action=add&type=".$_GET['id'];
$url2 = "?page=ed_image&action=edit&type=".$_GET['id'];
//$url3 = "?page=view_gallery";
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from".IMAGE_TBL."WHERE type = ".(int)$_GET['id']." order by id desc";
$url = "?page=view_gallery&id=".$_GET['id'];
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
?>
<table id="dataGrid" width="100%">
<?php  
	if(!empty($result)){
?>
    <thead>
    	
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Image Title</td>
        <td>Primary</td>
        <td colspan="3" width="40%"></td>
        </tr>
    </thead>
    <tbody>
		<?php $cnt = 1; 
			while ($row = $obj->fetch($result[0])){
				
				if($cnt%2==0){
					$class = "even";	
				}else{
					$class = "odd";
				}
		?>    
        	<tr class="<?php echo $class ?>">
            <td><?php echo $cnt; ?></td>
            <td><img src="../uploads/images/thumbs/<?php echo $row['image'];  ?>" alt="<?php echo $row['title'];  ?>"></td>
			<td>
			    <?php
			         if($row['isprimary']==0){
			             echo '<a href="javascript:void(0)"><img src="images/unpublish_small.png" onclick="change_status('.$row['id'].',1)" /></a>';
			         }else{
			             echo '<a href="javascript:void(0)"><img src="images/publish_small.png" onclick="change_status('.$row['id'].',0)" /></a>';
			         }
			    ?>
			</td>
            <td><a href="<?php echo $url2; ?>&id=<?php echo $row['id']; ?>"><img src="images/pencil.png" align="Edit" />Edit</a></td>
            <td><a href="?fol=actpages&amp;page=act_delimage&from=<?php echo $_GET['id']; ?>&id=<?php echo $row['id']; ?>"><img src="images/delete.png" />Delete</a></td>
            </tr>
        <?php $cnt++;} 
		 if(count($result[1])>1)
  {
  ?>
  <tr>
  <td></td>
    <td style="text-align:right;" colspan="3"><?php echo " ".implode(" ",$result[1])." ";?></td>
  
  </tr>
  <?php
  }	?>
  
  <table id="dataGrid" width="100%">
  </thead>
		  <form method="post" action="" enctype="multipart/form-data">
		  <table id="dataGrid" width="600px">
		  <thead>
		  <tr>
		  <td>Add Image</td>
		  <td></td>
		  </tr>
		  </thead>
		  <tr>
		  <td>Image name</td>
		  <td><input type="text" name="title"></td>
		  </tr>
		  <tr>
		  <td>Caption</td>
		  <td><input type="text" name="caption"></td>
		  </tr>
		  <tr>
		  <td>Image</td>
		  <td><input type="file" name="image"></td>
		  </tr>
		  <tr>
		  <td><input type="hidden" name="type" value="<?php echo $_GET['id']; ?>" /></td>
		  <td><input type="submit" name="submit" value="Submit"></td>
		  </tr>
		  </table>
		  </form> 
  </table>
 
    </tbody>
<?php }else{ ?>
	<thead>
    	<tr>
        	<td colspan="2">No <?php echo "Gallery Image"; ?> Found</td>
        	<td></td>
        </tr>
        
    </thead>
		  <form method="post" action="" enctype="multipart/form-data">
		  <table id="dataGrid" width="600px">
		  <thead>
		  <tr>
		  <td>Add Image</td>
		  <td></td>
		  </tr>
		  </thead>
		  <tr>
		  <td>Image name</td>
		  <td><input type="text" name="title"></td>
		  </tr>
		  <tr>
		  <td>Caption</td>
		  <td><input type="text" name="caption"></td>
		  </tr>
		  <tr>
		  <td>Image</td>
		  <td><input type="file" name="image"></td>
		  </tr>
		  <tr>
		  <td><input type="hidden" name="type" value="<?php echo $_GET['id']; ?>" /></td>
		  <td><input type="submit" name="submit" value="Submit"></td>
		  </tr>
		  </table>
		  </form>
<?php } ?>
</table>
<script>
    function change_status(id,status)
{  
    if(confirm('Sure to perfom the action'))
    {
       $.ajax({
           url:'actpages/change_status.php',
           type:'post',
           data:{"img_id":id,"value":status},
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
