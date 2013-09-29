<?php  
    include("../classes/application_top.php");
    if(isset($_POST['logbtn'])&&$_POST['logbtn']!=""){
        $email = trim($_POST['email']);
        $recoveryResponse = $user_obj->password_recovery($email);
    }
?>


<link rel="stylesheet" type="text/css" href="css/style.css" />
<body id="login">
    <h2>Recover Password</h2>
<div id = "login_pg">
    <div id="loginform">
    <form method="post" action="" onSubmit="">
        <table id="loginfrm" cellspacing="0">
            <tr>
                <td colspan="2" style="color:#E1E1E1;text-align: left; font-size:20px;padding-left: 25px;">Enter Your Email address. You might recieve a new Password.</td>
            </tr>
                <?php 
                     $user_obj->generateRecoveryError($recoveryResponse);
                ?>
            <tr>
            <td style="color:#E1E1E1;">Email</td>
            <td><input type="text" name="email" id="username" /></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td style="font-size:16px"><a href="login.php" style="color:silver;">Back to Login.</a></td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="logbtn" class="btn" id="logbtn" value="Recover"/></td>
            </tr>
        </table>
    
    </form>
    </div>
</div>
</body>
