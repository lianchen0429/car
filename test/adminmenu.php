<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Login -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>90號 咖啡</title>
    <?php
        include_once 'database/config.php'; 
        session_start();
    ?>
</head>
<body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="thing_of_members.php">90號 咖啡 後台管理區</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="thing_of_members.php">訂單查詢</a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">會員<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="member_insert.php">會員註冊</a></li>
                        <li><a href="member_modify.php">會員修改</a></li>
                        <li><a href="member_delect.php">會員刪除</a></li>
                      </ul>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">商品<span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                      <li><a href="thing_modify.php">進貨</a></li>
                        <li><a href="thing_insert.php">商品新增</a></li>
                        <li><a href="thing_delect.php">商品刪除</a></li>
                      </ul>
                </li>
                    <?php if(!isset($_SESSION['ADMINUSER'])){?> 
                        <button type="button" class="btn btn-default " id="myBtn">Login</button>
                    <?php }  ; ?>
                     <?php if(isset($_SESSION['level'])){?> 
                        <button type="button" class="btn btn-primary" onclick="window.location.href='index.php'">使用者</button>
                    <?php }  ; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</body>
</html>