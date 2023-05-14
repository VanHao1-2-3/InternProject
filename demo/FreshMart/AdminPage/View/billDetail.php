<?php
if (isset($_GET['mahd'])&& isset($_GET['masp'])) {
  $mahd = $_GET['mahd'];
  $masp= $_GET['masp'];
  $bill = new bill();
  $result = $bill->getSingleBillDetail($mahd,$masp);
}
?>
<div class="container d-flex justify-content-center mt-100">
  <form action="index.php?action=bill&act=update_detail" method="post">
    <div class="form-group">
      <label for="">Mã hóa đơn</label>
      <input class="form-control" type="number" disabled value="<?php echo $mahd ?>">
    </div>
    <div class="form-group">
      <label for="">Mã sản phẩm</label>
      <input name="masp" class="form-control" type="text" value="<?php echo $result['masp'] ?>">
    </div>
    <div class="form-group">
      <label for="">Số lượng</label>
      <input name="soluong" class="form-control" type="number" value="<?php echo  $result['soluong'] ?>">
    </div>
    <div class="form-group">
      <label for="">Tổng tiền</label>
      <input  class="form-control" type="number" disabled value="<?php echo  $result['thanhtien'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
  </form>
</div>