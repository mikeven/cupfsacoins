<style>
	.panel-heading-icon_p{
		margin: 0 auto;
	    font-size: 18px;
	    /*font-size: 0.9rem;*/
	    width: 80px;
	    height: auto;
	    line-height: 12px;
	    text-align: center;
	    color: #fff;
	    background-color: rgba(0, 0, 0, 0.1);
	}

	#userbox .dropdown-menu{
		background-color: #333;
	}
</style>
<?php
	$coins_usuario = obtenerCoinsUsuario( $dbh, $_SESSION["user"]["idUSUARIO"] );
?>
<!-- start: header -->
<header class="header">
	<div class="logo-container">
		<a href="../" class="logo">
			<img src="assets/images/logo_cupsfa.png" height="35" alt="JSOFT Admin" />
		</a>
		<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<!-- start: search & user box -->
	<div class="header-right">

		<form action="pages-search-results.html" class="search nav-form hidden">
			<div class="input-group input-search">
				<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form>

		<span class="separator hidden"></span>

		<ul class="notifications hidden">
			<li>
				<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
					<i class="fa fa-tasks"></i>
					<span class="badge">3</span>
				</a>

				<div class="dropdown-menu notification-menu large">
					<div class="notification-title">
						<span class="pull-right label label-default">3</span>
						Tasks
					</div>

					<div class="content">
						<ul>
							<li>
								<p class="clearfix mb-xs">
									<span class="message pull-left">Generating Sales Report</span>
									<span class="message pull-right text-dark">60%</span>
								</p>
								<div class="progress progress-xs light">
									<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
								</div>
							</li>

							<li>
								<p class="clearfix mb-xs">
									<span class="message pull-left">Importing Contacts</span>
									<span class="message pull-right text-dark">98%</span>
								</p>
								<div class="progress progress-xs light">
									<div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
								</div>
							</li>

							<li>
								<p class="clearfix mb-xs">
									<span class="message pull-left">Uploading something big</span>
									<span class="message pull-right text-dark">33%</span>
								</p>
								<div class="progress progress-xs light mb-xs">
									<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</li>
			<li>
				<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
					<i class="fa fa-envelope"></i>
					<span class="badge">4</span>
				</a>

				<div class="dropdown-menu notification-menu">
					<div class="notification-title">
						<span class="pull-right label label-default">230</span>
						Messages
					</div>

					<div class="content">
						<ul>
							<li>
								<a href="#" class="clearfix">
									<figure class="image">
										<img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />
									</figure>
									<span class="title">Joseph Doe</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<figure class="image">
										<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
									</figure>
									<span class="title">Joseph Junior</span>
									<span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<figure class="image">
										<img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />
									</figure>
									<span class="title">Joe Junior</span>
									<span class="message">Lorem ipsum dolor sit.</span>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<figure class="image">
										<img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />
									</figure>
									<span class="title">Joseph Junior</span>
									<span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>
								</a>
							</li>
						</ul>

						<hr />

						<div class="text-right">
							<a href="#" class="view-more">View All</a>
						</div>
					</div>
				</div>
			</li>
			<li>
				<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
					<i class="fa fa-bell"></i>
					<span class="badge">3</span>
				</a>

				<div class="dropdown-menu notification-menu">
					<div class="notification-title">
						<span class="pull-right label label-default">3</span>
						Alerts
					</div>

					<div class="content">
						<ul>
							<li>
								<a href="#" class="clearfix">
									<div class="image">
										<i class="fa fa-thumbs-down bg-danger"></i>
									</div>
									<span class="title">Server is Down!</span>
									<span class="message">Just now</span>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<div class="image">
										<i class="fa fa-lock bg-warning"></i>
									</div>
									<span class="title">User Locked</span>
									<span class="message">15 minutes ago</span>
								</a>
							</li>
							<li>
								<a href="#" class="clearfix">
									<div class="image">
										<i class="fa fa-signal bg-success"></i>
									</div>
									<span class="title">Connection Restaured</span>
									<span class="message">10/10/2014</span>
								</a>
							</li>
						</ul>

						<hr />

						<div class="text-right">
							<a href="#" class="view-more">View All</a>
						</div>
					</div>
				</div>
			</li>
		</ul>

		<span class="separator"></span>

		<div id="userbox" class="userbox">
			<a href="#" data-toggle="dropdown">
				
				<div class="profile-info" 
				data-lock-name="<?php echo $_SESSION["user"]["nombre"] ?>" 
				data-lock-email="<?php echo $_SESSION["user"]["email"] ?>">
					<span class="name"><?php echo $_SESSION["user"]["nombre"] ?></span>
					<span class="role"><?php echo hrolesUsuario( $accesos_usess["roles"] )?>
					</span>
				</div>
				<figure class="profile-picture">
					<div class="panel-heading-icon_p">
						<div style="margin-top: 10px;"><?php echo $coins_usuario ?></div>
						<div style="font-size: 10px; margin-bottom: 5px;">coins</div>
					</div>
				</figure>

				<i class="fa custom-caret"></i>
			</a>

			<div class="dropdown-menu">
				<ul class="list-unstyled">
					<li class="divider"></li>
					
					<li>
						<a role="menuitem" tabindex="-1" href="inicio.php?logout"><i class="fa fa-power-off"></i> Salir</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- end: search & user box -->
</header>
<!-- end: header -->