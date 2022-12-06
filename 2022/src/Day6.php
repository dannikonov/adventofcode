<?php

namespace y2022;

use Common\Common;

class Day6 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1109, 2 => 3965]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();

        foreach ($lines as $line) {
            $line = str_split($line);
            $i = 0;
            while ($i < count($line) - 3) {
                $window = array_slice($line, $i, 4);
                $freq = $this->freq_map($window);

                if (count(array_keys($freq)) === 4) {
                    return $i + 4;
                }

                $i++;
            }
        }
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        foreach ($lines as $line) {
            $line = str_split($line);
            $i = 0;
            while ($i < count($line) - 13) {
                $window = array_slice($line, $i, 14);
                $freq = $this->freq_map($window);

                if (count(array_keys($freq)) === 14) {
                    return $i + 14;
                }

                $i++;
            }
        }
    }

    private function freq_map($arr)
    {
        $freq = [];
        foreach ($arr as $c) {
            $freq[$c] = $freq[$c] ?? 0;
            $freq[$c]++;
        }

        return $freq;
    }

}