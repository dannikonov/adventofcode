<?php

namespace y2020;

use Common\Common;

class Day14 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 7997531787333, 2 => 3564822193820]);
    }

    private function apply_mask($mask, $target)
    {
        foreach ($mask as $position => $value) {
            $target[$position] = $value;
        }

        return $target;
    }

    private function get_address_list($address)
    {
        if (($pos = strpos($address, 'X')) === false) {
            return [bindec($address)];
        } else {
            return [
                ...$this->get_address_list(substr_replace($address, 0, $pos, 1)),
                ...$this->get_address_list(substr_replace($address, 1, $pos, 1)),
            ];
        }
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $lines = $this->parse_input();

        $mem = [];
        $mask = '';
        foreach ($lines as $line) {
            if (preg_match('/^mask = ([01X]*)$/', $line, $matches)) {
                $mask = array_filter(
                    str_split($matches[1]),
                    static function ($item) {
                        return $item !== 'X';
                    }
                );
            } else {
                if ($mask) {
                    if (preg_match('/^mem\[(\d+)\] = (\d*)$/', $line, $matches)) {
                        list(, $address, $value) = $matches;
                        $value = str_pad(decbin($value), 36, '0', STR_PAD_LEFT);
                        $mem[$address] = bindec($this->apply_mask($mask, $value));
                    }
                }
            }
        }

        return array_sum($mem);
    }

    public function solution_2()
    {
        $lines = $this->parse_input();

        $mem = [];
        $mask = '';
        foreach ($lines as $line) {
            if (preg_match('/^mask = ([01X]*)$/', $line, $matches)) {
                $mask = $matches[1];
            } else {
                if ($mask) {
                    if (preg_match('/^mem\[(\d+)\] = (\d*)$/', $line, $matches)) {
                        list(, $address, $value) = $matches;
                        $address = str_pad(decbin($address), 36, '0', STR_PAD_LEFT);

                        $address_mask = array_filter(
                            str_split($mask),
                            static function ($item) {
                                return $item !== '0';
                            }
                        );

                        $address = $this->apply_mask($address_mask, $address);
                        foreach ($this->get_address_list($address) as $address) {
                            $mem[$address] = $value;
                        }
                    }
                }
            }
        }

        return array_sum($mem);
    }
}