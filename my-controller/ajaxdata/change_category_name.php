<?php 
    include '../../classes/application_top.php';
    if(isset($_POST['id'])&&$_POST['id']!=""){
        $id = (int)$_POST['id'];
        $change_to = $obj->sanitize_quotes($_POST['change_to']);
        if($_POST['to']=='articles'){
            $obj->table_name = 'tbl_news_type';
            $obj->val = array('category'=>$change_to);
            $obj->cond = array('id'=>$id);
            $obj->update();
            echo json_encode(array('status'=>1));
        }elseif($_POST['to']=='members'){
            $obj->table_name = 'tbl_staff_cat';
            $obj->val = array('category'=>$change_to);
            $obj->cond = array('id'=>$id);
            $obj->update();
            echo json_encode(array('status'=>1));
        }elseif($_POST['to']=='ad'){
            $obj->table_name = 'tbl_ad_category';
            $obj->val = array('category'=>$change_to);
            $obj->cond = array('id'=>$id);
            $obj->update();
            echo json_encode(array('status'=>1));
        }
    }else{
        echo json_encode(array('status'=>0));
    }
        
?>