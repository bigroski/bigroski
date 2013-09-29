<?php   
include("../classes/application_top.php");
$row = $obj->getAd($_GET['id']);
?>

<style type="text/css">
<!--
.style2 {color: #000000}
-->
</style>
<img src="../uploads/advertisement/<?php echo $row['image']; ?>" />

  