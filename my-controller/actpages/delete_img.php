<?php 
	include "../../classes/application_top.php";
	if(isset($_POST['id'])&&$_POST['id']!=""){
	    if(isset($_POST['of'])&&$_POST['of']=="page"){
	        $result = $obj->select(MAIN_PAGE,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/pages/".$image_name);
                @unlink("../../uploads/pages/thumbs".$image_name);
                $obj->table_name = MAIN_PAGE;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
	    }elseif(isset($_POST['of'])&&$_POST['of']=="subpage"){
            $result = $obj->select(MAIN_PAGE,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/subpage/".$image_name);
                @unlink("../../uploads/subpage/thumbs".$image_name);
                $obj->table_name = MAIN_PAGE;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="prog"){
            $result = $obj->select("tbl_resource_sub_cat",'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/programs/".$image_name);
                @unlink("../../uploads/programs/thumbs".$image_name);
                $obj->table_name = "tbl_resource_sub_cat";
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="gallery"){
            $result = $obj->select("tbl_resource",'*',array("r_id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['file'];
                @unlink("../../uploads/images/".$image_name);
                @unlink("../../uploads/images/thumbs".$image_name);
                $obj->table_name = "tbl_resource";
                $obj->val = array("file"=>"");
                $obj->cond = array("r_id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="news"){
            $result = $obj->select(NEWS_TBL,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/news/".$image_name);
                @unlink("../../uploads/news/thumbs".$image_name);
                $obj->table_name = NEWS_TBL;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="slider"){
            $result = $obj->select(SLIDER,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/slider/".$image_name);
                @unlink("../../uploads/slider/thumbs".$image_name);
                $obj->table_name = SLIDER;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="staffs"){
            $result = $obj->select(STAFF_TBL,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/staffs/".$image_name);
                @unlink("../../uploads/staffs/thumbs".$image_name);
                $obj->table_name = STAFF_TBL;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }elseif(isset($_POST['of'])&&$_POST['of']=="ad"){
            $result = $obj->select(ADVERTISEMENT,'*',array("id"=>$_POST['id']));
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                $image_name = $row['image'];
                @unlink("../../uploads/advertisement/".$image_name);
                @unlink("../../uploads/advertisement/thumbs".$image_name);
                $obj->table_name = ADVERTISEMENT;
                $obj->val = array("image"=>"");
                $obj->cond = array("id"=>$_POST['id']);
                $obj->update();
                echo json_encode(array("status"=>1));
            }else{
                echo json_encode(array("status"=>0));
            }
        }
			
	}else{
		$obj->redirect("error.php");
	}
?>
