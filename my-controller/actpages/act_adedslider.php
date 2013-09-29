<?php  
if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/slider/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
}else{
        $imageResult = "";
}
if($_POST['action']=="edit"){
	$obj->table_name = SLIDER;
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc']);
    if($imageResult!=""){
        $obj->val['image'] = $imageResult;
    }
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("Silder successfully Edited.",'check-64.png');
    $obj->redirect("?page=manage_slider");
}else{
	
	$obj->table_name = SLIDER;
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc'],"image"=>$imageResult);
    $id = $obj->insert();
    Page_finder::set_message("Silder successfully Added.",'check-64.png');
    $obj->redirect("?page=manage_slider");
		
}
?>