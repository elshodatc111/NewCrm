
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();

    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $UserID = $_GET['UserID'];// Talaba ID
        $tulovType = $_POST['tulovType']; // Tulov turi
        $summa = str_replace(",","",$_POST['summa']); // Tulov summasi
        $izoh = str_replace("'","`",$_POST['izoh']); // Tulov haqida izoh
        $GuruhID = $_POST['GuruhID'];  //Guruh ID
        $Chegirma = str_replace(",","",$_POST['Chegirma']); // Chegirma summasi
        $MenegerID = $_COOKIE['UserID']; // Meneger ID
        $sqlDay = "SELECT * FROM `guruh_chegirma` WHERE `id`=1";
        $resDay = $conn->query($sqlDay);
        $rowDay = $resDay->fetch();
        $days = date('Y-m-d',strtotime('-'.$rowDay['Days'].' day')); // Chegirma muddati
        $MaxChegirma = $rowDay['Chegirma']; // Maksimal chegirma

        $sqltel = "SELECT * FROM `users` WHERE `UserID`='".$UserID."'";
        $resTel = $conn->query($sqltel);
        $rowTel = $resTel->fetch();
        $FIO = $rowTel['FIO'];
        $Phone = $rowTel['Phone'];
        $phone1 = str_replace(" ","",$rowTel['Phone']);
        $phone = substr($phone1,3);
        $checkID = time();
        $checkData = date("Y-m-d h:i:sa");
        $sqltest = "SELECT * FROM `user_student_tulov` WHERE 
        `UserID`='".$UserID."' AND `TulovType`='".$tulovType."' AND `Izoh`='".$izoh."' 
        AND `MenegerID`='".$MenegerID."' AND `InsertData`='".$checkData."' AND `TulovSumma`='".$summa."'";
        $restest = $conn->query($sqltest);
        $mytest = 0;
        while ($rowtest =$restest->fetch()) {
            $mytest = $mytest+1;
        }
        if($mytest>0){
            echo "Mavjud";
        }else{
            if($GuruhID==='NULL'){
                $GuruhName = $tulovType; //Guruh nomi
                $Typing = "Guruhga_tulov";
                // Talaba tarixiga yozish
                $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP, ?)";
                $stmt2= $conn->prepare($sql2);
                $stmt2->execute([$UserID, $GuruhID,$Typing,$GuruhName,$summa,$Username]);
                // Talaba to'lovlarini yozish
                $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                $stmt3= $conn->prepare($sql3);
                $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                // Talabaga sms yuborish
                include("../sms/sendMessehe.php");
                $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                sendMessege2($Text,$phone,$conn);
                header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=0&tulovplus=true");
            }else{
                $sqla11 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
                $resa11 = $conn->query($sqla11);
                $rowa11=$resa11->fetch();
                $GuruhName = $rowa11['GuruhName']; //Guruh nomi
                $GuruhStart = $rowa11['Start']; // Guruhning boshlanish vaqti
                echo $GuruhStart." ";
                echo $days;
                if($Chegirma==='0'){
                    echo "Nol";
                    $Typing = "Guruhga_tulov";
                    // Talaba tarixiga yozish
                    $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute([$UserID, $GuruhID,$Typing,$tulovType,$summa,$Username]);
                    // Talaba to'lovlarini yozish
                    $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                    $stmt3= $conn->prepare($sql3);
                    $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                    // Talabaga sms yuborish
                    include("../sms/sendMessehe.php");
                    $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                    sendMessege2($Text,$phone,$conn);
                    header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=0&tulovplus=true");
                }elseif($Chegirma>$MaxChegirma){
                    $Typing = "Guruhga_tulov";
                    // Talaba tarixiga yozish
                    $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute([$UserID, $GuruhID,$Typing,$tulovType,$summa,$Username]);
                    // Talaba to'lovlarini yozish
                    $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                    $stmt3= $conn->prepare($sql3);
                    $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                    // Talabaga sms yuborish
                    include("../sms/sendMessehe.php");
                    $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                    sendMessege2($Text,$phone,$conn);
                    header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=0&tulovguruhchegirmakattaplus=true");
                }elseif($GuruhStart>=$days){
                    echo "ok";
                    $Typing = "Guruhga_tulov";
                    $Typing2 = "Guruhga_Chegirma";

                    $sqln = "SELECT * FROM `user_student_history` WHERE `UserID`='".$UserID."' AND `GuruhID`='".$GuruhID."' AND `Type` ='".$Typing2."'";
                    $resn = $conn->query($sqln);
                    $count = $resn->fetchColumn();
                    if($count>0){
                        $Typing = "Guruhga_tulov";
                        // Talaba tarixiga yozish
                        $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                        $stmt2= $conn->prepare($sql2);
                        $stmt2->execute([$UserID, $GuruhID,$Typing,$tulovType,$summa,$Username]);
                        // Talaba to'lovlarini yozish
                        $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                        $stmt3= $conn->prepare($sql3);
                        $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                        // Talabaga sms yuborish
                        include("../sms/sendMessehe.php");
                        $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                        sendMessege2($Text,$phone,$conn);
                        header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=0&chegirmaminus=true");
                    }else{
                        // Talaba tarixiga yozish
                        $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                        $stmt2= $conn->prepare($sql2);
                        $stmt2->execute([$UserID, $GuruhID,$Typing,$tulovType,$summa,$Username]);
                        $sql223 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                        $stmt223= $conn->prepare($sql223);
                        $stmt223->execute([$UserID, $GuruhID,$Typing2,$GuruhName,$Chegirma,$Username]);
                        // Talaba to'lovlarini yozish
                        $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                        VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                        $stmt3= $conn->prepare($sql3);
                        $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                        $sql322233 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                        VALUES (NULL,?,'Chegirma',?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                        $stmt322233= $conn->prepare($sql322233);
                        $stmt322233->execute([$UserID,$Chegirma,$izoh,$MenegerID]);
                        // Talabaga sms yuborish
                        include("../sms/sendMessehe.php");
                        $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov va ".$Chegirma." so'm chegirma qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                        sendMessege2($Text,$phone,$conn);
                        header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=".$Chegirma."&tulovchegirmaplus=true");
                    }
                }else{
                    $Typing = "Guruhga_tulov";
                    // Talaba tarixiga yozish
                    $sql2 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                    $stmt2= $conn->prepare($sql2);
                    $stmt2->execute([$UserID, $GuruhID,$Typing,$tulovType,$summa,$Username]);
                    // Talaba to'lovlarini yozish
                    $sql3 = "INSERT INTO `user_student_tulov`(`id`, `UserID`, `TulovType`, `TulovSumma`, `Izoh`, `MenegerID`, `InsertData`, `UpateData`) 
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
                    $stmt3= $conn->prepare($sql3);
                    $stmt3->execute([$UserID, $tulovType,$summa,$izoh,$MenegerID]);
                    // Talabaga sms yuborish
                    include("../sms/sendMessehe.php");
                    $Text = $FIO." \nHisobingizga ".$summa." so'm to'lov qabul qilindi. ATKO koreys tili markazi \n(91) 950 1101";
                    sendMessege2($Text,$phone,$conn);
                    header("location: ../../blog/tashrif_eye.php?UserID=".$UserID."&pay=true&checkID=".$checkID."&checkData=".$checkData."&type=".$tulovType."&summa=".$summa."&chegirma=0&tulovguruhchegirmaplus=true");
                }
            }
            echo "ddd";
        }
    }else{
        header("location: ../../login.php");
    }
?>