<?php
// session_start();
// include '../model/connect.php';
// include '../model/products.php';
// $_SESSION['cart'] = array();
// $product_id = $_POST['product_id'] ?? '';
// if (!empty($product_id)) {
//   $product_model = new products();
//   $prod = $product_model->getSingleProduct($product_id);
//   $product_name = $prod['product_name'];
//   $product_price = $prod['price'];
//   $image = $prod['image'];
//   $size = $_POST['size'] ?? 'L';
//   $quantity = $_POST['quantity'] ?? 1;
//   $total = $quantity * $product_price;
//   $product = array(
//     'product_id' => $product_id,
//     'product_name' => $product_name,
//     'product_price' => $product_price,
//     'size' => $size,
//     'image' => $image,
//     'quantity' => $quantity,
//     'total' => $total
//   );
// }
// $_SESSION['cart'][] = $product;
// // if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
// // } else {
// //   if (!empty($_SESSION['cart'][$product_id])) {
// //     if ($size == $_SESSION['cart'][$product_id]['size']) {
// //       $_SESSION['cart'][$product_id]['quantity'] += $quantity;
// //     } else {
// //       $_SESSION['cart'][] = $product;
// //     }
// //   }
// // }
// $cart = '';
// foreach ($_SESSION['cart'] as $prods) :
//   $cart .= '<tr>';
//   $cart .= '<td class="product__cart__item">';
//   $cart .= '<div class="product__cart__item__pic">';
//   $cart .= ' <img src="./view/img/product/' . $prods['image'] . '" alt=""/>';
//   $cart .= ' </div>';
//   $cart .= '<div class="product__cart__item__text">';
//   $cart .= '<h6>' . $prods['product_name'] . '</h6>';
//   $cart .= '<h5>' . $prods['product_price'] . ' VND</h5>';
//   $cart .= '</div>';
//   $cart .= '</td>';
//   $cart .= '<td class="quantity__item">';
//   $cart .= '<div class="quantity">';
//   $cart .= '<div class="pro-qty-2">';
//   $cart .= '<input type="text" value="' . $prods['quantity'] . '"/>';
//   $cart .= '</div>';
//   $cart .= '</div>';
//   $cart .= '</td>';
//   $cart .= '<td class="cart__price">' . $prods['size'] . '</td>';
//   $cart .= '<td class="cart__price">' . $prods['total'] . '</td>';
//   $cart .= '<td class="cart__close"><i class="fa fa-close"></i></td>';
//   $cart .= '</tr>';
// endforeach;
// echo $cart;
