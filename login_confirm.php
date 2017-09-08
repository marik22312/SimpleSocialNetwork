<?php
   require("src/db_cfg.php");
$conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
   //form handling variables
   $mail = mysqli_real_escape_string($conn,$_POST['user_mail']);
   $pass = mysqli_real_escape_string($conn,$_POST['user_pass']);
   $hash = md5($pass);
   $login_remember = $_POST['login_remember'];



   // Check connection
   if ($conn->connect_error) {
       die(header("location: index.php?db_con=0"));
     }

   $query = " SELECT * FROM users WHERE user_mail = '$mail' AND user_pass = '$hash' LIMIT 1;";
   $result = mysqli_query($conn, $query);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
        //  session_register("myusername");
        //  $_SESSION['login_user'] = $myusername;
         if ($login_remember == "on") {
           setcookie('sc_user', $mail, time() + (86400 * 365), "/"); // 86400 = 1 day
           setcookie('sc_pass', $pass, time() + (86400 * 365), "/"); // 86400 = 1 day
         } else {
          //  session_start();
           $_SESSION['user_mail'] = $mail;
           $_SESSION['user_pass'] = $hash;
         }
         header("location: index.php?login=1");
        //  header("location: welcome.php");
      }else {
         header("location: index.php?login=0");
      }

   mysqli_close($conn);
   ?>
