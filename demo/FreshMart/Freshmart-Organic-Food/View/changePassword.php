<?php
$change = new user();

?>
 <!-- Breadcrumb -->
 <div id="breadcrumb">
  <div class="container">
   <h2 class="title">Change password</h2>
   <ul class="breadcrumb">
    <li><a href="#" title="Home">Home</a></li>
    <li><span>Change password</span></li>
   </ul>
  </div>
 </div>
 <div class="container">
  <div class="register-page">
   <div class="register-form form">
    <div class="block-title">
     <h2 class="title"><span>Change password</span></h2>
    </div>

    <form method="post" enctype="multipart/form-data">

     <div class="form-group">
      <label>Old Password</label>
      <input type="text" name="passwordChange1" value="<?php if(isset($_POST['passwordChange1'])) echo $_POST['passwordChange1']?>">
      <span class="invalid-feedback" style="color:red;"><?php if(isset($_GET['act']) && $_GET['act']=='changepass') echo $_SESSION['oldPass']?></span>
     </div>
     <div class="form-group">
      <label>New Password</label>
      <input type="text" name="passwordChange2" value="<?php if(isset($_POST['passwordChange2'])) echo $_POST['passwordChange2']?>">
      <span class="invalid-feedback" style="color:red;"><?php if(isset($_GET['act']) && $_GET['act']=='changepass') echo $_SESSION['newPass']?></span>
     </div>
     <div class="form-group">
      <label>Confirm NewPassword</label>
      <input type="text" name="passwordChange3" value="<?php if(isset($_POST['passwordChange3'])) echo $_POST['passwordChange3']?>">
      <span class="invalid-feedback" style="color:red;"><?php if(isset($_GET['act']) && $_GET['act']=='changepass') echo $_SESSION['cfPass']?></span>
     </div>
     <div class="form-group text-center">
      <input type="submit" class="btn btn-primary" value="Confirm">
     </div>
    </form>
   </div>
  </div>
 </div>
