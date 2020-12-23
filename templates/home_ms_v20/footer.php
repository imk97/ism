<?php
    $document = JFactory::getDocument();
?>
    <footer class="u-align-left u-clearfix u-footer u-gradient u-footer" id="sec-ba58">
  <div class="u-custom-color-1 u-expanded-width u-shape u-shape-rectangle u-shape-1"></div>
  <div class="u-black u-expanded-width u-shape u-shape-rectangle u-shape-2"></div>
  <div class="u-clearfix u-layout-wrap u-layout-wrap-1">
    <div class="u-gutter-0 u-layout">
      <div class="u-layout-row">
        <div class="u-align-left u-container-style u-layout-cell u-size-26-md u-size-26-sm u-size-26-xs u-size-29-lg u-size-30-xl u-layout-cell-1">
          <div class="u-container-layout u-valign-top-sm u-valign-top-xs u-container-layout-1">
            <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/logo-ism-removebg-preview.png" alt="" class="u-image u-image-default u-image-1" data-image-width="594" data-image-height="420">
            <h4 class="u-custom-font u-font-oswald u-text u-text-1">INSTITUT SOSIAL MALAYSIA </h4>
            <p class="u-custom-font u-font-arial u-text u-text-2">Lot PT 138556 KM 6 Lebuhraya Kuala Lumpur - Seremban, Sungai Besi,<br>57100 Kuala Lumpur, Malaysia 
            </p>
            <p class="u-custom-font u-font-arial u-text u-text-3">Tel: 03-79853333 </p>
            <p class="u-custom-font u-font-arial u-text u-text-4">Faks: 03-79853300 </p>
            <p class="u-custom-font u-font-arial u-text u-text-5">Emel: info@ism.gov.my </p>
            <p class="u-custom-font u-font-arial u-text u-text-6">webmaster@ism.gov.my</p>
            <div class="u-container-style u-group u-group-1">
              <div class="u-container-layout u-container-layout-2">
                <p class="u-text u-text-7">
                  <a href="http://waze.to/?ll=3.07707,101.70194&navigate=yes" class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-1">Waze<br>
                  </a>
                </p>
                <p class="u-text u-text-8">|</p>
                <p class="u-text u-text-9">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-2" href="https://www.google.com.my/maps/place/Institut+Sosial+Malaysia/@3.0768594,101.6997953,17z/data=!3m1!4b1!4m2!3m1!1s0x31cc4a7959c4d5f3:0xf19d482899add6e?hl=en&shorturl=1">Google Maps</a>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="u-container-style u-layout-cell u-size-30-xl u-size-31-lg u-size-34-md u-size-34-sm u-size-34-xs u-layout-cell-2">
          <div class="u-container-layout u-container-layout-3"><!--position-->
            <?php $positionName = 'statistic'; if ($positionName && CoreStatements::containsModules($positionName)) : ?><div data-position="statistic" class="u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-position u-position-1"><!--block-->
              <?php echo CoreStatements::position('statistic', 'block%block_1', 'block_1'); ?><!--/block-->
            </div><?php else: ?><div class="hidden-position" style="display:none"></div><?php endif; ?><!--/position-->
            <div class="u-social-icons u-spacing-16 u-text-grey-40 u-social-icons-1">
              <a class="u-social-url" target="_blank" href="https://facebook.com/institut.sosial.malaysia/"><span class="u-icon u-icon-circle u-social-facebook u-social-type-color u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-a122"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-a122" style="color: rgb(59, 89, 152);"><circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M73.5,31.6h-9.1c-1.4,0-3.6,0.8-3.6,3.9v8.5h12.6L72,58.3H60.8v40.8H43.9V58.3h-8V43.9h8v-9.2
            c0-6.7,3.1-17,17-17h12.5v13.9H73.5z"></path></svg></span>
              </a>
              <a class="u-social-url" target="_blank" href="https://twitter.com/ISM_HQ"><span class="u-icon u-icon-circle u-social-twitter u-social-type-color u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-c514"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-c514" style="color: rgb(85, 172, 238);"><circle fill="currentColor" class="st0" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M83.8,47.3c0,0.6,0,1.2,0,1.7c0,17.7-13.5,38.2-38.2,38.2C38,87.2,31,85,25,81.2c1,0.1,2.1,0.2,3.2,0.2
            c6.3,0,12.1-2.1,16.7-5.7c-5.9-0.1-10.8-4-12.5-9.3c0.8,0.2,1.7,0.2,2.5,0.2c1.2,0,2.4-0.2,3.5-0.5c-6.1-1.2-10.8-6.7-10.8-13.1
            c0-0.1,0-0.1,0-0.2c1.8,1,3.9,1.6,6.1,1.7c-3.6-2.4-6-6.5-6-11.2c0-2.5,0.7-4.8,1.8-6.7c6.6,8.1,16.5,13.5,27.6,14
            c-0.2-1-0.3-2-0.3-3.1c0-7.4,6-13.4,13.4-13.4c3.9,0,7.3,1.6,9.8,4.2c3.1-0.6,5.9-1.7,8.5-3.3c-1,3.1-3.1,5.8-5.9,7.4
            c2.7-0.3,5.3-1,7.7-2.1C88.7,43,86.4,45.4,83.8,47.3z"></path></svg></span>
              </a>
              <a class="u-social-url" target="_blank" href="https://www.instagram.com/ism_hq/"><span class="u-icon u-icon-circle u-social-instagram u-social-type-color u-icon-3"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4325"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-4325" style="color: rgb(197, 54, 164);"><circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M55.9,38.2c-9.9,0-17.9,8-17.9,17.9C38,66,46,74,55.9,74c9.9,0,17.9-8,17.9-17.9C73.8,46.2,65.8,38.2,55.9,38.2
            z M55.9,66.4c-5.7,0-10.3-4.6-10.3-10.3c-0.1-5.7,4.6-10.3,10.3-10.3c5.7,0,10.3,4.6,10.3,10.3C66.2,61.8,61.6,66.4,55.9,66.4z"></path><path fill="#FFFFFF" d="M74.3,33.5c-2.3,0-4.2,1.9-4.2,4.2s1.9,4.2,4.2,4.2s4.2-1.9,4.2-4.2S76.6,33.5,74.3,33.5z"></path><path fill="#FFFFFF" d="M73.1,21.3H38.6c-9.7,0-17.5,7.9-17.5,17.5v34.5c0,9.7,7.9,17.6,17.5,17.6h34.5c9.7,0,17.5-7.9,17.5-17.5V38.8
            C90.6,29.1,82.7,21.3,73.1,21.3z M83,73.3c0,5.5-4.5,9.9-9.9,9.9H38.6c-5.5,0-9.9-4.5-9.9-9.9V38.8c0-5.5,4.5-9.9,9.9-9.9h34.5
            c5.5,0,9.9,4.5,9.9,9.9V73.3z"></path></svg></span>
              </a>
              <a class="u-social-url" target="_blank" href="https://youtube.com/channel/UCUyvsSf8-qcXkdSlcbQ8uxA?view_as=subscriber"><span class="u-icon u-icon-circle u-social-type-color u-social-youtube u-icon-4"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-5ad3"></use></svg><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" xml:space="preserve" class="u-svg-content" viewBox="0 0 112 112" x="0px" y="0px" id="svg-5ad3" style="color: rgb(210, 34, 21);"><circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle><path fill="#FFFFFF" d="M74.9,33.3H37.3c-7.4,0-13.4,6-13.4,13.4v18.8c0,7.4,6,13.4,13.4,13.4h37.6c7.4,0,13.4-6,13.4-13.4V46.7 C88.3,39.3,82.3,33.3,74.9,33.3L74.9,33.3z M65.9,57l-17.6,8.4c-0.5,0.2-1-0.1-1-0.6V47.5c0-0.5,0.6-0.9,1-0.6l17.6,8.9 C66.4,56,66.4,56.8,65.9,57L65.9,57z"></path></svg></span>
              </a>
            </div>
            <img src="<?php $app = JFactory::getApplication();  echo JURI::root(true); ?>/templates/<?php echo $app->getTemplate(); ?>/images/iso1-removebg-preview.png" alt="" class="u-image u-image-default u-image-2" data-image-width="662" data-image-height="243">
            <div class="u-custom-php u-expanded-width-md u-expanded-width-xs u-custom-php-1"><?php
