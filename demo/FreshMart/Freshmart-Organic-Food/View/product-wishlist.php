<?php
$limit = 8;
$prod = new product();
$count = $prod->getCountWishlist();
$page = new page();
$start = $page->findStart($limit);
$totalPage = $page->findPage($count, $limit);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$sort = isset($_POST['sort']) ? $_POST['sort'] : 0;
?>
<!-- Main Content -->
<div id="content" class="site-content">
	<!-- Breadcrumb -->
	<div id="breadcrumb">
		<div class="container">
			<h2 class="title">Fruit</h2>

			<ul class="breadcrumb">
				<li><a href="index.php" title="Home">Home</a></li>
				<li><a href="index.php?action=wishlist" title="Fruit">Wishlist</a></li>
			</ul>
		</div>
	</div>


	<div class="container">
		<div class="row">
			<!-- Sidebar -->
			<!-- Page Content -->
			<div id="center-column" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="product-category-page">
					<!-- Nav Bar -->
					<div class="products-bar">
						<div class="row">
							<div class="col-md-6 col-xs-6">
								<div class="gridlist-toggle" role="tablist">
									<ul class="nav nav-tabs">
										<li class="active"><a href="#products-grid" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-large"></i></a></li>
										<li><a href="#products-list" data-toggle="tab" aria-expanded="false"><i class="fa fa-bars"></i></a></li>
									</ul>
								</div>
					
								<div class="total-products">There are <?php echo $count?> products</div>
							</div>

							<div class="col-md-6 col-xs-6">
								<div class="filter-bar">
								</div>
							</div>
						</div>
					</div>

					<div class="tab-content">
						<!-- Products Grid -->
						<div class="tab-pane active" id="products-grid">
							<div class="products-block">
								<div class="row">
									<!-- Xuất sản phẩm -->
									<?php							
									$hh = new product();		
										$result  = $hh->getWishlist();
									while ($set = $result->fetch()) :
									?>
										<div class="col-lg-3 col-md- col-sm-6 col-xs-12">
											<div class="product-item">
												<div class="product-image">
													<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<img class="img-responsive w-50" src="<?php echo $set['hinh'] ?>">
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
													<span class="sale-price"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>
													<!-- <span class="base-price">$90.00</span> -->
												</div>
												<div class="product-buttons">
													<a class="add-to-cart" href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<i class="fa fa-shopping-basket" aria-hidden="true"></i>
													</a>
									
												<a class="add-wishlist" href="index.php?action=productCtrl&act=yeuthich&id=<?php echo $set['masp']?>">
									
														<i class="fa fa-heart" aria-hidden="true"></i>
													</a>
											
													<a class="quickview" href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<i class="fa fa-eye" aria-hidden="true"></i>
													</a>
												</div>
											</div>
										</div>
									<?php endwhile ?>
								</div>

							</div>
						</div>

						<!-- Products List -->
						
					</div>

					<!-- Pagination Bar -->
					<div class="pagination-bar">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="text">Showing 1-12 of 20 item(s)</div>
							</div>

							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="pagination">
									<ul class="page-list">
										<li><a href="index.php?action=productCtrl&act=allproduct&page=1" class="prev">First page</a></li>
										<li><a href="index.php?action=productCtrl&act=allproduct&page=<?php if ($currentPage > 1) { echo $currentPage - 1;	} ?>" class="prev">Previous</a></li>
										<?php
										for ($i = 1; $i <= $totalPage; $i++) :
										?>
											<?php
											if ($i != $currentPage) : ?>
												<?php if ($i > $currentPage - 2 && $i < $currentPage + 2) : ?>
													<li><a href="index.php?action=productCtrl&act=allproduct&page=<?php echo $i ?>" class="current"><?php echo $i ?></a></li>
												<?php endif ?>
											<?php else : ?>
												<li><a style="background-color: black;" href="index.php?action=productCtrl&act=allproduct&page=<?php echo $i ?>" class="current"><?php echo $i ?></a></li>
											<?php endif ?>
										<?php endfor ?>
										<?php
										if ($currentPage <= ($totalPage - 2)) : ?>
											<span>...</span>
											<li><a href="index.php?action=productCtrl&act=allproduct&page=<?php echo $totalPage ?>" class="current"><?php echo $totalPage ?></a></li>
										<?php endif ?>
										<li><a href="index.php?action=productCtrl&act=allproduct&page=<?php if ($currentPage < $totalPage) {	echo $currentPage + 1;	} ?>" class="next">Next</a></li>
										<li><a href="index.php?action=productCtrl&act=allproduct&page=<?php echo $totalPage ?>" class="next">Last page</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Footer -->