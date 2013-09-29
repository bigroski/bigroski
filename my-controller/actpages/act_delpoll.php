<?php  

 $id = $_GET['id'];
	$res_option = $obj->exec("select * from options where ques_id = '$id'");
	while($ras_option = $obj->fetch($res_option))
	{
		$op_id = $ras_option['id'];
		$obj->exec("delete from votes where option_id = '$op_id'");
		$obj->exec("delete from options where id = '$op_id'");	
	}
   	$obj->exec("delete from questions where id = '$id'");
   // $obj->redirect("./?act=manage_poll&to=poll");
		$msg = "Data Successfully deleted";
		$url = "?page=manage_poll";
		$obj->alert($msg,$url);

?>