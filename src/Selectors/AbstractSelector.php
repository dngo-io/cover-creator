<?php

namespace DngoIO\CoverCreator\Selectors;


abstract class AbstractSelector
{
    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

}