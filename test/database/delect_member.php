<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once 'config.php';     
        if(isset($_POST["action"])&&($_POST["action"]=="join")){
            $query_FindUser = "SELECT * FROM `訂單` WHERE `使用者_帳號`='".$_POST["user"]."'";
            $row_user=mysql_query($query_FindUser);
            echo $row_user;
            if (mysql_num_rows($row_user)>0){
                header("Location: ../member_delect.php?errMsg=1&username=".$_POST["user"]);
            }
        else{
            $query_RecFindUser = "DELETE FROM `使用者` WHERE 帳號='".$_POST["user"]."'";
            $RecFindUser=mysql_query($query_RecFindUser);
            header("Location: ../member_delect.php?loginStats=1");
        }
        }    
        ?>
    </body>
</html>
