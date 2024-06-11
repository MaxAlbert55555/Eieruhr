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
    <meta property="og:url" content="https://www.das-perfekte-ei.free.nf/timer.php">
    <meta property="og:site_name" content="Eieruhr - Das perfekte Ei">
    <meta property="og:image" content="https://www.das-perfekte-ei.free.nf/images/og/startseite.jpg">
    <?php include('include/js-css.php'); ?>
    <?php include('include/favicon.php'); ?>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: https://das-perfekte-ei.free.nf");
        exit();
    }
    ?>
    <div class="GoBackBtn" onclick="history.back()">x</div>
    <div class="upper-curve"></div>
    <div class="bottom-curve"></div>

    <div class="container-2 active">
        <h2 id="headline">Starte den Timer,<br> sobald das Wasser kocht.</h2>
        <h3 class="center" id="funfacts"></h3>
        <div class="egg-container" style="margin-top:70px;">
            <img class="schale-back" src="images/content/egg-slider/ei-schale.png" alt="Eier Schale hinten">
            <img class="schale-front" src="images/content/egg-slider/schale-front.png" alt="Eier Schale vorn">
            <img class="soft-egg" src="images/content/egg-slider/ei-hart.png" alt="Flüssiges Ei">
            <img id="startButton" class="play" src="images/content/egg-slider/play.png" alt="Start">
            <img id="pauseButton" class="pause" src="images/content/egg-slider/pause.png" alt="Start" style="display:none;">
            <video id="holyFinish" class="holy-egg" autoplay loop muted playsinline>
                <source src="images/content/egg-slider/egg-loop-v.mp4" type="video/mp4">
                <img src="images/content/egg-slider/egg-loop.gif" alt="heiligenschein">
            </video>
        
            <?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function berechneSiedepunkt($hoehe) {
        // Formel zur Berechnung des Siedepunkts von Wasser
        return 100 - ($hoehe / 285);
    }
    function berechneKochzeit($temperatur, $hoehe, $groesse, $haerte) {
        // Durchmesser in mm basierend auf der Größe
        $GROESSE_DURCHMESSER = array(
            "XS" => 38,
            "S" => 41,
            "M" => 43,
            "L" => 46,
            "XL" => 49,
            "XXL" => 55
        );
        // Temperatur des Eies vor Kochbeginn
        $TEMP_START = array(
            "fridge" => 5,
            "room" => 21
        );
        // Zieltemperatur des Eigelbs nach Kochvorgang basierend auf der Härte
        if ($haerte <= 40) {
            $T_innen = 62 * ($haerte / 40); // Flüssiger Dotter von 0 bis 62°C
        } elseif ($haerte <= 55) {
            $T_innen = 62 + (67 - 62) * (($haerte - 40) / 15); // Weicher Dotter von 62 bis 67°C
        } else {
            $T_innen = 67 + (82 - 67) * (($haerte - 55) / 45); // Hartes Ei von 67 bis 82°C
        }
        // Berechnete Werte
        $d = $GROESSE_DURCHMESSER[$groesse];
        $T_wasser = berechneSiedepunkt($hoehe);
        $T_start = $TEMP_START[$temperatur];
        // Kochzeit in Minuten nach der Formel von Werner Gruber
        $kochzeitMinuten = 0.0016 * pow($d, 2) * log((2 * ($T_wasser - $T_start)) / ($T_wasser - $T_innen));
        // Umwandlung in Sekunden für die Ausgabe
        $kochzeitSekunden = round($kochzeitMinuten * 60);
        return $kochzeitSekunden;
    }

    $kochzeit = berechneKochzeit($_POST['temperature'], $_POST['altitude'], $_POST['size'], $_POST['hardness']);
    // Kochzeit im Format "MM:SS"
    $minuten = floor($kochzeit / 60);
    $sekunden = $kochzeit % 60;
    $kochzeitFormatiert = str_pad($minuten, 2, "0", STR_PAD_LEFT) . "min " . str_pad($sekunden, 2, "0", STR_PAD_LEFT) . "sek";
    echo "<p id='timer' class='center' style='position:relative;top:260px;z-index:50;'>$kochzeitFormatiert</p>";
}
         ?>


        </div>
    </div>

    <audio id="alarm" src="alarm.mp3" preload="auto" style="display: none;"></audio>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    var startButton = document.getElementById('startButton');
    var pauseButton = document.getElementById('pauseButton');
    var timerDisplay = document.getElementById('timer');
    var headline = document.getElementById('headline');
    var funfacts = document.getElementById('funfacts');
    var holyFinish = document.getElementById('holyFinish'); // Hinzugefügt
    var timerRunning = false;
    var timerStartedOnce = false;
    var timerInterval;
    var funfactInterval;
    var remainingTime = Math.floor(<?php echo isset($kochzeit) ? $kochzeit : 0; ?>);

    // Funfacts laden und Funfacts wechseln
    var funfactsArray = [];
    fetch('funfacts.txt')
        .then(response => response.text())
        .then(data => {
            funfactsArray = data.split(';').map(fact => fact.trim()).filter(fact => fact.length > 0);
        });

    var usedFunfacts = [];
    function showRandomFunfact() {
        if (funfactsArray.length > 0) {
            if (usedFunfacts.length === funfactsArray.length) {
                usedFunfacts = [];
            }
            var remainingFunfacts = funfactsArray.filter(fact => !usedFunfacts.includes(fact));
            var randomIndex = Math.floor(Math.random() * remainingFunfacts.length);
            var selectedFunfact = remainingFunfacts[randomIndex];
            usedFunfacts.push(selectedFunfact);

            funfacts.style.opacity = 0;
            setTimeout(function() {
                funfacts.innerText = selectedFunfact;
                funfacts.style.opacity = 1;
            }, 3000); // Matches the transition duration
        }
    }

    function updateDisplay() {
        var minuten = Math.floor(remainingTime / 60);
        var sekunden = remainingTime % 60;
        var minutenStr = minuten < 10 ? '0' + minuten : minuten;
        var sekundenStr = sekunden < 10 ? '0' + sekunden : sekunden;
        if (!timerStartedOnce) {
            timerDisplay.innerText = "# " + minutenStr + "min " + sekundenStr + "sek #";
        } else {
            timerDisplay.innerText = ">> " + minutenStr + "min " + sekundenStr + "sek" + " <<";
        }
    }

    function startTimer() {
        timerRunning = true;
        timerStartedOnce = true;
        headline.style.visibility = 'hidden';
        showRandomFunfact();
        funfactInterval = setInterval(showRandomFunfact, 20000);

        timerInterval = setInterval(function() {
            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                clearInterval(funfactInterval);
                timerDisplay.innerText = "00:00";
                funfacts.style.opacity = 0;
                setTimeout(function() {
                    funfacts.innerText = "Lass es dir schmecken :)";
                    funfacts.style.opacity = 1;
                }, 500); 
                timerRunning = false;
                // Bild auf display: block setzen
                holyFinish.style.display = 'block';
                // Audio-Element abspielen
                var alarmAudio = document.getElementById('alarm');
                alarmAudio.play();
            } else {
                remainingTime--;
                updateDisplay();
            }
        }, 1000);

    }

    startButton.addEventListener('click', function() {
        if (!timerRunning) {
            startTimer();
            startButton.style.display = 'none';
            pauseButton.style.display = 'inline';
        }
    });

    pauseButton.addEventListener('click', function() {
        clearInterval(timerInterval);
        clearInterval(funfactInterval);
        timerRunning = false;
        startButton.style.display = 'inline';
        pauseButton.style.display = 'none';
        updateDisplay();
    });

    updateDisplay(); // Initiale Anzeige aktualisieren

});


</script>

</body>
</html>
