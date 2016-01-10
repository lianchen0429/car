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
    <script src="js/bootstrap-select.js"></script>
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<?php
        include ("adminmenu.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 id="type">訂單明細</h1>
            <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                          <th class="lead">訂單編號</th>
                          <th class="lead">帳號</th>
                          <th class="lead">總金額</th>
                          <th class="lead">付款方式</th>
                          <th class="lead">配送方式</th>
                          <th class="lead">取貨超商</th> 
                          <th class="lead">聯絡地址</th>
                          <th class="lead">聯絡電話</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $id = $_POST["id"]; 
                            $sql = "SELECT * FROM `訂單` WHERE `訂單編號` = '".$_POST["id"]."'";
                            $rs = mysql_query($sql); 
                            if (mysql_num_rows($rs)>0) { 
                                 while($row = mysql_fetch_array($rs)){            
                         ?>      
                        <tr class="success">
                                <td>
                                    <p class="lead"><?php echo $row['訂單編號'];?></p>
                                </td>
                                <td>  
                                    <p class="lead"><?php echo $row['使用者_帳號'];?></p>
                                </td>
                                <td>  
                                    <p class="lead">$<?php echo $row['總金額'];?></p>
                                </td>
                                <td>
                                    <p class="lead"><?php echo  $row['付款方式'] ;?></p>
                                </td>
                                <td>
                                    <p class="lead"><?php echo  $row['配送方式'] ;?></p>
                                </td>
                                <td>
                                    <p class="lead"><?php echo  $row['取貨超商'] ;?></p>
                                </td>
                                <td>
                                    <p class="lead"><?php echo  $row['聯絡地址'] ;?></p>
                                </td>
                                <td>
                                    <p class="lead"><?php echo  $row['聯絡電話'] ;?></p>
                                </td>
                        </tr>                               
                        <?php
                            }
                        ?>                     
                    </tbody>
                    <?php 
                        }
                    ?> 
                </table>  
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                          <th class="lead">商品名稱</th>
                          <th class="lead">數量</th>
                          <th class="lead">單價</th>
                          <th class="lead">小計</th>  
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sql = "SELECT 訂單明細.訂單_訂單編號,訂單明細.商品_商品編號,商品.商品名稱,訂單明細.數量,訂單明細.單價 FROM 訂單明細 inner join 商品 on 訂單明細.商品_商品編號=商品.商品編號 WHERE 訂單明細.訂單_訂單編號='".$_POST["id"]."'";
                        $rs = mysql_query($sql); 
                        if (mysql_num_rows($rs)>0) { 
                            $total_paymet=0;
                             $total = mysql_num_rows($rs); 
                            for ($i=0; $i<$total; $i++){
                                $row = mysql_fetch_array($rs);
                                $total_paymet=$total_paymet*1+$row['單價']*$row['數量'];
                        ?>      
                        <tr>               
                            <td>
                                <p class="lead"><?php echo $row['商品名稱'];?></p>
                            </td>
                            <td>  
                                <p class="lead"><?php echo $row['數量'];?></p>
                            </td>
                            <td>
                                <p class="lead">$<?php echo  $row['單價'] ;?></p>
                            </td>
                            <td class="last">
                                <p class="lead"><?php echo "NT$".$total_paymet;?></p> 
                            </td>
                        </tr>                               
                        <?php
                            }
                        ?>                     
                    </tbody>
                     <?php 
                        }
                     ?> 
                </table>
            </div>
        </div>
        <a href="thing_of_members.php" class="btn btn-success">回首頁 </a>
    </div>
</body>
</html>