<?php

namespace y2020;

use Common\Common;

class Day9 extends Common
{
    const PREAMBULA = 25;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 776203571, 2 => 104800569]);
    }

    private function validate($i, $numbers)
    {
        $list = array_slice($numbers, $i - self::PREAMBULA, self::PREAMBULA);
        foreach ($list as $value) {
            if (in_array($numbers[$i] - $value, $list, true)) {
                return true;
            }
        }

        return false;
    }

    private function find_sum($numbers, $offset, $target)
    {
        $sum = 0;
        $i = 0;
        while ($sum < $target) {
            $sum += $numbers[$offset + $i++];
        }

        if ($sum === $target) {
            $values = array_slice($numbers, $offset, $i);

            return min($values) + max($values);
        }

        return 0;
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $numbers = $this->parse_input();
        array_walk(
            $numbers,
            static function (&$value) {
                $value = (int)$value;
            }
        );

        $length = count($numbers);

        for ($i = self::PREAMBULA; $i < $length; $i++) {
            if (!$this->validate($i, $numbers)) {
                return $numbers[$i];
            }
        }

        return -1;
    }

    public function solution_2()
    {
        $numbers = $this->parse_input();

        $target = $this->solution_1();
        $offset = 0;
        while (!($result = $this->find_sum($numbers, $offset, $target))) {
            $offset++;
        }

        return $result;
    }
}
