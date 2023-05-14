<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng nhập</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign Section -->
<div class="sign_in">
  <form action="index.php?action=user&act=login_act" method="post" id="signin_form">
    <h3 style="text-align: center;">Đăng nhập</h3>
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" name="email_signin" class="form-control" >
      <span class="email_signin_error" style="color:red;"></span>
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="password_signin" class="form-control">
      <span class="password_signin_error" style="color:red;"></span>
    </div>
    <button type="submit" class="btn btn-light">Đăng nhập</button>
    <a href="index.php?action=user&act=signup" style="text-decoration: none;color: black;">Bạn chưa có tài khoản?</a><br>
    <a href="index.php?action=user&act=forgot_password">Quên mật khẩu?</a>
  </form>
</div>
<script>
  
</script>