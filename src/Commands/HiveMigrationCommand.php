<?php

namespace R\Hive\Commands;

use Illuminate\Support\Str;

class HiveMigrationCommand extends HiveGeneratorCommand
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'hive:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Hive migration.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Table';


    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        parent::fire();
    }


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/migration.stub';
    }

    protected function getPath($name)
    {
        $migration_timestamp = date('Y_m_d_His');

        $name = Str::plural(Str::snake(str_replace($this->laravel->getNamespace(), '', $name)));

        $file = implode('_', [$migration_timestamp,
                              'create',
                              $name,
                              strtolower($this->type)
                            ]);

        return $this->laravel->basePath() . '/database/migrations/' . $file . '.php';
    }


    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            //
        ];
    }
}
