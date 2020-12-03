<?php

namespace y2020;

use Common\Common;

class Day3 extends Common
{

    private $map;
    private $x;
    private $y;
    private $w;
    private $h;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 234, 2 => 5813773056]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    private function next_step($step_x, $step_y)
    {
        $this->x = ($this->x + $step_x) % $this->w;
        $this->y += $step_y;
    }

    private function checkMap()
    {
        return $this->y < $this->h;
    }

    private function checkObject()
    {
        if (!$this->checkMap()) {
            return false;
        }

        return $this->map[$this->y][$this->x] === '#';
    }

    private function traverse($step_x, $step_y)
    {
        $this->x = 0;
        $this->y = 0;
        $cnt = 0;

        while (1) {
            if (!$this->checkMap()) {
                return $cnt;
            }

            if ($this->checkObject()) {
                $cnt++;
            }

            $this->next_step($step_x, $step_y);
        }
    }

    public function solution_1()
    {
        $this->map = $this->parse_input();

        $this->h = count($this->map);
        $this->w = strlen($this->map[0]);

        return $this->traverse(3, 1);
    }

    public function solution_2()
    {
        $this->map = $this->parse_input();

        $this->x = 0;
        $this->y = 0;

        $this->h = count($this->map);
        $this->w = strlen($this->map[0]);

        $cnt = [];
        $cnt[] = $this->traverse(1, 1);
        $cnt[] = $this->traverse(3, 1);
        $cnt[] = $this->traverse(5, 1);
        $cnt[] = $this->traverse(7, 1);
        $cnt[] = $this->traverse(1, 2);

        return array_reduce(
            $cnt,
            static function ($acc, $item) {
                return $acc * $item;
            },
            1
        );
    }
}