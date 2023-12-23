
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $Izoh = str_replace("'","`",$_POST['Izoh']);
        $UserID = $_POST['UserID'];
        $GuruhID = $_GET['GuruhID'];
        $MenegerID = $_COOKIE['UserID'];
        $qautarilgan = str_replace(",","",$_POST['qautarilgan']);

        $sql3 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $res3 = $conn->query($sql3);
        $row3 = $res3->fetch();
        $GuruhName = $row3['GuruhName'];
        $Guruhga = $row3['GuruhSumma']-$qautarilgan;
        $Talabaga = $row3['GuruhSumma'];
        if($Guruhga>0){
            echo "Talabaga qaytariladi: ".$Talabaga."<br>"; // Talaba balansiga
            echo "Talabaga jarima: ".$Guruhga."<br>";   // Talabaga jarima
            echo "Guruh ID: ".$GuruhID."<br>";
            echo "UserID ID: ".$UserID."<br>";
            echo "Meneger ID: ".$MenegerID."<br>";
            
            $sql0 = "UPDATE `guruh_plus` SET `End`=CURRENT_TIMESTAMP,`EndIzoh`=?,`EndMenegerID`=?,`Status`='false' WHERE `GuruhID`=? AND `UserID`=?";
            $stmt0= $conn->prepare($sql0);
            $stmt0->execute([$Izoh,$MenegerID,$GuruhID,$UserID]);
            echo "Guruhdan o'chirildi";

            $Typing = "Guruhga_jarima";
            $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
            VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
            $stmt33= $conn->prepare($sql33);
            $stmt33->execute([$UserID,$GuruhID,$Typing,$GuruhName,$Guruhga,$Username]);

            $Typing2 = "Guruh_talabaga";
            $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
            VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
            $stmt33= $conn->prepare($sql33);
            $stmt33->execute([$UserID,$GuruhID,$Typing2,$GuruhName,$Talabaga,$Username]);

            $sql1 = "INSERT INTO `guruh_user_del`(`id`, `GuruhID`, `GuruhSumma`, `UserID`, `UserSumma`, `Dates`)
            VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
            $stmt1= $conn->prepare($sql1);
            $stmt1->execute([$GuruhID,$Guruhga,$UserID,$Talabaga]);

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $stmt2->execute([$UserID,$_COOKIE['UserID']," Guruhdan talaba o`chirildi"]);

            header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&guruhdeltalaba=true");
        }elseif($Guruhga===0){
                echo "Talabaga qaytariladi: ".$Talabaga."<br>";
                echo "Talabaga jarima: ".$Guruhga."<br>";
                echo "Guruh ID: ".$GuruhID."<br>";
                echo "UserID ID: ".$UserID."<br>";
                echo "Meneger IDsss: ".$MenegerID."<br>";
                
                $sql0 = "UPDATE `guruh_plus` SET `End`=CURRENT_TIMESTAMP,`EndIzoh`=?,`EndMenegerID`=?,`Status`='false' WHERE `GuruhID`=? AND `UserID`=?";
                $stmt0= $conn->prepare($sql0);
                $stmt0->execute([$Izoh,$MenegerID,$GuruhID,$UserID]);
                echo "Guruhdan o'chirildi";
    
                $Typing2 = "Guruh_talabaga";
                $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                $stmt33= $conn->prepare($sql33);
                $stmt33->execute([$UserID,$GuruhID,$Typing2,$GuruhName,$Talabaga,$Username]);

                $sql1 = "INSERT INTO `guruh_user_del`(`id`, `GuruhID`, `GuruhSumma`, `UserID`, `UserSumma`, `Dates`)
                VALUES (NULL,?,?,?,?,CURRENT_TIMESTAMP)";
                $stmt1= $conn->prepare($sql1);
                $stmt1->execute([$GuruhID,$Guruhga,$UserID,$Talabaga]);
                $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
                $stmt2= $conn->prepare($sql2);
                $stmt2->execute([$UserID,$_COOKIE['UserID']," Guruhdan talaba o`chirildi"]);
    
                header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&guruhdeltalaba=true");
            
        }else{
            header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&guruhdeltalabaerror=true");
        }
    }else{
        header("location: ../../login.php");
    }
?>