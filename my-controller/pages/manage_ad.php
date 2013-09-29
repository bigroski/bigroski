<?php
$category_id = (int)$_GET['adCategory'];
$result_title = $obj->select("tbl_ad_category",'*',array("id"=>$category_id));
if(mysql_num_rows($result_title)!=""){
    $row_category = $obj->fetch($result_title);
    echo "<h2>Manage Advertisement (".stripslashes($row_category['category']).")</h2>";
}else{
    $obj->redirect("index.php");
}
  
$query_array = array('tbl_advertisement',
                     '*',
                     array('cat_id'=>$category_id),
                     array('id'=>'desc'));
                     $config = array('query'=>$query_array);
$pagination = new Pagination('?page=manage_ad',$config);
?>
<table id="dataGrid" width="100%">
    <thead>
        <tr>
            <td colspan="4">Add Advertisement</td>
            <td><a href="?page=adedad&action=add&adCategory=<?php echo $category_id; ?>"><img src="images/add.png" ></a></td>
        </tr>
        <tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <td>Status</td>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                $count = 0;
                while($adObj = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                             <td>'.++$count.'</td>
                             <td><img src="../uploads/advertisement/thumbs/'.$adObj->image.'" alt="'.$adObj->title.'"></td>
                             <td>';
                             ?>
                             
                <?php 
                    if($adObj->display==1){
                ?>
                    <a href="#"><img src="images/publish_small.png" align="published" onclick="change_status(<?php echo $adObj->id; ?>,0)" /></a>
                    <select onchange="return change_AdOrder('<?php echo $adObj->id;; ?>',this.value)">
                        <?php 
                            for($i = 0 ; $i <= $count ; ++$i){
                                    echo '<option value="'.$i.'"'.(($adObj->display==$i)?"selected":"").'>'.$i.'</option>';
                                }
                        ?>
                    </select>
                <?php }else{ ?>
                    <a href="#"><img src="images/unpublish_small.png" align="unpublished" onclick="change_status(<?php echo $adObj->id;  ?>,1)" /></a>
                <?php } ?>
            
                             <?php
                             echo '</td>
                             <td><a href="?page=adedad&action=edit&adCategory='.$category_id.'&id='.$adObj->id.'"><img src="images/pencil.png" />Edit</a></td>
                             <td><a href="?fol=actpages&amp;page=act_delad&id='.$adObj->id.'"><img src="images/delete.png" />Delete</a></td>
                          </tr>';
                }
            }else{
                 echo '<tr><td class="no-contents-found" colspan="4">No Articles Found</td></tr>';
            }
            if($pagination->pagination_link!=""){
                echo '<tr><td class="pagination" colspan="5">'.$pagination->pagination_link.'</td></tr>';
            }
        ?>
    </tbody>

 
</table>
<script type="text/javascript">
function change_AdOrder(id,value)
{  
	//alert(id+'--------'+value);
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
		   
          url:'actpages/change_adorder.php',
           type:'post',
           data:{"id":id,"position":value},
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
function change_status(id,status)
{  
    //alert(id+'--------'+p_order);
    var adCat = <?php echo $category_id ?>;
    var published = $("img[src$='images/publish_small.png']").length;
    //alert(adCat+'----------'+published);
    //if(adCat==1&&published==0||status==0||adCat!=1&&adCat!=2||adCat==2&&published==0){
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
           
           url:'actpages/change_status.php',
           type:'post',
           data:{"ad_id":id,"value":status},
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
    //}else{
    //    alert('Cannot Process Only One Advertisement of This category Allowed!');
    //}
}
</script>