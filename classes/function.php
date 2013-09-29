<?php  
include_once("database.php");

class Functions extends DataBase
{
	function __construct(){
	     parent::__construct();
         
	}
    
    public function get_site_features($filter=false){
        if($filter==true){
            $result = $this->select('tbl_features',array('id','feature_name'),array('isactive'=>1));
        }else{
            $result = $this->select('tbl_features','*');
        }
        
        if($this->count($result)!=""){
            while($row = $this->fetch($result)){
                if($filter==true){
                    $data[] = $row['id'];
                }else{
                    $data[] = $row;
                }
                
            }
            return $data;
        }else{
            return NULL;
        }
    }
    /**
     * Fetches associates category by id
     * 
     */
     public function get_associate_category($category_id = NULL){
         if($category_id!=NULL){
             $result = $this->select('tbl_staff_cat','*',array('id'=>$this->sanitize_quotes($category_id)));
             if($this->count($result)!=""){
                 $row = $this->fetch($result);
                 return $row;
             }else{
                 return null;
             }
         }else{
             //fetch all the categories
         }
     }
    
    
    
    
    
    
    
    public function getThumbs($image_name, $width="100", $height = "100"){
        $splitted = explode('.', $image_name);
        return $splitted[0]."_{$width}X{$height}.".$splitted[1];
        
    }
	
    /**
     * Traveses through the categories and subcategories and return the list in String format
     * @access public
     * @return string
     */
     public function travese_categories($table, $id, $is_parent = FALSE){
             $result = $this->select($table,'*',array('id'=>$id));
         if($this->count($result)!=""){
             $row = $this->fetch($result);
                 if($row['has_subcat']=='Y'){
                     $ids .= $this -> traverse_sub_categories($table, $id);
                 }else{
                     $ids .= $row['id'];
                 }
             
         }
         return $ids;
     }
    
    public function traverse_sub_categories($table, $id){
        $result = $this->select($table,'*',array('parent_id'=>$id));
        if($this->count($result)!=""){
            while($row = $this->fetch($result)){
                if($row['has_subcat']=='Y'){
                    $ids .= $this->traverse_sub_categories($table, $row['id']);
                }else{
                    $ids.= $row['id'].',';
                }
                
            }
        }
        return $ids;
    }
    
    /**
     * returns array with the latest articles/most read if first arguement is true
     * @param true|false detault false
     * @return array|null
     */
    public function get_latest_news_data($filter_most = false){
        if($filter_most == false){
            $result_all = $this->select('tbl_news', '*', NULL, array('posted_on'=>'desc','id'=>'desc'), array(0,10));
            if(mysql_num_rows($result_all)!= "" ){
                while($row = $this->fetch($result_all)){
                    $data[] = $row;
                }
                return $data;
            }else{
                return null;
            }
        }else{
            $filter_most_read = $this->select('tbl_visits', '*', array('type'=>'article'),array('visits'=>'desc'));
            if(mysql_num_rows($filter_most_read)!=""){
                while($row_most_read = $this->fetch($filter_most_read)){
                    $news_id = $row_most_read[res_id];
                    $article[] = $this->getArticle($news_id);
                }
                return $article;
            }else{
                return null;
            }
        }
        
        
    }
    
    
    
    public function find_category_titles($table_name,$array_ids){
        if(is_array($array_ids)){
            foreach($array_ids as $key => $val){
                $result= $this->select($table_name, '*', array('id'=> $val));
                if($this->count($result)!=""){
                    $titles = $this->fetch($result, MYSQL_ASSOC);
                    $title_ar[$titles['id']] = $titles['category'];
                }
            }
            return $title_ar;
        }else{
            throw new Exception('Un supported id format');
        }
        
    }
    //Article Section
    /**
     * Function finds a single article by article id
     * @param newsid
     * @param true|false if needed to increase counter set to true, default false
     * @return array|false
     */
    public function getArticle($id, $increase_counter = false){
        $id = $this->sanitize_quotes($id);
        $result = $this->select(NEWS_TBL,'*',array("id"=>$id));
        if($this->count($result)!=""){
            if($increase_counter==true){
                $this->increase_visits($id, 'article');
            }
            return $this->fetch($result);
        }else{
            return false;
        }
    }
    
