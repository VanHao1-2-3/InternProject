<?php

$act = $_GET['act'] ?? '';
switch($act){

  case 'show_bill':
    $bill_model = new bill();
    $result = $bill_model -> getBills()-> fetchAll();
    $bill = '';
    foreach($result as $value):
    $bill.= '<tr>';
    $bill.= '<td contenteditable="true">'.$value['id'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['customer_id'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['fullname'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['address'].' '.$value['city'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['phone'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['email'].'</td>';
    $bill.= '<td contenteditable="true">'.$value['date'].'</td>';
    $bill.= '<td class="total" data-id="'.$value['id'].'">'.$value['total'].'</td>';
    $bill.= '<td ><button class="btn btn-secondary details_btn" 
    data-bs-toggle="modal" data-bs-target="#myModal" data-id = "'.$value['id'].'">
    Xem chi tiết</button></td>';
    $bill.= '</tr>';
    endforeach;
    echo json_encode(array('success'=> true,'bill'=> $bill));
    break;
     case 'show_detail_bill':
      $id = $_POST['id'] ?? '';
      $bill_model = new bill();
      $bill_display = '';
        $bill_result = $bill_model -> getDetailBills($id) -> fetchAll();
        foreach($bill_result as $bill_item):
          $bill_display.='<tr>';
          $bill_display.='<td>'.$bill_item['bill_id'].'</td>';
          $bill_display.='<td>'.$bill_item['product_id'].'</td>';
          $bill_display.='<td>'.$bill_item['quantity'].'</td>';
          $bill_display.='<td>'.$bill_item['size'].'</td>';
          $bill_display.='<td>'.number_format($bill_item['total']).'đ</td>';
          $bill_display.='<td><button data-bill_id = "'.$bill_item['bill_id'].'" 
          data-product_id = "'.$bill_item['product_id'].'" data-size = "'.$bill_item['size'].'" 
          class="btn btn-danger detail_delete">Xóa</button></td>';
          $bill_display.='</tr>';
        endforeach;
        echo json_encode(array('success'=> true, 'bill'=> $bill_display));
    break;
    case 'bill_detail_delete':
     $bill_id = $_POST['bill_id'] ?? '';
     $product_id = $_POST['product_id'] ?? '';
     $size = $_POST['size'] ?? '';
     $bill_model = new bill();
     $bill_origin = $bill_id;
     $delete =  $bill_model -> deleteDetailBill($bill_origin, $product_id, $size);
     if($delete == true){
      $bill_display = '';
      $total = 0;
      $bill_result = $bill_model -> getDetailBills($bill_origin) -> fetchAll();
      if(count($bill_result) > 0){
        foreach($bill_result as $bill_item):
          $total+=$bill_item['total'];
          $bill_display.='<tr>';
          $bill_display.='<td>'.$bill_item['bill_id'].'</td>';
          $bill_display.='<td>'.$bill_item['product_id'].'</td>';
          $bill_display.='<td>'.$bill_item['quantity'].'</td>';
          $bill_display.='<td>'.$bill_item['size'].'</td>';
          $bill_display.='<td>'.number_format($bill_item['total']).'đ</td>';
          $bill_display.='<td><button data-bill_id = "'.$bill_item['bill_id'].'" 
          data-product_id = "'.$bill_item['product_id'].'" data-size = "'.$bill_item['size'].'" 
          class="btn btn-danger detail_delete">Xóa</button></td>';
          $bill_display.='</tr>';
        endforeach;
       
        $bill_model -> updateTotal($bill_origin,$total);
        echo json_encode(array('exist'=> true, 'billDetail'=> $bill_display, 'total'=> $total));
      }else{
        $bill_display = '<h3>Không có chi tiết hóa đơn nào để hiển thị</h3>';
        $delete_bill = $bill_model -> deleteBill($bill_origin);
        if($delete_bill == true){
          $result = $bill_model -> getBills()-> fetchAll();
          $bill = '';
          foreach($result as $value):
          $bill.= '<tr>';
          $bill.= '<td contenteditable="true">'.$value['id'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['customer_id'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['fullname'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['address'].' '.$value['city'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['phone'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['email'].'</td>';
          $bill.= '<td contenteditable="true">'.$value['date'].'</td>';
          $bill.= '<td class="total" data-id="'.$value['id'].'" >'.$value['total'].'</td>';
          $bill.= '<td ><button class="btn btn-secondary details_btn" 
          data-bs-toggle="modal" data-bs-target="#myModal" data-id = "'.$value['id'].'">
          Xem chi tiết</button></td>';
          $bill.= '</tr>';
          endforeach;
        }
        echo json_encode((array('null'=> true, 'bills'=> $bill,'billDetail' => $bill_display)));
      }
     }

     break;
  default:
  include './view/bill.php';
  break;
}
?>