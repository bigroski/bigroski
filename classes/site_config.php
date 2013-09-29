<?php

class Site_Config{
    public static function fileCreate(){
        $fp = fopen('../globalinc/g_db_config.php','w');
                $string = '<?php 
                            $config[host]="'.$_POST[host].'";
                            $config[username]="'.$_POST[username].'";
                            $config[password]="'.$_POST[password].'";
                            $config[database]="'.$_POST[database].'";
                           ?>';
                $fw = fwrite($fp,$string);
                fclose($fp);
                //self::importDb($_POST[database]);
        
    }
    /*
     * Creates A g_db_config.ini file
     */
     
     public function importDb($db){
        // mysql db_name < backup-file.sql
        //echo "c:/wamp/mysql/bin/mysql --host=$_POST[host] --user=$_POST[username] --password=$_POST[password] $db < ../globalinc/datab.sql";
        $mysqlImportFilename ='../globalinc/datab.sql';
          //passthru("mysql --host=$_POST[host] --user=$_POST[username] --password=$_POST[password] $db < ../globalinc/datab.sql", $r);
		  echo $command='mysql -h' .$_POST[host] .' -u' .$_POST[username] .' -p' .$_POST[password] .' ' .$db .' < ' .$mysqlImportFilename;
			exec($command,$output=array(),$worked);
          var_dump($worked);
          switch($worked){
    case 0:
        echo 'Import file <b>' .$mysqlImportFilename .'</b> successfully imported to database <b>' .$mysqlDatabaseName .'</b>';
        break;
    case 1:
        echo 'There was an error during import. Please make sure the import file is saved in the same folder as this script and check your values:<br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$db .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$_POST[username] .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$_POST[host] .'</b></td></tr><tr><td>MySQL Import Filename:</td><td><b>' .$mysqlImportFilename .'</b></td></tr></table>';
        break;
}
          
     }
    public static function create_db_config(){
        global $obj;
        if(isset($_POST['btn_create_db'])&&$_POST['btn_create_db']!=""){
            //echo 'Creating Database';
            if(empty($_POST['host'])||empty($_POST['username'])){
                Page_finder::set_message("Unable To perform Request. Please Refill Form",'error.png');
                $url = 'index.php';
                Page_finder::redirect_static($url);
            }else{
                self::fileCreate();
                $url = 'index.php';
                Page_finder::redirect_static($url);
                
            }
            
        }else{
            echo '<body style="background:black;float:left; width:100%;height:100%; ">
                    '.Page_finder::get_message().'
                    <form action="" method="post"  style="margin:0 auto; width:50%;">
                    <h1 style="color:red">Shouldn\'t you Set up your database first.</h1>
                      <table>
                      <tr>
                        <td colspan=""><h2 style="color:red;">Enter Database Credentials</h2></td>
                      </tr>
                        <tr>
                            <td style="color:white;">Enter Hostname</td>
                            <td><input type="text" name="host" /></td>
                        </tr>
                        <tr>
                            <td style="color:white;">Enter Username</td>
                            <td><input ttype="text" name="username" /></td>
                        </tr>
                        <tr>
                            <td style="color:white;">Enter Password</td>
                            <td><input type="text" name="password" /></td>
                        </tr>
                        <tr>
                            <td style="color:white;">Enter Database Name</td>
                            <td><input type="text" name="database" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="btn_create_db" value="Create Database"></td>
                        </tr>
                        
                      </table>
                      </form>
                      </body>';
             self::stop();
        }
        
        
    }
    /*
     * Stop Execution
     */
     public static function stop(){
         die();
     }
}
