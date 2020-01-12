<?php 

namespace Water\Vular\Post;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Water\Vular\Commands\Install;

class PostServiceProvider extends ServiceProvider {

    protected $namespace = 'Water\Vular\Http\Controllers';
    protected $baseDir = '';


    public function boot() 
    {
        $this->loadMigrationsFrom($this->baseDir.'database/migrations/');
    }


    public function register()
    {
        $this->baseDir = __DIR__ .'/../';
    }


}   