<?php
    function uploadImage() 
    {
        $uploadhinh = 1;
        // Tạo đường dẫn để lấy hình về
        $target_dir = "../FreshMart-Organic-Food/View/img/product/";
        // B1: cần lấy tên hình về để vào đường dẫn
        $target_file = $target_dir.basename($_FILES['hinh']['name']);
        // B2: lấy phần mở rộng ra để kiểm tra nó có phải là hình hay không
        $imageFileTypes = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //
        if(isset($_POST['submit']))
        {
            $check = getimagesize($_FILES['hinh']['tmp_name']);
            if($check != false)
            {
                $uploadhinh = 1;
            }
            else
            {
                $uploadhinh = 0;
                // echo '<script> alert("Hình không tồn tại"); </script>';
            }
        }

        // if(file_exists($target_file))
        // {
        //     echo '<script> alert("Hình đã tồn tại"); </script>';
        // }
        // Kiểm tra hình không vượt quá 500000kb
        // if($_FILES['hinh']['size']>500000)
        // {
        //     $uploadhinh = 0;
        //     echo '<script> alert("Hình vượt quá dung lượng"); </script>';
        // }
        // Kiểm tra có phải là hình hay không
        // if($imageFileTypes !='jpg' && $imageFileTypes !='jpeg' && $imageFileTypes != 'png' && $imageFileTypes!='gif'){
        //  echo '<script> alert("Không đúng định dạng"); </script>';
        // }
        if($uploadhinh == 1){
            move_uploaded_file($_FILES['hinh']['tmp_name'],$target_file);
        }
    }
?>