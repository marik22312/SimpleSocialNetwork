<?php
/**************************************************************************************
* Send Friend Request, Accept or Decline Request using Ajax, Jquery and PHP
* This script has been released with the aim that it will be useful.
* Written by Vasplus Programming Blog
* Website: www.vasplus.info
* Email: info@vasplus.info
* All Copy Rights Reserved by Vasplus Programming Blog
***************************************************************************************/


include "config.php"; //Include the database connection settings file

if(isset($_POST["page"]) && !empty($_POST["page"])) //Perform page validation
{
	global $logged_in_username,$page_owner;
	$logged_in_username = trim(strip_tags($_POST["logged_in_username"])); //This is the user who logged into the system or logged in session
	$page_owner = trim(strip_tags($_POST["page_owner"])); // This is the owner of the page viewed
	
	
	
	
	
	
	//This is the Add Friends Page
	if($_POST["page"] == "vpb_add_as_friend") 
	{
		//Check whether the user that a logged in user wants to add as friend has already added the logged in user as friend or not
		$check_request = mysql_query("select * from `friend_request` where `username` = '".mysql_real_escape_string($logged_in_username)."' and `friend` = '".mysql_real_escape_string($page_owner)."' or `username` = '".mysql_real_escape_string($page_owner)."' and `friend` = '".mysql_real_escape_string($logged_in_username)."'");
		
		if(mysql_num_rows($check_request) > 0) //If already added as friend, friendship confirmed
		{
			@mysql_query("delete from `friend_request` where `username` = '".mysql_real_escape_string($logged_in_username)."' and `friend` = '".mysql_real_escape_string($page_owner)."'");
			@mysql_query("delete from `friend_request` where `username` = '".mysql_real_escape_string($page_owner)."' and `friend` = '".mysql_real_escape_string($logged_in_username)."'");
			
			
			@mysql_query("insert into `my_friends` values('', '".mysql_real_escape_string($logged_in_username)."', '".mysql_real_escape_string($page_owner)."')");
			@mysql_query("insert into `my_friends` values('', '".mysql_real_escape_string($page_owner)."', '".mysql_real_escape_string($logged_in_username)."')");
			echo "friend_ship_confirmed";
		}
		else //If not already added as friend, send friends request
		{
			//Check first whether the page owner is already friend with the logged in user
			$check_friend_ship = mysql_query("select * from `my_friends` where `username` = '".mysql_real_escape_string($page_owner)."' and `friend` = '".mysql_real_escape_string($logged_in_username)."'");
			
			if(mysql_num_rows($check_friend_ship) > 0)
			{
				@mysql_query("insert into `my_friends` values('', '".mysql_real_escape_string($logged_in_username)."', '".mysql_real_escape_string($page_owner)."')");
				echo "friend_ship_confirmed";
			}
			else
			{
				@mysql_query("delete from `my_friends` where `username` = '".mysql_real_escape_string($logged_in_username)."' and `friend` = '".mysql_real_escape_string($page_owner)."'");
				@mysql_query("insert into `friend_request` values('', '".mysql_real_escape_string($logged_in_username)."', '".mysql_real_escape_string($page_owner)."')");
				echo "request_sent_successfully";
			}
		}
	}
	
	
	
	
	
	
	
	
	
	//This is the Cancel Friendship Page
	elseif($_POST["page"] == "vpb_cancel_friendship") 
	{
		mysql_query("delete from `friend_request` where `username` = '".mysql_real_escape_string($logged_in_username)."' and `friend` = '".mysql_real_escape_string($page_owner)."'");
		
		mysql_query("delete from `friend_request` where `username` = '".mysql_real_escape_string($page_owner)."' and `friend` = '".mysql_real_escape_string($logged_in_username)."'");
		
		mysql_query("delete from `my_friends` where `username` = '".mysql_real_escape_string($logged_in_username)."' and `friend` = '".mysql_real_escape_string($page_owner)."'");
		mysql_query("delete from `my_friends` where `username` = '".mysql_real_escape_string($page_owner)."' and `friend` = '".mysql_real_escape_string($logged_in_username)."'");
		
		echo "vpb_cancel_friendship";
	}
	
	
	
	
	
	
	
	
	//This is the page that checks for Friend Request
	elseif($_POST["page"] == "vpb_check_friends_request") 
	{
		$logged_in_username = trim(strip_tags($_POST["logged_in_username"]));
		
		if(!empty($logged_in_username))
		{
			$check_request = mysql_query("select * from `friend_request` where `friend` = '".mysql_real_escape_string($logged_in_username)."' order by `id` asc limit 1"); //First Request receive, first to respond to
				
			if(mysql_num_rows($check_request) > 0) //If there is a friend request for the logged in user then show it to the user otherwise do nothing
			{
				$get_request_details = mysql_fetch_array($check_request);
				
				//Check friend who sent the request full info from the users table
				$check_request_info = mysql_query("select * from `friendship_system_users_table` where `username` = '".mysql_real_escape_string($get_request_details["username"])."'");
				//Get friend who sent the request full info from the users table
				$get_request_info = mysql_fetch_array($check_request_info);
				
				//Check logged in user full info from the users table
				$check_logged_in_user_info = mysql_query("select * from `friendship_system_users_table` where `username` = '".mysql_real_escape_string($logged_in_username)."'");
				//Get logged in user full info from the users table
				$get_logged_in_user_info = mysql_fetch_array($check_logged_in_user_info);
				
				//Display notification below
				?>
				<div style="width:260px;">
				<div style=" font-family:Verdana, Geneva, sans-serif; font-size:14px; margin-bottom:8px;" align="left">Hello <?php echo strip_tags($get_logged_in_user_info["fullname"]); ?></div>
				<div style="font-family:Verdana, Geneva, sans-serif; font-size:11px; line-height:18px;" align="left">A user whose detail is shown below would like to add you as a friend.</div><br clear="all" />
				
				<div style=" float:left; width:80px;" align="left"><a href="index.php?page_owner=<?php echo base64_encode(strip_tags($get_request_info["username"])); ?>"><img src="images/big_avatar.jpg" class="vpb_people_you_may_want_to_add_or_cancel_photos" style="width:75px; height:65px;" border="0" align="absmiddle" /></a></div>
				<div style=" float:left;" align="left"><span class="ccc"><a href="index.php?page_owner=<?php echo base64_encode(strip_tags($get_request_info["username"])); ?>"><font style="color:blue;font-family:Verdana, Geneva, sans-serif; font-size:14px;"><?php echo strip_tags($get_request_info["fullname"]); ?></font></a></span></div><br clear="all" /><br clear="all" /><br clear="all" />
				
				<div style="width:230px;" align="center">
				<div style="margin-right:30px;" class="vpb_general_button_g" onClick="add_or_cancel_friend_ship('<?php echo $logged_in_username; ?>','<?php echo strip_tags($get_request_info["username"]); ?>','vpb_add_as_friend');">Accept</div>
				<div style="" class="vpb_general_button_r" onClick="add_or_cancel_friend_ship('<?php echo $logged_in_username; ?>','<?php echo strip_tags($get_request_info["username"]); ?>','vpb_cancel_friendship');">Decline</div>
				<br clear="all" />
				</div>
				</div>
				<?php
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	else
	{
		//Unknown page realized
	}
}
?>