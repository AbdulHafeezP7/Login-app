<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DoctorRequest;


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
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('department', function ($row) {
                    return $row->department_name; // Use the department name from the join
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
                ->make(true);
        }
    }

    public function addDoctors()
    {
        $departments = DB::table('departments')->pluck('department_en', 'id');
        return view('backend.doctorsAdd', compact('departments'));
    }

    public function store(DoctorRequest $request)
    {

        try {
            
            $doctor = new Doctor;
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
            return response()->json(['status' => true, 'message' => 'Doctor created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }




    public function edit($id)
    {
        $doctor = Doctor::find($id);
        $departments = DB::table('departments')->pluck('department_en', 'id');
        return view('backend.doctor-edit', compact('departments', 'doctor'));
    }


    public function update(Request $request, $id)
    {
        try {


            $doctor = Doctor::findOrFail($id);

            $request->validate([
                'name_en' => [
                    'required',
                    'regex:/^Dr\.\s.+$/',
                    'string',
                    'max:255'
                ],
                'name_ar' => [
                    'required',
                    'regex:/^Dr\.\s.+$/',
                    'string',
                    'max:255'
                ],
                'doctor_description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'department' => 'required|string',
            ]);

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

    public function toggleAvailibility(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->availability = $request->input('availability');
        if ($doctor->save()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
