<?php

namespace y2015;

use Common\Common;

class Day4 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 117946, 2 => 3938038]);
    }

    private function find($secret, $start_with)
    {
        for ($i = 0; $i < 999999999; $i++) {
            $hash = md5($secret . $i);
            if (strpos($hash, $start_with) === 0) {
                return $i;
            }
        }
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $secret = $this->parse_input();
        return $this->find($secret, '00000');
    }

    public function solution_2()
    {
        $secret = $this->parse_input();
        return $this->find($secret, '000000');
    }

}