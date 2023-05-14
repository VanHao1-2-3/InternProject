<div class="container">
  <div class="row py-5">
    <div class="col-md-3">
      <div class="card">
        <img  class="card-img-top mb-2" alt="User Avatar" id="user_avatar">
        <form id="personal_infor">
          <div class="form-group">
            <!-- Sử dụng label và input để tạo nút tải lên tùy chỉnh -->
            <label for="upload-file" class="custom-file-upload">
              <i class="fa fa-cloud-upload"></i> Chọn ảnh
            </label>
            <input type="file" id="upload-file" name="avatar">
            <!-- Hiển thị tên file đã chọn sau khi chọn file -->
            <div id="file-name" class="mt-2"></div>
          </div>

      </div>
    </div>
    <div class="col-md-9">
      <div class="row mb-3">
        <div class="col-md-6">

          <h2>Thông tin cá nhân</h2>
          <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name">
            <!-- <p id="name"></p> -->
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" readonly>
            <!-- <p id="email"></p> -->
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="tel" class="form-control" id="phone" name="phone">
            <!-- <p id="phone"></p> -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3 mt-5">
            <label for="address2" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address">
            <!-- <p id="address"></p> -->
          </div>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h2>Lịch sử giao dịch</h2>
         <div class="profile_bills_display">
         <table class="table table-bordered" >
            <thead>
              <tr>
                <th>Mã hóa đơn</th>
                <th>Ngày</th>
                <th>Tổng tiền</th>
                <th>Địa chỉ</th>
              </tr>
            </thead>
            <tbody id="transaction_history">
          <?php
          
          $user_model = new user();
      if(!empty($_SESSION['customer_id'])){
        $user = $user_model -> getUser($_SESSION['customer_id']);
        $listBill = $user_model -> getBill($_SESSION['customer_id'])->fetchAll();
        $bill_display = '';
        foreach($listBill as $bill):
          echo' <tr>';
          echo' <td>'.$bill['id'].'</td>';
          echo' <td>'.$bill['date'].'</td>';
          echo' <td>'.$bill['total'].'</td>';
          echo' <td>'.$bill['address'].' '.$bill['city'].'</td>';
          echo' <td><a data-toggle="modal" data-target="#profile_bills" class="btn btn-primary show-details" data-id="'.$bill['id'].'">Chi tiết</a></td>';
          echo' </tr>';
        endforeach;
      }
          ?>
            </tbody>
          </table>
         </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="profile_bills">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Chi tiết hóa đơn</h4>
        
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
        <tbody id="bills-details-profile">
          
        </tbody>
       </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<style>
  /* Thiết lập kiểu dáng cho nút tải lên */
  .custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
  }

  /* Ẩn input type=file mặc định */
  #upload-file {
    display: none;
  }
  .profile_bills_display{
    max-height: 200px;
    overflow: auto;
  }
</style>
<script>
  $(document).ready(function() {
    let image = document.querySelector('#upload-file').value;
    $.ajax({
      url: 'index.php?action=personal&act=show_personal',
      type: 'GET',
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(respnse) {
        // console.log(respnse);
        $('#name').val(respnse['name'])
        $('#email').val(respnse['email'])
        $('#address').val(respnse['address'])
        $('#phone').val(respnse['phone'])
        $('#user_avatar').attr('src', respnse['image'])
      }
    })
    $('#personal_infor').on('submit', function(e) {
      e.preventDefault()
      let formData = new FormData(this)
      let form = $(this)
      let img = form.closest('.card').find('#user_avatar')
      console.log(img);
      $.ajax({
        url: 'index.php?action=personal&act=update',
        method: "POST",
        dataType: 'json',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log(response);
          if (response.success) {
            swal({
              title: 'Cập nhật thành công',
              icon: 'success'
            }).then(success => {
              $('#name').val(response.data['name'])
              $('#email').val(response.data['email'])
              $('#address').val(response.data['address'])
              $('#phone').val(response.data['phone'])
              $('#user_avatar').attr('src', response.data['image'])
              // $('#transaction_history').html(response.data.bill_display)
            })
          } else {
            swal({
              title: 'Cập nhật không thành công',
              icon: 'error'
            })
          }
        }
      })
    })
    $('.show-details').click(function(){
      let id = $(this).data('id')
      $.ajax({
        url:'index.php?action=personal&act=show-details',
        data:{id},
        method:'POST',
        dataType:'json',
        success:function(response){
          if(response.success){
            $('#bills-details-profile').html(response.html)
          }
        }
      })
    })
  })
</script>