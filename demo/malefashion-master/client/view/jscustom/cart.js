$(document).ready(function () {
  let addedToCart = false;
  $.ajax({
    url:'index.php?action=cart',
    dataType:'json',
    success:function(response){
      $('#sessioncart_quantity').text(response.quantity);
      $('#sessioncart_total').text(response.total.toLocaleString('vi-VN') + 'đ');
    }
  });

  $("#add_cart_form").on('submit',function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    let product_id = $('#product_id').val();
    let size = $('input[name="size"]:checked').val();
    let quantity = $('#quantity').val();
    console.log(product_id, size,quantity);
    $.ajax({
      url:'index.php?action=cart&act=addtocart',
      method:'POST',
      data: {product_id, size, quantity},
      dataType:'json',
      success:function(response){
        if(response.alertQuantity){
          swal({
            title: "Vượt quá số lượng cho phép",
            text: `Số lượng sản phẩm còn lại là ${response.maxQuantity}`,
            icon: "error",
          })    
        }
        else if(response.success){
          console.log(response.size);
          $('#sessioncart_total').text(response.total.toLocaleString('vi-VN') + 'đ');
          $('#sessioncart_quantity').text(response.quantity);
            swal({
              title: "Thêm sản phẩm thành công",
              text: "Nhấn vào nút OK để đóng",
              icon: "success",
            });
            addedToCart = true; 
          }
          else if(response.updated){
            console.log(response.size);
            $('#sessioncart_total').text(response.total.toLocaleString('vi-VN') + 'đ');
            $('#sessioncart_quantity').text(response.quantity);
            swal({
              title: "Cập nhật sản phẩm thành công",
              text: "Nhấn vào nút OK để đóng",
              icon: "success",
            });
            addedToCart = true;
          }
        else if(response.withoutSize){
          swal({
            title: "Thêm sản phẩm không thành công",
            text: "Vui lòng chọn kích cỡ",
            icon: "error",
          });
        }
        // $.getScript('./view/jscustom/cart.js')
      }
    });
  });

  // Sửa sản phẩm
  $(document).on('change','.quantityChange',function(){
    let quantity = $(this).val();
    let product_id = $(this).data('id');
    let size = $(this).data('size');
    console.log(quantity,product_id);
    $.ajax({
      url:'index.php?action=cart&act=update',
      method:'POST',
      dataType:'json',
      data:{quantity, product_id, size},
      success:function(response){
        $('.body_cart').html(response.cart);
        if(response.total){
          $('#total').html(response.total.toLocaleString('vi-VN') + 'đ');
          $('#sessioncart_total').text(response.total.toLocaleString('vi-VN') + 'đ');
          $('#sessioncart_quantity').text(response.quantity);
          $('#discount_total').html(response.total+'đ')
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log("AJAX Error:", textStatus, errorThrown);
      }
    });
  });

  // Xóa sản phẩm
  $(document).on('click','.fa.fa-close.deleteIcon',function(){
    let product_id = $(this).data('id');
    let size = $(this).data('size');
    console.log(product_id,size);
    swal({
      title: "Bạn có chắc chắn muốn xóa sản phẩm này?",
      text: "Sản phẩm sẽ bị xóa khỏi giỏ hàng của bạn!",
      icon: "warning",
      buttons: ["Hủy bỏ", "Xóa"],
      dangerMode: true,
      })
      .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url:'index.php?action=cart&act=delete',
          method:"POST",
          data:{product_id, size},
          dataType:'json',
          success:function(response){
            $('.body_cart').html(response.cart);
            if(response.total){
              $('#total').html(response.total.toLocaleString('vi-VN') + 'đ');
              $('#sessioncart_total').text(response.total.toLocaleString('vi-VN') + 'đ');
              $('#sessioncart_quantity').text(response.quantity);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX Error:", textStatus, errorThrown);
          }
        });
      } 
    });
  });
});