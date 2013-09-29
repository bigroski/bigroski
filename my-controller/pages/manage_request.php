<?php 
echo "<h2>Manage Request</h2>";
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from".REQUEST_TBL." order by id DESC";
$url = "?page=manage_request&id=".$_GET['id'];
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
 ?>
 <table id="dataGrid" width="100%">
<?php  
	if(!empty($result)){
?>
    <thead>
    	<tr>
        	<td colspan="3"></td>
            <td></td>
        </tr>
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Sender Name</td>
        <td colspan="2" width="40%"></td>
        </tr>
    </thead>
    <tbody>
		<?php $cnt = 1; 
			while ($row = $obj->fetch($result[0])){
				if($cnt%2==0){
					$class = "even";	
				}else{
					$class = "odd";
				}
		?>    
        	<tr class="<?php echo $class ?>">
            <td width="5%"><?php echo $cnt; ?></td>
            <td width="45%"><?php echo $row['name'];  ?></td>
            <td width="20%"><a href="view_rqst.php?id=<?php echo $row['id']?>" class="thickbox"><img src="images/gear.png" align="Edit" />View</a></td>
            <td width="20%"><a href="?page=delrqst&id=<?php echo $row['id']; ?>"><img src="images/delete.png" />Delete</a></td>
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
        	<td colspan="2">No Contents Found</td>
        	<td></td>
        </tr>
        
    </thead>
<?php } ?>
</table>