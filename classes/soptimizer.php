<?php 
    class Soptimizer{
        public $dbCon;
       /**
        * Return fields for form
        * @param int resource id
        * @param string table_name
        * @return string
        */
        public static function getSEO_fields($res_id=Null,$tbl=NULL){
            if($res_id!=NULL&&$tbl!=NULL){
                $row = self::getSEO_Values($res_id,$tbl);
                if($row!=NULL){
                    $title = htmlentities(stripslashes($row->title));
                    $keyword = htmlentities(stripslashes($row->keywords));
                    $description = htmlentities(stripslashes($row->description));
                }else{
                    $title = "";
                    $keyword = "";
                    $description = "";
                }
                
            }else{
                $title = "";
                $keyword = "";
                $description = "";
            }
            $str = '<tr>
                        <td>Meta Title</td>
                        <td><textarea name="meta_title">'.$title.'</textarea></td>
                    </tr>
                    <tr>
                        <td>Meta Keyword</td>
                        <td><textarea name="meta_keyword">'.$keyword.'</textarea></td>
                    </tr>
                    <tr>
                        <td>Meta Description</td>
                        <td><textarea name="meta_description">'.$description.'</textarea></td>
                    </tr>
                    ';
                    return $str;
        }
        public static function getSEO_Values($res_id, $tbl){
            global $obj;
            $result = $obj->select('tbl_seo','*',array('res_id'=>$res_id,'tbl_name'=>$tbl),null,null,true);
            if($result->total_data()!=""){
                $r = $result->fetch_data($result);
                return $r;
            }else{
                return NULL;
            }
        }
        public static function set_SEO_Values($title,$keyword,$description, $res_id, $table_name){
            global $obj;
            $rid = self::getSEO_Values($res_id, $table_name);
            if($rid==NULL){
                $do = 'insert';
            }else{
                $obj->cond = array('id'=>$rid->id);
                $do ="update";
            }
            $obj->table_name = 'tbl_seo';
            $obj->val = array('title'=>$title,'keywords'=>$keyword,'description'=>$description,'tbl_name'=>$table_name,'res_id'=>$res_id);
            $obj->$do();
            //echo $obj->lastQuery;
            
        }
    }
?>