<?php

namespace y2015;

use Common\Common;

class Day5 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 258, 2 => 53]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $list = $this->parse_input();

        $nice = array_filter(
            $list,
            static function ($string) {
                preg_match_all('/[aeiou]/', $string, $matches);
                if (count($matches[0]) < 3) {
                    return false;
                }

                if (!preg_match('/(.)(\1)/', $string)) {
                    return false;
                }

                if (preg_match('/ab|cd|pq|xy/', $string)) {
                    return false;
                }

                return true;
            }
        );

        return count($nice);
    }

    public function solution_2()
    {
        $list = $this->parse_input();

        $nice = array_filter(
            $list,
            static function ($string) {
                if (!preg_match('/(\w\w).*\1+/', $string, $matches)) {
                    return false;
                }

                if (!preg_match('/(\w)\w\1/', $string)) {
                    return false;
                }
                return true;
            }
        );

        return count($nice);
    }

}