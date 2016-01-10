<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
     .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 40px;
    }
    </style>
</head>
<body>
    <?php 
        include ("menu.php");
        if(! isset($_SESSION['ADMINUSER'])) {
            echo '<script>alert("請先登入～！");'.'location.href = "index.php";</script> '; 
        }
         ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">結帳-購物明細
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a>
                    </li>
                    <li class="active">我的購物車</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading ">
                        <h4><i class="fa fa-fw fa-check"></i>確認</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>無誤</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>結帳</h4>
                    </div>
                </div>
            </div>
        </div>
        <div id="contents">
            <div class="row">
                <div class="col-md-12">
                <div id="checkout">                   
                    <table class="table table-striped">
                            <?php
                                if (empty($_POST["confirmOK"])) {
                                    $confirm_finish="NO";
                                    $SQLStr = "SELECT 購物車明細.商品_商品編號,商品.商品名稱,購物車明細.單價,商品.庫存量,購物車明細.數量
                                        FROM (購物車明細 inner join 商品 on 購物車明細.商品_商品編號=商品.商品編號) WHERE 購物車明細.使用者_帳號='".$_SESSION['ADMINUSER']."'";
                                }
                                else {  
                                        $SQLStr = "SELECT count(*) as 數量 FROM 購物車明細 WHERE 使用者_帳號 ='".$_SESSION['ADMINUSER']."'";
                                        $rs = mysql_query($SQLStr); 
                                        $row = mysql_fetch_array($rs);
                                        if ($row['數量']==0) {
                                            die("購物車中無商品");
                                        }
                                        date_default_timezone_set('Asia/Taipei');
                                        $datetime= date("Y-m-d H:i:s");
                                        $d= date("Y").date("m").date("d");
                                        $SQLStr = "SELECT Max(substr(訂單編號,9,4)) as 最大的流水號 FROM `訂單` where substr(訂單編號,1,8)='".$d."'";
                                        $rs = mysql_query($SQLStr); 
                                        $row = mysql_fetch_array($rs);
                                        if ($row['最大的流水號']==null) {
                                            $orderno=$d.'1001';
                                        }
                                        else {
                                            $orderno=$d.($row['最大的流水號']+1);
                                        }
                                        if ($_POST['logistics']=="宅配"){                                       
                                            $SQLStr = "INSERT INTO  訂單 (訂單編號,使用者_帳號,總金額,付款方式,配送方式,聯絡地址,聯絡電話)
values('".$orderno."','".$_SESSION['ADMINUSER']."','".$_SESSION['total_paymet']."','".$_POST['payway']."','".$_POST['logistics']."','".$_POST['address']."','".$_POST['phone']."')";
                                        }
                                        else{                                       
                                            $SQLStr = "INSERT INTO  訂單 (訂單編號,使用者_帳號,總金額,付款方式,配送方式,取貨超商,聯絡地址,聯絡電話)
values('".$orderno."','".$_SESSION['ADMINUSER']."','".$_SESSION['total_paymet']."','".$_POST['payway']."','".$_POST['logistics']."','".$_POST['store']."','".$_POST['address']."','".$_POST['phone']."')";
                                        }
                                        $rs = mysql_query($SQLStr); 
                                        $SQLStr = "insert into 訂單明細 select '".$orderno."' as 訂單_訂單編號,商品_商品編號,數量,單價 from 購物車明細 where 使用者_帳號= '".$_SESSION['ADMINUSER']."'";
                                        $rs = mysql_query($SQLStr);
                                        $SQLStr = "update 商品 set 庫存量=庫存量-(SELECT 數量 from 購物車明細 WHERE 使用者_帳號='".$_SESSION['ADMINUSER']."' and 購物車明細.商品_商品編號=商品.商品編號) WHERE exists(select * from 購物車明細  where 使用者_帳號='".$_SESSION['ADMINUSER']."' and 購物車明細.商品_商品編號=商品.商品編號)";
                                        $rs = mysql_query($SQLStr);
                                        $SQLStr = "delete from 購物車明細 where 使用者_帳號='".$_SESSION['ADMINUSER']."'";
                                        $rs = mysql_query($SQLStr);
                                         $SQLStr = "select 訂單明細.訂單_訂單編號,訂單明細.單價,訂單明細.數量,商品.商品名稱,商品.庫存量 from 訂單明細 inner join 商品 on 訂單明細.商品_商品編號= 商品.商品編號 where 訂單明細.訂單_訂單編號='".$orderno."'";          
                            ?>
                            <thead class="">
                                <tr>
                                    <th colspan=5>您的訂單編號是： <?php echo $orderno;?></th>
                                </tr>
                            <?php
                                }                           
                                $rs = mysql_query($SQLStr);
                               
                            ?>                              
                                <tr>
                          <th class="lead">商品名稱</th>
                          <th class="lead">數量</th>
                          <th class="lead">單價</th>
                          <th class="lead">小計</th>
                          <th class="lead">庫存</th>  
                                </tr>
                                </thead>
                                <?php
                                if (mysql_num_rows($rs)>0) { 
                                    $total_payment=0;
                                    $total = mysql_num_rows($rs); 
                                    for ($i=0; $i<$total; $i++)      {
                                        $row = mysql_fetch_array($rs);
                                        $total_payment=$total_payment*1+$row['單價']*$row['數量'];
                                ?>  
                        <tbody>                         
                                <tr>    
                                    <td class="lead">
                                        <?php echo $row['商品名稱'];?>
                                    </td>
                                    <td class="lead">
                                        <?php echo $row['數量'];?>
                                    </td>
                                    <td class="lead">
                                        $<?php echo $row['單價'];?>
                                    </td>
                                    <td class="lead">
                                        NT$<?php echo $row['數量']*$row['單價'];?>
                                    </td>
                                    <td class="lead"><div>
                                        <?php if ($row['庫存量']>=1) {echo "有";} else {echo "無";}?>
                                    </div></td>
                                </tr>                               
                            <?php
                                    }
                            ?> 
                                <tr>                                
                                    <td class="lead" colspan=2 align=right>共<?php echo $total;?>項商品，</td>
                                    <td class="lead">總計<?php echo "NT$".$total_payment;?> </td>
                                </tr>                               
                            <?php                           
                                }
                            ?> 
                        </tbody>
                    </table>
                    <form name="form1" action="checkout.php" method="post">
                        聯絡地址：<input type="text" name="address" value="<?php echo $_POST['address']; ?>"required>
                        <br>
                        <br>
                        連絡電話：<input type="text" name="phone" value="<?php echo $_POST['phone']; ?>"required>
                        <input type="hidden" name="logistics" value="<?php echo $_POST['logistics']; ?>">
                        <input type="hidden" name="store" value="<?php echo $_POST['store']; ?>">
                        <input type="hidden" name="payway" value="<?php echo $_POST['payway']; ?>">
                        <br>
                        <br>
                        <input type="submit" name="confirmOK" value="確認無誤結帳" class="btn btn-primary" >
                    </form>         
                </div>
            </div>
             <!-- Footer -->
    <?php include ("footer.php"); ?>
    </div>
    </div>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
