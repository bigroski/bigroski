<?php  
$type = $_GET['type'];
$id = $_GET['id'];
$table = RESOURCE;
$row = $obj->getDelInfo1($table,$id);
if($row['image']!="" || $row['file']!=""){
		$url = "../uploads/audio/";
		$file1 = $url.$row['file'];
		unlink($file1);
		
}
		$obj->table_name = RESOURCE;
		$obj->cond = array("r_id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_resources&id=".$type;
		$obj->alert($msg,$url);

?>