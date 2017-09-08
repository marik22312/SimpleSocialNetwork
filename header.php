<?php
require("src/db_cfg.php");

$logged_in = check_login(); //Check if user is logged in
if (check_login()) {
  $me = $user_ID_array['user_id'];
}

?>

<!-- Header.php
  Authors:
    Front-end: Asaf Hadad
      Back-End: Marik Shnitman
    Version:
      08/05/17 -- 00:40 -->


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Social Network</title>
    <link rel="stylesheet" href="src/css/reset.css">
    <link rel="stylesheet" href="src/css/style.css" media="screen" type="text/css" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="src/addons/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="src/addons/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">

  </head>
  <body>

    <header>
    <div class="navbar-header">
           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
           </button>

       </div>

       <!-- add menu -->
       <div class="collapse navbar-collapse navbar-fixed-top" id="navbar1">
           <ul class="nav navbar-nav">
             <li class="active"><a href="index.php" class="header-button"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
             <?php if (check_login() === TRUE): ?>
               <li><a href="chat.php"><i class="fa fa-comments-o" aria-hidden="true"></i>&nbsp;Chat </a></li>
               <li><a href="#"> <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;Settings</a></li>
             <?php endif; ?>
             <?php if (check_login() === TRUE): ?>
               <?php if (is_admin() === TRUE): ?>
                 <li><a href="admin.php"><i class="fa fa-wrench" aria-hidden="true"></i>&nbsp;Admin settings</a></li>
               <?php endif; ?>
             <?php endif; ?>
           </ul>

             <!-- Logout button  for logged in users
             Last Update: 07/05/17 23:57-->
             <!-- added font awesome and changed looks and font
              08/05/17 14:00-->
             <!-- add search form -->
             <form class="navbar-form navbar-right" role="search">
                 <div class="input-group">
                   <input type="text" class="form-control" placeholder="Search"></input>
                     <span class="input-group-btn">
                         <button type="submit" class="btn btn-default">
                         <span class="glyphicon glyphicon-search"></span>
                         </button>
                     </span>
                 </div>
                 <?php if (check_login() === TRUE): ?>
                   <div class="dropdown">
  <a id="dLabel" role="button" data-toggle="dropdown" data-target="notif" href="" aria-haspopup="true" aria-expanded="false">
    <i class="glyphicon glyphicon-bell"></i>
  </a>
  <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel" id="notif">

    <div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right"><a href="notifications.php">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></a></h4>
    </div>
    <li class="divider"></li>
   <div class="notifications-wrapper">


       <!-- Notfication -->
       <?php  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
        $notf_query = "SELECT * FROM `notification` WHERE `parent_id` = $me ORDER BY `notf_id` DESC;";
        $notf_result = mysqli_query($conn, $notf_query);
        $notf_row = mysqli_fetch_all($notf_result);
        $notf_arr = mysqli_fetch_array($notf_result);
       //  for each row
        foreach ($notf_row as $notf_row => $notf_value) {
         //  friend request
          if ($notf_value[3] == 1) :?>
          <?php
           $query = "SELECT * FROM `users` WHERE `user_id` = $notf_value[2];";
           $result = mysqli_query($conn, $query);
           $result_arr = mysqli_fetch_array($result);
           ?>
        <div class="notification-item">

            <h5><?php echo $result_arr['user_nick']; ?> Sent a friend request!</h5>
             <?php if ($notf_value[4] == 0): ?>
              <i class="fa fa-flag" aria-hidden="true"></i>
              <?php else: ?>
                <i class="fa fa-flag-o" aria-hidden="true"></i>
            <?php endif; ?>
            <!-- $notf_value[2]; = id of requesting user -->
            <a class="btn btn-success" href="#">Accept</a><a class="btn btn-danger">Decline</a>
        </div>
          <?php endif;}?>


     <a class="content" href="#">
      <div class="notification-item">
        <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
        <p class="item-info">Marketing 101, Video Assignment</p>
      </div>



   </div>
    <li class="divider"></li>
  </ul>

</div>
                   <li class="navbar-right logout"><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
                   <p class="navbar-text navbar-right">Logged In As <a href="profile.php?id=<?php echo $user_ID_array['user_id']; ?>" class="navbar-link"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<?php echo $user_name_array['user_nick']; ?></a></p>
                 <?php endif; ?>

             </form>

       </div>
           </header>
