<?php

namespace y2016;

use Common\Common;

class Day1 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 307, 2 => 165]);
    }

    protected function parse_input()
    {
        return $this->split_by_comma();
    }

    public function solution_1()
    {
        $commands = $this->parse_input();

        $x = 0;
        $y = 0;
        $direction = 0; // 0: North, 1: East, 2: South; 3: West

        foreach ($commands as $command) {
            preg_match('/([RL])(\d*)/', trim($command), $operands);

            if ($operands[1] == 'R') {
                $direction++;
            }

            if ($operands[1] == 'L') {
                $direction--;
            }

            $direction = ($direction + 4) % 4;

            switch ($direction) {
                case 0:
                    $y += $operands[2];
                    break;
                case 1:
                    $x += $operands[2];
                    break;
                case 2:
                    $y -= $operands[2];
                    break;
                case 3:
                    $x -= $operands[2];
                    break;
            }
        }
        return abs($x) + abs($y);
    }

    public function solution_2()
    {
        $commands = $this->parse_input();
        $x = 0;
        $y = 0;
        $direction = 0; // 0: North, 1: East, 2: South; 3: West

        $visited = [];
        array_push($visited, ["x" => $x, "y" => $y]);

        $result = 0;
        foreach ($commands as $command) {
            if ($result) {
                return $result;
            }

            preg_match('/([RL])(\d*)/', trim($command), $operands);

            if ($operands[1] == 'R') {
                $direction++;
            }

            if ($operands[1] == 'L') {
                $direction--;
            }

            $direction = ($direction + 4) % 4;
            for ($i = 0; $i < $operands[2]; $i++) {
                switch ($direction) {
                    case 0:
                        array_push($visited, ["x" => $x, "y" => ++$y]);
                        break;
                    case 1:
                        array_push($visited, ["x" => ++$x, "y" => $y]);
                        break;
                    case 2:
                        array_push($visited, ["x" => $x, "y" => --$y]);
                        break;
                    case 3:
                        array_push($visited, ["x" => --$x, "y" => $y]);
                        break;
                }

                for ($j = 0; $j < count($visited) - 1; $j++) {
                    if ($visited[$j]["x"] == $x && $visited[$j]["y"] == $y) {
                        $result = abs($x) + abs($y);
                    }
                }
            }
        }

        return $result;
    }

}