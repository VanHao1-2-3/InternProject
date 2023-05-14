<?php
 class bill{
  public function getBills(){
    $conn = new connect();
    $select = "SELECT * FROM bills order by id desc";
    $result = $conn -> getList($select);
    return $result;
  }
  public function getDetailBills($id){
    $conn = new connect();
    $select = "SELECT * FROM bill_detail WHERE bill_id = $id";
    $result = $conn -> getList($select);
    return $result;
  }
  public function deleteDetailBill($bill_id, $product_id,$size){
      $conn = new connect();
      $delete = "DELETE FROM bill_detail WHERE bill_id = $bill_id AND product_id = '$product_id' AND size='$size'";
      $delete_exec = $conn -> exec($delete);
      if($delete_exec>0){
        return true;
      }else{
         return false;
      }
  }
  public function deleteBill($id){
    $conn = new connect();
    $delete = "DELETE FROM bills WHERE id = $id";
    $delete_exec = $conn -> exec($delete);
    if($delete_exec > 0){
      return true;
    }else{
      return false;
    }
   }
   public function updateTotal($bill_id, $total){
    $conn = new connect();
    $update = "UPDATE bills SET total = $total WHERE id = $bill_id";
      $conn -> exec($update);
  }
  public function updateBillDelete($id){
    $conn = new connect();
    $sql = "UPDATE bills SET deleted = 1 WHERE id = $id";
    $result = $conn -> exec($sql);
    if($result>0){
      return true;
    }else{
      return false;
    }
  }
  public function updateStatusBill($id, $status){
    $conn = new connect();
    $sql = "UPDATE bills SET status = '$status' WHERE id = $id";
    $result = $conn -> exec($sql);
    if($result > 0){
      return true;
    }else{
      return false;
    }
  }
 }


?>