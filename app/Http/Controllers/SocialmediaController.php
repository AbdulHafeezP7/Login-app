<?php

namespace App\Http\Controllers;

use App\Models\Socialmedia;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SocialmediaRequest;
use App\Http\Requests\SocialmediaUpdateRequest;

class SocialmediaController extends Controller
{
    public function index()
    {
        return view('backend.socialmedias');
    }
    public function dataTablesForSocialmedias()
    {

        $query = Socialmedia::query();
        return DataTables::of($query)
            ->addColumn('socialmedia_url', function ($row) {
                return $row->socialmedia_url;
            })
            ->addColumn('socialmedia_image', function ($row) {
                if ($row->socialmedia_image) {
                    return $imageUrl = asset('images/' . $row->socialmedia_image); // Ensure this path is correct
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
            ->filterColumn('socialmedia_url', function ($query, $keyword) {
                $query->where('socialmedia_url', 'like', "%{$keyword}%");
            })
            ->orderColumn('sort', function ($query) {
                $query->orderBy('sort', 'asc');
            })
            ->make(true);
    }
    public function addSocialmedias()
    {
        return view('backend.socialmediasAdd');
    }
    public function store(SocialmediaRequest $request)
    {
        try {
            $totalSocialmedias = Socialmedia::count();
            $socialmedia = new Socialmedia;

            $socialmedia->socialmedia_url = $request->socialmedia_url;
            if ($request->hasFile('socialmedia_image')) {
                $socialmediaImageName = time() . '_socialmedia.' . $request->socialmedia_image->extension();
                $request->socialmedia_image->move(public_path('images'), $socialmediaImageName);
                $socialmedia->socialmedia_image = $socialmediaImageName;
            }

            $socialmedia->sort = $totalSocialmedias + 1;
            $socialmedia->save();
            return response()->json(['status' => true, 'message' => 'Social Media created successfully.']);
        } catch (\Exception $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function socialmediaDecrement(Request $request)
    {
        $socialmedia = Socialmedia::find($request->socialmediaId);
        $sort = --$socialmedia->sort;
        if ($sort >= 1) {
            $socialmediaDownData = Socialmedia::where('sort', $sort)->first();
            if ($socialmediaDownData) {
                $newSort = ($socialmediaDownData->sort == 0 || $socialmediaDownData->sort == null) ? 0 : $socialmediaDownData->sort;
                $socialmediaDownData->sort = $newSort + 1;
                $socialmediaDownData->save();
            }
            $socialmedia->sort = $sort;
            $socialmedia->save();
        }
        return response()->json(['status' => true, 'message' => 'Social Media sorted successfully.']);
    }
    public function socialmediaIncrement(Request $request)
    {
        $socialmedia = Socialmedia::find($request->socialmediaId);
        $sort = ++$socialmedia->sort;
        $socialmediaCount = Socialmedia::count('id');
        if ($sort <= $socialmediaCount) {
            $socialmediaUpData = Socialmedia::where('sort', $sort)->first();
            if ($socialmediaUpData) {
                $newSort = ($socialmediaUpData->sort == 0 || $socialmediaUpData->sort == null) ? 0 : $socialmediaUpData->sort;
                $socialmediaUpData->sort = $newSort - 1;
                $socialmediaUpData->save();
            }
            $socialmedia->sort = $sort;
            $socialmedia->save();
        }
        return response()->json(['status' => true, 'message' => 'Social Media sorted successfully.']);
    }
    public function edit($id)
    {
        $socialmedia = Socialmedia::find($id);

        return view('backend.socialmedia-edit', compact('socialmedia', 'id'));
    }
    public function update(SocialmediaUpdateRequest $request)
    {
        try {
            $socialmedia = Socialmedia::findOrFail($request->id);
            $socialmedia->socialmedia_url = $request->socialmedia_url;
            if ($request->hasFile('socialmedia_image')) {
                $socialmediaImageName = time() . '_socialmedia.' . $request->socialmedia_image->extension();
                $request->socialmedia_image->move(public_path('images'), $socialmediaImageName);
                $socialmedia->socialmedia_image = $socialmediaImageName;
            }
            $socialmedia->save();
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Social Media updated successfully.']);
            } else {
                return redirect()->route('socialmedias.index')->with('success', 'Social Media updated successfully.');
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
        $socialmedia = Socialmedia::findOrFail($id);
        $socialmedia->delete();
        return response()->json(['status' => true, 'message' => 'Social Media deleted successfully']);
    }
    public function show(Request $request, $id)
    {
        $socialmedia = Socialmedia::find($id);

        return view('backend.socialmedia-show', compact('socialmedia'));
    }
}
