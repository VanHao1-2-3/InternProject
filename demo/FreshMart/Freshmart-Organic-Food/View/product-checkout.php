
			<!-- Main Content -->
			<div id="content" class="site-content">
				<!-- Breadcrumb -->
				<div id="breadcrumb">
					<div class="container">
						<h2 class="title">Shopping Cart</h2>
						
						<ul class="breadcrumb">
							<li><a href="#" title="Home">Home</a></li>
							<li><span>Shopping Cart</span></li>
						</ul>
					</div>
				</div>
			
				<div class="container">
					<div class="page-checkout">
						<div class="row">
							<div class="checkout-left col-lg-9 col-md-9 col-sm-9 col-xs-12">
								<p>Returning customer? <a class="login" href="user-login.html">Click here to login</a>.</p>
										<div class="heading">
											<h4 class="title">
												<a>
													Payment
												</a>
											</h4>
										</div>
										<div >
											<div class="body">
														<?php 
															if(!isset($_SESSION['cartTemplate'])):
																echo "<table><tr class=".'p-5 m-auto'."><th>Chưa có sản phẩm nào trong giỏ hàng</th></tr></table>"
														?>
														<?php else: ?>
												<table class="cart-summary table table-bordered">
													<thead>
														<tr>
															<th class="width-80 text-center">Image</th>
															<th>Name</th>
															<th class="width-100 text-center">Unit price</th>
															<th class="width-100 text-center">Qty</th>
															<th class="width-100 text-center">Total</th>
														</tr>
													</thead>
													
													<tbody>
														<?php
														foreach($_SESSION['cartTemplate'] as $key => $item):	
														?>
														<tr>
															<td>
																<a href="product-detail-left-sidebar.html">
																	<img width="80" alt="Product Image" class="img-responsive" src="./View/img/product/<?php echo $item['hinh']?>">
																</a>
															</td>
															<td>
																<a href="product-detail-left-sidebar.html" class="product-name"><?php echo $item['tensp']?></a>
															</td>
															<td class="text-center">
															<?php echo number_format($item['dongia'])?><sup>đ</sup>
															</td>
															<td class="text-center">
															<?php echo $item['soluong']?>
															</td>
															<td class="text-center">
															<?php echo number_format($item['tongtien'])?><sup>đ</sup>
															</td>
														</tr>
														<?php endforeach;  endif?>
														
													</tbody>
												</table>
											</div>
										</div>
									
								

								<div class="pull-right">
									<a href="index.php?action=bill&act=checkout"><input type="submit" value="Place Order" name="proceed" class="btn btn-primary"></a>
								</div>
							</div>
							
							<div class="checkout-right col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<h4 class="title">Cart Total</h4>
								<table class="table cart-total">
									<tbody>
										<tr class="cart-subtotal">
											<th>
												<strong>Cart Subtotal</strong>
											</th>
											<td>
												<strong><span class="amount">
												<?php 
												$tt = new cart();
												$total = $tt->getTotal();
												echo number_format($total)
												?>
												</span><sup>đ</sup></strong>
											</td>
										</tr>
										<tr class="shipping">
											<th>
												Shipping
											</th>
											<td>
												Free Shipping<input type="hidden" value="free_shipping" class="shipping-method" name="shipping_method">
											</td>
										</tr>
										<tr class="total">
											<th>
												<strong>Order Total</strong>
											</th>
											<td>
												<strong><span class="amount"><?php echo number_format($total)?><sup>đ</sup></span></strong>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>