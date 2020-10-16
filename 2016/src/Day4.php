<?php

namespace y2016;

use Common\Common;

class Day4 extends Common
{

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 158835, 2 => 993]);
    }

    private function checksum($room)
    {
        $chars = [];
        foreach (str_split($room["name"]) as $char) {
            if ($char != '-') {
                if (!array_key_exists($char, $chars)) {
                    $chars[$char] = 0;
                }
                $chars[$char]++;
            }
        }

        $arr_chars = [];
        foreach ($chars as $char => $freq) {
            $arr_chars[] = ["char" => $char, "freq" => $freq];
        }

        usort(
            $arr_chars,
            function ($a, $b) {
                return $a["freq"] < $b["freq"]
                    ? 1
                    : ($a["freq"] > $b["freq"]
                        ? -1
                        : ($a["char"] > $b["char"]
                            ? 1
                            : -1));
            }
        );

        $arr_chars = array_map(
            function ($value) {
                return $value["char"];
            },
            $arr_chars
        );

        return join("", array_slice($arr_chars, 0, 5));
    }

    private function is_valid_room($room)
    {
        return $room["checksum"] == $this->checksum($room);
    }

    private function cypher($char, $dist)
    {
        // 97 - ascii(a)
        // 26 - letters between a - z
        return chr((ord($char) - 97 + $dist) % 26 + 97);
    }

    private function decrypt($room)
    {
        return join(
            '',
            array_map(
                function ($char) use ($room) {
                    return $char === '-'
                        ? ' '
                        : $this->cypher($char, $room["sector_id"]);
                },
                str_split($room["name"])
            )
        );
    }

    protected function parse_input()
    {
        $regexp = "/([a-z-]+?)-(\d+)\[([a-z]{5})\]/";

        return array_map(
            function ($room) use ($regexp) {
                preg_match($regexp, $room, $matches);
                return [
                    "name" => $matches[1],
                    "sector_id" => intval($matches[2]),
                    "checksum" => $matches[3]
                ];
            },
            $this->split_by_line()
        );
    }

    public function solution_1()
    {
        $rooms = $this->parse_input();
        $filtered = array_filter(
            $rooms,
            function ($room) {
                return $this->is_valid_room($room);
            }
        );

        return array_reduce(
            $filtered,
            function ($acc, $cur) {
                return $acc + $cur["sector_id"];
            }
        );
    }

    public function solution_2()
    {
        $rooms = $this->parse_input();
        $filtered = array_filter(
            $rooms,
            function ($room) {
                return $this->is_valid_room($room);
            }
        );

        $filtered = array_filter(
            $filtered,
            function ($room) {
                return strpos($this->decrypt($room), 'north') !== false;
            }
        );

        if (!empty($filtered)) {
            return array_pop($filtered)["sector_id"];
        }
    }

}