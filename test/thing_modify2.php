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
    if(isset($_POST["action"])&&($_POST["action"]=="join")){
            $query_RecFindUser = "SELECT * FROM `商品` WHERE `商品編號` ='".$_POST["id"]."'";    
            $RecFindUser=mysql_query($query_RecFindUser);
            $data = array();
            while ($row = mysql_fetch_array($RecFindUser, MYSQL_BOTH)) {
                $data = $row;
            }
        }
    ?>
  <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 id="type">進貨</h1>
          <hr/>
        </div>
      </div>
      <div class="row">
        <form class="form-horizontal" name="action" method="post" action="database/modify_thing.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">商品編號</label>
            <div class="col-sm-10">
              <input type="text" name="id" class="form-control" value="<?= $data['商品編號'] ?>"  placeholder="帳號" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">類別編號</label>
            <div class="col-sm-10">
              <input type="text" name="password" class="form-control"  value="<?= $data['商品類別_類別編號'] ?>"  placeholder="密碼" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">商品名稱</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control"  value="<?= $data['商品名稱'] ?>" placeholder="姓名" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">目前庫存量</label>
            <div class="col-sm-10">
              <input type="text" name="" class="form-control"  value="<?= $data['庫存量'] ?>" placeholder="地址" readonly>
            </div>
          </div>

          <div class="form-group has-error has-feedback">
            <label class="col-sm-2 control-label">廠商批發價</label>
            <div class="col-sm-10">
              <input type="text" name="" value="20" class="form-control" readonly>
            </div>
          </div>


          <div class="form-group has-error has-feedback">
            <label class="col-sm-2 control-label">欲進庫存</label>
            <div class="col-sm-10">
              <input type="text" name="phone" class="form-control" require>
            </div>
          </div>


        
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-warning" value="送出"></input>
              <input name="action" type="hidden" id="action" value="join">
            </div>
          </div>
        </form> 
      </div>
    </div><!-- /.container -->
</body>
</html>