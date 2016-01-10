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
            //找尋帳號是否已經註冊
            $query_RecFindUser = "SELECT * FROM `使用者` WHERE `帳號` ='".$_POST["id"]."'";    
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
          <h1 id="type">會員刪除</h1>
          <hr/>
        </div>
      </div>
      <div class="row">
        <form class="form-horizontal" name="action" method="post" action="database/delect_member.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">帳號</label>
            <div class="col-sm-10">
              <input type="text" name="user" class="form-control" value="<?= $data['帳號'] ?>"  placeholder="帳號" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">密碼</label>
            <div class="col-sm-10">
              <input type="text" name="password" class="form-control"  value="<?= $data['密碼'] ?>"  placeholder="密碼" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control"  value="<?= $data['姓名'] ?>" placeholder="姓名" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">電子郵件</label>
            <div class="col-sm-10">
              <input type="text" name="email" class="form-control"  value="<?= $data['電子郵件'] ?>" placeholder="電子郵件" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">地址</label>
            <div class="col-sm-10">
              <input type="text" name="phone" class="form-control"  value="<?= $data['地址'] ?>" placeholder="地址" readonly>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">電話</label>
            <div class="col-sm-10">
              <input type="text" name="address" class="form-control"  value="<?= $data['電話'] ?>" placeholder="電話" readonly>
            </div>
          </div>
          <div class="form-group">
	          <label class="col-sm-2 control-label">權限</label>
            <div class="col-sm-10">
              <input type="text" name="level" class="form-control"  value="<?= $data['權限'] ?>" placeholder="權限" readonly>
            </div>
 		      </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-danger" value="刪除"></input>
              <input name="action" type="hidden" id="action" value="join">
            </div>
          </div>
        </form> 
      </div>
    </div><!-- /.container -->
</body>
</html>