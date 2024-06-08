  // Navigation
  document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('[class*="container-"]');
    let currentIndex = 0;

    // Zeige den ersten Container an
    containers[currentIndex].classList.add('active');

    const goOnBtn = document.querySelector('.GoOnBtn');
    const goBackBtn = document.querySelector('.GoBackBtn');
    const goOnText = document.getElementById('GoOnText');

    // Funktion zum Festlegen des Button-Textes basierend auf dem Container-Index
    function setButtonText() {
        const buttonTexts = ["Los geht's", "Supi, weiter!", "Das ist es!", "Supi, weiter!", "Finish it!"];
        const index = currentIndex % buttonTexts.length; // Um den Index im Bereich der Button-Texte zu halten
        goOnText.textContent = buttonTexts[index];
    }

    // Funktion zum Anzeigen oder Ausblenden des "GoBackBtn"
    function updateGoBackBtnVisibility() {
        if (currentIndex > 0) {
            goBackBtn.style.display = 'block';
        } else {
            goBackBtn.style.display = 'none';
        }
    }

    // Funktion zum Anzeigen oder Ausblenden des "GoOnBtn"
    function updateGoOnBtnVisibility() {
        if (currentIndex < containers.length - 1) {
            goOnBtn.style.display = 'block';
        } else {
            goOnBtn.style.display = 'none';
        }
    }

    // Initialen Button-Text setzen und Button-Sichtbarkeit aktualisieren
    setButtonText();
    updateGoBackBtnVisibility();
    updateGoOnBtnVisibility();

    goOnBtn.addEventListener('click', function() {
        if (currentIndex < containers.length - 1) {
            // Aktuellen Container verstecken
            containers[currentIndex].classList.remove('active');
            // Zum nächsten Container wechseln
            currentIndex++;
            containers[currentIndex].classList.add('active');
            // Button-Text und Button-Sichtbarkeit aktualisieren
            setButtonText();
            updateGoBackBtnVisibility();
            updateGoOnBtnVisibility();
        }
    });

    goBackBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            // Aktuellen Container verstecken
            containers[currentIndex].classList.remove('active');
            // Zum vorherigen Container wechseln
            currentIndex--;
            containers[currentIndex].classList.add('active');
            // Button-Text und Button-Sichtbarkeit aktualisieren
            setButtonText();
            updateGoBackBtnVisibility();
            updateGoOnBtnVisibility();
        }
    });
  });

  //Container-2 Ausgangtemperatur
  var temperatureToggle = document.getElementById('temperatureToggle');
  var temperatureValue = document.getElementById('temperatureValue');

  temperatureToggle.addEventListener('change', function() {
    if (temperatureToggle.checked) {
      temperatureValue.value = "room"; // Wenn gehakt, dann "room"
    } else {
      temperatureValue.value = "fridge"; // Wenn nicht gehakt, dann "fridge"
    }
  });

  // Funktion zum Aktualisieren der Ei-Größe im Eingabefeld
  function updateSizeInput(swiper) {
    var activeSlide = swiper.slides[swiper.activeIndex];
    if (activeSlide) {
      var selectedSize = activeSlide.getAttribute("data-size");
      document.getElementById("size").value = selectedSize;
    }
  }

  // Initiiert den Swiper
  var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    on: {
      init: function () {
        updateSizeInput(this);
      },
      slideChange: function () {
        updateSizeInput(this);
      },
    },
  });

  // Setzt den Standardwert im Eingabefeld beim Laden der Seite
  document.getElementById("size").value = "XS";

   // Höhen Slider
   window.onload = function() {
  // Funktion 1: Aktualisierung der Höhenzahl
  var hSlider = document.getElementById("altitudeSlider");
  var result = document.getElementById("altitude");
  var altitudeValue = document.getElementById("altitudeValue");

  hSlider.addEventListener('input', function() {
      var altitude = hSlider.value;
      result.innerHTML = altitude + " m";
      altitudeValue.value = altitude; // Aktualisiere den Wert des versteckten Formularfelds
  });

  // Funktion 2: Steuerung der Opazität der Icons basierend auf dem Slider
  var altitudeSlider = document.getElementById('altitudeSlider');
  var icons = document.querySelectorAll('.nn-slider .icon');

  altitudeSlider.addEventListener('input', function() {
      var currentValue = parseInt(altitudeSlider.value);
      var closestIcon = null;
      var closestDistance = Infinity;

      // Finden des Bildes, das dem aktuellen Slider-Wert am nächsten liegt
      icons.forEach(function(icon) {
          var iconValue = parseInt(icon.getAttribute('data-altitude'));
          var distance = Math.abs(currentValue - iconValue);
          if (distance < closestDistance) {
              closestDistance = distance;
              closestIcon = icon;
          }
      });

      // Setzen der Opazität auf 1 für das am nächsten liegende Bild und auf 0.5 für alle anderen
      icons.forEach(function(icon) {
          if (icon === closestIcon) {
              icon.style.opacity = '1';
          } else {
              icon.style.opacity = '0.5';
          }
      });
  });

  // Setze die Opazität des Wasser-Icons auf 1, wenn der Regler noch nicht bewegt wurde
  if (altitudeSlider.value == 500) {
      document.querySelector('.nn-slider .icon[data-altitude="800"]').style.opacity = '1';
  }
};

// Ei Härte bestimmen
const slider = document.getElementById('slider');
const hardEgg = document.querySelector('.hard-egg');

slider.addEventListener('input', () => {
    const maskStart = 90; // Startpunkt der Maske in Prozent
    const maskSize = maskStart - (slider.value * 0.90); // Berechnung der Maskengröße
    const adjustedMaskSize = Math.max(maskSize, 0); // Stellt sicher, dass die Maske nicht kleiner als 0% wird

    // Anpassung der Breite und Höhe der Ellipse basierend auf den Bildabmessungen
    const width = hardEgg.width;
    const height = hardEgg.height;
    const ellipseWidth = width * 0.5;
    const ellipseHeight = height * 0.5;

    // Maskenstil mit weichem Rand
    hardEgg.style.mask = `radial-gradient(ellipse ${ellipseWidth}px ${ellipseHeight}px at center, transparent ${adjustedMaskSize}%, black ${Math.min(adjustedMaskSize + 8, 100)}%)`;
    hardEgg.style.webkitMask = `radial-gradient(ellipse ${ellipseWidth}px ${ellipseHeight}px at center, transparent ${adjustedMaskSize}%, black ${Math.min(adjustedMaskSize + 8, 100)}%)`;
});

const eiSchicht = document.querySelector('.ei-schicht');

slider.addEventListener('input', () => {
    const scaleValue = 1 - (slider.value / 100);
    eiSchicht.style.transform = `translate(-50%, 0) scale(${scaleValue})`;
});


