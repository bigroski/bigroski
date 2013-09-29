<?php
class Pagination{
    /**
     * Number of data per Page
     */
    public $perPage = 20;
    /**
     * Page Number
     */
    public $pageNum;
    /**
     * query to the database
     */
    public $query;
    
    /*Total number of data*/
    public $total_data; 
    
    /*page limit*/
    public $page_link_limit = 3;
    
    public $total_page;
    
    public $firstpage;
    
    public $lastpage;
    
    public $query_string_enabled = false;
    
    public $url;
    
    /**
     * Navigation Type supported values are symbols, words
     */
    public $navigation_type = "symbols";
    
    public $pagination_block_container;
    
    public $pagination_anchor_container;
    
    public $elog;
    
    public $page_selected_class = 'page_selected';
    /**
     * Returns a pagination Object, Mysql_Resource_object under $object_name->resource_body, 
     * the resource body can be used as while($o = $object_name->resource_body->fetch_data()){ //do process here };
     */
    
    public function __construct($link=null, $otherConfig = null){
        //$this->query = $config;
        if(isset($_GET[page_no])&&$_GET[page_no]!=""){
                $this->pageNum = (int)$_GET[page_no];
            }else{
                $this->pageNum = 1;
            }
        
        $this->url = $link;
        if(isset($link)&&$link!=null){
            if(strstr($link, '?'))
            $this->query_string_enabled = 'true';
            
        }
        
        if(is_array($otherConfig)&&count($otherConfig)!=""){
            foreach($otherConfig as $k => $v){
                $allvars = get_class_vars(get_class($this));
                if(array_key_exists($k, $allvars)){
                    $this->$k = $v;
                }
            }
        }
        
        $this->generate_page_values();
    }
    
    public function generate_page_values(){
        $this->count_total();
        $this->find_total_pages();
        $this->data_object_with_limit();
    }
    
    /**
     * same as count_total but generates a data object using limit
     */
     public function data_object_with_limit(){
         global $obj;
         if(is_array($this->query)){
             $this->resource_body = $obj->select($this->query[0],
                                    $this->query[1],
                                    $this->query[2], 
                                    $this->query[3],
                                    array(($this->pageNum-1)*$this->perPage, $this->perPage),
                                    true);
                                    
         }else{
             
             $this->resource_body = new MySql_Data_Object($obj->exec($this->query.' limit '.($this->pageNum-1)*$this->perPage.','.$this->perPage), $obj->connection);
         }
         
         $this->generate_pagination_nav();
         
     }
     
     /**
      * generates the pagination navigation
      */
      public function generate_pagination_nav(){
          if($this->query_string_enabled==true){
              $url = $this->url.'&amp;';
          }else{
              $url = $this->url.'?';
          }
          $this->find_offset_pages();
          for($i = $this->firstpage; $i<=$this->lastpage; $i++){
              $this->pagination_link .= '<a href="'.$url.'page_no='.$i.'" '.(($this->pageNum==$i)?' class="'.$this->page_selected_class.'"':'').'>'.$i.'</a>&nbsp;';
          }
          $this->bind_pagination();
      }
    
    /**
     * Sets the offset pages and set to $firstpage & $lastpage
     * 
     */
     
     private function find_offset_pages(){
         if($this->total_page < $this->page_link_limit){
             $this->firstpage = 1;
             $this->lastpage = $this->total_page;
         }else{
             //$this->elog = ceil($this -> page_link_limit/2) - 1;
             $this->firstpage = $this->pageNum - (ceil($this -> page_link_limit/2)-1);
             $this->elog = ceil($this -> page_link_limit/2)-1;
             $this->lastpage = $this->pageNum + ceil($this-> page_link_limit/2) - 1;
             if($this->lastpage > $this->total_page){
                 
                 $this->lastpage = $this->total_page;
             }
             if($this->lastpage == $this->total_page){
                 $this->firstpage = $this->lastpage-ceil($this-> page_link_limit/2);
             }
             if($this->firstpage <= 0 ){
                 
                 $this->firstpage = 1;
                 $this->lastpage = $this->firstpage+ceil($this-> page_link_limit/2);
             }
         }
         
     }
     
    /**
     * bind pagination appends the first and last page anchors to Pagination Link
     */
    
    public function bind_pagination(){
        if($this->query_string_enabled==true){
              $url = $this->url.'&amp;';
          }else{
              $url = $this->url.'?';
          }
          if($this->navigation_type=='words'){
              $first = 'First';
              $prev = "Prev";
              $next = "Next";
              $last = "Last";
          }else{
              $first = '&laquo;';
              $prev = "&lsaquo;";
              $next = "&rsaquo;";
              $last = "&raquo;";
          }
        if($this->firstpage!=1){
            $append_before = '<a href="'.$this->url.'">'.$first.'</a>&nbsp;<a href="'.$url.'page_no='.($this->pageNum-1).'">'.$prev.'</a>&nbsp';
        }else{
            $append_before = '';
        }
        if($this->lastpage!=$this->total_page){
            $append_after = '<a href="'.$url.'page_no='.($this->pageNum+1).'">'.$next.'</a>&nbsp;<a href="'.$url.'page_no='.($this->total_page).'">'.$last.'</a>';
        }else{
            $append_after = '';
        }
        if($this->pagination_link!=""){
            $this->pagination_link = $append_before.$this->pagination_link.$append_after;
        }
        
    }
    
    /**
     * finds the total number of pages required from the total
     */
     
     
    public function find_total_pages(){
        $this->total_page = ceil($this->total_data/$this->perPage);
    }
    /**
     * Counts the total numbers of rows excluding limit
     * 
     */    
    public function count_total(){
        global $obj;
        if(is_array($this->query)){
            $result_obj = $obj->select($this->query[0],$this->query[1],$this->query[2], $this->query[3],null,true);
        }else{
             $result_obj = new MySql_Data_Object($obj->exec($this->query), $obj->connection);
        }
        
        
        $this->total_data = $result_obj->total_data();
    }
    
    public function get_all_values(){
        $vals = get_class_vars(get_class($this));
        printArray($vals);
    }
    
}
