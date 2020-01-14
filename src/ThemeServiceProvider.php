<?php 

namespace Water\Vular\Webadmin;

use Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Water\Vular\Models\Product;
use Water\Vular\Post\Models\Post;

class ThemeServiceProvider extends ServiceProvider {

    protected $namespace = 'Water\Vular\Webtheme\Controllers';
    protected $baseDir = '';


    public function boot() 
    {
        $this->app->booted(function () {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group($this->baseDir . 'routes/web.php');
        });

        $dir = config('vular.theme');
        //$this->loadViewsFrom($this->baseDir . 'resources/views', 'kingnod');
        $this->loadViewsFrom($this->baseDir, $dir);
        
        $this->publishes([
            $this->baseDir.'public' => public_path($dir),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/css' => public_path($dir.'/css'),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/js' => public_path($dir.'/js'),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/images' => public_path($dir.'/images'),
        ], 'public');
        $this->publishes([
            $this->baseDir.'public/uploads' => public_path('uploads'),
        ], 'public');
        //$this->publishes([
        //    $this->baseDir.'config/'.$dir.'.php' => config_path($dir.'.php'),
        //]);
       
     }


    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ .'/../'.'config/vular.php', 'vular'
        );
        $theme = config('vular.theme') ? config('vular.theme') : "Warmy";
        $this->baseDir = app_path() .'/Themes/'.$theme.'/';

        $this->mergeConfigFrom(
            $this->baseDir.'config/vular.php', 'vular'
        );
   }


}   