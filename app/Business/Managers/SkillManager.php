<?php
// SkillManager.php
namespace App\Business\Managers;

use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Matcher;
use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Services\Service;

class SkillManager extends Service
{
    // protected $skills = [];
    // protected $intents = [];
    protected $matcher = null;

    public function __construct( Matcher $matcher )
    {
        $this->matcher = $matcher;
        parent::__construct();
    }

    public function registerSkill(BaseSkill $skill): self
    {
        $this->matcher->registerSkill($skill);
        return $this;
    }

    public function registerIntent(Intent $intent): self
    {
        // $this->intents[$intent->getName()] = $intent;
        $this->matcher->registerIntent($intent);
        return $this;
    }

    public function associate(Intent $intent, BaseSkill $skill): self
    {
        $this->matcher->associate($intent, $skill);
        return $this;
    }

    public function getIntent(string $intentName): ?Intent
    {
        return $this->matcher->getIntent($intentName);
    }

    public function getSkill(string $skillName): ?BaseSkill
    {
        return $this->matcher->getSkill($skillName);
    }

    public function getSkillsForIntent(Intent $intent): array
    {
        $intentName = $intent->getName();
        $associatedSkillNames = $this->matcher->map()[$intentName] ?? [];

        return array_map(function ($skillName) {
            return $this->matcher->getSkill($skillName);
        }, $associatedSkillNames);
    }

    public function runSkill( $behavior, $skillName )
    {
        // TODO: Figure out cause of this weird array structure
        if (isset($skillName[0]) && isset($skillName[0][0])) {
            $name = $skillName[0][0];

            // TODO: Build context from available information

            $skill = $this->matcher->getSkill($name);
            if ($skill) {
                return $skill->execute();
            }
        }
    }
}
