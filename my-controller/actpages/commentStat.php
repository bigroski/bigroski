<?php 
    include "../../classes/application_top.php";
    if(isset($_POST)){
        $obj->table_name = "tbl_newscomment";
        $obj->val = array("status"=>$_POST['status']);
        $obj->cond = array("id"=>$_POST['rowId']);
        $obj->update();
        echo json_encode(array("status"=>1));
    }
    
?>