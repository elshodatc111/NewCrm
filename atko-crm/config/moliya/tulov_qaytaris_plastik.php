
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $qaytarish_summa = str_replace(",","",$_POST['summa']);
        $izoh = str_replace(",","",$_POST['izoh']);
        $UserID = $_POST['select_box2'];
        $MenegerID = $_COOKIE['UserID'];
        $Type = "Plastik";
        $mavjudPlastik = $_GET['mavjudNaqt'];
        
        if($mavjudPlastik>=$chiqimsumma){
            $sql = "INSERT INTO `moliya_qaytarildi`(`id`, `UserID`, `TulovSumma`, `TulovTuri`, `QaytarishVaqti`, `Meneger`, `Izoh`, `Xisobchi`, `Tasdiqlandi`, `Status`) 
            VALUES (NULL,?,?,?,CURRENT_TIMESTAMP,?,?,'null','null','false')";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$UserID, $qaytarish_summa, $Type, $MenegerID, $izoh]);
            echo "ok";

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,'Chiqim',?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $text = $qaytarish_summa." ".$Type." to`lov talabaga qaytarildi";
            $stmt2->execute([$MenegerID,$text]);

            header("location: ../../moliya.php?tulovqaytarildi=true");
        }else{
            header("location: ../../moliya.php?mavjudemas=true");
        }

        

    }else{
        header("location: ../../login.php");
    }
?>