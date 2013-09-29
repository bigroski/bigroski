<?php   
include("../classes/application_top.php");
$row = $obj->getRequest($_GET['id']);
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
    <tr class="even">
      <td><span class="style2">Email Address </span></td>
      <td><span class="style2"><?php echo $row['email']?></span> </td>
    </tr>
	<tr class="odd">
      <td><span class="style2">Program</span></td>
      <td><span class="style2"><?php echo $row['program']?></span> </td>
    </tr>
	<tr class="even">
      <td><span class="style2">Artist</span></td>
      <td><span class="style2"><?php echo $row['artist']?></span> </td>
    </tr>
	<tr class="even">
      <td><span class="style2">Song</span></td>
      <td><span class="style2"><?php echo $row['song_title']?></span> </td>
    </tr>
    <tr class="odd">
      <td><span class="style2">Message</span></td>
      <td> <span class="style2"><?php echo $row['message']?></span> </td>
    </tr>
	
    <tr class="even">
      <td colspan="2" align="center" valign="middle">&nbsp;</td>
    </tr>
  </table>
