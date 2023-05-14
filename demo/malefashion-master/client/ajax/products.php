<?php
include '../model/connect.php';
$page = !empty($_POST['page']) ? $_POST['page'] : 1;
$limitNum = 9;
$start = $page > 1 ? ($page - 1) * $limitNum : 0;
$filter = !empty($_POST['filter']) && $_POST['filter'] !== "Tất cả" ? $_POST['filter'] : '';
$where = !empty($filter) ? " categories = '$filter'" : 1;
$search = !empty($_POST['search']) ? "AND product_name LIKE '%" . $_POST['search'] . "%'" : "";
$limit = "LIMIT $start,$limitNum";
$sort = '';
if (!empty($_POST['sort'])) {
  if ($_POST['sort'] == 1) {
    $sort = "ORDER BY price ASC";
  } elseif ($_POST['sort'] == 2) {
    $sort = "ORDER BY price DESC";
  }
}
$between = '';
$min = $_POST['min'] ?? 100000;
$max = $_POST['max'] ?? 0;
$between = $max > 0 ? "AND price BETWEEN $min AND $max" : "AND price >= $min";
$select = "SELECT * FROM products WHERE $where $between $search $sort $limit";
$conn = new connect();
$count = $conn->getList("SELECT * FROM products WHERE $where $between $search $sort");
$prods = $conn->getList($select)->fetchAll();
$numRow = count($prods);
$countable = count($count->fetchAll());
$totalPage = $countable % $limitNum == 0 ? $countable / $limitNum : ceil($countable / $limitNum);
// phần hiển thị sản phẩm
$product = '';  
if ($numRow > 0) :
  foreach ($prods as $set) :
    $product .= '<div class="col-lg-4 col-md-6 col-sm-6">';
    $product .= '<div class="product__item">';
    $product .= '<div class="product__item__pic" >';
    $product .= ' <img class="product__item__pic set-bg" src="./view/img/product/' . $set['image'] . '" alt="">';
    $product .= '<ul class="product__hover">';
    $product .= '<li><a href="#"><img src="view/img/icon/heart.png" alt=""></a></li>';
    $product .= '<li><a href="#"><img src="view/img/icon/compare.png" alt=""><span>Compare</span></a>';
    $product .= '</li>';
    $product .= '<li><a href="index.php?action=shop&act=product_detail&id=' . $set['id'] . '"><img src="view/img/icon/search.png" alt=""></a></li>';
    $product .= '</ul>';
    $product .= '</div>';
    $product .= '<div class="product__item__text">';
    $product .= '<h6>' . $set['product_name'] . ' </h6>';
    $product .= '<a href="index.php?action=shop&act=product_detail&id=' . $set['id'] . '" class="add-cart">+ Xem sản phẩm</a>';
    $product .= '<div class="rating">';
    $product .= '<i class="fa fa-star-o"></i>';
    $product .= '<i class="fa fa-star-o"></i>';
    $product .= '<i class="fa fa-star-o"></i>';
    $product .= '<i class="fa fa-star-o"></i>';
    $product .= '<i class="fa fa-star-o"></i>';
    $product .= '</div>';
    $product .= '<h5>' . number_format($set['price']) . " VND" . '</h5>';
    $product .= '<div class=" product__color__select">';
    $product .= '<label for="pc-4">';
    $product .= '<input type="radio" id="pc-4">';
    $product .= '</label>';
    $product .= '<label class="active black" for="pc-5">';
    $product .= '<input type="radio" id="pc-5">';
    $product .= '</label>';
    $product .= '<label class="grey" for="pc-6">';
    $product .= '<input type="radio" id="pc-6">';
    $product .= '</label>';
    $product .= '</div>';
    $product .= '</div>';
    $product .= '</div>';
    $product .= '</div>';
  endforeach;
else:
  $product.="<h3>Không có sản phẩm nào </h3>";  
endif;
// phần phân trang
$pagination = '';
$current_page = $_POST['page'] ?? 1;
for ($i = 1; $i <= $totalPage; $i++) :
  $active = $current_page == $i   ? "active" : '';
  $pagination .= '<a class="pagination ' . $active . '" data-page="' . $i . '" href="#page=' . $i . '">' . $i . '</a>';
endfor;
// endif;
header('Content-Type: application/json');
echo json_encode(array(
  'product' => $product,
  'pagination' => $pagination,
  'start' => $start,
  'limit' => $limitNum,
  'all' => $countable
));
