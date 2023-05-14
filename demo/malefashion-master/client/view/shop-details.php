<?php
$id = $_GET['id'] ?? '';
if (!empty($id)) {
  $prod = new products();
  $result = $prod->getSingleProduct($id);
  $cmt = $prod->getComments($result['id']);
  $countCmt = count($cmt->fetchAll());
} else {
  include './view/shop.php';
}
?>

<!-- Shop Details Section Begin -->
<section class="shop-details">
  <div class="product__details__pic">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="product__details__breadcrumb">
            <a href="./index.html">Trang chủ</a>
            <a href="./shop.html">Của hàng</a>
            <span>Chi tiết sản phẩm</span>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                <div class="product__thumb__pic set-bg" data-setbg="./view/img/product/<?php echo $result['image'] ?>">
                </div>
              </a>

            </li>

          </ul>
        </div>
        <div class="col-lg-6 col-md-9">
          <div class="tab-content">
            <div class="tab-pane active" id="tabs-1" role="tabpanel">
              <div class="product__details__pic__item">
                <img src="./view/img/product/<?php echo $result['image'] ?>" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="product__details__content">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <form id="add_cart_form" method="post">
            <div class="product__details__text">
              <input type="hidden" name="product_id" value="<?php echo $result['id'] ?>" id="product_id">
              <h4 id="product_name"><?php echo $result['product_name'] ?></h4>
              <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span> - 5 Reviews</span>
              </div>
              <h3 id="product_price"><?php echo number_format($result['price']) . " VND" ?></h3>


              <p><?php
                  echo $result['describe']
                  ?></p>
              <div class="product__details__option">
                <p>Hàng trong kho: <?php echo $result['quantity'] ?></p>
                <!-- <div class="product__details__option__size">
                  <?php
                  if ($result['categories'] == 'Áo thun' || $result['categories'] == 'Sơ mi' || $result['categories'] == 'Giày' || $result['categories'] == 'Áo khoác') {
                    echo '<span>Kích cỡ :</span>';
                  }
                  ?>
                  <?php
                  if ($result['categories'] == 'Áo thun' || $result['categories'] == 'Sơ mi' || $result['categories'] == 'Áo khoác') :
                    if ($result['oversize'] > 0) :
                  ?>
                      <label for="oversize">xxl
                        <input type="radio" id="oversize" name="size" value="xxl">
                      <?php endif ?>
                      </label>
                      <?php
                      if ($result['size_xl'] > 0) :
                      ?>
                        <label for="xl">xl
                          <input type="radio" id="xl" name="size" value="xl">
                        <?php endif ?>
                        </label>
                        <?php
                        if ($result['size_l'] > 0) :
                        ?>
                          <label for="l">l
                            <input type="radio" id="l" name="size" value="l">
                          <?php endif ?>
                          </label>
                          <?php
                        if ($result['size_m'] > 0) :
                        ?>
                          <label for="m">m
                            <input type="radio" id="m" name="size" value="m">
                          <?php endif ?>
                          </label>
                          <?php
                          if ($result['size_s'] > 0) :
                          ?>
                            <label for="s">s
                              <input type="radio" id="s" name="size" value="s">
                            <?php endif ?>
                            </label>
                            <?php elseif ($result['categories'] == 'Giày') :
                            if ($result['oversize'] > 0) :
                            ?>
                              <label for="oversize">41
                                <input type="radio" id="oversize" name="size" value="41">
                              <?php endif ?>
                              </label>
                              <?php
                              if ($result['size_xl'] > 0) :
                              ?>
                                <label for="xl">40
                                  <input type="radio" id="xl" name="size" value="40">
                                <?php endif ?>
                                </label>
                                <?php
                                if ($result['size_l'] > 0) :
                                ?>
                                  <label for="l">39
                                    <input type="radio" id="l" name="size" value="39">
                                  <?php endif ?>
                                  </label>
                                  <?php
                                  if ($result['size_m'] > 0) :
                                  ?>
                                    <label for="m">38
                                      <input type="radio" id="m" name="size" value="38">
                                    <?php endif ?>
                                    </label>
                                    <?php
                                  if ($result['size_s'] > 0) :
                                  ?>
                                    <label for="s">38
                                      <input type="radio" id="s" name="size" value="37">
                                    <?php endif ?>
                                    </label>
                                  <?php endif; ?>
                </div> -->
                <div class="shop__sidebar__color">
                <?php 
                $product_model = new products();
                $colors = $product_model -> getColors($result['id'])-> fetchAll();
                foreach($colors as $color):

                ?>
                  <label class="label"  for="sp<?php echo $result['id'] . $color[0]?>" style="background-color: <?php echo $color[0]?>;">
                   <input type="radio" id="sp<?php echo $result['id'] . $color[0]?>" class="color-input" value="<?php echo $color[0]?>">
                   <span class="icon" ><ion-icon name="checkmark-outline" class="check"  style="color:green;font-size:25px;display:none"></ion-icon></span>
                  </label>
                   <?php endforeach?>
                </div>           
              </div>
              <div class="product__details__cart__option">
                <!-- <div class="quantity">
                <div class="pro-qty"> -->
                <input type="number" value="1" min="1" max="<?php echo $result['quantity'] ?>" name="quantity" id="quantity">
                <!-- </div>
              </div> -->
                <button class="primary-btn" type="submit">Thêm vào giỏ hàng</button>
              </div>
              <div class="product__details__btns__option">
                <a href="#"><i class="fa fa-heart"></i> Thêm vào danh sách yêu thích</a>
                <a href="#"><i class="fa fa-exchange"></i> So sánh</a>
              </div>
              <div class="product__details__last__option">
                <h5><span>Đảm bảo an toàn khi thanh toán</span></h5>
                <img src="./view/img/shop-details/details-payment.png" alt="">
                <ul>
                  <li><span>SKU:</span> 3812912</li>
                  <li><span>Danh mục:</span> Clothes</li>
                  <li><span>Tag:</span> Clothes, Skin, Body</li>
                </ul>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="product__details__tab">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">

                  Bình luận(<span id="total_cmt"><?php echo $countCmt ?></span>)</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Thông tin thêm</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tabs-5" role="tabpanel">
                <div class="product__details__tab__content">

                  <div class="product__details__tab__content__item">
                    <h5>Mô tả sản phẩm</h5>
                    <p><?php echo $result['describe'] ?></p>
                  </div>

                </div>
              </div>
              <div class="tab-pane" id="tabs-6" role="tabpanel">
                <div class="product__details__tab__content">
                  <div class="product__details__tab__content__item">

                    <form class="review_form">
                      <input type="hidden" id="product_id" name="product_id" value="<?php echo $result['id'] ?>">
                      <div class="form-group">
                        <label for="comment">Bình luận của bạn:</label>
                        <textarea class="form-control" id="comment" rows="5" placeholder="Nhập bình luận của bạn"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="rating">Đánh giá sao:</label>
                        <div class="rating-stars">
                          <span class="star" data-rating="1">&#9733;</span>
                          <span class="star" data-rating="2">&#9733;</span>
                          <span class="star" data-rating="3">&#9733;</span>
                          <span class="star" data-rating="4">&#9733;</span>
                          <span class="star" data-rating="5">&#9733;</span>
                        </div>
                        <input type="hidden" id="rating-value" value="0">
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Đăng bình luận</button>
                    </form>
                    <div id="comment_display">
                      <?php
                      $product =  new products();
                      $product_id = $result['id'];
                      $customer_id = $_SESSION['customer_id'] ?? '';
                      $user = new user();
                      $commentAll = $product->getComments($product_id);
                      $commentResult = $commentAll->fetchAll();
                      $totalCmt = count($commentResult);
                      // Lấy thời gian hiện tại
                      $current_time = new DateTime();
                      if($totalCmt > 0):
                      foreach ($commentResult as $cmt) :
                        $comment_time = new DateTime($cmt['dateCmt']);
                        // Tính toán khoảng thời gian giữa hai thời điểm
                        $time_diff = $current_time->diff($comment_time);
                        $customer = $user->getUser($cmt['customer_id']);
                        $ratingNum = $cmt['rating'];
                        echo ' <div class="row">';
                        echo ' <div class="card mb-3  w-100">';
                        echo ' <div class="card-body d-flex gap-2">';
                        echo ' <img width="70" src="./view/img/user/' . $customer['avatar'] . '">';
                        echo '<div>';
                        echo ' <h5 class="card-title">' . $customer['customer_name'] . '</h5>';
                        echo ' <div class="rating">';
                        for ($i = 1; $i <= 5; $i++) :
                          if ($i <= $ratingNum) {
                            echo ' <span class="star selected">&#9733;</span>';
                          } else {
                            echo ' <span class="star">&#9733;</span>';
                          }
                        endfor;
                        echo ' <p class="card-text">' . $cmt['contents'] . '</p>';
                        echo ' <p class="card-text">' . $time_diff->format('%d ngày, %h giờ, %i phút, %s giây') . '</p>';
                        echo '</div>';
                        echo ' </div>';
                        echo ' </div>';
                        echo ' </div></div>';
                      endforeach;
                      else: echo '';
                    endif;
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tabs-7" role="tabpanel">
                <div class="product__details__tab__content">
                  <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                    solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                    ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                    pharetras loremos.</p>
                  <div class="product__details__tab__content__item">
                    <h5>Products Infomation</h5>
                    <p>A Pocket PC is a handheld computer, which features many of the same
                      capabilities as a modern PC. These handy little devices allow
                      individuals to retrieve and store e-mail messages, create a contact
                      file, coordinate appointments, surf the internet, exchange text messages
                      and more. Every product that is labeled as a Pocket PC must be
                      accompanied with specific software to operate the unit and must feature
                      a touchscreen and touchpad.</p>
                    <p>As is the case with any new technology product, the cost of a Pocket PC
                      was substantial during it’s early release. For approximately $700.00,
                      consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                      These days, customers are finding that prices have become much more
                      reasonable now that the newness is wearing off. For approximately
                      $350.00, a new Pocket PC can now be purchased.</p>
                  </div>
                  <div class="product__details__tab__content__item">
                    <h5>Material used</h5>
                    <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                      from synthetic materials, not natural like wool. Polyester suits become
                      creased easily and are known for not being breathable. Polyester suits
                      tend to have a shine to them compared to wool and cotton suits, this can
                      make the suit look cheap. The texture of velvet is luxurious and
                      breathable. Velvet is a great choice for dinner party jacket and can be
                      worn all year round.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="related-title">Sản phẩm liên quan</h3>
      </div>
    </div>
    <div class="row">
      <?php
      $realted = $prod->getRelatedProduct($result['categories'])->fetchAll();
      foreach ($realted as $set) :
      ?>
        <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
          <div class="product__item">
            <div class="product__item__pic set-bg" data-setbg="./view/img/product/<?php echo $set['image'] ?>">

              <ul class="product__hover">
                <li><a href="#"><img src="./view/img/icon/heart.png" alt=""></a></li>
                <li><a href="#"><img src="./view/img/icon/compare.png" alt=""> <span>So sánh</span></a></li>
                <li><a href="index.php?action=shop&act=product_detail&id=<?php echo $set['id'] ?>"><img src="view/img/icon/search.png" alt=""></a></li>
              </ul>
            </div>
            <div class="product__item__text">
              <h6><?php echo $set['product_name'] ?></h6>
              <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>
              <div class="rating">
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
                <i class="fa fa-star-o"></i>
              </div>
              <h5><?php echo number_format($set['price']) . " VND" ?></h5>
              <div class="product__color__select">
                <label for="pc-1">
                  <input type="radio" id="pc-1">
                </label>
                <label class="active black" for="pc-2">
                  <input type="radio" id="pc-2">
                </label>
                <label class="grey" for="pc-3">
                  <input type="radio" id="pc-3">
                </label>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>
