
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = strtoupper($_POST['FIO']);
        $Phone = $_POST['Phone'];
        $Address = $_POST['Address'];
        $TKun = $_POST['TKun'];
        $Mutahasis = $_POST['Mutahasis'];
        $About = $_POST['About'];
        $Login = $_POST['Login'];
        $Parol = md5($_POST['Parol']);
        switch ($Address) {
            case 10207:$Manzil = "G`uzor tumani";break;
            case 10212:$Manzil = "Dexqonobod tumani";break;
            case 10220:$Manzil = "Qamashi tumani";break;
            case 10224:$Manzil = "Qarshi tumani";break;
            case 10229:$Manzil = "Koson tumani";break;
            case 10232:$Manzil = "Kitob tumani";break;
            case 10233:$Manzil = "Mirishkor tumani";break;
            case 10234:$Manzil = "Muborak tumani";break;
            case 10235:$Manzil = "Nishon tumani";break;
            case 10237:$Manzil = "Kasbi tumani";break;
            case 10240:$Manzil = "Ko`kdala tumani";break;
            case 10242:$Manzil = "Chiroqchi tumani";break;
            case 10245:$Manzil = "Shaxrisabz tumani";break;
            case 10246:$Manzil = "Shaxrisabz shahar";break;
            case 10250:$Manzil = "Yakkabog` tumani";break;
            case 10401:$Manzil = "Qarshi shahar";break;
            default:$Manzil = "Boshqa";break;
        }
        $UserID = time();

        $sql1 = "INSERT INTO `users`(`id`, `UserID`, `FIO`, `Phone`, `Manzil`, `TKun`, `Type`, `Username`, `Password`, `DateInsert`, `DateUpdate`)
        VALUES (NULL,?,?,?,?,?,'techer',?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([ $UserID, $FIO, $Phone, $Manzil, $TKun, $Login, $Parol]);

        $sql1 = "INSERT INTO `user_techer`(`id`, `UserID`, `Mutahasilik`, `About`) VALUES (NULL,?,?,?)";
        $stmt1= $conn->prepare($sql1);
        $stmt1->execute([ $UserID, $Mutahasis, $About]);

        $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt2= $conn->prepare($sql2);
        $stmt2->execute([$UserID,$_COOKIE['UserID'],"$FIO yangi o`qituvchi qo`shildi"]);
        header("location: ../../oqituvchi.php?techerplus=true");
    }else{
        header("location: ../../login.php");
    }
?>        