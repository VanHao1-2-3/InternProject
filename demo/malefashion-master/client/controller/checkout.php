<?php 
$act = $_GET['act'] ??'' ;
  switch ($act) {
    case 'checkout':
      $flag = 0;
      if(empty($_SESSION['cart'])){
        $flag = 1;
      }elseif(empty($_SESSION['customer_id'])){
        $flag =2;
      }
      else{
        $flag = 0;
      }
      
      if($flag == 1){
        $result = array('null'=> true);
      }elseif($flag == 2){
        $result = array('noLogin'=> true);
      }else{
        $result = array('success'=> true);
      }
      echo json_encode($result);
      break;
    case 'checkout_act';
    $errors = array();
    $result = '';
    $flag = 0;
    $phone_reg = '/^(0|\+84)[3|5|7|8|9][0-9]{8}$/';
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $city = $_POST['city'] ?? '';
    if(empty($fname)){
      $errors['fname_error'] = "Không để trống họ";
    }else{
      $errors['fname_error'] = "";
    }
    if(empty($lname)){
      $errors['lname_error'] = "Không để trống tên";
    }else{
      $errors['lname_error'] = "";
    }
    if(empty($city)){
      $errors['city_error'] = "Không để trống thành phố/ huyện";
    }else{
      $errors['city_error'] = "";
    }
    if(empty($address)){
      $errors['address_error'] = "Không để trống địa chỉ";
    }else{
      $errors['address_error'] = "";
    }
    if(empty($phone)){
      $errors['phone_error'] = "Không để trống số điện thoại";
    }elseif(!preg_match($phone_reg,$phone)){
      $errors['phone_error'] = "Số điện thoại không hợp lệ. Ví dụ +84/0 123456789";
    }
    else{
      $errors['phone_error'] = "";
    }
    if(empty($email)){
      $errors['email_error'] = "Không được để trống email";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email_error'] = "Email không đúng định dạng";
    }
    else{
      $errors['email_error'] = "";
    }
    $count = 0;
      foreach($errors as $value):
        if(empty($value)){
          $count +=1;
        }
      endforeach;
        if($count == count($errors)){
          $errors = false;
        }
        if(empty($errors)){
          $bill_model = new bill();
          // insert and get bill_id
          $bill_id  = $bill_model -> insertBill($_SESSION['customer_id'],$fname.''.$lname,$city,$address,$phone,$email);
          $total = 0;
          foreach($_SESSION['cart'] as $item):
            $bill_model -> insertDetail($bill_id, $item['product_id'], $item['quantity'],$item['size'],$item['total']);
            $total += ($item['total'] );
            $bill_model -> updateDatabase($item['product_id'],$item['quantity']);
          endforeach;
          $total = $_POST['discountTotal'] ?? $total;
           $bill_model -> updateTotal($bill_id, $total);
           unset($_SESSION['cart']);
          //  unset($_SESSION['discountCode']);
           echo json_encode(array('success' => true));
        }else{
          echo json_encode(array('success' => false,'errors'=> $errors,'total'=> $_POST['discountTotal']));
        }
    break;
    default:
     include './view/checkout.php';
      break;
  }
?>