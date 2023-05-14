<table class="table table-bordered">
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
      <th></th>
    </tr>
  </thead>
  <tbody id="product_display">

  </tbody>
</table>
<script>
  $(document).ready(function() {
    $.ajax({
      url: 'index.php?action=product&act=show_product',
      dataType: 'json',
      success: function(response) {
        $('#product_display').html(response.product)
      }
    })
    $(document).on('focusout', '.editable', function() {
      let id = $(this).data('id')
      let value = $(this).text()
      let field = $(this).data('field')
      let editable = $(this)
      $.ajax({
        url: 'index.php?action=product&act=edit_product',
        method: 'POST',
        data: {
          id,
          field,
          value
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            editable.addClass('bg-success');
            setTimeout(function() {
              editable.removeClass('bg-success');
            }, 1000);
          } else if (response.failed) {
            editable.addClass('bg-danger');
            setTimeout(function() {
              editable.removeClass('bg-danger');
            }, 1000);
          }
        }
      })
    })
    $(document).on('change', '.image', function() {
      let $td = $(this).closest('td');
      let $button = $td.find('.edit-button');
      $button.css('display', 'block');
      let image = $(this).val();

    })
    $(document).on('submit', '.edit-image-form', function(e) {
      e.preventDefault()
      const formData = new FormData(this);
      let form = $(this)
      $.ajax({
        url: 'index.php?action=product&act=edit_image',
        method: "POST",
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function(response) {
          if (response.success) {
            form.find('.edit-button').css('display', 'none')
            form.find('.product-image').attr('src', `../client/view/img/product/${response.image}`)
            form.find('.image').val('')
          }
        }
      })
    })
    $(document).on('click', '.delete_icon', function() {
      let id = $(this).data('id')
      swal({
        title: 'Bạn có muốn xóa sản phẩm này',
        icon: 'warning',
        buttons: [{
            text: 'Hủy',
            value: false,
            visible: true,
            className: 'cancel-btn'
          },
          {
            text: 'Xóa',
            value: true,
            visible: true,
            className: 'delete-btn'
          }
        ]
      }).then(success => {
        if(success){
          $.ajax({
          url: 'index.php?action=product&act=delete_product',
          method: 'POST',
          data: {
            id
          },
          dataType: 'json',
          success: function(response) {
            if (response.success) {
              $('#product_display').html(response.product)
            } else {
              swal({
                title: 'Có lỗi xảy ra',
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