<!-- Related Section End -->
<style>
  .selected {
    color: orange;
  }

  .rating-stars .star {
    cursor: pointer;
    font-size: 20px;
  }

  #comment_display {
    max-height: 400px;
    overflow: auto;
  }
  .selected{
    /* box-shadow: 5px; */
    /* border:  solid green; */
    background-color: red;
  }
  label{
    display: flex;
    justify-content: center;
    align-items: center;
  }

</style>
<script>
  $(document).ready(function() {
    let rating = 0;
    $('.rating-stars .star').click(function() {
      rating = $(this).data('rating');
      $('#rating-value').val(rating);
      $('.rating-stars .star').removeClass('selected');
      $(this).addClass('selected');
      $('.rating-stars .star').each(function() {
        if ($(this).data('rating') <= rating) {
          $(this).addClass('selected');
        }
      });
    });
    $('.review_form').submit(function(e) {
      e.preventDefault();
      let comment = $('#comment').val();
      let product_id = $('#product_id').val()
      // let formData = $(this).serialize
      $.ajax({
        url: 'index.php?action=shop&act=comments',
        type: 'POST',
        dataType: 'json',
        data: {
          comment,
          rating,
          product_id
        },
        success: function(response) {
          if (response.noLogin == true) {
            swal({
              title: "Vui lòng đăng nhập để bình luận",
              text: `Nhấn OK để đi đến trang đăng nhập`,
              icon: "error",
              buttons: ["Hủy bỏ", "OK"],
            }).then(redict => {
              if (redict) window.location.href = 'index.php?action=user&act=login';
            })
          } else if (response.noContent) {
            swal({
              title: "Không thể bình luận",
              text: `Bạn vui lòng nhập nội dung bình luận và đánh giá`,
              icon: "error",
            })
          } else if (response.success) {
            swal({
              title: "Bình luận của bạn đã được gửi",
              icon: "success",
            }).then((ok) => {
              if (ok) {
                $('#comment_display').html(response.comment_display)
                $('#total_cmt').html(response.totalCmt)
              }
            })
          } else {
            console.log(response.failed);
            swal({
              title: "Không thể bình luận",
              text: `Có lỗi xảy ra ê ${response.failed}`,
              icon: "error",
            })
          }
        },
        error: function(xhr, status, error) {
          alert('Lỗi: ' + xhr.responseText);
        }
      });
    });
//     $('.color-input').change(function(e) {
// // e.stopPropagation()
//   $(this).closest('label').find('.check').css('display', 'block');
//   $('.color-input').not(this).closest('label').find('.check').css('display', 'none');
//   console.log($(this).closest('.label'));
// });
$('.color-input').click(function() {
  // Tìm phần tử label chứa input được chọn
  var label = $(this).closest('.label');
  // Ẩn icon checked của các lựa chọn khác
  $('.check').css('display','none');
  // Hiện icon checked của lựa chọn được chọn
  label.find('.check').css('display','block');
  // Đặt thuộc tính checked cho input được chọn
  $('.color-input').not(this).prop('checked', false);
  $(this).prop('checked', true);
  console.log($(this).val());
});
})
  const quantityInput = document.getElementById('quantity');


  quantityInput.addEventListener('input', function() {
    const quantity = parseInt(quantityInput.value);
    const min = parseInt(quantityInput.min);
    const max = parseInt(quantityInput.max);

    if (quantity < min) {
      quantityInput.value = min
    } else if (quantity > max) {
      quantityInput.value = max
    }
  });
</script>