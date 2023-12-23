
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $chiqimsumma = str_replace(",","",$_POST['Summa']);
        $chiqimizoh = str_replace(",","",$_POST['Izoh']);
        $MenegerID = $_COOKIE['UserID'];
        $Type = "Plastik";
        $mavjud = $_GET['mavjudPlastik'];

        if($mavjud>=$chiqimsumma){
            $sql = "INSERT INTO `moliya`(`id`, `Typing`, `Summa`, `Type`, `ChiqimIzoh`, `ChiqimMeneger`, `ChiqimData`, `TasdiqMeneger`, `TasdiqData`, `Status`)
            VALUES (NULL,'Xarajat',?,?,?,?,CURRENT_TIMESTAMP,'NULL','NULL','false')";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$chiqimsumma, $Type, $chiqimizoh, $MenegerID]);
            echo "ok";

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,'Chiqim',?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $text = $chiqimsumma." ".$Type." Summa xarajat uchun tasdiqlanish kutilmoqda";
            $stmt2->execute([$MenegerID,$text]);

            header("location: ../../moliya.php?xarajadplusss=true");
        }else{
            header("location: ../../moliya.php?mavjudemas=true");
        }

        

    }else{
        header("location: ../../login.php");
    }
?>