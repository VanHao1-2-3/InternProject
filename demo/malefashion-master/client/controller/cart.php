<?php
$act = $_GET['act'] ?? '';
switch ($act) {
  case 'addtocart':
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
    };
    $size = $_POST['size'] ?? '';
    $product_id = $_POST['product_id'] ?? '';
    $flag = 0;
    if (!empty($product_id)) {
      $product_model = new products();
      $prods = $product_model->getSingleProduct($product_id);
      $product_name = $prods['product_name'];
      $product_price = $prods['price'];
      $image = $prods['image'];
      $size = $_POST['size'] ?? '';
      $maxQuantity = $prods['quantity'];
      $quantity = $_POST['quantity'] ?? 1;
      $total = $quantity * $product_price;
      $product = array(
        'product_id' => $product_id,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'size' => $size,
        'image' => $image,
        'quantity' => $quantity,
        'total' => $total
      );
    }
    $result = '';
    $cartTotal = 0;
    $cartQuantity = 0;
    $availableSize = ['Áo thun',"Sơ mi","Giày",'Áo khoác'];
    if(empty($product['size']) && in_array($prods['categories'],$availableSize)) {
      $flag = 2;
    }

   
    foreach ($_SESSION['cart'] as $key => $prod) {
  
      if(!in_array($prods['categories'],$availableSize)){
        if($product['product_id'] == $prod['product_id']){
          if ($_SESSION['cart'][$key]['quantity'] + $quantity > $maxQuantity) {
            $flag = 3;
          } else {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $_SESSION['cart'][$key]['total'] = $_SESSION['cart'][$key]['quantity'] * $prod['product_price'];
            $flag = 1;
          }
        }else{
          $flag = ($quantity <= $maxQuantity) ? 0 : 3;
        }
      }
     else if (!empty($product['size'])) {
        if ($prod['product_id'] == $product['product_id'] && $prod['size'] == $product['size']) {
          if ($_SESSION['cart'][$key]['quantity'] + $quantity > $maxQuantity) {
            $flag = 3;
          } else {
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $_SESSION['cart'][$key]['total'] = $_SESSION['cart'][$key]['quantity'] * $prod['product_price'];
            $flag = 1;
            break;  
          }
        } else {
          $flag = ($quantity <= $maxQuantity) ? 0 : 3;
           
        }
      }
    
    
  }
    foreach($_SESSION['cart'] as $key => $prod){
      $cartTotal += $_SESSION['cart'][$key]['total'];
    }
    $cartQuantity = count($_SESSION['cart']);
    if ($flag == 0) {
      $_SESSION['cart'][] = $product;
      $result = array('success' => true,'total'=> $cartTotal,'quantity'=>$cartQuantity ,'cart'=>$_SESSION['cart']);
    } elseif ($flag == 1) {
      $result = array('updated' => true,'total'=> $cartTotal,'quantity'=>$cartQuantity ,'cart'=>$_SESSION['cart']);
    } elseif ($flag == 2) {
      $result = array('withoutSize' => true);
    }
    elseif($flag == 3){
      $result = array('alertQuantity' => true,'maxQuantity' =>$maxQuantity);
    }else{
      $result = array('abc'=> 4);
    }
    echo json_encode($result);
    break;
  case 'delete':
    $total = 0;
    $result = null;
    $product_id =  $_POST['product_id'] ?? '';
    $product_model = new products();
    $product = $product_model -> getSingleProduct($product_id);
    $maxQuantity = $product['quantity'];
    $size = $_POST['size'] ?? '';
    foreach ($_SESSION['cart'] as $key => $value) {
      if(isset($product_id) && isset($size)){
        if ($value['product_id'] == $product_id && $value['size'] == $size) {
          unset($_SESSION['cart'][$key]);
          $product_id = '';
          $size = '';
          $count = count($_SESSION['cart']);
        }
      }
    }
    $cart = '';
    foreach ($_SESSION['cart'] as $prods) :
      $total += $prods['total'];
      $cart .= '<tr>';
      $cart .= '<td class="product__cart__item">';
      // $cart.= '<div class="product__cart__item__pic">';
      $cart .= ' <img style="width:70px;" src="./view/img/product/' . $prods['image'] . '" alt=""/>';
      $cart .= ' </div>';
      $cart .= '<div class="product__cart__item__text">';
      $cart .= '<h6>' . $prods['product_name'] . '</h6>';
      $cart .= '<h5>' . number_format($prods['product_price']) . ' VND</h5>';
      $cart .= '</div>';
      $cart .= '</td>';
      $cart .= '<td class="quantity__item">';
      // $cart .= '<div class="quantity">';
      // $cart .= '<div class="pro-qty-2">';
      $cart .= '<input type="number" id="quantity" min="1" max="'.$maxQuantity.'" value="' . $prods['quantity'] . '" class="quantityChange" data-size="' . $prods['size'] . '" data-id="' . $prods['product_id'] . '"/> ';
      // $cart .= '</div>';
      // $cart .= '</div>';
      $cart .= '</td>';
      $cart .= '<td class="cart__price">' . $prods['size'] . '</td>';
      $cart .= '<td class="cart__price">' . number_format($prods['total']) . 'đ</td>';
      $cart .= '<td class="cart__close"><i  class="fa fa-close deleteIcon" data-size="' . $prods['size'] . '" data-id="' . $prods['product_id'] . '"></i></td>';
      $cart .= '</tr>';
    endforeach;
    
    echo json_encode(array('cart' => $cart, 'total' => $total,'quantity'=> $count));
    break;
    case 'update':
    $product_id =  $_POST['product_id']  ?? '';
    $size =  $_POST['size']  ?? '';
    $quantity =  $_POST['quantity']  ?? '';
    $product_model = new products();
    $product = $product_model -> getSingleProduct($product_id);
    $maxQuantity = $product['quantity'];
    $maxQuantityAlert = false;
    foreach($_SESSION['cart'] as $key => $value){
      if(isset($product_id) && isset($size) && isset($quantity)){
        if($value['product_id'] == $product_id && $size == $value['size'] && $value['quantity'] != $quantity){
            $_SESSION['cart'][$key]['quantity'] = $quantity;
            $_SESSION['cart'][$key]['total'] = $quantity * $value['product_price'];
            $product_id = '';
            $size = '';
            $quantity = '';

        }
      }
    }
    $cart = '';
    $total = 0;
    foreach ($_SESSION['cart'] as $prods) :
      $total += $prods['total'];
      $cart .= '<tr>';
      $cart .= '<td class="product__cart__item">';
      // $cart.= '<div class="product__cart__item__pic">';
      $cart .= ' <img style="width:70px;" src="./view/img/product/' . $prods['image'] . '" alt=""/>';
      $cart .= ' </div>';
      $cart .= '<div class="product__cart__item__text">';
      $cart .= '<h6>' . $prods['product_name'] . '</h6>';
      $cart .= '<h5>' . number_format($prods['product_price']) . ' VND</h5>';
      $cart .= '</div>';
      $cart .= '</td>';
      $cart.= '<td class="quantity__item">';
      // $cart.= '<div class="quantity">';
      // $cart.= '<div class="pro-qty-2">';
      $cart.= '<input type="number" min="1" id="quantity" max="'.$maxQuantity.'" value="'.$prods['quantity'].'" class="quantityChange" data-size="'.$prods['size'].'" data-id="'.$prods['product_id'].'"/> '; 
      // $cart.= '</div>';
      // $cart.= '</div>';
      $cart.= '</td>';
      $cart .= '<td class="cart__price">' . $prods['size'] . '</td>';
      $cart .= '<td class="cart__price">' . number_format($prods['total']) . 'đ</td>';
      $cart .= '<td class="cart__close"><i  class="fa fa-close deleteIcon" data-size="' . $prods['size'] . '" data-id="' . $prods['product_id'] . '"></i></td>';
      $cart .= '</tr>';
    endforeach;
    echo json_encode(array('cart' => $cart, 'total' => $total));
      break;
    case 'clear-cart':
      unset($_SESSION['cart']);
      include './view/shopping-cart.php';
      break;
      case 'discount':
     
        break;
  default:
  $discount = isset($_POST['discount']) ? $_POST['discount'] : '';

$cart_model = new cart();
$discountCode = 0;
if (!empty($discount)) {
  $discountCode = $cart_model->getDiscount($discount)[0] ?? 0;
} 
$total = 0;
if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $item) {
    $total += $item['total'];
  }
}
$quantity = count($_SESSION['cart']);
$discount_percent = $discountCode > 0 ? $discountCode : 0;
$_SESSION['discountCode'] = $discount_percent;
$discount_total = $discount_percent > 0 ? $total * (100 - $discount_percent) / 100 : $total;

echo json_encode(array(
  'quantity' => $quantity,
  'total' => number_format($total),
  'discount_percent' => $_SESSION['discountCode'],
  'discount_total' => number_format($discount_total)
));
}
?>
