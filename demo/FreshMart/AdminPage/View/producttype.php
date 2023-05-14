<div class="container d-flex justify-content-center mt-5">
  <?php
  $maloai = isset($_GET['maloai']) ? $_GET['maloai'] : null;
  $type = new type();
  $tenloai = isset($_GET['maloai']) ? $type->getName($maloai) : '';
  ?>
 <div>
 <?php if (isset($_GET['maloai'])) : ?>
    <form action="index.php?action=type&act=type_update" method="post">
    <?php else : ?>
      <form action="index.php?action=type&act=type_add" method="post">
      <?php endif ?>
      <div class="form-group">
        <label for="">Mã loại</label>
        <input type="number" class="form-control" value="<?php echo $maloai ?>" name="maloai">
      </div>
      <div class="form-group">
        <label for="">Tên loại</label>
        <input type="text" class="form-control" value="<?php echo $tenloai ?>" name="tenloai">
      </div>
      <?php if (isset($_GET['maloai'])) : ?>
        <button type="submit" class="btn btn-primary w-50">Cập nhật</button>
      <?php else : ?>
        <button type="submit" class="btn btn-primary w-50">Thêm loại</button>
      <?php endif ?>
      </form>
      <h1>OR</h1>
      <form action="index.php?action=type&act=import" method="post" enctype="multipart/form-data">

        <input type="file" name="file" />
        <input class="btn btn-secondary w-50" type="submit" name="submit_file" value="Submit">
      </form>
 </div>
</div>