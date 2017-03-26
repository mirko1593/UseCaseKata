<?php 

use CodeCast\Support\Collection;

if (! function_exists('collect')) {
    function collect($value = [])
    {
        return new Collection($value);
    }
}