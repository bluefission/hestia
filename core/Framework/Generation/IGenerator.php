<?php
namespace BlueFission\Framework\Generation;

interface IGenerator {
	public function generate(string $name, string $userPrompt): bool;
	public function getType(): string;
}