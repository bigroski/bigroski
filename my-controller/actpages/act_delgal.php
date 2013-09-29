<?php  
$type = $_GET['type'];
$id = $_GET['id'];
$url = "../uploads/images/";
$url2 = "../uploads/images/thumbs/";
$table = RESOURCE;
$row = $obj->getDelInfo1($table,$id);
if($row['image']!="" || $row['file']!=""){
		
		$file1 = $url.$row['file'];
		$file2 = $url2.$row['file'];
		@unlink($file1);
		@unlink($file2);
		
}
		$obj->table_name = RESOURCE;
		$obj->cond = array("r_id"=>$id);
		$obj->delete();
		$result = $obj->ImgDelInfo($id);
		while($row = $obj->fetch($result)){
			$file1 = $url.$row['image'];
			$file2 = $url2.$row['image'];
			@unlink($file1);
			@unlink($file2);
		}
		$obj->table_name = IMAGE_TBL;
		$obj->cond = array("type"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_resources&id=3";
		$obj->alert($msg,$url);

?>