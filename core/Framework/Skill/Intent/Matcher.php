<?php
namespace BlueFission\Framework\Skill\Intent;

// Matcher.php
use BlueFission\Framework\Skill\Intent\Context;
use BlueFission\Framework\Skill\Intent\IAnalyzer;
use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Services\Service;

class Matcher
{
    protected $intentAnalyzer;
    
    // Use static properties to store skills and intents globally
    protected static $skills = [];
    protected static $intents = [];
    protected static $intentSkillMap = [];


    public function __construct(IAnalyzer $intentAnalyzer)
    {
        $this->intentAnalyzer = $intentAnalyzer;
    }

    public function registerSkill(BaseSkill $skill): self
    {
        self::$skills[$skill->name()] = $skill;
        return $this;
    }

    public function registerIntent($intent): self
    {
        // self::$intents[$intent->getName()] = $skillName;
        self::$intents[$intent->getName()] = $intent;
        return $this;
    }

    public function associate($intent, $skill): self
    {
        $intentName = $intent->getName();
        $skillName = $skill->name();

        if (!isset($this->intentSkillMap[$intentName])) {
            self::$intentSkillMap[$intentName] = [];
        }

        self::$intentSkillMap[$intentName][] = $skillName;

        return $this;
    }

    public function map()
    {
        return self::$intentSkillMap;
    }

    public function getIntent(string $intentName): ?Intent
    {
        return self::$intents[$intentName] ?? null;
    }

    public function getSkill(string $skillName): ?BaseSkill
    {
        return self::$skills[$skillName] ?? null;
    }

    public function match($input, Context $context): ?BaseSkill
    {
        $intentScores = $this->intentAnalyzer->analyze($input, $context, self::$intents);

        if (count($intentScores) <= 0) return null;

        $bestMatchIntent = array_search(max($intentScores), $intentScores);
        $bestMatchSkills = self::$intentSkillMap[$bestMatchIntent] ?? null;

        return $bestMatchSkills ? self::$skills[$bestMatchSkills[0]] : null;
    }
}
