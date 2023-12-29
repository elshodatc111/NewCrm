
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config.php");
    $UserID = $_GET['UserID'];
    
    $FIO = str_replace("'","`",strtoupper($_POST['FIO'])); 
    $Phone = $_POST['Phone'];

    $sql = "UPDATE `users` SET `FIO`=?,`Phone`=?,`DateUpdate`=CURRENT_TIMESTAMP WHERE `UserID`=?";
    $stmt= $conn->prepare($sql);
    $stmt->execute([$FIO, $Phone, $UserID]);


    header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."");
?>