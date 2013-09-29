<?php  
echo "<h2>Manage Slider Image</h2>";
$pagination_query = array('tbl_slider',
                          array('id','title','image'),
                          null,
                          array('id'=>'asc'));
$config_pagination = array('query'=>$pagination_query);                          
$pagination = new Pagination('?page=manage_slider', $config_pagination);
?>
<table id="dataGrid" width="100%">
    <thead>
    	<tr>
        	<td colspan="3">Add Slider Image</td>
        	<td><a href="?page=adedslider"><img src="images/add.png" title="Add Slider Image" ></a></td>
        </tr>
    </thead>
    <tbody>
        <?php 
            if($pagination->resource_body->total_data()!=""){
                while($slider_data = $pagination->resource_body->fetch_data()){
                    echo '<tr>
                          <td></td>
                          <td><img src="../uploads/slider/thumbs/'.$slider_data->image.'" title="'.stripslashes($slider_data->title).'"></td>
                          <td><a href="?page=adedslider&action=edit&id='.$slider_data->id.'"><img src="images/pencil.png" alt = "Edit" title="Edit Slider Image" />Edit</a></td>
                          <td><a href="?fol=actpages&amp;page=act_delete&per=slider&to_delete='.$slider_data->id.'"><img src="images/delete.png" />Delete</a></td>
                          </tr>';
                }
                
            }else{
                echo '<tr><td class="no-contents-found"> No slider Images Found. </td></tr>';
            }
           if($pagination->pagination_link!=""){
                echo '<tr><td style="text-align:right;"colspan="4">'.$pagination->pagination_link.'</td></tr>';
            }
        ?>
		
    </tbody>
</table>
