<?php  
if(isset($_POST['submit']))
{
    if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/pages/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
    }else{
            $imageResult = "";
    }
    $obj->table_name = "tbl_page";
    $obj->val = array("pagelabel"=>$_POST['pagelabel'],
                      "description"=>$_POST['description'],
                      "shortdesc"=>$_POST['shortdesc'],
                      "heading"=>$_POST['heading'],
                      "has_subpage"=>$_POST['has_subpage'],
                      "parent_id"=>$_POST['parent_id']);
    if($imageResult!=""){
        $obj->val['image'] = $imageResult;
    }
    if(isset($_POST['id'])&&$_POST['id']!=""){
                
            $obj->cond = array("id"=>(int)$_POST['id']);
            
            $obj->update();
            
            Page_finder::set_message("Page Edit Successful.",'check-64.png');
            
            $obj->redirect('?page=manage_page&id='.$_POST['id']);
    }else{
                
            $inserted_id = $obj->insert();
            
            Page_finder::set_message("Page Addition Successful.",'check-64.png');
            
            $obj->redirect('?page=manage_page&id='.$inserted_id);
    }




}else{
	Page_finder::set_message("An Error Has Occured.",'check-64.png');
    $obj->redirect('index.php');
}
?>