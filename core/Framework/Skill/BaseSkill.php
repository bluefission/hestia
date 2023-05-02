<?php
// BaseSkill.php
namespace BlueFission\Framework\Skill;

use BlueFission\Framework\Context;
abstract class BaseSkill {
    protected $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function name(): string {
        return $this->name;
    }

    abstract public function execute(Context $context);

    abstract public function response(): string;
}
