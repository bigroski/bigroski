<?php 
//$obj->Print_Array($_POST);
if(isset($_POST['btn_submit'])&&$_POST['btn_submit']!=""){
    if(isset($_POST['id'])){
        $userId = (int)$_POST['id'];
        $username= mysql_real_escape_string($_POST['username']);
        $resultUser = $obj->select(" tbl_user_prev",
                                    '*',
                                    array("id"=>$_POST['id']));
        if(mysql_num_rows($resultUser)!=""){
            //$resultAllUser = $obj->select("tbl_admin",array("username"),array("username"=>$username));
            
                $obj->table_name = "tbl_user_prev";
                $prev = array_slice($_POST, 4, -1,true);
                $prev['admin_id'] = $inserted;
                $obj->val = $prev;
                $obj->cond = array("id"=>$userId);
                $obj->update();    
                Page_finder::set_message('A user Details has Been Updated');
           
        }else{
            Page_finder::set_message('User Not Found','error.png');
        }                            
    }else{
        $username = mysql_real_escape_string($_POST['username']);
        $email = mysql_real_escape_string($_POST['email']);
        $check_existing = $obj->select('tbl_admin',array('id'),array('username'=>$username));
        if(mysql_num_rows($check_existing)==""){
            $password = mysql_real_escape_string($_POST['pass']);
            $repass = mysql_real_escape_string($_POST['repass']);
            if($password==$repass){
                $inserted = $user_obj->create_user($username, $password, $email);
                $obj->table_name = "tbl_user_prev";
                $prev = array_slice($_POST, 4, -1,true);
                $prev['admin_id'] = $inserted;
                $obj->val = $prev;
                $obj->insert();
                Page_finder::set_message('A new user has been created.');
            }
        }
        
    }
}else{
    Page_finder::set_message('Error Error.....','error.png');
}
$obj->redirect('?page=manage_user');

?>