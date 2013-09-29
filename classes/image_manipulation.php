<?php
/*
 * Image Manipulation class by Bigroski
 * Step 1. Iniatialize Image Manipulation class by using the following statement
 *         
 *             $image_obj  =  ImageManipulation::generateClass($config);
 *      
 *     Available configuration Options are
 *       Required
 *          $config['directory'] = '../uploads/swhat/';
 *       Required        
 *          $config['thumb_width'] = 400;
 *       Optional [if thumb_height is not set thumbnail height is relative to the thumbnail width]                      
 *          $config['thumb_height'] = 100;
 * 
 *      USEAGE:-
 *          1. Single File Upload
 *              $imageResult = $image_obj  ->  upload_image($_FILES['image']);
 *              Returns a single file name
 *          2. Multiple File upload
 *              $uploaded_files = $image_obj  ->  upload_multiple_image($_FILES['image']);
 *              Returns an array containing recently uploaded files.
 * 
 *       Further Enhancements
 *          1. Multiple Thumbnails of different Sizes.
 *          2. Thumbnail Integration.
 * */ 
    class ImageManipulation{
            
        public $imageExt;
        public $uploadedImage;
        public $imageWidth;
        public $imageHeight;
        public $defaultWidth;
        public $defaultHeight;
        private $directory;
        private $thumb_width;
        private $thumb_height;
        public $mime;
        
        function __construct(){
            $this->check_gd();
        }
        
        private function check_gd(){
                
            if(!function_exists('gd_info')){
                    
                die('ERROR: Please Enable The GD Library And Try Again.');
            
            }
            
        }
        
        public function validate_image(){
            if($this->imageWidth == ''||$this->imageHeight==''){
                return FALSE;
            }elseif($this->is_valid_extension()===FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
            
            
        }
        
        private function is_valid_extension(){
            $validExt = array('bmp'=>'image/bmp',
                              'cod'=>'image/cis-cod',
                              'gif'=>'image/gif',
                              'ief'=>'image/ief',
                              'png'=>'image/png',
                              'jpeg'=>'image/jpeg',
                              'jpg'=>'image/jpeg',
                              'jfif'=>'image/pipeg',
                              'svg'=>'image/svg+xml',
                              'tif'=>'image/tiff',
                              'tiff'=>'image/tiff',
                              'ras'=>'image/x-cmu-raster',
                              'cmx'=>'image/x-cmx',
                              'ico'=>'image/x-icon');
             if(in_array($this->mime,$validExt)){
                 $ext = array_keys($validExt,$this->mime);
                 $this->imageExt = '.'.$ext[0];
                 //$this->view_config();
                 return TRUE;
             }else{
                 return FALSE;
             }
        }
        
        public function upload_image($file_data){
            
            $tmp_name = $file_data['tmp_name'];
            $error = $file_data['error'];
            $image_info = getimagesize($tmp_name);
            list($this->imageWidth,$this->imageHeight, , ,$this->mime) = $image_info;
            $this->mime = $image_info['mime'];
            //Validate Image
            if($this->validate_image()===TRUE){
                //Validate Folder
                if($this->check_folder()===TRUE){
                    $this->uploadedImage = rand();
                    @move_uploaded_file($tmp_name, $this->directory.$this->uploadedImage.$this->imageExt);
                    if(file_exists($this->directory.$this->uploadedImage.$this->imageExt)){
                        $this->check_thumbnail_length();
                    }else{
                        die('The image Cannot be uploaded');
                    }
                }
                return $this->uploadedImage.$this->imageExt;
            }else{
                die('The image Cannot be uploaded. Not an image');
            }
            
        }
        
        private function check_thumbnail_length(){
            if(is_array($this->thumb_width)){
                echo 'Multiple Dimension Thumbnail';
                $width_array = $this->thumb_width;
                $height_array = $this->thumb_height;
                $no_of_thumb = count($width_array);
                for($i = 0; $i<$no_of_thumb;$i++){
                    echo $this->thumb_width = $width_array[$i];
                    if(is_array($height_array)){
                        $this->thumb_height = $height_array[$i];
                    }
                    $this->generate_thumbnail();
                    $this->thumb_height = '';
                }
                $this->thumb_width = $width_array;
            }else{
                //echo 'Single Dimension Thumbnail';
                $this->generate_thumbnail();
            }
        }
        
        private function check_folder(){
            if(!file_exists($this->directory)){
                if(mkdir($this->directory)===TRUE){
                    mkdir($this->directory.'thumbs/');
                    return TRUE;
                }else{
                    return FALSE;
                }
            }else{
                /*Directory Found*/
                return TRUE;
            }
        }
        
        private function generate_thumbnail(){
            $image_file = $this->directory.$this->uploadedImage.$this->imageExt;
            if(file_exists($image_file)){
                $functionName = 'imagecreatefrom'.substr($this->imageExt, 1);
                $c_function = 'image'.substr($this->imageExt,1);
                $src_image = $functionName($image_file);
                if($this->thumb_height==''){
                    $this->calculate_thumbnail_height();
                }
                $dst_image = imagecreatetruecolor($this->thumb_width, $this->thumb_height);
                imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $this->thumb_width, $this->thumb_height, $this->imageWidth, $this->imageHeight);
                if($c_function($dst_image, $this->directory.'thumbs/'.$this->uploadedImage.$this->imageExt)==TRUE){
                    //echo $this->directory.'thumbs/'.$this->uploadedImage.'_'.$this->thumb_width.'X'.$this->thumb_height.$this->imageExt.'<br />';
                    @imagedestroy($dst_image); 
                    @imagedestroy($src_image); 
                }else{
                    echo 'Thumbnail Not Created';
                }
            }
            
        }
        
        private function calculate_thumbnail_height(){
            
            $ratio = $this->imageWidth/$this->imageHeight;
            $this->thumb_height = ceil($this->thumb_width/$ratio);
            //echo $this->thumb_height.'<br >';
            //$this->view_config();
            
        }
        
        private function add_watermark(){
            
        }
        
        public function upload_multiple_image($multiple){
            
            foreach($multiple['name'] as $key=>$val){
                $image_data['name'] = $val;
                $image_data['tmp_name'] = $multiple['tmp_name'][$key];
                $image_data['type'] = $multiple['type'][$key];
                $image_data['error'] = $multiple['error'][$key];
                $image_data['size'] = $multiple['size'][$key];
                $uploaded_files[] = $this->upload_image($image_data);
            }
            return $uploaded_files;
        }
        
        public function configure($config_data){
            if(is_array($config_data)){
                    
                $class_vars = get_class_vars(get_class());
            
                foreach($config_data as $key=>$val){
            
                    if(array_key_exists($key, $class_vars)){
                        //echo $key.'=>'.$val;    
                        $this->$key = $val;
                        
                    }
                }
                //$this->view_config();    
                }
            
            
        }
        
        public function view_config(){
                
            $class_vars = get_class_vars(get_class());
            
            foreach($class_vars as $key=>$val){
            
                echo $key.'=>'.$this->$key.'<br />';
            
            }
        }
        
        static function generateClass($config_data = NULL){
            
            $ob = new ImageManipulation(1,2);
            $ob->configure($config_data);
            return $ob;
        }
    
    }    //End Of Class
   
?>