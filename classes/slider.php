<?php
class Slider{
    /**
     * Slider limit from  show_tota;
     */
    private $show_total;
    private $dbCon;
    /**
     * constructor create assertion to database object
     * @param database Oject
     * @return none
     */
    public function __construct($db_con){
        $this->dbCon = $db_con;
    }
    /**
     * Function gets all the image resources filter by count in global slider_limit
     * @return array or NULL if nothing found.
     */
    public function get_all(){
        global $setting_options;
        $this->show_total = $setting_options[slider_limit];
        $o = $this->dbCon->select(SLIDER,'*',NULL,array('id'=>'desc'),array(0,$this->show_total), true);
        while($i = $o->fetch_data()){
            $data[] = $i;
            
        }
        return $data;
    }
}
