<?php

class ContentGenerator
{
    protected $aiCopyGenerator;

    public function __construct(AICopyGenerator $aiCopyGenerator)
    {
        $this->aiCopyGenerator = $aiCopyGenerator;
    }

    // ...

    private function copy($prompt)
    {
        return $this->aiCopyGenerator->generateText($prompt);
    }

    private function image($prompt)
    {
        return $this->aiCopyGenerator->generateImage($prompt);
    }

    // ...
}
