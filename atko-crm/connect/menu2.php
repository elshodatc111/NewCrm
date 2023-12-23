
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="../index.php">
          <i class="bi bi-grid"></i>
          <span>Bosh sahifa</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($guruh==='student'){}else{echo 'collapsed';} ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person-lines-fill"></i><span>Tashriflar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="../tashriflar.php" class="<?php if($submenu==='tashriflarim'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Tashriflar</span>
            </a>
          </li>
          <li>
            <a href="../qarzdorlar.php" class="<?php if($submenu==='qarzdorlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Qarzdorlar</span>
            </a>
          </li>
          <li>
            <a href="../tolovlar.php" class="<?php if($submenu==='tulovlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>To'lovlar</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($guruh==='guruh'){}else{echo 'collapsed';} ?>" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Guruhlar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="../guruhlar_plus.php" class="<?php if($submenu==='guruhPlus'){echo "active";} ?>" style='display:<?php if($UIns==='off'){echo "none;'";}elseif($Type==='mexmon'){echo "none;'";} ?>'>
              <i class="bi bi-circle"></i><span>Yangi guruh qo'shish</span>
            </a>
          </li>
          <li>
            <a href="../guruhlar.php" class="<?php if($submenu==='guruhlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Guruhlar</span>
            </a>
          </li>
			<!--
          <li>
            <a href="../guruhlar_new.php" class="<?php if($submenu==='yangiguruhlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Yangi guruhlar</span>
            </a>
          </li>
          <li>
            <a href="../guruhlar_active.php" class="<?php if($submenu==='aktivguruhlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Aktiv guruhlar</span>
            </a>
          </li>
          <li>
            <a href="guruhlar_end.php" class="<?php if($submenu==='endguruhlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Yakunlangan guruhlar</span>
            </a>
          </li>
-->
        </ul>
      </li>
      <li class="nav-item" <?php  // Hisobot
        if(isset($_COOKIE['UserID'])){
          if($Type==='mexmon'){echo "style='display:none;'";}
          elseif($Type==='meneger'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='aaaa'){}else{echo 'collapsed';} ?>" href="../hisobot.php">
          <i class="bi bi-layout-text-window-reverse"></i><span>Hisobotlar</span>
        </a>
      </li>
      <li class="nav-item"<?php
        if(isset($_COOKIE['UserID'])){
          if($Type==='meneger'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='aaaa'){}else{echo 'collapsed';} ?>" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Statistika</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse <?php if($blok==='ShowStatistika'){echo "show";} ?>" data-bs-parent="#sidebar-nav">
          <li>
            <a href="../sta_kun_tashrif.php" class="<?php if($submenu==='kunliktashrif'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Kunlik tashriflar</span>
            </a>
          </li>
          <li>
            <a href="../sta_oy_tashrif.php" class="<?php if($submenu==='oyliktashrif'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Oylik tashriflar</span>
            </a>
          </li>
          <li>
            <a href="../sta_kun_tulov.php" class="<?php if($submenu==='kunliktulov'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Kunlik to'lovlar</span>
            </a>
          </li>
          <li>
            <a href="../sta_oy_tulov.php" class="<?php if($submenu==='oyliktulovlar'){echo "active";} ?>">
              <i class="bi bi-circle"></i><span>Oylik to'lovlar</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($guruh==='aaaa'){}else{echo 'collapsed';} ?>" data-bs-target="#icons-nav" href="../moliya.php">
          <i class="bi bi-gem"></i><span>Moliya</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($guruh==='techer'){}else{echo 'collapsed';} ?>" href="../oqituvchi.php">
          <i class="bi bi-person-bounding-box"></i>
          <span>O'qituvchilar</span>
        </a>
      </li>
      <li class="nav-item"<?php
        if(isset($_COOKIE['UserID'])){
          if($Type==='meneger'){echo "style='display:none;'";}
          elseif($Type==='mexmon'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='hodim'){}else{echo 'collapsed';} ?>" href="../hodimlar.php">
          <i class="bi bi-person"></i>
          <span>Hodimlar</span>
        </a>
      </li>
      <li class="nav-item"<?php
        if(isset($_COOKIE['UserID'])){
          if($Type==='meneger'){echo "style='display:none;'";}
          elseif($Type==='xisobchi'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='xona'){}else{echo 'collapsed';} ?>" href="../xonalar.php">
          <i class="bi bi-question-circle"></i>
          <span>Xonalar</span>
        </a>
      </li>
      <li class="nav-item"<?php
        if(isset($_COOKIE['UserID'])){
          if($Type==='xisobchi'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='aaaa'){}else{echo 'collapsed';} ?>" href="../eslatma.php">
          <i class="bi bi-envelope"></i>
          <span>Eslatmalar</span>
        </a>
      </li>
      <li class="nav-item"<?php
        if(isset($_COOKIE['UserID'])){
          if($Type==='meneger'){echo "style='display:none;'";}
        }
      ?>>
        <a class="nav-link <?php if($guruh==='aaaa'){}else{echo 'collapsed';} ?>" href="../sms.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>SMS</span>
        </a>
      </li>
    </ul>
  </aside>