<?php
class bill{
 public function __construct()
 {
  
 }
 public function getBill(){
  $db = new connect();
  $select = "SELECT * from hoadon";
  $result = $db -> getList($select);
  return $result ;
 }
 public function getBillDetail(){
  $db = new connect();
  $select = "SELECT * from cthoadon";
  $result = $db -> getList($select);
  return $result ;
 }
 public function editBill($id, $new){
  $db = new connect();
  $select = "UPDATE loaisp set loaisp = '$new' where maloai = $id ";
  $db -> exec($select);
}
public function getSingleBill($mahd) {
  $db = new connect();
  $select = "SELECT * from hoadon where mahd= $mahd";
  $result = $db -> getInstance($select);
  return $result;
}
public function getSingleBillDetail($mahd,$masp) {
  $db = new connect();
  $select = "SELECT * from cthoadon where mahd= $mahd and masp= '$masp'";
  $result = $db -> getInstance($select);
  return $result;
}
public function getBillByMahd($mahd){
  $db = new connect();
  $select = "SELECT * from cthoadon where mahd = $mahd";
  $result = $db -> getList($select);
  return $result;
}
public function getMakh($makh){
  $db  = new connect();
  $select = "SELECT * from khachhang where makh = $makh";
  $result = $db -> getInstance($select);
  return $result;
}
public function updateBill($mahdold,$mahd,$makh,$ngaydat){
  $db = new connect();
  $select1 = "UPDATE hoadon set 
  mahd = $mahd, 
  makh=$makh,
  ngaydat='$ngaydat'
  where mahd = $mahdold
  ";
  $select2 = "UPDATE cthoadon set 
  mahd = $mahd
  where mahd = $mahdold
  ";
  $db -> exec($select1);
  $db -> exec($select2);
}
public function getPrice($masp){
  $db = new connect();
  $select = "SELECT dongia from sanpham where masp = '$masp'";
  $result = $db -> getInstance($select);
  return $result;
}
public function updateBillDetail($mahd,$maspold,$masp,$soluong,$thanhtien){
$db = new connect();
$select = "UPDATE cthoadon set masp='$masp',soluong=$soluong , thanhtien = $thanhtien
where masp='$maspold' and mahd = $mahd
";
$db -> exec($select);

}
public function updateBillTotal($mahd,$tongtien){
$db = new connect();
$select1= "UPDATE hoadon set tongtien = $tongtien where mahd = $mahd";
$db -> exec($select1);
}
public function deleteBill($mahd){
  $db = new connect();
  $select = "DELETE FROM hoadon where mahd = $mahd";
  $select1 = "DELETE FROM cthoadon where mahd = $mahd";
  $db -> exec($select);
  $db -> exec($select1);
}
public function getDetailPrice ($masp,$mahd){
  $db = new connect();
  $select = "Select thanhtien from cthoadon where mahd = $mahd and masp = '$masp'";
  $result = $db -> getInstance($select);
  return $result[0];
}
public function deleteDetailBill($mahd,$masp){
  $db = new connect();
  $delete = "DELETE FROM cthoadon where mahd = $mahd and masp = '$masp'";
  $db -> exec($delete);
}
public function updateTotal($mahd,$tongtien){
  $db = new connect();
  $select = "SELECT tongtien from hoadon where mahd = $mahd";
  $price = $db -> getInstance($select);
  if($price[0] - $tongtien > 0){
    $update = "UPDATE hoadon set tongtien = $price[0] - $tongtien where mahd = $mahd";
  }
  else{
    $update = "DELETE FROM hoadon where mahd = $mahd";
  }
  $db -> exec($update);
}
}
?>