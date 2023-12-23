
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include_once("../config.php");
    $UserID = $_GET['UserID'];
    $sql = "SELECT * FROM `users` WHERE `UserID`='".$UserID."'";
    $res = $conn->query($sql);
    $row = $res->fetch();
    $Phone = $row['Phone'];
    $phone1 = str_replace(" ","",$row['Phone']);
    $phone = substr($phone1,3);
    $test1 = str_replace("'","`",$_POST['text']);
    $teams = "ATKO o'quv markazi";
    $Text = $test1."\n".$teams;

    $data = json_encode([
        'send'=>'',
        'number'=>$phone,
        'text'=>$Text,
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
	if($smsArray['code']===200){
        echo "SMS yuborildi";
        $Markaz = "ATKO";
        $sql22 = "INSERT INTO `sms`(`id`, `Phone`, `Text`, `Markaz`, `Dates`)
        VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt22= $conn->prepare($sql22);
        $stmt22->execute([$phone, $Text, $Markaz]);

        header("location: ../../blog/tashrif_eye.php?UserID=".$_GET['UserID']."&sendsms=true");
    }else{
        header("location: ../../blog/tashrif_eye.php?UserID=".$_GET['UserID']."&sendPaket=true");
    }
?>