<?php
class product
{
   public function __construct()
   {
   }
   public function getProductAll()
   {
      $db = new connect();
      $select = 'SELECT * FROM sanpham ';
      $result = $db->getList($select);
      return $result;
   }
   public function getHomeProduct($group)
   {
      $db = new connect();
      $select = " SELECT * FROM sanpham where Nhom = $group limit 8";
      $result = $db->getList($select);
      return $result;
   }
   public function getDetail($id)
   {
      $db = new connect();
      $select = "SELECT * FROM sanpham where masp = '$id'";
      $result = $db->getInstance($select);
      return $result;
   }
   public function getGroupDetail($group)
   {
      $db = new connect();
      $select = "SELECT * FROM sanpham where Nhom = $group limit 4";
      $result = $db->getList($select);
      return $result;
   }
   public function getRelated($group,$id)
   {
      $db = new connect();
      $select = "SELECT * FROM sanpham where Nhom = $group and masp != '$id'" ;
      $result = $db->getList($select);
      return $result;
   }
   function getCountProds($act,$condition){
      $db = new connect();
      $select = '';
      if($act == 'type'){
         $select = "SELECT COUNT(*) FROM sanpham where Nhom = $condition";
      }
      elseif($act == 'search'){
         $select = "SELECT COUNT(*) FROM sanpham where tensp = '$condition'";
      }
      else{
         $select = "SELECT COUNT(*) FROM sanpham";
      }
      $result = $db -> getInstance($select);
      return $result[0];
     }
     function getPageProduct($start, $limit,$value,$search,$loai){
      $select ='';
      $db = new connect();
      if(isset($type)){

         if($value == 0){
            $select = "SELECT * FROM `sanpham` where Nhom = $loai and  tensp LIKE '%$search%' LIMIT $start,$limit ";
         }
         elseif($value == 1){
            $select = "SELECT * FROM `sanpham` where Nhom = $loai  and tensp LIKE '%$search%' order by dongia  LIMIT $start,$limit ";
         }
         elseif($value == 2){
            $select = "SELECT * FROM `sanpham` where Nhom = $loai and  tensp LIKE '%$search%' order by dongia desc LIMIT $start,$limit ";
         }
         elseif($value == 3){
            $select = "SELECT * FROM `sanpham` where Nhom = $loai  and tensp LIKE '%$search%' order by tensp LIMIT $start,$limit ";
         }
         elseif($value == 4){
            $select = "SELECT * FROM `sanpham` where  Nhom = $loai  and  tensp LIKE '%$search%' order by tensp desc LIMIT $start,$limit ";
         }
      }
      else{
         if($value == 0){
            $select = "SELECT * FROM `sanpham` where  tensp LIKE '%$search%' LIMIT $start,$limit ";
         }
         elseif($value == 1){
            $select = "SELECT * FROM `sanpham` where  tensp LIKE '%$search%' order by dongia  LIMIT $start,$limit ";
         }
         elseif($value == 2){
            $select = "SELECT * FROM `sanpham` where   tensp LIKE '%$search%' order by dongia desc LIMIT $start,$limit ";
         }
         elseif($value == 3){
            $select = "SELECT * FROM `sanpham` where    tensp LIKE '%$search%' order by tensp LIMIT $start,$limit ";
         }
         elseif($value == 4){
            $select = "SELECT * FROM `sanpham`  where tensp LIKE '%$search%' order by tensp desc LIMIT $start,$limit ";
         }
      }
      $result = $db -> getList($select);
      return $result;
     }
     public function getSearch($search){
      $db = new connect();
      $select = "SELECT * from sanpham where tensp like '%$search%'";
      $result = $db -> getList($select);
      return $result;
   }
   function insertComment($mahh,$makh,$noidung,$danhgia){
      $db = new connect();
      $date = new DateTime('now');
      $dateformat = $date->format('Y-m-d');
      $select = "INSERT INTO binhluan(mabl,masp,makh,ngaybl,noidung,danhgia)
      values (null,'$mahh',$makh,'$dateformat','$noidung',$danhgia)
      ";
      $db->exec($select);
     }
     function getCountComment($mahh){
      $db = new connect();
      $select = "SELECT count(mabl) from binhluan where masp = '$mahh'";
      $result = $db -> getInstance($select);
      return $result[0];
     }
     function getComment($mahh){
      $db = new connect();
      $select = "SELECT khachhang.tenkh,binhluan.noidung,binhluan.ngaybl,binhluan.danhgia FROM binhluan, khachhang WHERE binhluan.makh = khachhang.makh and binhluan.masp = '$mahh' limit 10";
      $result = $db -> getList($select);
      return $result;
   }
   function updateProductDB($id,$slmua){
      $db = new connect();
      $select = "UPDATE sanpham set soluong = soluong - $slmua , soluongban = soluongban + $slmua WHERE masp = '$id'";
      $db->exec($select);
   }
   function insertWishlist($masp,$tensp,$soluong,$dongia,$hinh,$mota,$nhom,$slban){
      $db = new connect();
      $select = "INSERT INTO yeuthich(masp,tensp,soluong,dongia,hinh,mota,Nhom,soluongban)
      values ('$masp', '$tensp', $soluong, $dongia,'$hinh','$mota',$nhom,$slban)
      ";
      $db->exec($select);
     }
     function checkWishlist ($id){
      $db = new connect();
      $select = "SELECT count(masp) FROM yeuthich where masp='$id'";
      $result = $db->getInstance($select);
      return $result;
     }
     public function getWishlist(){
      $db = new connect();
      $select = "SELECT * from yeuthich";
      $result = $db -> getList($select);
      return $result;
     }
     function getCountWishlist(){
      $db = new connect();
      $select = "SELECT COUNT(*) FROM yeuthich";
      $result = $db -> getInstance($select);
      return $result[0];
     }
     public function getTypeProduct(){
      $db = new connect();
      $select = "SELECT * FROM loaisp";
      $result = $db -> getList($select);
      return $result;
     }
     public function getTypeProductList($maloai){
      $db = new connect();
      $select = "SELECT * FROM sanpham where Nhom = $maloai";
      $result = $db -> getList($select);
      return $result;
     }
}
