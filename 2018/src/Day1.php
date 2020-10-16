<?php

namespace y2018;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 497, 2 => 558]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        return array_reduce(
            $input,
            function ($acc, $value) {
                return $acc + $value;
            },
            0
        );
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        $size = count($input);
        $frequency = 0;
        $reached = [];
        $i = 0;

        while (1) {
            $frequency += $input[$i % $size];

            if (!isset($reached[$frequency])) {
                $reached[$frequency] = 1;
            } else {
                return $frequency;
            }

            $i++;
        }
    }

}