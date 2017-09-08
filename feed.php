<?php
  include 'chat_box.php';
 ?>
<div class="posts">
<?php
  $me = $user_ID_array['user_id'];

    $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
    $me_friendsQ = "SELECT * FROM `relationship` WHERE `user_one_id` = '$me' OR `user_two_id` = '$me' AND `status` = 1 ;";
    $me_friendsR = mysqli_query($conn, $me_friendsQ);

    $me_friends = mysqli_fetch_all($me_friendsR); ?>

    <?php foreach ($me_friends as $me_friends => $friend) {
      if ($me == $friend[0]) {
        $friend_postQ = "SELECT * FROM `posts` WHERE `post_writer_id` = '$me' OR `post_writer_id` = '$friend[1]' ORDER BY `posts`.`post_time` DESC;";
      }else {
        $friend_postQ = "SELECT * FROM `posts` WHERE `post_writer_id` = '$me' OR `post_writer_id` = '$friend[0]' ORDER BY `posts`.`post_time` DESC;";
      }

      $friend_postR = mysqli_query($conn, $friend_postQ);

      $friend_post = mysqli_fetch_all($friend_postR);
      $friend_postA = mysqli_fetch_array($friend_postR);

       foreach ($friend_post as $friend_post => $value) :?>
       <?php
         $friend_imgQ = "SELECT * FROM `users` WHERE `user_id` = '$value[1]';";
         $friend_imgR = mysqli_query($conn, $friend_imgQ);

         $friend_imgA = mysqli_fetch_array($friend_imgR);


       ?>
         <div class="post">
           <div class="panel panel-default">
             <a href="profile.php?id=<?php echo $friend_imgA['user_id']; ?>"><img src="<?php echo profile_avatar($value[1]) ?>" alt="profile pic" width="82px" height="82px"/></a>
             <h4><a href="profile.php?id=<?php echo $friend_imgA['user_id']; ?>"><?php echo $friend_imgA['user_nick']; ?></a></h4>
             <span class="post_time"><a href="post.php?id=<?php echo $value[0];?>"><?php echo "$value[3]"; ?></span></a>
             <p class="post_content"><?php echo nl2br("$value[2]"); ?></span></p>
           </div>
         </div>

  <?php endforeach; } ?>
</div>

<!-- created base of feed page 10/05/2017 - 1:20 -->
