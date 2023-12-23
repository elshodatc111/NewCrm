
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $pass1 = md5($_POST['pass1']);
        $pass2 = md5($_POST['pass2']);
        $UserID = $_GET['UserID'];
        if($pass1===$pass2){
            $sql1 = "SELECT * FROM `users` JOIN `user_techer` ON users.UserID=user_techer.UserID WHERE users.UserID='".$_GET['UserID']."'";
            $res1 = $conn->query($sql1);
            $row1 = $res1->fetch();
            $FIO = $row1['FIO'];

            $sql = "UPDATE `users` SET `Password`=?,`DateUpdate`=CURRENT_TIMESTAMP WHERE `UserID`=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$pass1, $UserID]);

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $stmt2->execute([$UserID,$_COOKIE['UserID'],"$FIO o`qituvchi paroli yangilandi"]);

            header("location: ../../blog/oqituvchi_eye.php?techpasss=true&UserID=".$UserID."");
        }else{
            header("location: ../../blog/oqituvchi_eye.php?passwordedit=true&UserID=".$UserID."");
        }
    }else{
        header("location: ../../login.php");
    }
?>        