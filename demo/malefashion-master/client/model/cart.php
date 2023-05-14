<?php
class cart{

  // public function getAddProduct($id, $quantity, $size){
  //   $prods =  new products();
  //   $prod = $prods -> getSingleProduct($id);

  //   $product_id = $prod['id'];
  //   $product_name = $prod['product_name'];
  //   $product_price = $prod['product_price'];
  //   $image = $prod['image'];
  //   $size = $size;
  //   $quantity = $quantity;
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
  //   return $product;
  // }
  function delete($key){
    unset($_SESSION['cart'][$key]);
  }
  public function getDiscount($code){
    $conn = new connect();
    $sql = "SELECT discount from discount where code = '$code'";
    $result = $conn -> getInstance($sql);
    return $result;
  }
}

?>