

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" id="login_form">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="name"
                                                placeholder="Tên đăng nhập.">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="exampleInputPassword" placeholder="Mật khẩu">
                                        </div>
                                    
                                        <button  class="btn btn-primary btn-user btn-block">
                                            Đăng nhập
                                        </button>
                                        <hr>
                                    
                                    </form>
                                    <hr>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script>
        $(document).ready(function(){
            // alert('hheheh')  
            $(document).on('submit','#login_form',function(e){
                e.preventDefault()
                let formData = $(this).serialize()
                $.ajax({
                    url:'index.php?action=homeCtrl&act=login',
                    method:"POST",
                    data:formData,
                    dataType:'json',
                    success:function(response){
                        if(response.success){
                            swal({
                                title:'Đăng nhập thành công',
                                icon:'success'
                            }).then(success =>{
                                if(success){
                                    window.location.href = 'index.php?action=homeCtrl&act=login_act'
                                }
                            })
                        }else{
                            swal({
                                title:'Đăng nhập không thành công',
                                icon:'error'
                            })
                        }
                    }
                })
            })
        })
    </script>

