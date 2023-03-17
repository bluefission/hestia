<?php
namespace BlueFission\Framework\Generation;

class MigrationGenerator extends ScaffoldGenerator
{
    public function getType(): string
    {
        return 'migration';
    }

    public function generateMigrationFromHeaders($tableName, $headers)
    {
        $migrationCode = '';

        // Programmatically generate the migration code
        $migrationCode .= "Scaffold::create('$tableName', function( Structure \$entity ) {\n";
        foreach ($headers as $header) {
            // Use a helper method to infer the field type from the header
            $fieldType = $this->inferFieldType($header);
            $migrationCode .= "    \$entity->{$fieldType}('$header');\n";
        }
        $migrationCode .= "});\n";

        return $migrationCode;
    }

    protected function inferFieldType($header)
    {
        // Analyze the header and return the appropriate field type
        // This is a simple example, adjust it to fit your needs
        if (strpos(strtolower($header), 'id') !== false) {
            return 'incrementer';
        } elseif (strpos(strtolower($header), 'date') !== false) {
            return 'date';
        } else {
            return 'text';
        }
    }
}
