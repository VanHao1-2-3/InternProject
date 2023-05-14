<?php
$limit = 4;
$page = new page();
$prods = new product();
$count = $prods->getCount();
$start = $page->findStart();
$totalPage = $page->getTotalPage($count, $limit);
$pageProduct = $prods->getPageProduct($start, $limit);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
?>
<style>
  ul li {
    list-style-type: none;
  }
</style>
<div>
  <div class="row">
    <div class="col-lg-2 col-md-2 ">
      <ul class="nav nav-pills flex-column sidebar gap-3" role="tablist">
        <li class="nav-item">
          <a class="nav-link active mt-5" data-bs-toggle="pill" href="#product">Sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#producttypes">Loại sản phẩm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#bills">Hóa đơn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#billDetail">Chi tiết hóa đơn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#listuser">Danh sách khách hàng</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#setting">Cài đặt</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="pill" href="#chart">Thống kê</a>
        </li>
      </ul>
    </div>
    <div class="col-lg-10  col-md-10">
      <div class="tab-content">
        <div id="product" class="tab-pane active" data-bs-toggle="tab">
          <a href="index.php?action=product"><button class="btn btn-outline-success my-3 text-dark fw-bold">Thêm sản phẩm</button></a>
          <table class="table table-bordered ">
            <tr>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng </th>
              <th>Đơn giá</th>
              <th>Ảnh</th>
              <th>Mô tả sản phẩm</th>
              <th>Loại sản phẩm</th>
              <th>Số lượng bán</th>
              <th>Cập nhật</th>
              <th>Xóa</th>
            </tr>
            <?php
            $prods = new product();
            $result = $prods->getPageProduct($start, $limit);

            while ($set = $result->fetch()) :
            ?>
              <tr>
                <td><?php echo $set['masp'] ?></td>
                <td><?php echo $set['tensp'] ?></td>
                <td><?php echo $set['soluong'] ?></td>
                <td><?php echo number_format($set['dongia']) ?></td>
                <td class="d-flex justify-content-center align-items-center"><img src="..\Freshmart-Organic-Food/View/img/product/<?php echo $set['hinh'] ?>" alt="" class="w-50 img-fluid "></td>
                <td><textarea class="textarea" cols="30" rows="10"><?php echo $set['motasanpham'] ?></textarea></td>
                <td><?php
                    echo $set['Nhom'] . '-' . $prods->getTenLoai($set['Nhom'])[0];
                    ?></td>
                <td><?php echo $set['soluongban'] ?></td>
                <td style="width:130px;"><a href="index.php?action=product&masp=<?php echo $set['masp'] ?>"><button class="btn btn-warning ">Cập nhật</button></a></td>
                <td style="width:100px;"><button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $set['masp'] ?>" class="btn btn-danger ">Xóa</button></td>
              </tr>
              <div class="modal fade" id="exampleModal<?php echo $set['masp'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4 class="py-3">Bạn có chắc chắn muốn xóa loại sản phẩm có mã sản phẩm là : <?php echo $set['masp'] . '-' . $set['tensp'] ?>?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                      <a href="index.php?action=product&act=delete&masp=<?php echo $set['masp'] ?>"> <button type="button" class="btn btn-primary">Có</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          </table>
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="index.php?action=home&page=<?php if ($currentPage > 1) echo $currentPage - 1;
                                                                                        else echo 1 ?>">Previous</a></li>
            <?php if ($currentPage >= 4) : ?>
              <li class="page-item"><a class="page-link" href="index.php?action=home&page=1">1</a></li>
              <span>...</span>
            <?php endif ?>
            <?php
            for ($i = 1; $i <= $totalPage; $i++) :
            ?>
              <?php
              if ($i != $currentPage) :
                if ($i >= $currentPage - 2 && $i <= $currentPage + 2) :
              ?>
                  <li class="page-item"><a class="page-link" href="index.php?action=home&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endif ?>
              <?php else : ?>
                <li class="page-item"><a style="background-color: blue;color:white;" class="page-link" href="index.php?action=home&page=<?php echo $i ?>"><?php echo $i ?></a></li>
              <?php endif ?>
            <?php endfor ?>
            <?php if ($currentPage <= $totalPage - 3) : ?>
              <span>...</span>
              <li class="page-item"><a class="page-link" href="index.php?action=home&page=<?php echo $totalPage ?>"><?php echo $totalPage ?></a></li>
            <?php endif ?>
            <li class="page-item"><a class="page-link" href="index.php?action=home&page=<?php if ($currentPage < $totalPage) echo $currentPage + 1;
                                                                                        else echo $totalPage ?>">Next</a></li>
          </ul>
        </div>
        <div id="producttypes" class="tab-pane" data-bs-toggle="tab">
          <a href="index.php?action=type&act=add"> <button class="btn btn-outline-success my-3 text-dark fw-bold " type="submit">Thêm loại sản phẩm</button></a>
          <table class="table table-bordered">
            <tr>
              <th>Mã loại</th>
              <th>Tên loại</th>
              <th>Cập nhật</th>
              <th>Xóa</th>
            </tr>
            <?php
            $prods = new product();
            $result = $prods->getLoai();
            while ($set = $result->fetch()) :
            ?>
              <tr>
                <td><?php echo $set['maloai'] ?></td>
                <td><?php echo $set['loaisp'] ?></td>
                <td style="width:150px;"><a href="index.php?action=type&act=update&maloai=<?php echo $set['maloai'] ?>"><button class="btn btn-warning ">Cập nhật</button></a></td>
                <td style="width:150px;"><button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $set['maloai'] ?>" class="btn btn-danger ">Xóa</button></td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="exampleModal<?php echo $set['maloai'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4 class="py-3">Bạn có chắc chắn muốn xóa loại sản phẩm này?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                      <a href="index.php?action=type&act=type_delete&maloai=<?php echo $set['maloai'] ?>"> <button type="button" class="btn btn-primary">Có</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          </table>
        </div>
        <div id="bills" class="tab-pane" data-bs-toggle="tab">
          <table class="table table-bordered">
            <tr>
              <th>Mã hóa đơn</th>
              <th>Mã khách hàng</th>
              <th>Ngày đặt</th>
              <th>Tổng tiền</th>
              <th>Cập nhật</th>
              <th>Xóa</th>
            </tr>
            <?php
            $bill = new bill();
            $result = $bill->getBill();
            while ($set = $result->fetch()) :
            ?>
              <tr>
                <td><?php echo $set['mahd'] ?></td>
                <td><?php echo $set['makh'] ?></td>
                <td><?php echo $set['ngaydat'] ?></td>
                <td><?php echo number_format($set['tongtien']) ?></td>
                <td style="width:150px;"><a href="index.php?action=bill&act=update&mahd=<?php echo $set['mahd'] ?>"><button class="btn btn-warning ">Cập nhật</button></a></td>
                <td style="width:150px;"><button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $set['mahd'] ?>" class="btn btn-danger ">Xóa</button></td>
              </tr>
              <div class="modal fade" id="exampleModal<?php echo $set['mahd'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4 class="py-3">Bạn có chắc chắn muốn xóa hóa đơn này?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                      <a href="index.php?action=bill&act=bill_delete&mahd=<?php echo $set['mahd'] ?>">
                        <button type="button" class="btn btn-primary">Có</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          </table>
        </div>
        <div id="billDetail" class="tab-pane" data-bs-toggle="tab">
          <table class="table table-bordered">
            <tr>
              <th>Mã hóa đơn</th>
              <th>Mã sản phẩm</th>
              <th>Số lượng</th>
              <th>Thành tiền</th>
              <th>Cập nhật</th>
              <th>Xóa</th>
            </tr>
            <?php
            $billdetail = $bill->getBillDetail();
            while ($set = $billdetail->fetch()) :
            ?>
              <tr>
                <td><?php echo $set['mahd'] ?></td>
                <td><?php echo $set['masp'] ?></td>
                <td><?php echo $set['soluong'] ?></td>
                <td><?php echo number_format($set['thanhtien']) ?></td>
                <td style="width:150px;"><a href="index.php?action=bill&act=detail&mahd=<?php echo $set['mahd'] ?>&masp=<?php echo $set['masp'] ?>"><button class="btn btn-warning ">Cập nhật</button></a></td>
                <td style="width:150px;"><button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $set['masp'] . $set['mahd'] ?>" class="btn btn-danger ">Xóa</button></td>
              </tr>
              <div class="modal fade" id="exampleModal<?php echo $set['masp'] . $set['mahd'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4 class="py-3">Bạn có chắc chắn muốn xóa mã sản phẩm <?php echo $set['masp'] ?> của hóa đơn số <?php echo $set['mahd'] ?></h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                      <a href="index.php?action=bill&act=billDetail_delete&masp=<?php echo $set['masp'] ?>&mahd=<?php echo $set['mahd'] ?>"> <button type="button" class="btn btn-primary">Có</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          </table>
        </div>
        <div id="listuser" class="tab-pane" data-bs-toggle="tab">
          <table class="table table-bordered">
            <tr>
              <th>Mã khách hàng</th>
              <th>Tên khách hàng</th>
              <th>Địa chỉ</th>
              <th>Email</th>
              <th>Số điện thoại</th>
              <th>Mật khẩu</th>
              <th>Xóa</th>
            </tr>
            <?php
            $user = new user();
            $result = $user->getUser();
            while ($set = $result->fetch()) :
            ?>
              <tr>
                <td><?php echo $set['makh'] ?></td>
                <td><?php echo $set['tenkh'] ?></td>
                <td><?php echo $set['diachi'] ?></td>
                <td><?php echo $set['email'] ?></td>
                <td><?php echo $set['sodt'] ?></td>
                <td><?php echo $set['matkhau'] ?></td>
                <td style="width:150px;"><button data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $set['makh'] ?>" class="btn btn-danger ">Xóa</button></td>
              </tr>
              <div class="modal fade" id="exampleModal<?php echo $set['makh']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <h4 class="py-3">Bạn có chắc chắn muốn xóa khách hàng có mã số là <?php echo $set['makh']?></h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
                      <a href="index.php?action=user&act=delete&makh=<?php echo $set['makh'] ?>"><button type="button" class="btn btn-primary">Có</button></a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endwhile ?>
          </table>
        </div>
        <div id="setting" class="tab-pane" data-bs-toggle="tab">
          <ul class="p-4">
            <li><a href="index.php?action=admin"><button class="btn btn-primary">Đổi mật khẩu</button></a></li>
          </ul>
        </div>
        <div id="chart" class="tab-pane ms-5 mt-100" data-bs-toggle="tab">
          <div class=" d-flex gap-4">
            <form method="post">
              <h2>Thống kê bán hàng </h2>
              <div class="gap-4 d-flex">
                Từ
                <input type="month" class=" w-50" name="month" value="<?php echo isset($_POST['month']) ?  $_POST['month'] : '' ?>">
                <span>đến nay</span>
              </div>
              <button class="btn btn-primary mt-100">Show chart</button>
            </form>
            <script type="text/javascript" src="https://www.google.com/jsapi"></script>
            <script type="text/javascript">
              google.load('visualization', '1.0', {
                'packages': ['corechart']
              });
              google.setOnLoadCallback(drawVisualization);

              function drawVisualization() {
                //thống kê số lượng bán hàng theo mặt hàng vẽ bieu do tron
                // tạo bảng
                var data = new google.visualization.DataTable();
                var tenhh = new Array();
                var soluongban = new Array();
                var rows = new Array();
                var datahh = 0;
                var slban = 0;

                <?php
                if (isset($_POST['month'])) {
                  $month = date('m', strtotime($_POST['month']));
                  $year = date('Y', strtotime($_POST['month']));
                  $hh = new product();
                  $result = $hh->getThongKe_MatHang($month, $year);
                  while ($set = $result->fetch()) {
                    $tensp = $set['tensp'];
                    $soluong = $set['soluong'];
                    echo "tenhh.push('" . $tensp . "');";
                    echo "soluongban.push('" . $soluong . "');";
                  }
                }
                ?>
                // + dòng và cột
                for (var i = 0; i < tenhh.length; i++) {
                  datahh = tenhh[i];
                  slban = parseInt(soluongban[i]);
                  rows.push([datahh, slban]);
                }
                // tạo cột trong DataTable
                data.addColumn('string', "Hàng hóa");
                data.addColumn('number', "Số lượng bán");
                data.addRows(rows);
                // option
                var option = {
                  title: 'Thống kê số lượng bán hàng hóa',
                  'width': 600,
                  'height': 400,
                  'backgroundColor': '#ffffff',

                };
                // ColumnChart, PieChart, BarChart, LineChart
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, option);
              }
            </script>
            <?php
            if (isset($_POST['month'])) : ?>
              <div id="chart_div">Thống kê</div>
            <?php endif ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  </ul>
  <!-- model -->

</div>