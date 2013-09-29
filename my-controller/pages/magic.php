<h2>Magic quote GPC</h2>
<?php 
   include_once '../classes/user.php';
    $config['is_hashed']=FALSE;
    $user_obj = USER_CLASS::create_instance($config);
    $username = "Administrator";
    $password = "pass_#1234'";
    $user_obj->create_user($username,$password);
    echo '<br />';
    echo 'The salt is '.$user_obj->salt; 
    
    
?>
<form method="post">
    <textarea name="inserted"></textarea>
    <input type="submit">
    
    
</form>