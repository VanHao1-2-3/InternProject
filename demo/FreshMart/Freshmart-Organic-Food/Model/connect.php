<?php
class connect{
          var $db = null;
          public function __construct()
          {
                    $dsn = 'mysql:host=localhost;dbname=quanlithucpham';
                    $user = "root";
                    $pass = "";
                    try{
                    $this->db = new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
          }
                    catch(Exception $e){

                    }
          }
          public function getList($select){
                 $result =  $this->db->query($select);
                 return $result;

          }
          public function getInstance($select){
              $result =  $this->db->query($select);
              $result = $result -> fetch();
              return $result;

       }
       public function exec($query){
              $result = $this->db->exec($query);
              return $result;
       }
}

?>