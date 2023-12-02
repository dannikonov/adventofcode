<?php

namespace y2023;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 2331, 2 => 71585]);
    }

    protected function parse_input()
    {
        $games = [];
        $lines = $this->split_by_line();

        foreach ($lines as $line) {
            $matches = [];
            preg_match('/^Game (\d+):(.*)/', $line, $matches);
            $n = $matches[1];
            $sets = explode(';', $matches[2]);

            foreach ($sets as $set) {
                $cubes = explode(',', $set);

                $attempt = [
                    'red' => 0,
                    'green' => 0,
                    'blue' => 0
                ];

                foreach ($cubes as $cube) {
                    $part = explode(' ', trim($cube));
                    $attempt[$part[1]] = intval($part[0]);
                }

                $games[$n][] = $attempt;
            }
        }

        return $games;
    }

    public function solution_1()
    {
        $games = $this->parse_input();
        $possibleGames = array_filter($games, function ($game) {
            $possible = true;
            foreach ($game as $cubes) {
                if ($cubes['red'] > 12 || $cubes['green'] > 13 || $cubes['blue'] > 14) {
                    $possible = false;
                    break;
                }
            }

            return $possible;
        });

        return array_sum(array_keys($possibleGames));
    }

    public function solution_2()
    {
        $games = $this->parse_input();
        $pows = [];

        foreach ($games as $game) {
            $max = [
                'red' => 0,
                'green' => 0,
                'blue' => 0
            ];

            foreach ($game as $cubes) {
                if ($max['red'] < $cubes['red']) {
                    $max['red'] = $cubes['red'];
                }
                if ($max['green'] < $cubes['green']) {
                    $max['green'] = $cubes['green'];
                }
                if ($max['blue'] < $cubes['blue']) {
                    $max['blue'] = $cubes['blue'];
                }
            }

            $pows[] = array_reduce($max, function ($acc, $item) {
                $acc *= $item;

                return $acc;
            }, 1);
        }

        return array_sum($pows);
    }


}