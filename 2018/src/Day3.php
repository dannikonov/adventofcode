<?php

namespace y2018;

use Common\Common;

class Day3 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 105071, 2 => "222"]);
    }

    private function parse_claims($strings)
    {
        $claims = [];
        foreach ($strings as $string) {
            preg_match('/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/', $string, $matches);
            $claims[] = [
                'id' => $matches[1],
                'padding' => ['left' => $matches[2], 'top' => $matches[3]],
                'area' => ['wide' => $matches[4], 'tall' => $matches[5]]
            ];
        }

        return $claims;
    }

    protected function parse_input()
    {
        $input = $this->split_by_line();
        return $this->parse_claims($input);
    }

    public function solution_1()
    {
        $claims = $this->parse_input();
        $matrix = [];

        foreach ($claims as $claim) {
            $px = $claim['padding']['left'];
            $py = $claim['padding']['top'];

            for ($y = 0; $y < $claim['area']['tall']; $y++) {
                for ($x = 0; $x < $claim['area']['wide']; $x++) {
                    if (isset($matrix[$y + $py][$x + $px])) {
                        $matrix[$y + $py][$x + $px] = '#';
                    } else {
                        $matrix[$y + $py][$x + $px] = '.';
                    }
                }
            }
        }

        return array_reduce(
            $matrix,
            static function ($acc, $row) {
                return $acc + array_reduce(
                        $row,
                        static function ($carry, $value) {
                            return $carry + ($value === '#' ? 1 : 0);
                        },
                        0
                    );
            },
            0
        );
    }

    public function solution_2()
    {
        $claims = $this->parse_input();
        $matrix = [];

        foreach ($claims as $claim) {
            $px = $claim['padding']['left'];
            $py = $claim['padding']['top'];

            for ($y = 0; $y < $claim['area']['tall']; $y++) {
                for ($x = 0; $x < $claim['area']['wide']; $x++) {
                    $matrix[$y + $py][$x + $px][] = $claim['id'];
                }
            }
        }

        $all_claim_ids = array_map(
            static function ($claim) {
                return $claim['id'];
            },
            $claims
        );


        $intersections = [];
        foreach ($matrix as $row) {
            foreach ($row as $claim_ids) {
                if (count($claim_ids) > 1) {
                    array_push($intersections, ...$claim_ids);
                }
            }
        }

        $intersections = array_unique($intersections);

        $diff = array_diff($all_claim_ids, $intersections);
        return array_pop($diff);
    }

}