<?php
    include("../config.php");
    include("../sms/sendMessehe.php");
    $GuruhID = $_GET['GuruhID'];
    $Text = $_POST['text'];
    $sql = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$GuruhID."' AND `Status`='true'";
    $Phone = array();
    $res = $conn->query($sql);
    $k=0;
    while ($row=$res->fetch()) {
        if(isset($_POST[$row['UserID']])){
            $UserID = $row['UserID'];
            $sql1 = "SELECT * FROM `users` WHERE `UserID`='".$UserID."'";
            $res1 = $conn->query($sql1);
            $row1 = $res1->fetch();
            $phone1 = str_replace(" ","",$row1['Phone']);
            array_push($Phone,$phone1);
            $k++;
        }
    }
    $LINK = "https://crm-atko.uz/blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&sendMesseg=true";
    $query = [
        'SendMesseg' => true,
        'Url' => $LINK,
        'Phone' => $Phone,
        'Text' => $Text
    ];
    print_r($query);
    header('Location: https://atko.tech/sms/AllSendMessge.php?' . http_build_query($query));
    exit;
?>