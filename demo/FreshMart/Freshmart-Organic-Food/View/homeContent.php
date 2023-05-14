
<!-- Main Content -->
<div id="content" class="site-content">
	<!-- Slideshow -->
	<div class="section slideshow">
		<div class="tiva-slideshow-wrapper">
			<div id="tiva-slideshow" class="nivoSlider">
				<a href="#">
					<img class="img-responsive" src="./View/img/slideshow/home3-slideshow-1.jpg" alt="Slideshow Image">
				</a>
				<a href="#">
					<img class="img-responsive" src="./View/img/slideshow/home3-slideshow-2.jpg" alt="Slideshow Image">
				</a>
				<a href="#">
					<img class="img-responsive" src="./View/img/slideshow/home3-slideshow-3.jpg" alt="Slideshow Image">
				</a>
			</div>
		</div>
	</div>


	<!-- Product - New Arrivals -->
	<div class="section products-block product-tab tab-2">
		<div class="block-title">
			<h2 class="title">Sản phẩm <span>mới nhất</span></h2>
			<div class="sub-title">Lorem ipsum dolor sit amet consectetur adipiscing elit eiusmod tempor</div>
		</div>

		<div class="block-content">
			<div class="container">
				<!-- Tab Navigation -->
				<div class="tab-nav">
					<ul>
						<li class="active">
							<a data-toggle="tab" href="#all-products">
								<img src="./View/img/product/product-category-0.png" alt="All Product">
								<span>Trái cây</span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#vegetables">
								<img src="./View/img/product/product-category-0.png" alt="Vegetables">
								<span>Rau củ</span>
							</a>
						</li>
						<li>
							<a data-toggle="tab" href="#meat">
								<img src="./View/img/product/product-category-5.png" alt="Fruits">
								<span>Thịt</span>
							</a>
						</li>
					</ul>
				</div>

				<!-- Tab Content -->
				<div class="tab-content">
					<!-- All Products -->
					<div role="tabpanel" class="tab-pane fade in active" id="all-products">
							<div class="row">
								<?php
								$product = new product();
								$result = $product->getHomeProduct(0);
								while ($set = $result->fetch()) :
								?>
									<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
										<div class="product-item">
											<div class="product-image">
												<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
													<img class="img-responsive w-50" src="./View/img/product/<?php echo $set['hinh'] ?>">
												</a>
											</div>
											<div class="product-title">
												<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp']?>">
													<?php echo $set['tensp'] ?>
													<?php if($set['soluong'] == 0) : ?>
															<span>(Hết hàng)</span>
															<?php endif?>
												</a>
											</div>

											<div class="product-rating">
												<div class="star on"></div>
												<div class="star on"></div>
												<div class="star on "></div>
												<div class="star on"></div>
												<div class="star"></div>
											</div>

											<div class="product-price">
												<span class="sale-price" style="color:red"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>
												<!-- <span class="base-price">$90.00</span> -->
											</div>

											<div class="product-buttons">
												<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
													<i class="fa fa-shopping-basket" aria-hidden="true"></i>
												</a>

												<a class="add-wishlist" href="index.php?action=productCtrl&act=yeuthich&id=<?php echo $set['masp']?>"">
													<i class="fa fa-heart" aria-hidden="true"></i>
												</a>

												<a class="quickview" href="#">
													<i class="fa fa-eye" aria-hidden="true"></i>
												</a>
											</div>
										</div>
									</div>
								<?php endwhile ?>
							</div>
									<a href="index.php?action=productCtrl&act=allproduct">
										<input class="btn btn-primary" type="button" value="Xem tất cả sản phẩm">
									</a>
					</div>

					<!-- Vegetables -->
					<div role="tabpanel" class="tab-pane fade" id="vegetables">
						<div class="row">
							<?php
								$product = new product();
								$result = $product->getHomeProduct(2);
								while ($set = $result->fetch()) :
						?>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="product-item">
									<div class="product-image">
										<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
											<img class="img-responsive w-50" src="./View/img/product/<?php echo $set['hinh'] ?>">
										</a>
									</div>

									<div class="product-title">
										<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
											<?php echo $set['tensp'] ?>
										</a>
									</div>

									<div class="product-rating">
										<div class="star on"></div>
										<div class="star on"></div>
										<div class="star on "></div>
										<div class="star on"></div>
										<div class="star"></div>
									</div>

									<div class="product-price">
										<span class="sale-price" style="color:red"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>
										<!-- <span class="base-price">$90.00</span> -->
									</div>

									<div class="product-buttons">
										<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
											<i class="fa fa-shopping-basket" aria-hidden="true"></i>
										</a>

										<a class="add-wishlist" href="#">
											<i class="fa fa-heart" aria-hidden="true"></i>
										</a>

										<a class="quickview" href="#">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile ?>
						</div>
						<a href="index.php?action=productCtrl&act=allproduct">
										<input class="btn btn-primary" type="button" value="Xem tất cả sản phẩm">
									</a>
					</div>

					<!-- Bread -->
					<div role="tabpanel" class="tab-pane fade" id="meat">
						<div class="row">
						<?php
						$product = new product();
						$result = $product->getHomeProduct(1);
						while ($set = $result->fetch()) :
						?>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="product-item">
									<div class="product-image">
										<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
											<img class="img-responsive w-50" src="./View/img/product/<?php echo $set['hinh'] ?>">
										</a>
									</div>

									<div class="product-title">
										<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
											<?php echo $set['tensp'] ?>
											<?php if($set['soluong'] == 0) : ?>
															<span>(Hết hàng)</span>
															<?php endif?>
										</a>
									</div>

									<div class="product-rating">
										<div class="star on"></div>
										<div class="star on"></div>
										<div class="star on "></div>
										<div class="star on"></div>
										<div class="star"></div>
									</div>

									<div class="product-price">
										<span class="sale-price" style="color:red"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>
										<!-- <span class="base-price">$90.00</span> -->
									</div>

									<div class="product-buttons">
										<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
											<i class="fa fa-shopping-basket" aria-hidden="true"></i>
										</a>

										<a class="add-wishlist" href="#">
											<i class="fa fa-heart" aria-hidden="true"></i>
										</a>

										<a class="quickview" href="#">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile ?>
						</div>
						<a href="index.php?action=productCtrl&act=allproduct">
										<input class="btn btn-primary" type="button" value="Xem tất cả sản phẩm">
									</a>
					</div>

				</div>
			</div>
		</div>
	</div>


	<!-- Intro -->
	<div class="section intro">
		<div class="block-content">
			<div class="container">
				<div class="intro-content">
					<div class="row">
						<div class="title">Tại sao bạn nên chọn Fresh Mart</div>
						<div class="col-lg-6 col-md-6 col-xs-6 item up-left">
							<h4>100% thực phẩm tự nhiên</h4>
							<p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-6 item up-right">
							<h4>Sản phẩm tươi sạch</h4>
							<p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-6 item down-left">
							<h4>Chất lượng đảm bảo</h4>
							<p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
						<div class="col-lg-6 col-md-6 col-xs-6 item down-right">
							<h4>Tốt cho sức khỏe</h4>
							<p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Product -->
	<div class="two-column">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="section products-block category-double no-border">
					<div class="block-title">
						<h2 class="title">Sản phẩm <span>nổi bật</span></h2>
						<div class="sub-title">Lorem ipsum dolor sit amet consectetur adipiscing</div>
					</div>

					<div class="block-content">
						<div class="products owl-theme owl-carousel">
							<?php 
							$featued = new product();
							$result = $featued-> getHomeProduct(2);
							while($set = $result ->fetch()):
							?>
							<div class="product-item">
								<div class="product-image">
									<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
										<img src="./View/img/product/<?php echo $set['hinh']?>" alt="Product Image">
									</a>
								</div>

								<div class="product-title">
									<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
									<?php echo $set['tensp']?>
									<?php if($set['soluong'] == 0) : ?>
															<span>(Hết hàng)</span>
															<?php endif?>
									</a>
								</div>

								<div class="product-rating">
									<div class="star on"></div>
									<div class="star on"></div>
									<div class="star on "></div>
									<div class="star on"></div>
									<div class="star"></div>
								</div>

								<div class="product-price">
									<span class="sale-price"><?php echo number_format($set['dongia'])?><sup>đ</sup></span>
								</div>

								<div class="product-buttons">
									<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
										<i class="fa fa-shopping-basket" aria-hidden="true"></i>
									</a>

									<a class="add-wishlist" href="#">
										<i class="fa fa-heart" aria-hidden="true"></i>
									</a>

									<a class="quickview" href="#">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							<?php endwhile?>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="section products-block category-double no-border">
					<div class="block-title">
						<h2 class="title">Sản phẩm <span>giảm giá</span></h2>
						<div class="sub-title">Lorem ipsum dolor sit amet consectetur adipiscing</div>
					</div>

					<div class="block-content">
						<div class="products owl-theme owl-carousel">
							<?php
							$seller = new product();
							$result = $seller-> getHomeProduct(0);
							while($set = $result->fetch()):
							?>
							<div class="product-item">
								<div class="product-image">
									<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
										<img src="./View/img/product/<?php echo $set['hinh']?>" alt="Product Image">
									</a>
								</div>

								<div class="product-title">
									<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
									<?php echo $set['tensp']?>
									<?php if($set['soluong'] == 0) : ?>
															<span>(Hết hàng)</span>
															<?php endif?>
									</a>
								</div>

								<div class="product-rating">
									<div class="star on"></div>
									<div class="star on"></div>
									<div class="star on "></div>
									<div class="star on"></div>
									<div class="star"></div>
								</div>

								<div class="product-price">
									<span class="sale-price"><?php echo number_format($set['dongia']-100000)?></span>
									<span class="base-price"><?php echo number_format($set['dongia'])?></span>
								</div>

								<div class="product-buttons">
									<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
										<i class="fa fa-shopping-basket" aria-hidden="true"></i>
									</a>

									<a class="add-wishlist" href="#">
										<i class="fa fa-heart" aria-hidden="true"></i>
									</a>

									<a class="quickview" href="#">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>
								</div>
							</div>
							<?php endwhile?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Banners -->
	<div class="section banners">
		<div class="row margin-0">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-0">
				<div class="banner-item">
					<div class="text">
						<h3>Tomato and Pepper</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
						<a class="button" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>SHOP NOW</a>
					</div>
					<div class="image-mask"></div>
					<img class="img-responsive" src="./View/img/banner/home3-banner-1.jpg" alt="Banner">
				</div>
			</div>

			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding-0">
				<div class="row margin-0">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-0">
						<div class="banner-item">
							<div class="text">
								<h3>Tomato and Pepper</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
								<a class="button" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>SHOP NOW</a>
							</div>
							<div class="image-mask"></div>
							<img class="img-responsive" src="./View/img/banner/home3-banner-2.jpg" alt="Banner">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-0">
						<div class="banner-item">
							<div class="text">
								<h3>Tomato and Pepper</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
								<a class="button" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>SHOP NOW</a>
							</div>
							<div class="image-mask"></div>
							<img class="img-responsive" src="./View/img/banner/home3-banner-3.jpg" alt="Banner">
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-0">
						<div class="banner-item">
							<div class="text">
								<h3>Tomato and Pepper</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
								<a class="button" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>SHOP NOW</a>
							</div>
							<div class="image-mask"></div>
							<img class="img-responsive" src="./View/img/banner/home3-banner-4.jpg" alt="Banner">
						</div>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-0">
						<div class="banner-item">
							<div class="text">
								<h3>Tomato and Pepper</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
								<a class="button" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>SHOP NOW</a>
							</div>
							<div class="image-mask"></div>
							<img class="img-responsive" src="./View/img/banner/home3-banner-5.jpg" alt="Banner">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Latest News -->
	<div class="section latest-news layout-2">
		<div class="block-title">
			<h2 class="title">Our <span>Blog</span></h2>
			<div class="sub-title">Lorem ipsum dolor sit amet consectetur</div>
		</div>

		<div class="block-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="blog-item">
							<div class="blog-image">
								<a href="blog.php" class="zoom-effect">
									<img src="./View/img/blog/blog-1.jpg" alt="Blog Image">
								</a>
							</div>
							<div class="blog-info">
								<div class="blog-time">
									<span><i class="zmdi zmdi-comments"></i>13 comment</span>
									<span><i class="zmdi zmdi-calendar-note"></i>20 APRIl 2017</span>
								</div>
								<div class="blog-title"><a href="blog.php">5 Best fruits to make you fresh and healthy</a></div>
								<div class="blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy...</div>
								<div class="readmore"><a href="blog.php">Read more</a></div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="blog-item">
							<div class="blog-image">
								<a href="blog.php" class="zoom-effect">
									<img src="./View/img/blog/blog-2.jpg" alt="Blog Image">
								</a>
							</div>
							<div class="blog-info">
								<div class="blog-time">
									<span><i class="zmdi zmdi-comments"></i>13 comment</span>
									<span><i class="zmdi zmdi-calendar-note"></i>20 APRIl 2017</span>
								</div>
								<div class="blog-title"><a href="blog.php">5 Best fruits to make you fresh and healthy</a></div>
								<div class="blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy...</div>
								<div class="readmore"><a href="blog.php">Read more</a></div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="blog-item">
							<div class="blog-image">
								<a href="blog.php" class="zoom-effect">
									<img src="./View/img/blog/blog-3.jpg" alt="Blog Image">
								</a>
							</div>
							<div class="blog-info">
								<div class="blog-time">
									<span><i class="zmdi zmdi-comments"></i>13 comment</span>
									<span><i class="zmdi zmdi-calendar-note"></i>20 APRIl 2017</span>
								</div>
								<div class="blog-title"><a href="blog.php">5 Best fruits to make you fresh and healthy</a></div>
								<div class="blog-desc">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy...</div>
								<div class="readmore"><a href="blog.php">Read more</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Testimonial -->
	<div class="section testimonial layout-2">
		<div class="container">
			<div class="row">
				<div class="testimonial-wrap owl-theme owl-carousel">
					<div class="item">
						<div class="image"><img src="./View/img/testimonial-1.png" alt=""></div>
						<div class="content"><i class="fa fa-quote-left" aria-hidden="true"></i> Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.”</div>
						<div class="name">WILLIAM JAMES</div>
						<div class="job">Hairstyle</div>
					</div>

					<div class="item">
						<div class="image"><img src="./View/img/testimonial-2.png" alt=""></div>
						<div class="content"><i class="fa fa-quote-left" aria-hidden="true"></i> Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.”</div>
						<div class="name">WILLIAM JAMES</div>
						<div class="job">Hairstyle</div>
					</div>

					<div class="item">
						<div class="image"><img src="./View/img/testimonial-3.png" alt=""></div>
						<div class="content"><i class="fa fa-quote-left" aria-hidden="true"></i> Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.”</div>
						<div class="name">WILLIAM JAMES</div>
						<div class="job">Hairstyle</div>
					</div>

					<div class="item">
						<div class="image"><img src="./View/img/testimonial-2.png" alt=""></div>
						<div class="content"><i class="fa fa-quote-left" aria-hidden="true"></i> Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.”</div>
						<div class="name">WILLIAM JAMES</div>
						<div class="job">Hairstyle</div>
					</div>

					<div class="item">
						<div class="image"><img src="./View/img/testimonial-1.png" alt=""></div>
						<div class="content"><i class="fa fa-quote-left" aria-hidden="true"></i> Proin gravida nibh vel velit auctor aliquet. Aenean sollicudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.”</div>
						<div class="name">WILLIAM JAMES</div>
						<div class="job">Hairstyle</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Footer -->