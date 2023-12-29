
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
            $MenegerID = $_COOKIE['UserID'];
            
            $sql = "DELETE FROM `moliya_qaytarildi` WHERE `id`=?";
            $stmt= $conn->prepare($sql);
            $id = $_GET['id'];
            $stmt->execute([$id]);
            

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,'Chiqim',?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $text = " Talabaga qaytaradigan summani bekor qildi";
            $stmt2->execute([$MenegerID,$text]);

            header("location: ../../moliya.php?qaytardel=true");
        
    }else{
        header("location: ../../login.php");
    }
?>