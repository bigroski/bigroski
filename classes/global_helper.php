<?php
    /**
     * Function returns either checked or selected, when compares option1 and option2
     * @param option1
     * @param option2
     * @param checked filter eiter checked or selected default false
     * @return string 
     */
    function checkSelected($op1, $op2,$ch=false){
        if($op1 == $op2){
            if($ch==true){
                //return 'h';
                return ' checked="checked"';
            }else{
                return ' selected="selected"';
            }
            
        }
    }
    
    /**
     * Function prints array in readable format
     * @param array
     * @return void
     */
    function printArray($arr){
        print "<pre>";
        print_r($arr);
        print "</pre>";
    }
    
    /**
     * Function returns a limited number of words form the string
     * @param string Desired string to limit
     * @param limit default 22
     * @return string
     */
    function filterWords($string, $limit = 22){
        //Custom function to filter string by word Count;
        $words = explode(' ', $string);
        $seperate = array_slice($words, 0, $limit);
        $returnString = implode(' ', $seperate);
        return $returnString;
    }
    /**
     * Changes the format of the youtube shared video to original format
     * @param videourl
     * @return string
     */
    function revertVideo($vid){
        $exp = explode('/v/',$vid);
        return 'http://youtu.be/'.$exp[1];
    }
    /**
     * Extracts part of the link to get thumbnail
     * @param $url url form the database
     * @return string
     */
    function video_url($url){
        
        preg_match('/youtube\.com\/v\/([\w\-]+)/',$url, $match);
        $img_video = $match['1']."/default.jpg";
        $src_img = 'http://i2.ytimg.com/vi/'.$img_video;
        return $src_img;
    }
    function __autoload($classname){
        //echo __FILE__;
        //echo '../classes/'.strtolower($classname.".php");
        if(file_exists('classes/'.strtolower($classname.".php"))){
            require_once $classname.".php";
        }else{
            trigger_error('file not found'.$classname);
        }
        //echo $classname;
    }
    /**
     * Redirect with javascript
     * @param url
     */
    function java_redirect($url){
            echo "<script>window.location='$url';</script>";
    }

    function convertNepaliUnicode($str) {

$str = strval($str);

$array = array(0 =>'0' , 1 => '१', 2 => '२', 3 => '३', 4 => '४', 5 => '५', 6 => '६', 7 => '७', 8 => '८', 9 => '९');

$utf = "";

$cnt = strlen($str);

for ($i = 0; $i < $cnt; $i++) {

if (!isset($array[$str[$i]])) {

$utf .= $str[$i];

} else

$utf .= $array[$str[$i]];

}

return $utf;

}
    /**
     * Bigroski Custom Error Handler
     * 
     */
    function bigroski_c_error($err_type, $err_string, $err_file, $err_line){
        switch($err_type){
            case E_USER_ERROR:
                echo $err_string.'<br>';
                echo $err_file.'<br>';
                echo $err_line;
                break;
            case E_USER_WARNING:
                break;
            case E_USER_NOTICE:
                break;
        }
    }
