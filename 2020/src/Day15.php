<?php

namespace y2020;

use Common\Common;

class Day15 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => -1, 2 => -1]);
    }

    protected function parse_input()
    {
        return array_map('intval', $this->split_by_comma());
    }

    public function solution_1()
    {
        $numbers = array_reverse($this->parse_input());


        while (2020 !== count($numbers)) {
            $tail = array_shift($numbers);
            if (($prev = array_search($tail, $numbers)) !== false) {
                array_unshift($numbers, $tail);
                array_unshift($numbers, $prev + 1);
            } else { // first time spoken
                array_unshift($numbers, $tail);
                array_unshift($numbers, 0);
            }
        }

        return $numbers[0];
    }

    public function solution_2()
    {
        $numbers = $this->parse_input();

        $used = [];
        foreach ($numbers as $index => $number) {
            $used[$number] = [$index + 1];
        }

        $numbers = array_reverse($numbers);



        $i = count($numbers) + 1;
        while (30000000 !== count($numbers)) {
            $last = $numbers[0];
            if (isset($used[$last][0], $used[$last][1])) {
                $current = $used[$last][0] - $used[$last][1];
            } else {
                $current = 0;
            }


            array_unshift($numbers, $current);
            if (!isset($used[$current])) {
                $used[$current] = [];
            }
            array_unshift($used[$current], $i);


            $i++;
        }

        return $numbers[0];
    }
}