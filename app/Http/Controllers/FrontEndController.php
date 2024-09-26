<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Offer;
use App\Models\Branch;

// Controller for handling frontend functionalities
class FrontEndController extends Controller
{
    /**
     * Display the homepage with featured doctors, articles, and departments.
     *
     * @return \Illuminate\View\View
     */
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

    /**
     * Display the details of a specific article.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function articleDetails($slug = null)
    {
        $data = array();
        $data['article'] = Article::where('slug', $slug)->firstOrFail();
        return view('frontend.articleDetails', $data);
    }

    /**
     * Display the About Us page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('frontend.abouts');
    }

    /**
     * Display the offers page with available offers.
     *
     * @return \Illuminate\View\View
     */
    public function offer()
    {
        $data['offer'] = Offer::whereNotNull('image')->orderBy('sort', 'asc')->get();
        return view('frontend.offer', $data);
    }

    /**
     * Display the contact us page with branch information.
     *
     * @return \Illuminate\View\View
     */
    public function contact_us()
    {
        $data['branch'] = Branch::orderBy('sort', 'asc')->get();
        return view('frontend.contact', $data);
    }

    /**
     * Display the doctors' page with featured doctors and departments.
     *
     * @return \Illuminate\View\View
     */
    public function doctors()
    {
        $data['doctors'] = Doctor::join('departments', 'doctors.department', '=', 'departments.id')
            ->select('doctors.*', 'departments.department_ar as department_name')
            ->where('doctors.frontpage', '=', 1)
            ->orderBy('sort', 'asc')
            ->get();
        $data['department'] = Department::whereNotNull('department_ar')->get();
        return view('frontend.doctor', $data);
    }

    /**
     * Display the location details of a specific branch.
     *
     * @param int|null $branchId
     * @return \Illuminate\View\View
     */
    public function branch_location($branchId = null)
    {
        $data['branchDetails'] = Branch::find($branchId);
        return view('frontend.branch_location', $data);
    }

    /**
     * Display the details of a specific department.
     *
     * @param string|null $slug
     * @return \Illuminate\View\View
     */
    public function departmentDetails($slug = null)
    {
        $data = array();
        $data['details'] = Department::where('slug', $slug)->firstOrFail();
        return view('frontend.departmentDetails', $data);
    }

    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }
}
