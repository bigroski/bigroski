<?php  
//echo $_POST['action'];
//echo $_POST['type'];
//print_r($_POST);
//print_r($_FILES);
if($_POST['action']=="edit")
{
    //echo "this is edit";
    $obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"shortdesc"=>$_POST['shortdesc'],"sub_type"=>$_POST['subtype']);
    $obj->cond = array("r_id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['file']) && $_FILES['file']!='')
    {
        $type = $_FILES['file']['type'];
        $ext = "";
        if($type == "audio/mpeg")
                $ext = "mp3";
        if($ext != "")
        {

                $uploadPath = "../uploads/audio/";
                //for uploading file
                $temp_name = $_FILES['file']['tmp_name'];
                $file = $_POST['id']."_".$_FILES['file']['name'];
move_uploaded_file($temp_name,$uploadPath.$file);
                //$obj->UploadImage($temp_name, $ext, $file, $uploadPath);
                $obj->val = array("file"=>$file);
                $obj->cond = array("r_id"=>$_POST['id']);
                $obj->update();
    }
    }
        $msg = "Content Successfully updated";
        $url = "?page=manage_resources&id=".$_POST['type'];
        $obj->alert($msg,$url);
    
}else
{

    $obj->table_name = RESOURCE;
    $obj->val = array("title"=>$_POST['title'],"type"=>$_POST['type'],"shortdesc"=>$_POST['shortdesc'],"sub_type"=>$_POST['subtype']);
   // $obj->cond = array("id"=>$_POST['id']);
    $id = $obj->insert();
   if(isset($_FILES['file']) && $_FILES['file']!='')
    {
        $type = $_FILES['file']['type'];
        $ext = "";
        if($type == "audio/mpeg")
                $ext = "mp3";
        if($ext != "")
        {

                $uploadPath = "../uploads/audio/";
                //for uploading file
                $temp_name = $_FILES['file']['tmp_name'];
                $file = $id."_".$_FILES['file']['name'];
move_uploaded_file($temp_name,$uploadPath.$file);
                //$obj->UploadImage($temp_name, $ext, $file, $uploadPath);
                $obj->val = array("file"=>$file);
                $obj->cond = array("r_id"=>$id);

                $obj->update();
echo $obj->lastQuery;
    }
    }
        $msg = "Content Successfully Added";
        $url = "?page=manage_resources&id=".$_POST['type'];
        $obj->alert($msg,$url); 

}

//$obj->redirect("index.php?page=news");
?>