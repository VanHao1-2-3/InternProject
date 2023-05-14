<?php
class user {
 public function __construct()
 {
  
 }
 public function getUser(){
  $db = new connect();
  $select = "SELECT * FROM khachhang";
  $result = $db -> getList($select);
  return $result;
 }
 public function getUserDetail($makh){
  $db = new connect();
  $select = "SELECT * FROM khachhang where makh = $makh";
  $result = $db -> getInstance($select);
  return $result;
 }
 public function deleteUser($makh){
  $db = new connect();
  $mahd = '';
  $delete = "DELETE FROM khachhang WHERE makh = $makh";
  $delete2 = "DELETE FROM binhluan WHERE makh = $makh";
  $delete3 = "DELETE FROM hoadon WHERE makh = $makh";
  $select = "SELECT mahd FROM hoadon where makh = $makh";
  $result = $db -> getInstance($select);
  if(!empty($result)){
    $mahd = $result[0];
    $delete4 = "DELETE FROM cthoadon WHERE mahd = $mahd";
    $db -> exec($delete4);
  }
  $db -> exec($delete2);
  $db -> exec($delete3);
  $db -> exec($delete);

 }
}
?>