
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = strtoupper($_POST['FIO']);
        $Phone = $_POST['Phone'];
        $Mutahasis = $_POST['Mutahasis'];
        $About = $_POST['About'];
        $UserID = $_GET['UserID'];

        $sql = "UPDATE `users` SET `FIO`=?,`Phone`=?,`DateUpdate`=CURRENT_TIMESTAMP WHERE `UserID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$FIO, $Phone, $UserID]);

        $sql1 = "UPDATE `user_techer` SET `Mutahasilik`=?,`About`=? WHERE `UserID`=?";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([$Mutahasis, $About, $UserID]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"$FIO o`qituvchi malumotlari yangilandi"]);

        header("location: ../../blog/oqituvchi_eye.php?techereye=true&UserID=".$UserID."");
    }else{
        header("location: ../../login.php");
    }
?>        