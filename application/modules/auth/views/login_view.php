	<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img alt="image" height="170" width="170" src="<?=$assets_path.'site/img/logo.jpg'; ?>"/>
            </div>
            <h3>Welcome to <?= $this->config->item('site')['system_name']?></h3>
			<div class="m-t">
				<div class="form-group">
					<input type="email" class="form-control" id="username" placeholder="Username" required="">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="password" placeholder="Password" required="">
				</div>
				<div class="form-group">
					<span id="error-message" style="color:red;"></span>
				</div>
			</div>
			
			<button id="btn-login" class="btn btn-primary block full-width m-b">Login</button>
            <p class="m-t"> <small>Powered by: <?= $this->config->item('site')['powered_by']?></small> </p>
        </div>
    </div>