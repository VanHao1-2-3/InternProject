<?php
class bill{
  public function insertBill($customer_id,$fullname, $city, $address, $phone, $email){
  $conn = new connect();
  $date = new DateTime('now');
  $dateformat = $date -> format('Y-m-d H:i:s');
  $insert = "INSERT INTO bills(id, customer_id,fullname, city, address, phone, email, date,total,status)
  VALUES(null, $customer_id, '$fullname','$city','$address','$phone','$email','$dateformat',0,'Chờ xác nhận')
  ";
    $conn -> exec($insert);
  $select = "SELECT id FROM bills order by id desc limit 1";
  $result = $conn -> getInstance($select);
  return $result[0];
  }
  public function insertDetail($bill_id, $product_id, $quantity,$size, $total){
  $conn = new connect();
  $insert = "INSERT INTO bill_detail(bill_id, product_id, quantity,size, total) 
  VALUE($bill_id,'$product_id',$quantity,'$size', $total)
  ";
    $conn -> exec($insert);
    }
    public function updateTotal($bill_id, $total){
      $conn = new connect();
      $update = "UPDATE bills SET total = $total WHERE id = $bill_id";
        $conn -> exec($update);
    }
    public function updateDatabase($product_id, $quantity){
      $conn = new connect();
      $update = "UPDATE products SET quantity = quantity- $quantity, sold_quantity = sold_quantity + $quantity WHERE id = '$product_id'";
      $conn -> exec($update);
    }
    public function getDetailBills($id){
      $conn = new connect();
      $select = "SELECT * FROM bill_detail WHERE bill_id = $id";
      $result = $conn -> getList($select);
      return $result;
    }  
  }
?>