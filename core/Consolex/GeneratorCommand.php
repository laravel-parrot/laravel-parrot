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

abstract class GeneratorCommand extends Command
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

    abstract protected function getNamespace();

    abstract protected function getPath();



    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {

        $path = $this->getPath().$this->getNameInput().'.php';

        // First we will check to see if the class already exists. If it does, we don't want
        // to create the class and overwrite the user's code. So, we will bail out so the
        // code is untouched. Otherwise, we will continue generating this class' files.

        if($this->files->exists($path)){
          $this->error($this->type.' already exists!');
          return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass());

        $this->info($this->type.' created successfully.');
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists()
    {
        return $this->files->exists($this->getPath());
    }



    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {
        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        //return $path;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass()
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub)->replaceClass($stub);
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
        $stub = str_replace(
            [
              'DummyNamespace',
              'DummyController',
              'NamespacedDummyUserModel'
            ],
            [
              $this->getNamespace().$this->directoryNamespace(),
              $this->getNamespace(),
              $this->userProviderModel()
            ],
            $stub
        );

        return $this;
    }



    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub)
    {
        //$class = str_replace($this->getNamespace($name).'\\', '', $name);
        //$class = $this->getNameInput();
        $class = ucfirst($this->directoryClass());

        return str_replace('DummyClass', $class, $stub);
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        //return trim($this->argument('name'));

        $nameSplit = explode('/',$this->argument('name'));
        $lenName = count($nameSplit);
        $extraNameSpace = '';
        $a = 0;
        while ($a < ($lenName)) {
          $extraNameSpace = $extraNameSpace.'/'.ucfirst($nameSplit[$a]);
          $a = $a + 1;
        }
        return $extraNameSpace;
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

    protected function directoryNamespace(){
      $nameSplit = explode('/',$this->argument('name'));
      $lenName = count($nameSplit);
      $extraNameSpace = '';
      $a = 0;
      while ($a < ($lenName - 1)) {
        $extraNameSpace = $extraNameSpace.'\\'.ucfirst($nameSplit[$a]);
        $a = $a + 1;
      }
      return $extraNameSpace;
    }

    protected function directoryClass(){
      $nameSplit = explode('/',$this->argument('name'));
      $lenName = count($nameSplit);
      if ($lenName >= 1) {
        return $nameSplit[$lenName-1];
      }
      return $nameSplit[0];

    }
}
