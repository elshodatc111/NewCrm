
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = str_replace("'","`",strtoupper($_POST['FIO'])); 
        $Phone = $_POST['Phone'];
        $Tanish = str_replace("'","`",$_POST['Tanish']);
        $TanishPhone = $_POST['TPhone'];
        $UserID = $_GET['UserID'];

        $sql = "UPDATE `users` SET `FIO`=?,`Phone`=?,`DateUpdate`=CURRENT_TIMESTAMP WHERE `UserID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$FIO, $Phone, $UserID]);

        $sql1 = "UPDATE `user_student` SET `Tanish`=?,`TanishPhone`=? WHERE `UserID`=?";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([$Tanish, $TanishPhone, $UserID]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"Talaba malumotlari yangilandi"]);

        header("location: ../../blog/tashrif_eye.php?UserID=".$_GET['UserID']."&tashrifedit=true");



    }else{
        header("location: ../../login.php");
    }
?>