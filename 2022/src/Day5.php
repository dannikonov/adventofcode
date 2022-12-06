<?php

namespace y2022;

use Common\Common;

class Day5 extends Common
{

    private $n;
    private $stacks = [];
    private $commands = [];

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 'CVCWCRTVQ', 2 => 'CNSCZWLVT']);
    }

    protected function parse_input()
    {
        $this->stacks = [];
        $this->commands = [];

        $all = $this->split_by_blank_line();

        $lines = $this->split_by_line($all[0]);
        $numbers = str_split(trim($lines[count($lines) - 1]));
        $this->n = intval($numbers[count($numbers) - 1]);
        for ($i = 1; $i <= $this->n; $i++) {
            $this->stacks[$i] = [];
        }

        for ($i = count($lines) - 2; $i >= 0; $i--) {
            $boxes = str_split($lines[$i], 4);
            foreach ($boxes as $index => $box) {
                if (trim($box)) {
                    $box = preg_replace(['/\[/', '/\]/'], ['', ''], trim($box));
                    $this->stacks[$index + 1][] = $box;
                }
            }
        }

        $commands = $this->split_by_line($all[1]);
        foreach ($commands as $command) {
            $c = [];
            preg_match('/move (\d*) from (\d*) to (\d*)/', $command, $c);
            $this->commands[] = new Command($c[1], $c[2], $c[3]);
        }
    }

    public function solution_1()
    {
        $this->parse_input();

        foreach ($this->commands as $command) {
            for ($i = 0; $i < $command->n; $i++) {
                $crate = array_pop($this->stacks[$command->from]);
                $this->stacks[$command->to][] = $crate;
            }
        }

        $tops = '';
        foreach ($this->stacks as $stack) {
            $tops .= $stack[count($stack) - 1];
        }

        return $tops;
    }

    public function solution_2()
    {
        $this->parse_input();

        foreach ($this->commands as $command) {
            $crates = array_splice($this->stacks[$command->from], -1 * $command->n);
            $this->stacks[$command->to] = array_merge($this->stacks[$command->to], $crates);
        }

        $tops = '';
        foreach ($this->stacks as $stack) {
            $tops .= $stack[count($stack) - 1];
        }

        return $tops;
    }

}

class Command
{
    public $n;
    public $from;
    public $to;

    function __construct($n, $from, $to)
    {
        $this->n = $n;
        $this->from = $from;
        $this->to = $to;
    }
}