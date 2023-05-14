$(document).ready(function () {

  // phần đăng ký
  $("#signup_form").submit(function (e) {
    e.preventDefault();
    let formData = $(this).serialize();
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          swal({
            title: "Đăng ký thành công",
            text: "Nhấn vào nút OK để đi đến trang đăng nhập",
            icon: "success",
          }).then((willRedirect) => {
            if (willRedirect) {
              window.location.href = "index.php?action=user&act=login";
            }
          });
        } else if(response.existed){
          swal({
            title: "Người dùng đã tồn tại",
            text: "Vui lòng thay đổi tên khách hàng, email và số điện thoại và đăng ký lại",
            icon: "error",
          })
        } 
        else {
          $(".name_error").text(response.errors.username);
          $(".address_error").text(response.errors.address);
          $(".phone_error").text(response.errors.phone);
          $(".email_error").text(response.errors.email);
          $(".password_error").text(response.errors.password);
        }
      },
    });
  });
  $('#username').on('blur',function(){
    let username = $('#username').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {username},
      dataType: "json",
      success: function (response) {
        $(".name_error").text(response.errors.username);
      }})
  })
  $('#email').on('blur',function(){
    let email = $('#email').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {email},
      dataType: "json",
      success: function (response) {
        $(".email_error").text(response.errors.email);
      }})
  })
  $('#password').on('blur',function(){
    let password = $('#password').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {password},
      dataType: "json",
      success: function (response) {
        $(".password_error").text(response.errors.password);
      }})
  })
  $('#address').on('blur',function(){
    let address = $('#address').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {address},
      dataType: "json",
      success: function (response) {
        $(".address_error").text(response.errors.address);
      }})
  })
  $('#phone').on('blur',function(){
    let phone = $('#phone').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {phone},
      dataType: "json",
      success: function (response) {
        $(".phone_error").text(response.errors.phone);
      }})
  })
  $('#username').on('keyup',function(){
    let username = $('#username').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {username},
      dataType: "json",
      success: function (response) {
        $(".name_error").text('');
      }})
  })
  $('#email').on('keyup',function(){
    let email = $('#email').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {email},
      dataType: "json",
      success: function (response) {
        $(".email_error").text('');
      }})
  })
  $('#password').on('keyup',function(){
    let password = $('#password').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {password},
      dataType: "json",
      success: function (response) {
        $(".password_error").text('');
      }})
  })
  $('#address').on('keyup',function(){
    let address = $('#address').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {address},
      dataType: "json",
      success: function (response) {
        $(".address_error").text('');
      }})
  })
  $('#phone').on('keyup',function(){
    let phone = $('#phone').val()
    $.ajax({
      url: "./ajax/signup.php",
      type: "POST",
      data: {phone},
      dataType: "json",
      success: function (response) {
        $(".phone_error").text('');
      }})
  })
//  phần đăng nhập
$('#signin_form').submit(function(e){
  e.preventDefault();
  let formData = $(this).serialize();
  $.ajax({
    url: "./ajax/login.php",
    type: "POST",
    data: formData,
    dataType: "json", 
    success: function (response) {
      if(response.errors){
        $('.email_signin_error').text(response.errors.email_signin)
      $('.password_signin_error').text(response.errors.password_signin)

      }
      if(response.failed){
        swal({
          title: "Đăng nhập thất bại",
          text: "Tài khoản hoặc mật khẩu không chính xác",
          icon: "error",
        })
      }
      if(response.success){
        $('.signedin_name').text(response.name)
        swal({
          title: "Đăng nhập thành công",
          text: "Nhấn vào nút OK để đi đến trang chủ",
          icon: "success",
        }).then((willRedirect) => {
          if (willRedirect) {
            window.location.href = "index.php";
          }
        });
      }
    }})
})
$('#logout').click(function(e){
  e.preventDefault()
  $.ajax({
    url:'index.php?action=user&act=logout',
    dataType:'json',
    success:function(response){
      console.log(response);
      if(response.success){
        swal({
          title: "Đăng xuất thành công",
          text: "Nhấn OK để về lại trag chủ",
          icon: "warning",
        }).then(redirect => {
          if(redirect){
            window.location.href = 'index.php'
          }
        })

        
      }
  }
  })
})

$('#signin_form').submit(function(e){
e.preventDefault();
let formData = $(this).serialize();
$.ajax({
  url: "index.php?action=user&act=login_act",
  type: "POST",
  data: formData,
  dataType: "json", 
  success: function (response) {
    console.log(response);
    if(response.errors){
      $('.email_signin_error').text(response.errors.email_signin)
    $('.password_signin_error').text(response.errors.password_signin)

    }
   else if(response.failed){
      swal({
        title: "Đăng nhập thất bại",
        text: "Tài khoản hoặc mật khẩu không chính xác",
        icon: "error",
      })
    }
   else if(response.success){
      $('.signedin_name').text(response.name)
      swal({
        title: "Đăng nhập thành công",
        text: "Nhấn vào nút OK để đi đến trang chủ",
        icon: "success",
      }).then((willRedirect) => {
        if (willRedirect) {
          window.location.href = "index.php";
        }
      });
    }
  },
  error: function(jqXHR, textStatus, errorThrown) {
  console.log("AJAX Error:", textStatus, errorThrown);
}
})
})

});
