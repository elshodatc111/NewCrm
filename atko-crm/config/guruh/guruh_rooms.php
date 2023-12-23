
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    include("../../config/config.php");
    $RoomID = $_GET['RoomID'];
    $Start = $_GET['Start'];
    $End = $_GET['End'];
    $clock = array("08:00-09:30","09:30-11:00","11:00-12:30","12:30-14:00","14:00-15:30","15:30-17:00","17:00-18:30","18:30-20:00","20:00-21:30");
    $date = date("Y-m-d");
    if(empty($Start)){
        echo "<b style='color:red;' class='px-2'>Dars boshlanish vaqtini kiriting.</b><br>";
    }elseif(empty($End)){
        echo "<b style='color:red;' class='px-2'>Dars yakunlanish vaqtini kiriting.</b><br>";
    }elseif($Start>$End){
        echo "<b style='color:red;' class='px-2'>Dars Boshlanish vaqti yakunlanish vaqtidan kichik.</b><br>";
        echo "<b style='color:red;' class='px-2'>Darslar vaqtini to'g'irlang.</b>";
    }elseif($Start===$End){
        echo "<b style='color:red;' class='px-2'>Dars boshlanish vaqti va yakunlanish vaqti bir xil.</b><br>";
        echo "<b style='color:red;' class='px-2'>Darslar vaqtini to'g'irlang.</b>";
    }elseif($Start<$date){
        echo "<b style='color:red;' class='px-2'>Dars boshlanish vaqti bugungi kun va bugungi kundan kiyingi kunlarni kiriting.</b><br>";
    }else{
        # Dushanba
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Dushanba</label>
        <select class='form-control mb-3 mt-0' name='Dushanba' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $value) { 
                $sql = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Dushanba`='".$value."' AND `END`>'".$Start."'";
                $res = $conn->query($sql);
                $count = $res->fetchColumn();
                $sql2 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Dushanba`='".$value."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res2 = $conn->query($sql2);
                $count2 = $res2->fetchColumn();
                if($count>0){}
                elseif($count>0){echo "<option value=".$value.">".$value."</option>";}
                else{echo "<option value=".$value.">".$value."</option>"; }
            }
        echo "</select></div>";
        # Seshanba
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Seshanba</label>
        <select class='form-control mb-3 mt-0' name='Seshanba' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $val2ue) { 
                $sql22 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Seshanba`='".$val2ue."' AND `END`>'".$Start."'";
                $res22 = $conn->query($sql22);
                $count22 = $res22->fetchColumn();
                $sql222 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Seshanba`='".$val2ue."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res222 = $conn->query($sql222);
                $count222 = $res222->fetchColumn();
                if($count22>0){}
                elseif($count222>0){echo "<option value=".$val2ue.">".$val2ue."</option>";}
                else{echo "<option value=".$val2ue.">".$val2ue."</option>"; }
            }
        echo "</select></div>";
        # Chorshanba
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Chorshanba</label>
        <select class='form-control mb-3 mt-0' name='Chorshanba' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $val2ue) { 
                $sql33 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Chorshanba`='".$val2ue."' AND `END`>'".$Start."'";
                $res33 = $conn->query($sql33);
                $count33 = $res33->fetchColumn();
                $sql333 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Chorshanba`='".$val2ue."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res333 = $conn->query($sql333);
                $count333 = $res333->fetchColumn();
                if($count33>0){}
                elseif($count333>0){echo "<option value=".$val2ue.">".$val2ue."</option>";}
                else{echo "<option value=".$val2ue.">".$val2ue."</option>"; }
            }
        echo "</select></div>";
        #Payshanba
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Payshanba</label>
        <select class='form-control mb-3 mt-0' name='Payshanba' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $val2ue) { 
                $sql44 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Payshanba`='".$val2ue."' AND `END`>'".$Start."'";
                $res44 = $conn->query($sql44);
                $count44 = $res44->fetchColumn();
                $sql444 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Payshanba`='".$val2ue."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res444 = $conn->query($sql444);
                $count444 = $res444->fetchColumn();
                if($count44>0){}
                elseif($count444>0){echo "<option value=".$val2ue.">".$val2ue."</option>";}
                else{echo "<option value=".$val2ue.">".$val2ue."</option>"; }
            }
        echo "</select></div>";
        #Juma
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Juma</label>
        <select class='form-control mb-3 mt-0' name='Juma' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $val2ue) { 
                $sql55 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Juma`='".$val2ue."' AND `END`>'".$Start."'";
                $res55 = $conn->query($sql55);
                $count55 = $res55->fetchColumn();
                $sql555 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Juma`='".$val2ue."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res555 = $conn->query($sql555);
                $count555 = $res555->fetchColumn();
                if($count55>0){}
                elseif($count555>0){echo "<option value=".$val2ue.">".$val2ue."</option>";}
                else{echo "<option value=".$val2ue.">".$val2ue."</option>"; }
            }
        echo "</select></div>";
        #Shanba
        echo "<div class='col-6'><label class='form-label mt-1 mb-0' style='font-weight:600;'>Shanba</label>
        <select class='form-control mb-3 mt-0' name='Shanba' style='border-radius:0;' required>
            <option value='NULL'>Tanlang</option>";
            foreach ($clock as $val2ue) { 
                $sql66 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Shanba`='".$val2ue."' AND `END`>'".$Start."'";
                $res66 = $conn->query($sql66);
                $count66 = $res66->fetchColumn();
                $sql666 = "SELECT COUNT(*) FROM guruh WHERE `RoomID`='".$RoomID."' AND `Shanba`='".$val2ue."' AND `END`<'".$END."' AND `Start`>'".$Start."'";
                $res666 = $conn->query($sql666);
                $count666 = $res666->fetchColumn();
                if($count66>0){}
                elseif($count666>0){echo "<option value=".$val2ue.">".$val2ue."</option>";}
                else{echo "<option value=".$val2ue.">".$val2ue."</option>"; }
            }
        echo "</select></div>";
    }
    

?>
<!--
    <div class="col-6">
        <label class="form-label mt-1 mb-0" style="font-weight:600;">Juma</label>
        <select class="form-control mb-3 mt-0" name="Juma" style="border-radius:0;" required>
            <option value="NULL">Tanlang</option>
            <?php foreach ($clock as $key => $value) { #echo "<option value=".$value.">".$value."</option>"; 
            } ?>
        </select>
    </div>
    <div class="col-6">
        <label class="form-label mt-1 mb-0" style="font-weight:600;">Shanba</label>
        <select class="form-control mb-3 mt-0" name="Shanba" style="border-radius:0;" required>
            <option value="NULL">Tanlang</option>
            <?php foreach ($clock as $key => $value) { #echo "<option value=".$value.">".$value."</option>"; 
            } ?>
        </select>
    </div>