<?php
/**************************************************************************************
* Send Friend Request, Accept or Decline Request using Ajax, Jquery and PHP
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***************************************************************************************/
session_start();
ob_start();

//Include the database connection file
include "config.php";

$error = '';

//Check to see if the submit button has been clicked to process data
if(isset($_POST["submitted"]) && $_POST["submitted"] == "yes")
{
	//Variables Assignment
	$username = trim(strip_tags($_POST['username']));
	$user_password = trim(strip_tags($_POST['passwd']));
	$encrypted_md5_password = md5($user_password);
	
	$validate_user_information = mysql_query("select * from `friendship_system_users_table` where `username` = '".mysql_real_escape_string($username)."' and `password` = '".mysql_real_escape_string($encrypted_md5_password)."'");
	
	//Validate against empty fields
	if($username == "" || $user_password == "")
	{
		$error = '<br><div class="info">Sorry, all fields are required to log into your account. Thanks.</div><br>';
	}
	elseif(mysql_num_rows($validate_user_information) == 1) //Check if the information of the user are valid or not
	{
		//The submitted info of the user are valid therefore, grant the user access to the system by creating a valid session for this user and redirect this user to the welcome page
		$get_user_information = mysql_fetch_array($validate_user_information);
		$_SESSION["VALID_USER_ID"] = $username;
		$_SESSION["USER_FULLNAME"] = strip_tags($get_user_information["fullname"]);
		header("location: index.php?page_owner=".base64_encode($username));
	}
	else
	{
		//The submitted info the user are invalid therefore, display an error message on the screen to the user
		$error = '<br><div class="info">Sorry, you have provided incorrect information. Please enter correct user information to proceed. Thanks.</div><br>';
	}
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>vasPLUS Programming Blog - Send Friend Request, Accept or Decline Request using Ajax, Jquery and PHP</title>


<!-- Required header file -->
<link href="css/style.css" rel="stylesheet" type="text/css">




</head>
<body>
<center>
<div id="all_centered">
<center>
<div id="centered"><br>
<div id="vasp" style="">Send Friend Request, Accept or Decline Request using Ajax, Jquery and PHP</div><br clear="all" /><br clear="all" /><br clear="all" />











<!-- Code Begins -->
<center>
<div class="vpb_main_wrapper">

<br clear="all">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h2 align="left" style="margin-top:0px;">Users Login</h2><br />

<div align="left" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; margin-bottom:10px;">Please enter your username and password below to demo this system.</div><br />

<div style="width:115px; padding-top:10px;float:left;" align="left">Your Username:</div>
<div style="width:300px;float:left;" align="left"><input type="text" name="username" id="username" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">Your Password:</div>
<div style="width:300px;float:left;" align="left"><input type="password" name="passwd" id="passwd" value="" class="vpb_textAreaBoxInputs"></div><br clear="all"><br clear="all">


<div style="width:115px; padding-top:10px;float:left;" align="left">&nbsp;</div>
<div style="width:300px;float:left;" align="left">
<input type="hidden" name="submitted" id="submitted" value="yes">
<input type="submit" name="submit" id="" value="Login" style="margin-right:50px;" class="vpb_general_button_g">
<a href="signup.php" style="text-decoration:none;" class="vpb_general_button_g">Register</a>

</div>

</form>
<br clear="all"><br clear="all">
<div style="width:450px;float:left;" align="left"><?php echo $error; ?></div><br clear="all">

</div>
</center>
<!-- Code Ends -->



<br clear="all">



<br /><br /><div style="font-family:Verdana, Geneva, sans-serif; font-size:11px;">Please click on register and fill in some info to really see how the system works if you have not done that.</div><br /><br />











<p style="margin-bottom:250px;">&nbsp;</p>
</div>
</center>
</div>
</center>
</body>
</html>