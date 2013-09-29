<?php 
    class Menu{
        /**
         * available features type 
         * @param array;
         */
        private $available;
        
        /**
         * Previlage array
         */
        private $previlages;
        
        /**
         * dataBase connection
         * @access public
         */
        private $dbCon;
        
        public $test;
        public function __construct($site_features, $previlages, &$database){
            if(!is_array($site_features))
            {
                trigger_error("There are no site Features Available", E_USER_ERROR);
            }else{
                $this->available = $site_features;
            }
            if(!is_array($previlages))
            {
                trigger_error("No Previlage Is Given", E_USER_ERROR);
            }else{
                $this->previlages = $previlages;
            }
            $this->dbCon = $database;
            $this->start_generation();
        }
        private function start_generation(){
            $this->get_all_functions_names();
        }
        
        /**
         * core function that generates the data from tbl_feature database
         * 
         */
        
        private function get_all_functions_names(){
            $st = implode(',',$this->available);
            $sql = 'select * from tbl_features where id IN('.$st.')';
            $result = $this->dbCon->exec($sql);
            if($this->dbCon->count($result)!=""){
                while($row_slider = $this->dbCon->fetch($result)){
                    //$this->test[] = $row_slider['feature_name'];
                    if($this->previlages[str_replace(" ", "_", strtolower($row_slider[feature_name]))]==1||$this->previlages[all]=='yes'){
                        $html .= $this->generate($row_slider['feature_name'], $row_slider['menu_function'], $row_slider['default_link']);
                    }   
                }
            }
            $html .= $this->default_links();
            echo '<ul class="dropdown">'.$html.'</ul>';
            
        }
        /**
         * appends the default links such as change password etc.
         */
        public function default_links(){
            $ret = '<li><a href="index.php?fol=pages&amp;page=changepassword">Change Password</a></li>';
            if($this->previlages[super]=='yes'){
                $ret .= '<li><a href="?page=manage_user">Manage Users</a></li>
                       <li><a href="index.php?fol=pages&amp;page=settings">Settings</a></li>';  
            }
            return $ret;
        }

        /**
         * actual function that calls the functions in the function class
         */
        public function generate($name, $call_function, $default_link){
            if($call_function!=""){
                $main_link = "javascript:void(0)";
                $sub = '<ul class="submenu">'.call_user_func(array($this,$call_function)).'</ul>';
            }else{
                
                $main_link = '?page=manage_'.strtolower($name);
                $sub  = "";
            }
            if($default_link!=''){
                $main_link = $default_link;
            }
            return '<li>
                     <a href="'.$main_link.'">Manage '.ucfirst($name).'</a>'.$sub.'
                  </li>';
        }
/**
     * Get all the articles categories with links for admin menu
     * @return string
     */
    
    public function get_admin_article_menu(){
        $result_cat = $this->dbCon->select('tbl_news_type','*',array('parent_id'=>0));
        if($this->dbCon->count($result_cat)!=""){
            while($row = $this->dbCon->fetch($result_cat)){
                if($row[has_subcat]=='Y'){
                    $getMenu = $this->getSubNews($row['id']);
                }else{
                    $getMenu = '';
                }
                if($getMenu==""){
                    $sendTo = "?fol=pages&amp;page=manage_news&type=".$row['id'];
                }else{
                    $sendTo = "javascript:void(0)";
                }
                $return_html .= '<li><a href="'.$sendTo.'">'.stripslashes($row['category']).$getMenu.'</a></li>';
            }
        }
        return $return_html;
    }
    /**
     * Gets the child of the article menu
     * @access public
     * @param int parentid
     * @return string
     */
    public function getSubNews($parent_id){
        $parent_id = (int)$parent_id;
        $result_check = $this->dbCon->select(NEWS_TYPE,array('has_subcat'),array('id'=>$parent_id));
        $row_check = $this->dbCon->fetch($result_check);
        if($row_check['has_subcat']=='Y'){
               $val = '<ul class="submenu">';
            $result = $this->dbCon->select(NEWS_TYPE,'*',array("parent_id"=>$parent_id));
            if(mysql_num_rows($result)!=""){
                while($row = $this->dbCon->fetch($result)){
                    $val .= '<li><a href="?page=manage_news&type='.$row['id'].'">'.stripslashes($row['category']).'</a></li>';
                }
                
            }
            $val .= '<li><a href="?page=addcategory&type=news&parent_id='.$parent_id.'">Add Category</a></li></ul>';
        }
        
        return $val;
    }
    /**
     * Function generates the resource menu in administrator
     * @access public
     * @return string
     */
    public function get_admin_resource(){
        $r ='';
                    $count = 0;
                    $sql = "Select * from ".RESOURCE_TBL." WHERE `enabled` = 1"; 
                    $result = $this->dbCon->exec($sql);
                    while($row = $this->dbCon->fetch($result)){
                        if($row['url']!=""){
                            $url_offset = $row['url'];
                        }else{
                            $url_offset = '?fol=pages&amp;page=manage_resources';
                        }
                        if($count == 0){
                        ++$count;
                    
                    $r .= '<li style="border-top:none"><a href="'.$url_offset.'&amp;id='.$row['id'].'">'."Manage&nbsp;".$row['category'].'</a></li>';
                    }else{
                    $r .= '<li><a href="'.$url_offset.'&amp;id='.$row['id'].'">Manage&nbsp;'.$row['category'].'</a></li>';
                    }
                    }
               
                return $r;
    }
	public function get_admin_product_menu(){
		$result_product_cat = $this->dbCon->select('tbl_product_cat','*', array('parent_id'=>0), array('id'=>'desc'));
		//$ret = '<ul class="submenu">';
		if(mysql_num_rows($result_product_cat)!=""){
			while($row_product_cat  = $this->dbCon->fetch($result_product_cat)){
				$ret .= '<li><a href="'.(($row_product_cat['has_subcat']=='')?'?page=manage_products&amp;catid='.$row_product_cat[id]:'javascript:void(0)').'">'.$row_product_cat[category].'</a>'.$this->get_product_sub_cat($row_product_cat[id]).'</li>';
			}
		}
		$ret .= '<li><a href="?page=product_tree">Product Tree</a></li><li><a href="?page=addcategory&amp;type=product">Add Product</a></li>
		         ';
		return $ret;
	}
	
	public function get_product_sub_cat($parent_id){
		$result = $this->dbCon->select('tbl_product_cat','*',array('parent_id'=>$parent_id));
		if(mysql_num_rows($result)!=""){
			$ret = '<ul class="submenu">';
			while($row = $this->dbCon->fetch($result)){
				$ret .= '<li><a href="'.(($row[has_subcat]=='')?'?page=manage_products&amp;catid='.$row[id]:'javascript:void(0)').'">'.$row[category].'</a>'.
				(($row[has_subcat]=='Y')?$this->get_product_sub_cat($row[id]):'')
				.'</li>';
			}
			$ret .= '</ul>';
		}
return $ret;
	}
    /**
     * Gets all the Associates categories with links for admin menu
     * @param parent_id for child categories, default NULL
     * @param is_a subcat, default FALSE
     * @access public
     * @return html 
     */
    public function get_admin_associates_menu( $parent_id = NULL, $is_sub = FALSE){
        global $setting_options;
        if($parent_id!=NULL &&$is_sub== TRUE){
            $result_cat = $this->dbCon->select('tbl_staff_cat','*',array('parent_id'=>$parent_id));
        }else{
            $result_cat = $this->dbCon->select('tbl_staff_cat','*',array('parent_id'=>0));
        }
        if(mysql_num_rows($result_cat)!=""){
            if($is_sub==TRUE){
                $return_html = '<ul class="submenu">';
            }
            while($row_cat = $this->dbCon->fetch($result_cat)){
                $return_html .= '<li><a href="?page=manage_staffs&amp;id='.$row_cat['id'].'">'.stripslashes($row_cat['category']).'</a>
                                '.(($row_cat['has_subcat']=='Y')? $this->get_admin_associates_menu($row_cat['id'],true):'').'
                                </li>';
            }
            if($is_sub==TRUE){
                $return_html .= '</ul>';
            }
        }else{
            $return_html=="";
        }
        if($setting_options['allow_category_add_associates']=='y'&&$parent_id==NULL&&$is_sub==FALSE){
            $return_html .= '<li><a href="?page=addcategory&amp;type=staffs" style="color:red;">Add Category</a></li>';
        }
        return $return_html;
    }
/**
 * get admin advertisement menu
 */
    public function get_admin_ad_menu(){
            global $setting_options;
            $result_menu = $this->dbCon->select('tbl_ad_category','*');
            if(mysql_num_rows($result_menu)!=""){
                while($row_menu = $this->dbCon->fetch($result_menu)){
                    $menu_text .= '<li><a href="?page=manage_ad&amp;adCategory='.$row_menu['id'].'" />'.stripslashes($row_menu['category']).'</a></li>';
                }
            }else{
                $menu_text= '';
            }
            if($setting_options['allow_category_add_ad']=='y'){
                $menu_text .= '<li><a href="?page=addcategory&amp;type=ad" style="color:red">Add More category</a></li>';
            }
            return $menu_text;
        
    }
    /**
     * Gets admin pages menu
     */
     public function get_admin_pages_menu(){
        global $setting_options;
        $result_page = $this->dbCon->select('tbl_page',
                                     array('id','pagelabel','has_subpage'),
                                     array('parent_id'=>0));
        if($this->dbCon->count($result_page)!=""){
            while($row_page = $this->dbCon->fetch($result_page)){
                if($row_page['has_subpage']=='y'){
                    $gen_subpage_menu = '';
                    $gen_subpage_menu =  $this->get_admin_subpage_menu($row_page['id']);
                }else{
                    $gen_subpage_menu = '';
                }
                $menu_text .= '<li><a href="?page=manage_page&amp;id='.$row_page['id'].'">'.stripslashes($row_page['pagelabel']).'</a>'.$gen_subpage_menu.'</li>';
            }
            if($setting_options['allow_category_add_pages']=='y'){
                $menu_text .= '<li><a href="?fol=pages&amp;page=manage_page" style="color:#FF0000;">Add New Page</a></li>';
            }
            return $menu_text;
        }else{
            return NULL;
        }
        
    }
    /**
     * Get admin subpage menu
     */
    public function get_admin_subpage_menu($parent_id){
        $result_sub  =   $this->dbCon->select('tbl_page',
                                   array('id','pagelabel','has_subpage','parent_id'),
                                   array('parent_id'=>$parent_id));
        $subpage_text = '<ul class="submenu">';
        if($this->dbCon->count($result_sub)!=""){
            while($row_sub = $this->dbCon->fetch($result_sub)){
                $subpage_text .= '<li><a href="?page=manage_page&amp;id='.stripslashes($row_sub['id']).'">'.stripslashes($row_sub['pagelabel']).'</a></li>';
            }
            $subpage_text .= '<li><a href="?fol=pages&amp;page=manage_ordering&type='.$parent_id.'" style="color:#FF0000;">View Ordering</a></li>';
        }
        $subpage_text .= '<li><a href="?fol=pages&amp;page=manage_page&parent_id='.$parent_id.'" style="color:#FF0000;">Add New Page</a></li>';
        $subpage_text .= '</ul>';
        return $subpage_text;
    }
    }

?>