<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\OfferRequest;
use App\Http\Requests\OfferUpdateRequest;

class OfferController extends Controller
{
    public function index()
    {
        return view('backend.offers');
    }
    public function dataTablesForOffers()
    {
            $query = Offer::query();
            return DataTables::of($query)
                ->addColumn('offer_en', function ($row) {
                    return $row->offer_en;
                })
                ->addColumn('offer_ar', function ($row) {
                    return $row->offer_ar;
                })
                ->addColumn('sort', function ($row) {
                    return $row->sort;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('actual_price', function ($row) {
                    return $row->actual_price;
                })
                ->addColumn('offer_price', function ($row) {
                    return $row->offer_price;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('offer_en', function ($query, $keyword) {
                    $query->where('offer_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('offer_ar', function ($query, $keyword) {
                    $query->where('offer_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('actual_price', function ($query, $keyword) {
                    $query->where('actual_price', 'like', "%{$keyword}%");
                })
                ->filterColumn('offer_price', function ($query, $keyword) {
                    $query->where('offer_price', 'like', "%{$keyword}%");
                })
                ->orderColumn('sort', function ($query) {
                    $query->orderBy('sort', 'asc');
                })
                ->make(true);
    }
    public function addOffers()
    {
        return view('backend.offersAdd');
    }
    public function store(OfferRequest $request)
    {
        try {
            $totalOffers = Offer::count();
            $offer = new Offer;
            $offer->offer_en = $request->offer_en;
            $offer->offer_ar = $request->offer_ar;
            $offer->actual_price = $request->actual_price;
            $offer->offer_price = $request->offer_price;
            $offer->sort = $totalOffers + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $offer->image = $imageName;
            }
            $offer->save();
            return response()->json(['status' => true, 'message' => 'Offer created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function offerDecrement(Request $request)
    {
        $offer = Offer::find($request->offerId);
        $sort = --$offer->sort;
        if ($sort >= 1) {
            $offerDownData = Offer::where('sort', $sort)->first();
            if ($offerDownData) {
                $newSort = ($offerDownData->sort == 0 || $offerDownData->sort == null) ? 0 : $offerDownData->sort;
                $offerDownData->sort = $newSort + 1;
                $offerDownData->save();
            }
            $offer->sort = $sort;
            $offer->save();
        }
        return response()->json(['status' => true, 'message' => 'Offer sorted successfully.']);
    }
    public function offerIncrement(Request $request)
    {
        $offer = Offer::find($request->offerId);
        $sort = ++$offer->sort;
        $offerCount = Offer::count('id');
        if ($sort <= $offerCount) {
            $offerUpData = Offer::where('sort', $sort)->first();
            if ($offerUpData) {
                $newSort = ($offerUpData->sort == 0 || $offerUpData->sort == null) ? 0 : $offerUpData->sort;
                $offerUpData->sort = $newSort - 1;
                $offerUpData->save();
            }
            $offer->sort = $sort;
            $offer->save();
        }
        return response()->json(['status' => true, 'message' => 'Offer sorted successfully.']);
    }
    public function edit($id)
    {
        $offer = Offer::find($id);

        return view('backend.offer-edit', compact('offer', 'id'));
    }
    public function update(OfferUpdateRequest $request)
    {
        try {
            $offer = Offer::findOrFail($request->id);
            $offer->offer_en = $request->offer_en;
            $offer->offer_ar = $request->offer_ar;
            $offer->actual_price = $request->actual_price;
            $offer->offer_price = $request->offer_price;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $offer->image = $imageName;
            }
            $offer->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Offer updated successfully.']);
            } else {
                return redirect()->route('offers.index')->with('success', 'Offer updated successfully.');
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
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return response()->json(['status' => true, 'message' => 'Offer deleted successfully'],'');
    }
    public function show(Request $request, $id)
    {
        $offer = Offer::find($id);

        return view('backend.offer-show', compact('offer'));
    }
}
