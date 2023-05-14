
 <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="index.php?action=user&act=login">Đăng nhập</a>
                <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#"><img src="./view/img/icon/heart.png" alt=""></a>
            <a href="#"><img src="./view/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">$0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, 30-day return or refund guarantee.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?php
                                if(!empty($_SESSION['customer_id'])):
                                ?>
                                <a href="index.php?action=user&act=logout" id="logout">Đăng xuất</a>
                                <?php else: ?>
                                <a href="index.php?action=user&act=login" id="login">Đăng nhập</a>
                                <?php endif ?>
                                <a href="#">FAQs</a>
                                <div class="header__top__hover">
                                <span>Usd <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>USD</li>
                                    <li>EUR</li>
                                    <li>USD</li>
                                </ul>
                            </div>
                        <?php  
                        if(!empty($_SESSION['customer_id'])):
                        ?>
                                <a href="index.php?action=personal" id="personal_btn">Xin chào <span class="signedin_name"><?php echo $_SESSION['customer_name'] ?? ''?></span></a>
                            <?php endif?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="./"><img src="./view/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./">Home</a></li>
                            <li><a href="index.php?action=shop" id="shop">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="dropdown">
                                    <li><a href="index.php?action=about">About Us</a></li>
                                    <li><a href="index.php?action=shop-details">Shop Details</a></li>
                                    <li><a href="index.php?action=shopping-cart">Shopping Cart</a></li>
                                    <li><a href="index.php?action=checkout">Check Out</a></li>
                                    <li><a href="index.php?action=blog-details">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?action=blog">Blog</a></li>
                            <li><a href="index.php?action=contact">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                    
                        <a href="#"><img src="./view/img/icon/heart.png" alt=""></a>
                        <a href="index.php?action=shopping-cart"><img src="./view/img/icon/cart.png" alt=""> 
                        <span id="sessioncart_quantity"><?php if(!empty($_SESSION['cart'])) {
                            echo count($_SESSION['cart']);
                            }else{
                                echo 0;
                            }
                            ?>
                    </span></a>
                        <div class="price " id="sessioncart_total">0đ</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->
     <!-- Search Begin -->
     <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->
    