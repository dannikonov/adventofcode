<?php

namespace y2020;

use Common\Common;

class Day10 extends Common
{

    public function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1848, 2 => 8099130339328]);
    }

    protected function parse_input()
    {
        $adapters = $this->split_by_line();

        array_walk(
            $adapters,
            static function (&$value) {
                $value = (int)$value;
            }
        );

        sort($adapters);

        return $adapters;
    }

    public function solution_1()
    {
        $diff_1_cnt = 0;
        $diff_3_cnt = 0;

        $prev = 0;

        $adapters = $this->parse_input();

        foreach ($adapters as $adapter) {
            if ($adapter - $prev <= 3) {
                if ($adapter - $prev === 1) {
                    $diff_1_cnt++;
                }

                if ($adapter - $prev === 3) {
                    $diff_3_cnt++;
                }

                $prev = $adapter;
            }
        }

        $diff_3_cnt++;

        return $diff_1_cnt * $diff_3_cnt;
    }

    public function solution_2()
    {
        $adapters = $this->parse_input();
        $combinations_map = array_fill_keys($adapters, 0);
        $combinations_map[0] = 1;
        $last = max($adapters) + 3;
        $combinations_map[$last] = 0;

        foreach ($combinations_map as $adapter => &$combinations) {
            if ($adapter === 0) {
                continue;
            }

            for ($i = 1; $i <= 3; $i++) {
                if (isset($combinations_map[$adapter - $i])) {
                    $combinations += $combinations_map[$adapter - $i];
                }
            }
        }

        return $combinations_map[$last];
    }
}
