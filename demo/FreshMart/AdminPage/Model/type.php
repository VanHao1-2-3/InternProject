<?php
class type{
  public function __construct()
  {
    
  }
  public function getName($id){
    $db = new connect();
    $select = "SELECT loaisp from loaisp where maloai = $id";
    $result = $db -> getInstance($select);
    return $result[0];
  }
  public function getMaloai($id){
    $db = new connect();
    $select = "SELECT maloai from loaisp where maloai = $id";
    $result = $db -> getInstance($select);
    return $result;
  }
  public function editType($id, $new){
    $db = new connect();
    $select = "UPDATE loaisp set loaisp = '$new' where maloai = $id ";
    $db -> exec($select);
  }
  public function insertProductType($maloai,$tenloai){
      $db = new connect();
      $insert = "INSERT INTO loaisp(maloai,loaisp) values($maloai,'$tenloai')";
      $db->exec($insert);
  }
  public function deleteType($maloai){
    $db = new connect();
    $select ="SELECT masp FROM sanpham where Nhom = $maloai";
    $result = $db -> getList($select);
    while($set = $result->fetch()){
      $masp = $set['masp'];
      $delete3 = "DELETE FROM binhluan where masp = '$masp'";
      $db -> exec($delete3);
    }
    $delete1 = "DELETE  FROM sanpham where Nhom = $maloai" ;
    $delete2 = "DELETE FROM loaisp where maloai = $maloai";
    $db -> exec($delete1);
    $db -> exec($delete2);
  }
}
?>