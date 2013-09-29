<?php  
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);
//printArray($_FILES);
//die("Stop Here");
if($_FILES['image']['error']==0){
        $config['directory'] = '../uploads/documents/';
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
    $obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc']);
    if($imageResult!=""){
        $obj->val['url'] = $imageResult;
    }
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['file']) && $_FILES['file']!='')
    {
        $type = $_FILES['file']['type'];
        //$uploadedType = $_FILES['documentFile']['type'];
        $availableExt = array("doc"=>"application/msword",
                                      "dot"=>"application/msword",
                                      "docx"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                                      'ppt'=>"application/vnd.ms-powerpoint",
                                      'pot'=>"application/vnd.ms-powerpoint",
                                      "pps"=>'application/vnd.ms-powerpoint',
                                      "ppa"=>"application/vnd.ms-powerpoint",
                                      "pptx"=>"application/vnd.openxmlformats-officedocument.presentationml.presentation",
                                      "xls"=>"application/vnd.ms-excel",
                                      "xlsx"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                      "pdf"=>"application/pdf");
        $extension = array_search($type, $availableExt);
        if($extension != "")
        {

                $uploadPath = "../uploads/documents/";
                //for uploading file
                $temp_name = $_FILES['file']['tmp_name'];
                $file = $_POST['id']."_".$_FILES['file']['name'];
                $obj->UploadImage($temp_name, $extension, $file, $uploadPath);
                $obj->val = array("file"=>$file);
                $obj->cond = array("r_id"=>$_POST['id']);
                $obj->update();
        }
        
    }
Page_finder::set_message('Document Edited');
$obj->redirect('?fol=pages&page=manage_resources&id=2');
//$obj->redirect('?page=manage_resources&stat=u-success&id='.$_POST['type']);
}else
{

    $obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"file"=>$_POST['file'],"shortdesc"=>$_POST['shortdesc'],"sub_type"=>$_POST['sub_type'],"url"=>$imageResult);
   // $obj->cond = array("id"=>$_POST['id']);
    $id = $obj->insert();
        $type = $_FILES['file']['type'];
        //$uploadedType = $_FILES['documentFile']['type'];
        $availableExt = array("doc"=>"application/msword",
                                      "dot"=>"application/msword",
                                      "docx"=>"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                                      'ppt'=>"application/vnd.ms-powerpoint",
                                      'pot'=>"application/vnd.ms-powerpoint",
                                      "pps"=>'application/vnd.ms-powerpoint',
                                      "ppa"=>"application/vnd.ms-powerpoint",
                                      "pptx"=>"application/vnd.openxmlformats-officedocument.presentationml.presentation",
                                      "xls"=>"application/vnd.ms-excel",
                                      "xlsx"=>"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                                      "pdf"=>"application/pdf");
        $extension = array_search($type, $availableExt);
        if($extension != "")
        {

                $uploadPath = "../uploads/documents/";
                //for uploading file
                $temp_name = $_FILES['file']['tmp_name'];
                
                $file = $id."_".$_FILES['file']['name'];
                $obj->UploadImage($temp_name, $extension, $file, $uploadPath);
                $obj->val = array("file"=>$file);
                $obj->cond = array("r_id"=>$id);
                $obj->update();
                
        }
        Page_finder::set_message('Document Added');
$obj->redirect('?fol=pages&page=manage_resources&id=2');
         

}

//$obj->redirect("index.php?page=news");
?>