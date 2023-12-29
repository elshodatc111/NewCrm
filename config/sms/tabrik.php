
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
include("../config.php");
include("./sendMessehe.php");
    $sql = "SELECT * FROM  users WHERE  DATE_ADD(TKun, INTERVAL YEAR(CURDATE())-YEAR(TKun) + IF(DAYOFYEAR(CURDATE()) > (TKun),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 0 DAY)";
    $res = $conn->query($sql);
    $i=0;
    $Phon = array();
    $Text = "ATKO o'quv markazi jamoasi Sizni tug'ilgan kuningiz bilan tabriklaydi. Barcha yaxshi tilaklarimiz siz uchun.";
    while ($row = $res->fetch()) {
        $phone1 = str_replace(" ","",$row['Phone']);
        $phone = (string)substr($phone1,3);
        array_push($Phon,$phone);
        $i++;
    }
    for ($j=0; $j < $i; $j++) { 
        sendMessege2($Text,$Phon[$j],$conn);
    }
    header("location: ../../tugilgan_kunlar.php?send=true");
?>