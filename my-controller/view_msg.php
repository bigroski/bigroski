<?php   
include("../classes/application_top.php");
$row = $obj->getMessage($_GET['id']);
?>

<style type="text/css">
<!--
.style2 {color: #000000}
-->
</style>


  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" class="grid_header">Message Details </td>
    </tr>
    <tr class="even">
      <td width="25%">Name</td>
      <td width="75%"><span class="style2"><?php echo $row['name']?></span></td>
    </tr>
    <?php 
        if($row[image]!=""){
            echo '<tr><td></td><td><img src="../uploads/message/thumbs/'.$row[image].'" /></td></tr>';
        }
    ?>
    <tr class="even">
      <td><span class="style2">Email Address </span></td>
      <td><span class="style2"><?php echo $row['email']?></span> </td>
    </tr>
    <tr class="odd">
      <td><span class="style2">Message</span></td>
      <td> <span class="style2"><?php echo $row['message']?></span> </td>
    </tr>
    <tr class="even">
      <td><span class="style2">Status</span></td>
      <td> 
          <select id="change_status" onchange="change_status(<?php echo $row[id] ?>, this.value)">
              <option value="1" <?php if($row[status]==1) echo 'selected="selected"'; ?>>Processed</option>
              <option value ="0" <?php if($row[status]==0) echo 'selected="selected"'; ?>>Un-Processed</option>
          </select>
          </td>
    </tr>
	
    <tr class="even">
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
  </table>
<script>
    function change_status(id,status)
{  
    if(confirm('Sure to perfom the action'))
    {
       $.ajax({
           url:'actpages/change_status.php',
           type:'post',
           data:{"message_id":id,"value":status},
           dataType:'json',
          success:function(response)
            {
                if(response.status==1)
                    {
                        $('.hundred').hide('slow');
                        //alert(1);
                    }
            }
        });
    }
    
}
</script>