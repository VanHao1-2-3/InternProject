<?php

$act = $_GET['act']  ?? '';
switch($act){
  // phần sản phẩm
  case 'update':
    $id = $_POST['id'] ?? '';
    $product_model = new product();
    $product = $product_model -> getSingleProduct($id);
    if(!empty($product)){
      echo json_encode(array('success'=> true, 'product'=> $product));
    }else{
      echo json_encode(array('failed'=> true));
    }
    break;
  case 'delete':
      $id = $_POST['id'] ?? '';
      $product_model = new product();
      $delete = '';
      if(!empty($id)){
        $delete = $product_model ->insertDeleteProducts($id);
      }
      if($delete == true){
        $product_model = new product();
        $products = $product_model->getProduct()->fetchAll();
        $deleteProducts = $product_model -> getDeleteProducts()-> fetchAll();
        $deleted = array();
        $html= '';
        foreach ($products as $product) :
          foreach($deleteProducts as $productDelete):
              if($product['id'] === $productDelete['deleteID']){
                $deleted[] = $product['id'];
              }
          endforeach; 
          if(!in_array($product['id'],$deleted)):
          $html.= '<tr>';
          $html.= ' <td>' . $product['id'] . '</td>';
          $html.= ' <td>' . $product['product_name'] . '</td>';
          $html.= ' <td>' . $product['quantity'] . '</td>';
          $html.= ' <td>' . $product['price'] . '</td>';
          $html.= ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['image'] . '"></td>';
          $html.= ' <td><img style="width:60px" src="../malefashion-master/client/view/img/product/' . $product['impressive_image'] . '"></td>';
          $html.= ' <td>' . $product['describe'] . '</td>';
          $html.= ' <td>' . $product['categories'] . '</td>';
          $html.= ' <td>' . $product['sold_quantity'] . '</td>';
          $html.= ' <td>' . $product['size_s'] . '</td>';
          $html.= ' <td>' . $product['size_m'] . '</td>';
          $html.= ' <td>' . $product['size_l'] . '</td>';
          $html.= ' <td>' . $product['size_xl'] . '</td>';
          $html.= ' <td>' . $product['oversize'] . '</td>';
          $html.= ' <td>' . $product['color'] . '</td>';
          $html.= '<td><a href="index.php?action=request&act=delete-products" data-id="' . $product['id'] . '" class="btn btn-danger delete_btn">Xóa</a></td>';
          $html.= '</tr>';
        endif;
        endforeach; 
            echo json_encode(array('success'=> true,'html' => $html));
          }else{
            echo json_encode(array('failed'=> false));  
          }
    break;
  // Phần hóa đơn
    case 'show-details':
      $bill_model = new bill();
          $id = $_POST['id'] ?? '';
          $html = '';
          if(!empty($id)){
            $bill_details = $bill_model -> getDetailBills($id) -> fetchAll();
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
      
 
      case 'update-details':
            $bill_model = new bill();
            $id = $_POST['id'] ?? '';
            $html = '';
            if(!empty($id)){
              $bill_details = $bill_model -> getDetailBills($id) -> fetchAll();
              foreach($bill_details as $bill_detail):
                $html.= '<tr>';              
                $html.= '<td >'.$bill_detail['bill_id'].'</td>';
                $html.= '<td class="product_id">'.$bill_detail['product_id'].'</td>';
                $html.= '<td class="quantity">'.$bill_detail['quantity'].'</td>';
                $html.= '<td class="size">'.$bill_detail['size'].'</td>';
                $html.= '<td class="total">'.$bill_detail['total'].'</td>';
                $html.='<td><a class="edit_btn btn btn-warning">Sửa</a> <a style="display:none;" class="confirm_btn btn btn-warning">Cập nhật</a></td>';
                $html.= '</tr>';
              endforeach;
              echo json_encode(array('success'=> true, 'html'=> $html));
            }else{
              echo json_encode(array('failed'=> true));
            }
    break;
  case 'delete-bills':
      $id  = $_POST['id'] ?? '';
      $bill_model = new bill();
      $html = '';
      if(isset($id)){
        $delete = $bill_model -> updateBillDelete($id);
        if($delete == true){
          include './view/bills.php';
        }else{
          echo false;
        }
      }else{
        echo false;
      }
  break;
  case 'update-bills':
    $id = $_POST['id'] ?? '';
    $selectVal = $_POST['selectVal'] ?? '';
    if(!empty($id) && !empty($selectVal)){
      $bill_model = new bill();
      $update_bill = $bill_model -> updateStatusBill($id,$selectVal);
      if($update_bill == true){
        include './view/bills.php';
      }else{
        echo false;
      }
    }else{
      echo false;
    }
  break;
  // phần khách hàng
  case 'delete-customers':
    $id = $_POST['id'] ?? '';
    $customer_model = new customer();
    $html ='';
    if(!empty($id)){
      $delete = $customer_model -> deleteCustomer($id);
      if($delete == true){
        $customers = $customer_model-> getCustomers()-> fetchAll();
    foreach($customers as $customer):
      if($customer['deleted'] == 0):
         $html.= '<tr>';
         $html.= '<td>'.$customer['id'].'</td>';
         $html.= '<td>'.$customer['customer_name'].'</td>';
         $html.= '<td>'.$customer['customer_address'].'</td>';
         $html.= '<td>'.$customer['phone_number'].'</td>';
         $html.= '<td>'.$customer['customer_email'].'</td>';
         $html.= '<td><img width="70" src="../malefashion-master/client/view/img/user/'.$customer['avatar'].'"></td>';
         if($_GET['act']=='delete-customers'){
         $html.= '<td><a class="btn btn-danger delete_btn" data-id="'.$customer['id'].'">Xóa</a></td>';
         }
         $html.= '</tr>';
        endif;
    endforeach;
        echo json_encode(array('success'=> true, 'html'=> $html));
      }else{
        echo json_encode(array('failed'=> true));
      }
    }
  break;
  // phần quản trị
  case 'add-admin':
    $admin_model = new admin();
    $admin_name_reg = '/^[a-zA-Z][a-zA-Z0-9]*$/';
    $admin_name = $_POST['admin_name'] ?? '';
    $role = $_POST['role'] ?? '';
    $password = $_POST['password'] ?? '';
    $avatar = $_FILES['avatar']['name'] ?? '';
    $errors = array();
    if(empty($admin_name)){
      $errors['admin_name'] = "Không được để trông trường này";
    }elseif(!preg_match($admin_name_reg,$admin_name)){
      $errors['admin_name'] = "Tên đăng nhập phải bắt đầu bằng chữ cái và chỉ bao gồm chữ và số";
    }elseif(strlen($admin_name) > 20){
      $errors['admin_name'] = "Tên đăng nhập không quá 20 kí tự";
    }elseif(!empty($admin_model -> getAdmin($admin_name))){
      $errors['admin_name'] = "Tên này đã được đăng ký";
    }
    else{
      $errors['admin_name'] = "";
    }
    if(empty($password)){
      $errors['password'] = "Không được để trống trường này";
    }else{
      $errors['password'] = '';
    }
    if(empty($role)){
      $errors['role'] = "Không được để trống trường này";
    }else{
      $errors['role'] = '';
    }
    $avatar = $_FILES['avatar']['name'] ?? '';
      if(empty($avatar)){
        $errors['avatar'] = "Không được để trống trường này";
      } else {
      if(is_uploaded_file($_FILES['avatar']['tmp_name']) &&  $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
        $target_dir = "../malefashion-master/client/view/img/user/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)){
          // Tệp tin đã được tải lên và lưu trữ thành công
          $errors['avatar'] = '';
        } else {
          $errors['avatar'] = "Không thể tải lên tệp tin ảnh sản phẩm";
        }
      } else {
        $errors['avatar'] = "Lỗi khi tải lên tệp tin ảnh sản phẩm";
      }
    }
        $err = 0;
        foreach($errors as $error):
          if($error != ''){
            $err+=1;
          }
        endforeach;
        if($err > 0){
          
          echo json_encode(array('errors'=> $errors));
        }else{$data = array(
          'admin_name'=> $admin_name,
          'password'=> $password,
          'role'=> $role,
          'avatar'=> $avatar,
        );
        $add_admin = $admin_model -> insertAdmin($data);
        if($add_admin == true){
          echo json_encode(array('success'=>true));
        }else{
          echo json_encode(array('failed'=>true));
        }
        }
  break;
  case 'delete-admin':
    $id = $_POST['id'] ?? '';
    if(!empty($id)){
      $admin_model = new admin();
      $delete = $admin_model -> hideAdmin($id);
      if($delete){
        include './view/admin.php';
      }else{
        echo '<p>Có lỗi xảy ra</p>';
      }
    }
  break;
  // phần biểu đồ
  case 'show-chart':
    $chart_model = new chart();
    $month = $_POST['month'] ?? '';
    if(!empty($month)){
      $date_array = explode("-", $month);
      $year = $date_array[0];
      $month = $date_array[1];
      $result = $chart_model -> getStatisticProducts($month, $year)-> fetchAll();
    }
    else{
      $result = $chart_model -> getStatisticProducts('', '')-> fetchAll();
    }
  echo json_encode($result);
  break;
  default:
  break;
}
?>
