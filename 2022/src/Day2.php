<?php

namespace y2022;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 13809, 2 => 12316]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $score = 0;
        $rounds = $this->parse_input();
        foreach ($rounds as $round) {
            list($opponent, $player) = $this->split_line_by_space($round);
            $score += $this->round($opponent, $player);
        }

        return $score;
    }

    public function solution_2()
    {
        $score = 0;
        $rounds = $this->parse_input();
        foreach ($rounds as $round) {
            list($opponent, $player) = $this->split_line_by_space($round);
            $score += $this->round2($opponent, $player);
        }

        return $score;
    }

    private function cost($v)
    {
        return [
            'A' => 1,
            'B' => 2,
            'C' => 3,
            'X' => 1,
            'Y' => 2,
            'Z' => 3
        ][$v];
    }

    private function cost2($v)
    {
        return [
            'X' => 0,
            'Y' => 3,
            'Z' => 6
        ][$v];
    }

    private function round($opponent, $player)
    {
        $round = $this->cost($player);
        if ($this->cost($opponent) === $this->cost($player)) {
            $round += 3;
        } else {
            if ($player === 'X' && $opponent === 'C') {
                $round += 6;
            }
            if ($player === 'Y' && $opponent === 'A') {
                $round += 6;
            }
            if ($player === 'Z' && $opponent === 'B') {
                $round += 6;
            }
        }

        return $round;
    }

    private function round2($opponent, $result)
    {
        if ($this->cost2($result) == 3) {
            return $this->cost($opponent) + 3;
        }

        $player = 0;
        if ($opponent === 'A') {
            $player = $this->cost2($result) ? 'Y' : 'Z';
        }

        if ($opponent === 'B') {
            $player = $this->cost2($result) ? 'Z' : 'X';
        }

        if ($opponent === 'C') {
            $player = $this->cost2($result) ? 'X' : 'Y';
        }

        return $this->cost2($result) + $this->cost($player);
    }

}