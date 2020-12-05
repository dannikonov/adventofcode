<?php

namespace y2015;

use Common\Common;

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 2565, 2 => 2639]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $commands = $this->parse_input();
        $visited = [];
        $x = $y = 0;

        $visited['0,0'] = 1;
        foreach (str_split($commands) as $command) {
            $dx = 0;
            $dy = 0;
            switch ($command) {
                case 'v':
                    $dy = 1;
                    break;
                case '^':
                    $dy = -1;
                    break;
                case '>':
                    $dx = 1;
                    break;
                case '<':
                    $dx = -1;
                    break;
            }

            $x += $dx;
            $y += $dy;
            $coord = "{$x},{$y}";
            if (!isset($visited[$coord])) {
                $visited[$coord] = 1;
            }
        }

        return count($visited);
    }

    public function solution_2()
    {
        $commands = $this->parse_input();
        $visited = [];
        $x[0] = $x[1] = 0;
        $y[0] = $y[1] = 0;

        $visited['0,0'] = $visited['0,0'] = 1;
        $i = 0;
        foreach (str_split($commands) as $command) {
            $n = $i % 2;
            $dx = 0;
            $dy = 0;
            switch ($command) {
                case 'v':
                    $dy = 1;
                    break;
                case '^':
                    $dy = -1;
                    break;
                case '>':
                    $dx = 1;
                    break;
                case '<':
                    $dx = -1;
                    break;
            }

            $x[$n] += $dx;
            $y[$n] += $dy;
            $coord = "{$x[$n]},{$y[$n]}";
            if (!isset($visited[$coord])) {
                $visited[$coord] = 1;
            }
            $i++;
        }

        return count($visited);
    }

}