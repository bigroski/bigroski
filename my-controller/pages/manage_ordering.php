<?php  
	echo "<h2>Manage Page Ordering</h2>";
	//$result = $obj->getAllSubPage($_GET['type']);
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 10;
$sql = "SELECT * from tbl_page WHERE parent_id = ".$_GET['type']. " ORDER BY p_order ";
$url = "?page=manage_ordering&id=".$_GET['type'];
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
$count_no = mysql_num_rows($obj->exec($sql));
?>
<script type="text/javascript">
function change_pageordering(id,p_order)
{  
	//alert(id+'--------'+p_order);
    if(confirm('Sure to perfom the action'))
    {
           $.ajax({
		   
           url:'actpages/change_ordering.php',
           type:'post',
           data:{"id":id,"p_order":p_order},
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
<table id="dataGrid" width="100%">
    <thead>
		<tr>
		<td>Sno</td>
		<td>Page Name</td>
		<td>Page Ordering</td>
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
            <td width="45%"><?php echo $row['pagelabel'];  ?></td>
            <td width="20%"><select name="select" onchange="return change_pageordering('<?php echo $row['id']?>',this.value)">
		<?php
		for($i=1;$i<=$count_no;$i++)
		{
		?>
		<option value="<?php echo $i?>" <?php if($i==$row['p_order']) echo "selected";?>><?php echo $i;?></option>
		<?php
		}
		?>
        </select>      </a></td>
            
            </tr>
        <?php $cnt++;} 
		 if(count($result[1])>1)
  {
  ?>
  <tr>
  <td></td>
    <td style="text-align:right;" colspan="3"><?php echo " ".implode(" ",$result[1])." ";?></td>
  
  </tr>
  <?php } ?>
    
</table>
