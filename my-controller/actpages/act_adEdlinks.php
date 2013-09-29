<?php  
//print_r($_POST);
if($_POST['action']=="edit")
{
	//echo "this is edit";
	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"url"=>$_POST['url']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    	$msg = "Data Successfully updated";
		$url = "?page=manage_resources&id=".$_POST['type'];
		$obj->alert($msg,$url);
	
}else
{

 	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"url"=>$_POST['url']);
    $id = $obj->insert();
     $msg = "Data Successfully Added";
		$url = "?page=manage_resources&id=".$_POST['type'];
		$obj->alert($msg,$url);	

}

//$obj->redirect("index.php?page=news");
?>