    public function increase_visits($res_id, $type){
        $find_count = $this->select('tbl_visits','*',array('res_id'=>$res_id,'type'=>$type));
        if(mysql_num_rows($find_count)!=""){
            $found = $this->fetch($find_count);
            $this->table_name = 'tbl_visits';
            $this->val = array('visits'=>$found['visits']+1);
            $this->cond = array('res_id'=>$res_id,'type'=>$type);
            $this->update();
        }else{
            $this->table_name = 'tbl_visits';
            $this->val = array('res_id'=>$res_id,'type'=>$type,'visits'=>1);
            $this->insert();
        }
    }
    /**
     * function delivers the article type
     * @param category_id|false if false delivers all primary news category
     * @return array
     */
    public function getNewsCat($type=FALSE){
        if($type!=FALSE){
            $type = (int)$this->sanitize_quotes($type);
            $result = $this->select(NEWS_TYPE,'*',array('id'=>$type));
            if($this->count($result)!=""){
                return $this->fetch($result);
            }else{
                throw new Exception("The Requested Category does Not Exists Or Has Been Moved", 1);
            }
        }else{
            $result = $this->select(NEWS_TYPE,array('id','category'),array('has_subcat'=>''));
            if(mysql_num_rows($result)!=""){
                while($row_cat = $this->fetch($result)){
                    $row[]= $row_cat;
                }
                return $row;
            }else{
                throw new Exception("No Categories Found", 1);
            }
        }
        
    }
    
    //article Section End
    public function get_header_image(){
        $result_header = $this->select('tbl_site_settings','*',array('options'=>'banner'));
       // echo $this->lastQuery;
        $row_header_image = $this->fetch($result_header);
        if($row_header_image!=""){
            $image_name = '../uploads/banner/'.$row_header_image['option_values'];
        }else{
            $image_name = "images/itech-banner.png";
        }
        echo '<img src="'.$image_name.'" alt="i-tech Cms" id="banner_image"  />';
    }
     static function get_page_label(){
         global $obj;
         
             $result_page = $obj->select('tbl_page',
                                     array('id','pagelabel','parent_id','has_subpage'));
         
         
         if($obj->count($result_page)!=""){
             $count = '0';
             while($row = $obj->fetch($result_page)){
                 $ret_val[$count]['id'] = $row['id'];
                 $ret_val[$count]['title'] = $row['pagelabel'];
                 if($row['has_subpage']=='y'){
                     $ret_val[$count]['child'] = self::get_subpage_label($row['id']);
                 }
                 ++$count;
             }
             
         }else{
             $ret_val['error'] = '404';
         }
        //$obj->printArray($ret_val);
        echo $json_encoded =  json_encode($ret_val);
        
    }
    
    static function get_subpage_label($parent_id){
        global $obj;
        $result_page = $obj->select('tbl_page',
                                     array('id','pagelabel','parent_id','has_subpage'),
                                     array('parent_id'=>$parent_id));
        if( $obj -> count($result_page) != ""){
            while($row = $obj->fetch($result_page)){
                $subpage[] = $row;
            }
            return $subpage;
        }
    }
	
	static function get_products_category(){
		
	}
     static function get_articles_category(){
         global $obj;
         $result_category = $obj->select('tbl_news_type',
                                         '*',array('parent_id'=>0));
         if( $obj->count ($result_category) != '' ){
             $count = 0;
             while($row = $obj->fetch($result_category)){
                  $ret_val[$count]['id'] = $row['id'];
                  $ret_val[$count]['title'] = $row['category'];
                  if($row['has_subcat']=='Y'){
                     $ret_val[$count]['child'] = self::get_subcat_label($row['id']);
                 }
                 ++$count;
                
             }
         }else{
             $ret_val['error'] = '404';
         }
        //echo 'inside get the articles here';
        echo $json_encoded =  json_encode($ret_val);
    }
     static function get_subcat_label($parent_id){
        global $obj;
        $result_page = $obj->select('tbl_news_type',
                                     '*',
                                     array('parent_id'=>$parent_id));
        if( $obj -> count($result_page) != ""){
            while($row = $obj->fetch($result_page)){
                $subpage[] = $row;
            }
            return $subpage;
        }
    }
    
