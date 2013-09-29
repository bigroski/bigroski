<?php 
echo "<h2>Manage Video</h2>";
$url1 = "?page=adedvideo&action=add&type=".$_GET['id'];
$url2 = "?page=adedvideo&action=edit&type=".$_GET['id'];
$url3 = "?page=view_gallery";

$pagination_query = array(RESOURCE,
                          '*',
                          array('type'=>(int)$_GET['id']),
                          array('r_id'=>'desc'));
$config_pagination = array('query'=>$pagination_query);
$pagination = new Pagination("?page=manage_resource&id=".(int)$_GET['id'],$config_pagination);                          
?>
<table id="dataGrid" width="100%">
    <thead>
        <tr>
            <td colspan="3">Add <?php echo "Video"; ?></td>
            <td><a href="<?php echo $url1; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
        <tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                $cnt = 0;
                while($r = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                              <td>'.++$cnt.'</td>
                              <td>'.stripslashes($r->title).'</td>
                              <td><a href="'.$url2.'&id='.$r->r_id.'"><img src="images/pencil.png" />Edit</a></td>
                              <td><a href="?fol=actpages&amp;page=act_delvid&type='.(int)$_GET['id'].'&id='.$r->r_id.'"><img src="images/delete.png" />Delete</a></td>
                          </tr>';
                }
            }else{
                 echo '<tr><td class="no-contents-found" colspan="4">No Articles Found</td></tr>';
            }
            if($pagination->pagination_link!=''){
                 echo '<tr><td class="pagination" colspan="5">'.$pagination->pagination_link.'</td></tr>';
            }
        ?>
    </tbody>
</table>