<?php  
$type = $_GET['from'];
$id = $_GET['id'];
$obj->table_name = REQUEST_TBL;
$obj->cond = array("id"=>$id);
$obj->delete();
$msg = "Data Successfully deleted";
$url = "?page=manage_request";
$obj->alert($msg,$url);

?>