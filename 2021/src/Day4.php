<?php

namespace y2021;

use Common\Common;

class Day4 extends Common
{
    private $numbers = [];
    private $boards = [];

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 28082, 2 => 8224]);
    }

    protected function parse_input()
    {
        $this->numbers = $this->split_by_comma($this->get_line());

        $boards = $this->split_by_blank_line();
        unset($boards[0]);
        $this->boards = [];
        foreach ($boards as $board) {
            $this->boards[] = array_map(function ($line) {
                return $this->split_line_by_space($line);
            }, $this->split_by_line($board));
        }

        return true;
    }

    public function solution_1()
    {
        $this->parse_input();

        $i = 1;
        foreach ($this->numbers as $number) {
            $this->mark_number($number);
            if ($i > 5) {
                foreach ($this->boards as $board) {
                    if ($this->is_board_win($board)) {
                        return $number * $this->board_sum($board);
                    }
                }
            }
            $i++;
        }

        return 0;
    }

    public function solution_2()
    {
        $this->parse_input();

        $i = 1;
        foreach ($this->numbers as $number) {
            $this->mark_number($number);
            if ($i > 5) {
                if (count($this->boards) === 1) {
                    $sum = $this->board_sum($this->boards[0]);
                }
                $this->boards = array_values(
                    array_filter($this->boards, function ($board) {
                        return !$this->is_board_win($board);
                    })
                );
                if (count($this->boards) === 0) {
                    return $sum * $number;
                }
            }
            $i++;
        }

        return 0;
    }

    private function is_board_win($board)
    {
        for ($i = 0; $i < 5; $i++) {
            if ($this->is_row_complete($board, $i)) {
                return true;
            }

            if ($this->is_col_complete($board, $i)) {
                return true;
            }
        }

        return false;
    }

    private function is_row_complete($board, $r)
    {
        for ($i = 0; $i < 5; $i++) {
            if (isset($board[$r][$i])) {
                return false;
            } else {
                echo $board[$r][$i];
            }
        }

        return true;
    }

    private function is_col_complete($board, $c)
    {
        for ($i = 0; $i < 5; $i++) {
            if (isset($board[$i][$c])) {
                return false;
            }
        }

        return true;
    }

    private function mark_number($value)
    {
        foreach ($this->boards as &$board) {
            for ($r = 0; $r < 5; $r++) {
                for ($c = 0; $c < 5; $c++) {
                    if ($board[$r][$c] == $value) {
                        $board[$r][$c] = null;
                    }
                }
            }
        }
    }

    private function board_sum($board)
    {
        $sum = 0;
        for ($r = 0; $r < 5; $r++) {
            for ($c = 0; $c < 5; $c++) {
                if (isset($board[$r][$c])) {
                    $sum += $board[$r][$c];
                }
            }
        }

        return $sum;
    }

    private function debug($board)
    {
        for ($r = 0; $r < 5; $r++) {
            for ($c = 0; $c < 5; $c++) {
                echo ($board[$r][$c] ?? '-')." ";
            }

            echo "\n";
        }
    }
}