     static function get_member_category(){
         global $obj;
         $result_category = $obj->select('tbl_staff_cat',
                                         '*',array('parent_id'=>0));
         if( $obj->count ($result_category) != '' ){
             $count = 0;
             while($row = $obj->fetch($result_category)){
                  $ret_val[$count]['id'] = $row['id'];
                  $ret_val[$count]['title'] = $row['category'];
                  if($row['has_subcat']=='Y'){
                     $ret_val[$count]['child'] = self::get_subcat_staff($row['id']);
                 }
                 ++$count;
                
             }
         }else{
             $ret_val['error'] = '404';
         }
        //echo 'inside get the articles here';
        echo $json_encoded =  json_encode($ret_val);
    }
     static function get_ad_category(){
         global $obj;
         $result_category = $obj->select('tbl_ad_category','*');
         if(mysql_num_rows($result_category)!=""){
             $count = 0;
             while($row = $obj->fetch($result_category)){
                 $ret_val[$count]['id'] = $row['id'];
                 $ret_val[$count]['title'] = htmlentities(stripslashes($row['category']));
                 ++$count;
             }
         }else{
             $ret_val['error'] = '404';
         }
         echo $json_encoded = json_encode($ret_val);
     }
     static function get_subcat_staff($parent_id){
         global $obj;
        $result_page = $obj->select('tbl_staff_cat',
                                     '*',
                                     array('parent_id'=>$parent_id));
        if( $obj -> count($result_page) != ""){
            while($row = $obj->fetch($result_page)){
                $subpage[] = $row;
            }
            return $subpage;
        }
     }
    
    public function image_process(){
        if($_FILES['image']['error']==0){
            $config['directory'] = '../uploads/pages/';
            $config['thumb_width'] = DEFAULT_THUMB_WIDTH;
            $config['thumb_height'] = DEFAULT_THUMB_HEIGHT;
            $image_obj  =  ImageManipulation::generateClass($config);
            $imageResult = $image_obj  ->  upload_image($_FILES['image']);
        
        }else{
                $imageResult = "";
        }
        return $imageResult;
    }
    
    public function get_deletable_content($table_name, $id){
        $result = $this->select($table_name,'*',array('id'=>$id));
        if(mysql_num_rows($result)!=""){
            return $this->fetch($result);
        }
    }
    
    
    public function get_setting_options(){
        $result_option = $this->select('tbl_site_settings','*');
        if(mysql_num_rows($result_option)!=""){
            while($row = $this->fetch($result_option)){
                $option[$row[1]] = $row[2];
            }
            $option['site_features'] = $this->get_site_features(true);
            return $option;
        }else{
            return NULL;
        }
    }
    
    public function get_option_id($option_name){
        $result_option = $this->select('tbl_site_settings',array('id'),array('options'=>$this->sanitize_quotes($option_name)));
        if(mysql_num_rows($result_option)!=""){
            $row_option = $this->fetch($result_option);
            return $row_option['id'];
        }else{
            return false;
        }
        
    }
    public function generate_file_upload_script($name,$value){
        $ret_val = '<label><input type="radio" name="'.$name.'" value="y" {repyes}/>Yes</label>
                        <label><input type="radio" name="'.$name.'" value="n" {repno}/>No</label>';
        $search_yes = '{repyes}';
        $search_no = '{repno}';
        if($value == 'y'){
            $replace_yes = ' checked="checked"';
            $replace_no = ' blank';
        }else{
            $replace_yes = ' blank';
            $replace_no = ' checked="checked"';
            
        }
        $filtered = str_replace($search_yes, $replace_yes, $ret_val);
        $filtered = str_replace($search_no, $replace_no, $filtered);
        return $filtered;
        
    }
    
    public function checkPrevilage($userId){
    if($userId == 1){
        $prevArray['all'] = 'yes';
        $prevArray['super'] = 'yes';
    }elseif($userId == 2){
        $prevArray['all'] = 'yes';
    }else{
        $sql ="select * from tbl_admin where id = $userId ";
        $result = $this->exec($sql);
        if(mysql_num_rows($result)!=""){
            $rowUser = $this->fetch($result);
            $tblUserId = $userId;
            $resultPrev = $this->select("tbl_user_prev",
                                '*',
                                array("admin_id"=>$tblUserId));
                             
            if(mysql_num_rows($resultPrev)!=""){
                $rowPrev = $this->fetch($resultPrev, MYSQL_ASSOC);
                foreach($rowPrev as $key=>$val){
                    $prevArray[$key] = $val;
                }
            }else{
                //$this->redirect("?page=logout");
                
            }
            
        }    
    }    
    
    return $prevArray;
}

function Programdetails($day)
    {
     
        //echo "select * from tbl_program where day = '$day' order by start_time";
         return $this->exec("select * from tbl_program where day = '$day' order by start_time");
        
    }
    function currentprogram(){
        //      global $ado;
        $day = date("l");
        $current_time = date('H:i:s');
        $sql = "SELECT * FROM tbl_program WHERE day = '$day' AND '$current_time' BETWEEN start_time and end_time";
        $result = $this->exec($sql);
        return $this->fetch($result);
    }
    function next_program(){
                //global $ado;
        $day = date("l");
         $current_time = date('H:i:s');
        //$sql = "SELECT * FROM tbl_program WHERE day= '$day' and '$current_time'>= start_time";
         $sql ="SELECT * FROM tbl_program WHERE DAY = '$day' AND '$current_time' <= start_time ORDER BY start_time LIMIT 0 , 1 ";
         $result = $this->exec($sql);
        return $this->fetch($result);
    }
    
