<?php
if(isset($_GET['id'])){
$title = $obj->getResourceType($_GET['id']);
echo "<h2>Manage&nbsp;".$title['category']."</h2>";
//$result = $obj->getAllResources($_GET['id']);
switch($_GET['id']){
	case 1:
		$url1 = "?page=aded_prog&action=add&type=".$_GET['id'];
		$url2 = "?page=aded_prog&action=edit&type=".$_GET['id'];
		$url3 = "?fol=actpages&amp;page=act_delprog&type=".$_GET['id'];
		break;	
	case 2:
		$url1 = "?page=adeddocument&action=add&type=".$_GET['id'];
		$url2 = "?page=adeddocument&action=edit&type=".$_GET['id'];
		$url3 = "?fol=actpages&amp;page=act_deldocument&type=".$_GET['id'];
		break;
	/*case 3:
		$obj->redirect("?page=manage_audio&id=".$_GET['id']);
		break;*/
	case 5:
		$obj->redirect("?page=manage_video&id=".$_GET['id']);
		break;
	
	case 3:
		$obj->redirect("?page=manage_gallery&id=".$_GET['id']);
		break;
	case 4:
		$url1 = "?page=adeddocument&action=add&type=".$_GET['id'];
        $url2 = "?page=adeddocument&action=edit&type=".$_GET['id'];
        $url3 = "?fol=actpages&amp;page=act_deldocument&type=".$_GET['id'];
		break;
}
}else{
	$obj->redirect("index.php");	
}
if(isset($_GET['filterType'])&&$_GET['filterType']!=""){
    $filterType = (int)$_GET['filterType'];
    $pagination_query = array(RESOURCE,
                          '*',
                          array('type'=>(int)$_GET['id'],'sub_type'=>$filterType),
                          array('r_id'=>'desc'));
}else{
    $pagination_query = array(RESOURCE,
                          '*',
                          array('type'=>(int)$_GET['id']),
                          array('r_id'=>'desc'));
}



$config_pagination = array('query'=>$pagination_query);
$pagination = new Pagination('?page=manage_resources&id='.(int)$_GET['id'],$config_pagination);
?>
<?php 
    if($_GET['id']==1){
?>
<div class="box" style="float:left;">
    <div class="boxHolder">Filter
        <?php
    $result_audioCat = $obj->select('tbl_resource_sub_cat',array('id','title'),array('type'=>1));
    if(mysql_num_rows($result_audioCat)!=""){
        echo '<select name="subtype" id="subtype">';
        while($row_audioCat  =  $obj->fetch($result_audioCat)){
            $cat[$row_audioCat['id']] = $row_audioCat['title'];
            echo '<option value="'.$row_audioCat['id'].'" '.((isset($row)&&$row['sub_type']==$row_audioCat['id'])?'selected="selected"':'').'>'.$row_audioCat['title'].'</option>';
        }
        echo '</select>';
        echo '<input type="button" class="btn" value="GO" onclick="filterData()" style="margin-left:5px;">';
    }
?>
        </div>
</div>
<?php } ?>
<script>
    function filterData(){
        var val = document.getElementById('subtype').value;
        //alert(val);
        window.location = "?page=manage_resources&id=1&filterType="+val;
    }
</script>
<table id="dataGrid" width="100%">
    <thead>
        <tr>
            <td colspan="3">Add <?php echo $title['category'] ?></td>
                <?php  
                    if($_GET['id']==1){
                            echo '<td></td><td></td>';
                    }
            ?>
            <td><a href="<?php echo $url1; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
        <tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <?php  
                if($_GET['id']==1){
                    echo '<td>Category</td><td></td>';
                }
        ?>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                while($r = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                            <td>'.++$cnt.'</td>
                            <td>'.htmlentities(stripslashes($r->title)).'</td>
                            <td>'.$cat[$r->sub_type].'</td>
                            <td><a href="'.$url2.'&id='.$r->r_id.'"><img src="images/pencil.png" align="Edit" />Edit</a></td>
                            <td><a href="'.$url3.'&id='.$r->r_id.'"><img src="images/delete.png" />Delete</a></td>
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
<script type="text/javascript" charset="utf-8">
    
function change_AdOrder(id,value)
{  
    //alert(id+'--------'+value);
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
           
          url:'actpages/change_adorder.php',
           type:'post',
           data:{"id":id,"resource":value},
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
