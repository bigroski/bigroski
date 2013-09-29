<?php  

//print_r($_FILES);

if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/news/';
        $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
        $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
        $image_obj  =  ImageManipulation::generateClass($config);
        $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
}else{
        $imageResult = "";
}
if($_POST['action']=="edit")
{
	//echo "this is edit";
	$obj->table_name = NEWS_TBL;
    $obj->val = array("title"=>$_POST['title'],
                        "caption"=>$_POST['caption'],
                        "shortdesc"=>$_POST['shortdesc'],
                        "description"=>$_POST['description'],
                        "posted_on"=>$_POST['date'],
                        "type"=>$_POST['type']);
    if($imageResult!=""){
        $obj->val['image'] = $imageResult;
    }
    
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    Page_finder::set_message("News successfully Edited.",'check-64.png');
    Soptimizer::set_SEO_Values($_POST[meta_title],$_POST[meta_keyword],$_POST[meta_description],$_POST['id'],$obj->table_name);
    $obj->redirect('?page=manage_news&type='.$_POST['type']);
}else{
 	$obj->table_name = NEWS_TBL;
	$obj->val = array("title"=>$_POST['title'],
                    	"caption"=>$_POST['caption'],
                    	"shortdesc"=>$_POST['shortdesc'],
                    	"description"=>$_POST['description'],
                    	"type"=>$_POST['type'],
                    	"posted_on"=>$_POST['date'],
                        "image"=>$imageResult);
    $id = $obj->insert();
    Soptimizer::set_SEO_Values($_POST[meta_title],$_POST[meta_keyword],$_POST[meta_description],$id,$obj->table_name);
    Page_finder::set_message("News Successfully Added",'check-64.png');
    $obj->redirect('?page=manage_news&type='.$_POST['type']);	
}
?>







