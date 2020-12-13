<?php

namespace y2020;

use Common\Common;

class Day12 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1221, 2 => 59435]);
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $commands = [];
        foreach ($lines as $line) {
            preg_match('/([NSEWLRF])(\d+)/', $line, $matches);

            $commands[] = [$matches[1], $matches[2]];
        }

        return $commands;
    }

    public function solution_1()
    {
        $commands = $this->parse_input();
        $direction = 'E';
        $x = $y = 0;

        $directions = ['N', 'E', 'S', 'W'];
        $target = ['N' => 'dy', 'E' => 'dx', 'S' => 'dy', 'W' => 'dx'];
        $signs = ['N' => -1, 'E' => 1, 'S' => 1, 'W' => -1, 'R' => 1, 'L' => -1];

        foreach ($commands as list($operator, $operand)) {
            $dx = $dy = 0;
            if ($operator === 'R' || $operator === 'L') {
                $sign = $signs[$operator];
                $index = array_search($direction, $directions);
                $index += ($sign * $operand) / 90 + 4;
                $index %= 4;

                $direction = $directions[$index];
            } else {
                if ($operator === 'F') {
                    $sign = $signs[$direction];
                    $tmp_direction = $target[$direction];
                } else {
                    $sign = $signs[$operator];
                    $tmp_direction = $target[$operator];
                }

                $$tmp_direction += $sign * $operand;
            }

            $x += $dx;
            $y += $dy;
        }

        return abs($x) + abs($y);
    }

    public function solution_2()
    {
        $commands = $this->parse_input();
        $waypoint = ['x' => 10, 'y' => -1];
        $x = $y = 0;

        $target = ['N' => 'dy', 'E' => 'dx', 'S' => 'dy', 'W' => 'dx'];
        $signs = ['N' => -1, 'E' => 1, 'S' => 1, 'W' => -1, 'R' => 1, 'L' => -1];

        foreach ($commands as list($operator, $operand)) {
            $dx = $dy = 0;

            if ($operator === 'F') {
                $x += $waypoint['x'] * $operand;
                $y += $waypoint['y'] * $operand;
            } elseif ($operator === 'R' || $operator === 'L') {
                $deg = deg2rad($signs[$operator] * $operand);

                $waypoint = [
                    'x' => $waypoint['x'] * cos($deg) - $waypoint['y'] * sin($deg),
                    'y' => $waypoint['x'] * sin($deg) + $waypoint['y'] * cos($deg)
                ];
            } else {
                $sign = $signs[$operator];
                $tmp_direction = $target[$operator];

                $$tmp_direction += $sign * $operand;
                $waypoint['x'] += $dx;
                $waypoint['y'] += $dy;
            }
        }

        return abs($x) + abs($y);
    }
}