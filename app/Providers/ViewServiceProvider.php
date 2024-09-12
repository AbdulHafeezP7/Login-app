<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Department;
use App\Models\Partner;
use App\Models\Insurance;
use App\Models\Branch;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $departments = Department::orderBy('sort', 'asc')->get();
            $partner = Partner::orderBy('sort', 'asc')->get();
            $insurance = Insurance::orderBy('sort', 'asc')->get();
            $branch = Branch::orderBy('sort', 'asc')->get();
            $view->with(['departments'=>$departments,'insurance'=>$insurance,'partner'=>$partner,'branch'=>$branch]);
        });
    }
}
