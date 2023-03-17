<?php
namespace BlueFission\Framework\Skill\Intent;

interface IAnalyzer
{
    public function analyze(array $criteria): array;
}