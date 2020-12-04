<?php


namespace y2019;

use Common\Common;

class Day3 extends Common
{
    private $x = 0;
    private $y = 0;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 865, 2 => 35038]);
    }

    private function draw_wire($commands, &$wire)
    {
        $x = 0;
        $y = 0;
        $total_steps = 0;
        foreach ($this->split_by_comma($commands) as $command) {
            preg_match('/(.)(\d*)/', $command, $matches);
            list(, $direction, $steps) = $matches;

            $dx = 0;
            $dy = 0;
            switch ($direction) {
                case 'D':
                    $dy = 1;
                    break;
                case 'U':
                    $dy = -1;
                    break;
                case 'R':
                    $dx = 1;
                    break;
                case 'L':
                    $dx = -1;
                    break;
            }

            for ($i = 0; $i < $steps; $i++) {
                $x += $dx;
                $y += $dy;
                $total_steps++;
                $coord = "{$x},{$y}";
                if (!isset($wire[$coord])) {
                    $wire[$coord] = $total_steps;
                }
            }
        }
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $wires = [];
        foreach ($this->parse_input() as $index => $commands) {
            $this->draw_wire($commands, $wires[$index]);
        }

        $intersections = array_intersect_key($wires[0], $wires[1]);
        $min = INF;

        foreach (array_keys($intersections) as $intersection) {
            $cur = array_sum(array_map('abs', explode(',', $intersection)));
            if ($cur < $min) {
                $min = $cur;
            }
        }

        return $min;
    }

    public function solution_2()
    {
        $wires = [];
        foreach ($this->parse_input() as $index => $commands) {
            $this->draw_wire($commands, $wires[$index]);
        }

        $intersections = array_intersect_key($wires[0], $wires[1]);
        $min = INF;

        foreach (array_keys($intersections) as $intersection) {
            $cur = $wires[0][$intersection] + $wires[1][$intersection];
            if ($cur < $min) {
                $min = $cur;
            }
        }

        return $min;
    }

}