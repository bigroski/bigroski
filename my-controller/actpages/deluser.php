<?php 
    if(isset($_GET['id'])&&$_GET['id']!=''){
        $userId = (int)$_GET['id'];
        $resultUser = $obj->select("tbl_user_prev",'*',array("id"=>$userId));
        if(mysql_num_rows($resultUser)==1){
            $found_user = $obj->fetch($resultUser);
            $adminId = $found_user['admin_id'];
            $obj->table_name = "tbl_user_prev";
            $obj->cond = array("id"=>$userId);
            $obj->delete();
            $obj->table_name = "tbl_admin";
            $obj->cond = array("id"=>$adminId);
            $obj->delete();
            $obj->alert("User Successfully Deleted","?page=manage_user");
            
        }else{
            $obj->redirect("index.php");
        }
    }else{
        $obj->redirect("index.php");
    }
?>