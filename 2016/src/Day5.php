<?php

namespace y2016;

use Common\Common;

class Day5 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => "4543c154", 2 => "1050cbbd"]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $door_id = $this->parse_input();

        $password = null;
        for ($i = 0; $i < 99999999, strlen($password) < 8; $i++) {
            $hash = md5($door_id . $i);
            if (substr($hash, 0, 5) === "00000") {
                $password .= substr($hash, 5, 1);
            }
        }

        return $password;
    }

    public function solution_2()
    {
        $door_id = $this->parse_input();

        $password = array_fill(0, 8, false);
        $empty = count($password);

        for ($i = 0; $i < 999999999, $empty > 0; $i++) {
            $hash = md5($door_id . $i);
            if (substr($hash, 0, 5) === "00000") {
                $position = substr($hash, 5, 1);
                if (preg_match('/[0-7]/', $position)) {
                    if ($password[$position] === false) {
                        $password[$position] = substr($hash, 6, 1);
                        $empty--;
                    }
                }
            }
        }

        return join('', $password);
    }

}