<?php

namespace y2021;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1226, 2 => 1252]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $depths = $this->parse_input();

        $inc = 0;
        $last = $depths[0];
        foreach ($depths as $depth) {
            if ($depth > $last) {
                $inc++;
            }
            $last = $depth;
        }

        return $inc;
    }

    public function solution_2()
    {
        $depths = $this->parse_input();

        $inc = 0;
        $windows = [];
        for ($i = 0; $i < count($depths) - 2; $i++) {
            $windows[$i] = $depths[$i] + $depths[$i + 1] + $depths[$i + 2];
        }

        $inc = 0;
        $last = $windows[0];
        foreach ($windows as $window) {
            if ($window > $last) {
                $inc++;
            }
            $last = $window;
        }

        return $inc;
    }

}