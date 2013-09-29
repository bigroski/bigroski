<?php
if(isset($_GET['id'])){
$sql_title = "Select * from tbl_resource_sub_cat where id = ".$_GET['id'];
$result_title = $obj->exec($sql_title);
$title = $obj->fetch($result_title);

echo "<h2>Manage&nbsp;".$title['title']."</h2>";


		$url1 = "?page=aded_document&action=add&type=1&sub_type=".$_GET['id'];
		$url2 = "?page=aded_document&action=edit&type=1&sub_type=".$_GET['id'];
		$url3 = "?page=act_deldocument&type=".$_GET['id'];
		
}else{
	$obj->redirect("index.php");	
}
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from".RESOURCE."WHERE sub_type = ".$_GET['id'];
$order = " order by r_id desc";
$url =  $_SERVER['REQUEST_URI'];
//echo $url = "?page=manage_resources&id=".$_GET['id'];
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
?>
<table id="dataGrid" width="100%">
<?php  
	if(!empty($result)){
?>
    <thead>
    	<tr>
        	<td colspan="3">Add <?php echo $title['title'] ?></td>
			<?php  
					if($_GET['id']==1){
							echo '<td></td>';
					}
			?>
            <td><a href="<?php echo $url1; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
		<?php  
				if($_GET['id']==1){
					echo '<td></td>';
				}
		?>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
		<?php $cnt = 1; 
			while ($row = $obj->fetch($result[0])){
				if($_GET['id']==1){
					$r_id = $row['r_id'];
				}else{
					$r_id = $row['r_id'];
				}
				if($cnt%2==0){
					$class = "even";	
				}else{
					$class = "odd";
				}
		?>    
        	<tr class="<?php echo $class ?>">
            <td><?php echo $cnt; ?></td>
            <td><?php echo $row['title'];  ?></td>
            
					<?php  
				if($_GET['id']==1){
			?>
				<td><a href="?page=view_archive?id=<?php echo $r_id; ?>"><img src="images/gear.png" alt="View" />View</a></td>
			<?php
				}
				?>

			<td><a href="<?php echo $url2; ?>&id=<?php echo $r_id; ?>"><img src="images/pencil.png" align="Edit" />Edit</a></td>
            <td><a href="<?php echo $url3; ?>&id=<?php echo $r_id; ?>"><img src="images/delete.png" />Delete</a></td>
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
  }
		
		?>
    </tbody>
<?php }else{ ?>
	<thead>
    	<tr>
        	<td colspan="2">No Contents <?php echo $title['title'] ?> Found</td>
        	<td><a href="<?php echo $url1; ?>"><img src="images/add.png" ></a></td>
        </tr>
        
    </thead>
<?php } ?>
</table>
