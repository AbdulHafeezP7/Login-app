<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\PartnerRequest;
use App\Http\Requests\PartnerUpdateRequest;

// Controller For Partner
class PartnerController extends Controller
{
    // View Partner Index
    public function index()
    {
        return view('backend.partners');
    }
    // Datatable For Partner
    public function dataTablesForPartners()
    {
        $query = Partner::query();
        return DataTables::of($query)
            ->addColumn('partner_en', function ($row) {
                return $row->partner_en;
            })
            ->addColumn('partner_ar', function ($row) {
                return $row->partner_ar;
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
            ->filterColumn('partner_en', function ($query, $keyword) {
                $query->where('partner_en', 'like', "%{$keyword}%");
            })
            ->filterColumn('partner_ar', function ($query, $keyword) {
                $query->where('partner_ar', 'like', "%{$keyword}%");
            })
            ->orderColumn('sort', function ($query) {
                $query->orderBy('sort', 'asc');
            })
            ->make(true);
    }
    // Add Partner
    public function addPartners()
    {
        return view('backend.partnersAdd');
    }
    // Store PArtner
    public function store(PartnerRequest $request)
    {
        try {
            $totalPartners = Partner::count();
            $partner = new Partner;
            $partner->partner_en = $request->partner_en;
            $partner->partner_ar = $request->partner_ar;
            $partner->sort = $totalPartners + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $partner->image = $imageName;
            }
            $partner->save();
            return response()->json(['status' => true, 'message' => 'Partner created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // Sort Decrement Function For Partner
    public function partnerDecrement(Request $request)
    {
        $partner = Partner::find($request->partnerId);
        $sort = --$partner->sort;
        if ($sort >= 1) {
            $partnerDownData = Partner::where('sort', $sort)->first();
            if ($partnerDownData) {
                $newSort = ($partnerDownData->sort == 0 || $partnerDownData->sort == null) ? 0 : $partnerDownData->sort;
                $partnerDownData->sort = $newSort + 1;
                $partnerDownData->save();
            }
            $partner->sort = $sort;
            $partner->save();
        }
        return response()->json(['status' => true, 'message' => 'Partner sorted successfully.']);
    }
    // Sort Increment Function For Partner
    public function partnerIncrement(Request $request)
    {
        $partner = Partner::find($request->partnerId);
        $sort = ++$partner->sort;
        $partnerCount = Partner::count('id');
        if ($sort <= $partnerCount) {
            $partnerUpData = Partner::where('sort', $sort)->first();
            if ($partnerUpData) {
                $newSort = ($partnerUpData->sort == 0 || $partnerUpData->sort == null) ? 0 : $partnerUpData->sort;
                $partnerUpData->sort = $newSort - 1;
                $partnerUpData->save();
            }
            $partner->sort = $sort;
            $partner->save();
        }
        return response()->json(['status' => true, 'message' => 'Partner sorted successfully.']);
    }
    // Edit Partner
    public function edit($id)
    {
        $singlePartner = Partner::find($id);

        return view('backend.partner-edit', compact('singlePartner', 'id'));
    }
    // Update Partner
    public function update(PartnerUpdateRequest $request)
    {
        try {
            $partner = Partner::findOrFail($request->id);
            $partner->partner_en = $request->partner_en;
            $partner->partner_ar = $request->partner_ar;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $partner->image = $imageName;
            }
            $partner->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Partner updated successfully.']);
            } else {
                return redirect()->route('partners.index')->with('success', 'Partner updated successfully.');
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
    // Delete Partner
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();
        return response()->json(['status' => true, 'message' => 'Partner deleted successfully']);
    }
    // View Partner
    public function show(Request $request, $id)
    {
        $singlePartner = Partner::find($id);
        return view('backend.partner-show', compact('singlePartner'));
    }
}
