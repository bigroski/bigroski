<?php  
include ("../../classes/constants.php");
$con = mysql_connect(SERVERNAME,USER,PASSWORD) or die (mysql_error());
$db = mysql_select_db(DATABASE);
if(isset($_POST['id'])){
$id = (int)$_POST['id'];
$status = (int)$_POST['value'];
$table = $_POST['table'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
  //echo "update tbl_news set status = '$status' where id = '$id'";
mysql_query("update tbl_news set $table = '$status' where id = '$id'");
echo json_encode(array("status"=>1));

}
?>