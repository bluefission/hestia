<?php
namespace BlueFission\Framework\Skill\Intent;

class Analyzer implements IAnalyzer
{
    public function analyze(array $criteria): array
    {
        $score = 0;
        if (isset($criteria['mimeType']) && $criteria['mimeType'] === $criteria['inputMimeType']) {
            $score++;
        }
        if (isset($criteria['keywords']) && count(array_intersect($criteria['keywords'], $criteria['inputKeywords'])) > 0) {
            $score++;
        }
        if (isset($criteria['context']) && $criteria['context'] === $criteria['inputContext']) {
            $score++;
        }

        return $score;
    }
}