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
            $query_FindUser = "SELECT * FROM `訂單明細` WHERE `商品_商品編號`='".$_POST["id"]."'";
            $row_user=mysql_query($query_FindUser);
            echo $row_user;
            if (mysql_num_rows($row_user)>0){
                header("Location: ../thing_delect.php?errMsg=1&username=".$_POST["id"]);
            }
        else{
            $query_RecFindUser = "DELETE FROM `商品` WHERE 商品編號='".$_POST["id"]."'";
            $RecFindUser=mysql_query($query_RecFindUser);
            header("Location: ../thing_delect.php?loginStats=1");
            }
        }    
        ?>
    </body>
</html>
