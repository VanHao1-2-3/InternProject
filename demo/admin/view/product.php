  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID sản phẩm</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng </th>
                  <th>Đơn giá</th>
                  <th>Hình ảnh</th>
                  <th>Ảnh liên quan</th>
                  <th>Mô tả</th>
                  <th>Danh mục</th>
                  <th>Số lượng đã bán</th>
                  <th>Size_s</th>
                  <th>Size_m</th>
                  <th>Size_l</th>
                  <th>Size_xl</th>
                  <th>Oversize</th>
                  <th>Màu</th>
                  <?php
                  if(isset($_GET['act']) && $_GET['act'] != 'show-products'){
                    echo '<th></th>';
                  }
                  ?>
                </tr>
              </thead>

              <tbody id="product_display">
                <?php
                $product_model = new product();
                $products = $product_model->getProduct()->fetchAll();
                $deleteProducts = $product_model->getDeleteProducts()->fetchAll();
                $deleted = array();
                foreach ($products as $product) :
                  foreach ($deleteProducts as $productDelete) :
                    if ($product['id'] === $productDelete['deleteID']) {
                      $deleted[] = $product['id'];
                    }
                  endforeach;
                  if (!in_array($product['id'], $deleted)) :
                    echo '<tr>';
                    echo ' <td>' . $product['id'] . '</td>';
                    echo ' <td>' . $product['product_name'] . '</td>';
                    echo ' <td>' . $product['quantity'] . '</td>';
                    echo ' <td>' . $product['price'] . '</td>';
                    echo ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['image'] . '"></td>';
                    echo ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['impressive_image'] . '"></td>';
                    echo ' <td>' . $product['describe'] . '</td>';
                    echo ' <td>' . $product['categories'] . '</td>';
                    echo ' <td>' . $product['sold_quantity'] . '</td>';
                    echo ' <td>' . $product['size_s'] . '</td>';
                    echo ' <td>' . $product['size_m'] . '</td>';
                    echo ' <td>' . $product['size_l'] . '</td>';
                    echo ' <td>' . $product['size_xl'] . '</td>';
                    echo ' <td>' . $product['oversize'] . '</td>';
                    echo ' <td>' . $product['color'] . '</td>';
                    if (isset($_GET['act']) && $_GET['act'] == 'update-products') {
                      echo ' <td><a href="index.php?action=request&act=update-products" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success edit_btn" data-id="' . $product['id'] . '">Sửa</a></td>';
                    }
                    if (isset($_GET['act']) && $_GET['act'] == 'delete-products') {
                      echo '<td><a href="index.php?action=request&act=delete-products" data-id="' . $product['id'] . '" class="btn btn-danger delete_btn">Xóa</a></td>';
                    }
                    echo '</tr>';
                  endif;
                endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- End of Main Content -->






  <!-- <table class="table table-bordered">
  <thead>
    <tr>
      <th>ID sản phẩm</th>
      <th>Tên sản phẩm</th>
      <th>Số lượng </th>
      <th>Đơn giá</th>
      <th>Hình ảnh</th>
      <th>Ảnh liên quan</th>
      <th>Mô tả</th>
      <th>Danh mục</th>
      <th>Số lượng đã bán</th>
      <th>Size_s</th>
      <th>Size_m</th>
      <th>Size_l</th>
      <th>Size_xl</th>
      <th>Oversize</th>
      <th>Màu</th>
    </tr>
  </thead>
  <tbody id="product_display">
    <?php
    $product_model = new product();
    $products = $product_model->getProduct()->fetchAll();
    $deleteProducts = $product_model->getDeleteProducts()->fetchAll();
    $deleted = array();
    foreach ($products as $product) :
      foreach ($deleteProducts as $productDelete) :
        if ($product['id'] === $productDelete['deleteID']) {
          $deleted[] = $product['id'];
        }
      endforeach;
      if (!in_array($product['id'], $deleted)) :
        echo '<tr>';
        echo ' <td>' . $product['id'] . '</td>';
        echo ' <td>' . $product['product_name'] . '</td>';
        echo ' <td>' . $product['quantity'] . '</td>';
        echo ' <td>' . $product['price'] . '</td>';
        echo ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['image'] . '"></td>';
        echo ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['impressive_image'] . '"></td>';
        echo ' <td>' . $product['describe'] . '</td>';
        echo ' <td>' . $product['categories'] . '</td>';
        echo ' <td>' . $product['sold_quantity'] . '</td>';
        echo ' <td>' . $product['size_s'] . '</td>';
        echo ' <td>' . $product['size_m'] . '</td>';
        echo ' <td>' . $product['size_l'] . '</td>';
        echo ' <td>' . $product['size_xl'] . '</td>';
        echo ' <td>' . $product['oversize'] . '</td>';
        echo ' <td>' . $product['color'] . '</td>';
        if (isset($_GET['act']) && $_GET['act'] == 'update-products') {
          echo ' <td><a href="index.php?action=request&act=update-products" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success edit_btn" data-id="' . $product['id'] . '">Sửa</a></td>';
        }
        if (isset($_GET['act']) && $_GET['act'] == 'delete-products') {
          echo '<td><a href="index.php?action=request&act=delete-products" data-id="' . $product['id'] . '" class="btn btn-danger delete_btn">Xóa</a></td>';
        }
        echo '</tr>';
      endif;
    endforeach; ?>
  </tbody>
