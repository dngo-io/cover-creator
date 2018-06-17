<?php

namespace DngoIO\CoverCreator;



class Config
{
    /**
     * @var array Default Selector Config
     */
    public $selectors = [
        'font-size' => 18,  //px
        'font-type' => __DIR__ . '../assets/Roboto-Regular.ttf', //path of ttf file on server
        'text-color' => [61,183,228],
        'left' => 0,
        'top' => 0,
        'background-url' => __DIR__ . '../assets/background.jpg' //path of the png
    ];

    public $config = [
        'auto-center' => true,
        'angle' => 0,
        'header' => 'Content-type: image/jpeg',
    ];

    public function getConfig()
    {
        return $this->config;
    }

    public function getSelectors()
    {
        return $this->selectors;
    }
}