<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BranchRequest;
use App\Http\Requests\BranchUpdateRequest;
use App\Models\SocialMedia;

// Controller for managing Branch operations
class BranchController extends Controller
{
    // Display the index view for branches
    public function index()
    {
        return view('backend.branchs');
    }

    // Handle the DataTable request for branches
    public function dataTablesForBranchs(Request $request)
    {
        if ($request->ajax()) {
            // Fetch branch data with social media links
            $query = Branch::query()
                ->join('socialmedias', 'branchs.branchsocial_link', '=', 'socialmedias.id')
                ->select('branchs.*', 'socialmedias.socialmedia_url as socialmedia_url');

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
                    return $row->socialmedia_url;
                })
                ->addColumn('branchoffice_number', function ($row) {
                    return $row->branchoffice_number;
                })
                ->addColumn('branchmanager_number', function ($row) {
                    return $row->branchmanager_number;
                })
                ->addColumn('sort', function ($row) {
                    return $row->sort;
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
                    $query->where('socialmedias.socialmedia_url', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchoffice_number', function ($query, $keyword) {
                    $query->where('branchoffice_number', 'like', "%{$keyword}%");
                })
                ->filterColumn('branchmanager_number', function ($query, $keyword) {
                    $query->where('branchmanager_number', 'like', "%{$keyword}%");
                })
                ->orderColumn('sort', function ($query) {
                    $query->orderBy('sort', 'asc');
                })
                ->make(true);
        }
    }

    // Show the form to add a new branch
    public function addBranchs()
    {
        $socialmedias = SocialMedia::all();
        return view('backend.branchsAdd', compact('socialmedias'));
    }

    // Store a newly created branch
    public function store(BranchRequest $request)
    {
        try {
            $totalBranchs = Branch::count();
            $branch = new Branch;
            $branch->branchname_en = $request->branchname_en;
            $branch->branchname_ar = $request->branchname_ar;
            $branch->branchmanager_name = $request->branchmanager_name;
            $branch->branch_location = $request->branch_location;
            $branch->branch_address = $request->branch_address;
            $branch->branchsocial_link = $request->branchsocial_link;
            $branch->branchoffice_number = $request->branchoffice_number;
            $branch->branchmanager_number = $request->branchmanager_number;
            $branch->sort = $totalBranchs + 1;
            $branch->save();

            return response()->json(['status' => true, 'message' => 'Branch created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // Decrement the sort order of a branch
    public function branchDecrement(Request $request)
    {
        $branch = Branch::find($request->branchId);
        $sort = --$branch->sort;

        if ($sort >= 1) {
            $branchDownData = Branch::where('sort', $sort)->first();
            if ($branchDownData) {
                $newSort = ($branchDownData->sort == 0 || $branchDownData->sort == null) ? 0 : $branchDownData->sort;
                $branchDownData->sort = $newSort + 1;
                $branchDownData->save();
            }
            $branch->sort = $sort;
            $branch->save();
        }

        return response()->json(['status' => true, 'message' => 'Branch sorted successfully.']);
    }

    // Increment the sort order of a branch
    public function branchIncrement(Request $request)
    {
        $branch = Branch::find($request->branchId);
        $sort = ++$branch->sort;
        $branchCount = Branch::count('id');

        if ($sort <= $branchCount) {
            $branchUpData = Branch::where('sort', $sort)->first();
            if ($branchUpData) {
                $newSort = ($branchUpData->sort == 0 || $branchUpData->sort == null) ? 0 : $branchUpData->sort;
                $branchUpData->sort = $newSort - 1;
                $branchUpData->save();
            }
            $branch->sort = $sort;
            $branch->save();
        }

        return response()->json(['status' => true, 'message' => 'Branch sorted successfully.']);
    }

    // Show the form to edit a specific branch
    public function edit($id)
    {
        $singleBranch = Branch::find($id);
        $socialmedias = SocialMedia::all();
        return view('backend.branch-edit', compact('socialmedias', 'singleBranch', 'id'));
    }

    // Update the specified branch
    public function update(BranchUpdateRequest $request)
    {
        try {
            $branch = Branch::findOrFail($request->id);
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

    // Delete a specific branch
    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return response()->json(['status' => true, 'message' => 'Branch deleted successfully']);
    }

    // Display details of a specific branch
    public function show(Request $request, $id)
    {
        $singleBranch = Branch::find($id);
        return view('backend.branch-show', compact('singleBranch'));
    }
}