</table>'; -->
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-fullscreen p-4">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Chỉnh sửa sản phẩm</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form id="update-products" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">ID sản phẩm</label>
                  <input class="form-control" type="text" name="id" id="id" readonly>
                  <span style='color:red;' class="error_id"></span>
                </div>
                <div class="form-group">
                  <label for="">Tên sản phẩm</label>
                  <input class="form-control" type="text" name="product_name" id="product_name">
                  <span style='color:red;' class="error_product_name"></span>
                </div>
                <div class="form-group">
                  <label for="">Số lượng sản phẩm</label>
                  <input class="form-control" type="number" value="0" name="quantity" id="quantity">
                  <span style='color:red;' class="error_quantity"></span>
                </div>
                <div class="form-group">
                  <label for="">Đơn giá sản phẩm</label>
                  <input class="form-control" type="number" value="0" name="price" id="price">
                  <span style='color:red;' class="error_price"></span>
                </div>
                <div class="form-group">
                  <label for="">Ảnh sản phẩm</label>
                  <input class="form-control" type="file" name="image" id="image">
                  <span style='color:red;' class="error_image"></span>
                </div>
                <div class="form-group">
                  <label for="">Ảnh liên quan sản phẩm</label>
                  <input class="form-control" type="file" name="impressive_image" id="impressive_image">
                  <span style='color:red;' class="error_impressive_image"></span>
                </div>
                <div class="form-group">
                  <label for="">Mô tả sản phẩm</label>
                  <input class="form-control" type="text" name="describe" id="describe">
                  <span style='color:red;' class="error_describe"></span>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">Danh mục sản phẩm </label>

                  <select name="categories" id="" class="form-control" id="categories">
                    <option value="">Chọn danh mục</option>
                    <?php
                    $product_model = new product();
                    $products = $product_model->getCategories()->fetchAll();
                    foreach ($products as $product) :
                      echo '<option value="' . $product['categories_name'] . '">' . $product['categories_name'] . '</option>';
                    endforeach;
                    ?>
                  </select>
                  <span style='color:red;' class="error_categories"></span>
                </div>
                <div class="form-group">
                  <label for="">Số sản phẩm đã bán</label>
                  <input class="form-control" type="number" value="0" name="sold_quantity" id="sold_quantity">
                  <span style='color:red;' class="error_sold_quantity"></span>
                </div>
                <div class="form-group">
                  <label for="">Kích cỡ nhỏ</label>
                  <input class="form-control" type="number" value="0" name="size_s" id="size_s">
                  <span style='color:red;' class="error_size_s"></span>
                </div>
                <div class="form-group">
                  <label for="">Kích cỡ vừa</label>
                  <input class="form-control" type="number" value="0" name="size_m" id="size_m">
                  <span style='color:red;' class="error_size_m"></span>
                </div>
                <div class="form-group">
                  <label for="">Kích cỡ lớn</label>
                  <input class="form-control" type="number" value="0" name="size_l" id="size_l">
                  <span style='color:red;' class="error_size_l"></span>
                </div>
                <div class="form-group">
                  <label for="">Kích cỡ Xl</label>
                  <input class="form-control" type="number" value="0" name="size_xl" id="size_xl">
                  <span style='color:red;' class="error_size_xl"></span>
                </div>
                <div class="form-group">
                  <label for="">Oversize</label>
                  <input class="form-control" type="number" value="0" name="oversize" id="oversize">
                  <span style='color:red;' class="error_oversize"></span>
                </div>
                <div class="form-group">
                  <label for="">Màu</label>
                  <input class="form-control" type="text" name="color" id="color">
                  <span style='color:red;' class="error_color"></span>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
              </div>
            </div>
          </form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $(document).on('click', '.edit_btn', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        $.ajax({
          url: 'index.php?action=resolve&act=update',
          method: "post",
          data: {
            id
          },
          dataType: 'json',
          success: function(response) {
            if (response.failed) {
              swal({
                title: 'Có lỗi xảy ra',
                icon: 'error'
              })
            } else {
              $('#id').val(response.product.id)
              $('#product_name').val(response.product.product_name)
              $('#quantity').val(response.product.quantity)
              $('#price').val(response.product.price)
              $('#sold_quantity').val(response.product.sold_quantity)
              $('#describe').val(response.product.describe)
              $('#categories').val(response.product.categories)
              $('#size_s').val(response.product.size_s)
              $('#size_m').val(response.product.size_m)
              $('#size_l').val(response.product.size_l)
              $('#size_xl').val(response.product.size_xl)
              $('#oversize').val(response.product.oversize)
              $('#color').val(response.product.color)

            }
          }
        })
        $(document).on('submit', '#update-products', function(e) {
          e.preventDefault();
          let formData = new FormData(this)
          formData.append('request', 'update-products')
          console.log(formData);
          $.ajax({
            url: './ajax/products.php',
            method: "POST",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
              if (response.error) {
                $('.error_id').text(response.errors.id);
                $('.error_product_name').text(response.errors.product_name);
                $('.error_image').text(response.errors.image);
                $('.error_impressive_image').text(response.errors.impressive_image);
                $('.error_describe').text(response.errors.describe);
                $('.error_color').text(response.errors.color);
                $('.error_categories').text(response.errors.categories);
              } else if (response.failed) {
                swal({
                  title: 'Cập nhật sản phầm không thành công',
                  text: ' Có lỗi xảy ra',
                  icon: 'error'
                })
              } else {
                swal({
                  title: "Cập nhật sản phẩm thành công",
                  icon: 'success'
                }).then(function() {
                  // Ẩn modal
                  $('#myModal').modal('hide');
                  $('#product_display').html(response.html)
                });
              }
            }
          })
        })
      })
      $(document).on('click', '.delete_btn', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        console.log(id);
        swal({
          title: 'Bạn có chắc chắn muốn xóa sản phẩm này',
          icon: 'warning'
        }).then(agr => {
          if (agr) {
            $.ajax({
              url: 'index.php?action=resolve&act=delete',
              method: 'POST',
              data: {
                id
              },
              dataType: 'json',
              success: function(data) {
                if (data.success) {
                  swal({
                    title: 'Xóa thành công',
                    icon: 'success'
                  }).then(success => {
                    $('#product_display').html(data.html)
                   
                  })

                } else {
                  swal({
                    title: 'Xóa không thành công',
                    icon: 'error'
                  })
                }
              }
            })
          }
        })
      })
    })
  </script>