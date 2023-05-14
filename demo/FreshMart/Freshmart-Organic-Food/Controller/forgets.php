<?php
    $act="forgetpw";
    if(isset($_GET['act']))
    {
        $act=$_GET['act'];
    }
    switch ($act) {
        case 'forgetpw':
            include "./View/forgetpassword.php";
            break;
        case 'forget_action':
            // require '../../Model/class.phpmailer.php';
            if(isset($_POST['submit_email']))
            {
                $email=$_POST['email'];
                $_SESSION['email']=array();
                // kiểm tra email có tồn tại không
                $usr=new user();
                $checkemail=$usr->getEmail($email);
                if($checkemail!=false)
                {
                    // tạo ra code gửi qua mail đó
                    $code=substr(rand(0,999999),0,6);
                    // tạo ra và lưu vào Session
                    //tạo ra đối tượng
                    $item=array(    
                        'code'=>$code,
                        'email'=>$email,
                    );
                    $_SESSION['email'][]=$item;
                    $mail = new Mailer();
                    $mail->sendMail($code,$_POST['email']);
                     include "./View/resetpw.php";
                }
                else
                {
                    echo '<script> alert("Email không tồn tại");</script>';
                    include "./View/forgetpassword.php";
                }
            }
            break;
        case 'resetpw':
            if(isset($_POST['submitpass']))
            {
                $codenew=$_POST['code'];
                foreach($_SESSION['email'] as $key=>$item)
                {
                    if($item['code']==$codenew)
                    {
                        // cập nhật
                        $codenew=md5($codenew);
                        $email=$item['email'];
                        $usr=new user();
                        $usr->updateEmail($email, $codenew);
                    }
                    else
                    {
                        echo '<script> alert("Mã code sai");</script>';
                    }
                }
            }
            include "View/user-login.php";
            break;
        
    }
