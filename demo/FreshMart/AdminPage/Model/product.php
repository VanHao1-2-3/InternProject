<?php
class product
{
  public function __construct()
  {
  }
  public function getAllProduct()
  {
    $db = new connect();
    $select = "SELECT * FROM sanpham";
    $result = $db->getList($select);
    return $result;
  }
  public function getCount()
  {
    $db = new connect();
    $select = "SELECT count(*) FROM sanpham";
    $result  = $db->getInstance($select);
    return $result[0];
  }
  public function getLoai()
  {
    $db = new connect();
    $select = "SELECT * FROM loaisp";
    $result = $db->getList($select);
    return $result;
  }
  public function getTenLoai($nhom)
  {
    $db = new connect();
    $select = "SELECT loaisp FROM loaisp where maloai = $nhom";
    $result = $db->getInstance($select);
    return $result;
  }
  public function getPageProduct($start, $limit)
  {
    $db = new connect();
    $select = "SELECT * FROM sanpham limit $start,$limit";
    $result = $db->getList($select);
    return $result;
  }
  public function getProduct($masp)
  {
    $db = new connect();
    $select = "SELECT * FROM sanpham where masp = '$masp'";
    $result = $db->getInstance($select);
    return $result;
  }
  public function updateProduct($maspold, $masp, $tensp, $soluong, $dongia, $hinh, $mota, $nhom, $slban)
  {
    $db = new connect();
    $updatesp = "UPDATE sanpham set
  masp='$masp',
  tensp='$tensp',
  soluong=$soluong,
  dongia=$dongia,
  hinh= '$hinh',
  motasanpham='$mota',
  Nhom = $nhom,
  soluongban = $slban
  where masp = '$maspold'
  ";
    $updateyt = "UPDATE yeuthich set
  masp='$masp',
  tensp='$tensp',
  soluong=$soluong,
  dongia=$dongia,
  hinh= '$hinh',
  mota='$mota',
  Nhom = $nhom,
  soluongban = $slban
  where masp = '$maspold'";
    $db->exec($updatesp);
    $db->exec($updateyt);
  }
  public function getMasp($masp)
  {
    $db = new connect();
    $select = "SELECT masp from sanpham where masp = '$masp'";
    $result = $db->getInstance($select);
    return $result;
  }
  public function addProduct($masp, $tensp, $soluong, $dongia, $hinh, $mota, $nhom, $slban)
  {
    $db = new connect();
    $insert = "INSERT INTO sanpham(masp,tensp,soluong,dongia,hinh,motasanpham,Nhom,soluongban) VALUES
  ('$masp',
  '$tensp',
  $soluong,
  $dongia,
  '$hinh',
  '$mota',
  $nhom,
  $slban)";
    $db->exec($insert);
  }
  public function deleteProduct($masp)
  {
    $db = new connect();
    $deleteCMT = "DELETE FROM binhluan where masp = '$masp'";
    $deleteProd = "DELETE from sanpham where masp = '$masp'";
    $db->exec($deleteCMT);
    $db->exec($deleteProd);
  }
  public function getThongKe_MatHang($month, $year)
  {
    $db = new connect();
    $select = "SELECT a.tensp, sum(b.soluong) as soluong
            from sanpham a, cthoadon b,hoadon c 
            WHERE a.masp=b.masp and b.mahd = c.mahd and month(ngaydat) = $month
            and year(ngaydat) = $year
            group by a.tensp";
    $result = $db->getList($select);
    return $result;
  }
}
