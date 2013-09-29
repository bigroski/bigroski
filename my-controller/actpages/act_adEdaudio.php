<?php  
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);
if($_POST['action']=="edit")
{
	//echo "this is edit";
	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['file']) && $_FILES['file']!='')
    {
       $type = $_FILES['file']['type'];
       	$uploadPath = "../uploads/audio/";
       	//for uploading file
		$temp_name = $_FILES['file']['tmp_name'];
		$file = $_POST['id']."_".$_FILES['file']['name'];
		$obj->UploadImage($temp_name, $ext, $file, $uploadPath);
		$obj->val = array("file"=>$file);
        $obj->cond = array("r_id"=>$_POST['id']);
        $obj->update();
		
		$msg = "Document Successfully updated";
		$url = "?page=manage_resources&id=".$_POST['type'];
		$obj->alert($msg,$url);
	}
}else
{

 	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"shortdesc"=>$_POST['shortdesc']);
   // $obj->cond = array("id"=>$_POST['id']);
    $id = $obj->insert();
   
		$type = $_FILES['file']['type'];
		$ext = "";
		$uploadPath = "../uploads/audio/";
		//for uploading file
		 $temp_name = $_FILES['file']['tmp_name'];
		$file = $id."_".$_FILES['file']['name'];
		$obj->UploadImage($temp_name, $ext, $file, $uploadPath);
		$obj->val = array("file"=>$file);
        $obj->cond = array("r_id"=>$id);
        $obj->update();
		$msg = "Document Successfully Added";
		$url = "?page=manage_resources&id=".$_POST['type'];
		$obj->alert($msg,$url);	

}

//$obj->redirect("index.php?page=news");
?>