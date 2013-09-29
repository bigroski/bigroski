<?php  
//print_r($_POST);
$vid = explode('/',$_POST['url']);
$video_url = 'http://www.youtube.com/v/'.$vid['3'];
if($_POST['action']=="edit"){
$obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"url"=>$video_url,"shortdesc"=>$_POST['shortdesc']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    $obj->redirect('?page=manage_video&stat=i-success&id='.$_POST['type']);
}else{
$obj->table_name = RESOURCE;
$obj->val = array("title"=>$_POST['title'],"url"=>$video_url,"type"=>$_POST['type'],"shortdesc"=>$_POST['shortdesc']);
$obj->insert();
$obj->redirect('?page=manage_video&stat=i-success&id='.$_POST['type']);
}