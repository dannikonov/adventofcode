<?php

namespace y2016;

use Common\Common;

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 983, 2 => 1836]);
    }

    private function is_valid_triangle($triangle)
    {
        usort(
            $triangle,
            function ($a, $b) {
                return $b - $a;
            }
        );

        return $triangle[0] < $triangle[1] + $triangle[2];
    }

    private function transpose($lines)
    {
        $list = [];
        for ($c = 0; $c < 3; $c++) {
            $list[$c] = [];

            for ($r = 0; $r < count($lines); $r++) {
                $list[$c][$r] = $lines[$r][$c];
            }
        }

        return $list;
    }

    private function make_list($lines)
    {
        $list = array_reduce(
            $this->transpose($lines),
            function ($acc, $value) {
                return array_merge($acc, $value);
            },
            []
        );

        $result_list = [];
        for ($i = 0; $i < count($list); $i += 3) {
            $result_list[] = array_slice($list, $i, 3);
        }

        return $result_list;
    }

    protected function parse_input()
    {
        $input = $this->split_by_line();

        return array_map(
            function ($line) {
                return $this->split_line_by_space($line);
            },
            $input
        );
    }

    public function solution_1()
    {
        $triangles = $this->parse_input();

        $filtered = array_filter(
            $triangles,
            function ($triangle) {
                return $this->is_valid_triangle($triangle);
            }
        );

        return count($filtered);
    }

    public function solution_2()
    {
        $triangles = $this->parse_input();

        $filtered = array_filter(
            $this->make_list($triangles),
            function ($triangle) {
                return $this->is_valid_triangle($triangle);
            }
        );

        return count($filtered);
    }

}