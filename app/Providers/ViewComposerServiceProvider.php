<?php

namespace App\Providers;

use App\Models\Category; // Sửa từ Categories thành Category
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('partials.header', function ($view) {
            $categories = Category::active()->get(); // Đúng với tên model
            $view->with('categories', $categories);
        });
    }

    public function register()
    {
        //
    }
}
