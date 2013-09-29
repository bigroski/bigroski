<?php
$current =  $_SERVER['REQUEST_URI'];

if(isset($_GET['type'])&&$_GET['type']!=""){
    $type = (int)$_GET['type'];
    $resultType = $obj->select(NEWS_TYPE,'*',array("id"=>$type));
    if(mysql_num_rows($resultType)!=""){
        $rowType = $obj->fetch($resultType);
        echo "<h2 class=\"green\">".$rowType['category']."<a href=\"javascript:void(0)\" onclick=\"change_category();\"><img src=\"images/microscope.png\" title=\"Click here to Edit Category\"></a><a href=\"actpages/delcat.php?type=1&id=".$type."\"><img src=\"images/error.png\" title=\"Click here to Delete Category\"></a></h2>";
        $pagination_query = array('tbl_news',
                        '*',
                        array('type'=>$_GET['type']),
                        array('id'=>'desc','posted_on'=>'desc'));
        $config = array('query'=>$pagination_query);
        $pagination = new Pagination("?page=manage_news&amp;type=$type", $config);
    }else{
        $obj->redirect("index.php");
    }
}else{
    //$obj->redirect("index.php");
    echo "<h2 class=\"green\">Article Section </h2>";
    $pagination_query = array('tbl_news',
                        '*',
                        null,
                        array('id'=>'desc','posted_on'=>'desc'));
    $config = array('query'=>$pagination_query);
    $pagination = new Pagination("?page=manage_news", $config);
}

?>
<?php 
    if($type==23){
        echo '<span style="color:red;">Note: Manual Enable and Disable Required for Breaking News</span>';
    }
?>

	<table id="dataGrid" width="100%">

    <thead>
    	<tr>
        	<td colspan="3">Add News</td>
            <td><a href="?page=adednews&action=add<?php if(isset($type)) echo "&amp;type=$type"; ?>" ><img src="images/add.png" alt="Add"></a></td>
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
                while($data_row = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                          <td>'.++$cnt.'</td>
                          <td>'.$data_row->title.'</td>
                          <td><a href="?page=adednews&action=edit&id='.$data_row->id.'&type='.$data_row->type.'"><img src="images/pencil.png" alt="edit" /></a></td>
                          <td><a href="?fol=actpages&amp;page=act_delete&to_delete='.$data_row->id.'&per=news"><img src="images/delete.png" />Delete</a></td>
                          </tr>';
                }
            }else{
                echo '<tr><td class="no-contents-found" colspan="4">No Articles Found</td></tr>';
            }
            if($pagination->pagination_link!=""){
                echo '<tr><td class="pagination" colspan="4">'.$pagination->pagination_link.'</td></tr>';
            }
        ?>
		
	
    </tbody>

	

</table>
<script>

function change_category(){
    var id = <?php echo $type; ?>;
    var new_name = prompt('Enter New Category Name','<?php echo $rowType[category]; ?>');
    if(new_name!=""){
        $.ajax({
                    url:'ajaxdata/change_category_name.php',
                    data:{'id':id,'change_to':new_name,'to':'articles'},
                    type:'post',
                    dataType:'json',
                    success:function(r){
                        if(r.status==1){
                            location.reload();
                        }else{
                            alert('Error!! Cannot rename Category');
                        }
                        
                    }
                });
    }else{
        alert('Error!! Cannot rename Category');
    }
        
}
    function change_status(id,value,table){
        
        if(confirm('Sure to perfom the action'))
    {
           $.ajax({
           
               url:'actpages/change_newstat.php',
               type:'post',
               data:{"id":id,"value":value,"table":table},
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