    public function find_other_programs($programId=null){
        
        $day = date("l");
        $current_time = date('H:i:s');
        //$sql = "SELECT * FROM tbl_program WHERE day= '$day' and '$current_time'>= start_time";
         $sql ="SELECT * FROM tbl_program WHERE DAY = '$day' AND start_time >=  '$current_time'   ORDER BY start_time LIMIT 0 , 6 ";
         $result = $this->exec($sql);
         
         if(mysql_num_rows($result)!=""){
             while($row = $this->fetch($result)){
                 $program_array[] = $row;
             }
             return $program_array;
         }else{
             return FALSE;
         }
        //return $this->fetch($result);
    }
    function changetime($starttime)
    {
    $start = explode(":",$starttime);
    if($start[0]>=12 && $start[0]<24)
        {
           // $anc = "pm";
        if($start[0]>12){
            $start[0]= $start[0]-12;}
        }else
        {
            //$anc = "am";
        }
    
        $time = $start[0].":".$start[1]."&nbsp;".$anc;
        return $time;
    
    
    }
    public function scrollingNews(){
        $result = $this->select(NEWS_TBL,
                                array('id','title'),
                                array("headline"=>1),
                                array('posted_on'=>"desc","updated_on"=>"desc"),
                                array(0,10));
        if($this->count($result)){
            while($row = $this->fetch($result)){
                $displayed[] = $row['id'];
                echo '<a href="news-details.php?news='.$row['id'].'">'.stripslashes($row['title']).'</a> |';
            }
        }
    }
    public function findMain(){
        $result = $this->select(NEWS_TBL,
                                array('id','title','shortdesc','image','DATE_FORMAT( posted_on, \'%Y %M %d\') as fdate'),
                                array('highlight'=>1),
                                array('posted_on'=>'desc','updated_on'=>'desc'),
                                array(0,1));
         if($this->count($result)){
             return $this->fetch($result);
         }else{
             return FALSE;
         }
    }
//-----------Delete info----------
	function getDelInfo($table,$id){
		 $sql = "SELECT * FROM $table where id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);

	}
	function getDelInfo1($table,$id){
		 $sql = "SELECT * FROM $table where r_id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);

	}
	function ImgDelInfo($id){
		$sql = "SELECT image from".IMAGE_TBL."WHERE type = $id";
		return $this->exec($sql);
	}

//--------------------Page Section
	function getpage($id){
		$sql = "SELECT * FROM".MAIN_PAGE ." WHERE id = $id";
		$result = $this->exec($sql) or die (mysql_error());
		return $this->fetch($result);	
	}
	
	function getSubPage($id){
		$sql = "SELECT * FROM".SUB_PAGE." WHERE id = $id";
		$result = $this->exec($sql) or die (mysql_error());
		return $this->fetch($result);	
	}
	function getAllSubPage($id){
		$sql = "SELECT * FROM".SUB_PAGE." WHERE type = $id";
		return $this->exec($sql);
	
	}

//---------------------News and Events Section-------------------
    
