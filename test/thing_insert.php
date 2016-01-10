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
    $member = "SELECT * FROM `商品類別` WHERE 1";
    $total_member = mysql_query($member);
	?>
  <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
        <script language="javascript">
            alert('商品註冊成功。');
            window.location.href='thing_insert.php';         
        </script>
  <?php }?>
  <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <script language="javascript">
            alert('商品編號已經有註冊過，請重新註冊！');
            window.location.href='thing_insert.php';         
        </script>
  <?php }?>
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 id="type">商品新增</h1>
          <hr/>
        </div>
      </div>
      <div class="row">
        <form class="form-horizontal" name="action" method="post" enctype="multipart/form-data" action="database/insert_thing.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">圖檔名</label>
            <div class="col-sm-10">
              <input type="file" name="photo" value="boots6.jpg">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">商品類別</label>
              <div class="col-sm-10">
                <select id="selectpicker" class="selectpicker" name="category">
               <?php
                  while($row_member=mysql_fetch_assoc($total_member)){ 
                ?>
                  <option><?php echo $row_member["類別編號"];?></option>
                <?php } ?>
                </select>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">商品編號</label>
            <div class="col-sm-10">
              <input type="text" name="number" class="form-control"  placeholder="編號" required>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label">商品名稱</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" placeholder="名稱" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">商品單價</label>
            <div class="col-sm-10">
              <input type="text" name="price" class="form-control" placeholder="單價" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">商品說明</label>
            <div class="col-sm-10">
              <input type="text" name="ex" class="form-control" placeholder="說明" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">庫存量</label>
            <div class="col-sm-10">
              <input type="text" name="quantity" class="form-control" placeholder="庫存" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-default" value="送出"></input>
              <input name="action" type="hidden" id="action" value="join">
            </div>
          </div>
        </form> 
      </div>
    </div><!-- /.container -->
</body>
</html>