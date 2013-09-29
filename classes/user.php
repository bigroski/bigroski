<?php 
/*
 * User Class validates user, create users, authenticates user, 
 * Note. 
 *      not Able to do good login validation
 * 
 * Supports captcha generation after 3 failed login attempts
 * */
    class USER_CLASS {
        //w3rogbei 
        public $password_is_hashed;
        //hashed token is the ip+browser in md5
        public $hashed_token;
        public $initializer;
        public $id;
        public $username;
        public $password;
        public $email;
        public $salt;
        public $salt_length=15;
        /**
         * Tracker in database;
         */
        public $dbLog;
        function __construct(){
            
        }
        
        public function create_user($username,$password,$email=NULL){
            global $obj;
            $user = $obj->sanitize_quotes($username);
            $pass = $obj->sanitize_quotes($password);
            $hashed_password = $this->generate_hashed_password($pass);
            $obj->table_name = 'tbl_admin';
            $obj->val = array('username'=>$user,'password'=>$hashed_password,'salt'=>$this->salt,'email'=>$email);
            $id = $obj->insert();
            return $id;
            //echo $this->checkPassword($pass, $hashed_password);
        }
        
        public function checkPassword($unhashed, $hashed){
            
            if($this->generate_hashed_password($unhashed)== $hashed){
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
        public function set_session($user_id){
            global $obj;
            $_SESSION['authuserid'] = $user_id;
            setcookie('activity_start',time(),time()*24);
            if(isset($_SESSION[redirect_to])){
                $redirect_to = $_SESSION[redirect_to];
                //unset('redirect_to');
                $_SESSION[redirect_to] = null;
                $obj->redirect($redirect_to);
            }else{
                $obj->redirect('index.php');
            }
            $this->valid_login($user_id);
            
        }
        
        public function checkLoggedIn(){
            //print_r($_SESSION);
            if (!isset($_SESSION['authuserid'])) {
                $_SESSION[redirect_to] = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                $url = "login.php";
                Page_finder::redirect_static($url);
            }else{
                if(isset($_COOKIE[activity_start])){
                    //inactivity time is greater than 30 mins redirect to logout
                    $diff = $this->calculate_activity_time();
                    if($diff>1800){
                        //printArray($_SERVER);
                        unset($_SERVER['authuserid']);
                        $_SESSION[redirect_to] = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
                        $url = "login.php";
                        $this->logout();
                        Page_finder::redirect_static($url);
                    }else{
                        //assign User Id for the user
                        $this->id = $_SESSION['authuserid'];
                        //assign new activity start time
                        setcookie('activity_start',time(),time()*24);
                        $this->latest_activity();
                    }
                }else{
                    setcookie('activity_start',time(),time()*24);
                    $this->latest_activity();
                }
            }
        }
        /**
         * calculate activity time
         * @return time difference
         */
        private function calculate_activity_time(){
            $now = time();
            $last_activity = $_COOKIE['activity_start'];
            //echo 'Now:-'.$now.'<br />Last Activity:-'.$last_activity;
            $time_difference = $now-$last_activity;
            //echo '<br />Time Difference in seconds:-'.$time_difference;
            return $time_difference;
        }
        public function authenticate_user($user,$pass){
            global $obj;
            $user = $obj->sanitize_quotes($user);
            $this->username = $user;
            $pass = $obj->sanitize_quotes($pass);
            $this->check_attempt(FALSE);
            if($this->enable_captcha==TRUE){
                $checkWith = $_SESSION['securimage_code_value'];
                $inserted = $_POST['code'];
                if($inserted == ''){
                    //If captcha code is not entered
                    return 1;
                }else{
                    if($checkWith!=$inserted){
                        $this->invalid_login();
                        return 'IV';
                    }
                }
                
            }
            $sql = "select * from tbl_admin where username='$user'";
            $result = $obj->exec($sql);
            if(mysql_num_rows($result)==1){
                $row = $obj->fetch($result);
                //$this->username = $row['user'];
                $db_password = $row['password'];
                $this->salt = $row['salt'];
                $auth = $this->checkPassword($pass,$db_password);
                if($auth===TRUE){
                    $this->set_session($row['id']);
                }else{
                    $this->invalid_login($row['id']);
                    return FALSE;
                }
                
            }else{
                $this->invalid_login();
                return FALSE;
            }
            
            
        }
        
        public function count_login_attempt(){
            global $obj;
            $ip = $_SERVER['REMOTE_ADDR'];
            $sql = "select count(*) as count_attempt from tbl_login_attempt where ip='$ip' and token='$this->hashed_token' and initializer='$this->initializer'";
            $result  = $obj->exec($sql);
            $count = $obj->fetch($result);
            return $count_attempt = $count['count_attempt'];
            
        }
        
        public function get_current_admin($adminId = FALSE){
            global $obj;
            
            if($adminId==FALSE){
                $result = $obj->select('tbl_admin','*',array('id'=>$_SESSION['authuserid']));
                
            }else{
                $result = $obj->select('tbl_admin','*',array('id'=>$adminId));
            }
            
            if(mysql_num_rows($result)!=""){
                $row = $obj->fetch($result);
                return $row['username'];
            }else{
                return false;
            }
        }
        
        public function check_attempt($generate=TRUE){
            $count_attempt = $this->count_login_attempt();
            if($count_attempt>3){
                $this->enable_captcha = TRUE;
                if($generate==TRUE){
                    return $this->generate_captcha();
                }
                
            }
        }
        
        public function generate_captcha(){
            echo '<tr><td align="center"><p style="background:none; border:none;height:auto; font:normal 2px Mangal, Arial, Helvetica, sans-serif; ">
            <img src="'.SITE_URL.'captcha/securimage_show.php?sid='.md5(uniqid(time())).'" id="image" align="absmiddle" style="width:130px; height: 40px;" />
            <a href="javascript:void(0)" onClick="document.getElementById(\'image\').src = \''.SITE_URL.'/captcha/securimage_show.php?sid=\' + Math.random(); return false"><img src="'.SITE_URL.'captcha/refresh.gif" border="0" style="width:18px; height:18px;"></a><br />
                   asdf </p></td>
                   
                    <td align="center">
                    <fieldset>
                    <legend>Captcha</legend>
                    <input type="text" name="code"/>
                    </fieldset>
                    </td>
                   </tr>';
        }
        
        public function generateError($auth_result=0){
             if(isset($auth_result)&&$auth_result==FALSE){
                     echo '<tr>
            <td colspan="2"><span class="loginErr">Invalid Username Or Password!</span></td>
            </tr>';
                 }elseif(isset($auth_result)&&$auth_result==1){
                     echo '<tr>
            <td colspan="2"><span class="loginErr">Captcha Error. Re-enter captcha code!</span></td>
            </tr>';  
                 }elseif(isset($auth_result)&&$auth_result=="IV"){
                     echo '<tr>
            <td colspan="2"><span class="loginErr">Captcha Error. Invalid captcha code!</span></td>
            </tr>';  
                     
                 }
        }
        
        public function password_recovery($email){
            global $obj;
            $email = $obj->sanitize_quotes($email);
            if($this->get_admin_by_email($email)==FALSE){
                //Email Not Found;
                return "NotFound";
            }else{
                return "Success";
            }
            
            
        }
        
        
        private function get_admin_by_email($email){
            global $obj;
            $result = $obj->select('tbl_admin','*',array('email'=>$email));
            if(mysql_num_rows($result)==1){
                $row = $obj->fetch($result);
                $admin_id = $row['id'];
                $admin_email = $row['email'];
                $this->salt = $row['salt'];
                $this->change_admin_password($admin_id,$admin_email);
                return TRUE;
            }else{
                return FALSE;
            }
        }
        
        public function change_admin_password($userid,$userEmail=NULL,$unhased_password=NULL){
            global $obj;
            if($unhased_password==NULL){
                $random_password = $this->generate_random_string();
            }else{
                $random_password = $unhased_password;
            }
            $hashed_random_password =  $this->generate_hashed_password($random_password);
            $obj->table_name = 'tbl_admin';
            $obj->val = array('password'=>$hashed_random_password);
            $obj->cond = array('id'=>$userid);
            $obj->update();
            $obj->lastQuery;
            if($userEmail!=NULL){
                $this->sendEmail($userEmail,$random_password);
            }
            //echo $random_password;
            return TRUE;
            
        }
        private function sendEmail($sendTo,$password){
            $subject ="Password Change Confirmation";
            $to=$sendTo;
            $admin_email = 'admin@itechnepal.com';
            //$to="mdh_anil@hotmail.com";
            $msg="\n Account Inormation <br><br>";
            $msg.="\n Your Account password has been successfully changed. The details of your Account are as follows.<br>";
            $msg.="\n Password:  $password \n";
            $msg .="\n Your password has been changed \n";
            $msg.="\n You Are Advised to Change Your Password Manually \n";
        //print_r($msg);
            $mailheaders = "From:  ".$admin_email." \r\n" .
                    "Content-Type: text/html; charset=utf-8\r\n" .
                   "Content-Transfer-Encoding: 8bit\r\n";
                   @mail($to, $subject, $msg, $mailheaders);
                   return TRUE;
        }
        
        private function generate_random_string(){
            //random password generator via Sweety Shiwakoti
            $length=9;
            $chars = "abcdefghijklmnopqrstuvwxyz!@#ABCDEFGHI$%^&*JKLMNOPQRSTUVWX()Y_Z+0123=456789";
            $size = strlen( $chars );
            for( $i = 0; $i < $length; $i++ ) {
                $str .= $chars[ rand( 0, $size - 1 ) ];
            }
            return $str;
            
        }
        /**
         * Logs in the details of the valid login
         */
        private function valid_login($userId){
            global $obj;
             $ip = $_SERVER['REMOTE_ADDR'];
             $sql = "select * from tbl_login_attempt where userid='$userId' and logout_time='0000-00-00 00:00:00'";
             $result = $obj->exec($sql);
             if(mysql_num_rows($result)!=""){
                 while($rt = $obj->fetch($result)){
                     $id = $rt[id];
                     $obj->table_name = 'tbl_login_attempt';
                     $obj->val = array('logstatus'=>0);
                     $obj->cond = array('id'=>$id);
                     $obj->update();
                 }
             }
             $obj->table_name = 'tbl_login_attempt';
             $obj->val = array('ip'=>$ip,'logstatus'=>1,'userid'=>$userId,'token'=>$this->hashed_token,'initializer'=>$this->initializer,'login_time'=>date("Y-m-d H:i:s"));
             $this->dbLog = $obj->insert();
            
        }
        
        private function invalid_login($userId=NULL){
            /*
             * Perform invalid Login here
             * */
             global $obj;
             $ip = $_SERVER['REMOTE_ADDR'];
             $obj->table_name = 'tbl_login_attempt';
             $obj->val = array('ip'=>$ip,'logstatus'=>0,'userid'=>$userId,'token'=>$this->hashed_token,'initializer'=>$this->initializer,'login_time'=>date("Y-m-d H:i:s"));
             $obj->insert();
             
             
        }
        
        public function generate_hashed_password($generateFrom){
            $key = '!@#$%^&()_+=-{}][<>.,';
               if ($this->salt == '')
               {
                   $this->salt = substr(hash('sha512',uniqid(rand(), true).$key.microtime()), 0, $this->salt_length);
               }
               
              return hash('sha512',$this->salt . $key .  $generateFrom).$this->salt;
        }
        
        public function setToken(){
            
            $browser_info = $_SERVER['HTTP_USER_AGENT'];
            $browser_array = explode(' ', $browser_info);
            $browser_name = $browser_array[0];
            $this->initializer = rand();
            $this->hashed_token = md5($this->initializer.$_SERVER['REMOTE_ADDR'].$browser_name);
            $_SESSION['token'] = $this->hashed_token;
            $_SESSION['initializer'] = $this->initializer;
        }
        
        public function session_to_properties(){
            
            $this->initializer = $_SESSION['initializer'];
            $this->hashed_token = $_SESSION['token'];
        }
        
        public function generateRecoveryError($responseStatus=NULL){
            switch($responseStatus){
                case 'NotFound':
                    echo '<tr>
                            <td colspan="2"><span class="loginErr">Sorry!! The requested Email not Found.</span></td>
                            </tr>';
                    break;
                case 'Success':
                    echo 'An Email has been sent. Follow the process as per the Email.'; 
                default:
                    break;
            }
        }
        
        static function create_instance($config){
            $user_obj = new USER_CLASS();
            $user_obj->password_is_hashed = $config['is_hashed'];
            if(isset($_SESSION['token'])){
                $user_obj->session_to_properties();                    
            }else{
                $user_obj->setToken();
            }
            return $user_obj;
        }
        /**
         * Logs out the Current User
         * 
         */
         public function logout(){
             global $obj;
             $obj->table_name = 'tbl_login_attempt';
             $obj->val = array('logstatus'=>2,'logout_time'=>date("Y-m-d H:i:s"));
             $obj->cond = array('token'=>$this->hashed_token,'initializer'=>$this->initializer);
             $obj->update();   
             unset($_SESSION['token']);
             unset($_SESSION['initializer']);
             unset($_SESSION['authuserid']);
             $url = "login.php";
             Page_finder::redirect_static($url);
         }
         /**
         * Latest Activity time of the user
         * 
         */
         public function latest_activity($token=NULL, $ini = NULL){
             global $obj;
             if($token==NULL){
                 $obj->cond = array('token'=>$this->hashed_token,'initializer'=>$this->initializer);
             }else{
                 $obj->cond = array('token'=>$token,'initializer'=>$ini);
             }
             $obj->table_name = 'tbl_login_attempt';
             $obj->val = array('last_activity'=>date("Y-m-d H:i:s"));
             $obj->update();   
             
         }
         
         public function available_admin($admin_user_id){
             global $obj;
             $sql = "select last_activity from tbl_login_attempt where userid = '$admin_user_id' and logstatus = 1 order by id desc";
             $result = $obj->exec($sql);
             if(mysql_num_rows($result)!=""){
                 $row = $obj->fetch($result,MYSQL_ASSOC);
                 $activity = $row['last_activity'];
                 $split = explode(' ', $activity);
                 $date_opt = explode('-', $split[0]);
                 $time_opt = explode(":", $split[1]);
                 $current = date("Y-m-d H:i:s");
                 $diff = time() - mktime($time_opt[0],$time_opt[1],$time_opt[2],$date_opt[1],$date_opt[2],$date_opt[0]);
                 //returns false if idle time is greater then 30 seconds
                 if($diff<30){
                     return true;
                 }else{
                     return false;
                 }
                 
                 
             }else{
                 return FALSE;
             }
         }
         
        /**
         * Gets all the usernames currently online
         */
         public function get_all_online_admin($current_admin = NULL){
             global $obj;
             if($current_admin!=NULL){
                 $this->id = $current_admin;
             }
             $result = $obj->select('tbl_login_attempt',array('userid'),array('logstatus'=>1),null,null,TRUE);
             if($result->total_data()!=""){
                 while($on = $result->fetch_data()){
                     if($on->userid!=$this->id){
                         if($this->available_admin($on->userid)==true){
                             $admin_names[] =$this->get_current_admin($on->userid);
                         }
                        
                     }
                 }
                 if(is_array($admin_names)){
                     return $admin_names;
                 }else{
                     return 'No Other Users online';
                 }
                 
             }else{
                 return NULL;
             }
         }
         public function get_admin_id_byName($admin_name){
             global $obj;
             $sql = "select id from tbl_admin where username='".$admin_name."'";
             $result = $obj->exec($sql);
             if(mysql_num_rows($result)!=""){
                 $rowi = $obj->fetch($result,MYSQL_ASSOC);
                 return $rowi[id];
             }
             
         }
         
    }
?>