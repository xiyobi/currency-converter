
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>

<?php
require "src/Weather.php";
$weather = new Weather();
?>

<div class="container text-center">
    <h1 class="my-4">Weather in <span id="city-name">Tashkent</span></h1>

    <div class="weather-card text-center">

        <div class="mb-3">

                <img id="weather-icon" src="<?php echo 'https://openweathermap.org/img/wn/' . $weather->getWeather()->weather[0]->icon .'@2x.png';?>" alt="Weather Icon" class="weather-icon">

        </div>

        <h2 class="mb-3" id="temperature">5°C</h2>
        <p id="description">Clear Sky</p>

        <div class="d-flex justify-content-around">
            <div>
                <h5>Namlik</h5>
                <p id="humidity"><?php echo $weather->getWeather()->main->humidity; ?>%</p>
            </div>
            <div>
                <h5>Bosim</h5>
                <p id="pressure"><?php echo $weather->getWeather()->main->pressure; ?> Pa</p>
            </div>
            <div>
                <h5>Shamol</h5>
                <p id="speed"><?php echo $weather->getWeather()->wind->speed; ?>m/s</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
