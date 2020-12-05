<?php

namespace Common;

abstract class Common
{
    private $year;
    private $day;
    private $in;
    private $answer;

    function __construct($year, $day)
    {
        $this->year = $year;
        $this->day = $day;
        $path = "{$this->year}/in";
        $this->in = file_get_contents("{$path}/{$this->day}.txt");
    }

    protected function set_answer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param string|null $in
     * @return array Values
     */
    protected function split_by_line($in = null)
    {
        if (!isset($in)) {
            $in = $this->in;
        }

        $lines = explode("\n", $in);

        return array_filter(
            $lines,
            static function ($line) {
                return !empty($line);
            }
        );
    }

    /**
     * @param null $input
     * @return array Values
     */
    protected function split_by_blank_line()
    {
        $lines = explode("\n\n", $this->in);

        return array_filter(
            $lines,
            static function ($line) {
                return !empty($line);
            }
        );
    }

    /**
     * @param string|null $in
     * @return array Values
     */
    protected function split_by_comma($in = null)
    {
        if (!isset($in)) {
            $in = $this->in;
        }

        $values = explode(",", $in);

        return array_filter(
            $values,
            static function ($value) {
                return !isset($value) || !empty($value) || $value === '0';
            }
        );
    }

    /**
     * @param $line
     * @return false|string[]
     */
    protected function split_line_by_space($line)
    {
        $values = explode(' ', trim($line));
        return array_values(
            array_filter(
                $values,
                function ($value) {
                    return !empty($value);
                }
            )
        );
    }

    protected function get_line()
    {
        $lines = explode("\n", $this->in);

        return $lines[0];
    }

    abstract protected function parse_input();

    abstract function solution_1();

    abstract function solution_2();

    public function answer()
    {
        if ($this->answer) {
            foreach ($this->answer as $key => $value) {
                echo "{$key}: {$value}\n";
            }
        }
    }

}