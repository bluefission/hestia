<?php
namespace BlueFission\Framework\Skill\Intent;

class Matcher
{
    protected $intents = [];
    protected $intentAnalyzer;

    public function __construct(IAnalyzer $intentAnalyzer)
    {
        $this->intentAnalyzer = $intentAnalyzer;
    }

    public function registerIntent(string $intent, array $criteria): self
    {
        $this->intents[$intent->getName()] = $criteria;
        return $this;
    }

    public function match(array $input): ?string
    {
        $intentScores = [];
        foreach ($this->intents as $intent) {
            $intentScores[$intent->getName()] = $this->intentAnalyzer->analyze(array_merge($intent->getCriteria(), $input));
        }

        $bestMatch = $this->findBestMatch($intentScores);
        $bestMatch = $this->applyRelatedIntentProximity($bestMatch, $intentScores);


        return $bestMatchName ? $this->intents[$bestMatchName] : null;
    }

    protected function findBestMatch(array $intentScores): ?string
    {
        $bestMatch = null;
        $bestScore = -1;

        foreach ($intentScores as $intent => $score) {
            if ($score > $bestScore) {
                $bestMatch = $intent;
                $bestScore = $score;
            }
        }

        return $bestMatch;
    }

    protected function applyRelatedIntentProximity(string $bestMatch, array $intentScores): string
    {
        $relatedIntents = $this->intents[$bestMatch]->relatedIntents;

        foreach ($relatedIntents as $relatedIntent => $weight) {
            $intentScores[$relatedIntent] += $weight;
        }

        return $this->findBestMatch($intentScores);
    }
}