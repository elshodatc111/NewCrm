<?php
include("../config.php");
    $sql = "SELECT * FROM  users WHERE  DATE_ADD(TKun, INTERVAL YEAR(CURDATE())-YEAR(TKun) + IF(DAYOFYEAR(CURDATE()) > (TKun),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 0 DAY)";
    $res = $conn->query($sql);
    $i=0;
    $Phon = array();
    $Text = "ATKO o'quv markazi jamoasi Sizni tug'ilgan kuningiz bilan tabriklaydi. Barcha yaxshi tilaklarimiz siz uchun.";
    while ($row = $res->fetch()) {
        $phone1 = str_replace(" ","",$row['Phone']);
        array_push($Phon,$phone1);
        $i++;
    }
    $LINK = "https://crm-atko.uz/tugilgan_kunlar.php?send=true";
    $query = [
        'SendMesseg' => true,
        'Url' => $LINK,
        'Phone' => $Phon,
        'Text' => $Text
    ];
    print_r($query);
    header('Location: https://atko.tech/sms/AllSendMessge.php?' . http_build_query($query));
    exit;
?>