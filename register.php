

		<div class="row">
			<div class="panel">
				<div class="panel-body">
          <!-- registration form -->
					<div class="regMain">

					<form  action="registration.php" method="post" id="register">
						<div class="form-group">
							<h2 id="account">Create an account</h2>
						</div>
            <!-- Nickname -->
						<div class="form-group">
							<label class="control-label" for="signupNick">Nickname:</label>
							<input required name="reg_nick" id="signupNick" type="text" maxlength="50" class="form-control" data-toggle="tooltip" data-placement="right" title="This name will be displayed">
						</div>
						<!-- Motto -->
						<div class="form-group" name="signup_motto">
							<label class="control-label" for="signup_motto">Motto</label>
							<input  id="signup_motto" name ="signup_motto" type="text" maxlength="50" class="form-control" value="i'm A Noob" >
						</div>
            <!-- Gender -->
            <div class="form-group">
							<label class="control-label" for="signupNick">Gender</label>

              <div class="radio">

                <label><input required type="radio" name="reg_gender" value="m">Male</label>
              </div>
              <div class="radio">
                <label><input required type="radio" name="reg_gender" value="f">Female</label>
              </div>
            </div>
            <!-- email -->
						<div class="form-group">
							<label class="control-label" for="signupEmail">Email:</label>
							<input required name="reg_email" id="signupEmail"  type="email" maxlength="50" class="form-control">

						</div>
            <!-- password -->
						<div class="form-group" name="passwordCheck">
							<label class="control-label" for="signupPassword">Password:</label>
							<input required id="signupPassword" name="reg_pass" type="password" onchange="validatePass()" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40" data-toggle="tooltip" data-placement="right" title="Must contain at least 6 characters">
						</div>
						<div class="form-group" name="passwordCheck">
							<label class="control-label" for="signupPasswordagain">Password again</label>
							<input required id="signupPasswordagain" type="password" maxlength="25" class="form-control" onkeyup="matchPass()" >
							<p class="help-block alert-danger" id="reg_passHelp">
								Passwords do not match!
							</p>
						</div>
						<div class="form-group" name="autoLogin">
							<label class="control-label" for="reg_autoLogin">Login Automatically</label>
							<input id="reg_autoLogin" name="reg_autoLogin" type="checkbox" value="Yes">

						</div>
            <!-- submit -->
						<div class="form-group">
							<button id="signupSubmit" type="submit" class="btn btn-info btn-block">Create your account</button>
						</div>
            <!-- terms of use -->
						<p class="form-group">By creating an account, you agree to our <a href="#">Terms of Use</a> and our <a href="#">Privacy Policy</a>.</p>
						<hr>
					</form>
				</div>
				</div>
			</div>
		</div>
	</div><!-- container end -->
