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
        $this->set_answer([1 => -1, 2 => -1]);
    }

    protected function parse_input()
    {
        $this->numbers = $this->split_by_comma($this->get_line());

        $boards = $this->split_by_blank_line();
        unset($boards[0]);
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

        $i = 0;
        $is_winner = false;
        while (!$is_winner && $i < count($this->numbers)) {

        }

        return 0;
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        return 0;
    }

    private function is_board_win($board) {

    }
}