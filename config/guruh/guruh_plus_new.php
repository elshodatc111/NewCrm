
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $stmt = $conn->query("SELECT * FROM `users` WHERE `UserID`='".$_COOKIE['UserID']."'");
    $user = $stmt->fetch();
    $Username = $user['Username'];
    if(isset($_COOKIE['UserID'])){
        $Meneger = $_COOKIE['UserID'];
        $GuruhID = $_GET['GuruhID'];
        $GuruhNomi = strtoupper(str_replace("'","`",$_POST['GuruhNomi']));
        $GuruhSumma = str_replace(",","",$_POST['GuruhSumma']);
        $TechTulov = str_replace(",","",$_POST['TechTulov']);
        $TechBonus = str_replace(",","",$_POST['TechBonus']);
        $Start = $_POST['Start'];
        $End = $_POST['End'];
        $NewGuruhID = time();
        $RoomID = $_POST['RoomID'];
        $sql = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
        $res = $conn->query($sql);
        $rowm = $res->fetch();
        $Dushanba = $rowm['Dushanba'];
        $Seshanba = $rowm['Seshanba'];
        $Chorshanba = $rowm['Chorshanba'];
        $Payshanba = $rowm['Payshanba'];
        $Juma = $rowm['Juma'];
        $Shanba = $rowm['Shanba'];

        function history($conn,$text,$UserID){
            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $Meneger = $_COOKIE['UserID'];
            $stmt2->execute([$UserID, $Meneger,$text]);
            echo $text." Istoriya yozildi<br>";
        }
        #Yangi guruh ochilgandan kiyingi davomi
        $sqlNew = "INSERT INTO `guruh_end`(`id`, `GuruhID`, `NewGuruh`, `Status`) VALUES (NULL,?,?,'true')";
        $stmtNew= $conn->prepare($sqlNew);
        $stmtNew->execute([$GuruhID,$NewGuruhID]);
        #Yangi guruh ochish
        $sqlgp = "INSERT INTO `guruh`(`id`, `GuruhID`, `GuruhName`, `GuruhSumma`, `TecherID`, `TechTulov`, `TechBonus`, `Start`, `End`, `RoomID`, `Dushanba`, `Seshanba`, `Chorshanba`, `Payshanba`, `Juma`, `Shanba`, `Meneger`, `InsertData`, `UpdateData`)
        VALUES (NULL,?,?,?,'NULL',?,?,?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmtgp= $conn->prepare($sqlgp);
        $stmtgp->execute([$NewGuruhID, $GuruhNomi, $GuruhSumma, $TechTulov, $TechBonus, $Start, $End, $RoomID, $Dushanba, $Seshanba, $Chorshanba, $Payshanba, $Juma, $Shanba, $Meneger]);
        echo "Yangi guruh ochildi<br>";
        #Yangi guruh tarixga yozildi
        history($conn,'Yangi guruh ochildi',$NewGuruhID);

        $sqlt = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$GuruhID."' AND `Status`='true'";
        $rest = $conn->query($sqlt);
        while ($rowt = $rest->fetch()) {
            $rowt = $rowt['UserID'];
            if(isset($rowt)){
                if(isset($_POST[$rowt])){
                    #Talaba yangi guruhga qo'shiladi
                    $sqltp = "INSERT INTO `guruh_plus`(`id`, `GuruhID`, `UserID`, `Start`, `StartIzoh`, `StartMenegerID`, `End`, `EndIzoh`, `EndMenegerID`, `Status`)
                    VALUES (NULL,?,?,CURRENT_TIMESTAMP,?,?,'NULL','NULL','NULL','true')";
                    $stmttp= $conn->prepare($sqltp);
                    $text = "Talaba Yangi guruhga qo'shildi";
                    $stmttp->execute([$NewGuruhID, $rowt,$text,$Meneger]);
                    $Typing = "Guruhga_qoshildi";
                    $sql33 = "INSERT INTO `user_student_history`(`id`, `UserID`, `GuruhID`, `Type`, `Status`, `Summa`, `Data`, `Meneger`)
                    VALUES (NULL,?,?,?,?,?,CURRENT_TIMESTAMP,?)";
                    $stmt33= $conn->prepare($sql33);
                    $stmt33->execute([$rowt,$NewGuruhID,$Typing,$GuruhNomi,$GuruhSumma,$Username]);
                    history($conn,'Yangi guruhga qo`shildi',$rowt);
                    echo $rowt;
                }
            }
        }
        header("location: ../../guruhlar.php?newguruhplus=true");
    }else{
        header("location: ../../login.php");
    }

?>