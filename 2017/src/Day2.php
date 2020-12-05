<?php

namespace y2017;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 45158, 2 => 294]);
    }

    private function checksum($spreadsheet)
    {
        return array_sum(
            array_map(
                static function ($row) {
                    return max($row) - min($row);
                },
                $spreadsheet
            )
        );
    }

    private function edv($spreadsheet)
    {
        return array_sum(
            array_map(
                function ($row) {
                    $length = count($row);
                    for ($i = 0; $i < $length; $i++) {
                        for ($j = 0; $j < $length; $j++) {
                            if ($i !== $j) {
                                if ($row[$i] % $row[$j] === 0) {
                                    return $row[$i] / $row[$j];
                                }
                            }


                        }
                    }
                },
                $spreadsheet
            )
        );
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $spreadsheet = $this->parse_input();
        foreach ($spreadsheet as &$row) {
            $row = $this->split_line_by_space($row);
        }

        return $this->checksum($spreadsheet);
    }

    public function solution_2()
    {
        $spreadsheet = $this->parse_input();
        foreach ($spreadsheet as &$row) {
            $row = $this->split_line_by_space($row);
        }

        return $this->edv($spreadsheet);
    }

}