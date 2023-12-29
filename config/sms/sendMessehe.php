
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    function sendMessege($text,$phone){
        $Markaz = "ATKO";
        $sql = "INSERT INTO `sms`(`id`, `Phone`, `Text`, `Markaz`, `Dates`)
        VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$phone, $text, $Markaz]);
        $data = json_encode([
            'send'=>'',
            'number'=>$phone,
            'text'=>$text,
            'user_id'=>'5139864291',
            'token'=>"emNlVoGxdivUfMjAKYXPIORyDFLkqtSsnEZHarTQuBhbJgp",
            'id'=>'5390'
        ]);
        $url = "https://api.xssh.uz/smsv1/?data=".urlencode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        $smsArray = json_decode($res, true);
        if($smsArray['code']===200){
            return true;
        }else{
            return false;
        }
    }
    function sendMessege2($text,$phone,$conn){
        $Markaz = "ATKO";
        $sql = "INSERT INTO `sms`(`id`, `Phone`, `Text`, `Markaz`, `Dates`)
        VALUES (NULL,?,?,?,CURRENT_TIMESTAMP)";
        $stmt= $conn->prepare($sql);
        $stmt->execute([$phone, $text, $Markaz]);
        $data = json_encode([
            'send'=>'',
            'number'=>$phone,
            'text'=>$text,
            'user_id'=>'5139864291',
            'token'=>"emNlVoGxdivUfMjAKYXPIORyDFLkqtSsnEZHarTQuBhbJgp",
            'id'=>'5390'
        ]);
        $url = "https://api.xssh.uz/smsv1/?data=".urlencode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $res = curl_exec($ch);
        $smsArray = json_decode($res, true);
        if($smsArray['code']===200){
            return true;
        }else{
            return false;
        }
    }
?>