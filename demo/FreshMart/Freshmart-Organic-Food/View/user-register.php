<!-- Main Content -->
<div id="content" class="site-content">
	<!-- Breadcrumb -->
	<div id="breadcrumb">
		<div class="container">
			<h2 class="title">Create Account</h2>

			<ul class="breadcrumb">
				<li><a href="index.php" title="Home">Home</a></li>
				<li><span>Create Account</span></li>
			</ul>
		</div>
	</div>

	<?php

	?>
	<div class="container">
		<div class="register-page">
			<div class="register-form form">
				<div class="block-title">
					<h2 class="title"><span>Create Account </span></h2>
				</div>

				<form action="index.php?action=user&act=register_act" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Username</label>
						<input type="text" value="<?php if (isset($_POST['username'])) {
																echo $_POST['username'];
															} ?>"" name=" username" />
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['usnameErr'] ?></span>
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" value="<?php if (isset($_POST['address'])) {
																echo $_POST['address'];
															} ?>" name="address">
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['addressErr'] ?></span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" value="<?php if (isset($_POST['email'])) {
																echo $_POST['email'];
															} ?>" name="email">
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['emailErr'] ?></span>
					</div>
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" value="<?php if (isset($_POST['phone'])) {
																echo $_POST['phone'];
															} ?>" name="phone">
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['phoneErr'] ?></span>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input type="text" value="<?php if (isset($_POST['password'])) {
																echo $_POST['password'];
															} ?>" name="password">
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['passErr'] ?></span>
					</div>
					<div class="form-group">
						<label>Password Confirm</label>
						<input type="password" value="<?php if (isset($_POST['password2'])) {
																	echo $_POST['password2'];
																} ?>" name="password2">
						<span style="font-weight: 600; color:red;"><?php if (isset($_GET['act']) && $_GET['act'] == "register_act") echo $_SESSION['confirmPassErr'] ?></span>
					</div>
					<div class="form-group text-center">
						<input name="submit" type="submit" class="btn btn-primary" value="Create Account">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>