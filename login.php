<div class="container">
<div class="panel panel-default">
  <form class="form-horizontal" action="login_confirm.php" method="post">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="user_mail">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="inputPassword3" placeholder="password" name="user_pass">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="login_remember"> Remember me
          </label>
          
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">


      <div class="col-sm-offset-2 col-sm-6">
        <!-- <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-primary">
      Register Now!
      </a> -->
      <div class="row" id="signin">


        <div class="col-sm-8">
        <button type="submit" class="btn btn-lg">Sign in</button>
      </div>
    </div>
      <div class="row">
        Not registered yet?
        <a href="#" data-toggle="modal" data-target="#myModal">
      Register Now!
      </a>
      </div>
    </div>
    </div>
  </div>
</div>
  </form>
 </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Register</h4>
</div>
<div class="modal-body">
<?php include 'register.php' ?>
</div>
</div>
</div>
</div>
