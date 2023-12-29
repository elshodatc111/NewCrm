
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $GuruhNomi = strtoupper($_GET['GuruhName']);
        $GuruhID = $_GET['GuruhID'];
        $Meneger = $_COOKIE['UserID'];
        $TecherID = $_POST['UserID'];


        $sql = "UPDATE `guruh` SET `TecherID`=?,`UpdateData`=CURRENT_TIMESTAMP WHERE `GuruhID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$TecherID, $GuruhID]);
        
        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $GuruhNomi." Guruhga o`qituvchi qo`shildi";
        $stmt2->execute([$GuruhID, $Meneger,$text]);

        header("location: ../../blog/guruh_eye.php?GuruhID=".$GuruhID."&techerplus=true");

    }else{
        header("location: ../../login.php");
    }

?>