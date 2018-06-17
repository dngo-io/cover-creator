<?php

namespace DngoIO\CoverCreator\Selectors;

use SimpleValidator\Validator;

class SelectorValidator extends Validator
{

    /**
     * @param $input
     * @return bool
     */
    protected static function file($input)
    {
        return file_exists($input);
    }

    /**
     * @param $input
     * @return bool
     */
    protected static function rgb($input)
    {
        if (!is_array($input)) return false;

        foreach (array_values($input) as $item) {
            if (!is_numeric($item)) return false;
        }

        if (count($input) > 3) return false;

        return true;
    }

    /**
     * @param $lang
     * @return string
     * defining error files for your validator
     */
    protected function getErrorFilePath($lang)
    {
        return __DIR__ . "/ValidationErrors.php";
    }
}