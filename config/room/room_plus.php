
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $Nomi = str_replace("'","`",strtoupper($_POST['Nomi']));
        $Sigim = $_POST['Sigim'];
        $RoomID = time();
        $UserID = $_COOKIE['UserID'];

        $sql = "INSERT INTO `rooms`(`id`, `RoomID`, `Room`, `Sigim`, `MenegerID`, `InsertData`, `UpateData`) 
        VALUES (NULL,?,?,?,?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([ $RoomID, $Nomi, $Sigim, $UserID ]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $Nomi." Yangi xona qo'shildi";
        $stmt2->execute([$RoomID, $UserID,$text]);

        header("location: ../../xonalar.php?xonaplus=true");


    }else{
        header("location: ../../login.php");
    }
?>