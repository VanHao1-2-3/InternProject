<table class="table table-bordered">
  <thead>
    <tr>
      <th>Mã hóa đơn</th>
      <th>Mã khách hàng</th>
      <th>Tên khách hàng</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <th>Email</th>
      <th>Ngày đặt</th>
      <th>Tổng tiền</th>
      <th></th>
    </tr>
  </thead>
  <tbody id="bill_display">

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
              <th>Mã hàng hóa</th>
              <th>Số lượng</th>
              <th>Kích cỡ</th>
              <th>Tổng tiền</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="detail_bill_display">

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
  $(document).ready(function() {
    $.ajax({
      url: 'index.php?action=bill&act=show_bill',
      method: 'get',
      dataType: 'json',
      success: function(response) {
        if (response.success) {
          $('#bill_display').html(response.bill)
        }
      }
    })
    $(document).on('click', '.details_btn', function() {
      let id = $(this).data('id')
      $.ajax({
        url: 'index.php?action=bill&act=show_detail_bill',
        method: 'POST',
        data: {
          id
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
           $('#detail_bill_display').html(response.bill)
          }
        }
      })

      $('.parent').find('.child').each(function() {
  var id = $(this).data('id');
  console.log(id);
});
    })
    $(document).on('click','.detail_delete',function(){
      let bill_id = $(this).data('bill_id')
      let product_id = $(this).data('product_id')
      let size = $(this).data('size')
      let total = $('#bill_display')
      $.ajax({
        url:'index.php?action=bill&act=bill_detail_delete',
        method:'POST',
        data:{bill_id, product_id,size},
        dataType:'json',
        success:function(response){
          $('#detail_bill_display').html(response.billDetail)
          if(response.exist){
            let total = $('#bill_display')
            total.find('.total').each(function(){
              let id = $(this).data('id')
              if(id == bill_id){
                $(this).html(response.total)
              }
            })
          }
          else{
            $('#bill_display').html(response.bills)
          }
        }
      })
    })
  })
</script>