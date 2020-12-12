<?php

namespace y2020;

use Common\Common;

class Day11 extends Common
{
    private $cols;
    private $rows;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 2489, 2 => 2180]);
    }

    private function need_change_seat_1($map, $x, $y)
    {
        $occupied = 0;
        for ($dy = -1; $dy <= 1; $dy++) {
            for ($dx = -1; $dx <= 1; $dx++) {
                if ($dx === 0 && $dy === 0) {
                    continue;
                }

                if (isset($map[$y + $dy][$x + $dx])) {
                    $occupied += $map[$y + $dy][$x + $dx] === '#';
                }
            }
        }

        if ($map[$y][$x] === '#') {
            return $occupied >= 4;
        }

        if ($map[$y][$x] === 'L') {
            return $occupied === 0;
        }

        return false;
    }

    private function need_change_seat_2($map, $x, $y)
    {
        $occupied = 0;

        for ($dy = -1; $dy <= 1; $dy++) {
            for ($dx = -1; $dx <= 1; $dx++) {
                if ($dx === 0 && $dy === 0) {
                    continue;
                }

                for ($r = 1; isset($map[$y + $r * $dy][$x + $r * $dx]); $r++) {
                    if ($map[$y + $r * $dy][$x + $r * $dx] === 'L') {
                        break;
                    }

                    if ($map[$y + $r * $dy][$x + $r * $dx] === '#') {
                        $occupied++;
                        break;
                    }
                }
            }
        }

        if ($map[$y][$x] === '#') {
            return $occupied >= 5;
        }

        if ($map[$y][$x] === 'L') {
            return $occupied === 0;
        }

        return false;
    }

    private function update_map($map, $callback)
    {
        $new_map = $map;
        for ($y = 0; $y < $this->rows; $y++) {
            for ($x = 0; $x < $this->cols; $x++) {
                if ($map[$y][$x] === '#') {
                    if ($callback($map, $x, $y)) {
                        $new_map[$y][$x] = 'L';
                    }
                }
                if ($map[$y][$x] === 'L') {
                    if ($callback($map, $x, $y)) {
                        $new_map[$y][$x] = '#';
                    }
                }
            }
        }


        return $new_map;
    }

    private function print_map($map)
    {
        for ($y = 0; $y < $this->rows; $y++) {
            for ($x = 0; $x < $this->cols; $x++) {
                echo $map[$y][$x];
            }
            echo "\n";
        }
    }

    private function calc_occupied($map)
    {
        $occupied = 0;
        for ($y = 0; $y < $this->rows; $y++) {
            for ($x = 0; $x < $this->cols; $x++) {
                if ($map[$y][$x] === '#') {
                    $occupied++;
                }
            }
        }

        return $occupied;
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $map = [];
        foreach ($lines as $line) {
            $map[] = str_split($line);
        }

        $this->rows = count($map);
        $this->cols = count($map[0]);

        return $map;
    }

    public function solution_1()
    {
        $map = $this->parse_input();
        while (1) {
            $new_map = $this->update_map(
                $map,
                function ($map, $x, $y) {
                    return $this->need_change_seat_1($map, $x, $y);
                }
            );
            if ($new_map === $map) {
                return $this->calc_occupied($map);
            }
            $map = $new_map;
        }
    }

    public function solution_2()
    {
        $map = $this->parse_input();
        while (1) {
            $new_map = $this->update_map(
                $map,
                function ($map, $x, $y) {
                    return $this->need_change_seat_2($map, $x, $y);
                }
            );
            if ($new_map === $map) {
                return $this->calc_occupied($map);
            }
            $map = $new_map;
        }
    }
}