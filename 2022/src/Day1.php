<?php

namespace y2022;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 72718, 2 => 213089]);
    }

    protected function parse_input()
    {
        return $this->split_by_blank_line();
    }

    public function solution_1()
    {
        $elves = $this->parse_input();
        $elves = array_map(function ($elf) {
            return $this->split_by_line($elf);
        }, $elves);

        $sums = new \SplMaxHeap();
        foreach ($elves as $elf) {
            $sums->insert(array_sum($elf));
        }

        return $sums->top();
    }

    public function solution_2()
    {
        $elves = $this->parse_input();
        $elves = array_map(function ($elf) {
            return $this->split_by_line($elf);
        }, $elves);

        $sums = new \SplMaxHeap();
        foreach ($elves as $elf) {
            $sums->insert(array_sum($elf));
        }

        $sumTop3 = 0;
        for ($i = 0; $i < 3; $i++) {
            $sumTop3 += $sums->extract();
        }

        return $sumTop3;
    }

}