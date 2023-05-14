<?php
if(isset($_GET['makh'])){
  $user = new user();
  $user -> deleteUser($_GET['makh']);
  echo "<script type='text/javascript'>
        Swal.fire({
          icon: 'success',
          title: 'Thành công',
          text: 'Xóa thành công',
          confirmButtonText: 'OK',
        })
        </script>";
  echo '<meta http-equiv=refresh content="3;url=./index.php?action=home"/>';
}
?>