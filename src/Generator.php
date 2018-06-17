<?php

namespace DngoIO\CoverCreator;


use DngoIO\CoverCreator\Selectors;

class Generator
{

    protected $selectors;

    protected $config;

    protected $text;

    public function __construct($text, array $selectors = [], array $configVars = [])
    {
        //merge selectors with default values
        $selectors = array_merge((new Config)->getSelectors(), $selectors);
        $this->selectors = new Selectors($selectors);

        //merge config with default values
        $this->config = array_merge((new Config)->getConfig(), $configVars);

        $this->text = $text;
    }

    public function generate()
    {

        //Set the Content Type
        header($this->config['header']);

        // Create Image From Existing File

        $image = imagecreatefrompng($this->selectors['background-url']);

        // Allocate A Color For The Text
        $text_color = imagecolorallocate($image, $this->selectors['text-color'][0],$this->selectors['text-color'][1], $this->selectors['text-color'][2]);
        $font_size = $this->selectors['font-size'];
        $angle = $this->config['angle'];

        $text = $this->text;
        $font_path = $this->selectors['font-type'];

        $x = $this->selectors['left'];
        $y = $this->selectors['top'];

        if($this->config['auto-center']) {
            $center = $this->autoCenter($image,$font_size,$angle,$font_path,$text);
            $x = $x + $center['x'];
            $y = $y + $center['y'];
        }

        imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font_path, $text);

        // Send Image to Browser
        imagejpeg($image, null,95);

        // Clear Memory
        imagedestroy($image);
    }


    public function autoCenter($image, $font_size, $angle, $font_path, $text)
    {
        // Get image dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // Get center coordinates of image
        $centerX = $width / 2;
        $centerY = $height / 2;

        // Get size of text
        list($left, $bottom, $right, , , $top) = imageftbbox($font_size, $angle, $font_path, $text);

        // Determine offset of text
        $left_offset = ($right - $left) / 2;
        $top_offset = ($bottom - $top) / 2;

        // Generate coordinates
        $x = $centerX - $left_offset;
        $y = $centerY - $top_offset;

        return ['x' => $x, 'y' => $y];
    }

}