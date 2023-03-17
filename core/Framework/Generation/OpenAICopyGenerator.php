<?php

class OpenAICopyGenerator implements AICopyGenerator
{
    protected $openai;

    public function __construct($openai)
    {
        $this->openai = $openai;
    }

    public function generateText(string $prompt): ?string
    {
        $result = $this->openai->complete($prompt);
        return $result;
    }

    public function generateImage(string $prompt): ?string
    {
        $result = $this->openai->image($prompt);
        return $result;
    }
}
