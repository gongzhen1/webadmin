<?php 

namespace Water\Vular\Webadmin;

use Event;
use Illuminate\Support\Facades\Route;
use Water\Vular\Providers\VularBaseServiceProvider;
use Water\Vular\Webadmin\Models\Product;
use Water\Vular\Webadmin\Models\Post;
use Water\Vular\Webadmin\Observers\ProductObserver;
use Water\Vular\Webadmin\Observers\PostObserver;

class WebadminServiceProvider extends VularBaseServiceProvider {

    public function boot() 
    {
        Product::observe(ProductObserver::class);
        Post::observe(PostObserver::class);
        $this->loadMigrationsFrom($this->baseDir.'database/migrations/');
     }


    public function register()
    {
        $this->baseDir = __DIR__ .'/../';
        $this->registerMenuItem('Water\Vular\Webadmin\Form\Menu');
        $this->registerMenuItem('Water\Vular\Webadmin\Page\Menu');
        $this->registerMenuItem('Water\Vular\Webadmin\Post\Menu');
        $this->registerMenuItem('Water\Vular\Webadmin\Product\Menu');
    }
}   