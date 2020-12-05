<?php

namespace y2017;

use Common\Common;
use http\Params;

class Day3 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 480, 2 => 349975]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $target = $this->parse_input();

        $matrix = [];
        $x = $y = 0;
        $direction = 'R';

        for ($i = 1; $i < $target; $i++) {
            $matrix[$y][$x] = $i;
            if ($i > 1) {
                if (($direction === 'R') && (!isset($matrix[$y - 1][$x]))) {
                    $direction = 'U';
                } elseif ($direction === 'U' && !isset($matrix[$y][$x - 1])) {
                    $direction = 'L';
                } elseif ($direction === 'L' && !isset($matrix[$y + 1][$x])) {
                    $direction = 'D';
                } elseif ($direction === 'D' && !isset($matrix[$y][$x + 1])) {
                    $direction = 'R';
                }
            }

            switch ($direction) {
                case 'R':
                    $x++;
                    break;
                case 'U':
                    $y--;
                    break;
                case 'L':
                    $x--;
                    break;
                case 'D':
                    $y++;
                    break;
            }
        }

        return abs($x) + abs($y);
    }

    public function solution_2()
    {
        $target = $this->parse_input();

        $matrix = [];
        $x = $y = 0;
        $direction = 'R';

        for ($i = 1; ; $i++) {
            $neighbours = 0;

            if (isset($matrix[$y])) {
                $neighbours += isset($matrix[$y][$x + 1]) ?
                    $matrix[$y][$x + 1] : 0;
                $neighbours += isset($matrix[$y][$x - 1]) ?
                    $matrix[$y][$x - 1] : 0;
            }

            if (isset($matrix[$y - 1])) {
                $neighbours += isset($matrix[$y - 1][$x + 1]) ?
                    $matrix[$y - 1][$x + 1] : 0;
                $neighbours += isset($matrix[$y - 1][$x]) ?
                    $matrix[$y - 1][$x] : 0;
                $neighbours += isset($matrix[$y - 1][$x - 1]) ?
                    $matrix[$y - 1][$x - 1] : 0;
            }

            if (isset($matrix[$y + 1])) {
                $neighbours += isset($matrix[$y + 1][$x + 1]) ?
                    $matrix[$y + 1][$x + 1] : 0;
                $neighbours += isset($matrix[$y + 1][$x]) ?
                    $matrix[$y + 1][$x] : 0;
                $neighbours += isset($matrix[$y + 1][$x - 1]) ?
                    $matrix[$y + 1][$x - 1] : 0;
            }

            if ($neighbours > $target) {
                return $neighbours;
            }

            $matrix[$y][$x] = $i === 1
                ? 1
                : $neighbours;


            if ($i > 1) {
                if (($direction === 'R') && (!isset($matrix[$y - 1][$x]))) {
                    $direction = 'U';
                } elseif ($direction === 'U' && !isset($matrix[$y][$x - 1])) {
                    $direction = 'L';
                } elseif ($direction === 'L' && !isset($matrix[$y + 1][$x])) {
                    $direction = 'D';
                } elseif ($direction === 'D' && !isset($matrix[$y][$x + 1])) {
                    $direction = 'R';
                }
            }

            switch ($direction) {
                case 'R':
                    $x++;
                    break;
                case 'U':
                    $y--;
                    break;
                case 'L':
                    $x--;
                    break;
                case 'D':
                    $y++;
                    break;
            }
        }

        return abs($x) + abs($y);
    }

}