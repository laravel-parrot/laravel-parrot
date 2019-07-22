<?php

namespace Parrot\Parrot\Core\Consolex\Command;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Parrot\Parrot\Core\Consolex\GeneratorCommand;

class MailMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'p-m:mail {name} {--pkg=} {--markdown}';

    // public function handle(){
    //   if(parent::handle() === false && ! $this->option('force')){
    //     return;
    //   }
    //   if($this->option('plg') !== ''){
    //     $this->info($this->option('plg'));
    //   }
    //
    // }
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Mail class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Mail';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('markdown')
                        ? __DIR__.'/../stubs/markdown-mail.stub'
                        :  __DIR__.'/../stubs/mail.stub';
    }

    /**
     * set the namespace.
     *
     * @return string
     */

    protected function getNamespace()
    {
      if($this->option('pkg')){
        $package = $this->option('pkg');
        $pkgNamespace = 'Parrotx\\'.ucfirst($package).'\App\Mail';
        return $pkgNamespace;
      }
      return 'Parrot\Parrot\App\Mail';
    }
    /**
     * set the filepath.
     *
     * @return string
     */
    protected function getPath()
    {
      if($this->option('pkg')){
        $package = $this->option('pkg');
        $pkgPathName = 'pluginx/'.lcfirst($package).'/app/Mail/';
        return base_path($pkgPathName);
      }
      return base_path('parrot/app/Mail/');
    }


}
