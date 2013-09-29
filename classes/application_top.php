<?php    
session_start();
date_default_timezone_set('Asia/Katmandu');
require_once 'pagefinder.php';
require_once "global_helper.php";
require_once "site_config.php";
require_once "function.php";
require_once 'user.php';
require_once 'image_manipulation.php';
require_once "variable_debugger.php";
require_once "user_previlage.php";
require_once "pagination.php";
require_once "arraytoobject.php";
require_once "menu.php";
set_error_handler('bigroski_c_error');
$obj = new Functions;
$setting_options = $obj->get_setting_options();
$config['is_hashed']=FALSE;
$user_obj = USER_CLASS::create_instance($config);
$previlage_obj = User_Previlage::instantiate_prev_obj($user_obj->id, $obj);
?>