<?php  
$type = $_GET['from'];
$id = $_GET['id'];
$obj->table_name = MESSAGE;
$obj->cond = array("id"=>$id);
$obj->delete();
$msg = "Data Successfully deleted";
$url = "?page=manage_message";
$obj->alert($msg,$url);

?>