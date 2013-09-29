<?php 
include BASE_PATH.'interface/interface.dataobject.php';
class MySql_Data_Object implements Database_Result_Object{
    public $db_con;
    public $db_res;
    public $cur_resource;
    public $key;
    public $valid;
    
    public function __construct($db_resource, $connection){
        $this->db_res = $db_resource;
        $this->db_con = $connection;
    }
    
    /**
     * Return total number of mysql resource selected;
     * @access public
     * @return int
     */
    public function total_data(){
        
        return mysql_num_rows($this->db_res);
        
    }
    /**
     * Return one row at a time
     * @access public
     * @return array;
     */
    public function fetch_data(){
        
        if($this->total_data()!=""){
            
            if($this->cur_resource = mysql_fetch_array($this->db_res, MYSQL_ASSOC)){
                
                $this->valid = true;
                
                $this->key += 1;
                
                return new ArrayToObject($this->cur_resource);
                
            } else {
                
                return null;
                
                
            }
        }else{
         
            return null;
        }
        
    }
    
    
}
