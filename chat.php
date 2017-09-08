<?php
 require 'header.php';
 include 'chat_box.php';
 check_login();
 $me = $user_ID_array['user_id'];
 $friend = $user_ID_array['user_id'];
 if (isset($_GET['id'])) {
 $profile_id = $_GET['id'];
 $Chat_id = profile_nick($profile_id);
 if (profile_exist($profile_id) === FALSE) {
   header("location: index.php");
 }
}
?>

<?php
if (isset($_POST['new_message'])) {
  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
  $content = $_POST['new_message'];
  $contentQ = "INSERT INTO `chat` (`message_reciver_id`, `message_writer_id`, `message_content`, `message_time`) VALUES ($friend, '$me', '$content', CURRENT_TIMESTAMP);";
  mysqli_query($conn, $contentQ);
  mysqli_close($conn);
}
 ?>
 <div class="container bootstrap snippet">
     <div class="row big_chat">
 		<div class="col-md-4 bg-white ">
             <div class=" row border-bottom padding-sm" style="height: 40px;">
             	friends
             </div>

             <!-- member list -->
             <ul class="friend-list">
                 <li class="active bounceInDown">
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>John Doe</strong>
                 		</div>
                 		<div class="last-message text-muted">Hello, Are you there?</div>
                 		<small class="time text-muted">Just now</small>
                 		<small class="chat-alert label label-danger">1</small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Jane Doe</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">5 mins ago</small>
                 	<small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Kate</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">Yesterday</small>
                 		<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Kate</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">Yesterday</small>
                 		<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Kate</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">Yesterday</small>
                 		<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_6.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Kate</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">Yesterday</small>
                 		<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                 	</a>
                 </li>
                 <li>
                 	<a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_5.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Kate</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">Yesterday</small>
                 		<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small>
                 	</a>
                 </li>
                 <li>
                     <a href="#" class="clearfix">
                 		<img src="http://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                 		<div class="friend-name">
                 			<strong>Jane Doe</strong>
                 		</div>
                 		<div class="last-message text-muted">Lorem ipsum dolor sit amet.</div>
                 		<small class="time text-muted">5 mins ago</small>
                 	<small class="chat-alert text-muted"><i class="fa fa-check"></i></small>
                 	</a>
                 </li>
             </ul>
 		</div>

         <!--=========================================================-->
         <!-- selected chat -->
     	<div class="col-md-8 bg-white ">
             <div class="chat-message">
                 <ul class="chat">
                   <?php  $conn = new mysqli(DB_SERVERNAME, DB_USER, DB_PASS, DB_NAME);
               $message_content_query = " SELECT * FROM chat ORDER BY `message_time` ASC;";
               $message_content_result = mysqli_query($conn, $message_content_query);

                $message_content = mysqli_fetch_all($message_content_result);
                $message_contentArr = mysqli_fetch_array($message_content_result);
                $message_writer_id = $message_contentArr['message_writer_id'];
                ?>
                 <?php foreach ($message_content as $message_content => $value) :?>
                   <li class="left clearfix">
                    <span class="chat-img pull-left">
                      <img src="<?php echo profile_avatar($profile_id); ?>" alt="chat_pic" width="60px" height="60px">
                    </span>
                    <div class="chat-body clearfix">
                      <div class="header">
                        <strong class="primary-font"><?php echo   profile_nick($profile_id); ?></strong>
                        <small class="pull-right text-muted"><i class="fa fa-clock-o"></i><?php echo chat['message_time']; ?></small>
                      </div>
                      <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                      </p>
                    </div>
                   </li>
            <?php endforeach; ?>
                 </ul>
             </div>
             <div class="chat-box bg-white my_chat_box">
             	<div class="input-group">
                <form action="#" method="post">
                  <textarea required type="text" name="new_message" rows="2" cols="90" placeholder="Write a message"></textarea><br />
                  <input type="submit" value="send a message">
                </form>
             	</div>
             </div>
 		        </div>
 	        </div>
        </div>
        <?php
        require 'footer.php';
        ?>
