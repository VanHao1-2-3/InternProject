<?php
if(isset($_GET['mahd'])){
  $bill = new bill();
  $rerult= $bill -> getSingleBill($_GET['mahd']);
  $mahd = $rerult['mahd'];
  $makh = $rerult['makh'];
  $ngaydat = $rerult['ngaydat'];
  $tongtien = $rerult['tongtien'];
}
?>
<div class="container d-flex justify-content-center mt-5">
  <form action="index.php?action=bill&act=bill_update" method="post">
    <div class="form-group">
      <label for="">Mã hóa đơn</label>
      <input name="mahd" type="number" value="<?php if(isset($_GET['mahd'])) echo $mahd ;else echo ''?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Mã khách hàng</label>
      <input name="makh" type="number" value="<?php if(isset($_GET['mahd'])) echo $makh ; else echo ''?>" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Ngày đặt</label>
      <input name="ngaydat" type="date" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Đơn giá</label>
      <input disabled name="tongtien" type="number" value="<?php if(isset($_GET['mahd'])) echo $tongtien ;else ''?>" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </form>
</div>