<?php
namespace App\Business\Managers;

use BlueFission\Framework\Skill\BaseSkill;
use BlueFission\Framework\Skill\Intent\Intent;
use BlueFission\Framework\Skill\Intent\Matcher;

class SkillManager
{
    protected $skills = [];
    protected $intentMatcher;

    public function __construct(Matcher $intentMatcher)
    {
        $this->intentMatcher = $intentMatcher;
    }

    public function register(BaseSkill $skill, Intent $intent): self
    {
        $this->skills[$intent->name] = $skill;
        $this->intentMatcher->registerIntent($intent);
        return $this;
    }

    public function execute(array $input): string
    {
        $matchedIntent = $this->intentMatcher->match($input);

        if ($matchedIntent && isset($this->skills[$matchedIntent])) {
            $skill = $this->skills[$matchedIntent];
            $skill->execute($input['prompt']);
            return $skill->response();
        }

        return "I'm sorry, I couldn't understand the command.";
    }
}