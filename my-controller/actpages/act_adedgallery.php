<?php  
if($_POST['action']=="edit")
{
	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("Gallery Category Changed",'check-64.png');
    $obj->redirect('?page=manage_gallery&amp;id='.$_POST['type']);
    
    
}else
{
 	$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type']);
    $id = $obj->insert();
    Page_finder::set_message("A new Gallery has Been Created",'check-64.png');
    $obj->redirect('?page=view_gallery&id='.$id);
}

?>