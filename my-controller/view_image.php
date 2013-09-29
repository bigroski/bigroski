<?php   
include("../classes/application_top.php");
$row = $obj->getImage($_GET['id']);
?>

<style type="text/css">
<!--
.style2 {color: #000000}
-->
</style>
<img src="../uploads/images/<?php echo $row['image']; ?>" />

  