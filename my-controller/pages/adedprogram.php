

<?php 
$hours = array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16","17"=>"17","18"=>"18","19"=>"19","20"=>"20","21"=>"21","22"=>"22","23"=>"23");
$minutes = array("00"=>"00","05"=>"05","10"=>"10","15"=>"15","20"=>"20","25"=>"25","30"=>"30","35"=>"35","40"=>"40","45"=>"45","50"=>"50","55"=>"55");
$day = array("01"=>"Sunday","02"=>"Monday","03"=>"Tuesday","04"=>"Wednesday","05"=>"Thursday","06"=>"Friday","07"=>"Saturday");
	
	if($_GET['action']=="edit"){
		$action = "edit";
		$row = $obj->getSelProgram($_GET['id']);
	echo "<h2>Edit Program</h2>";
		$start = explode(":",$row['start_time']);
				$end = explode(":",$row['end_time']);
	}elseif($_GET['action']=="add"){
	$action = "add";
		echo "<h2>Add New Program</h2>";
		}
?>


<form method="post" id="prgform" action="?page=act_program&amp;fol=actpages">
<table id="dataGrid">
	
	<tr>
	<td>Program Name</td>
	<td><input type="text" name="title" value="<?php echo $row['title']; ?>" /></td>
	</tr>

<tr>
<td>Select Day</td>
<td> 
	  <?php
	  foreach($day as $key=>$val)
	  {
	  ?>
	 <input type="checkbox" name="dayselect[]" value="<?php echo $key; ?>" id="dayselect[]" <?php if($action=="edit"){if($val == $row['day']) { echo "checked='checked'"; }else{ echo "disabled='disabled'";}} ?>/><?php echo $val; ?><br />
	  <?php
	  }?>

	  </td>
</tr>


<tr>
<td>Start Time</td>
<td>      <select name="start_hour" class="required" title="Select Start Time" title="select time">
	  <option value="">-Select Time-</option>
          <?php
          foreach($hours as $key=>$val)
          {
              ?>
          <option value="<?php echo $val; ?>" <?php if($val == $start[0]){ echo "selected"; } ?>><?php echo $val; ?></option>
          <?php
          }
          ?>
    </select>
      <select name="start_min" class="required" title="Select Minute">
      <option value="">-Select Minute-</option>
          <?php
          //foreach($minutes as $key=>$val)
          for($val = 0; $val<60 ; $val++)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $start[1]){ echo "selected"; } ?>><?php echo $val?></option>
              <?php
          }
          ?>
      </select>
</td>
</tr>
<tr>
<td>End Time</td>
<td>      <select name="end_hour" class="required" title="Select End Time">
	  <option value="">-Select Time-</option>
           <?php
          foreach($hours as $key=>$val)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $end[0]){ echo "selected"; } ?>><?php echo $val?></option>
          <?php
          }
          ?>
      </select>
      <select name="end_min" class="required" title="Select Minute">
      <option value="">-Select Minute-</option>
          <?php
          foreach($minutes as $key=>$val)
          {
              ?>
          <option value="<?php echo $val?>" <?php if($val == $end[0]){ echo "selected"; } ?>><?php echo $val?></option>
              <?php
          }
          ?>
      </select></td>

</tr>


<tr>
<td><input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" /><input type="hidden" name="r_dic" value="<?php echo $_GET['day']; ?>" /><input type="hidden" name="action" value="<?php echo $_GET['action']; ?>" /></td>
<td><input type="submit" name="submit" value="Submit" /></td>
</tr>

</table>
</form>