<?php
class admin{
  public function __construct(){

  }
  public function getPassword(){
    $db = new connect();
    $select = "SELECT password FROM admintable ";
    $result = $db -> getInstance($select);
    return $result[0];
  }
  public function changePass($pass){
    $db = new connect();
    $password = md5($pass);
    $update = "UPDATE admintable SET password = '$password'";
    $db -> exec($update);
  }
}
?>