$server = "localhost";
$username = "root";
$password = "";
$db = "ism";

try {
    $connection = new PDO("mysql:host=$server;dbname=$db;", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";

    $ip = getIPAddress();
    $ipadd = long2ip(intVal($ip));
    // echo $ipadd;

    $date = date('Y-m-d');
    $query = $connection->query("SELECT count(*) FROM gr8os_visitor WHERE ipaddress = '$ipadd' AND date = '$date' ");
    $result = $query->fetchColumn();

    // echo $result;
    if ($result == 0) {
        $connection->exec("INSERT INTO gr8os_visitor (ipaddress) VALUES ('$ipadd')");
    }

    // $query = $connection->query("SELECT INET_NTOA(total) FROM gr8os_visitor");
    // $num = $query->fetchColumn();
    // echo $num;

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function getIPAddress() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $address = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $address = $_SERVER['REMOTE_ADDR'];
    }
    return $address;
}
?></div>
            <div class="u-container-style u-expanded-width-xs u-group u-group-2">
              <div class="u-container-layout u-container-layout-4">
                <p class="u-custom-font u-font-arial u-text u-text-palette-1-base u-text-12">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-3" href="#">Peta Laman</a>
                </p>
                <p class="u-text u-text-13">|</p>
                <p class="u-custom-font u-font-arial u-text u-text-palette-1-base u-text-14">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-4" href="#">Penafian</a>
                </p>
                <p class="u-text u-text-15">|</p>
                <p class="u-custom-font u-font-arial u-text u-text-palette-1-base u-text-16">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-5" href="#">Dasar Keselamatan</a>
                </p>
                <p class="u-align-left u-text u-text-17">|</p>
                <p class="u-custom-font u-font-arial u-text u-text-palette-1-base u-text-18">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-6" href="#">Dasar Privasi</a>
                </p>
                <p class="u-text u-text-19">|</p>
                <p class="u-custom-font u-font-arial u-text u-text-palette-1-base u-text-20">
                  <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-hover-none u-none u-text-palette-1-base u-btn-7" href="#">Hubungi Kami</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-2">
    <div class="u-layout">
      <div class="u-layout-row">
        <div class="u-black u-container-style u-layout-cell u-size-60 u-layout-cell-3">
          <div class="u-container-layout u-valign-middle u-container-layout-5">
            <p class="u-text u-text-default u-text-21">Hak Cipta © 2020 Institut Sosial Malaysia. Hak Cipta Terpelihara.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
    