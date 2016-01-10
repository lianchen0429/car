<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'config.php';
        if(isset($_POST["action"])&&($_POST["action"]=="join")){
            $query_RecFindUser = "SELECT `帳號` FROM `使用者` WHERE `帳號`='".$_POST["user"]."'";
            $RecFindUser=mysql_query($query_RecFindUser);
            if (mysql_num_rows($RecFindUser)>0){
                header("Location: ../assign.php?errMsg=1&username=".$_POST["user"]);
            }
            else{
                $user = $_POST['user'];    
                $password = $_POST['password'];     
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $level = '一般會員';          
                $sql = "INSERT INTO `shopcar`.`使用者` "
                            . "(`帳號`, `密碼`, `姓名`, `電子郵件`, `地址`, `電話`, `權限`)"
                            . " VALUES ('$user',"."'$password',"."'$name',"."'$email',"."'$address',"."'$phone',"."'$level')";
                   // echo "\n".$sql . "\n";
                 $result = mysql_query($sql);
                header("Location: ../assign.php?loginStats=1");
            }
        }     
        ?>
    </body>
</html>
