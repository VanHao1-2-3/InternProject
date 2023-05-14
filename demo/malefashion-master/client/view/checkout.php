

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="checkout-form">
                    <div class="row">
                        <div class="col-lg-7 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                            here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Họ<span>*</span></p>
                                        <input type="text" name="fname">
                                        <span class="fname_error" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text" name="lname">
                                        <span class="lname_error" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="address">
                                <span class="address_error" style="color:red"></span>
                            </div>
                            <div class="checkout__input">
                                <p>Thành phố/ Tỉnh<span>*</span></p>
                                <input type="text" name="city" placeholder="Thành phố/ Tỉnh">
                                <span class="city_error" style="color:red"></span>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="phone">
                                        <span class="phone_error" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email">
                                        <span class="email_error" style="color:red"></span>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Tổng <span>Đơn hàng</span></div>
                                <ul class="checkout__total__products">
                                    <?php
                                    $total = 0;
                                    foreach($_SESSION['cart'] as $key=> $item):
                                        
                                        $total += $item['total'];                                  ?>
                                    <li><?php echo $key + 1?>. <?php echo $item['product_name']?><span><?php echo number_format($item['total'])?>đ</span></li>
                                   
                                    <?php 
                                
                                    endforeach?>
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Tổng tiền <span><?php echo number_format($total)?></span></li>
                                    <li>Giảm giá: <span class = "discount-percent "><?php echo  $_SESSION['discountCode']?>%</span></li>
                                    <li>Tổng tiền <span class = "checkout-total"><?php
                                    if(isset($_SESSION['discountCode'])){
                                        $total = $total * (100 - $_SESSION['discountCode'])/100;
                                    };
                                    echo number_format($total)?>đ</span></li>
                                </ul>
                                <input type="hidden" name='discountTotal' value="<?php echo $total?>">
                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
<script>
    $(document).ready(function(){
        $('#checkout-form').on('submit',function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                url:'index.php?action=checkout&act=checkout_act',
                type:'POST',
                dataType:'json',
                data:formData,
                success:function(response){
                    console.log(response.code);
                       if(!response.success){
                        $('.fname_error').text(response.errors.fname_error)
                        $('.lname_error').text(response.errors.lname_error)
                        $('.city_error').text(response.errors.city_error)
                        $('.address_error').text(response.errors.address_error)
                        $('.phone_error').text(response.errors.phone_error)
                        $('.email_error').text(response.errors.email_error)
                       }
                       else{
                        swal({
                            title:"Thanh toán thành công",
                            text:"Nhấn OK để vê trang chủ",
                            icon:"success"
                        }).then(redirect =>{
                            if(redirect) window.location.href = 'index.php';
                        })
                       }
                }
            })
        })
    })
</script>

    