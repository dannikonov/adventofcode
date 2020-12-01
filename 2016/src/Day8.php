<?php

namespace y2016;

use Common\Common;

class Day8 extends Common
{
    private $w;
    private $h;
    private $screen;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 106, 2 => "CFLELOYFCS"]);
    }

    private function init_screen($w, $h)
    {
        $this->w = $w;
        $this->h = $h;

        $this->screen = array_fill(0, $this->h, array_fill(0, $this->w, 0));
    }

    private function rect($w, $h)
    {
        for ($y = 0; $y < $h; $y++) {
            for ($x = 0; $x < $w; $x++) {
                $this->screen[$y][$x] = 1;
            }
        }
    }

    private function rotate_column($x, $v)
    {
        $buffer = [];
        for ($y = 0; $y < $this->h; $y++) {
            $buffer[$y] = $this->screen[$y][$x];
        }

        for ($y = 0; $y < $this->h; $y++) {
            $this->screen[($y + $v) % $this->h][$x] = $buffer[$y];
        }
    }

    private function rotate_row($y, $v)
    {
        $buffer = [];
        for ($x = 0; $x < $this->w; $x++) {
            $buffer[$x] = $this->screen[$y][$x];
        }

        for ($x = 0; $x < $this->w; $x++) {
            $this->screen[$y][($x + $v) % $this->w] = $buffer[$x];
        }
    }

    public function print_screen()
    {
        for ($y = 0; $y < $this->h; $y++) {
            for ($x = 0; $x < $this->w; $x++) {
                echo $this->screen[$y][$x]
                    ? "|"
                    : " ";
            }
            echo "\n";
        }
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();

        $commands = [];
        foreach ($lines as $line) {
            $command = explode(" ", $line);

            if ($command[0] === "rect") {
                list($w, $h) = explode('x', $command[1]);
                $commands[] = ["rect", intval($w), intval($h)];
            }

            if ($command[0] === "rotate") {
                $command_name = "rotate_" . $command[1];
                $object = explode("=", $command[2])[1];

                $commands[] = [$command_name, intval($object), intval($command[4])];
            }
        }

        return $commands;
    }

    public function solution_1()
    {
        $commands = $this->parse_input();
        $this->init_screen(50, 6);
        foreach ($commands as $command) {
            $exec = $command[0];
            $this->$exec($command[1], $command[2]);
        }

        $counter = 0;
        for ($y = 0; $y < $this->h; $y++) {
            for ($x = 0; $x < $this->w; $x++) {
                $counter += $this->screen[$y][$x];
            }
        }

        return $counter;
    }

    public function solution_2()
    {
        $this->solution_1();
        $this->print_screen();

        return "CFLELOYFCS";
    }

}