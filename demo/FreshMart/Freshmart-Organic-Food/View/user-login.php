
			<!-- Main Content -->
			<div id="content" class="site-content">
				<!-- Breadcrumb -->
				<div id="breadcrumb">
					<div class="container">
						<h2 class="title">Login</h2>
						
						<ul class="breadcrumb">
							<li><a href="#" title="Home">Home</a></li>
							<li><span>Login</span></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="login-page">
						<div class="login-form form">
							<div class="block-title">
								<h2 class="title"><span>Login</span></h2>
							</div>
			
						
							<form action="index.php?action=user&act=login_act" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label>Email</label>
									<input type="text" value="<?php if(isset($_POST['email']))
									{ echo $_POST['email'] ;}
									?>" name="email">
									<span style="font-weight: 500;color:red;"><?php if(isset($_GET['act']) && $_GET['act'] == 'login_act' )
									echo $_SESSION['emailLogin']
									?></span>
								</div>
								
								<div class="form-group">
									<label>Password</label>
									<input type="text" value="<?php if(isset($_POST['password']))
									{ echo $_POST['password'] ;}
									?>" name="password">
									<span style="font-weight: 500;color:red;"><?php if(isset($_GET['act']) && $_GET['act'] == 'login_act')
									echo $_SESSION['passwordLogin']
									?></span>
								</div>
								
								<div class="form-group text-center">
									<div class="link">
										<a  href="index.php?action=forgets&act=forgetpw">Forgot your password?</a> 
										<a href="index.php?action=user&act=register">Register?</a>
									</div>
								</div>
								
								<div class="form-group text-center">
									<input name="submit" type="submit" class="btn btn-primary" value="Sign In">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			<!-- Footer -->
