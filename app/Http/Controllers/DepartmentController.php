<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('backend.departments');
    }
    public function dataTablesForDepartments(Request $request)
    {
        if ($request->ajax()) {
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
                ->make(true);
        }
    }
    public function addDepartments()
    {
        return view('backend.departmentsAdd');
    }
    public function store(DepartmentRequest $request)
    {
        try {
            $department = new Department;
            $department->department_en = $request->department_en;
            $department->department_ar = $request->department_ar;
            $department->department_details = $request->department_details;
            $department->slug = $request->slug;
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
    public function edit($id)
    {
        $department = Department::find($id);
        return view('backend.department-edit', compact('department', 'id'));
    }
    public function update(Request $request)
    {
        try {
            $department = Department::findOrFail($request->id);
            $request->validate([
                'department_en' => 'required|string|max:255',
                'department_ar' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'department_details' => 'required|string',
                'slug' => 'required|string|max:255|unique:departments,slug,' . $request->id,
            ], [
                'slug.unique' => 'The slug should be unique.',
            ]);
            $department->department_en = $request->department_en;
            $department->department_ar = $request->department_ar;
            $department->department_details = $request->department_details;
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
        return response()->json(['status' => true, 'message' => 'Department deleted successfully'],);
    }
    public function show(Request $request, $id)
    {
        $department = Department::find($id);
        return view('backend.department-show', compact('department'));
    }
}
