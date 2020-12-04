<?php

namespace y2020;

use Common\Common;

class Day4 extends Common
{

    private $required_fields = [
        'byr',
        'iyr',
        'eyr',
        'hgt',
        'hcl',
        'ecl',
        'pid'
    ];

    private $optional_fields = [
        'cid',
    ];

    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 235, 2 => 194]);
    }

    private function validate_1($passport)
    {
        $pairs = $this->split_line_by_space($passport);
        $fields = [];
        foreach ($pairs as $pair) {
            $fields[] = explode(':', $pair)[0];
        }

        $diff = array_diff($this->required_fields, $fields);

        return count($diff) === 0;
    }

    private function validate_2($passport)
    {
        $pairs = $this->split_line_by_space($passport);
        $fields = [];
        $validators = [
            //byr (Birth Year) - four digits; at least 1920 and at most 2002.
            'byr' => static function ($value) {
                return preg_match('/^\d{4}$/', $value) && 1920 <= $value && $value <= 2002;
            },
            //iyr (Issue Year) - four digits; at least 2010 and at most 2020.
            'iyr' => static function ($value) {
                return preg_match('/^\d{4}$/', $value) && 2010 <= $value && $value <= 2020;
            },
            //eyr (Expiration Year) - four digits; at least 2020 and at most 2030.
            'eyr' => static function ($value) {
                return preg_match('/^\d{4}$/', $value) && 2020 <= $value && $value <= 2030;
            },
            //hgt (Height) - a number followed by either cm or in:
            //If cm, the number must be at least 150 and at most 193.
            //If in, the number must be at least 59 and at most 76.
            'hgt' => static function ($value) {
                if (preg_match('/^(\d*)cm$/', $value, $matches)) {
                    return 150 <= $matches[1] && $matches[1] <= 193;
                }
                if (preg_match('/^(\d*)in$/', $value, $matches)) {
                    return 59 <= $matches[1] && $matches[1] <= 76;
                }
                return false;
            },
            //hcl (Hair Color) - a # followed by exactly six characters 0-9 or a-f.
            'hcl' => static function ($value) {
                return preg_match('/^#[0-9a-f]{6}$/', $value);
            },
            //ecl (Eye Color) - exactly one of: amb blu brn gry grn hzl oth.
            'ecl' => static function ($value) {
                return preg_match('/^(amb|blu|brn|gry|grn|hzl|oth)$/', $value);
            },
            //pid (Passport ID) - a nine-digit number, including leading zeroes.
            'pid' => static function ($value) {
                return preg_match('/^\d{9}$/', $value);
            },
            'cid' => static function ($value) {
                return 1;
            }
        ];
        $is_valid = true;
        foreach ($pairs as $pair) {
            list($key, $value) = explode(':', $pair);
            $is_valid &= $validators[$key]($value);
        }

        return $is_valid;
    }

    protected function parse_input()
    {
        return $this->split_by_blank_line();
    }

    public function solution_1()
    {
        $cnt = 0;
        foreach ($this->parse_input() as $raw_passport) {
            $passport = implode(' ', $this->split_by_line($raw_passport));
            if ($this->validate_1($passport)) {
                $cnt++;
            }
        }

        return $cnt;
    }

    public function solution_2()
    {
        $cnt = 0;
        foreach ($this->parse_input() as $raw_passport) {
            $passport = implode(' ', $this->split_by_line($raw_passport));
            if ($this->validate_1($passport) && $this->validate_2($passport)) {
                $cnt++;
            }
        }

        return $cnt;
    }
}


