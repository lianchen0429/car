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
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        }
            else document.getElementById('ifYes').style.display = 'none';
        }
    </script>
</head>
<body>
    <?php 
        include ("menu.php");
        if(! isset($_SESSION['ADMINUSER'])) {
            echo '<script>alert("請先登入～！");'.'location.href = "index.php";</script> '; 
        }
        if (isset($_POST['addcar'])){
            $SQLStr = "SELECT  * from 購物車明細 where 使用者_帳號='".$_SESSION['ADMINUSER']."' and 商品_商品編號='".$_POST['buyproductno']."'";
            $rs = mysql_query($SQLStr);            
            if (mysql_num_rows($rs)==0){    
                $SQLStr = "SELECT 商品單價 FROM 商品 WHERE 商品編號 ='".$_POST['buyproductno']."'";
                $rs = mysql_query($SQLStr);  
                $row = mysql_fetch_array($rs);                          
                $SQLStr = "INSERT into 購物車明細 values ('".$_SESSION['ADMINUSER']."','".$_POST['buyproductno']."','".$_POST['buyqty']."','".$row['商品單價']."')";
                $rs = mysql_query($SQLStr);   
            }
            else {  
                $SQLStr = "UPDATE  購物車明細 set  數量=數量+1 where 使用者_帳號='".$_SESSION['ADMINUSER']."' and 商品_商品編號='".$_POST['buyproductno']."'" ;
                $rs = mysql_query($SQLStr);   
            }
        }
        else if (isset($_POST['delCartOK'])){
            $SQLStr = "DELETE from 購物車明細 where 使用者_帳號='".$_SESSION['ADMINUSER']."' and 商品_商品編號='".$_POST['buyproductno']."'";
            $rs = mysql_query($SQLStr);   
        }
    ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">購物車內容
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a>
                    </li>
                    <li class="active">我的購物車</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-check"></i>快速</h4>
                    </div>
                    <div class="panel-body">
                        <p>採購快速，東西多、步驟少，不囉嗦，即點即買，你還在等甚麼！！！！　　　　　</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-gift"></i>安心 &amp; 方便</h4>
                    </div>
                    <div class="panel-body">
                        <p>讓您不管身處何地都能訂購自己所愛的咖啡豆，喝的安心、買的放心，天天都開心！</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="fa fa-fw fa-compass"></i>簡單好操作</h4>
                    </div>
                    <div class="panel-body">
                        <p>登入、選擇、結帳，三項步驟即可滿足您的需求，心動不如馬上行動各位看官們！　　　　　　</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                      <thead class="">
                        <tr>
                          <th class="lead">刪除</th>
                          <th class="lead">商品名稱</th>
                          <th class="lead">數量</th>
                          <th class="lead">單價</th>
                          <th class="lead">小計</th>  
                        </tr>
                      </thead>
                     <tbody>
                        <?php
                            $SQLStr = "SELECT 購物車明細.商品_商品編號,購物車明細.數量,購物車明細.單價,商品.商品名稱,商品.庫存量 FROM 購物車明細 inner join 商品 on 購物車明細.商品_商品編號=商品.商品編號 WHERE 購物車明細.使用者_帳號='".$_SESSION['ADMINUSER']."'";
                            $rs = mysql_query($SQLStr); 
                            if (mysql_num_rows($rs)>0) { 
                                $total_paymet=0;
                                $total = mysql_num_rows($rs); 
                                for ($i=0; $i<$total; $i++){
                                    $row = mysql_fetch_array($rs);
                                        $total_paymet=$total_paymet*1+$row['單價']*$row['數量'];
                         ?>      
                        <tr>
                            <form name="buyform" action="car.php" method="post">
                                <td>
                                    <input type="submit" name="delCartOK" value="Delete" class="btn-delete btn btn-danger"> 
                                </td>
                                <td>
                                    <p class="lead"><?php echo $row['商品名稱'];?></p>
                                </td>
                                <td>  
                                    <input type="hidden" name="buyproductno" value="<?php echo $row['商品_商品編號'];?>">
                                    <input type="text" name="buyqty" value="<?php echo $row['數量'];?>" disabled>
                                </td>
                                <td>
                                    <p class="lead">$<?php echo  $row['單價'] ;?></p>
                                </td>
                                <td class="last">
                                    <p class="lead"><?php echo "NT$".$total_paymet;?></p> 
                                </td>
                            </form>
                        </tr>                               
                        <?php
                            }
                            $_SESSION['total_paymet']=$total_paymet;
                        ?>                     
                    </tbody>
                     <?php 
                        }else {
                            echo "購物車中無商品";
                        }
                     ?> 
            </table>
                <form action="checkout.php" method="POST">
                     請選擇付款方式：
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="payway" value="信用卡" checked> 信用卡
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="payway" value="貨到付款"> 貨到付款
                        </label>
                    </div>
                    <br>
                    <br>
                     請選擇物流方式：
                    <div class="btn-group" onclick="javascript:yesnoCheck();">
                        <label class="btn btn-default">
                            <input type="radio" name="logistics" value="宅配"  id="noCheck"checked> 宅配
                        </label>
                        <label class="btn btn-default">
                            <input type="radio" name="logistics" value="超商取貨" id="yesCheck"> 超商取貨 
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label>
                        <div id="ifYes" style="display:none">
                            <select class="selectpicker" name="store" >
                              <option>新民街7-11</option>
                              <option>真理街7-11</option>
                              <option>新春街7-11</option>
                            </select>
                        </div>
                        </label>
                    </div>
                    <br>
                    <br>
                    <input type="hidden" name="address" value="<?php echo $_SESSION['address']; ?>">
                    <input type="hidden" name="phone" value="<?php echo $_SESSION['phone']; ?>">        
                    <input type="submit" name="confirmOrder" value="下一步" class="btn btn-success">
                </form>
        </div>
      </div>
    </div>
        <!-- Footer -->
    <?php include ("footer.php"); ?>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <style>
    .btn-primary:active, .btn-primary.active {
        background-color: #265a88;
        border-color: #245580;
    }
    </style>
</body>
</html>
