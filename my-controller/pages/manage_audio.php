<?php 
echo "<h2>Manage Audio</h2>";
$url1 = "?page=aded_audio&action=add&type=".$_GET['id'];
		$url2 = "?page=aded_audio&action=edit&type=".$_GET['id'];
				$url3 = "?page=view_gallery";

$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from".RESOURCE."WHERE type = ".$_GET['id']." order by r_id desc";
$url = "?page=manage_gallery&id=".$_GET['id'];
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
?>
<table id="dataGrid" width="100%">
<?php  
	if(!empty($result)){
?>
    <thead>
    	<tr>
        	<td colspan="4">Add <?php echo "Audio"; ?></td>
            <td><a href="<?php echo $url1; ?>"><img src="images/add.png" alt="Add"></a></td>
        </tr>
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Title</td>
        <td colspan="3" width="40%"></td>
        </tr>
    </thead>
    <tbody>
		<?php $cnt = 1; 
			while ($row = $obj->fetch($result[0])){
				$url2 =$url2.$row['id'];
				if($cnt%2==0){
					$class = "even";	
				}else{
					$class = "odd";
				}
		?>    
        	<tr class="<?php echo $class ?>">
            <td><?php echo $cnt; ?></td>
            <td><?php echo $row['title'];  ?></td>
			<td>&nbsp;</td>		
            <td><a href="<?php echo $url2; ?>&id=<?php echo $row['r_id']; ?>"><img src="images/pencil.png" align="Edit" />Edit</a></td>
            <td><a href="?page=act_delaudio&type=<?php echo $_GET['id']; ?>&id=<?php echo $row['r_id']; ?>"><img src="images/delete.png" />Delete</a></td>
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
        	<td colspan="2">No <?php echo "Audio"; ?> Found</td>
        	<td><a href="<?php echo $url1; ?>"><img src="images/add.png" ></a></td>
        </tr>
        
    </thead>
<?php } ?>
</table>