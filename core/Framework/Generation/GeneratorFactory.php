<?php
namespace BlueFission\Framework\Generation;

class GeneratorFactory
{
    public function createGenerator(string $type, string $templatePath, string $outputPath): ?ScaffoldGenerator
    {
        switch ($type) {
            case 'controller':
                return new ControllerGenerator($templatePath, $outputPath);
            // Add other cases for different types of files
            default:
                return null;
        }
    }
}
