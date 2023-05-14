<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng ký</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign Section -->
<div class="sign_in">
  <form  id="signup_form">
    <h3 style="text-align: center;">Đăng ký</h3>
    <div class="form-group">
      <label for="">Tên khách hàng</label>
      <input type="text" name="username" class="form-control" id="username">
      <span class="name_error errors"> </span>
    </div>
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" name="email" class="form-control" id="email">
      <span class="email_error errors"> </span>
    </div>
    <div class="form-group">
      <label for="">Địa chỉ</label>
      <input type="text" name="address" class="form-control" id="address">
      <span class="address_error errors"> </span>
    </div>
    <div class="form-group">
      <label for="">Số điện thoại</label>
      <input type="text" name="phone" class="form-control" id="phone">
      <span class="phone_error errors"> </span>
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="password" class="form-control" id="password">
      <span class="password_error errors"> </span>
    </div>
    <button type="submit" class="btn btn-light">Đăng ký</button>
    <a href="index.php?action=user&act=login" style="text-decoration: none;color: black;">Bạn đã có tài khoản?</a>
  </form>
</div>
<style>
  .errors{
    color: red;
  }
  input{
    margin-bottom: 10px;
  }
</style>