<?php

namespace y2016;

use Common\Common;

class Day7 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 118, 2 => 260]);
    }

    private function is_support_tls($ip)
    {
        $is_hypernet = false;
        $found = false;

        $length = strlen($ip) - 3;
        $c = str_split($ip);

        for ($i = 0; $i < $length; $i++) {
            if ($c[$i] === '[') {
                $is_hypernet = true;
                continue;
            }

            if ($c[$i] === ']') {
                $is_hypernet = false;
                continue;
            }

            if ($c[$i] === $c[$i + 3] && $c[$i + 1] === $c[$i + 2] && $c[$i] !== $c[$i + 1]) {
                if ($is_hypernet) {
                    return false;
                }

                $found = true;
            }
        }

        return $found;
    }

    private function is_support_ssl($ip)
    {
        $is_hypernet = false;

        $aba_list = [];
        $bab_list = [];

        $length = strlen($ip) - 2;
        $c = str_split($ip);

        for ($i = 0; $i < $length; $i++) {
            if ($c[$i] === '[') {
                $is_hypernet = true;
                continue;
            }

            if ($c[$i] === ']') {
                $is_hypernet = false;
                continue;
            }

            if ($c[$i + 1] !== '[' && $c[$i + 1] !== ']') {
                if ($c[$i] === $c[$i + 2] && $c[$i] !== $c[$i + 1]) {
                    if ($is_hypernet) {
                        $bab_list[] = join('', [$c[$i], $c[$i + 1]]);
                    } else {
                        $aba_list[] = join('', [$c[$i + 1], $c[$i]]);
                    }
                }
            }
        }

        return count(array_intersect($bab_list, $aba_list));
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();
        array_unique($lines);

        return $lines;
    }

    public function solution_1()
    {
        $ips = $this->parse_input();
        $filtered = array_filter(
            $ips,
            function ($ip) {
                return $this->is_support_tls($ip);
            }
        );

        return count($filtered);
    }

    public function solution_2()
    {
        $ips = $this->parse_input();
        $filtered = array_filter(
            $ips,
            function ($ip) {
                return $this->is_support_ssl($ip);
            }
        );

        return count($filtered);
    }

}