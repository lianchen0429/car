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
                $user = $_POST['user'];    
                $password = $_POST['password'];     
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $level = $_POST['level'];  
                $query_RecFindUser = " UPDATE `使用者` SET `帳號`='$user',`密碼`='$password',`姓名`='$name',`電子郵件`='$email',`地址`='$address',`電話`='$phone',`權限`='$level' WHERE `帳號`='".$_POST["user"]."'";
                $RecFindUser=mysql_query($query_RecFindUser);     
                header("Location: ../member_modify.php?loginStats=1");      
        }     
        ?>
    </body>
</html>
