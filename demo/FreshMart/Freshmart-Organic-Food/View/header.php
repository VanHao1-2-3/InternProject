<!-- Header -->
<header id="header">
	<!-- Topbar -->
	<div class="topbar">
		<!-- Close Topbar -->
		<div class="close-topbar">
			<i class="zmdi zmdi-close"></i>
		</div>
		<!-- Topbar Content -->
		<div class="container topbar-content">
			<div class="row">
				<!-- Topbar Left -->
				<div class="col-md-7 col-sm-7 col-xs-12">
					<div class="topbar-left d-flex">
						<div class="email">
							<i class="fa fa-envelope" aria-hidden="true"></i>Email: tivatheme@gmail.com
						</div>
						<div class="skype">
							<i class="fa fa-skype" aria-hidden="true"></i>Skype: tivatheme
						</div>
					</div>
				</div>

				<!-- Topbar Right -->
				<div class="col-md-5 col-sm-5 col-xs-12">
					<div class="topbar-right d-flex justify-content-end">
						<!-- My Account -->
						<div class="dropdown account">
							<div class="dropdown-toggle" data-toggle="dropdown">
								My Account
							</div>
							<div class="dropdown-menu">
								<div class="item">
									<a href="#" title="Log in to your customer account"><i class="fa fa-cog"></i>My Account</a>
								</div>
								<div class="item">
									<a href="user-login.php" title="Log in to your customer account"><i class="fa fa-sign-in"></i>Login</a>
								</div>
								<div class="item">
									<a href="user-register.php" title="Register Account"><i class="fa fa-user"></i>Register</a>
								</div>
								<div class="item">
									<a href="#" title="My Wishlists"><i class="fa fa-heart"></i>My Wishlists</a>
								</div>
							</div>
						</div>

						<!-- Language -->
						<div class="dropdown language">
							<div class="dropdown-toggle" data-toggle="dropdown">
								<img src="img/language-en.jpg" alt="Language English">
							</div>
							<div class="dropdown-menu">
								<div class="item">
									<a href="#" title="Language English"><img src="img/language-en.jpg" alt="Language English"> English</a>
								</div>
								<div class="item">
									<a href="#" title="Language French"><img src="img/language-fr.jpg" alt="Language French"> French</a>
								</div>
							</div>
						</div>

						<!-- Currency -->
						<div class="dropdown currency">
							<div class="dropdown-toggle" data-toggle="dropdown">
								USD
							</div>
							<div class="dropdown-menu">
								<div class="item">
									<a href="#" title="USD">USD</a>
								</div>
								<div class="item">
									<a href="#" title="EUR">EUR</a>
								</div>
								<div class="item">
									<a href="#" title="GBP">GBP</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Open Topbar -->
		<div class="container active">
			<div id="toggle-topbar"><i class="zmdi zmdi-plus"></i></div>
		</div>
	</div>

	<!-- Header Top -->
	<div class="header-top">
		<div class="container">
			<div class="row">
				<!-- Search -->
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="form-search">
						<form action="index.php?action=productCtrl&act=search" method="post">
							<input type="text" class="form-input" placeholder="Search" name="txtsearch">
							<button type="submit" class="fa fa-search"></button>
						</form>
					</div>
				</div>

				<!-- Logo -->
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="logo">
						<a href="../">
							<img class="img-responsive" src="./View/img/logo.png" alt="Logo">
						</a>
					</div>

					<span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
				</div>

				<!-- Cart -->
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="block-cart dropdown">
						<div class="cart-title">
							<a href="index.php?action=productCtrl&act=cart"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
							<?php if (isset($_SESSION['cartTemplate']) && count($_SESSION['cartTemplate']) > 0) :
								$count = count($_SESSION['cartTemplate']);
							?>
								<span class="cart-count">
									<?php echo $count ?>
								</span>
							<?php else : ?>
								<span class="cart-count">
									0
								</span>
							<?php endif ?>
						</div>

						<div class="dropdown-content">
							<div class="cart-content">
								<table>
									<tbody>
										<?php
										$tongtien = 0;
										if (isset($_SESSION['cartTemplate'])) :
											foreach ($_SESSION['cartTemplate'] as $item) :
												$tongtien += $item['tongtien'];
										?>
												<tr>
													<td class="product-image">
														<a href="View/product-detail.php">
															<img src="./View/img/product/<?php echo $item['hinh'] ?>" alt="Product">
														</a>
													</td>
													<td>
														<div class="product-name">
															<a href="index.php?action=productCtrl&act=detail&id=<?php echo $item['masp'] ?>"><?php echo $item['tensp'] ?></a>
														</div>
														<div>
															<?php echo $item['soluong'] ?> x <span class="product-price"><?php echo number_format($item['dongia']) ?></span>
														</div>
													</td>
													<td class="action">
														<a class="remove" href="index.php?action=cart&act=delete&id=<?php echo $item['masp'] ?>">
															<i class="fa fa-trash-o" aria-hidden="true"></i>
														</a>
													</td>
												</tr>
										<?php
											endforeach;
										endif ?>

										<tr class="total">
											<td>Total:</td>
											<td colspan="2"><?php echo number_format($tongtien) ?> <sup>đ</sup></td>
										</tr>

										<tr>
											<td colspan="3">
												<div class="cart-button">
													<a class="btn btn-primary" title="View Cart" href="index.php?action=cart">View Cart</a>
													<a class="btn btn-primary" href="index.php?action=bill" title="Checkout">Checkout</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- Main Menu -->
	<div id="main-menu">
		<ul class="menu">
			<li><a href="./" title="Homepage">Home</a></li>

			<li class="dropdown">
				<a href="index.php?action=productCtrl&act=allproduct" title="Product">Product</a>
				<div class="dropdown-menu">
					<ul>
						<?php
						$type = new product();
						$result = $type->getTypeProduct();
						while ($set = $result->fetch()) :
						?>
							<li class="dropdown-submenu">
								<a href="index.php?action=productCtrl&act=type&type=<?php echo $set['maloai'] ?>"><?php echo $set['loaisp'] ?></a>
							</li>
						<?php endwhile ?>
					</ul>
				</div>
			</li>


			<li class="dropdown">
				<a href="View/#" title="Page">Page</a>
				<div class="dropdown-menu">
					<ul>
						<li class="dropdown-submenu">
							<a href="index.php?action=productCtrl&act=allproduct" title="Product List">Product List</a>
						</li>

						<li>
							<a href="index.php?action=productCtrl&act=cart" title="Cart">Cart</a>
						</li>
						<li>
							<a href="index.php?action=user&act=checkout" title="Checkout">Checkout</a>
						</li>
						<li class="dropdown-submenu">
							<a href="View/#" title="User">User</a>
							<div class="dropdown-menu level2">
								<ul>
									<li><a href="index.php?action=user&act=login" title="Login">Login</a></li>
									<li><a href="index.php?action=user&act=register" title="Register">Register</a></li>
									<?php if (isset($_SESSION['makh'])) : ?>
										<li><a href="index.php?action=user&act=changepass" title="Login">Change password</a></li>
									<?php endif ?>
									<li><a href="View/#" title="My Account">My Account</a></li>
									<li><a href="index.php?action=wishlist" title="My Wishlists">My Wishlists</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="View/page-404.php" title="Page 404">Page 404</a>
						</li>
					</ul>
				</div>
			</li>

			<li class="dropdown">
				<a href="View/blog.php">Blog</a>
			</li>

			<li>
				<a href="View/page-about-us.php">About Us</a>
			</li>

			<li>
				<a href="View/page-contact.php">Contact</a>
			</li>
		</ul>
	</div>
</header>