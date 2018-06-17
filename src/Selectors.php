<?php

namespace DngoIO\CoverCreator;

use DngoIO\CoverCreator\Exception\InvalidTypeException;
use DngoIO\CoverCreator\Selectors\SelectorValidator;

class Selectors
{

    /**
     * @var array
     */
    public $selectorRules= [
        'font-size' => ['integer'], //px
        'font-type' => ['file'], //path of ttf file on server
        'text-color' => ['rgb'], // RGB as array
        'left' => ['integer'],
        'top' => ['integer'],
        'background-url' => ['file'] //path of the png
    ];

    /**
     * Selectors constructor.
     * @param array $selectors
     * @throws InvalidTypeException
     * @throws \SimpleValidator\SimpleValidatorException
     */
    public function __construct(array $selectors)
    {
        $validator = SelectorValidator::validate($selectors,$this->selectorRules);
        if ($validator->isSuccess() == false) {
            throw new InvalidTypeException(implode(',',$validator->getErrors()));
        }

        return $selectors;
    }

}