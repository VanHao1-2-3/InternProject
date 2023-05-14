<?php
class products
{
  public function __construct()
  {
  }
  // get all products
  public function getProducts($start, $limit)
  {
    $db = new connect();
    $categories = $_POST['filter'] ?? '';
    $where = !empty($categories) ?  "Where categories = '$categories'" : $categories;
    $select = "SELECT * from products $where limit $start, $limit";
    $select_count = "SELECT COUNT(*) FROM products $where";
    $result = $db->getList($select);
    $count = $db->getInstance($select_count);
    return [$result, $count[0]];
  }
  // get product by id
  public function getSingleProduct($id)
  {
    $db = new connect();
    $select = "SELECT * FROM products  WHERE id='$id'";
    $result = $db->getInstance($select);
    return $result;
  }
  // get group product by categories
  public function getRelatedProduct($categories)
  {
    $db = new connect();
    $select = "select * from products where categories = '$categories' limit 4";
    $result = $db->getList($select);
    return $result;
  }
  public function insertComment($product_id, $customer_id, $contents, $rating)
{
    $db = new connect();
    $date = new DateTime('now');
    $dateformat = $date->format('Y-m-d H:i:s');
    $result = 0;
    $select = "INSERT INTO comments(id,product_id,customer_id,dateCmt,contents,rating)
        values (null,'$product_id',$customer_id,'$dateformat','$contents',$rating)";
    try {
       $result = $db->exec($select);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Throwable $e) {
        return $e;
    }
}
public function getComments($id){
  $db = new connect();
  $select = "SELECT * FROM comments WHERE product_id = '$id' ORDER BY dateCmt desc";
  $result = $db -> getList($select);
  return $result;
}
public function getBestSeller(){
  $conn = new connect();
  $sql = "SELECT * FROM products order by sold_quantity desc limit 8";
  $result = $conn -> getList($sql);
  return $result;
}
public function getNewArrivals(){
  $conn = new connect();
  $sql = "SELECT * FROM products order by timestamp desc limit 8";
  $result = $conn -> getList($sql);
  return $result;
}
public function getProperties(){
  $conn = new connect();
  $sql = "Select *, sum(quantity) from properties group by id";
  $result = $conn -> getList($sql);
  return $result;
}
public function getColors($id){
  $conn = new connect();
  $sql = "SELECT DISTINCT(color) FROM `properties` where id like '%$id%'";
  $result = $conn -> getList($sql);
  return $result;
}
}
?>
