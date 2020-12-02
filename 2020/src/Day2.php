<?php

namespace y2020;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 416, 2 => 688]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    private function validate_1($row)
    {
        $parts = $this->split_line_by_space($row);
        list($min, $max) = explode('-', $parts[0]);
        $char = substr($parts[1], 0, 1);

        preg_match_all("/{$char}/", $parts[2], $matches);
        $cnt = count($matches[0]);

        if ($min <= $cnt && $cnt <= $max) {
            return true;
        }

        return false;
    }

    private function validate_2($row)
    {
        $parts = $this->split_line_by_space($row);
        list($pos_1, $pos_2) = explode('-', $parts[0]);
        $char = substr($parts[1], 0, 1);

        $char_1 = $parts[2][$pos_1 - 1];
        $char_2 = $parts[2][$pos_2 - 1];

        return ($char_1 !== $char_2 && ($char === $char_1 || $char === $char_2));
    }

    public function solution_1()
    {
        $list = $this->parse_input();
        $cnt = 0;
        foreach ($list as $line) {
            if ($this->validate_1($line)) {
                $cnt++;
            }
        }

        return $cnt;
    }

    public function solution_2()
    {
        $list = $this->parse_input();
        $cnt = 0;
        foreach ($list as $line) {
            if ($this->validate_2($line)) {
                $cnt++;
            }
        }

        return $cnt;
    }

}