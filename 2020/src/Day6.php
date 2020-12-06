<?php

namespace y2020;

use Common\Common;

class Day6 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 6726, 2 => 3316]);
    }

    protected function parse_input()
    {
        return $this->split_by_blank_line();
    }

    public function solution_1()
    {
        $all_answers = $this->parse_input();

        $group_answers = [];
        $i = 0;
        foreach ($all_answers as $answers) {
            foreach ($this->split_by_line($answers) as $str) {
                foreach (str_split($str) as $answer) {
                    if (!isset($group_answers[$i][$answer])) {
                        $group_answers[$i][$answer] = 0;
                    }
                    $group_answers[$i][$answer]++;
                }
            }
            $i++;
        }

        $cnt = array_map(
            static function ($answer) {
                return count($answer);
            },
            $group_answers
        );

        return array_sum($cnt);
    }

    public function solution_2()
    {
        $all_answers = $this->parse_input();

        $group_answers = [];
        $i = 0;
        foreach ($all_answers as $answers) {
            $people = 0;
            foreach ($this->split_by_line($answers) as $str) {
                $people++;
                foreach (str_split($str) as $answer) {
                    if (!isset($group_answers[$i][$answer])) {
                        $group_answers[$i][$answer] = 0;
                    }
                    $group_answers[$i][$answer]++;
                }
            }

            $group_answers[$i] = array_filter(
                $group_answers[$i],
                static function ($value) use ($people) {
                    return $value === $people;
                }
            );

            $i++;
        }

        $cnt = array_map(
            static function ($answer) {
                return count($answer);
            },
            $group_answers
        );

        return array_sum($cnt);
    }
}


