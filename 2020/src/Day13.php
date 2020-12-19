<?php

namespace y2020;

use Common\Common;

class Day13 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 2238, 2 => 560214575859998]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();
        $ts = $lines[0];
        $bus_id_list = array_filter(
            explode(',', $lines[1]),
            static function ($value) {
                return $value !== 'x';
            }
        );

        $nearest = INF;
        $nearest_bus_id = 0;
        foreach ($bus_id_list as $bus_id) {
            $cur = (\intdiv($ts, $bus_id) + 1) * $bus_id;
            if ($cur < $nearest) {
                $nearest = $cur;
                $nearest_bus_id = $bus_id;
            }
        }

        return ($nearest - $ts) * $nearest_bus_id;
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        $bus_id_list = explode(',', $lines[1]);

        $ts = 0;
        $add = 1;
        $offset = 0;

        while (true) {
            if ($bus_id_list[$offset] === 'x') {
                $offset++;
                continue;
            }

            if (($ts + $offset) % $bus_id_list[$offset] === 0) {
                $add *= $bus_id_list[$offset];
                $offset++;
            }

            if (count($bus_id_list) === $offset) {
                break;
            }
            $ts += $add;
        }

        return $ts;
    }
}