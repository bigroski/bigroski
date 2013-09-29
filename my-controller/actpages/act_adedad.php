<?php  
if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/advertisement/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
}else{
        $imageResult = "";
}
if($_POST['action']=="edit"){
	$obj->table_name = ADVERTISEMENT;
    $obj->val = array("title"=>$_POST['title'],"cat_id"=>$_POST['cat_id'],'url'=>$_POST['url']);
    if($imageResult!=""){
        $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message('Advertisement Successfully Edited');
    $obj->redirect('?page=manage_ad&adCategory='.$_POST['cat_id']);
}else{
	$obj->table_name = ADVERTISEMENT;
    $obj->val = array("title"=>$_POST['title'],"cat_id"=>$_POST['cat_id'],"image"=>$imageResult,'url'=>$_POST['url']);
    $id = $obj->insert();
    Page_finder::set_message('New Advertisement Successfully Added');
    $obj->redirect('?page=manage_ad&adCategory='.$_POST['cat_id']);
}
?>