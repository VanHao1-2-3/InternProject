<?php
$act = $_GET['act'] ?? null;
switch ($act) {
  case 'product_detail':
    
    include './view/shop-details.php';
    break;
  case 'comments':
    $result = '';
    $comment = $_POST['comment'] ?? '';
    $rating = $_POST['rating'] ?? 1;
    $product_id = $_POST['product_id'] ?? '';
    $customer_id = $_SESSION['customer_id'] ?? '';
    $comment_result = '';
    $product = new products();

    if (empty($_SESSION['customer_id'])) {
      $result = array('noLogin' => true);
    } elseif (empty($comment) || empty($rating)) {
      $result = array('noContent' => true);
    } elseif(!empty($product_id)) {
      $comment_result =   $product->insertComment($product_id, $customer_id, $comment, $rating);
      if ($comment_result) {
        $result = array('success' => true);
      } else {
        $result = array('failed' => $comment_result);
      }
    }

    $comment_display = '';
    $user = new user();
    $commentAll = $product->getComments($product_id);
    $commentResult = $commentAll->fetchAll();
    // Lấy thời gian hiện tại
    $current_time = new DateTime();

    // Lấy thời gian của bình luận được lưu trong cơ sở dữ liệu
    ;
    $totalCmt = count($commentResult);
    foreach ($commentResult as $cmt) :
      $comment_time = new DateTime($cmt['dateCmt']);
  
      // Tính toán khoảng thời gian giữa hai thời điểm
      $time_diff = $current_time->diff($comment_time);
  
      // Hiển thị khoảng thời gian dưới dạng chuỗi
      $customer = $user-> getUser($cmt['customer_id']);
      $ratingNum = $cmt['rating'];
      $comment_display.=' <div class="row">';
      $comment_display.=' <div class="card mb-3  w-100">';
      $comment_display.=' <div class="card-body d-flex gap-2">';
      $comment_display.=' <img width="70" src="./view/img/user/'.$customer['avatar'].'">';
      $comment_display.= '<div>';
      $comment_display.=' <h5 class="card-title">'.$customer['customer_name'].'</h5>';
      $comment_display.=' <div class="rating">';
      for($i = 1; $i <= 5 ; $i++):
      if($i<= $ratingNum){
        $comment_display.=' <span class="star selected">&#9733;</span>';
      }else{
        $comment_display.=' <span class="star">&#9733;</span>';
      }
      endfor;
      $comment_display.=' <p class="card-text">'.$cmt['contents'].'</p>';
      $comment_display.=' <p class="card-text">'.$time_diff->format('%d ngày, %h giờ, %i phút, %s giây').'</p>';
      $comment_display.= '</div>';
      $comment_display.=' </div>';
      $comment_display.=' </div>';
      $comment_display.=' </div></div>';
    endforeach;
    // show comments


    echo json_encode(array_merge($result, array('comment_display'=> $comment_display,'totalCmt'=> $totalCmt)));
    break;
  default:
    include './view/shop.php';
    break;
}
?>