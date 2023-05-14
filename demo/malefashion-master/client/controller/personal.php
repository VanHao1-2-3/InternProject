<?php

  $act = $_GET['act'] ?? '';
  switch($act){
    case 'show_personal':
      $user_model = new user();
      if(!empty($_SESSION['customer_id'])){
        $user = $user_model -> getUser($_SESSION['customer_id']);
        $listBill = $user_model -> getBill($_SESSION['customer_id'])->fetchAll();
        $bill_display = '';
        foreach($listBill as $bill):
          $bill_display.=' <tr>';
          $bill_display.=' <td>'.$bill['id'].'</td>';
          $bill_display.=' <td>'.$bill['date'].'</td>';
          $bill_display.=' <td>'.$bill['total'].'</td>';
          $bill_display.=' <td>'.$bill['address'].' '.$bill['city'].'</td>';
          $bill_display.=' <td><a data-bs-toggle="modal" data-bs-target="#profile_bills" class="btn btn-primary show-details" data-id="'.$bill['id'].'">Chi tiết</a></td>';
          $bill_display.=' </tr>';
        endforeach;
          $result = array(
            'name'=> $user['customer_name'],
            'address' => $user['customer_address'],
            'email'=> $user['customer_email'],
            'phone'=> $user['phone_number'],
            'image' => './view/img/user/'.$user['avatar'],
            'bill_display' => $bill_display
          );
      }
      
  echo json_encode($result);
      break;
      case 'update':
        $upload = true;
        if (isset($_FILES['avatar']['name'])) {
          $target_dir = "./view/img/user/";
          $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
          if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            $upload = true;
          } else {
              $upload = false;
          }
      }
        $user_model = new user();
        $result = '';
        if(!empty($_SESSION['customer_id'])):
        $user = $user_model -> getUser($_SESSION['customer_id']);
        $name = $_POST['name'] ?? $user['customer_name'];
        $phone = $_POST['phone'] ?? $user['phone_number'];
        $email = $_POST['email'] ?? $user['customer_email'];
        $address = $_POST['address'] ?? $user['customer_address'];
        $avatar = $upload == false ? $user['avatar'] : $_FILES['avatar']['name'];
        $result = $user_model -> updateUser($_SESSION['customer_id'],$name,$address,$email,$phone,$avatar);
        $user = $user_model -> getUser($_SESSION['customer_id']);
        $listBill = $user_model -> getBill($_SESSION['customer_id'])->fetchAll();
        $bill_display = '';
          $result = array(
            'name'=> $name,
            'address' => $address,
            'email'=> $email,
            'phone'=> $phone,
            'image' => './view/img/user/'.$user['avatar'],
          );
        endif;
        if($result == true){
          echo json_encode(array('success'=> true,'avatar'=> $avatar,'data'=>$result));
        }else{
          echo json_encode(array('success'=> false,'avatar'=> $avatar));
        }
        break;
        case 'show-details':
          $id = $_POST['id'] ?? '';
          if(!empty($id)){
            $bill_model = new bill();
            $bill_details = $bill_model -> getDetailBills($id) -> fetchAll();
            $html = '';
            foreach($bill_details as $bill_detail):
              $html.= '<tr>';              
              $html.= '<td >'.$bill_detail['bill_id'].'</td>';
              $html.= '<td class="product_id">'.$bill_detail['product_id'].'</td>';
              $html.= '<td class="quantity">'.$bill_detail['quantity'].'</td>';
              $html.= '<td class="size">'.$bill_detail['size'].'</td>';
              $html.= '<td class="total">'.$bill_detail['total'].'</td>';          
              $html.= '</tr>';
            endforeach;
            echo json_encode(array('success'=> true, 'html'=> $html));
          }else{
            echo json_encode(array('failed'=> true));
          }
          break;
      default:
      include './view/profile.php';
      break;
  }
?>