	function getNewsType($id){
		$sql = "SELECT * FROM".NEWS_TYPE;
		if($id!=""){
			$sql .=" WHERE id = $id";
		}
		$result = $this->exec($sql);
        if($this->count($result)!=""){
            return $row = $this->fetch($result);
        }else{
            return FALSE;
        }

	}
    function getStaffType($id){
        $sql = "SELECT * FROM".STAFF_CAT."WHERE id = $id";
        $result = $this->exec($sql);
        return $this->fetch($result);
    }
    public function relatedNews($newsType, $visible){
        $sql = "SELECT id, title, shortdesc FROM tbl_news where type = $newsType and id != $visible order by posted_on desc, updated_on desc limit 0 , 10";
        $result = $this->exec($sql);
        if(mysql_num_rows($result)!=""){
            echo '<ul>';
            while($row = $this->fetch($result)){
                echo '<li class="popuplink">
        <a href="news-details.php?nid='.$row['id'].'" class="popuplink">'.stripslashes($row['title']).'</a>

        <div class="popupcontent">
            <div class="newscontent">
                '.$this->filterWords(stripslashes($row['shortdesc']),15).'
            </div>
        </div>

    </li>';
            }
            echo '</ul>';
        }else{
            return FALSE;
        }
    }
public function otherVideo($visible){
        $sql = "SELECT * FROM tbl_resource where type = 5 and r_id != $visible order by date desc limit 0 , 10";
        $result = $this->exec($sql);
        if(mysql_num_rows($result)!=""){
            
            while($row = $this->fetch($result)){
                $image = video_url($row['url']);
                echo '<div class="img_box">
                                    <div class="img">
                                        <a href="video.php?vid='.$row['r_id'].'"><img src="'.$image.'" alt="" border="0" title="View Album" /></a>
                                    </div>
                                    
                                    <div class="img_text">
                                        <a href="video.php?vid='.$row['r_id'].'">'.$row['title'].'</a>
                                    </div>
                                  
                                </div>';
                
            }
            
        }else{
            return FALSE;
        }
    }

	
	public function filterShine($shine){
	    $exploded = explode('(', $shine);
        return implode('<br />(', $exploded);
	}
	
//---------------------------Resource Section----------------
	function getResourceType($id=FALSE){
	    if($id!=FALSE){
	        $sql = "SELECT * FROM".RESOURCE_TBL."WHERE id = $id";
            $result = $this->exec($sql);
            return $this->fetch($result);
	    }
            $sql = "SELECT * FROM".RESOURCE_TBL;
            $result = $this->exec($sql);
            if(mysql_num_rows($result)){
                while($row = $this->fetch($result)){
                    $row_c[] = $row;
                }
                return $row_c;
            }
		
	}
	function getAllResources($id){
		$sql = "SELECT * FROM".RESOURCE."WHERE type = $id";
		return $this->exec($sql);
		
	} 
	function getSomeResources($id,$max){
		$sql = "SELECT * FROM".RESOURCE."WHERE type = $id order by rand() limit 0, $max";
		return $this->exec($sql);
		
	} 
	function getResource($id){
		$sql = "SELECT * FROM".RESOURCE."WHERE r_id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);
	}
//-----------------Slider and Advertisement Section
	function getSlider($id){
		$sql = "SELECT * FROM".SLIDER."WHERE id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);
	}
	function getAllSlider(){
		$sql = "SELECT * FROM".SLIDER;
		return $this->exec($sql);
	//	return $this->fetch($result);
	}
	function getAd($id){
		$sql = "SELECT * FROM".ADVERTISEMENT."WHERE id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);
	}
	function getAllAd(){
		$sql = "SELECT * FROM".ADVERTISEMENT." where display = 1 order by position ";
		return $this->exec($sql);
	//	return $this->fetch($result);
	
	}

    

//------------------Image Content
	function getImgContent($id){
		$sql = "SELECT * FROM".IMAGE_TBL."WHERE id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);
	}
	
	function getAllImg($id){
		$sql = "SELECT * FROM".IMAGE_TBL."WHERE type = $id";
		return  $this->exec($sql);
		//return $this->fetch($result);
	}

//-----------------image functions-------------
	function UploadImage($temp_name, $ext, $img_name, $uploaddir)
	{
		if(is_uploaded_file($temp_name))
		{
			@move_uploaded_file($temp_name,$uploaddir.$img_name);
		}		 
		//if(file_exists($uploaddir.$img_name))
				//$this->CreateBigThumb($img_name,$ext,$uploaddir,$uploaddir,600,600);
					
	}
function checkQuery($val){
    $pattern = '/^[0-9]*$/';
            if(!preg_match($pattern,$val)){
            $this->redirect("index.php");
    
    }else{
        return;
    }   

}

