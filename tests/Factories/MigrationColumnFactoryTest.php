<?php

use R\Hive\Factories\MigrationColumnFactory;
use Mockery as m;

class MigrationColumnFactoryTest extends PHPUnit_Framework_TestCase
{

    public function testGeneratesSimpleColumn()
    {
        $input = [
            'name' => ['type' => 'string']
        ];

        $output   = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->string('name');";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }


    public function testGeneratesMultipleSimpleColumns()
    {
        $input = [
            'name' => ['type' => 'string'],
            'age'  => ['type' => 'integer']
        ];

        $output   = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->string('name');";
        $output[] = "\$table->integer('age');";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }


    public function testGeneratesMultiColumnWithDecorator()
    {
        $input = [
            'name' => ['type' => 'string', 'decorators' => ['nullable']],
            'age'  => ['type' => 'integer']
        ];

        $output   = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->string('name')->nullable();";
        $output[] = "\$table->integer('age');";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }


    public function testGeneratesColumnWithArgsAndDecorators()
    {
        $input = [
            'name' => [
                'type' => 'string',
                'args' => ['15'],
                'decorators' => ['nullable']
            ]
        ];

        $output = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->string('name', 15)->nullable();";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }


    public function testGeneratesMultiColWithArgsAndDecorators()
    {
        $input = [
            'average' => [
                'type' => 'double',
                'args' => ['15', '8'],
                'decorators' => ['nullable', 'default(10)']],
            'age'  => [
                'type' => 'integer'
            ]
        ];

        $output   = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->double('average', 15, 8)->nullable()->default(10);";
        $output[] = "\$table->integer('age');";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }

    public function testGeneratesColumnWithForeignConstraints() {
        $input = [
          'user_id' => [
            'type'       => 'integer',
            'decorators' => ['nullable', 'foreign']
          ]
        ];

        $output = [];
        $output[] = "\$table->increments('id');";
        $output[] = "\$table->integer('user_id')->nullable();";
        $output[] = "\$table->foreign('user_id')->references('id')->on('users');";
        $output[] = "\$table->timestamps();";

        $this->assertEquals($output, MigrationColumnFactory::make($input));
    }
}
