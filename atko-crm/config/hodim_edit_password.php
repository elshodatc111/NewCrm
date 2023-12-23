
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $Password = md5($_POST['password']);
        $UserID = $_GET['UserID'];

        $sql3 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt3= $conn->prepare($sql3);
        $stmt3->execute([$UserID,$_COOKIE['UserID'],"Parolini almashtirdi"]);

        $sql = "UPDATE `users` SET `Password`=? WHERE `UserID`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$Password, $UserID]);

        header("location: ../blog/hodim_eye.php?UserID=".$UserID."&editpassword=true");

    }else{
        header("location: ../login.php");
    }
?>