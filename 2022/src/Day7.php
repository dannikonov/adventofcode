<?php

namespace y2022;

use Common\Common;

class Day7 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1667443, 2 => 8998590]);
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $dirs = [];
        $currentPath = [];
        $cur = reset($lines);
        while ($cur) {
            $m = [];
            if (preg_match('/\$ cd (.*)/', $cur, $m)) {
                $v = $m[1];
                if ($v === '/') {
                    $currentPath = [];
                } else {
                    if ($v === '..') {
                        array_pop($currentPath);
                    } else {
                        $currentPath[] = $v;
                    }
                }
            }

            if (preg_match('/^(\d*) (.*)/', $cur, $m)) {
                $path = implode('', ['', ...$currentPath]);
                $dirs[$path] = $dirs[$path] ?? 0;
                $dirs[''] = $dirs[''] ?? 0;

                if (!isset($dirs[$path . '/' . $m[2]])) {
                    $dirs[$path . '/' . $m[2]] = 0;
                    $dirs[''] += $m[1];

                    for ($i = 0; $i < count($currentPath); $i++) {
                        $p = implode('', array_slice(['', ...$currentPath], 0, $i + 2));
                        $dirs[$p] = $dirs[$p] ?? 0;
                        $dirs[$p] += $m[1];
                    }
                }
            }

            $cur = next($lines);
        }

        $dirs = array_filter($dirs, function ($item) {
            return !!$item;
        });

        ksort($dirs);

        return $dirs;
    }

    public function solution_1()
    {
        $dirs = $this->parse_input();

        return array_sum(
            array_filter($dirs, function ($item) {
                return $item && $item < 100000;
            })
        );
    }

    public function solution_2()
    {
        $dirs = $this->parse_input();

        $total = 70000000;
        $required = 30000000;
        $toDelete = abs($total - $required - $dirs['']);

        return min(
            array_filter($dirs, function ($item) use ($toDelete) {
                return $item >= $toDelete;
            })
        );
    }

}