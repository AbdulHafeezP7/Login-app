<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Department;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $departments = Department::all();
            $view->with('departments', $departments);
        });
    }
}
