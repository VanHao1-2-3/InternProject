

<form id="login_form">
<div class="form-group">
  <label for="">Tên người quản trị</label>
  <input type="text" name="name" id="" class="form-control">
</div>
<div class="form-group">
  <label for="">Mật khẩu</label>
  <input type="password" name="password" id="" class="form-control">
</div>
<button type="submit" id="submitbtn" class="btn btn-primary">Đăng nhập</button>
</form>
<style>
  body{
    display: flex;
    justify-content: center;
    align-items: center;
    background: url('./view/img/bg.jpg') no-repeat;
    background-size: cover;
  }
  #login_form{
    width: 400px;
    margin-top: 50px;

  }
  #login_form input{
    width: 80%;
  }
  label{
    font-size: 18px;
    font-weight: 550;
    color: white;
  }
</style>
