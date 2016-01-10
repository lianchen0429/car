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
            $query_RecFindUser = "SELECT `商品編號` FROM `商品` WHERE `商品編號`='".$_POST["number"]."'";
            $RecFindUser=mysql_query($query_RecFindUser);
            if (mysql_num_rows($RecFindUser)>0){
                header("Location: ../thing_insert.php?errMsg=1&username=".$_POST["number"]);
            }
            else{
                $upload_dir='../images/';
                $sourcefile=$_FILES['photo']['name'];
                echo'$upload_dir='.$upload_dir;
                if(!is_dir($upload_dir)) mkdir($upload_dir);   
                    if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_dir.$sourcefile)){
                        echo '上傳成功...';
                        echo '<br />原始檔名:' .$_FILES['photo']['name'];
                        echo '<br />檔案類型:' .$_FILES['photo']['type'];
                        echo '<br />檔案大小:' .$_FILES['photo']['size'];
                        echo '<br />暫存檔名:' .$_FILES['photo']['tmp_name'];     
                    }
                else{
                    echo'同名檔案已存在('.$upload_dir . $_FILES['photo']['name'].')<br>';
                }
                $number = $_POST['number'];    
                $category = $_POST['category'];     
                $name = $_POST['name'];
                $price = $_POST['price'];
                $ex = $_POST['ex'];
                $quantity = $_POST['quantity'];          
                $sql = "INSERT INTO `shopcar`.`商品` "
                            . "(`商品編號`, `商品類別_類別編號`, `商品名稱`, `商品單價`, `圖檔名`, `商品說明`, `庫存量`)"
                            . " VALUES ('$number',"."'$category',"."'$name',"."$price,"."'images/".$_FILES['photo']['name']."',"."'$ex',"."$quantity)";
                   // echo "\n".$sql . "\n";
                 $result = mysql_query($sql);

               header("Location: ../thing_insert.php?loginStats=1");
            }
        }     
        ?>
    </body>
</html>
