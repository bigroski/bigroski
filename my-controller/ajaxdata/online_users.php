<?php 
    include '../../classes/application_top.php';
    //printArray($_SESSION);
    $user_obj->latest_activity($_SESSION[token],$_SESSION[initializer]);
    $ret = $user_obj->get_all_online_admin($_SESSION[authuserid]);
    if(is_array($ret)){
        foreach($ret as $uv){
            echo '<li><a href="javascript:void(0)" class="online_client" name="'.$user_obj->get_admin_id_byName($uv).'">'.$uv.'</a></li>';
            
        }
        
     }
                        
                    
?>