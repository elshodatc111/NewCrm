
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("./config.php");
    $FIO = strtoupper($_GET['q']);
    $del = $conn->prepare("SELECT * FROM `users` WHERE `Phone`='".$FIO."' AND `Type`='student'");
    $del->execute();
    $count = $del->rowCount();
    if($count>0){
        echo "<b style='color:red;'>Bu talaba oldin ro`yhatdan o`tgan!!!</b>";
    }
?>