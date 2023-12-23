
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = strtoupper(str_replace("'","`",$_POST['FIO'])); 
        $Phone = $_POST['Phone'];
        $Tanish = str_replace("'","`",$_POST['Tanish']);
        $TanishPhone = $_POST['TanishPhone'];
        $TKun = $_POST['TKun'];
        $Haqimizda = str_replace("'","`",$_POST['Haqimizda']);
        $TashrifHaqida = str_replace("'","`",$_POST['TashrifHaqida']);
        echo $_POST['TashrifHaqida'];
        $UserID = time();
        
        $sql22 = "SELECT * FROM `users` WHERE `FIO`='".$FIO."' AND `TKun`='".$TKun."' AND `Type`='student'";
        $res22 = $conn->query($sql22);
        $count = $res22->fetchColumn();

        $sql223 = "SELECT * FROM `users` WHERE `Phone`='".$Phone."'";
        $res223 = $conn->query($sql223);
        $count2 = $res223->fetchColumn();
        if($count>0){
            header("location: ../../tashriflar.php?pluserror=true");
        }elseif($count2>0){
            header("location: ../../tashriflar.php?phoneerror=true");
        }else{
            switch ($_POST['Manzil']) {
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

            $sql = "INSERT INTO `users`(`id`, `UserID`, `FIO`, `Phone`, `Manzil`, `TKun`, `Type`, `Username`, `Password`, `DateInsert`, `DateUpdate`) 
            VALUES (NULL,?,?,?,?,?,'student','student','student',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$UserID,$FIO,$Phone,$Manzil,$TKun]);
            
            $sql1 = "INSERT INTO `user_student`(`id`, `UserID`, `Tanish`, `TanishPhone`, `About`, `Haqimizda`) VALUES (NULL,?,?,?,?,?)";
            $stmt1= $conn->prepare($sql1);
            $stmt1->execute([$UserID,$Tanish,$TanishPhone,$TashrifHaqida,$Haqimizda]);

            $sql2 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt2= $conn->prepare($sql2);
            $stmt2->execute([$UserID,$_COOKIE['UserID'],"$FIO yangi talab qo`shildi"]);
            include("../sms/sendMessehe.php");
            
            $phone1 = str_replace(" ","",$Phone);
            $phone = substr($phone1,3);
            $Text = $FIO." ".date("Y")." yil ".date("M-d")." kunida ATKO koreys tili o'quv markazida o'qish uchun ro'yhatga olindi.\nMa'lumot uchun: (91) 950 1101";
            sendMessege2($Text,$phone,$conn);
            header("location: ../../tashriflar.php?teshrifplus=true");
        }


    }else{
        header("location: ../../login.php");
    }
?>