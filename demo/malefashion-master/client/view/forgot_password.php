<div class="container w-25 ">
  <form id="forgot_password_form">
    <h3>Quên mật khẩu</h3>
    <div class="form-group">
      <label for="" class="font-weight-bold ">Nhập email của bạn</label>
      <input type="email" name="email" id="" class="form-control" placeholder="Nhập email của bạn">
    </div>
    <button type="submit" class="btn btn-primary">Gửi mật khẩu mới</button>
  </form>
</div>
<script>
  $(document).ready(function() {
    $(document).on('submit', '#forgot_password_form', function(e) {
      e.preventDefault()
      let formData = $(this).serialize()
      $.ajax({
        url: 'index.php?action=user&act=get_password',
        data: formData,
        method: "POST",
        dataType: 'json',
        beforeSend: function() {
          swal({
            title: 'Đang xử lí',
            text: 'Vui lòng chờ trong giây lát...',
            icon: 'info',
            buttons: false,
            closeOnClickOutside: false,
            closeOnEsc: false,
          })
        },
        success: function(response) {
          swal.close()
          if (response.success) {
            swal({
              title: 'Làm mới mật khẩu thành công',
              text: 'Mật khẩu mới đã được gửi vào email của bạn',
              icon: 'success'
            }).then(success => {
              window.location.href = "index.php?action=user&act=login"
            })
          } else if (response.senderror) {
            swal({
              title: 'Lỗi khi gửi email',
              text: 'Vui lòng thử lại sau',
              icon: 'error'
            })
          } else {
            swal({
              title: 'Email này không ứng với tài khoản nào',
              text: 'Vui lòng kiểm tra lại email của bạn',
              icon: 'error'
            })
          }
        }
      })
    })
  })
</script>