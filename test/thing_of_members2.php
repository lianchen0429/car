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
      $id = $_POST["id"];
			$sql = "SELECT * FROM `訂單` WHERE `使用者_帳號` = '".$_POST["id"]."'";
      $result = mysql_query($sql) or die('MySQL query error');
	?>
	<div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 id="type">訂單查詢</h1>
          <hr/>
        </div>
      </div>
      <div class="row">
        <form class="form-horizontal" name="action" method="post" action="thing_of_members3.php">
          <div class="form-group">
            <label class="col-sm-2 control-label">選擇訂單</label>
            <div class="col-sm-10">
              <select id="selectpicker" class="selectpicker" name="id">
              <?php
                while($row_member=mysql_fetch_assoc($result)){ 
              ?>
                <option><?php echo $row_member["訂單編號"];?></option>
		      <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-default" value="送出"></input>
            </div>
          </div>
        </form> 
      </div>
    </div>
</body>
</html>