<?php

namespace y2020;

use Common\Common;

class Day8 extends Common
{
    function __construct($year, $day)
    {
        parent::__construct($year, $day);
        $this->set_answer([1 => 1475, 2 => 1270]);
    }

    private function run($commands, &$acc)
    {
        $i = 0;
        $last_line = count($commands);
        while ($i < $last_line) {
            if ($commands[$i]['process']) {
                return -1;
            }

            $commands[$i]['process'] = true;
            switch ($commands[$i]['operator']) {
                case 'nop':
                    $i++;
                    break;
                case 'jmp':
                    $i += $commands[$i]['operand'];
                    break;
                case 'acc':
                    $acc += $commands[$i]['operand'];
                    $i++;
                    break;
            }
        }

        return 0;
    }

    protected function parse_input()
    {
        $program = $this->split_by_line();

        $commands = [];
        foreach ($program as $line) {
            preg_match('/(acc|jmp|nop) \+?([-\d]+)/', $line, $matches);
            $commands[] = [
                'operator' => $matches[1],
                'operand' => $matches[2],
                'process' => false
            ];
        }

        return $commands;
    }

    public function solution_1()
    {
        $commands = $this->parse_input();

        $acc = 0;
        $this->run($commands, $acc);

        return $acc;
    }

    public function solution_2()
    {
        $commands = $this->parse_input();

        $i = 0;
        foreach ($commands as $command) {
            if ($command['operator'] === 'jmp' || $command['operator'] === 'nop') {
                $acc = 0;
                $new_commands = $commands;
                $new_commands[$i]['operator'] = $new_commands[$i]['operator'] === 'nop'
                    ? 'jmp' : 'nop';

                if (!$this->run($new_commands, $acc)) {
                    return $acc;
                }
            }
            $i++;
        }

        return -1;
    }
}
