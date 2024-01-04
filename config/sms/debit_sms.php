
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../config.php");
    include("../sms/sendMessehe.php");
    $sql1 = "SELECT * FROM `guruh_plus` WHERE `GuruhID`='".$_GET['GuruhID']."' AND `Status`='true'";
    $res1 = $conn->query($sql1);
    $i=0;
    $Phones = array();
    $Tests = array();
    while ($row1 = $res1->fetch()) {
        $GuruhSumma = 0;
        $sql2 = "SELECT guruh.GuruhSumma FROM `guruh_plus` JOIN `guruh` ON guruh_plus.GuruhID=guruh.GuruhID WHERE guruh_plus.Status='true' AND guruh_plus.UserID='".$row1['UserID']."'";
        $res2 = $conn->query($sql2);
        while ($row2 = $res2->fetch()) {
            $GuruhSumma = $GuruhSumma + $row2['GuruhSumma'];
        }
        $sql2 = "SELECT * FROM `user_student_tulov` WHERE `UserID`='".$row1['UserID']."'";
        $res2 = $conn->query($sql2);
        $tulovlar = 0;
        while ($row2=$res2->fetch()) {
            if($row2['TulovType']==='Plastik'){
                $tulovlar = $tulovlar + $row2['TulovSumma'];
            }elseif($row2['TulovType']==='Naqt'){
                $tulovlar = $tulovlar + $row2['TulovSumma'];
            }elseif($row2['TulovType']==='Qaytarildi'){
                $tulovlar = $tulovlar - $row2['TulovSumma'];
            }elseif($row2['TulovType']==='Chegirma'){
                $tulovlar = $tulovlar + $row2['TulovSumma'];
            }
        }
        $qarz = $tulovlar-$GuruhSumma;
        if($qarz<0){
            $qarz2 = 0-$qarz;
            $sql3 = "SELECT * FROM `users` WHERE `UserID`='".$row1['UserID']."'";
            $res3 = $conn->query($sql3);
            $row3 = $res3->fetch();
            
            $phone1 = str_replace(" ","",$row3['Phone']);
            array_push($Phones,$phone1);
            $Text = $row3['FIO']." ATKO koreys tili o'quv markazi kurslaridan ".date("Y-m-d")." holatida ".number_format($qarz2, 0, '.', ' ')." so'm qarzdorligingiz mavjud. Sizdan mavjud qarzdorlikni so'ndirishni so'raymiz. (91) 950 1101";
            array_push($Tests,$Text);
            $i++;
        }
    }
    $LINK = "https://crm-atko.uz/blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&send=true";
    $query = [
        'SendMesseg' => true,
        'Url' => $LINK,
        'Phone' => $Phones,
        'Text' => $Tests
    ];
    print_r($query);
    header('Location: https://atko.tech/sms/guruhDebetSend.php?' . http_build_query($query));
    exit;
    
?>