<?php
class user{
   function __construct()
   {
      
   }
   function InsertUser($usname,$usaddress,$email,$phone,$pass){
      $db = new connect();
      $query = "INSERT INTO khachhang (makh,tenkh,diachi,email,sodt,matkhau) VALUES 
      (NULL,'$usname','$usaddress','$email','$phone','$pass')";
      $db -> exec($query);
   }
   function checkUser($us,$email,$phone){
      $db = new connect();
      $query = "SELECT * FROM khachhang where tenkh = '$us' and   email = '$email' or sodt = '$phone'";
      $result = $db->getInstance($query);
      return $result;
   }
   function userLogin($email,$pass){
      $db = new connect();
      $select = "SELECT * FROM khachhang where email = '$email' and matkhau = '$pass' ";
      $result = $db->getInstance($select);
      return $result;
   }
   function changePassword($new,$makh){
      $db = new connect();
      $select = "UPDATE khachhang set matkhau = '$new' WHERE makh = $makh";
      $db -> exec($select);
   }
   function getEmail($email)
        {
            $db=new connect();
            $select = "select * from khachhang where email='$email'";
            //    echo $select;
            $result=$db->getInstance($select);
            return $result;
        }
        function updateEmail($emailold, $codenew)
        {
            $db=new connect();
            $query="update khachhang set matkhau='$codenew' where email='$emailold'";
            $db->exec($query);
          
        }
}
?>