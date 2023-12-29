
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("./config.php");
    $del = $conn->prepare("SELECT * FROM `users` WHERE `Phone`='".$_GET['q']."' AND `Type`='student'");
    $del->execute();
    $count = $del->rowCount();
    if($count>0){
        echo "<b style='color:red;'>Telefon raqam oldin ro`yhatga olingan!!!</b>";
    }
?>