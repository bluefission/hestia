<?php
// LocationService.php
namespace App\Business\Services;

use BlueFission\Services\Service;

class LocationService extends Service
{
    private $baseUrl = 'http://ip-api.com/json';

    public function __construct()
    {
        parent::__construct();
    }

    public function getIpLocation()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = $this->baseUrl."/{$ip}";
        $response = json_decode(file_get_contents($url), true);

        if (isset($response['city'])) {
            $cityState = $response['city'];
            if (isset($response['regionName'])) {
                $cityState .= ', ' . $response['regionName'];
            }

            return $cityState;
        } else {
            return 'New York';
        }
    }
}
