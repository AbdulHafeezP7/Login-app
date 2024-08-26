<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Article;

class FrontEndController extends Controller
{

    public function home()
    {
        $data = array();
        $data['doctors'] = Doctor::join('departments', 'doctors.department', '=', 'departments.id')
            ->select('doctors.*', 'departments.department_en as department_name')
            ->where('doctors.frontpage', '=', 1)
            ->get();
        $data['article'] = Article::latest()->take(5)->get();
        $data['department'] = Department::whereNotNull('department_ar')->get();

        return view('frontend.home', $data);
    }
    public function articleDetails($slug = null)
    {
        $data = array();
        $data['article'] = Article::where('slug', $slug)->firstOrFail();
        return view('frontend.articleDetails', $data);
    }
    public function about()
    {
        return view('frontend.abouts');
    }
}