	function CreateThumb($img_name,$ext,$src_location,$dest_location,$new_w,$new_h)
	{	
		$name = $src_location.$img_name;
		$filename = $dest_location.$img_name;
		switch($ext)
		{
			case "jpg" :
				$src_img = @imagecreatefromjpeg($name);
				break;
			case "gif" :
				$src_img = @imagecreatefromgif($name);
				break;
			case "png" :
				$src_img = @imagecreatefrompng($name);
				break;			
			default :
				$src_img = @imagecreatefromjpeg($name);
		}
	
		$old_x = imagesx($src_img);
		$old_y = imagesy($src_img);
				
		$thumb_w = $new_w; 
		$thumb_h = $new_h; 
		$dst_img = @imagecreatetruecolor($thumb_w, $thumb_h);
		@imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
		switch($ext)
		{
			case "jpg" :
				@imagejpeg($dst_img, $filename);
				break;
			case "gif" :
				@imagegif($dst_img, $filename);
				break;
			case "png" :
				@imagepng($dst_img, $filename);
				break;
			default :
				@imagejpeg($dst_img, $filename);
		}		
		@imagedestroy($dst_img); 
		@imagedestroy($src_img); 
	}
//------------for pageing

function PageMe($url, $order, $perpage, $sql, $class, $p)
	{
		$cnt = $this->count($this->exec($sql));
		if($cnt > 0)
		{
			//resultset
			$pageNum = !empty($p) ? $p : 1;
			$pageNum = $pageNum < 1 ? 1 : $pageNum;
			$maxPage = ceil($cnt/$perpage);
			$pageNum = $pageNum > $maxPage ? $maxPage : $pageNum;
			$offset = ($pageNum - 1) * $perpage;
			$sql .= !empty($order) ? " ".$order : "";
			$sql = $sql." LIMIT $offset, $perpage ";
			$res = $this->exec($sql);
			
			//link set	
			$aend = "";
			$pageStart = ($pageNum >5) ? $pageNum -5 : 1;
			$pageEnd = ($pageNum > ($maxPage -5)) ? $maxPage : $pageNum +5;
			if ($pageNum > 1)
			{
				$page = 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">First</a>";
				$page = $pageNum - 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">Previous</a>";
			}
			
			($pageNum > 6) ? $nav[] = " ... " : "";
			
			for($page = $pageStart; $page <= $pageEnd; $page++)
			{
				$nav[] = ($page == $pageNum) ? "<strong> $page</strong>" : "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">".$page."</a>";				
			}
			
			($pageNum > ($maxPage - 6)) ? "" : $nav[] = " ... ";
								
			if ($pageNum < $maxPage)
			{
				$page = $pageNum + 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">Next</a>";
				$page = $maxPage;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">Last</a>";
			}
			
			$ref = array($offset + 1, $offset + $perpage, $cnt);
			
			return array($res, $nav, $ref);
		}
		else
			return;
	}

 function PageMe1($url, $order, $perpage, $sql, $class, $p)
	{
		$cnt = $this->count($this->exec($sql));
		if($cnt > 0)
		{
			//resultset
			$pageNum = !empty($p) ? $p : 1;
			$pageNum = $pageNum < 1 ? 1 : $pageNum;
			$maxPage = ceil($cnt/$perpage);
			$pageNum = $pageNum > $maxPage ? $maxPage : $pageNum;
			$offset = ($pageNum - 1) * $perpage;
			$sql .= !empty($order) ? " ".$order : "";
			$sql = $sql." LIMIT $offset, $perpage ";
			$res = $this->exec($sql);

			//link set
			$aend = "";
			$pageStart = ($pageNum >5) ? $pageNum -5 : 1;
			$pageEnd = ($pageNum > ($maxPage -5)) ? $maxPage : $pageNum +5;
			if ($pageNum > 1)
			{
				$page = 1;
				$nav[] = "<a href=\"$url?per=$perpage&p=$page/\" class=\"$class\">&laquo;</a>";
				$page = $pageNum - 1;
				$nav[] = "<a href=\"$url?per=$perpage&p=$page/\" class=\"$class\">&lsaquo;</a>";
			}

			($pageNum > 6) ? $nav[] = " ... " : "";

			for($page = $pageStart; $page <= $pageEnd; $page++)
			{
				$nav[] = ($page == $pageNum) ? "<strong class='select'> $page</strong>" : "<a href=\"$url?per=$perpage&p=$page/\" class=\"$class\">".$page."</a>";
			}

			($pageNum > ($maxPage - 6)) ? "" : $nav[] = " ... ";

			if ($pageNum < $maxPage)
			{
				$page = $pageNum + 1;
				$nav[] = "<a href=\"$url?per=$perpage&p=$page/\" class=\"$class\">&rsaquo;</a>";
				$page = $maxPage;
				$nav[] = "<a href=\"$url?per=$perpage&p=$page/\" class=\"$class\">&raquo;</a>";
			}

			$ref = array($offset + 1, $offset + $perpage, $cnt);

			return array($res, $nav, $ref);
		}
		else
			return;
	}

