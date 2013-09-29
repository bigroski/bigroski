<?php  
if(isset($_GET['id'])){
    $cat = (int)$_GET['id'];
    $traverse_category = $obj->travese_categories('tbl_staff_cat', $cat);
    if($traverse_category==""){
        $traverse_category = $cat;
    }else{
        $t = $traverse_category;
        $traverse_category = substr($traverse_category, 0,-1);
        if($traverse_category==""){
            $traverse_category = $t;
        }
    }
    $title = $obj->getStaffType($cat);
    if($title == ""){
        $obj->redirect('index.php');
    }
    echo "<h2>Manage&nbsp;".$title['category']."<a href=\"?page=addteam&id=".$_GET['id']."\"><img src=\"images/microscope.png\" title=\"Click here to Edit Category\"></a><a href=\"actpages/delcat.php?type=2&id=".$_GET['id']."\"><img src=\"images/error.png\" title=\"Click here to Delete Category\"></a></h2>";
$sql = "SELECT * from".STAFF_TBL."WHERE type IN ($traverse_category)";
$config = array('query'=>$sql);
$pagination = new Pagination("?page=manage_staffs&id=$cat",$config);

}else{
	$obj->redirect("index.php");	
}
?>
<script type="text/javascript">
function change_staffordering(id,s_order)
{  
	//alert(id+'--------'+s_order);
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
		   
           url:'actpages/change_ordering.php',
           type:'post',
           data:{"id":id,"s_order":s_order},
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
<table id="dataGrid" width="100%">
    <thead>
        <tr>
            <td colspan="5">Add <?php echo $title['category'] ?></td>
            <td><a href="?page=adedstaffs&action=add&type=<?php echo $_GET['id']; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
        <tr>
            <td width="5%">Sno</td>
            <td width="40%">Associates/Clients</td>
            <td width="10%"></td>
            <td>Ordering</td>
            <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                while($r = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                              <td>'.++$cnt.'</td>
                              <td>'.stripslashes($r->firstname).' '.stripslashes($r->lastname).'</td><td></td>
                              <td>';
                              ?>
                              <select name="select" onchange="return change_staffordering('<?php echo $r->id ?>',this.value)">
                                    <option value="0">Select Rank</option>
                                <?php
                                    for($i=1;$i<=$pagination->resource_body->total_data();$i++)
                                    {
                                ?>
                                    <option value="<?php echo $i?>" <?php if($i==$r->s_order) echo "selected";?>><?php echo $i;?></option>
                                <?php
                                    }
                                ?>
                                </select>  
                              <?php
                    echo     '</td>
                                <td width="20%"><a href="?page=adedstaffs&action=edit&id='.$r->id.'&type='.$r->type.'"><img src="images/pencil.png" align="Edit" />Edit</a></td>
                        <td width="20%"><a href="?fol=actpages&amp;page=delstaffs&type='.$_GET['id'].'&id='.$r->id.'"><img src="images/delete.png" />Delete</a></td>
                          </tr>';
                }
            }else{
                echo '<tr><td class="no-contents-found" colspan="4">No Articles Found</td></tr>';
            }
            if($pagination->pagination_link!=''){
                 echo '<tr><td class="pagination" colspan="6">'.$pagination->pagination_link.'</td></tr>';
            }
        ?>
    </tbody>

</table>