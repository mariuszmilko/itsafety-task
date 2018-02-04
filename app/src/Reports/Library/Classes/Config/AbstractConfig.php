<?php

namespace App\Reports\Library\Classes\Config;

use App\Reports\Library\Classes\Config\ISchema;


class AbstarctConfig implements ISchema
{

    protected function filter(Traversable $filter, Callable $callback = null, $flag = 0) {
        if ($callback === null) {
            $callback = 'notEmpty';
        }
    
        foreach ($filter as $key => $value) {
            switch($flag) {
                case ARRAY_FILTER_USE_KEY:
                    if ($callback($key)) {
                        yield $key => $value;
                    }
                    break;
                case ARRAY_FILTER_USE_BOTH:
                    if ($callback($value, $key)) {
                        yield $key => $value;
                    }
                    break;
                default:
                    if ($callback($value)) {
                        yield $key => $value;
                    }
                    break;
            }
        }
    }
}