<?php
$day = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");

$d = $_GET['day'];
$schedule_day = $day[$d];
?>


<h1>Program Schedule</h1>
<table id="dataGrid">
<tr>
<td><strong>Select Day</strong></td>
<td><select name="day" onchange="window.location='index.php?page=manage_program&day='+this.value">
<option value="">--Select a day--</option>
	  <?php
	  foreach($day as $key=>$val)
	  {
	  ?>
	  <option value="<?php echo $key?>" <?php if($d == $key) echo "selected";?>><?php echo $val?></option>
	  <?php
	  }?>

</select></td>
<td colspan="5"></td>
</tr>
</table>
<table id="dataGrid">


<?php  
$class = "paging";// for designers
$p = !empty($_GET['p']) ? $_GET['p'] : 1;
$perpage = !empty($_GET['per']) ? $_GET['per'] : 25;
$sql = "SELECT * FROM tbl_program WHERE day = '$schedule_day' ORDER BY start_time";
$url = "?page=manage_program&day=$d";
$result = $obj->PageMe($url, $order, $perpage, $sql, $class, $p);
if(!empty($result[1]))
{
?>
<thead>
<tr>
<td colspan="5"><strong>Program Schedule</strong></td>

<td><a href="index.php?page=adedprogram&action=add&day=<?php echo $d; ?>"><img src="images/add.png" alt="add" title="add"/></a></td>
</tr>

<tr>
<td><b>Sno</td>
<td><b>Program Name</td>
<td><b>Start Time</td>
<td><b>End Time</td>

<td colspan="2"><b>Action</td>
</tr>
</thead>
<?php 
while($row = $obj->fetch($result[0])){
?>
<tr>
<td><?php echo ++$sn; ?></td>
<td><?php  echo $row['title']; ?></td>
<td><?php  echo $row['start_time']; ?></td>
<td><?php  echo $row['end_time']; ?></td>

<td><a href="index.php?page=adedprogram&action=edit&day=<?php echo $d; ?>&id=<?php echo $row['pro_id']; ?>"><img src="images/pencil.png" alt="Edit" title="Edit"/></a></td>
<td><a href="?fol=actpages&amp;page=act_program&action=delete&day=<?php echo $d; ?>&id=<?php echo $row['pro_id']; ?>"><img src="images/delete.png" alt="Delete" title="Delete"/></a></td>

</tr>
<?php }}
else{
 ?>
<thead>
<tr>
<td colspan="5"><strong>No contents </strong></td>
<td>&nbsp;</td>
<td><a href="index.php?page=adedprogram&action=add&day=<?php echo $d; ?>"><img src="images/add.png" alt="add" title="add"/></a></td>
</tr>
</thead>
<?php } ?>
 <?php
  if(count($result[1])>1)
  {
  ?>
  <tr>
    <td colspan="7" style="text-align:right;" ><?php echo " &thinsp; ".implode("&nbsp;&nbsp;&nbsp;",$result[1])." "; ?></td>
  </tr>
 <?php } ?>
</table>