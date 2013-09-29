<?php  
$type = $_GET['type'];
$id = $_GET['id'];
$table = STAFF_TBL;
$row = $obj->getDelInfo($table,$id);
if($row['image']!=""){
		$url = "../uploads/staffs/";
		$url2 = "../uploads/staffs/thumbs/";
		$file1 = $url.$row['image'];
		$file2 = $url2.$row['image'];
		unlink($file1);
		unlink($file2);
}
		$obj->table_name = STAFF_TBL;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_staffs&id=".$type;
		$obj->alert($msg,$url);

?>