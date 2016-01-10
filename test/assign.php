<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include_once 'database/config.php' ;?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico"> 
    <title>90號 咖啡</title> 
    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </head>
  <body>
    <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
        <script language="javascript">
            alert('會員新增成功\n請用申請的帳號密碼登入。');
            window.location.href='index.php';         
        </script>
    <?php }?>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <script language="javascript">
            alert('帳號已經有人使用請重新輸入！');
            window.location.href='assign.php';         
        </script>
    <?php }?>
    <div class="container">
        <h1 class="form-signin-heading col-md-offset-5">建立帳號</h1>
        <form name="action" method="post" action="database/insert_user.php">
          <div class="col-md-4 col-md-offset-4">
  	        <input type="text" name="user" id="user" class="form-control" placeholder="帳號" required>
         	<br>
            <input type="password" name="password" id="password" class="form-control" placeholder="密碼" required>
            <br>
            <input type="text" name="name" id="name" class="form-control" placeholder="姓名" required >
            <br>
            <input type="text" name="email" id="email" class="form-control" placeholder="電子郵件" required>
            <br>
            <input type="text" name="address" id="address" class="form-control" placeholder="地址" required>
            <br>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="電話" required>
            <br>
            <input type="submit" name="Submit2" class="btn-primary btn-block" value="送出申請">
            <input name="action" type="hidden" id="action" value="join">
          </div>
        </form>  
    </div> <!-- /container -->
  </body>
</html>
