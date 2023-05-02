<?php
namespace BlueFission\Framework;

// IIntentAnalyzer.php
use BlueFission\Framework\Context;

interface IAnalyzer
{
    public function analyze(string $input, Context $context, array $keywords): array;
}
