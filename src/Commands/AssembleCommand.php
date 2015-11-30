<?php

namespace R\Hive\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AssembleCommand extends Command
{
    protected $name = 'hive:assemble';

    protected $description = 'Create a new Hive RESTful HTTP resource collection.';

    public function fire()
    {
        $name = $this->argument('name');

        $this->call('hive:instance', ['name' => $name, '-e' => 'bar', '-m' => 'bar']);
        $this->call('hive:factory', ['name' => $name, '-i' => 'bar']);
        $this->call('hive:repo', ['name' => $name, '-o' => 'bar']);
        $this->call('hive:mutator', ['name' => $name.'Request', '-r' => 'bar']);
        $this->call('hive:controller', ['name' => $name]);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the instance.'],
        ];
    }

    protected function getOptions()
    {
        return [
            ['fields', 'f', InputOption::VALUE_REQUIRED, 'The fields to be used in this schema.'],
        ];
    }
}
