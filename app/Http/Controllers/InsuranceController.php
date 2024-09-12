<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\InsuranceRequest;
use App\Http\Requests\InsuranceUpdateRequest;

class InsuranceController extends Controller
{
    public function index()
    {
        return view('backend.insurances');
    }
    public function dataTablesForInsurances()
    {
            $query = Insurance::query();
            return DataTables::of($query)
                ->addColumn('insurance_en', function ($row) {
                    return $row->insurance_en;
                })
                ->addColumn('insurance_ar', function ($row) {
                    return $row->insurance_ar;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('sort', function ($row) {
                    return $row->sort;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('insurance_en', function ($query, $keyword) {
                    $query->where('insurance_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('insurance_ar', function ($query, $keyword) {
                    $query->where('insurance_ar', 'like', "%{$keyword}%");
                })
                ->orderColumn('sort', function ($query) {
                    $query->orderBy('sort', 'asc');
                })
                ->make(true);
    }
    public function addInsurances()
    {
        return view('backend.insurancesAdd');
    }
    public function store(InsuranceRequest $request)
    {
        try {
            $totalInsurances = Insurance::count();
            $insurance = new Insurance;
            $insurance->insurance_en = $request->insurance_en;
            $insurance->insurance_ar = $request->insurance_ar;
            $insurance->sort = $totalInsurances + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $insurance->image = $imageName;
            }
            $insurance->save();
            return response()->json(['status' => true, 'message' => 'Insurance created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function insuranceDecrement(Request $request)
    {
        $insurance = Insurance::find($request->insuranceId);
        $sort = --$insurance->sort;
        if ($sort >= 1) {
            $insuranceDownData = Insurance::where('sort', $sort)->first();
            if ($insuranceDownData) {
                $newSort = ($insuranceDownData->sort == 0 || $insuranceDownData->sort == null) ? 0 : $insuranceDownData->sort;
                $insuranceDownData->sort = $newSort + 1;
                $insuranceDownData->save();
            }
            $insurance->sort = $sort;
            $insurance->save();
        }
        return response()->json(['status' => true, 'message' => 'Insurance sorted successfully.']);
    }
    public function insuranceIncrement(Request $request)
    {
        $insurance = Insurance::find($request->insuranceId);
        $sort = ++$insurance->sort;
        $insuranceCount = Insurance::count('id');
        if ($sort <= $insuranceCount) {
            $insuranceUpData = Insurance::where('sort', $sort)->first();
            if ($insuranceUpData) {
                $newSort = ($insuranceUpData->sort == 0 || $insuranceUpData->sort == null) ? 0 : $insuranceUpData->sort;
                $insuranceUpData->sort = $newSort - 1;
                $insuranceUpData->save();
            }
            $insurance->sort = $sort;
            $insurance->save();
        }
        return response()->json(['status' => true, 'message' => 'Insurance sorted successfully.']);
    }
    public function edit($id)
    {
        $insurance = Insurance::find($id);

        return view('backend.insurance-edit', compact('insurance', 'id'));
    }
    public function update(InsuranceUpdateRequest $request)
    {
        try {
            $insurance = Insurance::findOrFail($request->id);
            $insurance->insurance_en = $request->insurance_en;
            $insurance->insurance_ar = $request->insurance_ar;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $insurance->image = $imageName;
            }
            $insurance->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Insurance updated successfully.']);
            } else {
                return redirect()->route('insurances.index')->with('success', 'Insurance updated successfully.');
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
        $insurance = Insurance::findOrFail($id);
        $insurance->delete();
        return response()->json(['status' => true, 'message' => 'Insurance deleted successfully'],);
    }
    public function show(Request $request, $id)
    {
        $insurance = Insurance::find($id);

        return view('backend.insurance-show', compact('insurance'));
    }
}
