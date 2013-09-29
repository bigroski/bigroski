<?php  
$type = $_GET['from'];
$id = $_GET['id'];
$table = ADVERTISEMENT;
$row = $obj->getDelInfo($table,$id);
if($row['image']!=""){
		$url = "../uploads/advertisement/";
		$url2 = "../uploads/advertisement/thumbs/";
		$file1 = $url.$row['image'];
		$file2 = $url2.$row['image'];
		unlink($file1);
		unlink($file2);
}
		$obj->table_name = ADVERTISEMENT;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_ad&adCategory=".$row['cat_id'];
		$obj->alert($msg,$url);

?>