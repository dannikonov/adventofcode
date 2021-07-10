<?php


namespace y2019;

use Common\Common;

class Day4 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 495, 2 => 305]);
    }

    private function is_password_valid($password)
    {
        $password = strval($password);
        if (strlen($password) === 6) {
            if (preg_match('/(\d)\1+/', $password)) {
                for ($i = 1; $i < strlen($password); $i++) {
                    if ($password[$i - 1] > $password[$i]) {
                        return false;
                    }
                }

                return true;
            }
        }

        return false;
    }

    private function is_password_valid_2($password)
    {
        $password = strval($password);
        if (strlen($password) == 6) {
            for ($i = 1; $i < strlen($password); $i++) {
                if ($password[$i - 1] > $password[$i]) {
                    return false;
                }
            }

            if (preg_match_all('/(\d)\1+/', $password, $matches)) {
                foreach ($matches[0] as $match) {
                    if (strlen($match) === 2) {
                        return true;
                    }
                }

                return false;
            }
        }
        return false;
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    public function solution_1()
    {
        $input = $this->parse_input();
        list($min, $max) = explode('-', $input);

        $count = 0;
        for ($i = $min; $i <= $max; $i++) {
            $count += $this->is_password_valid($i);
        }

        return $count;
    }

    public function solution_2()
    {
        $input = $this->parse_input();
        list($min, $max) = explode('-', $input);

        $count = 0;
        for ($i = $min; $i <= $max; $i++) {
            $count += $this->is_password_valid_2($i);
        }

        return $count;
    }

}