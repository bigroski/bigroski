<?php  
include ("../../classes/constants.php");
$con = mysql_connect(SERVERNAME,USER,PASSWORD) or die (mysql_error());
$db = mysql_select_db(DATABASE);
if(isset($_POST['s_order'])){
$id = $_POST['id'];
$s_order = $_POST['s_order'];
  //echo "    update tbl_staff set s_order = '$s_order' where id = '$id'";
mysql_query("update tbl_staffs set s_order = '$s_order' where id = '$id'");
echo json_encode(array("status"=>1));

}else{
$id = $_POST['id'];
$p_order = $_POST['p_order'];
  //     "update tbl_subpage set order = '$p_order' where id = '$id'";
mysql_query("update tbl_page set p_order = '$p_order' where id = '$id'");
echo json_encode(array("status"=>1));

}?>