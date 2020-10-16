<?php


namespace y2019;

use Common\Common;

class Day2 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 3516593, 2 => 7749]);
    }

    private function calc($input, $noun, $verb)
    {
        $input[1] = $noun;
        $input[2] = $verb;

        $i = 0;
        while ($i < count($input)) {
            if (array_key_exists($i, $input) && $input[$i] === 99) {
                break;
            } else {
                if (array_key_exists($i, $input) && $input[$i] === 1) {
                    $input[$input[$i + 3]] = $input[$input[$i + 1]] + $input[$input[$i + 2]];
                    $i += 4;
                } elseif (array_key_exists($i, $input) && $input[$i] === 2) {
                    $input[$input[$i + 3]] = $input[$input[$i + 1]] * $input[$input[$i + 2]];
                    $i += 4;
                } else {
                    $i++;
                }
            }
        }

        return $input[0];
    }


    protected function parse_input()
    {
        $values = $this->split_by_comma();
        array_walk(
            $values,
            function (&$value) {
                $value = intval($value);
            }
        );

        return $values;
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        return $this->calc($input, 12, 2);
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        for ($noun = 0; $noun < 100; $noun++) {
            for ($verb = 0; $verb < 100; $verb++) {
                if ($this->calc($input, $noun, $verb) === 19690720) {
                    return 100 * $noun + $verb;
                }
            }
        }
    }

}