<?php

namespace y2020;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 436404, 2 => 274879808]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $values = $this->parse_input();

        foreach ($values as $value) {
            if (in_array(2020 - $value, $values, false)) {
                return $value * (2020 - $value);
            }
        }

        return 0;
    }

    public function solution_2()
    {
        $values = $this->parse_input();
        $cnt = count($values);

        for ($i = 0; $i < $cnt; $i++) {
            for ($j = $i; $j < $cnt; $j++) {
                if ($i === $j) {
                    continue;
                }

                if ($values[$i] + $values[$j] < 2020) {
                    $sum = $values[$i] + $values[$j];

                    if (in_array(2020 - $sum, $values, false)) {
                        return $values[$i] * $values[$j] * (2020 - $sum);
                    }
                }
            }
        }
    }

}