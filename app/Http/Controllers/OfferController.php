<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\OfferRequest;


class OfferController extends Controller
{

    public function index()
    {
        return view('backend.offers');
    }
    public function dataTablesForOffers(Request $request)
    {
        if ($request->ajax()) {
            $query = Offer::query();

            return DataTables::of($query)
                ->addColumn('offer_en', function ($row) {
                    return $row->offer_en;
                })
                ->addColumn('offer_ar', function ($row) {
                    return $row->offer_ar;
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
                ->make(true);
        }
    }
    public function addOffers()
    {
        return view('backend.offersAdd');
    }

    public function store(OfferRequest $request)
    {

        try {
            $request->validate([
                'offer_en' => 'required|string|max:255',
                'offer_ar' => 'required|string|max:255',
                'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'actual_price' => 'required|string|max:255',
                'offer_price' => 'required|string|max:255',
            ]);
            $offer = new Offer;
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
            return response()->json(['status' => true, 'message' => 'Offer created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }




    public function edit($id)
    {
        $offer = Offer::find($id);

        return view('backend.offer-edit', compact('offer'));
    }


    public function update(Request $request, $id)
    {
        try {


            $offer = Offer::findOrFail($id);

            $request->validate([
                'offer_en' => 'required|string|max:255',
                'offer_ar' => 'required|string|max:255',
                // 'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'actual_price' => 'required|string|max:255',
                'offer_price' => 'required|string|max:255',
            ]);
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

        return response()->json(['status' => true, 'message' => 'Offer deleted successfully'],);
    }


    public function show(Request $request, $id)
    {
        $offer = Offer::find($id);

        return view('backend.offer-show', compact('offer'));
    }
}
