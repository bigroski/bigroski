<?php 
echo "<h2>Manage Poll</h2>";
$query = array('questions',
               '*',
               null,
               array('created_on'=>'desc'));
$config = array('query'=>$query);
$pagination = new Pagination("?page=manage_poll",$config);

 ?>
 <table id="dataGrid" width="100%">
     <thead>
        <tr>
            <td colspan="3"></td>
            <td></td>
        </tr>
        <tr>
            <td width="5%">Sno</td>
            <td width="45%">Poll Question</td>
            <td></td>
            <td width="40%"><a href="?page=adedpoll"><img src="images/add.png" alt="Add"></a></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                while($r = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                              <td>'.++$cnt.'</td>
                              <td>'.stripslashes($r->ques).'</td>
                              <td width="20%"><a href="?page=adedpoll&amp;id='.$r->id.'"><img src="images/pencil.png" alt="Edit" />Edit</a></td>
                              <td width="20%"><a href="?fol=actpages&amp;page=act_delpoll&amp;id='.$r->id.'"><img src="images/delete.png" alt="Delete" />Delete</a></td>
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