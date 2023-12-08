<?php

namespace y2023;

use Common\Common;

class Day5 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 178159714, 2 => 10378710]);
    }

    protected function parse_input()
    {
        $maps = [];
        $tmp = $this->split_by_blank_line();

        preg_match_all('/\d+/', $tmp[0], $seeds);

        for ($i = 1; $i < count($tmp); $i++) {
            $lines = explode("\n", $tmp[$i]);

            $map = [];
            for ($j = 1; $j < count($lines); $j++) {
                $map[] = $this->split_line_by_space($lines[$j]);
            }

            $maps[] = $map;
        }

        return [$seeds[0], $maps];
    }

    public function solution_1()
    {
        list($seeds, $maps) = $this->parse_input();

        foreach ($seeds as &$seed) {
            foreach ($maps as $map) {
                for ($m = 0; $m < count($map); $m++) {
                    list($dst, $src, $length) = $map[$m];

                    if ($src <= $seed && $seed <= $src + $length) {
                        $seed = $seed - $src + $dst;
                        break;
                    }
                }
            }
        }

        return min($seeds);
    }

    public function solution_2()
    {
        list($seeds, $maps) = $this->parse_input();

        $seedRanges = [];
        for ($i = 0; $i < count($seeds); $i += 2) {
            $seedRanges[] = [$seeds[$i], $seeds[$i + 1]];
        }

        $min = INF;
//        foreach ($seedRanges as $seedRange) {
//            for ($i = 0; $i < $seedRange[1]; $i++) {
//                $seed = $seedRange[0] + $i;
////
//                foreach ($maps as $map) {
//                    for ($m = 0; $m < count($map); $m++) {
//                        list($dst, $src, $length) = $map[$m];
//
//                        if ($src <= $seed) {
//                            if ($seed <= $src + $length) {
//                                $seed = $seed - $src + $dst;
//                                break;
//                            }
//                        } else {
//
//                        }
//                    }
//                }
//            }
////
//            echo $min . PHP_EOL;
////
//        }
//        }


        return $min;
    }

}
