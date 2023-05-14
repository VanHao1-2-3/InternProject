<body class="home home-1" id="body">
          <?php
            include_once "View/header.php";
            $ctrl = '';
              if(isset($_GET['action'])){
                $ctrl = $_GET['action'];
                
              }
              include_once "Controller/".$ctrl.".php";
              include_once "View/footer.php";
          ?>
</body>
