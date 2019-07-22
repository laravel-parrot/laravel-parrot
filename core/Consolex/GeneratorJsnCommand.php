<?php

namespace Parrot\Parrot\Core\Consolex;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command as Command;

abstract class GeneratorJsnCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type;

    /**
     * Create a new controller creator command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    abstract protected function getStub();

    abstract protected function getExtra();


    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {

        $path = base_path('composer54.json');





        $this->files->put($path, $this->buildClass());

        $this->info($this->type.' created successfully.');
    }







    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass()
    {
        $stub = $this->files->get(base_path('composer54.json'));

        return $this->replaceNamespace($stub);
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub)
    {
      if (! str_contains($stub,'merge-plugin')) {
        $stub = str_replace(
            ['"extra": {', '"App\\\\": "app/"'],
            ['"extra": {
                "merge-plugin": {
                  "include": [
                      "parrot/composer.json",
                      "pluginx/*/composer.json"
                      ],
                  "require": [
                    "parrot/composer.json",
                    "pluginx/*/composer.json"
                  ],
                  "recurse": true,
                  "replace": false,
                  "ignore-duplicates": false,
                  "merge-dev": true,
                  "merge-extra": false,
                  "merge-extra-deep": false,
                  "merge-scripts": false
                },','"App\\\\": "app/",
            "Parrot\\\\Parrot\\\\": "parrot/"'],
            $stub
        );
      }


        return $stub;
    }




    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name'));
    }



    /**
     * Get the model for the default guard's user provider.
     *
     * @return string|null
     */
    protected function userProviderModel()
    {
        $guard = config('auth.defaults.guard');

        $provider = config("auth.guards.{$guard}.provider");

        return config("auth.providers.{$provider}.model");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }
}
