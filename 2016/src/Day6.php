<?php

namespace y2016;

use Common\Common;

class Day6 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => "nabgqlcw", 2 => "ovtrjcjh"]);
    }

    protected function parse_input()
    {
        $columns = array_fill(0, 8, []);

        foreach ($this->split_by_line() as $line) {
            foreach (str_split($line) as $index => $char) {
                if (!array_key_exists($char, $columns[$index])) {
                    $columns[$index][$char] = 0;
                }
                $columns[$index][$char]++;
            }
        }

        return $columns;
    }

    public function solution_1()
    {
        $columns = $this->parse_input();

        return join(
            '',
            array_map(
                function ($column) {
                    asort($column);
                    $keys = array_keys($column);
                    return array_pop($keys);
                },
                $columns
            )
        );
    }

    public function solution_2()
    {
        $columns = $this->parse_input();

        return join(
            '',
            array_map(
                function ($column) {
                    arsort($column);
                    $keys = array_keys($column);
                    return array_pop($keys);
                },
                $columns
            )
        );
    }

}