<?php
namespace BlueFission\Framework\Skill\Intent;

class Intent
{
    protected $name;
    protected $criteria;
    protected $actions = [];

    protected $relatedIntents;

    public function __construct(string $name, array $criteria)
    {
        $this->name = $name;
        $this->criteria = $criteria;
        $this->relatedIntents = [];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCriteria(): array
    {
        return $this->criteria;
    }

    public function getRelatedIntents(): array
    {
        return $this->relatedIntents;
    }

    public function addAction(callable $action): self
    {
        $this->actions[] = $action;
        return $this;
    }

    public function addRelatedIntent(Intent $intent, float $weight): self
    {
        $this->relatedIntents[$intent->name] = $weight;
        return $this;
    }

    public function dispatch(): void
    {
        foreach ($this->actions as $action) {
            $action($this);
        }
    }
}