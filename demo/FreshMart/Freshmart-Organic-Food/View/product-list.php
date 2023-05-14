<?php
$limit = 8;
$prod = new product();
$count = 0;
if(isset($_GET['act'])){
	if($_GET['act'] == 'search' && isset($_POST['txtsearch'])){
		
		$count = $prod->getCountProds($_GET['act'],$_POST['txtsearch']);
	}
	elseif($_GET['act'] == 'type'){
		$_SESSION['type'] = $_GET['type'];
		$count = $prod->getCountProds($_GET['act'],$_GET['type']);
	}
	else{
		$count = $prod->getCountProds($_GET['act'],'');
		unset($_SESSION['type']);
	}
}
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
				<li><a href="#" title="Fruit">Product</a></li>
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
									<form  class="pull-right" method="post">
										<div class="select ">
											<select class="form-control" onchange="this.form.submit()" name="sort">
												<?php if (isset($_POST['sort'])) {
													$_SESSION['sort'] = $_POST['sort'];
													if ($_SESSION['sort'] == 1) echo '<option value="1">Price: Lowest first</option>';
													elseif ($_SESSION['sort'] == 2) echo '<option value="2">Price: Highest first</option>';
													elseif ($_SESSION['sort'] == 3) echo '<option value="3">Product Name: A to Z</option>';
													elseif ($_SESSION['sort'] == 4) echo '<option value="4">Product Name: Z to A</option>';
													else {
														echo	'<option value="0" >Sort By</option>';
													}
												} else { 
													echo	'<option value="0">Sort By</option>';
												}
												?>
												 <?php
												if($_SESSION['sort'] != 0){
													echo '<option value="0">Sort By</option>';
												}
												if($_SESSION['sort'] != 1){
													echo '<option value="1">Price: Lowest first</option>';
												}
												if($_SESSION['sort'] != 2){
													echo '<option value="2">Price: Highest first</option>';
												}
												if($_SESSION['sort'] != 3){
													echo '<option value="3">Product Name: A to Z</option>';
												}
												if($_SESSION['sort'] != 4){
													echo '<option value="4">Product Name: Z to A</option>';
												}
												?> 

											</select>
										</div>
									</form>
									
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
									$act = 0;
									if(isset($_SESSION['sort'])){
										$sort = $_SESSION['sort'];
									}
									if (isset($_GET['act']) && $_GET['act'] == 'search') {
										$act = 1;
									}
									if(isset($_GET['act']) && $_GET['act'] == 'type'){
										$act = 2;
									}
										$result  = $prod->getPageProduct($start, $limit,$sort,isset($_POST['txtsearch']) ? $_POST['txtsearch'] : '',isset($_SESSION['type']) ? $_SESSION['type'] : "");
									while ($set = $result->fetch()) :;
									?>
										<div class="col-lg-3 col-md- col-sm-6 col-xs-12">
											<div class="product-item">
												<div class="product-image">
													<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<img class="img-responsive " src="./View/img/product/<?php echo $set['hinh'] ?>">
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
													<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
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
						<div class="tab-pane" id="products-list">
							<div class="products-block layout-5">
								<?php
								$product = new product();
								$result  = $prod->getPageProduct($start, $limit,$sort,isset($_POST['txtsearch']) ? $_POST['txtsearch'] : '',$_SESSION['type']);
								while ($set = $result->fetch()) :
								?>
									<!-- <div class="product-item">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="product-image">
													<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<img class="img-responsive" src="<?php echo $set['hinh'] ?>" alt="Product Image">
													</a>
												</div>
											</div>

											<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
												<div class="product-info">
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
														<span class="review-count">(3 Reviews)</span>
													</div>

													<div class="product-price">
														<span class="sale-price"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>

													</div>

													<div class="product-stock">
														<i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
													</div>

													<div class="product-description">
														<?php echo $set['motasanpham'] ?>
													</div>

													<div class="product-buttons">
														<a class="add-to-cart" href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
															<i class="fa fa-shopping-basket" aria-hidden="true"></i>
															<span>Add To Cart</span>
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
										</div>
									</div> -->
									<div class="product-item">
										<div class="row">
											<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
												<div class="product-image">
													<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
														<img class="img-responsive" src="<?php echo $set['hinh'] ?>" alt="Product Image">
													</a>
												</div>
											</div>

											<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
												<div class="product-info">
													<div class="product-title">
												
														<a href="index.php?action=productCtrl&act=detail&id=<?php echo $set['masp'] ?>">
															<?php echo $set['tensp'] ?>
															<?php if($set['soluong'] == 0): ?>	
																<div>Hết hàng</div>
																<?php else: ?>
																	<div>Còn hàng</div>
																	<?php endif?>
														</a>
													</div>

													<div class="product-rating">
														<div class="star on"></div>
														<div class="star on"></div>
														<div class="star on "></div>
														<div class="star on"></div>
														<div class="star"></div>
														<span class="review-count">(3 Reviews)</span>
													</div>

													<div class="product-price">
														<span class="sale-price"><?php echo number_format($set['dongia']) ?><sup>đ</sup></span>

													</div>

													<div class="product-stock">
														<i class="fa fa-check-square-o" aria-hidden="true"></i>In stock
													</div>

													<div class="product-description">
														<?php echo $set['motasanpham'] ?>
													</div>

													<div class="product-buttons">
														<a class="add-to-cart" href="index.php?action=cart&act=cart&id=<?php echo $set['masp']?>">
															<i class="fa fa-shopping-basket" aria-hidden="true"></i>
															<span>Add To Cart</span>
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
									
										</div>
									</div>
								<?php endwhile ?>
							</div>
						</div>
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
										<li><a href="index.php?action=productCtrl&&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>page=<?php if ($currentPage > 1) { echo $currentPage - 1;	} ?>" class="prev">Previous</a></li>
										<?php
										for ($i = 1; $i <= $totalPage; $i++) :
										?>
											<?php
											if ($i != $currentPage) : ?>
												<?php if ($i > $currentPage - 2 && $i < $currentPage + 2) : ?>
													<li><a href="index.php?action=productCtrl&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>&page=<?php echo $i ?>" class="current"><?php echo $i ?></a></li>
												<?php endif ?>
											<?php else : ?>
												<li><a style="background-color: black;" href="index.php?action=productCtrl&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>&page=<?php echo $i ?>" class="current"><?php echo $i ?></a></li>
											<?php endif ?>
										<?php endfor ?>
										<?php
										if ($currentPage <= ($totalPage - 2)) : ?>
											<span>...</span>
											<li><a href="index.php?action=productCtrl&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>&page=<?php echo $totalPage ?>" class="current"><?php echo $totalPage ?></a></li>
										<?php endif ?>
										<li><a href="index.php?action=productCtrl&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>&page=<?php if ($currentPage < $totalPage) {	echo $currentPage + 1;	} ?>" class="next">Next</a></li>
										<li><a href="index.php?action=productCtrl&act=<?php echo $_GET['act']?>&<?php if($_GET['act'] == 'type') echo 'type='.$_SESSION['type']?>&page=<?php echo $totalPage ?>" class="next">Last page</a></li>
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