<?php

if (isset($_GET['masp'])) {
  $product = new product();
  $result = $product->getProduct($_GET['masp']);
  $masp = $result['masp'];
  $tensp = $result['tensp'];
  $soluong = $result['soluong'];
  $dongia = $result['dongia'];
  $hinh = $result['hinh'];
  $mota = $result['motasanpham'];
  $loaisp = $result['Nhom'];
  $soluongban = $result['soluongban'];
}

?>

<div class="container d-flex justify-content-center mt-2 ">
  <?php 
  if(isset($_GET['masp'])):
  ?>
  <form action="index.php?action=product&act=update" method="post" enctype="multipart/form-data">
  <?php else: ?>
    <form action="index.php?action=product&act=add" method="post" enctype="multipart/form-data">
      <?php endif?>
    <div class="form-group">
      <label for="">Mã sản phẩm</label>
      <input type="text" class="form-control" name="masp" value="<?php if(isset($masp))  echo $masp ?>">
    </div>
    <div class="form-group">
      <label for="">Tên sản phẩm</label>
      <input type="text" class="form-control" name="tensp" value="<?php if(isset($tensp))  echo $tensp ?>">
    </div>
    <div class="form-group">
      <label for="">Số lượng</label>
      <input type="number" class="form-control" name="soluong" value="<?php if(isset($soluong))  echo $soluong ?>">
    </div>
    <div class="form-group">
      <label for="">Đơn giá</label>
      <input type="number" class="form-control" name="dongia" value="<?php  if(isset($dongia)) echo $dongia ?>">
    </div>
    <div class="form-group">
      <label for="">Ảnh</label>
      <input type="file" class="form-control" name="hinh" value="<?php  if(isset($hinh)) echo $hinh ?>">
    </div>
    <div class="form-group">
      <label for="">Mô tả sản phẩm</label>
      <textarea name="mota" id="change" cols="30" rows="5">
      <?php  if(isset($mota)) echo $mota ?>
    </textarea>
    </div>
    <div class="form-group">
      <select class="form-control" name="Nhom">
        <option value="">Chọn loại</option>
        <?php
        $type = new product();
        $result = $type->getLoai();
        while ($set = $result->fetch()) :
        ?>
          <option <?php if(isset($loaisp) && $loaisp == $set['maloai']) echo 'selected' ?>  value="<?php  echo $set['maloai'] ?>"><?php  echo $set['maloai'] ?> - <?php  echo $set['loaisp'] ?></option>
        <?php endwhile ?>
      </select>

    </div>
    <div class="form-group">
      <label for="">Số lượng bán</label>
      <input type="number" class="form-control" name="soluongban" value="<?php  if(isset($soluongban)) echo $soluongban ?>">
    </div>
    <?php
    if(isset($_GET['masp'])):
    ?>
    <button type="submit" class="btn btn-primary w-50">Cập nhật</button>
    <?php else: ?>
      <button type="submit" class="btn btn-primary w-50">Thêm</button>
      <?php endif?>
  </form>
</div>