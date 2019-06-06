<?php

namespace App\Reports\Library\Classes\Helpers\Arrays;

/**
 * Class ArrayToObject
 * @package App\Reports\Library\Classes\Helpers\Arrays
 */
class ArrayToObject
{
    /**
     * @param $array
     * @return null|\stdClass
     */
    function arrayToObject($array): ?\stdClass
    {
        if(!is_array($array))
        {
            return $array;
        }

        $object = new \stdClass();
        if(is_array($array) && count($array) > 0)
        {
            foreach($array as $name => $value)
            {
                $name = strtolower(trim($name));
                if(!empty($name))
                {
                    $object->$name = $this->arrayToObject($value);
                }
            }
            return $object;
        }
        else
        {
            return null;
        }
    }

}


