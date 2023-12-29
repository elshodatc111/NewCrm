
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config/config.php");
    if(isset($_COOKIE['UserID'])){
        $FIO = strtoupper(str_replace("'","`",$_POST['FIO']));
        $Phone = str_replace("'","`",$_POST['Phone']);
        $Address = str_replace("'","`",$_POST['Address']);
        $TKun = str_replace("'","`",$_POST['TKun']);
        $lovozim = str_replace("'","`",$_POST['lovozim']);
        if(isset($_POST['insert'])){$insert = str_replace("'","`",$_POST['insert']);}
        else{ $insert = 'off';}
        if(isset($_POST['edit'])){$edit = str_replace("'","`",$_POST['edit']);}
        else{ $edit = 'off';}
        if(isset($_POST['delete'])){$delete = str_replace("'","`",$_POST['delete']);}
        else{ $delete = 'off';}
        $username = str_replace("'","`",$_POST['username']);
        $parol = md5($_POST['parol']);
        $UserID = time();
        switch ($_POST['Address']) {
            case 10207:$Address = "G`uzor tumani";break;
            case 10212:$Address = "Dexqonobod tumani";break;
            case 10220:$Address = "Qamashi tumani";break;
            case 10224:$Address = "Qarshi tumani";break;
            case 10229:$Address = "Koson tumani";break;
            case 10232:$Address = "Kitob tumani";break;
            case 10233:$Address = "Mirishkor tumani";break;
            case 10234:$Address = "Muborak tumani";break;
            case 10235:$Address = "Nishon tumani";break;
            case 10237:$Address = "Kasbi tumani";break;
            case 10240:$Address = "Ko`kdala tumani";break;
            case 10242:$Address = "Chiroqchi tumani";break;
            case 10245:$Address = "Shaxrisabz tumani";break;
            case 10246:$Address = "Shaxrisabz shahar";break;
            case 10250:$Address = "Yakkabog` tumani";break;
            case 10401:$Address = "Qarshi shahar";break;
            default:$Address = "Boshqa";break;
        }
        $sql = "SELECT * FROM `users` WHERE `Username`='".$username."'";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if($count>0){
            header("location: ../hodimlar.php?loginError=true");
        }else{
            $sql = "INSERT INTO `users`(`id`, `UserID`, `FIO`, `Phone`, `Manzil`, `TKun`, `Type`, `Username`, `Password`, `DateInsert`, `DateUpdate`) VALUES (NULL,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP)";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$UserID,$FIO,$Phone,$Address,$TKun,$lovozim,$username,$parol]);

            $sql2 = "INSERT INTO `user_admin`(`id`, `UserID`, `Plus`, `Edit`, `Trash`) VALUES (NULL,?,?,?,?)";
            $stmt2= $conn->prepare($sql2);
            $stmt2->execute([$UserID,$insert,$edit,$delete]);

            $sql3 = "INSERT INTO `user_history`(`id`, `UserID`, `AdminID`, `Izoh`, `Data`) VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
            $stmt3= $conn->prepare($sql3);
            $stmt3->execute([$UserID,$_COOKIE['UserID'],"$FIO $lovozim kiritildi"]);

            header("location: ../hodimlar.php?newLogin=true");
        }
    }else{
        header("location: ../login.php");
    }
?>