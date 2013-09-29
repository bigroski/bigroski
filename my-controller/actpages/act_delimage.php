<?php  
$type = $_GET['from'];
$id = $_GET['id'];
$table = IMAGE_TBL;
$row = $obj->getDelInfo($table,$id);
if($row['image']!=""){
		$url = "../uploads/images/";
		$url2 = "../uploads/images/thumbs/";
		$file1 = $url.$row['image'];
		$file2 = $url2.$row['image'];
		unlink($file1);
		unlink($file2);
}
		$obj->table_name = IMAGE_TBL;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=view_gallery&id=".$type;
		$obj->alert($msg,$url);

?>