<?php
session_Start();
/*  Social Network config
    @Author: Marik Shnitman, Asaf Hadad
    @Version: 08/05/17 00:59  */

/* database config*/
$DB_servername = "localhost"; //server name
$DB_username = "root"; //username
$DB_password = ""; //DB password
$DB_name = "sc_network"; //DB name

//Constants
define("DB_SERVERNAME", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "sc_network");

/* input test */
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

/* Cookies */

/*check if cookies set*/
function check_login(){
  if ((isset($_COOKIE['sc_user'])===TRUE) && (isset($_COOKIE['sc_pass'])) === TRUE) {
    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
       //form handling variables
       $mail = $_COOKIE['sc_user'];
       $pass = $_COOKIE['sc_pass'];
       $hash = md5($pass);



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

               return TRUE;
          }else {

            if (((isset($_COOKIE['sc_user']) === TRUE) && (isset($_COOKIE['sc_pass']) === TRUE))) {
              setcookie("sc_user", '0' ,time() - 3600, '/');
              setcookie("sc_pass", '0' ,time() - 3600, '/');
              return FALSE;
            }
          }

       mysqli_close($conn);
  } elseif (isset($_SESSION['user_mail']) === TRUE) {
    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
       //form handling variables
       $mail = $_SESSION['user_mail'];
       $pass = $_SESSION['user_pass'];
       $hash = md5($pass);



       // Check connection
       if ($conn->connect_error) {
           die(header("location: index.php?db_con=0"));
         }

       $query = " SELECT * FROM users WHERE user_mail = '$mail' AND user_pass = '$hash' LIMIT 1;";
       $result = mysqli_query($conn, $query);
       $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


          $count = mysqli_num_rows($result);
          return TRUE;
  }
  else {
    if (isset($_SESSION['user_mail']) && (isset($_SESSION['user_pass']))) {
      session_unset();
      session_destroy();
    }

    return FALSE;
  }
}

function u_logout(){
  setcookie("sc_user", '0' ,time() - 3600, '/');
  setcookie("sc_pass", '0' ,time() - 3600, '/');
  session_unset();
  session_destroy();
  header("location: index.php");
}

// Set variables for logged In user
// Last Change: 08/05/17 00:59
if (check_login() === TRUE) {
  // if login set by cookie
  if ((isset($_COOKIE['sc_user'])===TRUE) && (isset($_COOKIE['sc_pass'])) === TRUE) {
    $conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
    $user_cookie_mail = $_COOKIE['sc_user'];
    //Get User Name
    $getUserNick_query = " SELECT user_nick FROM users WHERE user_mail = '$user_cookie_mail';";
    $getUserNick_result = mysqli_query($conn, $getUserNick_query);
    $user_name_array = mysqli_fetch_assoc($getUserNick_result);
    //Get User ID
    $getUserID_query = " SELECT user_id FROM users WHERE user_mail = '$user_cookie_mail';";
    $getUserID_result = mysqli_query($conn, $getUserID_query);
    $user_ID_array = mysqli_fetch_assoc($getUserID_result);

    // if Login set by session
  } elseif (isset($_SESSION['user_mail']) === TRUE) {
    $conn = new mysqli($DB_servername, $DB_username, $DB_password, $DB_name);
    $user_session_mail = $_SESSION['user_mail'];
    //Get User Name
    $getUserNick_query = " SELECT user_nick FROM users WHERE user_mail = '$user_session_mail';";
    $getUserNick_result = mysqli_query($conn, $getUserNick_query);
    $user_name_array = mysqli_fetch_assoc($getUserNick_result);
    //Get User ID
    $getUserID_query = " SELECT user_id FROM users WHERE user_mail = '$user_session_mail';";
    $getUserID_result = mysqli_query($conn, $getUserID_query);
    $user_ID_array = mysqli_fetch_assoc($getUserID_result);

  }
  else {
    return FALSE;
  }

}
 function is_admin(){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
      //form handling variables
      $mail = mysqli_real_escape_string($conn,$_COOKIE['sc_user']);

      // Check connection
      if ($conn->connect_error) {
          die(header("location: index.php?db_con=0"));
        }

      $query = " SELECT * FROM users WHERE user_mail = '$mail' AND sc_admin = '1' LIMIT 1;";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


         $count = mysqli_num_rows($result);

         // If result matched $myusername and $mypassword, table row must be 1 row

         if($count == 1) {
           return TRUE;
            } else {
              return FALSE;
            }

 }

 /* Profile Page */

 //Set Nickname
 function profile_nick($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $nick_query = " SELECT user_nick FROM users WHERE user_id = '$id';";
   $nick_result = mysqli_query($conn, $nick_query);
   $nick = mysqli_fetch_array($nick_result);
   return $nick['user_nick'];
 }

 //Set Profilepic
 function profile_avatar($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $profile_img_query = " SELECT user_avatar FROM users WHERE user_id = '$id';";
   $profile_img_result = mysqli_query($conn, $profile_img_query);
   $profile_img = mysqli_fetch_array($profile_img_result);
   return $profile_img['user_avatar'];
 }

 //Set Profile motto
 function profile_motto($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $profile_motto_query = " SELECT user_motto FROM users WHERE user_id = '$id';";
   $profile_motto_result = mysqli_query($conn, $profile_motto_query);
   $profile_motto = mysqli_fetch_array($profile_motto_result);
   return $profile_motto['user_motto'];
 }

 function profile_exist($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);

      // Check connection
      if ($conn->connect_error) {
          die(header("location: index.php?db_con=0"));
        }

      $query = " SELECT * FROM users WHERE user_id = '$id';";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);


         $count = mysqli_num_rows($result);

         // If result matched $myusername and $mypassword, table row must be 1 row

         if($count == 1) {
           return TRUE;
         }
         return FALSE;
 }

 function getProfPost($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $profile_post_query = " SELECT * FROM posts WHERE post_writer_id = '$id';";
   $profile_post_result = mysqli_query($conn, $profile_post_query);

     $profile_post = mysqli_fetch_all($profile_post_result);
    // print_r ($profile_post);
     foreach ($profile_post as $profile_post => $value) {
        print_r ($profile_post['post_content']);
     }
     mysqli_close($conn);

 }

 function getProfPostID($id){
   $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
   $profile_postID_query = " SELECT post_content FROM posts WHERE post_writer_id = '$id';";
   $profile_postID_result = mysqli_query($conn, $profile_postID_query);

     $profile_postID = mysqli_fetch_array($profile_postID_result);
     return $profile_postID;
     mysqli_close($conn);

 }

//show friends
function showfriends($id){

$conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
$query="SELECT * FROM `relationship`
WHERE `user_one_id` = $id OR `user_two_id` = $id AND `status` = 1";
$results = mysqli_query($conn,$query);

$row = mysqli_fetch_array($results);
while ($row = mysqli_fetch_array($results)) {

    return $row;
}
mysqli_close($conn);
}

function adminPanelPremission() {
  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
  $query = "SELECT user_nick FROM `users`;";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  foreach ($row as $result){
    return $row;
  }
  mysqli_close($conn);
}

?>
