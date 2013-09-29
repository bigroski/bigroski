<?php  

$id = $_GET['id'];
$table = PARTNER_TBL;
$row = $obj->getDelInfo($table,$id);
if($row['logo']!=""){
		$url = "../uploads/partner/";
		$url2 = "../uploads/partner/thumbs/";
		$file1 = $url.$row['logo'];
		$file2 = $url2.$row['logo'];
		unlink($file1);
		unlink($file2);
}
		$obj->table_name = PARTNER_TBL;
		$obj->cond = array("id"=>$id);
		$obj->delete();
		$msg = "Data Successfully deleted";
		$url = "?page=manage_partners";
		$obj->alert($msg,$url);

?>