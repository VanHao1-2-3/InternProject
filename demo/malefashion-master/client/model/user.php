<?php
class user{
  public function insertUser($customer_name, $address, $email,$phone_number, $password){
    $conn = new connect();
    $insert = "INSERT INTO customers (id, customer_name, customer_address, customer_email, phone_number,avatar,pass) 
    VALUES(null,'$customer_name','$address','$email','$phone_number','avatar.jpg','$password')
    ";
    try {
      $conn->exec($insert);
      return true; // Trả về true nếu insert thành công
  } catch (PDOException $e) {
      return false; // Trả về false nếu insert không thành công
  }
  }
  public function checkExistedUser($username, $email, $phone){
    $conn = new connect();
    $select = "SELECT customer_name, customer_email, phone_number FROM customers WHERE 
    customer_name = '$username' AND customer_email = '$email' OR phone_number = '$phone'
    ";
    $result = $conn -> getInstance($select);
    return $result;
  }
  public function checkLogin($email, $password){
    $conn = new connect();
    $check = "SELECT id,customer_name, customer_email, pass FROM customers WHERE customer_email = '$email' AND pass = '$password'";
    $result = $conn -> getInstance($check);
    return $result;
  }
  public function getUser($id){
    $conn = new connect();
    $select = "SELECT * FROM customers where id = $id";
    $result = $conn -> getInstance($select);
    return $result;
  }
  public function getBill($id){
    $conn = new connect();
    $select = "SELECT * FROM bills where customer_id = $id";
    $result = $conn -> getList($select);
    return $result;
  }
  public function updateUser($id,$name,$address,$email,$phone,$avatar){
    $conn = new connect();
    $update = "UPDATE customers set customer_name = '$name',customer_address='$address',customer_email='$email',phone_number='$phone',avatar='$avatar' WHERE id = $id";
    $result =  $conn -> exec($update);
      if($result>0){
        return  true;
      }
      else{
        return false;
      }
   
  }
  public function checkEmail($email){
    $conn = new connect();
    $sql = "Select * from customers where customer_email = '$email'";
    $result = $conn -> getInstance($sql);
    return $result;
  }
  public function changePassword($email, $password){
    $conn = new connect();
    $sql = "UPDATE customers set pass = '$password' where customer_email = '$email'";
    $conn -> exec($sql);
  }
}
?>
