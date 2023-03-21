<?php
// KeywordIntentAnalyzer.php
namespace BlueFission\Framework\Skill\Intent;

use BlueFission\Framework\Skill\Intent\Context;

class KeywordIntentAnalyzer implements IAnalyzer
{
    public function __construct() {}

    public function analyze(string $input, Context $context, array $intents): array
    {
        $scores = [];

        // Tokenize the input into words and convert to lowercase
        $inputWords = preg_split('/\s+/', strtolower($input));
        $inputWordCount = count($inputWords);

        foreach ($intents as $intentName => $intent) {
            $criteria = $intent->getCriteria();
            // Calculate the score for this intent based on keywords, context, and other criteria.
            $score = 0;

            foreach ($criteria['keywords'] as $keyword) {
                $keywordLower = strtolower($keyword['word']);

                foreach ($inputWords as $inputWord) {
                    $similarityPercent = 0;
                    similar_text($inputWord, $keywordLower, $similarityPercent);

                    // Convert the similarity percentage to a value between 0 and 1
                    $similarityScore = $similarityPercent / 100;

                    // Calculate the multiplier based on the input word count
                    $multiplier = 1 / $inputWordCount;

                    // Increase the score based on the similarity and multiplier
                    $score += $keyword['priority'] * $similarityScore * $multiplier;
                }
            }

            if ($score > 5) {
                $scores[$intent->getName()] = $score;
            }
        }

        return $scores;
    }
}
