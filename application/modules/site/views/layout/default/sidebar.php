		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img alt="image" height="170" width="170" src="<?=$assets_path.'site/img/logo.jpg'; ?>"/>
                            <a href="#">
                                <span class="block m-t-xs font-bold"><?= $this->session->userdata('profile')['fullname']?></span>
                                <span class="text-muted text-xs block"><?= $this->session->userdata('user_role')['description']?></span>
                            </a>
                        </div>
                        <div class="logo-element">
                            BPv3
                        </div>
                    </li>
					<?= $menu?>
                </ul>
            </div>
        </nav>
		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <span class="navbar-minimalize minimalize-styl-2">Welcome to <strong><?= $this->config->item('site')['system_name']?></strong>.</span>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="<?= base_url('auth/logout')?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            