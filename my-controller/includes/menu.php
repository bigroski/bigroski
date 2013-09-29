<?php 
    $previlage = $obj->checkPrevilage($_SESSION['authuserid']);
    $menu = new Menu($setting_options[site_features],$previlage, $obj);
    
?>
 <div class="online">
     <span class="dim_Message">Users Online</span>
                    <?php 
                       /* $ret = $user_obj->get_all_online_admin();
                        echo '<ul class="current_online" name="'.$_SESSION[authuserid].'">';
                        if(is_array($ret)){
                            
                            foreach($ret as $uv){
                                echo '<li><a href="javascript:void(0)" class="online_client" name="'.$user_obj->get_admin_id_byName($uv).'">'.$uv.'</a></li>';
                            }
                            
                        }
                        echo '</ul>';
                    */?>
                </div>
