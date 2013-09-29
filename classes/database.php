<?php  
include("constants.php");
include 'mysql_data_object.php';
include BASE_PATH.'interface/interface.database.php';
class DataBase implements Database_interface
{
     public $connection;
     private $servername;
     private $username;
     private $password;
     private $database;
     private $query_logger = array();
     public $lastQuery;
     function __construct(){
         $this->page_finder = new Page_finder;
         if(!file_exists($_SERVER[DOCUMENT_ROOT].SITE_FOLDER.'globalinc/g_db_config.php')){
             Site_Config::create_db_config();
         }else{
             include_once($_SERVER[DOCUMENT_ROOT].SITE_FOLDER.'globalinc/g_db_config.php');
         }
         $this->servername = $config['host'];
         $this->username = $config['username'];
         $this->password = $config['password'];
         $this->database= $config['database'];
         $this->db_connect();
     }
     /**
      * Checks if the database is empty
      */
     private function is_database_empty(){
         
     }
	 public function db_connect()
	 {
			$this->connection = mysql_connect($this->servername,$this->username,$this->password) or Site_Config::create_db_config();
			$db = mysql_select_db($this->database,$this->connection) or Site_Config::create_db_config() ;
	 }
	function insert()
	{
		$sql = "insert into $this->table_name set ";
		foreach($this->val as $key=>$value)
		{
			$val_arr[] = "$key='".$this->sanitize_quotes($value)."'";
		}
		$sql .= implode(", ",$val_arr);
		//echo $sql."<br>";
		//exit;
		$this->exec($sql);
		return $this->id();
	}
	
	function update()
	{
		$sql = "update $this->table_name set ";
		foreach($this->val as $key=>$value)
		{
			$val_arr[] = "$key='".$this->sanitize_quotes($value)."'";
		}
		$sql .= implode(", ",$val_arr);
		
		foreach($this->cond as $key=>$value)
		{
			$cond_arr[] = "$key='$value'";
		}
		$sql .= " where ".implode(" and ",$cond_arr);
		//echo $sql."<br>";
		//exit;
		$this->exec($sql);
	}
	
	function delete(){
		$sql = "DELETE FROM $this->table_name ";
		foreach($this->cond as $key=>$value)
		{
			$cond_arr[] = "$key='$value'";
		}
		$sql .= " where ".implode(" and ",$cond_arr);
		$this->exec($sql);
	}
    /**
     * Function queries the database
     * @access public
     * @param string,table name
     * @param string|array fields to return default '*'
     * @param array condition (where clause)
     * @param array("order by"=>'assend type')
     * @param array('start','end');
     * @param boolean true to return object 
     * @return mysql_resource|data_object
     */
    public function select($table, $field = '*',$cond = '',$ord = '', $limit = '', $r_object = false){
    //Checks for the fields to query from the database
        if(is_array($field)){
            $field_value = "";
            foreach($field as $val){
                $field_value .= $val.",";
                
            }
            $final_value = substr($field_value, 0, -1);
            $sql = "SELECT $final_value FROM $table";
        }else{
            $sql = "SELECT $field from $table";
        }
        //checks for the condition for the query
        if(is_array($cond)){
            foreach($cond as $key=>$value)
            {
                $key = $this->sanitize_quotes($key);
                $val = $this->sanitize_quotes($value);
                $cond_arr[] = "$key='$value'";
            }
            $sql .= " where ".implode(" and ",$cond_arr);
            
        }
        if(is_array($ord)){
            foreach($ord as $key=>$value)
            {
                $ord_arr[] = "$key $value";
            }
            $sql .= " ORDER BY ".implode(" , ",$ord_arr);
            
        }
        if(is_array($limit)){
            $sql .= " LIMIT ".$limit[0].", ".$limit[1];
        }
        //echo $sql."<br>";
        if($r_object==true){
            return new MySql_Data_Object($this->exec($sql), $this->connection);
        }else{
            return $this->exec($sql);
        }
        
    }
	function exec($sql){
	    $this->lastQuery = $sql;
        $this->query_logger[] = $sql;
        if($queryResult = mysql_query($sql,$this->connection)){
            return $queryResult;
        }else{
            $output = "You Have An Error in &raquo ".$sql."<br /><b>";
            $output .= mysql_error($this->connection).'</b><br>';
            trigger_error($output,E_USER_ERROR);
        }
		
	}
	
	function fetch($result, $fetch_type = NULL){
	    if($fetch_type!=NULL){
	        return mysql_fetch_array($result, $fetch_type);
	    }else{
	        return mysql_fetch_array($result);
	    }
		
	}
	
	function count($result){
		return mysql_num_rows($result);	
		
	}
	function addslashes($str)
	{
		$str = addslashes(trim($str));
		return $str;
	}
	
    public function show_query_log(){
        echo '<script>$(\'.hundred\').show();</script>';
        echo "total Number of queries run:-".count($this->query_logger);
        printArray($this->query_logger);
    }
    
	function id(){
		return mysql_insert_id();	
	}
	function alert($msg, $url)
	{
		echo "<script>alert('$msg');</script>";
		echo !empty($url) ? "<script>window.location='$url';</script>" : "";
	}
	
	function redirect($url)
	{
		//echo "<script>window.location='$url';</script>";
		//header('Location:'.$url);
        $this->page_finder->redirect($url);
	}

	function alert1($msg)
	{
		echo "<script>alert('$msg');</script>";
		echo "<script>window.history.go(-2)</script>";
	}
    
    function get_field_names($tablename){
        if($tablename!=""){
            $sql = "SHOW COLUMNS FROM $tablename";
            $result = $this->exec($sql);
            if(mysql_num_rows($result)!=""){
                while($row = $this->fetch($result)){
                    $fieldnames[] = $row[0];
                }
                return $fieldnames;
            } else{
                return FALSE;
            }
        }else{
            return False;
        }
    }

    public function export_database(){
        //echo $str = "mysqldump -u [$this->username] -p [$this->username] [$this->database] > ../../globalinc/$this->database.sql";
       // $a = exec($str,$op);
       $dumpfile = "../globalinc/datab.sql";
       echo "/usr/bin/mysqldump --opt --host=$this->servername --user=$this->username --password=$this->password $this->database > $dumpfile";
       passthru("c:/wamp/mysql/bin/mysqldump --opt --host=$this->servername --user=$this->username --password=$this->password $this->database > $dumpfile", $r);
       if($r==0){
           echo 'Database Successfully Exported';
       }elseif($r == 1){
           echo 'Database Couldnot Be exported. Please Manually Export the DB';
       }
       
    }
    
    function sanitize_quotes(&$data){
        if(get_magic_quotes_gpc()){
            $data = stripslashes($data);
            $data = mysql_real_escape_string(trim($data));
        }else{
            $data = mysql_real_escape_string(trim($data));
        }
        return $data;
    }
    	
}
?>