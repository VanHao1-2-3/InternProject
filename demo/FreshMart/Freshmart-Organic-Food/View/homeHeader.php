
<!-- Header -->
<header id="header">
	<div class="container">
		<div class="header-top">
			<div class="row align-items-center">
				<!-- Header Left -->
				<div class="col-lg-5 col-md-5 col-sm-12">
					<!-- Main Menu -->
					<div id="main-menu">
						<ul class="menu">
							<li><a href="./" title="Homepage">Home</a></li>
							<li class="dropdown">
								<a  href="index.php?action=productCtrl&act=allproduct" title="Product">Product</a>
								<div class="dropdown-menu">
									<ul>
									<?php 
									$type = new product();
									$result = $type -> getTypeProduct();
									while($set = $result -> fetch()):
									?>
										<li class="dropdown-submenu">
												<a href="index.php?action=productCtrl&act=type&type=<?php echo $set['maloai']?>"><?php echo $set['loaisp']?></a>
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
											<a  href="index.php?action=productCtrl&act=allproduct" title="Product List">Product List</a>
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
													<li><a  href="index.php?action=user&act=login" title="Login">Login</a></li>
													<?php if(isset($_SESSION['makh'])): ?>
													<li><a  href="index.php?action=user&act=changepass" title="Login">Change password</a></li>
													<?php endif?>
													<li><a  href="index.php?action=user&act=register" title="Register">Register</a></li>
													<li><a  href="View/#" title="My Account">My Account</a></li>
													<li><a  href="index.php?action=wishlist" title="My Wishlists">My Wishlists</a></li>
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
				</div>

				<!-- Header Center -->
				<div class="col-lg-2 col-md-2 col-sm-12 header-center justify-content-center">
					<!-- Logo -->
					<div class="logo">
						<a href="./">
							<img class="img-responsive" src="./View/img/logo.png" alt="Logo">
						</a>
					</div>

					<span id="toggle-mobile-menu"><i class="zmdi zmdi-menu"></i></span>
				</div>


				<!-- Header Right -->
				<div class="col-lg-5 col-md-5 col-sm-12 header-right d-flex justify-content-end align-items-center">
					<!-- Search -->
					<div class="form-search">
						<form action="index.php?action=productCtrl&act=search" method="post">
							<input type="text" class="form-input" placeholder="Search" name="txtsearch">
							<button type="submit" class="fa fa-search"></button>
						</form>
					</div>

					<!-- Cart -->
					<div class="block-cart dropdown">
						<div class="cart-title">
							<a href="index.php?action=productCtrl&act=cart"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
							<?php if(isset($_SESSION['cartTemplate']) && count($_SESSION['cartTemplate']) > 0):
							$count = count($_SESSION['cartTemplate']);
							?>
							<span class="cart-count">
								<?php echo $count?>
							</span>
							<?php else:?>
								<span class="cart-count">
								0
							</span>
							<?php endif?>
						</div>

						<div class="dropdown-content">
							<div class="cart-content">
								<table>
									<tbody>
										<?php 
									$tongtien = 0;
										if(isset($_SESSION['cartTemplate'])):
											foreach($_SESSION['cartTemplate'] as $item):
												$tongtien += $item['tongtien'];
										?>
										<tr>
											<td class="product-image">
												<a href="View/product-detail.php">
													<img src="./View/img/product/<?php echo $item['hinh']?>" alt="Product">
												</a>
											</td>
											<td>
												<div class="product-name">
													<a href="index.php?action=productCtrl&act=detail&id=<?php echo $item['masp'] ?>"><?php echo $item['tensp']?></a>
												</div>
												<div>
												<?php echo $item['soluong']?> x <span class="product-price"><?php echo number_format($item['dongia'])?></span>
												</div>
											</td>
											<td class="action">
												<a class="remove" href="index.php?action=cart&act=delete&id=<?php echo $item['masp']?>">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<?php 
									 endforeach; endif?>
										
										<tr class="total">
											<td>Total:</td>
											<td colspan="2"><?php echo number_format($tongtien)?> <sup>đ</sup></td>
										</tr>

										<tr>
											<td colspan="3">
												<div class="cart-button">
													<a class="btn btn-primary"  title="View Cart" href="index.php?action=cart">View Cart</a>
													<a class="btn btn-primary" href="index.php?action=bill" title="Checkout">Checkout</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>


					<!-- My Account -->
					<div class="my-account dropdown toggle-icon">
						<div class="dropdown-toggle" data-toggle="dropdown">
							<i class="zmdi zmdi-menu"></i>
						</div>
						<div class="dropdown-menu">
							<div class="item">
								<?php 
								if(isset($_SESSION['makh'])):
									$name = $_SESSION['tenkh'];
								?>
								<a href="View/#" title="Log in to your customer account"><i class="fa fa-cog"></i><?php echo $name?></a>
								<?php else:?>
								<a href="View/#" title="Log in to your customer account"><i class="fa fa-cog"></i>My Account</a>
								<?php endif?>
							</div>
							<div class="item">
								<?php 
								if(isset($_SESSION['makh'])):
								?>
								<a href="index.php?action=user&act=logout" title="Log in to your customer account"><i class="fa fa-sign-in"></i>Logout</a>
								<?php else:?>
								<a href="index.php?action=user&act=login" title="Log in to your customer account"><i class="fa fa-sign-in"></i>Login</a>
								<?php endif ?>
							</div>
							<div class="item">
								<a href="View/user-register.php" title="Register Account"><i class="fa fa-user"></i>Register</a>
							</div>
							<div class="item">
								<a href="View/#" title="My Wishlists"><i class="fa fa-heart"></i>My Wishlists</a>
							</div>
							<div class="item">
								<!-- Language -->
								<div class="language switcher">
									<a href="View/#" title="Language English" class="active"><img src="./View/img/language-en.jpg" alt="Language English"></a>
									<a href="View/#" title="Language French"><img src="./View/img/language-fr.jpg" alt="Language French"></a>
									<a href="View/#" title="Language Deutsch"><img src="./View/img/language-de.jpg" alt="Language Deutsch"></a>
								</div>

								<!-- Currency -->
								<div class="currency switcher">
									<a href="View/#" title="USD" class="active">USD</a>
									<a href="View/#" title="EUR">EUR</a>
									<a href="View/#" title="GBP">GBP</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
