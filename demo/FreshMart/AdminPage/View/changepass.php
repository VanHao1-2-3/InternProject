<div class="container d-flex justify-content-center mt-100">
  <form action="index.php?action=admin&act=changepassword" method="post">
    <div class="form-group">
    <label for="">Mật khẩu cũ</label>
    <input type="password" name="password"  class="form-control">
    </div>
    <div class="form-group">
    <label for="">Mật khẩu mới</label>
    <input type="password" name="passwordnew"  class="form-control">
    </div>
    <div class="form-group">
    <label for="">Xác nhận mật khẩu</label>
    <input type="password" name="cfpasswordnew"  class="form-control">
    </div>
    <button type="submit" class="btn btn-primary w-50">Đổi mật khẩu</button>
  </form>
</div>