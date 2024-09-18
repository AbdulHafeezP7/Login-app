<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('backend.departments');
    }
    public function dataTablesForDepartments()
    {
            $query = Department::query();
            return DataTables::of($query)
                ->addColumn('department_en', function ($row) {
                    return $row->department_en;
                })
                ->addColumn('department_ar', function ($row) {
                    return $row->department_ar;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image); // Ensure this path is correct

                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('department_details', function ($row) {
                    return $row->department_details;
                })
                ->addColumn('slug', function ($row) {
                    return $row->slug;
                })
                ->addColumn('sort', function ($row) {
                    return $row->sort;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('department_en', function ($query, $keyword) {
                    $query->where('department_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('department_ar', function ($query, $keyword) {
                    $query->where('department_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('department_details', function ($query, $keyword) {
                    $query->where('department_details', 'like', "%{$keyword}%");
                })
                ->filterColumn('slug', function ($query, $keyword) {
                    $query->where('slug', 'like', "%{$keyword}%");
                })
                ->orderColumn('sort', function ($query) {
                    $query->orderBy('sort', 'asc');
                })
                ->make(true);
    }
    public function addDepartments()
    {
        return view('backend.departmentsAdd');
    }
    public function store(DepartmentRequest $request)
    {
        try {
            $totalDepartments = Department::count();
            $department = new Department;
            $department->department_en = $request->department_en;
            $department->department_ar = $request->department_ar;
            $department->department_details = $request->department_details;
            $department->content_ar = $request->content_ar;
            $department->slug = $request->slug;
            $department->sort = $totalDepartments + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $department->image = $imageName;
            }
            $department->save();
            return response()->json(['status' => true, 'message' => 'Department created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function departmentDecrement(Request $request)
    {
        $department = Department::find($request->departmentId);
        
        $sort =($department->sort!="")?--$department->sort:0;
        if ($sort >= 1) {
            $departmentDownData = Department::where('sort', $sort)->first();
            if ($departmentDownData) {
                $newSort = ($departmentDownData->sort == 0 || $departmentDownData->sort == null) ? 0 : $departmentDownData->sort;
                $departmentDownData->sort = $newSort + 1;
                $departmentDownData->save();
            }
            $department->sort = $sort;
            $department->save();
        }
        return response()->json(['status' => true, 'message' => 'Department sorted successfully.']);
    }
    public function departmentIncrement(Request $request)
    {
        $department = Department::find($request->departmentId);
        $sort = ++$department->sort;
        $departmentCount = Department::count('id');
        if ($sort <= $departmentCount) {
            $departmentUpData = Department::where('sort', $sort)->first();
            if ($departmentUpData) {
                $newSort = ($departmentUpData->sort == 0 || $departmentUpData->sort == null) ? 0 : $departmentUpData->sort;
                $departmentUpData->sort = $newSort - 1;
                $departmentUpData->save();
            }
            $department->sort = $sort;
            $department->save();
        }
        return response()->json(['status' => true, 'message' => 'Department sorted successfully.']);
    }
    public function edit($id)
    {
        $department = Department::find($id);
        return view('backend.department-edit', compact('department', 'id'));
    }
    public function update(DepartmentUpdateRequest $request)
    {
        try {
            $department = Department::findOrFail($request->id);
            $department->department_en = $request->department_en;
            $department->department_ar = $request->department_ar;
            $department->department_details = $request->department_details;
            $department->content_ar = $request->content_ar;
            $department->slug = $request->slug;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $department->image = $imageName;
            }
            $department->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Department updated successfully.']);
            } else {
                return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
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
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json(['status' => true, 'message' => 'Department deleted successfully'],'');
    }
    public function show(Request $request, $id)
    {
        $department = Department::find($id);
        return view('backend.department-show', compact('department'));
    }
}
