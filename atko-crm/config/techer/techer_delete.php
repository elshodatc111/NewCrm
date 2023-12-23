
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $GuruhID = $_GET['GuruhID'];
    $sql2 = "UPDATE `guruh` SET `TecherID`='NULL' WHERE `GuruhID`=?";
    $stmt2= $conn->prepare($sql2);
    $stmt2->execute([$GuruhID]);
    header("location: ../../blog/guruh_eye.php?GuruhID=".$GuruhID."");
?>