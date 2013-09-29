<?php  
	include("../../classes/application_top.php");
	$id = $_GET['id'];
	if($_GET['status']==1){
		$stat = 0;
	}else{
		$stat = 1;
	}
	$sql = "UPDATE tbl_message set status = $stat where id = $id";
	mysql_query($sql);
	$obj->redirect("../index.php?page=manage_message");
	
?>