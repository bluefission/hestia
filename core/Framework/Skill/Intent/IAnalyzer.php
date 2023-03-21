<?php
namespace BlueFission\Framework\Skill\Intent;

// IIntentAnalyzer.php
use BlueFission\Framework\Skill\Intent\Context;

interface IAnalyzer
{
    public function analyze(string $input, Context $context, array $intents): array;
}
