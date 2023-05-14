<?php

class chart{
public function getChartData(){
  $conn = new connect();
  $sql = "Select * from products where sold_quantity > 0";
  $result = $conn -> getList($sql);
  return $result;
}
public function getStatisticProducts($month, $year)
  {
    $db = new connect();
    if(!empty($month) && !empty($year)){
    $select = "SELECT a.product_name, sum(b.quantity) as quantity
            from products a, bill_detail b,bills c 
            WHERE a.id=b.product_id and b.bill_id = c.id and month(date) = $month
            and year(date) = $year
            group by a.product_name";
    }else{
      $current_month = date('m');
      $current_year = date('Y');
      $select = "SELECT a.product_name, sum(b.quantity) as quantity
            from products a, bill_detail b,bills c 
            WHERE a.id=b.product_id and b.bill_id = c.id and year(date) = $current_year
            group by a.product_name";
    }
    $result = $db->getList($select);
    return $result;
  }


}


?>