<?php

class Variable_debugger{
    public static function debug_vars($variables){
        array_shift($variables);
        $exclude_vars = array("_ENV","HTTP_ENV_VARS","HTTP_POST_VARS","HTTP_GET_VARS","HTTP_COOKIE_VARS","HTTP_SERVER_VARS","HTTP_POST_FILES","_REQUEST"
                                ,"HTTP_SESSION_VARS");
        echo '<div id="debugger_console">
                <div id="debugger_console_title">Variable Debugger</div>
                <div id="debugger_console_close">[X]Close</div>';
                
        foreach($variables as $key=>$val){
            if(!in_array($key,$exclude_vars)){
                self::generate_html($key,$val);
            }
        }
        echo '</div>';                        
        
        
    }
    public static function generate_html($key, $val){
        echo '<div class="debug_container"><div class="debugger_val_title">'.$key.'</div>';
        if(is_array($val)&&!empty($val)){
            printArray($val);
        }elseif(is_object($val)){
            printArray($val);
        }else{
            echo '<div class="debugger_single_val">'.$val.'</div>';
        }
        echo '</div>';
    }
    
}
