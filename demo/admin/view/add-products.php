<div class="d-flex justify-content-center">
<form id="add-products" class=" w-50" enctype="multipart/form-data">
  <h3>Thêm sản phẩm</h3>
  <div class="form-group">
    <label for="">ID sản phẩm</label>
    <input class="form-control" type="text" name="id">
    <span style='color:red;'class="error_id"></span>
  </div>
  <div class="form-group">
    <label for="">Tên sản phẩm</label>
    <input class="form-control" type="text" name="product_name">
    <span style='color:red;'class="error_product_name"></span>
  </div>
  <div class="form-group">
    <label for="">Số lượng sản phẩm</label>
    <input class="form-control" type="number" value="0" name="quantity">
    <span style='color:red;'class="error_quantity"></span>
  </div>
  <div class="form-group">
    <label for="">Đơn giá sản phẩm</label>
    <input class="form-control" type="number" value="0" name="price">
    <span style='color:red;'class="error_price"></span>
  </div>
  <div class="form-group">
    <label for="">Ảnh sản phẩm</label>
    <input class="form-control" type="file" name="image">
    <span style='color:red;'class="error_image"></span>
  </div>
  <div class="form-group">
    <label for="">Ảnh liên quan sản phẩm</label>
    <input class="form-control" type="file" name="impressive_image">
    <span style='color:red;'class="error_impressive_image"></span>
  </div>
  <div class="form-group">
    <label for="">Mô tả sản phẩm</label>
    <input class="form-control" type="text" name="describe">
    <span style='color:red;'class="error_describe"></span>
  </div>
  <div class="form-group">
    <label for="">Danh mục sản phẩm </label>
    
    <select name="categories" id="" class="form-control">
      <option value="">Chọn danh mục</option>
      <?php
  $product_model = new product();
  $products = $product_model -> getCategories() -> fetchAll();
  foreach($products as $product):
      echo '<option value="'.$product['categories_name'].'">'.$product['categories_name'].'</option>';
  endforeach;
      ?>
      </select>
    <span style='color:red;'class="error_categories"></span>
  </div>
  <div class="form-group">
    <label for="">Số sản phẩm đã bán</label>
    <input class="form-control" type="number" value="0" name="sold_quantity">
    <span style='color:red;'class="error_sold_quantity"></span>
  </div>
  <div class="form-group">
    <label for="">Kích cỡ nhỏ</label>
    <input class="form-control" type="number" value="0" name="size_s">
    <span style='color:red;'class="error_size_s"></span>
  </div>  
  <div class="form-group">
    <label for="">Kích cỡ vừa</label>
    <input class="form-control" type="number" value="0" name="size_m">
    <span style='color:red;'class="error_size_m"></span>
  </div>  
  <div class="form-group">
    <label for="">Kích cỡ lớn</label>
    <input class="form-control" type="number" value="0" name="size_l">
    <span style='color:red;'class="error_size_l"></span>
  </div>  
  <div class="form-group">
    <label for="">Kích cỡ Xl</label>
    <input class="form-control" type="number" value="0" name="size_xl">
    <span style='color:red;'class="error_size_xl"></span>
  </div>  
  <div class="form-group">
    <label for="">Oversize</label>
    <input class="form-control" type="number" value="0" name="oversize">
    <span style='color:red;'class="error_oversize"></span>
  </div>
  <div class="form-group">
    <label for="">Màu</label>
    <input class="form-control" type="text" name="color">
    <span style='color:red;'class="error_color"></span>
  </div>
  <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>
</div>
<script>
  $(document).ready(function(){
$(document).on('submit','#add-products',function(e){
  e.preventDefault()
  let formData = new FormData(this)
  formData.append('request','add-products')
  console.log(formData);
  $.ajax({
    url:'./ajax/products.php',
    method:"POST",
    data: formData,
    dataType:'json',
    processData:false,
    contentType:false,
    success:function(response){
      if(response.error){
            $('.error_id').text(response.errors.id);
            $('.error_product_name').text(response.errors.product_name);
            $('.error_image').text(response.errors.image);
            $('.error_impressive_image').text(response.errors.impressive_image);
            $('.error_describe').text(response.errors.describe);
            $('.error_color').text(response.errors.color);
            $('.error_categories').text(response.errors.categories);
      }
      else if(response.failed){
        swal({
          title:'Thêm sản phầm không thành công',
          text :' Có lỗi xảy ra',
          icon:'error'
        })
      }else{
        swal({
          title:"Thêm sản phẩm thành công",
          icon:'success'
        })
      }
    },
    error: function(xhr, status, error) {
        // Hiển thị thông báo lỗi
        console.log("Lỗi: " + error);
    }
  })
})
$(document).on('keyup','.form-control',function(){
  $('.error_id').text('');
            $('.error_product_name').text('');
            $('.error_image').text('');
            $('.error_impressive_image').text('');
            $('.error_describe').text('');
            $('.error_color').text('');
            $('.error_categories').text('');
})

  })
</script>