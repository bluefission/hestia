<?php

// WeatherRequest.php
namespace App\Business\Services;

class OpenWeatherService
{
    private $apiKey = 'YOUR_API_KEY'; // Replace with your OpenWeatherMap API key
    private $baseUrl = 'https://api.openweathermap.org/data/2.5/weather';

    public function getWeatherByLocation($location)
    {
        $params = [
            'q' => $location,
            'appid' => $this->apiKey,
            'units' => 'metric', // Use 'imperial' for Fahrenheit
        ];

        $url = $this->baseUrl . '?' . http_build_query($params);
        $response = json_decode(file_get_contents($url), true);

        if (isset($response['main'], $response['weather'][0])) {
            $temperature = $response['main']['temp'];
            $description = $response['weather'][0]['description'];

            return "The current temperature in {$location} is {$temperature}°C with {$description}.";
        } else {
            return "Unable to fetch weather data for {$location}.";
        }
    }
}
