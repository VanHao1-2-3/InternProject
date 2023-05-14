<?php
class page{
  public function __construct(){}
  public function getTotalPage($count,$limit){
    $total = $count % $limit == 0 ? $count / $limit : ceil($count/$limit);
    return $total;
  }
  public function findStart(){
    if(!isset($_GET['page']) || $_GET['page'] == 1){
      $start = 0;
    }
    else{
      $start = 4 * ($_GET['page'] - 1);
    }
    return $start;
  }
}

?>