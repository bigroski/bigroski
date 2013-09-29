<?php 
    include '../../classes/application_top.php';
    function find_function( $a, $b ){
        global $find;
        if($a == $find){
            call_user_func(array('Functions',$b));
        }
    }
    if(isset($_POST)&&$_POST['find']!=""){
        $find = $_POST['find'];
        $available = array('pages','articles','members','ad','products');
        $associate = array('get_page_label','get_articles_category','get_member_category','get_ad_category', 'get_products_category');
        if(in_array($_POST['find'],$available)){
            array_map('find_function', $available, $associate);
        }else{
            echo 'Noting to do Here';
        }
    }
?>