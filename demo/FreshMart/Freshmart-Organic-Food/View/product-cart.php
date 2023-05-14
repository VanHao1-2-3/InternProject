
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
					<div class="page-cart">
						<div class="table-responsive">
							<?php
							if(!isset($_SESSION['cartTemplate'])|| count($_SESSION['cartTemplate'])==0):
							echo "<table><tr class=".'p-5 m-auto'."><th>Chưa có sản phẩm nào trong giỏ hàng</th></tr></table>"
							?>
							<?php else: ?>
							<form action="index.php?action=cart&act=update" method="post">
							<table class="cart-summary table table-bordered">
								<thead>
									<tr>
										<th class="width-20">&nbsp;</th>
										<th class="width-80 text-center">Image</th>
										<th>Name</th>
										<th class="width-100 text-center">Unit price</th>
										<th class="width-80 text-center">Qty</th>
										<th class="width-90 text-center">Total</th>
										<th class="width-20 text-center"></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$j = 0;
									foreach($_SESSION['cartTemplate'] as $key => $item):
									?>
									<tr>
										<td class="product-remove">
											<a href="index.php?action=cart&act=delete&id=<?php echo $key?>" title="Remove this item" class="remove" href="#">
												<i class="fa fa-times"></i>
											</a>
										</td>
										<td>
											<a href="product-detail.php">
												<img width="80" alt="Product Image" class="img-responsive" src="./View/img/product/<?php echo $item['hinh']?>">
											</a>
										</td>
										<td>
											<a href="product-detail.php" class="product-name"><?php echo $item['tensp']?></a>
										</td>
										<td class="text-center">
											<?php echo number_format($item['dongia'])?>
										</td>
										<td>
											<div class="product-quantity">
												<div class="qty">
													<div class="input-group">
														<input type="number" name="soluong[]" value="<?php echo $item['soluong']?>" data-min="1">
													</div>
												</div>
											</div>
										</td>
										<td class="text-center">
											<?php echo number_format($item['tongtien'])?>
										</td>
										<td><button type="submit" class="btn btn-primary">Sửa</button></td>
									</tr>
									<?php endforeach?>
								</tbody>
								
								<tfoot>
									
									<tr class="cart-total">
										<td rowspan="3" colspan="3"></td>
										<td colspan="2" class="text-right">Total products</td>
										<td colspan="1" class="text-center"><?php 
									$prod = new cart();
									$total = $prod->getTotal();
									echo number_format($total);
									?></td>
									</tr>
								</tfoot>
							</table>
							</form>
							<?php endif;?>
						</div>
						
						<div class="checkout-btn">
							<a href="index.php?action=bill" class="btn btn-primary pull-right" title="Proceed to checkout">
								<span>Proceed to checkout</span>
								<i class="fa fa-angle-right ml-xs"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
