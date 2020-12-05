<?php

namespace y2020;

use Common\Common;

class Day5 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 911, 2 => 629]);
    }

    private function decode($pass)
    {
        return bindec(str_replace(['F', 'B', 'L', 'R'], [0, 1, 0, 1], $pass));
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $pass_list = $this->parse_input();
        $ids = [];
        foreach ($pass_list as $pass) {
            $ids[] = $this->decode($pass);
        }

        return max($ids);
    }

    public function solution_2()
    {
        $pass_list = $this->parse_input();
        $ids = [];
        foreach ($pass_list as $pass) {
            $ids[] = $this->decode($pass);
        }

        sort($ids);
        $cnt = count($ids);
        for ($i = 0; $i < $cnt - 1; $i++) {
            if ($ids[$i] + 1 !== $ids[$i + 1]) {
                return $ids[$i] + 1;
            }
        }
    }
}


