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
  public function insertProduct($product){
    $conn = new connect();
    $stmt = $conn->prepare("INSERT INTO products(id, product_name, quantity, price, image, impressive_image, `describe`, categories, sold_quantity, size_s, size_m, size_l, size_xl, oversize, color) VALUES(:id, :product_name, :quantity, :price, :image, :impressive_image, :description, :categories, :sold_quantity, :size_s, :size_m, :size_l, :size_xl, :oversize, :color)");

    $stmt->bindParam(':id', $product['id']);
    $stmt->bindParam(':product_name', $product['product_name']);
    $stmt->bindParam(':quantity', $product['quantity']);
    $stmt->bindParam(':price', $product['price']);
    $stmt->bindParam(':image', $product['image']);
    $stmt->bindParam(':impressive_image', $product['impressive_image']);
    $stmt->bindParam(':description', $product['describe']);
    $stmt->bindParam(':categories', $product['categories']);
    $stmt->bindParam(':sold_quantity', $product['sold_quantity']);
    $stmt->bindParam(':size_s', $product['size_s']);
    $stmt->bindParam(':size_m', $product['size_m']);
    $stmt->bindParam(':size_l', $product['size_l']);
    $stmt->bindParam(':size_xl', $product['size_xl']);
    $stmt->bindParam(':oversize', $product['oversize']);
    $stmt->bindParam(':color', $product['color']);
    
    $result = $stmt->execute();
    if($result){
      return true;
    }else{
      return false;
    }

  }
  public function updateProduct($product){
    $conn = new connect();
        $stmt = $conn->prepare("UPDATE products SET 
        product_name = :product_name,
          quantity = :quantity,
          price = :price,
          image = :image,
          impressive_image = :impressive_image,
          `describe` = :describe,
          categories = :categories, 
          sold_quantity = :sold_quantity,
          size_s = :size_s,
          size_m = :size_m,
          size_l = :size_l,
          size_xl = :size_xl,
          oversize = :oversize,
          color = :color
          WHERE id = :id");

    $stmt->bindParam(':id', $product['id'],PDO::PARAM_STR);
    $stmt->bindParam(':product_name', $product['product_name'],PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $product['quantity'],PDO::PARAM_INT);
    $stmt->bindParam(':price', $product['price'],PDO::PARAM_INT);
    $stmt->bindParam(':image', $product['image'],PDO::PARAM_STR);
    $stmt->bindParam(':impressive_image', $product['impressive_image'],PDO::PARAM_STR);
    $stmt->bindParam(':describe', $product['describe'],PDO::PARAM_STR);
    $stmt->bindParam(':categories', $product['categories'],PDO::PARAM_STR);
    $stmt->bindParam(':sold_quantity', $product['sold_quantity'],PDO::PARAM_STR);
    $stmt->bindParam(':size_s', $product['size_s'],PDO::PARAM_INT);
    $stmt->bindParam(':size_m', $product['size_m'],PDO::PARAM_INT);
    $stmt->bindParam(':size_l', $product['size_l'],PDO::PARAM_INT);
    $stmt->bindParam(':size_xl', $product['size_xl'],PDO::PARAM_INT);
    $stmt->bindParam(':oversize', $product['oversize'],PDO::PARAM_INT);
    $stmt->bindParam(':color', $product['color'],PDO::PARAM_STR);
        
        $result = $stmt->execute();
        if($result)
        return true;
        else{
          return $stmt -> errorInfo();
        }
       
    
}

  public function getCategories(){
    $conn = new connect();
    $select = "SELECT * FROM categories";
    $result = $conn -> getList($select);
    return $result;
  }
public function insertDeleteProducts($id){
  $conn  = new connect();
  $sql = $conn -> prepare("INSERT INTO deleteproducts(deleteID) VALUES(:id)");
  $sql -> bindParam(':id',$id,PDO::PARAM_STR);
  $result = $sql -> execute();
  if($result){
    return true;
  }else{
    return false;
  }

}
public function getDeleteProducts(){
  $conn = new connect();
  $sql = "SELECT * FROM deleteproducts";
  $result = $conn -> getList($sql);
  return $result;
}
}
?>