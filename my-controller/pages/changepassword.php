<link rel="stylesheet" href="css/passwordgrid.css" type="text/css" />
<?php
//$LOGIN_TABLE_NAME= "tbl_user";				//set tablename
//$DB_PASSWORD = "password";					//set password
//$DB_PRIMARYID = "id";						//set primary id
//$obj->table_name = $LOGIN_TABLE_NAME;		
//$obj->table_password = $DB_PASSWORD;			
//$obj->table_primaryId = $DB_PRIMARYID;		
$id = $_SESSION['authuserid'];
//to change password
if(isset($_POST['oldpass']) && !empty($_POST['oldpass']))
{

	$old_pass = $_POST['oldpass'];
	$new_pass = $_POST['newpass'];
    $result_find = $obj->select('tbl_admin',array('password','salt'),array('id'=>$id));
    if(mysql_num_rows($result_find)!=""){
        $rowFind = $obj->fetch($result_find);
        $hashed_password = $rowFind['password'];
        $user_obj->salt = $rowFind['salt'];
        if($user_obj->checkPassword($old_pass, $hashed_password)==TRUE){
            //echo 'Yes';
            $user_obj->change_admin_password($id,NULL,$new_pass);
            $msg = "Password Successfully Changed";
            $url = '?page=changepassword';
            
            $obj->alert($msg,$url);
        }else{
            $msg = "Invalid Password";
            $url = '?page=changepassword';
            $obj->alert($msg,$url);
        }
    }else{
        echo 'error';
    }
	
	
	
}
if(isset($_POST['old_email']) && !empty($_POST['old_email']))
{
	$id = $_SESSION['authuserid'];
	$old_email = $_POST['old_email'];
	$new_email = $_POST['new_email'];
	$result = $obj->checkAdminEmail($id,$old_email);
	$count = mysql_num_rows($result);
	if($count==1)
	{
		$msg1 = "Email is changed Successfully";
		
		$obj->exec("update tbl_admin set email = '$new_email' where id = '$id'");
		$obj->alert("Email has been sussesfully Changed","index.php");
	}
	else
	{
		$msg1 = "Old Email Doesnot match";
		$obj->alert("Old Email Doesnot match","?page=manage_password");
	}
}
?>
<form action="" method="post" onsubmit="return chksubmit();" >
<table id= "passGrid" width="500"> 
<thead  style="background-color:#006699;">
<tr>
<Td>Change Password</Td>
<td>&nbsp;</td>
</tr>
</thead>
<tr>
<td>Current Password</td>
<td><input type="password" name="oldpass" id = "oldpass" req="1"  autocomplete="off"/> </td>
</tr>
<tr>
<td>New Password</td>
<td><input type="password" name="newpass" id="newpass" req="1"  autocomplete="off"/></td>
</tr>

<tr>
<td>Re-Enter new Password</td>
<td><input type="password" name="repass" id="repass" req="1"  autocomplete="off"/></td>
</tr>

<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="Submit"/></td>
</tr>
</table>
</form>

<form action="" method="post">
<table id="passGrid">
<thead>
<tr>
<td>Change Email</td>
<td>&nbsp;</td>
</tr>
</thead>
<tr>
<td>Current Email</td>
<td><input type="text" name="old_email"  /></td>
</tr>
<tr>
<td>New Email</td>
<td><input type="text" name="new_email" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit2" value="submit" /></td>
</tr>
</table>
</form>

	<script type="text/javascript">
		function chksubmit(){
			var pass1 = document.getElementById("newpass").value;
			var pass2 = document.getElementById("repass").value;
                            
                            if(pass1 == pass2){
                                return true;
                                
                            }else{
                                alert ("Password not Matched. Re-enter Password");
                                document.getElementById("newpass").focus();
                                //document.getElementById("newpass").value= "";
								//document.getElementById("repass").value= "";
								return false;
                            }
                }
	
	</script> 