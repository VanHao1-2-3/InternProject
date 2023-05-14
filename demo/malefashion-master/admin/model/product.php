<?php

class product{
  public function getProduct(){
    $conn = new connect();
    $select = "SELECT * FROM products";
    $result = $conn -> getList($select);
    return $result;
  }
  public function getSingleProduct($id){
    $conn = new connect();
    $select = "SELECT * FROM products WHERE id = '$id'";
    $result = $conn -> getInstance($select);
    return $result;
  }
  public function updateProduct($id, $field, $value){
    $conn = new connect();
    $stmt = $conn->prepare("UPDATE products SET $field=:value WHERE id=:id");
    $stmt->bindParam(':value', $value, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    try {
      $result = $stmt->execute();
      if($result) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
  public function updateImage($id,$field, $image){
    $conn = new connect();
    $stmt = $conn->prepare("UPDATE products SET $field=:value WHERE id=:id");
    $stmt->bindParam(':value', $image, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    try {
      $result = $stmt->execute();
      if($result) {
        return true;
      } else {
        return false;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
  public function deleteProduct($id){
    $conn = new connect();
    $delete = "DELETE FROM products WHERE id = '$id'";
    $result = $conn -> exec($delete);
    if($result > 0){
      return true;
    }else{
      return false;
    }
  }
}
?>