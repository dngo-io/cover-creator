<?php

namespace DngoIO\CoverCreator;

class Selectors
{

    /**
     * @var array
     */
    public static $selectorRules= [
        'font-size' => ['integer'], //px
        'font-type' => ['file'], //path of ttf file on server
        'text-color' => ['rgb'], // RGB as array
        'left' => ['integer'],
        'top' => ['integer'],
    ];

}