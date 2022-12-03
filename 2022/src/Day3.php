<?php

namespace y2022;

use Common\Common;

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 7701, 2 => 2644]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $rucksacks = $this->parse_input();

        $sum = 0;
        foreach ($rucksacks as $rucksack) {
            $n = strlen($rucksack);
            list($compartment1, $compartment2) = str_split($rucksack, $n / 2);
            $compartment1 = str_split($compartment1);
            $compartment2 = str_split($compartment2);

            $shared = array_unique(array_intersect($compartment1, $compartment2));
            foreach ($shared as $item) {
                $sum += $this->priority($item);
            }
        }

        return $sum;
    }

    public function solution_2()
    {
        $rucksacks = $this->parse_input();

        $groups = [];
        $i = 0;
        foreach ($rucksacks as $rucksack) {
            $groups[intdiv($i,  3)][] = str_split($rucksack);
            $i++;
        }

        $sum = 0;
        foreach ($groups as $group) {
            $shared = array_unique(array_intersect(...$group));
            foreach ($shared as $item) {
                $sum += $this->priority($item);
            }
        }

        return $sum;
    }

    private function priority($item) {
        return ctype_upper($item)
            ? ord($item) - ord('A') + 27
            : ord($item) - ord('a') + 1;
    }

}