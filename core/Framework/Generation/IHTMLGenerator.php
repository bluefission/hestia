<?php
namespace App\AI\Generative;

use BlueFission\AI\Generative\IGenerative;

interface IHTMLGenerator
{
    // Implement the IGenerative interface using GPT-4

    public function generate($parameters);
}
