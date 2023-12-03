<?php

namespace y2023;

use Common\Common;

class Number
{
    public $x, $y, $count, $value;

    public function __construct($x, $y, $value)
    {
        $this->x = $x;
        $this->y = $y;
        $this->count = strlen($value);
        $this->value = intval($value);
    }
}

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 507214, 2 => 72553319]);
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $symbols = [];
        $numbers = [];

        foreach ($lines as $y => $line) {
            $chars = str_split($line);

            for ($x = 0; $x < count($chars); $x++) {
                if ($chars[$x] !== '.') {
                    if (is_numeric($chars[$x])) {
                        $number = '';

                        for ($fp = $x; $fp < count($chars) && is_numeric($chars[$fp]); $fp++) {
                            $number .= $chars[$fp];
                        }

                        $numbers[] = new Number($x, $y, $number);
                        $x = $fp - 1;
                    } else {
                        $symbols[$y][$x] = $chars[$x];
                    }
                }
            }
        }

        return [$numbers, $symbols];
    }

    public function solution_1()
    {
        list ($numbers, $symbols) = $this->parse_input();

        $sum = 0;
        foreach ($numbers as $number) {
            $adjacent = false;
            for ($r = $number->y - 1; $r <= $number->y + 1; $r++) {
                for ($c = $number->x - 1; !$adjacent && $c <= $number->x + $number->count; $c++) {
                    if (isset($symbols[$r][$c])) {
                        $adjacent = true;
                    }
                }
            }

            if ($adjacent) {
                $sum += $number->value;
            }
        }

        return $sum;
    }

    public function solution_2()
    {
        list ($numbers, $symbols) = $this->parse_input();

        $gears = [];
        foreach ($numbers as $number) {
            $adjacent = false;
            for ($r = $number->y - 1; $r <= $number->y + 1; $r++) {
                for ($c = $number->x - 1; !$adjacent && $c <= $number->x + $number->count; $c++) {
                    if (isset($symbols[$r][$c]) && $symbols[$r][$c] === '*') {
                        $gears[$r][$c][] = $number->value;
                    }
                }
            }
        }

        $ratios = [];
        foreach ($gears as $r => $c) {
            foreach ($c as $numbers) {
                if (count($numbers) > 1) {
                    $ratios[] = array_reduce($numbers, function ($acc, $item) {
                        $acc *= $item;

                        return $acc;
                    }, 1);
                }
            }
        }

        return array_sum($ratios);
    }

}
