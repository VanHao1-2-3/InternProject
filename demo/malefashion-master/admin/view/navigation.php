<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item <?php if(isset($_GET['action']) == 'product') echo 'active'?>">
          <a class="nav-link" href="index.php?action=product">Sản phẩm</a>
        </li>
        <li class="nav-item <?php if(isset($_GET['action']) == 'bill') echo 'active'?>">
          <a class="nav-link" href="index.php?action=bill" id="bill">Hóa đơn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Tài khoản Admin</a>
        </li>
      </ul>
    </div>
  </nav>
