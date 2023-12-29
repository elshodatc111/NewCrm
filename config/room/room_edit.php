

<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $Nomi = str_replace("'","`",strtoupper($_POST['Nomi']));
        $Sigim = $_POST['Sigim'];
        $RoomID =$_GET['RoomID'];
        $UserID = $_COOKIE['UserID'];

        $sql = "UPDATE `rooms` SET `Room`=?,`Sigim`=?,`UpateData`=CURRENT_TIMESTAMP WHERE `RoomID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([ $Nomi, $Sigim, $RoomID ]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $Nomi." Xona malumotlari yangilandi";
        $stmt2->execute([$RoomID, $UserID,$text]);

        header("location: ../../xonalar.php?xonaedit=true");


    }else{
        header("location: ../../login.php");
    }
?>