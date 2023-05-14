<!-- <table class="table table-bordered">
  <thead>
    <tr>
      <th>ID admin</th>
      <th>Tên admin</th>
      <th>Ảnh</th>
      <th>Vai trò</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $admin_model = new admin();
    $admins = $admin_model->getAdminAcc()->fetchAll();
    $html = '';
    foreach ($admins as $admin) :
      echo '<tr>';
      echo ' <td>' . $admin['id'] . '</td>';
      echo ' <td>' . $admin['admin_name'] . '</td>';
      echo ' <td><img width="70" src="../malefashion-master/client/view/img/user/' . $admin['avatar'] . '"></td>';
      echo ' <td>' . $admin['role'] . '</td>';
      echo '</tr>';
    endforeach;
    ?>
  </tbody>
</table> -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID admin</th>
                <th>Tên admin</th>
                <th>Ảnh</th>
                <th>Vai trò</th>
                <?php 
                
                if(isset($_GET['act']) && $_GET['act'] != 'show-admin'){
                  echo '<th></th>';
                }
                ?>
              </tr>
            </thead>

            <tbody>
              <?php

              $admin_model = new admin();
              $admins = $admin_model->getAdminAcc()->fetchAll();
              $html = '';
              foreach ($admins as $admin) :
                if($admin['deleted'] == 0):
                echo '<tr>';
                echo ' <td>' . $admin['id'] . '</td>';
                echo ' <td>' . $admin['admin_name'] . '</td>';
                echo ' <td><img width="70" src="../malefashion-master/client/view/img/user/' . $admin['avatar'] . '"></td>';
                echo ' <td>' . $admin['role'] . '</td>';
                if(isset($_GET['act']) && $_GET['act'] == 'delete-admin'){
                  echo '<td><a class="btn btn-danger delete_btn" data-id="'.$admin['id'].'" >Xóa</a></td>';
                }
                echo '</tr>';
              endif;
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- End of Main Content -->
<script>
  $(document).ready(function(){
    $(document).on('click','.delete_btn',function(e){
      let id = $(this).data('id')
      swal({
        title:'Bạn có chắc muốn xóa tài khoản này',
        icon:'warning'
      }).then(success => {
        if(success){
          $.ajax({
            url:'index.php?action=resolve&act=delete-admin',
            data:{id},
            method:'post',
            success:function(response){
                $('table').html(response)
            }
          })
        }
      })
    })
  })
</script>