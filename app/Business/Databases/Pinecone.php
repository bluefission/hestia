<?php
namespace BlueFission\Data\Databases;

use BlueFission\Data\Storage\Storage;
use BlueFission\Connections\Curl;

class Pinecone extends Storage
{
    private $_client;

    /**
     * @var array $_config The configuration options for the Mongo storage class.
     */
    protected $_config = array( 
        'location'=>'https://api.pinecone.io/',
        'name'=>'',
        'apikey'=>'',
    );

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Curl([
            'target' => $this->config('location'),
            'method' => 'post',
            'headers' => [
                'x-api-key' => $this->config('apikey'),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    private function sendRequest($endpoint, $data)
    {
        $this->client->config('target', $this->baseUrl . $endpoint);
        $this->client->open();
        $this->client->query($data);
        $response = $this->client->result();
        $this->client->close();

        return json_decode($response, true);
    }

    public function createIndex($metric = "euclidean")
    {
        return $this->sendRequest('index/create', [
            'index_name' => $indexName,
            'index_config' => [
                'metric' => $metric
            ]
        ]);
    }

    public function read()
    {
        $indexName = $this->config('name');
        $this->_data = $this->sendRequest("index/{$indexName}/fetch", [
            'ids' => $this->id
        ]);
    }

    public function write($items)
    {
        $indexName = $this->config('name');
        $this->sendRequest("index/{$indexName}/upsert", [
            'items' => $this->data
        ]);
    }

    public function delete()
    {
        $indexName = $this->config('name');
        $this->sendRequest("index/{$indexName}/delete", [
            'ids' => $this->id
        ]);
    }

    public function deleteIndex()
    {
        $this->sendRequest('index/delete', [
            'index_name' => $this->config('name')
        ]);
    }

    public function query($queries, $topK = 1)
    {
        $indexName = $this->config('name');
        return $this->sendRequest("index/{$indexName}/query", [
            'queries' => $queries,
            'top_k' => $topK
        ]);
    }
}
