<?php

// WikiNewsRequest.php
namespace App\Business\Services;

class WikiNewsService
{
    private $baseUrl = 'https://en.wikinews.org/w/api.php';

    public function getHeadlines($topic = '', $location = '')
    {
        $searchQuery = $topic;
        if ($location) {
            $searchQuery .= ($searchQuery ? ' AND ' : '') . $location;
        }

        $params = [
            'action' => 'query',
            'format' => 'json',
            'list' => 'search',
            'srsearch' => $searchQuery,
            'srprop' => 'size|wordcount|timestamp|snippet',
            'srlimit' => 5,
        ];

        $url = $this->baseUrl . '?' . http_build_query($params);
        $response = json_decode(file_get_contents($url), true);

        $headlines = [];
        if (isset($response['query']['search'])) {
            foreach ($response['query']['search'] as $result) {
                $headlines[] = $result['title'];
            }
        }

        return $headlines;
    }
}

