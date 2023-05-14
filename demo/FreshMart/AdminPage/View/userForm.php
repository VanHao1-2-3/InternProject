<?php
if(isset($_GET['makh'])){
  $user = new user();
  $result = $user-> getUserDetail($_GET['makh']);

}
?>
<div class="container d-flex justify-content-center mt-100">
  <form action="index.php?action=user">
    <div class="form-group">
      <label for="">Mã khách hàng</label>
      <input type="text" value="<?php echo $result['makh']?>" placeholder="Mã khách hàng">
    </div>
    <div class="form-group">
      <label for="">Tên khách hàng</label>
      <input type="text" value="<?php echo $result['tenkh']?>" placeholder="Tên khách hàng">
    </div>
    <div class="form-group">
      <label for="">Địa chỉ</label>
      <input type="text" value="<?php echo $result['diachi']?>" placeholder="Địa chỉ">
    </div>
    <div class="form-group">
      <label for="">Email</label>
      <input type="text" value="<?php echo $result['email']?>" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="">Số điện thoại</label>
      <input type="text" value="<?php echo $result['sodt']?>" placeholder="Số điện thoại">
    </div>
    <div class="form-group">
      <label for="">Mật khẩu</label>
      <input type="text" value="<?php echo $result['matkhau']?>" placeholder="Mật khẩu">
    </div>
  </form>
</div>