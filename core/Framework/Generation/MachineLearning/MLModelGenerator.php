<?php

class MLModelGenerator
{
    protected $gpt4CodeGenerator;
    protected $controllerGenerator;
    protected $modelGenerator;
    protected $migrationGenerator;
    protected $adminModuleGenerator;

    public function __construct(Gpt4CodeGenerator $gpt4CodeGenerator)
    {
        $this->gpt4CodeGenerator = $gpt4CodeGenerator;
        $this->controllerGenerator = new ControllerGenerator($this->gpt4CodeGenerator);
        $this->modelGenerator = new ModelGenerator($this->gpt4CodeGenerator);
        $this->migrationGenerator = new MigrationGenerator($this->gpt4CodeGenerator);
        $this->adminModuleGenerator = new AdminModuleGenerator($this->gpt4CodeGenerator);
    }

    public function generateComponents()
    {
        $this->controllerGenerator->generate("manage data for SageMaker model");
        $this->modelGenerator->generate("data model for SageMaker model");
        $this->migrationGenerator->generate("database migration for SageMaker model");
        $this->adminModuleGenerator->generate("admin module for managing data");
    }
}
