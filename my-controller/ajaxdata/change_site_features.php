<?php 
    include '../../classes/application_top.php';
    function remove_brace($fun){
        $fun = str_replace('[', '', $fun);
        $fun = str_replace(']', '', $fun);
        return $fun;
    }
    if(isset($_POST['string_data'])&&$_POST['string_data']!=""){
        $_POST['string_data'] = str_replace('%5B', '[', $_POST['string_data']);
        $_POST['string_data'] = str_replace('%5D', ']', $_POST['string_data']);
        $pattern = '/\[[0-9]*\]/';
        $m = preg_match_all($pattern,$_POST['string_data'],$out);
        $obj->exec('update tbl_features set isactive=\'0\'');
        foreach($out[0] as $val){
            
            $v = remove_brace($val);
            $obj->table_name = 'tbl_features';
            $obj->val = array('isactive'=>'1');
            $obj->cond = array('id'=>(int)$v);
            $obj->update();
        }
        $previlage_obj->modify_privilage_options();
        Page_finder::set_message('Site Feature Settings Saved');
        echo json_encode(array('status'=>1));
    }else{
        echo json_encode(array('status'=>0));
    }    
?>