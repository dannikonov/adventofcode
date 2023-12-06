<?php

namespace y2023;

use Common\Common;

class Day4 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 19855, 2 => 10378710]);
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $cards = [];
        foreach ($lines as $line) {
            $numbers = [];
            preg_match('/^Card[ \d]+: ([ \d]*) \| ([ \d]*)$/', $line, $numbers);
            $numbers[1] = str_replace('  ', ' ', trim($numbers[1]));
            $numbers[2] = str_replace('  ', ' ', trim($numbers[2]));
            $cards[] = [explode(' ', $numbers[1]), explode(' ', $numbers[2])];
        }

        return $cards;
    }

    public function solution_1()
    {
        $cards = $this->parse_input();

        $sum = 0;
        foreach ($cards as $i => $card) {
            $matches = array_intersect($card[0], $card[1]);
            if (count($matches)) {
                $sum += pow(2, count($matches) - 1);
            }
        }

        return $sum;
    }

    public function solution_2()
    {
        $cards = $this->parse_input();

        $matches = [];
        $copies = [];
        foreach ($cards as $i => $card) {
            $matches[$i] = count(array_intersect($card[0], $card[1]));
            $copies[$i] = 1;
        }

        $sum = 0;
        for ($i = 0; $i < count($cards); $i++) {
            if (isset($copies[$i])) {
                $sum += $copies[$i];
            }

            $inc = $copies[$i];
            for ($j = 1; $j <= $matches[$i]; $j++) {
                if (!isset($copies[$i + $j])) {
                    $copies[$i + $j] = 0;
                }
                $copies[$i + $j] += $inc;
            }
        }

        return $sum;
    }

}
