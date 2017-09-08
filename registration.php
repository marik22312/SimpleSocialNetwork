<?php
//DB Configuration
require ("src/db_cfg.php");

//form handling variables
$nick = $_POST['reg_nick'];
$mail = $_POST['reg_email'];
$gender = $_POST['reg_gender'];
$pass = $_POST['reg_pass'];
$motto = $_POST['signup_motto'];
$auto_connect = $_POST['reg_autoLogin'];
if ($auto_connect != 'Yes') {
    $auto_connect = 'No';
}



/* Input Validation */
//nickname Validation
if (!preg_match("/^[a-zA-Z0-9 ]*$/",$nick)) {
    die (header("location: index.php?reg_err=11"));
}

//email validation
$reg_mail_validate = test_input($mail);
if (!filter_var($reg_mail_validate, FILTER_VALIDATE_EMAIL)) {
  die (header("location: index.php?reg_err=12"));
}

//password validation
if ((strlen($pass) < 6)) {
  die (header("location: index.php?reg_err=13"));
}

// Create connection
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);

// Check connection
if ($conn->connect_error) {
    die(header("location: index.php?db_con=1"));
  }

  $query = "INSERT INTO `users` (`user_id`, `user_nick`, `user_avatar`, `user_motto`, `user_gender`, `user_mail`, `user_pass`, `sc_admin`) VALUES (NULL, '$nick', NULL, '$motto', '$gender', '$mail', md5('$pass'), '0');";

if (mysqli_query($conn,$query) === TRUE) {
    mysqli_close($conn);
    if ($auto_connect == 'Yes') {
      setcookie('sc_user', $mail, time() + (86400 * 365), "/"); // 86400 = 1 day
      setcookie('sc_pass', md5($pass), time() + (86400 * 365), "/"); // 86400 = 1 day
      header("location: index.php?reg_success=1");
    }
      header("location: index.php?reg_success=1");

} else {
    mysqli_close($conn);
    header("location: index.php?reg_success=0");
}

?>
