<?php

namespace y2020;

use Common\Common;

class Bag
{
    public $color;
    public $content;

    public function __construct($color = null, $content = [])
    {
        $this->color = $color;
        $this->content = $content;
    }
}

class Day7 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 238, 2 => 82930]);
    }

    private function parse_rule($rule)
    {
        preg_match('/([\w ]+) bags contain ([\w ,]+)/', $rule, $matches);
        list(, $color, $content_rules) = $matches;
        $content = [];
        foreach (explode(',', $content_rules) as $content_rule) {
            preg_match('/(\d+) ([\w ]+) bags?$/', $content_rule, $matches);
            if ($matches) {
                $content[$matches[2]] = $matches[1];
            } else {
                $content = [];
            }
        }

        return new Bag($color, $content);
    }

    private function calc($arg, $bags)
    {
        $sum = 0;

        foreach ($bags[$arg]->content as $color => $value) {
            $sum += $value + $value * $this->calc($color, $bags);
        }

        return $sum;
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $rules = $this->parse_input();

        $bags = [];
        foreach ($rules as $rule) {
            $bag = $this->parse_rule($rule);
            $bags[$bag->color] = $bag;
        }

        $contain = [];
        $q = new \SplQueue();
        $q->enqueue($bags['shiny gold']);

        while (!$q->isEmpty()) {
            $search = $q->dequeue();

            foreach ($bags as $bag) {
                if (array_key_exists($search->color, $bag->content)) {
                    $contain[$bag->color] = 1;
                    $q->enqueue($bag);
                }
            }
        }

        return count($contain);
    }

    public function solution_2()
    {
        $rules = $this->parse_input();

        $bags = [];
        foreach ($rules as $rule) {
            $bag = $this->parse_rule($rule);
            $bags[$bag->color] = $bag;
        }

        return $this->calc('shiny gold', $bags);
    }
}
