<?php

namespace y2023;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 56049, 2 => 54530]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();
        $values = [];

        foreach ($lines as $line) {
            $digits = [];
            preg_match_all('/[0-9]/', $line, $digits);
            $digits = $digits[0];
            $values[] = 10 * $digits[0] + $digits[count($digits) - 1];
        }

        return array_sum($values);
    }

    public function solution_2()
    {
        $lines = $this->parse_input();
        $values = [];

        $convert = function ($value) {
            switch ($value) {
                case 'one': return 1;
                case 'two': return 2;
                case 'three': return 3;
                case 'four': return 4;
                case 'five': return 5;
                case 'six': return 6;
                case 'seven': return 7;
                case 'eight': return 8;
                case 'nine': return 9;
                default:
                    return intval($value);
            }
        };

        foreach ($lines as $line) {
            $digits = [];
            preg_match('/.*([0-9]|one|two|three|four|five|six|seven|eight|nine).*$/U', $line, $digits);
            $begin = $convert($digits[1]);
            preg_match('/.*([0-9]|one|two|three|four|five|six|seven|eight|nine).*$/', $line, $digits);
            $end = $convert($digits[1]);

            $values[] = $begin * 10 + $end;
        }

        return array_sum($values);
    }

}