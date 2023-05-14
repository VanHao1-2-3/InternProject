<div class="container d-flex justify-content-center align-items-center">
<form id="add-admin" >
  <h3>Thêm tài khoản quản trị</h3>
  <div class="form-group">
    <label for="">Tên đăng nhập</label>
    <input type="text" name="admin_name" id="" class="form-control" placeholder="Tên đăng nhập">
    <span class="text-danger error_admin_name"></span>
  </div>
  <div class="form-group ">
    <label for="">Mật khẩu</label>
    <input type="password" name="password" id="" class="form-control" placeholder="Mật khẩu">
    <span class="text-danger error_password"></span>
  </div>
  <div class="form-group">
    <label for="">Ảnh</label>
    <input type="file" name="avatar" id="" class="form-control">
    <span class="text-danger error_avatar"></span>
  </div>
  <div class="form-group">
    <label for="">Quyền</label>
    <select name="role" id="" class="form-control">
      <option value="">Chọn quyền</option>
      <?php
      $admin_model = new admin();
      $roles = $admin_model -> getRole() -> fetchAll();
      foreach($roles as $role):
        echo '<option value="'.$role['id'].'">'.$role['role'].'</option>';
      endforeach;
      ?>
    </select>
    <span class="text-danger error_role"></span>
  </div>
  <button type="submit" class="btn btn-primary">Thêm</button>
</form>
</div>
<script>
  $(document).ready(function(){
    $(document).on('submit','#add-admin',function(e){
      e.preventDefault();
      let formData = new FormData(this)
      $.ajax({
        url:'index.php?action=resolve&act=add-admin',
        method:"POST",
        data: formData,
        contentType:false,
        processData:false,
        dataType:'json',
        success: function(response){
          if(response.success){
            swal({
              title:"Thêm tài khoản thành công",
              icon:'success'
            })
            $('.error_admin_name').text('')
            $('.error_role').text('')
            $('.error_password').text('')
            $('.error_avatar').text('')
          }else if(response.errors){
            $('.error_admin_name').text(response.errors.admin_name)
            $('.error_role').text(response.errors.role)
            $('.error_password').text(response.errors.password)
            $('.error_avatar').text(response.errors.avatar)
          }else{
            swal({
              title:'Có lỗi xảy ra',
              text:'Thêm tài khoản không thành công',
              icon:'error'
            })
          }
        }
      })
    })



  })
</script>