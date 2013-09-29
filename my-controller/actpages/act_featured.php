<?php 
	$id = $_GET['id'];
	$from = $_GET['status'];
	if($from == 1){
		$to = 0;
	}elseif($from == 0){
		$to = 1;		
	}
	$obj->table_name = "tbl_resource_sub_cat";
	$obj->val = array("featured"=>$to);
	$obj->cond = array("id"=>$id);
	$obj->update();
	$obj->redirect("index.php?page=manage_resources&id=1");
?>