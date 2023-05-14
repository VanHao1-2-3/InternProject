<?php

$act = $_GET['act'] ?? '';
switch($act){
  case 'show_product':
    $product_model = new product();
    $product = $product_model -> getProduct()-> fetchAll();
    $productHtml = '';
    foreach($product as $value):
      $productHtml.= '<tr>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="id">'.$value['id'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="product_name">'.$value['product_name'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="quantity">'.$value['quantity'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="price">'.$value['price'] .'</td>';
      $productHtml.= '<td  data-id="'.$value['id'].'" data-field="image">
      <form class="edit-image-form" action="index.php?action=product&act=edit_image" method="post">
      <img width="100" class="product-image" src="../client/view/img/product/'.$value['image'] .'"> 
      <label for="image'.$value['id'].'" class="custom-file-upload"><i class="fa fa-cloud-upload"></i></label>
      <input style="display:none" type="file" name="file" class="image" id="image'.$value['id'].'"> 
      <input type="hidden" name="id" value="'.$value['id'].'">
      <input type="hidden" name="field" value="image">
      <button class="edit-button btn btn-warning mt-2" style="display:none" type="submit">Tải ảnh lên</button>
      </form>
      </td>';
      $productHtml.= '<td data-id="'.$value['id'].'" data-field="impressive_image">
      <form class="edit-image-form" action="index.php?action=product&act=edit_image" method="post">
      <img width="100" class="product-image" src="../client/view/img/product/'.$value['impressive_image'] .'"> 
      <label for="image_impressive'.$value['id'].'" class="custom-file-upload"><i class="fa fa-cloud-upload"></i></label>
      <input style="display:none" type="file" name="file" class="image" id="image_impressive'.$value['id'].'"> 
      <input type="hidden" name="id" value="'.$value['id'].'">
      <input type="hidden" name="field" value="impressive_image">
      <button class="edit-button btn btn-warning mt-2" style="display:none" type="submit">Tải ảnh lên</button>
      </form>
      </td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="describe">'.$value['describe'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="categories">'.$value['categories'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="sold_quantity">'.$value['sold_quantity'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_s">'.$value['size_s'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_m">'.$value['size_m'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_l">'.$value['size_l'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_xl">'.$value['size_xl'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="oversize">'.$value['oversize'] .'</td>';
      $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="color">'.$value['color'] .'</td>';
      $productHtml.='<td><i class="fa fa-close delete_icon" data-id="'.$value['id'].'"></i></td>';
      $productHtml.= '</tr>';
    endforeach;
    echo json_encode(array('product'=> $productHtml));
  break;
  case 'edit_product':
    $id = $_POST['id'] ?? '';
    $value = $_POST['value'] ?? '';
    $field = $_POST['field'] ?? '';
    $product_model = new product();
    $flag = 0;
    $type = gettype($value);
    // Kiểm tra nếu giá trị của trường cập nhật trùng với giá trị cũ
    if ($product_model->getSingleProduct($id)[$field] === $value) {
        $flag = 1; // Cờ hiệu báo giá trị không thay đổi
    } else {
      // Kiểm tra nếu trường cập nhật có giá trị rỗng
      if (empty($value)) {
          $flag = 2; // Cờ hiệu báo giá trị không hợp lệ
      } else {
          // Tạo một mảng chứa danh sách các trường có kiểu dữ liệu là số
          $int_fields = ['quantity', 'sold_quantity', 'price', 'size_s', 'size_m', 'size_l', 'size_xl', 'oversize'];
          $string_field = ['id','product_name','describe','categories','color'];
          // Kiểm tra nếu trường cập nhật có kiểu dữ liệu là string 
          if (in_array($field, $int_fields)  && !is_numeric($value)) {
              $flag = 2; // Cờ hiệu báo giá trị không hợp lệ
          }elseif(in_array($field,$string_field) && is_numeric($value)){
            $flag = 2;
          } 
          else {
              // Thực hiện cập nhật dữ liệu sản phẩm
              $product = $product_model->updateProduct($id, $field, $value);
              if ($product) {
                  $flag = 0; // Cập nhật thành công
              } else {
                  $flag = 2; // Cập nhật thất bại
              }
          }
      }
     }
    if($flag == 0){
      echo json_encode(array('success'=> true));
    }
    elseif($flag == 1){
      echo json_encode(array('null'=> true));
    }
    else{
      echo json_encode(array('failed'=> true));
    }
  break;
  case 'edit_image':
    if (isset($_FILES['file']['name']) && isset($_POST['id'])&& isset($_POST['field'])) {
      $uploadDir = '../client/view/img/product/';
      $fileName = basename($_FILES['file']['name']);
      $targetFile = $uploadDir . $fileName;
      $product_model = new product(); 
      $result = '';
      $id = $_POST['id'] ?? '';
      $field = $_POST['field'] ?? '';
      if ($_FILES['file']['error'] === UPLOAD_ERR_OK && move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
        $update = $product_model -> updateImage($id,$field, $fileName);
        if($update == true){
          $result = array('success' => true,'image' => $fileName);
        }
        else{
          $result = array('failed' => true);
        }
      } else {
       $result =  array('failed' => true, 'error' => $_FILES['file']['error']);
      }
    } else {
      $result = array('failed' => true);
    }
   echo json_encode($result);
  break;
  case 'delete_product':
    $id = $_POST['id'] ?? '';
    $product_model = new product();
    $productHtml = '';
    $result = '';
    if(!empty($id)){
      $delete = $product_model -> deleteProduct($id);
      if($delete == true){
        $product = $product_model -> getProduct()-> fetchAll();
        foreach($product as $value):
          $productHtml.= '<tr>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="id">'.$value['id'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="product_name">'.$value['product_name'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="quantity">'.$value['quantity'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="price">'.$value['price'] .'</td>';
          $productHtml.= '<td  data-id="'.$value['id'].'" data-field="image">
          <form class="edit-image-form" action="index.php?action=product&act=edit_image" method="post">
          <img width="100" class="product-image" src="../client/view/img/product/'.$value['image'] .'"> 
          <label for="image'.$value['id'].'" class="custom-file-upload"><i class="fa fa-cloud-upload"></i></label>
          <input style="display:none" type="file" name="file" class="image" id="image'.$value['id'].'"> 
          <input type="hidden" name="id" value="'.$value['id'].'">
          <input type="hidden" name="field" value="image">
          <button class="edit-button btn btn-warning mt-2" style="display:none" type="submit">Tải ảnh lên</button>
          </form>
          </td>';
          $productHtml.= '<td data-id="'.$value['id'].'" data-field="impressive_image">
          <form class="edit-image-form" action="index.php?action=product&act=edit_image" method="post">
          <img width="100" class="product-image" src="../client/view/img/product/'.$value['impressive_image'] .'"> 
          <label for="image_impressive'.$value['id'].'" class="custom-file-upload"><i class="fa fa-cloud-upload"></i></label>
          <input style="display:none" type="file" name="file" class="image" id="image_impressive'.$value['id'].'"> 
          <input type="hidden" name="id" value="'.$value['id'].'">
          <input type="hidden" name="field" value="impressive_image">
          <button class="edit-button btn btn-warning mt-2" style="display:none" type="submit">Tải ảnh lên</button>
          </form>
          </td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="describe">'.$value['describe'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="categories">'.$value['categories'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="sold_quantity">'.$value['sold_quantity'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_s">'.$value['size_s'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_m">'.$value['size_m'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_l">'.$value['size_l'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="size_xl">'.$value['size_xl'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="oversize">'.$value['oversize'] .'</td>';
          $productHtml.= '<td contenteditable="true" class="editable" data-id="'.$value['id'].'" data-field="color">'.$value['color'] .'</td>';
          $productHtml.='<td><i class="fa fa-close delete_icon" data-id="'.$value['id'].'"></i></td>';
          $productHtml.= '</tr>';
        endforeach;
        $result = array('success'=>true ,'product'=>$productHtml);
      }else{
        $result = array('failed' => true);
      }
    }
    echo json_encode($result);
    break;
  default:
  include './view/product.php';
  break;
}
?>