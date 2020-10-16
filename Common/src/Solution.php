<?php

namespace Common;

class Solution
{
    private $solution;

    function __construct($year, $day)
    {
        $classname = "y{$year}\Day{$day}";
        if ($classname) {
            $this->solution = new $classname($year, $day);
        }
    }

    public function get_solution()
    {
        return $this->solution;
    }

}
