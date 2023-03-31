<?php
// SkillManager.php
namespace App\Business\Managers;

use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Matcher;
use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Services\Service;
use BlueFission\Bot\NaturalLanguage\EntityExtractor;

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

    public function getIntent(string $intentLabel): ?Intent
    {
        return $this->matcher->getIntent($intentLabel);
    }

    public function getIntents(): ?Intent
    {
        return $this->matcher->getIntents();
    }

    public function getSkill(string $skillName): ?BaseSkill
    {
        return $this->matcher->getSkill($skillName);
    }

    public function getSkillsForIntent(Intent $intent): array
    {
        $intentLabel = $intent->getLabel();
        $associatedSkillNames = $this->matcher->map()[$intentLabel] ?? [];

        return array_map(function ($skillName) {
            return $this->matcher->getSkill($skillName);
        }, $associatedSkillNames);
    }

    public function process( $intent, $context ) {
        return $this->matcher->process($intent, $context);
    }

    public function runSkill( $behavior, $args )
    {
        if (empty($args) || $args == null) {
            $this->_response = "Here's a list of skills";
            return;
        }

        if (isset($args) && isset($args[0])) {
            $extractor = new EntityExtractor();
            $name = $extractor->object($args)[0];
            // $name = $args[0];

            // TODO: Build context from available information

            $skill = $this->matcher->getSkill($name);
            if ($skill) {
                $skill->execute();
                $this->_response = $skill->response();
            }
        }
    }
}
