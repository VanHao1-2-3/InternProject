<?php
class bill{
   public function __construct(){

   }
   // phương thức thêm dữ liệu vào bảng hóa đơn
   public function insertBill($makh){
      $db = new connect();
      $date = new DateTime('now');
      $dateFormat = $date->format('Y-m-d');
      $insert = "INSERT INTO hoadon (mahd,makh,ngaydat,tongtien) 
      values (null,$makh,'$dateFormat','0')";
      $db ->exec($insert);
      $bill = $db -> getInstance('select mahd from hoadon 
      order by mahd desc limit 1');
      return $bill[0];
   }
   public function insertDetail($mahd,$masp,$soluong,$tongtien){
      $db = new connect();
      $insert = "INSERT INTO cthoadon(mahd,masp,soluong,thanhtien)
      values($mahd,'$masp',$soluong,'$tongtien')";
      $db->exec($insert);
   }
   function updateTotal($mahd,$tongtien){
      $db = new connect();
      $update = "Update hoadon set tongtien = '$tongtien' where mahd= $mahd";
      $db->exec($update);
   }
}
?>