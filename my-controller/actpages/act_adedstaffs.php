<?php  

if($_POST['include_screencast']=='y'){
    include("lib/GrabzItClient.class.php");
    include("config.php");
    try
        {
            $grabzIt = new GrabzItClient($grabzItApplicationKey, $grabzItApplicationSecret);
            $grabzIt->SetImageOptions($_POST['lastname']);
            $name = rand();
            $filepath = "../uploads/staffs/$name.jpg";
            $grabzIt->SaveTo($filepath);
            $grabzIt->Save($grabzItHandlerUrl);
        }
        catch (Exception $e)
        {
            $message =  $e->getMessage();
        }
}

$dob  = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
if($_POST['action']=="edit")
{
	//echo "this is edit";
	$obj->table_name = STAFF_TBL;
    $obj->val = array("firstname"=>$_POST['firstname'],"middlename"=>$_POST['middlename'],"lastname"=>$_POST['lastname'],"post"=>$_POST['post'],"email"=>$_POST['email'],"about"=>$_POST['about'],"contact"=>$_POST['contact'],"address"=>$_POST['address']);
	if(isset($name)&&$name!=""){
	    $obj->val['image'] = $name.'.jpg';
	}
    
    $obj->cond = array("id"=>$_POST['id']);
    $obj->update();
    if(isset($_FILES['image']) && $_FILES['image']!='')
    {
        $type = $_FILES['image']['type'];
        $ext = "";
        if($type == "image/png")
                $ext = "png";
        elseif($type == "image/gif")
                $ext = "gif";
        elseif($type == "image/jpeg")
                $ext = "jpg";
        elseif($type == "image/bmp")
                $ext = "bmp";
        elseif($type == "image/pjpeg")
                $ext = "jpg";

	    if($ext != "")
    	{

        		$uploadPath = "../uploads/staffs/";
        		$destPath = "../uploads/staffs/thumbs/";
                //for uploading image
				$temp_name = $_FILES['image']['tmp_name'];
				$img_name = $_POST['id'].".".$ext;
				$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		        if(file_exists($uploadPath.$img_name))
        	        $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,210,210);
                $obj->val = array("image"=>$img_name);
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
		}
        Page_finder::set_message("Client Edited");
        $obj->redirect('?page=manage_staffs&stat=i-success&id='.$_POST['type']);
		//$obj->redirect('?page=manage_staffs&stat=u-success&id='.$_POST['type']);
	}
}elseif($_POST['action']== "add")
{

 	$obj->table_name = STAFF_TBL;
   
    $obj->val = array("firstname"=>$_POST['firstname'],"middlename"=>$_POST['middlename'],"lastname"=>$_POST['lastname'],"post"=>$_POST['post'],"type"=>$_POST['type'],"email"=>$_POST['email'],"about"=>$_POST['about'],"contact"=>$_POST['contact'],"address"=>$_POST['address']);
	if(isset($name)&&$name!=""){
        $obj->val['image'] = $name.'.jpg';
    }
    $id = $obj->insert();
   
		$type = $_FILES['image']['type'];
		$ext = "";
		if($type == "image/png")
			$ext = "png";
		elseif($type == "image/gif")
			$ext = "gif";
		elseif($type == "image/jpeg")
			$ext = "jpg";
		elseif($type == "image/bmp")
			$ext = "bmp";
		elseif($type == "image/pjpeg")
			$ext = "jpg";

		if($ext != "")
		{
		$uploadPath = "../uploads/staffs/";
		$destPath = "../uploads/staffs/thumbs/";
			//for uploading image
		 $temp_name = $_FILES['image']['tmp_name'];
		
		$img_name = $id.".".$ext;
		$obj->UploadImage($temp_name, $ext, $img_name, $uploadPath);
		if(file_exists($uploadPath.$img_name))
			 $obj->CreateThumb($img_name,$ext,$uploadPath,$destPath,210,210);
                $obj->val = array("image"=>$img_name);
                $obj->cond = array("id"=>$id);
                $obj->update();
		}
        Page_finder::set_message("Client Added");
        $obj->redirect('?page=manage_staffs&stat=i-success&id='.$_POST['type']);
        //$obj->redirect('?page=manage_staffs&stat=i-success&id='.$_POST['type']);	

}

//$obj->redirect("index.php?page=news");
?>