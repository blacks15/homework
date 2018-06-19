<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
                        <!-- CSS -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="public/plugins/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="public/plugins/bootstrap-select/css/bootstrap-select.css">
    <link rel="stylesheet" type="text/css" href="public/plugins/font-awesome/css/fontawesome-all.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/loading.css">
                        <!-- JAVASCRIPT -->
    <script type="text/javascript" src="public/plugins/jquery/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="public/plugins/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="public/plugins/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="public/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <script type="text/javascript" src="public/plugins/sweetalert/sweetalert2.all.js"></script>
    <script type="text/javascript" src="public/plugins/basicjs/basicjs.js"></script>
    <script type="text/javascript" src="public/js/nav.js"></script>
    <script type="text/javascript" src="public/js/global.js"></script>
    <script type="text/javascript" src="public/js/home.js"></script>
</head>
    <body>
        <div class="wrapper">
            <?php 
                require_once('rutas.php');
                //include("private/resources/masterpage/sidebar.php");    //SIDEBAR
            ?>
            <div class="main">
                <?php 
                include("private/resources/masterpage/userbar.php");    //NAV
                include("private/resources/masterpage/container.php");  //MASTER
                ?>
            </div>
        </div>
    </body>
</html>
