<?php

namespace y2017;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1102, 2 => 1076]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        $captcha = str_split($input);
        $length = count($captcha);

        $sum = 0;

        for ($i = 0; $i < $length; $i++) {
            if ($captcha[$i] === $captcha[($i + 1) % $length]) {
                $sum += $captcha[$i];
            }
        }
        return $sum;
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        $captcha = str_split($input);
        $length = count($captcha);
        $steps = $length / 2;

        $sum = 0;

        for ($i = 0; $i < $length; $i++) {
            if ($captcha[$i] === $captcha[($i + $steps) % $length]) {
                $sum += $captcha[$i];
            }
        }

        return $sum;
    }

}