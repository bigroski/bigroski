<?php
echo "<h2>Manage&nbsp;Events</h2>";
//if(isset($_GET['type']) && $_GET['type']!=""){
		$class = "paging";// for designers
		
		$p = !empty($_GET['p']) ? $_GET['p'] : 1;
		$perpage = !empty($_GET['per']) ? $_GET['per'] : 32;
		if(isset($_POST['filter'])&&$_POST['filter']!=""){
		    $filterDate1 = (int)$_POST['year']."-".(int)$_POST['month']."-"."01";
            $filterDate2 = (int)$_POST['year']."-".((int)$_POST['month']+1)."-"."01";
            $sql ="select *,DATE_FORMAT(posted_on ,'%d %M %Y') as eDate from ".EVENT_TBL." where posted_on BETWEEN '$filterDate1' AND '$filterDate2' ";
            $order = " order by posted_on asc , date_tracker asc";
		}else{
		    $sql = "SELECT *,DATE_FORMAT(posted_on,'%d %M %Y') as eDate from ".EVENT_TBL;
             $order = " order by posted_on desc , date_tracker desc";
		}
		$url = "?page=manage_events";
		$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
//}
?>
<form action="" method="post">
<div class="filterOptions">
    <div class="filterTiltle">Filter Result </div>
    <div class="filterField">
        <select name="year">
            <?php 
                $offset = 2011;
                $currentYear = date('Y');
                while($offset<=$currentYear){
                    echo '<option value="'.$offset.'" '.((isset($_POST['year'])&&$_POST['year']==$offset)?' selected="selected"':"").'>'.$offset++.'</option>';
                }
            ?>
            
        </select>
    </div>
    <div class="filterField">
        <select name="month">
            <?php 
               for($i = 1;$i<=12;$i++){
                   echo '<option value="'.$i.'" '.((isset($_POST['month'])&&$_POST['month']==$i)?' selected="selected"':"").'>'.date('F',mktime(0,0,0,$i)).'</option>';
               }
            ?>
        </select>
        
        
    </div>
    <div class="filterField"><input type="submit" name="filter" class="btn" value="Filter" /></div>
</div>
</form>
	<table id="dataGrid" width="100%">


    <thead>
    	<tr>
        	<td colspan="3">Add Events</td>
            <td><a href="?page=adedevents&action=add"><img src="images/add.png" alt="Add"></a></td>
        </tr>
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
		<?php $cnt = 1; 
		if(!empty($result[1])){
			while ($row = $obj->fetch($result[0])){
				
		?>    
        	<tr>
            <td width="5%"><?php echo $cnt; ?></td>
            <td width="45%"><?php echo stripslashes($row['title']);  ?> <sub class="green"><?php echo $row['eDate']; ?></sub></td>
        	<td width="20%"><a href="?page=adedevents&action=edit&id=<?php echo $row['id']; ?>"><img src="images/pencil.png" align="Edit" />Edit</a></td>
            <td width="20%"><a href="?fol=actpages&amp;page=act_delete&to_delete=<?php echo $row['id']; ?>&per=events"><img src="images/delete.png" />Delete</a></td>
            </tr>
        <?php $cnt++;
			}}else{
				echo '<tr><td colspan="5">No Events Found</td></tr>';
			}
		 if(count($result[1])>1)
  {
  ?>
  <tr>
  <td></td>
    <td style="text-align:right;" colspan="3"><?php echo " ".implode(" ",$result[1])." ";?></td>
  
  </tr>
  <?php
  }
		
		?>
    </tbody>

</table>

<script type="text/javascript">
function change_status(id,value)
{  
	//alert(id+'--------'+value);
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
		   
          url:'actpages/change_status.php',
           type:'post',
           data:{"id":id,"news":value},
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