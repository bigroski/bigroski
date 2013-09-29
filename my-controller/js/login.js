// JavaScript Document
function focuson(){
	var u = document.getElementById('username');
	u.focus();
}
function checkLogin()
{
    if(document.getElementById('username').value=="")
	{
	//alert("missing username");
	document.getElementById('loginErr').innerHTML  ='Please enter the username!!';
	document.getElementById('username').focus();
	return false;
	}
	else if(document.getElementById('password').value=="")
	{
	document.getElementById('loginErr').innerHTML  ='Please enter the password!!';
	document.getElementById('password').focus();
	
	return false;
	}
	else
	return true;


}

function remove()
{
document.getElementById('loginErr').innerHTML  ='';
}

function focusMe()
{
document.getElementById('username').focus();
}