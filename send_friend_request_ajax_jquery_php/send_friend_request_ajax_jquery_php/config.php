<?php
//Database Connection Settings
define ('hostnameorservername','localhost'); 	//Your Server Name or host Name goes in here
define ('serverusername',''); 					//Your database Username goes in here
define ('serverpassword',''); 					//Your database Password goes in here
define ('databasenamed',''); 					//Your database Name goes in here

global $connection;
$connection = @mysql_connect(hostnameorservername,serverusername,serverpassword) or die('Connection could not be made to the SQL Server.');
@mysql_select_db(databasenamed,$connection) or die('Connection could not be made to the database.');	
?>
