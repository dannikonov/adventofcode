<?php

namespace y2016;

use Common\Common;

class Day9 extends Common
{
    private $w;
    private $h;
    private $screen;

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 123908, 2 => 10755693147]);
    }

    protected function parse_input()
    {
        return $this->get_line();
    }

    private function decompress($input)
    {
        $decompressed_l = 0;

        while ($input !== '') {
            preg_match('/\(((\d*)x(\d*))\)/', $input, $matches);
            if ($matches) {
                list($marker, , $chars, $repeat) = $matches;
                $marker_length = strlen($marker);
                $marker_pos = strpos($input, $marker);
                $text_after_marker_pos = $marker_pos + $marker_length;

                $decompressed_l += $marker_pos;
                $decompressed_l += $repeat * $chars;

                $input = substr($input, $text_after_marker_pos + $chars);
            } else {
                break;
            }
        }

        $decompressed_l += strlen($input);

        return $decompressed_l;
    }

    private function decompress_recursive($input)
    {
        $decompressed_l = 0;

        while ($input !== '') {
            preg_match('/\(((\d*)x(\d*))\)/', $input, $matches);
            if ($matches) {
                list($marker, , $chars, $repeat) = $matches;
                $marker_length = strlen($marker);
                $marker_pos = strpos($input, $marker);
                $text_after_marker_pos = $marker_pos + $marker_length;

                $decompressed_l += $marker_pos;

                $data_to_repeat = substr($input, $text_after_marker_pos, $chars);
                $decompressed_l += $repeat * $this->decompress_recursive($data_to_repeat);

                $input = substr($input, $text_after_marker_pos + $chars);
            } else {
                break;
            }
        }

        $decompressed_l += strlen($input);

        return $decompressed_l;
    }

    public function solution_1()
    {
        $input = $this->parse_input();

        return $this->decompress($input);
    }

    public function solution_2()
    {
        $input = $this->parse_input();

        return $this->decompress_recursive($input);
    }

}