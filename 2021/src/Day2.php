<?php

namespace y2021;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1459206, 2 => 1320534480]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $commands = $this->parse_input();

        $x = 0;
        $y = 0;

        foreach ($commands as $command) {
            preg_match('/(forward|down|up) (\d*)/', trim($command), $operands);

            if ($operands[1] == 'forward') {
                $x += $operands[2];
            }

            if ($operands[1] == 'up') {
                $y -= $operands[2];
            }

            if ($operands[1] == 'down') {
                $y += $operands[2];
            }
        }

        return $x * $y;
    }

    public function solution_2()
    {
        $commands = $this->parse_input();

        $x = 0;
        $y = 0;
        $aim = 0;

        foreach ($commands as $command) {
            preg_match('/(forward|down|up) (\d*)/', trim($command), $operands);

            if ($operands[1] == 'forward') {
                $x += $operands[2];
                $y += $aim * $operands[2];
            }

            if ($operands[1] == 'up') {
                $aim -= $operands[2];
            }

            if ($operands[1] == 'down') {
                $aim += $operands[2];
            }
        }
        return $x * $y;
    }

}