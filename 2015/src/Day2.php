<?php

namespace y2015;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1588178, 2 => 3783758]);
    }

    private function calc_box($dimensions)
    {
        list($l, $w, $h) = explode('x', $dimensions);

        $box = 2 * $l * $w + 2 * $w * $h + 2 * $h * $l;

        return $box + min(
                [
                    $l * $w,
                    $w * $h,
                    $h * $l
                ]
            );
    }

    private function calc_ribbon($dimensions)
    {
        $d = explode('x', $dimensions);
        sort($d);
        list($l, $w, $h) = $d;
        $wrap = 2 * $l + 2 * $w;
        $bow = $l * $w * $h;

        return $wrap + $bow;
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $result = 0;
        $presents = $this->parse_input();
        foreach ($presents as $dimensions) {
            $result += $this->calc_box($dimensions);
        }

        return $result;
    }

    public function solution_2()
    {
        $result = 0;
        $presents = $this->parse_input();
        foreach ($presents as $dimensions) {
            $result += $this->calc_ribbon($dimensions);
        }

        return $result;
    }

}