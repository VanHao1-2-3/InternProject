<table class="table table-bordered">
  <thead>
    <tr>
      <th>Mã khách hàng</th>
      <th>Tên khách hàng</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <th>Email</th>
      <th>Ảnh</th>
    </tr>
  </thead>
  <tbody id="customer_display">
    <?php
    $customer_model = new customer();
    $customers = $customer_model-> getCustomers()-> fetchAll();
    foreach($customers as $customer):
      if($customer['deleted'] == 0):
          echo '<tr>';
          echo '<td>'.$customer['id'].'</td>';
          echo '<td>'.$customer['customer_name'].'</td>';
          echo '<td>'.$customer['customer_address'].'</td>';
          echo '<td>'.$customer['phone_number'].'</td>';
          echo '<td>'.$customer['customer_email'].'</td>';
          echo '<td><img width="70" src="../malefashion-master/client/view/img/user/'.$customer['avatar'].'"></td>';
         if($_GET['act']=='delete-customers'){
          echo '<td><a class="btn btn-danger delete_btn" data-id="'.$customer['id'].'">Xóa</a></td>';
         }
          echo '</tr>';
        endif;
    endforeach;
    ?>
  </tbody>
</table> 
<script>
  $(document).ready(function(){
    $(document).on('click','.delete_btn',function(){
      let id = $(this).data('id')
      swal({
        title:"Bạn có chắc chắn muốn xóa người dùng này",
        icon:'warning'
      }).then(agr =>{
        $.ajax({
          url:'index.php?action=resolve&act=delete-customers',
          method:'post',
          data:{id},
          dataType:'json',
          success:function(response){
            if(response.success){
              swal({
                title:'Xóa thành công',
                icon:'success'
              }).then(success => {
                $('#customer_display').html(response.html)
              })
            }else{
              swal({
                title:'Xóa không thành công',
                icon:'error'
              })
            }
          }
        })
      })
    })
  })
</script>