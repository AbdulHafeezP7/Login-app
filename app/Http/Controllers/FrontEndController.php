<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Offer;
use App\Models\Branch;


class FrontEndController extends Controller
{
    public function home()
    {
        $data = array();
        $data['doctors'] = Doctor::join('departments', 'doctors.department', '=', 'departments.id')
            ->select('doctors.*', 'departments.department_en as department_name')
            ->where('doctors.frontpage', '=', 1)
            ->orderBy('sort', 'asc')
            ->get();
        $data['article'] = Article::latest()->take(5)->get();
        $data['department'] = Department::whereNotNull('department_ar')->orderBy('sort', 'asc')->get();
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
    public function offer()
    {
        $data['offer'] = Offer::whereNotNull('image')->orderBy('sort', 'asc')->get();
        return view('frontend.offer',$data);
    }
     public function contact_us()
    {
        $data['branch'] = Branch::orderBy('sort', 'asc')->get();
        return view('frontend.contact',$data);
    }
    public function doctors()
    {
        $data['doctors'] = Doctor::join('departments', 'doctors.department', '=', 'departments.id')
            ->select('doctors.*', 'departments.department_ar as department_name')
            ->where('doctors.frontpage', '=', 1)
            ->orderBy('sort', 'asc')
            ->get();
        $data['department'] = Department::whereNotNull('department_ar')->get();
        return view('frontend.doctor',$data);
    }
    public function branch_location($branchId=null)
    {
        $data['branchDetails'] = Branch::find($branchId);
        return view('frontend.branch_location',$data);
    }
    public function departmentDetails($slug = null)
    {
        $data = array();
        $data['details'] = Department::where('slug', $slug)->firstOrFail();
        return view('frontend.departmentDetails', $data);
    }
     public function privacy_policy()
    {
        
        return view('frontend.privacy_policy');
    }
  
}
