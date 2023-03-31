<?php
//https://stackoverflow.com/questions/72711031/stream-data-from-openai-gpt-3-api-using-php
namespace App\Business\Services;

use BlueFission\Services\Service;
use BlueFission\Behavioral\Behaviors\Event;
use BlueFission\Net\HTTP;
use BlueFission\Connections\Curl;

class OpenAIService extends Service
{
    protected $_api_key;
    protected $_curl;

    /**
     * OpenAIService constructor.
     */
    public function __construct()
    {
        $this->_api_key = env('OPEN_AI_API_KEY');
        $this->_curl = new Curl([
            'method' => 'post',
        ]);

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->_api_key,
        ];

        $this->_curl->config('headers', $headers);
    }

    /**
     * Get GPT-3 completion based on the input.
     *
     * @param string $input
     * @return array
     */
    public function complete($input)
    {
        $request_data = [
            'prompt' => $input,
            'model' => 'text-davinci-002',
            'max_tokens' => 1024,
            'temperature' => 0.8,
            'top_p' => 0,
            'frequency_penalty' => 0.2,
            'presence_penalty' => 0.6,
        ];

        $this->_curl->config('target', 'https://api.openai.com/v1/completions');
        $this->_curl->open();
        $this->_curl->query(json_encode($request_data));
        $response = $this->_curl->result();
        $this->_curl->close();

        return json_decode($response, true);
    }

    /**
     * Get image based on the input.
     *
     * @param string $prompt
     * @param string $width
     * @param string $height
     * @return array
     */
    private function image($prompt, $width = '256', $height = '256')
    {
        $request_data = [
            'prompt' => $prompt,
            'model' => 'image-alpha-001',
            'size' => "{$width}x{$height}",
        ];

        $this->_curl->config('target', 'https://api.openai.com/v1/images/generations');
        $this->_curl->open();
        $this->_curl->query(json_encode($request_data));
        $response = $this->_curl->result();
        $this->_curl->close();

        return json_decode($response, true);
    }
}
