<?php
$API_KEY = '97009df79eb620c9b031039b48bbb92c'; // Ganti dengan API key Anda dari OpenWeatherMap
$CITY = 'Jakarta';
$URL = "http://api.openweathermap.org/data/2.5/forecast?q={$CITY}&units=metric&appid={$API_KEY}";

function getWeatherForecast($URL, $CITY) {
    try {
        $response = file_get_contents($URL);
        $data = json_decode($response, true);

        if ($data['cod'] != '200') {
            echo "Error fetching weather data: " . $data['message'] . PHP_EOL;
            return;
        }

        $forecast = array_filter($data['list'], function ($reading) {
            return strpos($reading['dt_txt'], '12:00:00') !== false;
        });

        echo "5-Day Weather Forecast for {$CITY}:" . PHP_EOL;

        foreach ($forecast as $day) {
            $date = date('l, d M Y', strtotime($day['dt_txt']));
            $temp = $day['main']['temp'];
            echo "{$date}: {$temp}°C" . PHP_EOL;
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage() . PHP_EOL;
    }
}

getWeatherForecast($URL, $CITY);
?>
