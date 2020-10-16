<?php

namespace y2018;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 6696, 2 => "bvnfawcnyoeyudzrpgslimtkj"]);
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        $m2 = $m3 = 0;

        foreach ($input as $id) {
            $matches = [];
            for ($i = 0; $i < strlen($id); $i++) {
                $c = $id[$i];
                if (key_exists($id[$i], $matches)) {
                    $matches[$c]++;
                } else {
                    $matches[$c] = 1;
                }
            }

            $flag_m2 = false;
            $flag_m3 = false;

            foreach ($matches as $m) {
                $flag_m2 |= ($m == 2);
                $flag_m3 |= ($m == 3);
            }

            $m2 += (int)$flag_m2;
            $m3 += (int)$flag_m3;
        }

        return $m2 * $m3;
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        for ($i = 0; $i < count($input) / 2; $i++) {
            $found = false;
            for ($j = 0; $j < count($input); $j++) {
                if ($i != $j) {
                    if (levenshtein($input[$i], $input[$j]) == 1) {
                        $found = true;
                        break;
                    };
                }
            }

            if ($found) {
                $result = "";
                for ($c = 0; $c < strlen($input[$i]); $c++) {
                    if ($input[$i][$c] == $input[$j][$c]) {
                        $result .= $input[$i][$c];
                    }
                }
                return $result;
            }
        }
    }

}