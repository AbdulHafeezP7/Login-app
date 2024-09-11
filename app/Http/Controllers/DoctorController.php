<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Models\Department;

class DoctorController extends Controller
{
    public function index()
    {
        return view('backend.doctors');
    }
    public function dataTablesForDoctors(Request $request)
    {
        if ($request->ajax()) {
            $query = Doctor::query()
                ->join('departments', 'doctors.department', '=', 'departments.id') // Join with departments table
                ->select('doctors.*', 'departments.department_en as department_name'); // Select the department name
            return DataTables::of($query)
                ->addColumn('name_en', function ($row) {
                    return $row->name_en;
                })
                ->addColumn('name_ar', function ($row) {
                    return $row->name_ar;
                })
                ->addColumn('doctor_description', function ($row) {
                    return $row->doctor_description;
                })
                ->addColumn('frontpage', function ($row) {
                    return $row->frontpage;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image);
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('department', function ($row) {
                    return $row->department_name;
                })
                ->addColumn('sort', function ($row) {
                    return $row->sort;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('name_en', function ($query, $keyword) {
                    $query->where('name_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('doctor_description', function ($query, $keyword) {
                    $query->where('doctor_description', 'like', "%{$keyword}%");
                })
                ->filterColumn('name_ar', function ($query, $keyword) {
                    $query->where('name_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('department', function ($query, $keyword) {
                    $query->where('departments.department_en', 'like', "%{$keyword}%");
                })
                ->orderColumn('sort', function ($query) {
                    $query->orderBy('sort', 'asc');
                })
                ->make(true);
        }
    }
    public function addDoctors()
    {
        $departments = Department::pluck('department_en', 'id');  // Fetch department names and IDs
        return view('backend.doctorsAdd', compact('departments'));
    }
    public function store(DoctorRequest $request)
    {
        try {
            $totalDoctors = Doctor::count();
            $doctor = new Doctor;
            $doctor->name_en = $request->name_en;
            $doctor->name_ar = $request->name_ar;
            $doctor->doctor_description = $request->doctor_description;
            $doctor->department = $request->department;
            $doctor->sort = $totalDoctors + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $doctor->image = $imageName;
            }
            $doctor->save();
            return response()->json(['status' => true, 'message' => 'Doctor created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function doctorDecrement(Request $request)
    {
        $doctor = Doctor::find($request->doctorId);
        $sort = --$doctor->sort;
        if ($sort >= 1) {
            $doctorDownData = Doctor::where('sort', $sort)->first();
            if ($doctorDownData) {
                $newSort = ($doctorDownData->sort == 0 || $doctorDownData->sort == null) ? 0 : $doctorDownData->sort;
                $doctorDownData->sort = $newSort + 1;
                $doctorDownData->save();
            }
            $doctor->sort = $sort;
            $doctor->save();
        }
        return response()->json(['status' => true, 'message' => 'Doctor sorted successfully.']);
    }
    public function doctorIncrement(Request $request)
    {
        $doctor = Doctor::find($request->doctorId);
        $sort = ++$doctor->sort;
        $doctorCount = Doctor::count('id');
        if ($sort <= $doctorCount) {
            $doctorUpData = Doctor::where('sort', $sort)->first();
            if ($doctorUpData) {
                $newSort = ($doctorUpData->sort == 0 || $doctorUpData->sort == null) ? 0 : $doctorUpData->sort;
                $doctorUpData->sort = $newSort - 1;
                $doctorUpData->save();
            }
            $doctor->sort = $sort;
            $doctor->save();
        }
        return response()->json(['status' => true, 'message' => 'Doctor sorted successfully.']);
    }
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $departments = Department::pluck('department_en', 'id'); // Fetching departments using the Department model
        return view('backend.doctor-edit', compact('departments', 'doctor', 'id'));
    }

    public function update(DoctorUpdateRequest $request)
    {
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->name_en = $request->name_en;
            $doctor->name_ar = $request->name_ar;
            $doctor->doctor_description = $request->doctor_description;
            $doctor->department = $request->department;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $doctor->image = $imageName;
            }
            $doctor->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Doctor updated successfully.']);
            } else {
                return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
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
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['status' => true, 'message' => 'Doctor deleted successfully'],);
    }
    public function show(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        return view('backend.doctor-show', compact('doctor'));
    }
    public function toggleFrontpage(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->frontpage = $request->input('frontpage');
        if ($doctor->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
