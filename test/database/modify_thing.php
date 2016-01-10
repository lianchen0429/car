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
                $id = $_POST['id'];    
                $phone = $_POST['phone']; 
                $query_RecFindUser = "UPDATE `商品` SET `庫存量`=`庫存量`+'".$_POST["phone"]."' WHERE `商品編號`='".$_POST["id"]."'";        
                $RecFindUser=mysql_query($query_RecFindUser);     
                header("Location: ../thing_modify.php?loginStats=1");      
        }     
        ?>
    </body>
</html>

