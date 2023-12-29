
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $id = $_GET['id'];
        $MenegerID = $_COOKIE['UserID'];;

            $sql = "UPDATE `moliya` SET `TasdiqMeneger`=?,`TasdiqData`=CURRENT_TIMESTAMP,`Status`='true' WHERE `id`=?";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$MenegerID, $id]);

            $sql4 = "SELECT * FROM `moliya` WHERE `id`='".$id."'";
            $res4 = $conn->query($sql4);
            $row4 = $res4->fetch();
            $TulovType = $row4['Type'];
            $TulovSumma = $row4['Summa'];
            $Typing = $row4['Typing'];
            $Izoh = $row4['ChiqimIzoh'];

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,'Chiqim',?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $text = "id=".$id." chiqim yoki xarajatni tasdiqladi";
            $stmt2->execute([$MenegerID,$text]);

            if($Typing==='Chiqim'){
                $Status = "Kassadan_Chiqim";
                $sql3 = "INSERT INTO `user_admin_history`(`id`, `Status`, `Type`, `Summa`,`Izoh`, `Data`)
                VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
                $stmt3= $conn->prepare($sql3);
                $stmt3->execute([$Status,$TulovType,$TulovSumma,$Izoh]);
            }
            

            header("location: ../../moliya.php?chiqimtasdiq=true");

    }else{
        header("location: ../../login.php");
    }
?>