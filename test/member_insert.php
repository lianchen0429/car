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
  <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
        <script language="javascript">
            alert('會員新增成功。');
            window.location.href='member_insert.php';         
        </script>
    <?php }?>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <script language="javascript">
            alert('帳號已經有人使用請重新輸入！');
            window.location.href='member_insert.php';         
        </script>
    <?php }?>
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 id="type">會員註冊</h1>
          <hr/>
        </div>
      </div>
      <div class="row">
        <form class="form-horizontal" name="action" method="post" action="database/insert_member.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">帳號</label>
            <div class="col-sm-10">
              <input type="text" name="user" class="form-control"  placeholder="帳號" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">密碼</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control"  placeholder="密碼" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" placeholder="姓名" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">電子郵件</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control" placeholder="電子郵件" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">地址</label>
            <div class="col-sm-10">
              <input type="text" name="phone" class="form-control" placeholder="地址" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">電話</label>
            <div class="col-sm-10">
              <input type="text" name="address" class="form-control" placeholder="電話" required>
            </div>
          </div>
          <div class="form-group">
	          <label class="col-sm-2 control-label">權限</label>
	          	<div class="col-md-1">
				        <select class="selectpicker" name="level" >
		            	<option>一般會員</option>
		              <option>管理者</option>
		            </select>
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