 function PageMe2($url, $order, $perpage, $sql, $class, $p)
	{
		$cnt = $this->count($this->exec($sql));
		if($cnt > 0)
		{
			//resultset
			$pageNum = !empty($p) ? $p : 1;
			$pageNum = $pageNum < 1 ? 1 : $pageNum;
			$maxPage = ceil($cnt/$perpage);
			$pageNum = $pageNum > $maxPage ? $maxPage : $pageNum;
			$offset = ($pageNum - 1) * $perpage;
			$sql .= !empty($order) ? " ".$order : "";
			$sql = $sql." LIMIT $offset, $perpage ";
			$res = $this->exec($sql);

			//link set
			$aend = "";
			$pageStart = ($pageNum >5) ? $pageNum -5 : 1;
			$pageEnd = ($pageNum > ($maxPage -5)) ? $maxPage : $pageNum +5;
			if ($pageNum > 1)
			{
				$page = 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">&laquo;</a>";
				$page = $pageNum - 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">&lsaquo;</a>";
			}

			($pageNum > 6) ? $nav[] = " ... " : "";

			for($page = $pageStart; $page <= $pageEnd; $page++)
			{
				$nav[] = ($page == $pageNum) ? "<strong> $page</strong>" : "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">".$page."</a>";
			}

			($pageNum > ($maxPage - 6)) ? "" : $nav[] = " ... ";

			if ($pageNum < $maxPage)
			{
				$page = $pageNum + 1;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">&rsaquo;</a>";
				$page = $maxPage;
				$nav[] = "<a href=\"$url&per=$perpage&p=$page/\" class=\"$class\">&raquo;</a>";
			}

			$ref = array($offset + 1, $offset + $perpage, $cnt);

			return array($res, $nav, $ref);
		}
		else
			return;
	}
//----------------check email
function checkAdminEmail($id,$old){
	$sql = "SELECT * FROM tbl_admin where id = $id AND email = '$old'";
	return $this->exec($sql);
}
function checkemail($email){
	$sql = "SELECT * FROM tbl_admin where email = '$email'";
	return $this->exec($sql);
}
function getImage($id){
	$sql = "select image from tbl_images where id = $id";
	$result = $this->exec($sql);
	return $this->fetch($result);
	}
	
 
	

function getPartner($id){
		$sql = "SELECT * FROM".PARTNER_TBL."WHERE id = $id";
		$result = $this->exec($sql);
		return $this->fetch($result);
	}








