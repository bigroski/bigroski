<?php  

//print_r($_POST);
if($_POST['action']=="edit")
{
	
	$obj->table_name = EVENT_TBL;
    $obj->val = array("title"=>$_POST['title'],
						"shortdesc"=>$_POST['shortdesc']
						,"description"=>$_POST['description'],
						"posted_on"=>$_POST['date']);
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("Event Updated");
    $obj->redirect('?page=manage_events');
}else{

 	$obj->table_name = EVENT_TBL;
	$obj->val = array("title"=>$_POST['title'],
						"shortdesc"=>$_POST['shortdesc'],
						"description"=>$_POST['description'],
						"posted_on"=>$_POST['date'],
						"posted_by"=>$_SESSION['authuserid']);
	
    $id = $obj->insert();
    Page_finder::set_message("New Event Added");
    $obj->redirect('?page=manage_events');
        	
}
?>