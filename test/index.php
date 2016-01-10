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
    <?php 
        include ("menu.php");
        $sql = "SELECT * FROM 商品 ORDER BY 商品編號";
        $result = mysql_query($sql);
        $total = mysql_num_rows($result);
        $category = array();
        while ($row = mysql_fetch_assoc($result)) {
            array_push($category, $row);
    } ?>
<body>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/index/1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>麝香咖啡</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/index/2.jpg');"></div>
                <div class="carousel-caption">
                    <h2>愛爾蘭咖啡</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/index/3.jpg');"></div>
                <div class="carousel-caption">
                    <h2>焦糖瑪奇朵</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

    <!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    歡迎來到 90 號咖啡
                </h1>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
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

        <!-- Portfolio Section -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">本期推薦商品</h2>
            </div>
            <?php
                for($i=0 ; $i<6; $i++) {
            ?>
            <div class="col-md-4 col-sm-6">
                <a href="about.php?cid=<?=$category[$i]['商品類別_類別編號']?>">
                    <img class="img-responsive img-portfolio img-hover" src="<?=$category[$i]['圖檔名']?>" alt="">
                </a>
            </div>
            <?php
                }
            ?> 
        </div>
        <!-- Footer -->
        <?php include ("footer.php"); ?>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
