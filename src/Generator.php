<?php

namespace DngoIO\CoverCreator;


use DngoIO\CoverCreator\Exception\InvalidTypeException;
use DngoIO\CoverCreator\Selectors;
use DngoIO\CoverCreator\Selectors\SelectorValidator;

class Generator
{

    /** @var array  */
    protected $selectors;

    /** @var array  */
    protected $config;

    /** @var array  */
    protected $texts = [];

    /**
     * Generator constructor.
     * @param array $configVars
     */
    public function __construct(array $configVars = [])
    {
        $this->setConfig($configVars);
    }

    /**
     * Generate the image
     */
    public function generate()
    {
        //Set the Content Type
        header($this->config['header']);

        $image = null;

        // Create Image From Existing File
        $image = imagecreatefrompng($this->config['background-url']);

        foreach ($this->texts as $text => $selector) {

            if(isset($selector['wrap']) && is_int($selector['wrap']))
            {
                $text = explode("\n",wordwrap($text,20,"\n"));
            }
            // Allocate A Color For The Text
            $text_color = imagecolorallocate($image, $selector['text-color'][0], $selector['text-color'][1], $selector['text-color'][2]);
            $font_size = $selector['font-size'];
            $angle = $this->config['angle'];

            $font_path = $selector['font-type'];

            $x = $selector['left'];
            $y = $selector['top'];

            if (!isset($selector['wrap']) && $this->config['auto-center']) {
                $center = $this->autoCenter($image, $font_size, $angle, $font_path, $text);
                $x = $x + $center['x'];
                $y = $y + $center['y'];
            }

            if(is_array($text))
            {
                foreach($text as $line)
                {
                    imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font_path, trim($line));
                    $y = $y + $font_size + 18;

                }
            } else {
                imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font_path, $text);
            }

        }

        // Send Image to Browser
        imagejpeg($image, null, 95);

        // Clear Memory
        imagedestroy($image);
    }


    /**
     * @param $text
     * @param array $selectors
     * @return $this
     * @throws InvalidTypeException
     */
    public function addLine($text, array $selectors = [])
    {
        //merge selectors with default values
        $selectors = array_merge((new Config)->getSelectors(), $selectors);

        //validate selectors
        $validator = SelectorValidator::validate($selectors,\DngoIO\CoverCreator\Selectors::$selectorRules);
        if ($validator->isSuccess() == false) {
            throw new InvalidTypeException(implode(',',$validator->getErrors()));
        }

        $this->texts[$text] =  $selectors;

        return $this;

    }

    /**
     * @param array $config
     * @return $this
     */
    public function setConfig(array $config)
    {
        //merge config with default values
        $this->config = array_merge((new Config)->getConfig(), $config);

        return $this;
    }

    /**
     *
     * @param $image
     * @param $font_size
     * @param $angle
     * @param $font_path
     * @param $text
     * @return array
     */
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