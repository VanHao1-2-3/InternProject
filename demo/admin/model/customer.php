<?php
class customer{
public function getCustomers(){
  $conn = new connect();
  $sql = "SELECT * FROM customers";
  $result = $conn -> getList($sql);
  return $result;
}
public function deleteCustomer($id){
  $conn = new connect();
  $sql = "UPDATE customers SET deleted = 1 WHERE id = $id";
  $delete = $conn -> exec($sql);
  if($delete > 0){
    return true;
  }else{
    return false;
  }
}
}
?>