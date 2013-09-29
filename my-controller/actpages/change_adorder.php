<?php  
include ("../../classes/application_top.php");

if(isset($_POST['position'])){
	$id = $_POST['id'];
	$position = $_POST['position'];
	//echo "update tbl_advertisement set position = '$position' where id = '$id'";
	mysql_query("update tbl_advertisement set position = '$position' where id = '$id'");
	echo json_encode(array("status"=>1));

}elseif(isset($_POST['resource'])){
    $id = $_POST['id'];
    $position = $_POST['resource'];
    //echo "update tbl_advertisement set position = '$position' where id = '$id'";
    mysql_query("update tbl_resource_sub_cat set position = '$position' where id = '$id'");
    echo json_encode(array("status"=>1));
}
?>