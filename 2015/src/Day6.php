<?php


namespace y2015;

use Common\Common;

class Day6 extends Common
{
    const X = 1000;
    const Y = 1000;

    private $grid;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 377891, 2 => 14110788]);
    }

    protected function parse_input()
    {
        $lines = $this->split_by_line();
        $regexp = '/(turn on|turn off|toggle) (\d*),(\d*) through (\d*),(\d*)/';

        foreach ($lines as $line) {
            preg_match($regexp, $line, $c);
            $command = [];
            list(, $command['action'], $command['x1'], $command['y1'], $command['x2'], $command['y2']) = $c;
            $commands[] = $command;
        }


        return $commands;
    }

    private function init_grid()
    {
        $row = array_fill(0, self::X, 0);
        $this->grid = array_fill(0, self::Y, $row);
    }

    private function run_command_1($command)
    {
        for ($y = $command['y1']; $y <= $command['y2']; $y++) {
            for ($x = $command['x1']; $x <= $command['x2']; $x++) {
                switch ($command['action']) {
                    case 'turn on':
                        $this->grid[$y][$x] = true;
                        break;
                    case 'turn off':
                        $this->grid[$y][$x] = false;
                        break;
                    case 'toggle':
                        $this->grid[$y][$x] = !$this->grid[$y][$x];
                        break;
                }
            }
        }
    }

    private function run_command_2($command)
    {
        for ($y = $command['y1']; $y <= $command['y2']; $y++) {
            for ($x = $command['x1']; $x <= $command['x2']; $x++) {
                switch ($command['action']) {
                    case 'turn on':
                        $this->grid[$y][$x]++;
                        break;
                    case 'turn off':
                        $this->grid[$y][$x]--;
                        if ($this->grid[$y][$x] < 0) {
                            $this->grid[$y][$x] = 0;
                        }
                        break;
                    case 'toggle':
                        $this->grid[$y][$x] += 2;
                        break;
                }
            }
        }
    }

    protected function count_lights()
    {
        return array_reduce(
            $this->grid,
            function ($count, $row) {
                return $count + array_reduce(
                        $row,
                        function ($count, $light) {
                            return $count + (int)$light;
                        },
                        0
                    );
            },
            0
        );
    }

    public function solution_1()
    {
        $commands = $this->parse_input();
        $this->init_grid();

        foreach ($commands as $command) {
            $this->run_command_1($command);
        }

        return $this->count_lights();
    }

    function solution_2()
    {
        $commands = $this->parse_input();
        $this->init_grid();

        foreach ($commands as $command) {
            $this->run_command_2($command);
        }

        return $this->count_lights();
    }
}