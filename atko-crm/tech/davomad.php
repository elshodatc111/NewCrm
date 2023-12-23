
<?php 
    date_default_timezone_set("Asia/Samarkand");
?><?php
    include("../config/config.php");

function sendMessehe($phone2,$text){
    $data = json_encode([
        'send'=>'',
        'number'=>$phone2,
        'text'=>$text,
        'user_id'=>'5139864291',
        'token'=>"nHdJaBfmAibyGoSeLFvYgxEVljspuOhQXRqPZtMNkTKIrUD",
        'id'=>'5390'
    ]);

    $url = "https://api.xssh.uz/smsv1/?data=".urlencode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    $res = curl_exec($ch);
    $smsArray = json_decode($res, true);
    echo "SMS yuborildi";
}

    if(isset($_POST['davomatplus'])){
        $GuruhID = $_GET['GuruhID'];
        $Data = date("Y-m-d");

        $sql = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$GuruhID."' AND `Status`='true'";
        $res = $conn->query($sql);
        while ($row = $res->fetch()) {
            $sql2 = "SELECT * FROM `users` JOIN `user_student` ON users.UserID=user_student.UserID WHERE users.UserID='".$row['UserID']."'";
            $res2 = $conn->query($sql2);
            $row2 = $res2->fetch();
            $FIO = $row2['FIO'];
            
            $Phone2 = $row2['TanishPhone'];
            $phone12 = str_replace(" ","",$Phone2);
            $phone2 = substr($phone12,3);
            #$phone2 = "908830450";

            $sql3 = "SELECT * FROM `guruh` WHERE `GuruhID`='".$GuruhID."'";
            $res3 = $conn->query($sql3);
            $row3 = $res3->fetch();
            $text = $FIO." Bugun(".date("Y-m-d ").") ".$row3['GuruhName']." guruh dars mashg'ulotlariga qatnashmadi.\n ATKO o'quv markazi mamuriyati";
            
            if(isset($_POST[$row['UserID']])){
                $sql1 = "INSERT INTO `guruh_davomad`(`id`, `UserID`, `GuruhID`, `Date`) VALUES (NULL,?,?,?)";
                $stmt= $conn->prepare($sql1);
                $stmt->execute([$row['UserID'],$GuruhID,$Data]);
                echo "Qatnashgan";
            }else{
                #sendMessehe($phone2,$text);
            }
            
        }
        header("Location: ./guruh_eye.php?davomadPlus=true&GuruhID=".$_GET['GuruhID']."");
    }
?>