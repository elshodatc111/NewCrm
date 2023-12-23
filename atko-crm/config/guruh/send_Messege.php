
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
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
            $phone = (string)substr($phone1,3);
            array_push($Phone,$phone);
            $k++;
        }
    }
    for ($i=0; $i <$k ; $i++) { 
        sendMessege2($Text,$Phone[$i],$conn);
        echo $Phone[$i]." ";
    }
    header("location: ../../blog/guruh_eye.php?GuruhID=".$_GET['GuruhID']."&sendMesseg=true");
?>