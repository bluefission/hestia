<?php

namespace BlueFission\Framework\Generation;

class CSSGenerator implements ICSSGenerator {
    private $css;

    public function __construct($config = []) {
        $this->css = "";
    }

    public function addRule($selector, $properties = []) {
        $this->css .= "$selector {\n";
        foreach ($properties as $property => $value) {
            $this->css .= "\t$property: $value;\n";
        }
        $this->css .= "}\n";
    }

    public function addRules($rules = []) {
        foreach ($rules as $selector => $properties) {
            $this->addRule($selector, $properties);
        }
    }

    public function render() {
        return "<style>\n$this->css\n</style>";
    }

    public function generate() {
        return $this->render();
    }
}

$css = new CSSGenerator();

// // Set some styles using a multidimensional array
// $styles = array(
//     'body' => array(
//         'background-color' => '#f0f0f0',
//         'color' => '#333',
//         'font-family' => 'Arial, sans-serif'
//     ),
//     'h1' => array(
//         'font-size' => '24px',
//         'font-weight' => 'bold'
//     ),
//     'p' => array(
//         'font-size' => '16px'
//     ),
//     '.my-class' => array(
//         'color' => '#ff0000',
//         'font-style' => 'italic'
//     )
// );
// $css->addStyles($styles);

// // Render the CSS as a string
// echo $css->render();
