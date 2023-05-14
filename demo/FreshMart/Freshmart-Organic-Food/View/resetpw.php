
			<!-- Main Content -->
			<div id="content" class="site-content">
				<!-- Breadcrumb -->
				<div id="breadcrumb">
					<div class="container">
						<h2 class="title">Login</h2>
						
						<ul class="breadcrumb">
							<li><a href="index.php?action=homeCtrl" title="Home">Home</a></li>
							<li><span>Reset password</span></li>
						</ul>
					</div>
				</div>
				<div class="container">
					<div class="login-page">
						<div class="login-form form">
							<div class="block-title">
								<h2 class="title"><span>Reset password</span></h2>
							</div>
							<form action="index.php?action=forgets&act=resetpw" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label>Enter code</label>
									<input type="text" value="" name="code">
									<span style="font-weight: 500;color:red;"></span>
								</div>
								<div class="form-group text-center">
									<input  type="submit" class="btn btn-primary" value="Chang password" name='submitpass'>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>


			<!-- Footer -->
