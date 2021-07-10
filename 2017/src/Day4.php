<?php


namespace y2017;

use Common\Common;

class Day4 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 337, 2 => 231]);
    }

    private function is_passprase_valid($passprase)
    {
        $words = explode(' ', $passprase);
        $words_frequency = [];
        foreach ($words as $word) {
            if (!isset($words_frequency[$word])) {
                $words_frequency[$word] = 0;
            }

            $words_frequency[$word]++;
        }

        return !array_filter(
            $words_frequency,
            function ($frequency) {
                return $frequency > 1;
            }
        );
    }

    private function is_passprase_valid_2($passprase)
    {
        $words = explode(' ', $passprase);
        $words_frequency = [];
        foreach ($words as $word) {
            $chars = str_split($word);
            sort($chars);
            $word = implode($chars);

            if (!isset($words_frequency[$word])) {
                $words_frequency[$word] = 0;
            }

            $words_frequency[$word]++;
        }

        return !array_filter(
            $words_frequency,
            function ($frequency) {
                return $frequency > 1;
            }
        );
    }

    protected function parse_input()
    {
        return $this->split_by_line();
    }

    public function solution_1()
    {
        $passphrases = $this->parse_input();

        $count = 0;
        foreach ($passphrases as $passphrase) {
            if ($this->is_passprase_valid($passphrase)) {
                $count++;
            }
        }

        return $count;
    }


    public function solution_2()
    {
        $passphrases = $this->parse_input();

        $count = 0;
        foreach ($passphrases as $passphrase) {
            if ($this->is_passprase_valid_2($passphrase)) {
                $count++;
            }
        }

        return $count;
    }

}