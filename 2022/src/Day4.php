<?php

namespace y2022;

use Common\Common;

class Day4 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 526, 2 => 886]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $pairs = $this->parse_input();

        $cnt = 0;
        foreach ($pairs as $pair) {
            list($r1, $r2) = explode(',', $pair);
            $r1 = explode('-', $r1);
            $r2 = explode('-', $r2);

            if ($r1[0] === $r2[0] || $r1[1] === $r2[1]) {
                $cnt++;
            } else {
                if ($r1[0] < $r2[0] ? $r2[1] < $r1[1] : $r1[1] < $r2[1]) {
                    $cnt++;
                }
            }
        }

        return $cnt;
    }

    public function solution_2()
    {
        $pairs = $this->parse_input();

        $cnt = 0;
        foreach ($pairs as $pair) {
            list($r1, $r2) = explode(',', $pair);
            $r1 = explode('-', $r1);
            $r2 = explode('-', $r2);

            $cnt += (max($r1[0], $r2[0])) <= (min($r1[1], $r2[1]));
        }

        return $cnt;
    }

}