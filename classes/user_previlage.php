<?php
class User_Previlage{
    /**
     * List of User previlage
     */
     public $previlage = array();
     /**
     * List of available previlage in array
     */
     public $available = array();
     
     private $dbCon;
     
     private $tempQuery;
     
     /**
      * get all the user access
      * @param user_session_id
      * @return user previlage 
      */
      public function get_all_user_access($user_id){
          global $obj;
          
      }
      /**
      * Instantiate class object
      * @param user_session_id
      * @return user previlage 
      */
      public static function instantiate_prev_obj($userSession_id,&$db){
          $user_prev_obj = new User_Previlage($userSession_id);
          //clone General Function object.
          $user_prev_obj->dbCon = $db;
          $user_prev_obj->get_available_previlage_options();
          return $user_prev_obj;
      }
      /**
       * Gets all the fieldnames in the tbl_user_previlage and stores it in the available array
       * @return NULL
       */ 
      private function get_available_previlage_options(){
          global $setting_options;
          $active_features = $setting_options[site_features];
          foreach($active_features as $val){
              $ids .= $val.",";
          }
          $this->tempQuery = "select feature_name from tbl_features where id IN(".substr($ids,0,-1).")";
          $result = $this->dbCon->exec($this->tempQuery);
          if(mysql_num_rows($result)!=""){
              while($row_prev = $this->dbCon->fetch($result)){
                  $this->available[] = $row_prev['feature_name'];
              }
          }
          
          
          
      }
      /**
       * Check all the active previlage in the tbl_features and generate field in tbl_user_prev
       * @access public
       * @return null
       */
      public function modify_privilage_options(){
          $all_active_result = $this->dbCon->select('tbl_features','*',array('isactive'=>1),null,null,true);
          if($all_active_result->total_data()!=""){
              while($r = $all_active_result->fetch_data()){
                  $str[] = str_replace(" ", "_", strtolower($r->feature_name));
              }
              //Gets all the previlage currently available
              $current_fields = $this->get_all_prev_fields();
              //finds the currently available tables not to be touched
              $no_touch_previlage = array_intersect($str, $current_fields);
              //finds the new previlages which must be added to table
              $add_previlage = array_diff($str, $current_fields);
              //finds the old previlage that must be deleted from table tbl_user_prev
              $delete_previlage = array_diff($current_fields, $str);
              
              //Process to delete all the unwanted previlage
              if(is_array($delete_previlage)){
                  foreach($delete_previlage as $dval){
                      //$del_sql = 'ALTER TABLE tbl_user_prev DROP "'.$dval.'"';
                      $this->dbCon->exec('ALTER TABLE tbl_user_prev DROP '.$dval);
                  }
              }
              //Add all the new Previlages as required
              if(is_array($add_previlage)){
                  foreach($add_previlage as $aval){
                      $this->dbCon->exec("ALTER TABLE tbl_user_prev ADD $aval INT(11)");
                  }
              }
              //$list = implode(',', $str);
              
          }
          
          
      }
      private function get_all_prev_fields(){
          $sql = "show columns from tbl_user_prev";
          $result = mysql_query($sql);
          while($r = $this->dbCon->fetch($result)){
              if(($r[0]!="id")&&($r[0]!='admin_id')){
                  $fields[] = $r[0];
              }
          }
          return $fields;
      }
      
    
}
