<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BranchRequest;
use DB;

class BranchController extends Controller
{

    public function index()
    {
        return view('backend.branchs');
    }
    public function dataTablesForBranchs(Request $request)
    {
        if ($request->ajax()) {
            $query = Branch::query();
            // $query = DB::table('branchs')::query();


            return DataTables::of($query)
                ->addColumn('branchname_en', function ($row) {
                    return $row->branchname_en;
                })
                ->addColumn('branchname_ar', function ($row) {
                    return $row->branchname_ar;
                })
                ->addColumn('branchmanager_name', function ($row) {
                    return $row->branchmanager_name;
                })
                ->addColumn('branch_location', function ($row) {
                    return $row->branch_location;
                })
                ->addColumn('branch_address', function ($row) {
                    return $row->branch_address;
                })
                ->addColumn('branchsocial_link', function ($row) {
                    return $row->branchsocial_link;
                })
                ->addColumn('branchoffice_number', function ($row) {
                    return $row->branchoffice_number;
                })
                ->addColumn('branchmanager_number', function ($row) {
                    return $row->branchmanager_number;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('branchname_en', function ($query, $keyword) {
                    $query->where('branchname_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchname_ar', function ($query, $keyword) {
                    $query->where('branchname_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchmanager_name', function ($query, $keyword) {
                    $query->where('branchmanager_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('branch_location', function ($query, $keyword) {
                    $query->where('branch_location', 'like', "%{$keyword}%");
                })
                ->filterColumn('branch_address', function ($query, $keyword) {
                    $query->where('branch_address', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchsocial_link', function ($query, $keyword) {
                    $query->where('branchsocial_link', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchoffice_number', function ($query, $keyword) {
                    $query->where('branchoffice_number', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchmanager_number', function ($query, $keyword) {
                    $query->where('branchmanager_number', 'like', "%{$keyword}%");
                })
                ->make(true);
        }
    }
    public function addBranchs()
    {
        return view('backend.branchsAdd');
    }

    public function store(BranchRequest $request)
    {

        try {
            $request->validate([
                'branchname_en' => 'required|string|max:255',
                'branchname_ar' => 'required|string|max:255',
                'branchmanager_name' => 'required|string|max:255',
                'branch_location' => 'required|string|max:255',
                'branch_address' => 'required|string',
                'branchsocial_link' => 'required|string|max:255',
                'branchoffice_number' => 'required|string|max:255',
                'branchmanager_number' => 'required|string|max:255',
            ]);
            $branch = new Branch;
            $branch->branchname_en = $request->branchname_en;
            $branch->branchname_ar = $request->branchname_ar;
            $branch->branchmanager_name = $request->branchmanager_name;
            $branch->branch_location = $request->branch_location;
            $branch->branch_address = $request->branch_address;
            $branch->branchsocial_link = $request->branchsocial_link;
            $branch->branchoffice_number = $request->branchoffice_number;
            $branch->branchmanager_number = $request->branchmanager_number;
            
            $branch->save();
            return response()->json(['status' => true, 'message' => 'Branch created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }




    public function edit($id)
    {
        $branch = Branch::find($id);

        return view('backend.branch-edit', compact('branch'));
    }


    public function update(Request $request, $id)
    {
        try {


            $branch = Branch::findOrFail($id);

            $request->validate([
                'branchname_en' => 'required|string|max:255',
                'branchname_ar' => 'required|string|max:255',
                'branchmanager_name' => 'required|string|max:255',
                'branch_location' => 'required|string|max:255',
                'branch_address' => 'required|string',
                'branchsocial_link' => 'required|string|max:255',
                'branchoffice_number' => 'required|string|max:255',
                'branchmanager_number' => 'required|string|max:255',
            ]);
            $branch->branchname_en = $request->branchname_en;
            $branch->branchname_ar = $request->branchname_ar;
            $branch->branchmanager_name = $request->branchmanager_name;
            $branch->branch_location = $request->branch_location;
            $branch->branch_address = $request->branch_address;
            $branch->branchsocial_link = $request->branchsocial_link;
            $branch->branchoffice_number = $request->branchoffice_number;
            $branch->branchmanager_number = $request->branchmanager_number;

            $branch->save();

            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Branch updated successfully.']);
            } else {
                return redirect()->route('branchs.index')->with('success', 'Branch updated successfully.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->validator->errors()->first()], 422);
            } else {
                return back()->with('error', $e->validator->errors()->first());
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
            } else {
                return back()->with('error', $e->getMessage());
            }
        }
    }
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return response()->json(['status' => true, 'message' => 'Branch deleted successfully'],);
    }


    public function show(Request $request, $id)
    {
        $branch = Branch::find($id);

        return view('backend.branch-show', compact('branch'));
    }
}
