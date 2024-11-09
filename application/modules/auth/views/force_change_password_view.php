<input type="hidden" id="user_id" value="<?= $this->session->userdata('user_id')?>">
		<div id="wrapper">
			<div class="vertical-align-wrap">
				<div class="vertical-align-middle">
					<div class="auth-box register">
						<div class="content">
							<div class="header">
								<div class="logo text-center">
									<!-- <img src="assets/img/logo-dark.png" alt="Klorofil Logo"> -->
								</div>
								<p class="lead">Change Password</p>
							</div>
							<form class="form-auth-small" id="form_force_change_pass">
								<div class="form-group">
									<label for="signup-password" class="control-label sr-only">New Password</label>
									<input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" required>
                </div>
                <div class="form-group">
									<label for="signup-password" class="control-label sr-only">Repeat New Password</label>
									<input type="password" class="form-control" name="re_new_password" id="re_new_password" placeholder="Repeat New Password" required>
								</div>
								<button id="btn-change-pass" class="btn btn-primary btn-lg btn-block">Submit</button>
              </form>
						</div>
					</div>
				</div>
			</div>
		</div>
		