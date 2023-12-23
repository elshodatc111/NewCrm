
<?php 
    date_default_timezone_set("Asia/Samarkand");
?>
<?php
    $typing = $_GET['q'];
    if($typing==='Tashriflar'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">Tashrif turlari</label>
            <select name="tashrif" class="form-control" style="border-radius:0;" required>
                <option value="">Tanlang</option>
                <option value="all">Barcha talabalar</option>
                <option value="nogrops">Guruhga biriktirilmagan talabalar</option>
                <option value="endgrops">Guruhga biriktirilgan talabalar</option>
                <option value="depetgrops">Qarzdor talabalar</option>
            </select>
        </div>
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="FILTERTASHRIF" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>
<?php
    }
    if($typing==='Guruhlar'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">Guruh holat</label>
            <select class="form-control" name="holat" style="border-radius:0;" required>
                <option value="">Tanlang</option>
                <option value="all">Barcha guruhlar</option>
            </select>
        </div>
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="GURUHFILTER" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>
<?php
    }
    if($typing==='Oqituvchilar'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">O'qituvchilar</label>
            <select class="form-control" name="techer" style="border-radius:0;" required>
                <option value="">Tanlang</option>
                <option value="all">Barcha o'qituvchilar</option>
                <option value="groups">To'langan ish haqi</option>
            </select>
        </div>
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="TECHERS" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>

<?php
    }
    if($typing==='Moliya'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">Hisobot turlari</label>
            <select class="form-control" name="moliya" style="border-radius:0;" required>
                <option value="">Tanlang</option>
                <option value="allchiqim">Barcha chiqimlar</option>
                <option value="xarajatchiqim">Xarajat uchun chiqimlar</option>
                <option value="kassachiqim">Kassaga chiqim</option>
                <option value="qaytarilgantolov">Qaytarilgan to'lovlar</option>
                <option value="alltulov">Barcha to'lovlar</option>
                <option value="naqttulov">Naqt to'lovlar</option>
                <option value="plastiktulovlar">Plastik to'lovlar</option>
                <option value="chegirmalar">Chegirma to'lovlar</option>
            </select>
        </div>
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="MOLIYA" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>
<?php
    }
    if($typing==='Hodimlar'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">Hodimlar</label>
            <select class="form-control" name="hodim" style="border-radius:0;" required>
                <option value="">Tanlang</option>
                <option value="all">Barcha hodimlar</option>
                <option value="tulovlar">Hodimlarga to'langan ish haqi</option>
            </select>
        </div>
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="HODIMLAR" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>
<?php
    }
    if($typing==='SMS'){
?>
    <div class="row">
        <div class="col-lg-6 my-1">
            <label class="w-100 text-center">.</label>
            <input type="submit" name="SENDMESSEGE" class="btn btn-outline-primary w-100" style="border-radius:0;" value="FILTER" class="w-100">
        </div>
    </div>
<?php
    }
?>