<?php

namespace y2019;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 3514064, 2 => 5268207]);
    }

    private function get_fuel($mass)
    {
        return floor($mass / 3) - 2;
    }

    private function get_fuel_rec($mass)
    {
        $fuel = $this->get_fuel($mass);

        if ($fuel <= 0) {
            return 0;
        } else {
            return $fuel + $this->get_fuel_rec($fuel);
        }
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();
        return array_reduce(
            $input,
            function ($acc, $mass) {
                return $acc + $this->get_fuel($mass);
            },
            0
        );
    }

    public function solution_2()
    {
        $input = $this->parse_input();
        return array_reduce(
            $input,
            function ($acc, $mass) {
                return $acc + $this->get_fuel_rec($mass);
            },
            0
        );
    }

}