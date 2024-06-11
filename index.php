<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eieruhr | Koch dein perfektes Ei</title>
    <meta name="description" content="Du liebst gekochte Eier und hättest gerne immer die perfekte Konsistenz? Dann probiere diese Eieruhr.">
    <meta property="og:locale" content="de_DE">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Eieruhr | Koch dein perfektes Ei">
    <meta property="og:description" content="Du liebst gekochte Eier und hättest gerne immer die perfekte Konsistenz? Dann probiere diese Eieruhr.">
    <meta property="og:url" content="https://www.das-perfekte-ei.free.nf/">
    <meta property="og:site_name" content="Eieruhr - Das perfekte Ei">
    <meta property="og:image" content="https://www.das-perfekte-ei.free.nf/images/og/startseite.jpg">
    <?php include('include/js-css.php'); ?>
    <?php include('include/favicon.php'); ?>
</head>
<body>
  <div class="GoBackBtn"><span class="arrow"> <<<span class="arrow-line">-</span></span></div>
  <nav>
    <div class="GoOnBtn">
       <span id="GoOnText"></span><span class="arrow"> <span class="arrow-line">-</span>>></span>
    </div>
  </nav>
  <div class="upper-curve"></div>
  <div class="bottom-curve"></div>
  <form action="timer.php" method="post">
    <div class="container-1">
      <img class="tasse" src="images/bg/tasse.jpg" alt="Kaffeetasse von oben betrachtet">
      <h1 class="welcome">Heute gibt's <br>perfekte Eier <br>&lt;3 </h1>
    </div>

    <div class="container-2">
      <!-- <progress value="1" max="4"></progress> -->
      <h2>Was ist deine Ei Ausgangstemperatur</h2> 
      <label for="temperatureToggle" class="switch">
      <input type="checkbox" id="temperatureToggle">
        <span class="toggle"></span>
        <div class="temperatur">
          <svg class="fridge" xmlns="http://www.w3.org/2000/svg" height="140px" viewBox="0 -960 960 960" width="140px" fill="#647A90">
            <path d="M309-650v-118h60v118h-60Zm0 361v-196h60v196h-60ZM220-80q-24.75 0-42.37-17.63Q160-115.25 160-140v-680q0-24.75 17.63-42.38Q195.25-880 220-880h520q24.75 0 42.38 17.62Q800-844.75 800-820v680q0 24.75-17.62 42.37Q764.75-80 740-80H220Zm0-60h520v-398H220v398Zm0-458h520v-222H220v222Z"/>
          </svg>
          <span class="fridge">Kühlschrank</span>
          <svg class="room" xmlns="http://www.w3.org/2000/svg" height="140px" viewBox="0 -960 960 960" width="140px" fill="#E29952">
            <path d="M220-180h150v-250h220v250h150v-390L480-765 220-570v390Zm-60 60v-480l320-240 320 240v480H530v-250H430v250H160Zm320-353Z"/>
          </svg>
          <span class="room">Zimmer</span>
        </div>
      </label>
    </div>
    <input type="hidden" name="temperature" id="temperatureValue" value="fridge">

    <div class="container-3">
      <h2 class="center">Wie hoch kochst du?</h2>
      <input type="hidden" name="altitude" id="altitudeValue" value="500"> 
        <div class="nn-slider">
          <input class="input-range" orient="vertical" type="range" step="1" value="500" min="0" max="4000" id="altitudeSlider">
          <div class="val" id="altitude">500 m</div>
          <img class="icon" src="images/content/jesus.png" alt="Jesus-Icon" data-altitude="3200">
          <img class="icon" src="images/content/berge.png" alt="Berg-Icon" data-altitude="2400">
          <img class="icon" src="images/content/village.png" alt="village-Icon" data-altitude="1600">
          <img class="icon" src="images/content/houses.png" alt="Haus-Icon" data-altitude="800">
          <img class="icon" src="images/content/water.png" alt="Meer-Icon" data-altitude="0">
      </div>
    </div>

    <div class="container-4">
      <h2 class="center">
        <label for="size">Wie groß ist dein Ei? :)</label>
      </h2>
      <!-- Input Feld für die Eigröße -->
      <input type="text" id="size" name="size" value="XS" readonly hidden>
      <!-- Swiper Eierrahmen -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide" data-size="XS"><img src="images/content/frames/xs.png" style="width:175px;height:auto;" alt="xs-Ei-Rahmen"></div>
          <div class="swiper-slide" data-size="S"><img src="images/content/frames/s.png" style="width:190px;height:auto;" alt="s-Ei-Rahmen"></div>
          <div class="swiper-slide" data-size="M"><img src="images/content/frames/m.png" style="width:205px;height:auto;" alt="m-Ei-Rahmen"></div>
          <div class="swiper-slide" data-size="L"><img src="images/content/frames/l.png" style="width:220px;height:auto;" alt="l-Ei-Rahmen"></div>
          <div class="swiper-slide" data-size="XL"><img src="images/content/frames/xl.png" style="width:235px;height:auto;" alt="xl-Ei-Rahmen"></div>
          <div class="swiper-slide" data-size="XXL"><img src="images/content/frames/xxl.png" style="width:250px;height:auto;" alt="xxl-Ei-Rahmen"></div>        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
     
    </div>
    
    <div class="container-5">
      <h2>Wähle die Härte des Ei's</h2>
      <div class="egg-container">
          <img class="schale-back" src="images/content/egg-slider/ei-schale.png" alt="Eier Schale hinten">
          <img class="schale-front" src="images/content/egg-slider/schale-front.png" alt="Eier Schale vorn">
          <img class="soft-egg" src="images/content/egg-slider/ei-fluessig.png" alt="Flüssiges Ei">
          <div class="hard-egg-container">
              <img class="hard-egg" src="images/content/egg-slider/ei-hart.png" alt="Hartes Ei">
          </div>
          <img class="ei-schicht" src="images/content/egg-slider/ei-schicht.png" alt="Ei Grenze">
      </div>
      <div class="egg-slider">
          <input type="range" min="0" max="100" value="0" class="slider" id="slider" name="hardness">
          <div class="labels">
              <span class="fluit">flüssig</span>
              <span class="soft">weich</span>
              <span class="hard">hart</span>
          </div>
      </div>
      <button class="sendForm">Finish it!<span class="arrow"> <span class="arrow-line">-</span>>></span></button>
    </div>
  </form>
  <script src="css-js/script.js"></script>
</body>
</html>