<?php
  //print_r($_SERVER);
  //echo $_SERVER[DOCUMENT_ROOT];
include("../classes/application_top.php");
if(isset($_POST['logbtn'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $auth_result = $user_obj->authenticate_user($user, $pass);
}
//printArray($_SERVER);

?>

<script src="js/login.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<body id="login">
    <h2>Login</h2>
<div id = "login_pg">
	
	<div id="loginform">
		
	<form method="post" action="" onSubmit="return chkLogin();">
		<table id="loginfrm" cellspacing="0">
			
			    <?php 
			         $user_obj->generateError($auth_result);
			    ?>
			<tr>
			
			<td align="center">
			 <fieldset>
			     <legend>USERNAME</legend>
			    <input type="text" name="username" id="username" value="" />
			 </fieldset>
			</td>
			<td align="center">
			    <fieldset>
                 <legend>PASSWORD</legend>
			    <input type="password" name="password" id="password" value="" />
			     </fieldset>
			</td>
			</tr>
			
			<?php 
			     echo $user_obj->check_attempt();
			?>
			<tr>
			<td>&nbsp;</td>
			<td style="font-size:16px"><a href="forgot.php" style="color:silver;">Forgot Your Password?</a></td>
			</tr>
			<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="logbtn" class="btn" id="logbtn" value="Login"/></td>
			</tr>
		</table>
	
	</form>
	</div>
</div>
</body>
