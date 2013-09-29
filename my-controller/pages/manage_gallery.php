<?php  
echo "<h2>Manage Gallery</h2>";
$url1 = "?page=adedgallery&action=add&type=".$_GET['id'];
$url2 = "?page=adedgallery&action=edit&type=".$_GET['id'];
$url3 = "?page=view_gallery";
$pagination_query = array(RESOURCE,
                          '*',
                          array('type'=>(int)$_GET['id']),
                          array('r_id'=>'desc'));
$config = array('query'=>$pagination_query);
$pagination = new Pagination("?page=manage_gallery&id=".(int)$_GET['id'],$config);
?>
<table id="dataGrid" width="100%">
    <thead>
        <tr>
            <td colspan="4">Add <?php echo "Gallery"; ?></td>
            <td><a href="<?php echo $url1; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
        <tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <td colspan="3" width="40%"></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                while($r = $pagination->resource_body->fetch_data()){
                    $sql_count = "select id from tbl_images where type = ".$r->r_id;
                    $count_image = $obj->exec($sql_count);
                    $count = $obj->count($count_image);
                    echo '<tr>
                              <td>'.++$cnt.'</td>
                              <td>'.stripslashes($r->title).'<span class="display">'.$count.' Images</span</td>
                              <td><a href="'.$url3.'&id='.$r->r_id.'"><img src="images/gear.png" />View</a></td>
                              <td><a href="'.$url2.'&id='.$r->r_id.'"><img src="images/pencil.png" align="Edit" />Edit</a></td>
                              <td><a href="?fol=actpages&amp;page=act_delgal&from='.(int)$_GET['id'].'&id='.$r->r_id.'"><img src="images/delete.png" />Delete</a></td>
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
