<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$hh = new product();
	$result = $hh->getDetail($id);
	$tenhh = $result['tensp'];
	$dongia = $result['dongia'];
	$hinh = $result['hinh'];
	$nhom = $result['Nhom'];
	$soluong = $result['soluong'];
	$motasanpham = $result['motasanpham'];
}
?>
<!-- Main Content -->
<div id="content" class="site-content">
	<!-- Breadcrumb -->
	<div id="breadcrumb">
		<div class="container">
			<h2 class="title"><?php echo $tenhh ?></h2>

			<ul class="breadcrumb">
				<li><a href="#" title="Home">Home</a></li>
				<li><a href="#" title="Fruit">Fruit</a></li>
				<li><span>Tomato</span></li>
			</ul>
		</div>
	</div>

	<div class="container">

			<div class="product-detail">
				<div class="products-block layout-5">
					<div class="product-item">
						<div class="product-title">
							
							<?php echo $tenhh ?>
						</div>
						<div class="row">
							<div class="product-left col-md-5 col-sm-5 col-xs-12">
								<div class="product-image vertical">
									<div class="main-image">
										<img class="img-responsive" src="./View/img/product/<?php echo $hinh ?>" alt="Product Image">
									</div>
									<div class="thumb-images">
										<?php
										$result = $hh->getGroupDetail($nhom);
										while ($set = $result->fetch()) :
										?>
											<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
												<img class="img-responsive" src="./View/img/product/<?php echo $set['hinh'] ?>" alt="Product Image">
											</a>
										<?php endwhile ?>
									</div>
								</div>
							</div>

							<div class="product-right col-md-7 col-sm-7 col-xs-12">
								<div class="product-info">
									<div class="product-price">
										<span class="sale-price "><?php echo number_format($dongia) ?><sup>đ</sup></span>
									</div>

									<div class="product-stock">
										<?php if($soluong == 0): ?>
										<span class="text-seccondary" style="text-decoration: line-through;">Availability :<i class="fa-solid fa-xmark"></i>Out Of stock</span>
										<?php else: ?>
										<span class="availability">Availability :</span><i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
									<?php endif?>
									</div>
									<div class="product-short-description">
										<?php echo $motasanpham ?>
									</div>
									<form action="index.php?action=cart&act=cart" method="post">
									<input type="hidden" name="masp" value="<?php echo $id ?>">
										<div class="product-add-to-cart border-bottom">
											<div class="product-quantity">
												<span class="control-label">QTY :</span>
												<div class="qty">
													<div class="input-group">
														<input type="number" name="soluong" value="1" min='1'>
													</div>
												</div>
											</div>
											<div class="product-buttons">
												<?php if($soluong>0): ?>
												<button type="submit" class="btn">Add to cart</button>
												<?php else: ?>
													<input type="button" class="btn" disabled value="Add to cart">
													<?php endif?>
												<a class="add-wishlist" href="#">
													<i class="fa fa-heart" aria-hidden="true"></i>
												</a>
											</div>
											<span style="font-weight: bold;">Hàng có sẵn : <?php echo $soluong?></span>
										</div>
									</form>

									<div class="product-share border-bottom">
										<div class="item">
											<a href="#"><i class="zmdi zmdi-share" aria-hidden="true"></i><span class="text">Share</span></a>
										</div>
										<div class="item">
											<a href="#"><i class="zmdi zmdi-email" aria-hidden="true"></i><span class="text">Send to a friend</span></a>
										</div>
										<div class="item">
											<a href="#"><i class="zmdi zmdi-print" aria-hidden="true"></i><span class="text">Print</span></a>
										</div>
									</div>

									<div class="product-review border-bottom">
										<div class="item">
											<div class="product-quantity">
												<span class="control-label">Review :</span>
												<div class="product-rating">
													<div class="star on"></div>
													<div class="star on"></div>
													<div class="star on"></div>
													<div class="star on"></div>
													<div class="star"></div>
												</div>
											</div>
										</div>

										<div class="item">
											<a href="#"><i class="zmdi zmdi-comments" aria-hidden="true"></i><span class="text">Read Reviews (3)</span></a>
										</div>

										<div class="item">
											<a href="#"><i class="zmdi zmdi-edit" aria-hidden="true"></i><span class="text">Write a review</span></a>
										</div>
									</div>

									<div class="product-extra">
										<div class="item">
											<span class="control-label">Review :</span><span class="control-label">E-02154</span>
										</div>
										<div class="item">
											<span class="control-label">Categories :</span>
											<a href="#" title="Vegetables">Vegetables,</a>
											<a href="#" title="Fruits">Fruits,</a>
											<a href="#" title="Apple">Apple</a>
										</div>
										<div class="item">
											<span class="control-label">Tags :</span>
											<a href="#" title="Vegetables">Hot Trend,</a>
											<a href="#" title="Fruits">Summer</a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="product-tab">
							<!-- Tab Navigation -->
							<form action="">
								<div class="tab-nav">
									<ul>
										<li class="active">
											<a data-toggle="tab" href="#description">
												<span>Description</span>
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#additional-information">
												<span>Additional Information</span>
											</a>
										</li>
										<li>
											<a data-toggle="tab" href="#review">
												<?php
												if (isset(($_GET['id']))) {
													$mahh = $_GET['id'];
													$bl = new product();
													$tongbl = $bl->getCountComment($mahh);
												}
												?>
												<span>Review(<?php echo $tongbl ?>) </span>
											</a>
										</li>
									</ul>
								</div>
							</form>

							<!-- Tab Content -->
							<div class="tab-content">
								<!-- Description -->
								<div role="tabpanel" class="tab-pane fade in active" id="description">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
								</div>

								<!-- Product Tag -->
								<div role="tabpanel" class="tab-pane fade" id="additional-information">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
								</div>

								<!-- Review -->
								<div role="tabpanel" class="tab-pane fade" id="review">
									<div class="reviews">
										<?php $listCMT = $bl->getComment($mahh);
										while ($set = $listCMT->fetch()) :
										?>
											<div class="comments-list ">
												<div class="item d-flex">
													<div class="comment-left pull-left">
														<div class="avatar">
															<img src="./View/img/testimonial-1.png" alt="" width="40" height="40">
														</div>
														<div class="product-rating">
														<?php if(isset($set['danhgia']) && $set['danhgia'] == 1): ?>
															<div class="star on"></div>
															<div class="star"></div>
															<div class="star"></div>
															<div class="star"></div>
															<div class="star"></div>
															<?php elseif(isset($set['danhgia']) && $set['danhgia'] == 2): ?>
																<div class="star on"></div>
															<div class="star on"></div>
															<div class="star"></div>
															<div class="star"></div>
															<div class="star"></div>
															<?php elseif(isset($set['danhgia']) && $set['danhgia'] == 3): ?>
																<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<div class="star"></div>
															<div class="star"></div>
															<?php elseif(isset($set['danhgia']) && $set['danhgia'] == 4): ?>
																<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<div class="star"></div>
															<?php else: ?>
																<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<div class="star on"></div>
															<?php endif;?>
													</div>
													</div>
													<div class="comment-body">
														<div class="comment-meta">
															<span class="author"><?php echo $set['tenkh'] ?></span> - <span class="time"><?php echo $set['ngaybl'] ?></span>
														</div>
														<div class="comment-content w-100"><?php echo $set['noidung'] ?> </div>
													</div>
												</div>
											</div>
										<?php endwhile ?>
										<?php

										if (isset($_SESSION['makh'])) :
										?>
											<div class="review-form">
												<h4 class="title">Write a review</h4>
												<form action="index.php?action=productCtrl&act=comment&id=<?php echo $id ?>" method="post" class="form-validate">
													<div class="form-group">
													<div class="text">Your Rating</div>
													<select name="rating" style="padding: 5px 10px;"">
														<option value="1">1 sao</option>
														<option value="2">2 sao</option>
														<option value="3">3 sao</option>
														<option value="4">4 sao</option>
														<option value="5">5 sao</option>
													</select>
												</div>
														<div class="product-rating">
														<span id="rateMe4"  class="feedback"></span>
														</div>
													</div>
													<div class="form-group">
														<div class="text">You review<sup class="required">*</sup></div>
														<textarea id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
													</div>
													<div class="form-group">
														<button type="submit" class="btn btn-primary">Send your review</button>
													</div>
												<?php endif ?>
												</form>
											</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Related Products -->
			<div class="products-block related-products item-4">
				<div class="block-title">
					<h2 class="title">Related <span>Products</span></h2>
				</div>
	
				<div class="block-content">
					<div class="products owl-theme owl-carousel">
						<?php
						$result = $hh->getRelated($nhom, $id);
						while ($set = $result->fetch()):
						?>
							<div class="product-item">
								<div class="product-image">
									<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
										<img src="./View/img/product/<?php echo $set['hinh'] ?>" alt="Product Image">
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
									<span class="sale-price"><?php echo number_format($set['dongia']) ?><sup>đ</sup> </span>
								</div>
	
								<div class="product-buttons">
									<a class="add-to-cart" href="">
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
						<?php endwhile ?>
					</div>
				</div>
			</div>
	</div>
</div>