<?php  
echo "<h2>Manage&nbsp;Useful Links</h2>";
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from".PARTNER_TBL." order by name ";
$url = "?page=manage_partners";
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
//$result = $obj->getAllContent($_GET['id']);
?>
<table id="dataGrid" width="100%">
<?php  
	if(!empty($result)){
?>
    <thead>
    	<tr>
        	<td colspan="3">Add Useful Links</td>
            <td><a href="?page=adedpartners&action=add"><img src="images/add.png" alt="Add"></a></td>
        </tr>
    	<tr>
        <td width="5%">Sno</td>
        <td width="45%">Link Title</td>
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
            <td width="20%"><a href="?page=adedpartners&action=edit&id=<?php echo $row['id']; ?>"><img src="images/pencil.png" align="Edit" />Edit</a></td>
            <td width="20%"><a href="?fol=actpages&amp;page=act_delpartner&id=<?php echo $row['id']; ?>"><img src="images/delete.png" />Delete</a></td>
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
        	<td colspan="2">No Links Found</td>
        	<td><a href="?page=adedpartners&action=add"><img src="images/add.png" ></a></td>
        </tr>
        
    </thead>
<?php } ?>
</table>