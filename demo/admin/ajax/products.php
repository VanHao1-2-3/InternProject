<?php
include '../model/connect.php';
include '../model/product.php';
$errors = array();
$id = $_POST['id'] ?? '';
$origin_id = $id;
$product_name = $_POST['product_name'] ?? '';
$quantity = $_POST['quantity'] ?? 0;
$price = $_POST['price'] ?? 0;
$image = $_FILES['image']['name'] ?? '';
$impressive_image = $_FILES['impressive_image']['name'] ?? '';
$describe = $_POST['describe']?? '';
$categories = $_POST['categories'] ?? '';
$sold_quantity = $_POST['sold_quantity'] ?? 0;  
$size_m = $_POST['size_m'] ?? 0;
$size_l = $_POST['size_l'] ?? 0;
$size_xl = $_POST['size_xl'] ?? 0;
$size_s = $_POST['size_s'] ?? 0;
$oversize = $_POST['oversize'] ?? 0;
$color = $_POST['color'] ?? '';
$request = $_POST['request'] ?? '' ;
$reg_string = "/^[a-zA-Zàáảãạăắằẳẵặâấầẩẫậđèéẻẽẹêếềểễệìíỉĩịòóỏõọôốồổỗộơớờởỡợùúủũụưứừửữựỳýỷỹỵ]/";
$product_model = new product();
if($_POST['request'] == 'update-products'){
  $errors['id'] = "";
}else{
  if(empty($id)){
    $errors['id'] = "Không được để trống trường này";
  }elseif($product_model -> getSingleProduct($id)){
    $errors['id'] = "ID này đã tồn tại";
  }else{
    $errors['id'] = "";
  }
}

if(empty($product_name)){
  $errors['product_name'] = "Không được để trống tên sản phẩm";
}elseif(!preg_match($reg_string, $product_name)){
  $errors['product_name'] = "Tên phải bắt đầu bằng chữ cái";
}else{
  $errors['product_name'] = "";
}
if(empty($categories)){
  $errors['categories'] = "Không được để trống danh mục sản phẩm";
}else{
  $errors['categories'] = "";
}
if(empty($color)){
  $errors['color'] = "Không được để trống màu sản phẩm";
}elseif(!preg_match($reg_string, $color)){
  $errors['color'] = "Tên phải bắt đầu bằng chữ cái";
}else{
  $errors['color'] = "";
}
if(empty($describe)){
  $errors['describe'] = "Không được để trống tên sản phẩm";
}else{
  $errors['describe'] = "";
}
if(empty($_FILES['image']['name'])){
  $errors['image'] = 'Vui lòng chọn ảnh';
}else{
  $errors['image'] = '';
}
if(empty($_FILES['impressive_image']['name'])){
  $errors['impressive_image'] = 'Vui lòng chọn ảnh';
}else{
  $errors['impressive_image'] = '';
}
if(isset($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && !empty($image)){
  $target_dir = "../../malefashion-master/client/view/img/product/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
    // Tệp tin đã được tải lên và lưu trữ thành công
    $image = $_FILES['image']['name'];
    $errors['image'] = '';
  }else{
    $errors['image'] = "Không thể tải lên tệp tin ảnh sản phẩm";
  }
}

if(isset($_FILES['impressive_image']['name']) && $_FILES['impressive_image']['error'] === UPLOAD_ERR_OK && !empty($impressive_image)){
  $target_dir = "../../malefashion-master/client/view/img/product/";
  $target_file = $target_dir . basename($_FILES["impressive_image"]["name"]);
  if(move_uploaded_file($_FILES["impressive_image"]["tmp_name"], $target_file)){
    // Tệp tin đã được tải lên và lưu trữ thành công
    $errors['impressive_image'] = '';
    $impressive_image = $_FILES['impressive_image']['name'];
  }else{
    $errors['impressive_image'] = "Không thể tải lên tệp tin ảnh liên quan sản phẩm";
  }
}
$countErr = 0;
foreach($errors as $error):
  if($error!= ''){
    $countErr +=1;
  }
endforeach;
$result = "";

if($countErr > 0){
  echo json_encode(array('error'=> true, 'errors'=> $errors));
}else{
  $data= array(
    'id'=>$id,
    'product_name'=>$product_name,
    'quantity'=>$quantity,
    'price'=>$price,
    'image'=>$image,
    'impressive_image'=>$impressive_image,
    'describe'=>$describe,
    'categories'=>$categories,
    'sold_quantity'=>$sold_quantity,
    'size_s'=>$size_s,
    'size_m'=>$size_m,
    'size_l'=>$size_l,
    'size_xl'=>$size_xl,
    'oversize'=>$oversize,
    'color'=>$color,
  );
  if(isset($request)){
    if($request == 'add-products'){
      $result = $product_model-> insertProduct($data);
      }else{
        $result = $product_model -> updateProduct($data);
      }
  }
 if($result == true){
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
    $html.= ' <td><a href="index.php?action=request&act=update-products" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-success edit_btn" data-id="' . $product['id'] . '">Sửa</a></td>';
    $html.= '</tr>';
  endif;
  endforeach; 
  echo json_encode(array('success'=> true,'html'=> $html));
 }else{
  echo json_encode(array('failed'=> true,'err' => $result,'req' => $data));
 }
}

?>