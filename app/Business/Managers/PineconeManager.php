<?php

namespace App\Business\Managers;

use App\Business\Databases\Pinecone;

class PineconeManager extends Service
{
    private $_pinecone;
    private $openai;
    private $data;

    public function __construct(Pinecone $pinecone, OpenAIService $openai)
    {
        $this->_pinecone = $pinecone;
        $this->_openai = $openai;
    }

    public function setData($data) {
    	$this->_data = $data;
    }

    private function gptQueryToVector($query)
    {
        // Use OpenAI API to generate a query vector
        $prompt = "Generate a vector for the query: $query";
        $response = $this->_openai->complete($prompt);
        $queryVector = $this->extractVector($response);

        return $queryVector;
    }

    private function extractVector($response)
    {
        // Extract the vector from the OpenAI API response
        // Note: You'll need to modify this line based on the actual response format
        $vector = $response['choices'][0]['vector'];

        return $vector;
    }

    private function getIndexName($client_id)
    {
        return $client_id . "-pinecone-index";
    }

    public function storeVectorsInPinecone($client_id)
    {
        $indexName = $this->getIndexName($client_id);
        $this->_pinecone->createIndex($indexName);
        $this->_pinecone->upsert($indexName, $this->data);
    }

    public function getRelevantResults($client_id, $query, $top_k = 5)
    {
        $indexName = $this->getIndexName($client_id);
        $queryVector = $this->gptQueryToVector($query);
        $results = $this->_pinecone->query($indexName, [$queryVector], $top_k);
        return $results;
    }

    public function displayResults($results)
    {
        foreach ($results as $result) {
            $document = $this->data[intval($result[0])];
            echo "{$document['title']} - {$document['url']}\n";
        }
    }
}
