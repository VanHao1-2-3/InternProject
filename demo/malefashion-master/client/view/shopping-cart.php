<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Kích thước</th>
                                <th>Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="body_cart">
                            <?php
                            $total = 0;
                            $product_model = new products();
                            $maxQuantity = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $key => $prods) :
                                    $product = $product_model->getSingleProduct($prods['product_id']);
                                    if (isset($product)) {
                                        $maxQuantity = $product['quantity'];
                                    }
                                    $total += $prods['total'];
                                    echo '<tr>';
                                    echo '<td class="product__cart__item">';
                                    // echo '<div class="product__cart__item__pic">';
                                    echo ' <img style="width:70px;" src="./view/img/product/' . $prods['image'] . '" alt=""/>';
                                    echo ' </div>';
                                    echo '<div class="product__cart__item__text">';
                                    echo '<h6>' . $prods['product_name'] . '</h6>';
                                    echo '<h5>' . number_format($prods['product_price']) . ' VND</h5>';
                                    echo '</div>';
                                    echo '</td>';
                                    echo '<td class="quantity__item">';
                                    // echo '<div class="quantity">';
                                    // echo '<div class="pro-qty-2">';
                                    echo '<input type="number" id="quantity" min="1" max="' . $maxQuantity . '" value="' . $prods['quantity'] . '" class="quantityChange" data-size="' . $prods['size'] . '" data-id="' . $prods['product_id'] . '"/> ';
                                    echo '<span id="quantity-error" style="color: red; display: none;">Số lượng không hợp lệ</span>';
                                    // echo '</div>';
                                    // echo '</div>';
                                    echo '</td>';
                                    echo '<td class="cart__price">' . $prods['size'] . '</td>';
                                    echo '<td class="cart__price">' . number_format($prods['total']) . 'đ</td>';
                                    echo '<td class="cart__close"><i  class="fa fa-close deleteIcon" data-size="' . $prods['size'] . '" data-id="' . $prods['product_id'] . '"></i></td>';
                                    echo '</tr>';
                                endforeach;
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="index.php?action=shop">Tiếp tục mua sắm</a>
                        </div>
                    </div>
                    <?php
                    $class = !empty($_SESSION['cart']) ? '' :'disabled';
                    ?>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a class="clear_cart <?php echo $class?>" style="cursor:pointer" ><i class="fa fa-spinner"></i>Xóa toàn bộ cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Mã giảm giá</h6>
                    <form id="discount_form">
                        <input type="text" placeholder="Mã giảm giá" name="discount">
                        <button type="submit">Sử dụng</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Tổng tiền</h6>
                    <ul>
                        <li>Tổng tiền<span id="total"><?php echo number_format($total) ?>đ</span></li>
                        <li>Giảm giá: <span id="discount_percent">0%</span></li>
                        <li>Thành tiền <span id="discount_total"><?php echo number_format($total) ?>đ</span></li>
                    </ul>
                    <a href="index.php?action=checkout&act=checkout" id="checkout_btn" data-discount="<?php echo $_SESSION['discountCode']?>" class="primary-btn">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    *{
        user-select: none;
    }
    a.disabled {
  pointer-events: none;
  opacity: 0.5;
  /* hoặc sử dụng thuộc tính cursor để thay đổi kiểu con trỏ */
  cursor: default;
}
.shopping__cart__table{
    max-height: 400px;
    overflow: auto;
}
</style>
<!-- Shopping Cart Section End -->
<script>
    $(document).ready(function() {
        $('#checkout_btn').on('click', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url: 'index.php?action=checkout&act=checkout',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    if (response.null) {
                        swal({
                            'title': 'Bạn không có bất kì sản phẩm nào trong giỏ hàng để thanh toán',
                            icon: 'warning'
                        })
                    } else if (response.noLogin) {
                        swal({
                            'title': 'Vui lòng đăng nhập để thanh toán',
                            'text': 'Nhấn OK để đi đến trang đăng nhập',
                            icon: 'error'
                        }).then((redict) => {
                            window.location.href = 'index.php?action=user&act=login'
                        })
                    } else if (response.success) {
                        window.location.href = 'index.php?action=checkout'
                    }
                }
            })

        })
        $('.clear_cart').click(function(e) {
            e.preventDefault()
            swal({
                title: 'Bạn có muốn xóa toàn bộ hàng hóa trong giỏ hàng',
                icon: 'warning'
            }).then(success => {
                if (success) {
                    $.ajax({
                        url: 'index.php?action=cart&act=clear-cart',
                        success: function(response) {
                            let temp = $('<div>').html(response).hide();
                            let table = temp.find('.shopping__cart__table')

                            temp.remove()
                            swal({
                                title: 'Xóa thành công',
                                icon: 'success'
                            }).then(success => {
                                if (success) {
                                    
                                    $('.shopping__cart__table').html(table)
                                    $('#total').html(0 +'đ')
                                    $('#sessioncart_quantity').text(0 );
                                    $('#sessioncart_total').text(0 + 'đ');
                                    $('a.shopping__cart__table').addClass('disabled')
                                    $('#discount_total').html(0+'đ')
                                }
                            })
                        }
                    })
                }
            })
        })
        $('#discount_form').on('submit',function(e){
            e.preventDefault()
            let data = $(this).serialize();
            $.ajax({
                url:'index.php?action=cart',
                method:'post',
                data : data,
                dataType:'json',
                success:function(response){
                $('#discount_percent').html(response.discount_percent+'%')
                $('#discount_total').html(response.discount_total+'đ')
                console.log(response.discount_percent);
                }
            })
        })
    })
    const quantityInput = document.getElementById('quantity');
    const quantityError = document.getElementById('quantity-error');

    quantityInput.addEventListener('input', function() {
        const quantity = parseInt(quantityInput.value);
        const min = parseInt(quantityInput.min);
        const max = parseInt(quantityInput.max);

        if (quantity > max) {
            quantityInput.value = max
        } else if (quantity < min) {
            quantityInput.value = min
        }
    });
</script>