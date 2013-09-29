<?php 
    include_once '../classes/image_manipulation.php';
    if(isset($_POST)&&$_POST['btn_submit']!=""){
        $config['directory'] = '../uploads/swhat/';
        //$config['thumb_width'] = 400;
        $config['thumb_width'] = array(200,100,150);
        //$config['thumb_height'] = 100;
        $image_obj  =  ImageManipulation::generateClass($config);
        $uploaded_files = $image_obj  ->  upload_multiple_image($_FILES['image']);
        print'<pre>';
        print_r($uploaded_files);
        print'</pre>';
        //$imageResult = $image_obj  ->  upload_image($_FILES['image']);
        //echo $imageResult;
        
        
    }
    
    
    
?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image[]" /><br />
    <input type="file" name="image[]" /><br />
    <input type="file" name="image[]" /><br />
    <input type="submit" name="btn_submit" value="submit" />
    
</form>
