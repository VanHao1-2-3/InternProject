<table class="table table-bordered">
  <thead>
    <th>Mã hóa đơn</th>
    <th>Mã khách hàng</th>
    <th>Tên khách hàng</th>
    <th>Địa chỉ</th>
    <th>Thành phố</th>
    <th>Số điện thoại</th>
    <th>Email</th>
    <th>Ngày mua hàng</th>
    <th>Tổng tiền</th>
    <th>Trạng thái</th>
  </thead>
  <tbody id="bill_display">
    <?php
    $bill_model = new bill();
    $bills = $bill_model->getBills()->fetchAll();
    if(count($bills) > 0):
    foreach ($bills as $bill) :
      if($bill['deleted'] == 0):
      echo '<tr>';
      echo '<td>'.$bill['id'].'</td>';
      echo '<td>'.$bill['customer_id'].'</td>';
      echo '<td>'.$bill['fullname'].'</td>';
      echo '<td>'.$bill['address'].'</td>';
      echo '<td>'.$bill['city'].'</td>';
      echo '<td>'.$bill['phone'].'</td>';
      echo '<td>'.$bill['email'].'</td>';
      echo '<td>'.$bill['date'].'</td>';
      echo '<td>'.$bill['total'].'</td>';
      echo '<td><span class="status">'.$bill['status'].'</span></td>';
      if( $_GET['act'] == 'update-bills'){
      echo '<td><a class="btn btn-warning edit-bills" data-id="'.$bill['id'].'">Sửa</a> 
      <a class="btn btn-primary update-bills" style="display:none" data-id="'.$bill['id'].'">Cập nhật</a></td>';
      }elseif($_GET['act'] == 'show-bills'){
        echo '<td><a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-primary show-details" data-id="'.$bill['id'].'">Xem chi tiết</a></td>';
      }else{
        echo '<td><a class="btn btn-danger delete_btn" data-id="'.$bill['id'].'">Xóa</a></td>';
      }
      echo '</tr>';
    endif;
    endforeach;
    else:
    echo '<h3>Không có hóa đơn nào</h3>';
    endif;
    ?>
  </tbody>

</table>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Chi tiết hóa đơn</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mã hóa đơn</th>
            <th>Mã sản phẩm</th>
            <th>Số lượng </th>
            <th>Kích cỡ</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody id="bills_details">
          
        </tbody>
       </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<script>
  $(document).ready(function(){
    $(document).on('click','.show-details',function(e){
      e.preventDefault()
      let id = $(this).data('id')
      let request = 'update-bills'
      $.ajax({
        url:'index.php?action=resolve&act=show-details',
        method:'post',
        data:{
          id,
          request
        },
        dataType:'json',
        success:function(response){
            if(response.success){
              $('#bills_details').html(response.html)
              console.log(response.act);
            }else{
              $('#bills_details').text("Có lỗi xảy ra");

            }
        }
      })
    })
    $('.edit-bills').click(function(e){
      e.preventDefault()
      let id = $(this).data('id')
      let request = 'edit-bills'
      let td = $(this).closest('td')
      let status = $(this).closest('tr').find('.status')
      let update_btn = $(this).closest('tr').find('.update-bills')
      td.find(this).css('display','none')
      td.find('.update-bills').css('display','block')
      let selectElement = $('<select class="form-control">')
      let options = ['Chờ xác nhận', 'Đã xác nhận', 'Đang giao hàng',"Giao hàng thành công","Hủy đơn"]
      $.each(options, function(index, value) {
      let optionElement = $("<option>");
      optionElement.val(value);
      optionElement.text(value);
      selectElement.append(optionElement);
      });
      selectElement.val(status.text())
      status.replaceWith(selectElement)
      let selectVal = '';
      selectElement.change(function(){
        selectVal = $(this).val()
      })
      console.log(update_btn);
      update_btn.click(function(){
        $.ajax({
          url:'index.php?action=resolve&act=update-bills',
          method:'post',
          data:{
            id,
            selectVal
          },
          success:function(response){
              if(response){
                swal({
                  title:'Cập nhật thành công',
                  icon:'success'
                }).then(success =>{
                  $('table').html(response)
                })
              }else{
                swal({
                  title:"Cập nhật không thành công",
                  icon:'error'
                })
              }
          }
        })
      })
    })
    $(document).on('click','.delete_btn',function(){
      let id = $(this).data('id')
      swal({
        title:"Bạn có chắc muốn xóa hóa đơn này",
        icon:'warning'
      }).then(agr => {
        if(agr){
          $.ajax({
            url:'index.php?action=resolve&act=delete-bills',
            method:"POST",
            data:{id},
            success:function(response){
              if(response){
                swal({
                title:'Xóa thành công',
                icon:'success'
              }).then(agr =>{
                $('table').html(response);
              })
              }else{
                swal({
                title:'Xóa không thành công',
                text:"Có lỗi xảy ra",
                icon:'error'
              })
              }
            }
          })
        }
      })



    })
  })
</script>
