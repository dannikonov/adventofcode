<?php

namespace y2015;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 232, 2 => 1783]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        $floor = 0;
        foreach (str_split($input) as $command) {
            if ($command === '(') {
                $floor++;
            }

            if ($command === ')') {
                $floor--;
            }
        }

        return $floor;
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        $floor = 0;
        $i = 0;
        foreach (str_split($input) as $command) {
            if ($command === '(') {
                $floor++;
            }

            if ($command === ')') {
                $floor--;
            }
            $i++;
            if ($floor === -1) {
                return $i;
            }
        }

        return -1;
    }

}