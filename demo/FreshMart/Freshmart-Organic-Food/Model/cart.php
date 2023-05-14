<?php
class cart{
   function addProduct($masp,$soluong){
      $prod =  new product();
      $prods = $prod->getDetail($masp);
      $tensp = $prods['tensp'];
      $hinh = $prods['hinh'];
      $dongia = $prods['dongia'];
      $tongtien = $soluong * $dongia;
      $item = array(
         'masp'=>$masp,
         'tensp'=>$tensp,
         'hinh'=>$hinh,
         'dongia'=>$dongia,
         'soluong'=>$soluong,
         'tongtien'=>$tongtien
      );
      $flag = 0;
      foreach($_SESSION['cartTemplate'] as $key => $element){
         if($item['masp'] === $element['masp']){
         
            $flag = 1;
            $element['soluong']+=$soluong;
            $this->update($key,$element['soluong']);
            break;
         }
      }
      if($flag == 0){
         $_SESSION['cartTemplate'][]= $item;
      }
   }
   function getTotal(){
      $total = 0;
      foreach($_SESSION['cartTemplate'] as $item){
         $total += $item['tongtien'];
      }
      return $total;
   }
   function delete($key){
     unset($_SESSION['cartTemplate'][$key]);
   }
   function update($key,$quantity){
      if($quantity <= 0 ){
         $this->delete($key);
      }
      else{
         $_SESSION['cartTemplate'][$key]['soluong'] = $quantity;
         $newTotal = $_SESSION['cartTemplate'][$key]['soluong']  * $_SESSION['cartTemplate'][$key]['dongia'];
         $_SESSION['cartTemplate'][$key]['tongtien'] = $newTotal;
      }
   }
}
?>