<?php

namespace y2016;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 53255, 2 => "7423A"]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();

        $code = '';
        $matrix = [
            [1, 2, 3],
            [4, 5, 6],
            [7, 8, 9]
        ];
        $col = $row = 1;
        foreach ($lines as $line) {
            $commands = str_split($line);
            foreach ($commands as $command) {
                switch ($command) {
                    case 'U':
                        if ($row > 0) {
                            $row--;
                        }
                        break;
                    case 'R':
                        if ($col < 2) {
                            $col++;
                        }
                        break;
                    case 'D':
                        if ($row < 2) {
                            $row++;
                        }
                        break;
                    case 'L':
                        if ($col > 0) {
                            $col--;
                        }
                        break;
                }
            }
            $code .= $matrix[$row][$col];
        }

        return $code;
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        $code = '';
        $matrix = [
            [0, 0, 1, 0, 0],
            [0, 2, 3, 4, 0],
            [5, 6, 7, 8, 9],
            [0, 'A', 'B', 'C', 0],
            [0, 0, 'D', 0, 0]
        ];
        $col = 0;
        $row = 2;
        foreach ($lines as $line) {
            $commands = str_split($line);
            foreach ($commands as $command) {
                switch ($command) {
                    case 'U':
                        if ($row > 0 && $matrix[$row - 1][$col] !== 0) {
                            $row--;
                        }
                        break;
                    case 'R':
                        if ($col < 4 && $matrix[$row][$col + 1] !== 0) {
                            $col++;
                        }
                        break;
                    case 'D':
                        if ($row < 4 && $matrix[$row + 1][$col] !== 0) {
                            $row++;
                        }
                        break;
                    case 'L':
                        if ($col > 0 && $matrix[$row][$col - 1] !== 0) {
                            $col--;
                        }
                        break;
                }
            }
            $code .= $matrix[$row][$col];
        }

        return $code;
    }

}