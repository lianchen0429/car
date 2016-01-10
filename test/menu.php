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
        if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
            unset($_SESSION["ADMINUSER"]);
            unset($_SESSION["ADMINPWD"]);
            unset($_SESSION["level"]);   
            header("Location: index.php");
        }
        if(isset($_GET["cid"])&&($_GET["cid"]!="")){
            $query_RecProduct = "SELECT * FROM `商品` WHERE `商品類別_類別編號`=".$_GET["cid"]." ORDER BY `商品編號` DESC";
        }
        else{
             $query_RecProduct = "SELECT * FROM `商品` ORDER BY `商品編號` DESC";
        }

        $RecProduct = mysql_query($query_RecProduct);
        $query_RecCategory = "SELECT `商品類別`.`類別編號`, `商品類別`.`類別名稱`FROM `商品類別` LEFT JOIN `商品` ON `商品類別`.`類別編號` = `商品`.`商品類別_類別編號` GROUP BY `商品類別`.`類別編號`, `商品類別`.`類別名稱`, `商品類別`.`類別名稱`;";
        $RecCategory = mysql_query($query_RecCategory);

    ?>
</head>
<body>
<!-- 登入 -->
        <?php
            if (!isset($_POST['user']) && !isset($_POST['password'])) {
        ?>
        <div class="container">
              <!-- Modal -->
              <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="padding:35px 50px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
                    </div>
                    <div class="modal-body" style="padding:40px 50px;">
                      <form role="form"  method="post" action="">
                        <div class="form-group">
                          <label for="usrname"><span class="glyphicon glyphicon-user"></span>帳號</label>
                          <input type="text" name="user" class="form-control" id="usrname" placeholder="請輸入帳號">
                        </div>
                        <div class="form-group">
                          <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> 密碼</label>
                          <input type="password" name="password" class="form-control" id="psw" placeholder="請輸入密碼">
                        </div>
                          <input type="submit" name="Submit2" class="btn btn-success btn-block" value="登入">     
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                      <p><a href="assign.php">加入會員</a></p>
                    </div>
                  </div>     
                </div>
              </div> 
        </div>
        <script>
            $(document).ready(function(){
                $("#myBtn").click(function(){
                    $("#myModal").modal();
                });
            });
        </script>
            <?php
                }
                else{
                    $_SESSION['ADMINUSER']=$_POST['user'];
                    $_SESSION['ADMINPWD']=$_POST['password'];  
                    $SQLStr = "SELECT *FROM 使用者 WHERE 使用者.帳號='".$_SESSION['ADMINUSER']."'"." and 使用者.密碼='".$_SESSION['ADMINPWD']."'";
                    $rs = mysql_query($SQLStr);
                    if(mysql_num_rows($rs)==0){
                        unset($_SESSION["ADMINUSER"]);
                        unset($_SESSION["ADMINPWD"]);
                        echo '<script>alert("帳號或密碼錯誤!");' .'location.href = "index.php";</script>';
                        die();
                    }
                    $SQLStr = "SELECT *FROM 使用者 WHERE 使用者.帳號='".$_SESSION['ADMINUSER']."'"." and 使用者.權限='一般會員'";
                    $rs = mysql_query($SQLStr);
                    $row_rs=mysql_fetch_assoc($rs);
                    $address=$row_rs["地址"];
                    $phone=$row_rs["電話"];
                    $_SESSION['address']=$address;
                    $_SESSION['phone']=$phone;
                    if(mysql_num_rows($rs)>0){
                        echo'<script>alert("一般會員登入成功！");'.'location.href = "index.php";</script> '; 
                        die();
                    }
                    $SQLStr = "SELECT *FROM 使用者 WHERE 使用者.帳號='".$_SESSION['ADMINUSER']."'"." and 使用者.權限='管理者'";
                    $rs = mysql_query($SQLStr);
                    $row_rs=mysql_fetch_assoc($rs);
                    $address=$row_rs["地址"];
                    $phone=$row_rs["電話"];
                    $_SESSION['address']=$address;
                    $_SESSION['phone']=$phone;
                    if(mysql_num_rows($rs)>0){
                        $_SESSION['level']="ADMIN";
                        echo'<script>alert("管理者登入成功！");'.'location.href = "index.php";</script> ';                            
                        }
                }
                
            ?>
<!-- 選單 -->
<!-- Navigation -->
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
                <a class="navbar-brand" href="index.php">90號 咖啡</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        while($row_RecCategory=mysql_fetch_assoc($RecCategory)){ 
                    ?> 
                    <li>
                        <li><a href="about.php?cid=<?php echo $row_RecCategory["類別編號"];?>"><?php echo $row_RecCategory["類別名稱"];?> </a></li>
                    </li>
                    <?php } ?>
                    <?php if(isset($_SESSION['ADMINUSER'])){?>
                    <li>
                        <a href="car.php">我的購物車</a>
                    </li>
                    <li>
                        <a href="thing.php">我的訂單</a>
                    </li>
                    <input class="btn btn-default" type="button" value="Logout" onclick="window.location.href='?logout=true'">
                    <?php } ?>
                    <?php if(!isset($_SESSION['ADMINUSER'])){?> 
                        <button type="button" class="btn btn-default " id="myBtn">Login</button>
                    <?php }  ; ?>
                     <?php if(isset($_SESSION['level'])){?> 
                        <button type="button" class="btn btn-danger " onclick="window.location.href='thing_of_members.php'">管理者</button>
                    <?php }  ; ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</body>