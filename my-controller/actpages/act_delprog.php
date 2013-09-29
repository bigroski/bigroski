<?php  
$type = $_GET['type'];
$id = (int)$_GET['id'];
$url = "../uploads/images/";
$url2 = "../uploads/images/thumbs/";

		$sql = "select * from tbl_resource where r_id = $id ";
		$result = $obj->exec($sql);
		while($row = $obj->fetch($result)){
		$file1 = "../".UPLOAD_PATH.$row['file'];
			@unlink($file1);
		}
		$obj->table_name = "tbl_resource";
		$obj->cond = array("r_id"=>$id);
		$obj->delete();
		
		$msg = "Data Successfully deleted";
		$url = "?page=manage_resources&id=3";
		echo '<script>history.go(-1)</script>';

?>