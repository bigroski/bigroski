<?php  
$type = $_GET['from'];
$id = $_GET['id'];
$table = SLIDER;
$row = $obj->getDelInfo($table,$id);
if($row['image']!=""){
		$url = "../uploads/slider/";
		$url2 = "../uploads/slider/thumbs/";
		$file1 = $url.$row['image'];
		$file2 = $url2.$row['image'];
		unlink($file1);
		unlink($file2);
}
		$obj->table_name = SLIDER;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_slider";
		$obj->alert($msg,$url);

?>