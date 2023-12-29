
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $id = $_GET['id'];
        $XisobchiID = $_COOKIE['UserID'];
        $sql1 = "SELECT * FROM `moliya_qaytarildi` WHERE `id`='".$id."'";
        $res1 = $conn->query($sql1);
        $row1 = $res1->fetch();
        $UserID = $row1['UserID'];
        $TulovTuri = "Qaytarildi";
        $TulovSumma = $row1['TulovSumma'];
        $Izoh = $row1['Izoh'];
        $MenegerID = $row1['Meneger'];
        $GuruhName = "To'lov qaytarildi";
        $GuruhID = "NULL";
        $Typing2 = "Tulov_Qaytarildi";
        $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`)
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP)";
        $stmt33= $conn->prepare($sql33);
        $stmt33->execute([$UserID,$GuruhID,$Typing2,$GuruhName,$TulovSumma]);

        $sql = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`)
        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$UserID, $TulovTuri, $TulovSumma, $Izoh,$MenegerID]);
        echo "ok";

        $sql = "UPDATE `moliya_qaytarildi` SET `Xisobchi`=?,`Tasdiqlandi`=CURRENT_TIMESTAMP,`Status`='true' WHERE `id`=?";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$XisobchiID, $id]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,'Chiqim',?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $text = $chiqimsumma." ".$Type." Summa tasdiqlash uchun chiqim qilindi";
        $stmt2->execute([$MenegerID,$text]);

        header("location: ../../moliya.php?qaytarishtasdiqlandi=true");
        
        

    }else{
        header("location: ../../login.php");
    }
?>