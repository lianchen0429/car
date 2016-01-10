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
</head>
<body>
    <?php 
        include ("menu.php");
        if (isset($_GET['page'])) {
            $current = $_GET['page'];
        } else {
            $current = 1;   // 未設定,顯示第一頁
        }
        // 設定每一分頁顯示多少筆
        $per = 6; 
        // 查詢並顯示該分頁內容
        $start = ($current - 1) * $per;
        $query = $query_RecProduct . ' LIMIT ' . $start . ',' . $per;
        $RecProduct = mysql_query($query);
        $sql = "SELECT * FROM `商品` WHERE `商品類別_類別編號`=".$_GET["cid"]." ORDER BY `商品編號` DESC";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result); // 總筆數           
        $pages = ceil($total / $per);
        if(isset($_GET['cid'])) {
            $category= $_GET['cid'];
        }
        $sql = "SELECT * FROM 商品類別 ORDER BY 類別編號";
        $result = mysql_query($sql);

        $category_product = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($category_product, $row);
        }
        $cp = $category_product[$category-1];
        ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">關於
                    <small><?=$cp['類別名稱'];?>咖啡豆</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">首頁</a>
                    </li>
                    <li class="active">關於</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" src="<?=$cp['類別照片'];?>" alt="">         
            </div>
            <div class="col-md-6">
                <h2>歷史由來</h2>
                <p><?=$cp['類別簡介'];?></p>
            </div>
        </div>
        <!-- /.row -->
        <!-- Team Members -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">所有商品</h2>
            </div>
            <?php
                while($row_RecProduct=mysql_fetch_assoc($RecProduct)){                
            ?>
            <div class="col-md-4 text-center">
                <form action="car.php" method="POST">
                    <div class="thumbnail">
                        <img class="img-responsive" src="<?=$row_RecProduct['圖檔名']?>" alt="">
                        <div class="caption">
                            <h3><?=$row_RecProduct['商品名稱']?><br>
                                <small>單價： $</small>
                                <small><?=$row_RecProduct['商品單價']?></small>
                            </h3>
                            <p>
                                <small>現有庫存量：</small>
                                <small><?=$row_RecProduct['庫存量']?></small>
                            </p>
                            <ul class="list-inline">
                                <button type="button" disabled="disabled" class="btn btn-default btn-lg" readonly>
                                    <span class="glyphicon glyphicon-shopping-cart">    
                                </button>
                                <input type="submit" class="btn btn-primary" name="addcar" value="加入購物車">
                                <input type=hidden name="buyproductno" value="<?=$row_RecProduct['商品編號']?>">
                                <p>購買數量：
                                <input type="text" class="form-control-" name="buyqty" value="1">
                                <input type="hidden" value="<?=$row_RecProduct['商品編號']?>">  
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
            <?php
             }
            ?>       
        </div>
        <!-- /.row -->
        <div class="row text-center">
            <div class="col-lg-12"></div>
                <nav>
                    <ul class="pagination ">
                        <li>
                            <?php  if ($current > 1) {?>
                                <a href="about.php?cid=<?=$category?>&page=<?php echo $current-1;?>">&lt;&lt;</a>              
                            <?php }else{?>
                                <a href=""> &lt;&lt;</a> 
                             <?php }?>
                        </li> 
                        <?php
                            for ($i = 1; $i <= $pages; $i++) {
                        ?>
                        <li>
                            <?='<a href="about.php?cid='.$category.'&page=' . $i . '">' . $i . '</a> '?>
                        </li>
                        <?php
                            }
                        ?>
                        <li>
                            <?php  if ($current < $pages) {?>
                                <a href="about.php?cid=<?=$category?>&page=<?php echo $current+1;?>">&gt;&gt;</a>              
                            <?php }else{?>
                                <a href=""> &gt;&gt;</a> 
                            <?php }?>
                        </li>
                    </ul>
                </nav> 
        </div>        
         <!-- Footer -->
        <?php include ("footer.php"); ?>
    </div>
    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
