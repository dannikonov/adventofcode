<?php

namespace y2021;

use Common\Common;

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 3320834, 2 => 4481199]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();

        $gamma_rate = $this->gamma($lines);

        $epsilon_rate = $this->invert($gamma_rate);


        return bindec($gamma_rate) * bindec($epsilon_rate);
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        $oxygen_lines = $co2_lines = $lines;
        $gamma_rate = $this->gamma($lines);
        $epsilon_rate = $this->epsion($lines);
        $i = 0;

        while ($i < strlen($gamma_rate)) {
            if (count($oxygen_lines) !== 1) {
                $bit = $gamma_rate[$i];
                $oxygen_lines = array_filter($oxygen_lines, function ($line) use ($i, $bit) {
                    return $line[$i] === $bit;
                });
                $gamma_rate = $this->gamma($oxygen_lines);
            }

            if (count($co2_lines) !== 1) {
                $bit = $epsilon_rate[$i];
                $co2_lines = array_filter($co2_lines, function ($line) use ($i, $bit) {
                    return $line[$i] === $bit;
                });
                $epsilon_rate = $this->epsion($co2_lines);
            }
            $i++;
        }
        
        return bindec(array_pop($oxygen_lines)) * bindec(array_pop($co2_lines));
    }

    private function gamma($lines)
    {
        $bits = [];
        foreach ($lines as $line) {
            foreach (str_split($line) as $i => $bit) {
                $bits[$i][] = $bit;
            }
        }

        return array_reduce($bits, function ($carry, $item) {
            return $carry . round($this->avg($item));
        },                  '');
    }

    private function epsion($lines)
    {
        return $this->invert($this->gamma($lines));
    }

    private function invert($gamma_rate)
    {
        return array_reduce(str_split($gamma_rate), function ($carry, $item) {
            return $carry . ($item ? 0 : 1);
        },                  '');
    }
}