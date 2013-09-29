<?php 
    class Page_finder{
        public function redirect(&$url){
            header('Location:'.$url);
        }
        public static function redirect_static(&$url){
            header('Location:'.$url);
        }
      public static  function pagefinder($page='home',$folder='pages'){
            if($page==""){
                
                $page="home";
                
            }
            if($folder==""){
                
                $folder="pages";
            }
            $path = $folder.'/'.$page.'.php';
            if(file_exists($path)){
                return $path;
            }else{
                return 'pages/404.php';
            }
        }
      
      public static function getStatus($status){
          if($status=="i-success"){
              echo '<div class="box">
                     <div class="box_head"><img src="images/check-64.png" /> Content Successfully Added!!</div>
                    </div>';
          }elseif($status=="u-success"){
             echo '<div class="box">
                    <div class="box_head"><img src="images/check-64.png" /> Content Successfully Edited!!</div>
                    </div>';
          }else{
              echo '<div class="box">
                    <div class="box_head"><img src="images/unchecked.gif" /> No tinkering With The Url!!</div>
                    </div>';
          }
      }
      public static function  set_message($msg, $img="check-64.png"){
          if(!empty($msg)){
              $_SESSION['session_message'] = $msg;
              $_SESSION['session_image'] = $img;
          }
      }
      
      public static function get_message(){
          if(isset($_SESSION['session_message'])&&$_SESSION['session_message']!=""){
              $msg =  '<div class="box">
                     <div class="box_head"><img src="images/'.$_SESSION['session_image'].'" /> '.$_SESSION['session_message'].'</div>
                    </div>';
                    unset($_SESSION['session_message']);
                    unset($_SESSION['session_image']);
              return $msg;
          }else{
              return FALSE;
          }
          
      }
      public static function redirect_with_error($msg=null){
          global $obj;
          if($msg==null){
              self::set_message("An Error Has Occured. Page Not found .",'error.png');
          }else{
              self::set_message($msg,'error.png');
          }
          
          $send_back_to = 'index.php';
          $obj->redirect($send_back_to);
      }
      
}
?>