    public function fetchVideo(){
        $result = $this->select(RESOURCE,'*',array('type'=>5),array('r_id'=>'desc'),array(0,7));
        if($this->count($result)!=""){
            while($row = $this->fetch($result)){
                $row_array[] = $row;
            }
            return $row_array;
        }else{
            return FALSE;
        }
    }
    function optionsbypollId($id)
    {
            //echo "select * from options where ques_id = '$id'";   
       // global $ado;
        $res = $this->exec("select * from options where ques_id = '$id'");
        return $res;
    }
      function checkpoll()
    {
        return $this->exec("select * from questions");
    
    }
    /**
     * get advertisement by category
     * @param adcategory
     * @param limit default null
     * @return array|null
     */
    public function getAdvertisement($adType, $limit=NULL){
        if(is_array($limit)){
            $result = $this->select(ADVERTISEMENT,'*',array('cat_id'=>$adType,'display'=>1),array('position'=>'asc'),array($limit[0], $limit[1]));
        }else{
            $result = $this->select(ADVERTISEMENT,'*',array('cat_id'=>$adType,'display'=>1),array('position'=>'asc'));
        }
        
        if(mysql_num_rows($result)!=""){
               while($row = $this->fetch($result)){
                   $data[] = $row;
               }
        }else{
            $data = null;
        }
        return $data;
    }
    public function getLabel($id){
        $result = $this->select('tbl_subpage',array('id','s_pagename'),array('type'=>$id));
        if(mysql_num_rows($result)!=""){
            $count = 0;
            while($row = $this->fetch($result)){
                if($count%2==0){
                    $cls = 'bluebutton';
                }else{
                    $cls = 'greenbutton';
                }
                ++$count;
                echo '<div class="'.$cls.' fleft" onclick="location.href=\'subpage.php?pid='.$row['id'].'\'">
                '.stripslashes($row['s_pagename']).'
            </div>';
                
            }
        }
    }
    /**
     * filter article content by category id
     * @param int categoryId
     * @param int total no of data required default 5
     * @return array|Null
     */
     public function get_articles_filter_by_cat($category_id,$limit=5,$type="large"){
         $result = $this->select('tbl_news','*',array('type'=>$category_id),array('id'=>'desc',"posted_on"=>'desc'),array(0,$limit));
         if(mysql_num_rows($result)!=""){
             while($row = $this->fetch($result)){
                 $data[] = $row;
             }
         }else{
             $data = null;
         }
         $this->generate_news_block($data, $type);
         //return $data;
     }
     /**
      * generate html for hompage in news section
      */
      public function generate_news_block($dataFirst, $filterClass){
          if($filterClass=="large"){
              $news_wrapper_div = 'news-box';
              $news_title_wrapper = 'news-title';
              $news_content_wrapper = 'news-content';
              $filter_c = 2;
              $t = 28;
          }else{
              $filter_c = 1;
              $t = 18;
              $news_wrapper_div = 'common-box';
              $news_title_wrapper = 'common-title';
              $news_content_wrapper = 'common-content';
          }
          if(is_array($dataFirst)&&!empty($dataFirst)){
                $blockDisplay = array_slice($dataFirst,0,$filter_c);
                $smallDisplay = array_slice($dataFirst,$filter_c);
                if(is_array($blockDisplay)&&$blockDisplay!=""){
                   // echo '<div class="common-tab-content fleft">';
                    foreach($blockDisplay as $val){
                        echo '<div class="news-box fleft"> <a href="news-details.php?nid='.$val[id].'" class="fleft mar-bot-5" title="'.strip_tags(stripslashes($val[title])).'">'.strip_tags(stripslashes($val[title])).'</a> <br />
                        '.(($val[image]!="")?'<img src="uploads/news/'.$val['image'].'" alt="image" title="" />':'').'
               '.filterWords(stripslashes($val['shortdesc']),$t).' .... 
            </div>';
                       
                    }
                    //echo '</div>';
                    if(is_array($smallDisplay)&&!empty($smallDisplay)){
                  
                        echo '<div class="thapsamachar fleft">';
                        foreach($smallDisplay as $sval){
                            echo '<a href="news-details.php?nid='.$sval['id'].'">'.stripslashes($sval['title']).'</a>';
                        }
                        echo '</div>';
                    }
                }
            }
      }
      /**
       * Get lastest article by category
       * @param category_id
       * @return array|null
       */
       public function get_single_article($category_id){
           $result  = $this->select('tbl_news','*',array('type'=>$category_id),array('id'=>'desc','posted_on'=>'desc'),array(0,1));
           if(mysql_num_rows($result)!=""){
               $data =$this->fetch($result);
           }else{
               $data = null;
           }
           return $data;
       }
        /**
         * return the primary image of gallery by id if found else return random image else returns null
         * @param gallery_id
         * @return array|null
         */    
        public function get_primary_image($gallery_id){
            $result = $this->select('tbl_images',array('image','caption'),array('type'=>$gallery_id,'isprimary'=>1));
            if(mysql_num_rows($result)!=""){
                $image_res = $this->fetch($result);
                $image[image] = $image_res[image];
                $image[caption] = stripslashes($image_res[caption]);
            }else{
                $sql = "select * from tbl_images where type='$gallery_id' order by rand() limit 0 , 1";
                $result= $this->exec($sql);
                if($this->count($result)!=""){
                    $row = $this->fetch($result);
                    $image[image] = $row['image'];
                    $image[caption] = stripslashes($row[caption]);
                }else{
                    $image = null;
                }
            }
            return $image;
        }
        function getSelProgram($id){
        $sql = "SELECT * FROM".PROGRAM_TBL."WHERE pro_id = $id";
        $result = $this->exec($sql);
        return $this->fetch($result);
    }
        function selProgram(){
    
        $sql = "SELECT DISTINCT title FROM tbl_program ORDER BY title";
        return $this->exec($sql);
    }
        public function getMessage($id){
            $result = $this->select('tbl_message','*',array('id'=>(int)$id));
            if(mysql_num_rows($result)!=""){
                $row = $this->fetch($result);
                return $row;
            }else{
                return null;
            }
        }
        public function __call($function_name, $arguements){
            return '<b style="color:#000; background:#fff">You have called a non Existant function with the name&raquo;'.$function_name.'</br>
                    </b>';
        }
		public function find_product_parents($cat_id){
			$result = $this->select('tbl_product_cat','*',array('id'=>$cat_id),null,null,true);
			if($result->total_data()!=""){
				$row = $result->fetch_data($result);
				$category = $row[category].',';
				if($row[parent_id]!=0){
					$category .= $this->find_product_parents($row[parent_id]);
				}
			}
//echo $category;
			//$category_array = explode(',',$category);
			//printArray($category_array);
			return $category;
		}
        
}//end of class
?>