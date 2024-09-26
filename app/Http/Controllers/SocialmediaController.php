<?php

namespace App\Http\Controllers;

use App\Models\Socialmedia;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SocialmediaRequest;
use App\Http\Requests\SocialmediaUpdateRequest;

// Controller for managing social media entries
class SocialmediaController extends Controller
{
    // Display the social media index view
    public function index()
    {
        return view('backend.socialmedias');
    }

    // Return data for the social media DataTable
    public function dataTablesForSocialmedias()
    {
        $query = Socialmedia::query();
        return DataTables::of($query)
            ->addColumn('socialmedia_url', function ($row) {
                return $row->socialmedia_url;
            })
            ->addColumn('socialmedia_image', function ($row) {
                return $row->socialmedia_image ? asset('images/' . $row->socialmedia_image) : 'No Image';
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

    // Show the form for adding a new social media entry
    public function addSocialmedias()
    {
        return view('backend.socialmediasAdd');
    }

    // Store a newly created social media entry
    public function store(SocialmediaRequest $request)
    {
        try {
            $totalSocialmedias = Socialmedia::count();
            $socialmedia = new Socialmedia;
            $socialmedia->socialmedia_url = $request->socialmedia_url;

            // Handle image upload if a file is provided
            if ($request->hasFile('socialmedia_image')) {
                $socialmediaImageName = time() . '_socialmedia.' . $request->socialmedia_image->extension();
                $request->socialmedia_image->move(public_path('images'), $socialmediaImageName);
                $socialmedia->socialmedia_image = $socialmediaImageName;
            }

            $socialmedia->sort = $totalSocialmedias + 1; // Set the sort order
            $socialmedia->save();
            return response()->json(['status' => true, 'message' => 'Social Media created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }

    // Decrement the sort order for a social media entry
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

    // Increment the sort order for a social media entry
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

    // Show the form for editing a social media entry
    public function edit($id)
    {
        $socialmedia = Socialmedia::find($id);
        return view('backend.socialmedia-edit', compact('socialmedia', 'id'));
    }

    // Update an existing social media entry
    public function update(SocialmediaUpdateRequest $request)
    {
        try {
            $socialmedia = Socialmedia::findOrFail($request->id);
            $socialmedia->socialmedia_url = $request->socialmedia_url;

            // Handle image upload if a file is provided
            if ($request->hasFile('socialmedia_image')) {
                $socialmediaImageName = time() . '_socialmedia.' . $request->socialmedia_image->extension();
                $request->socialmedia_image->move(public_path('images'), $socialmediaImageName);
                $socialmedia->socialmedia_image = $socialmediaImageName;
            }

            $socialmedia->save();

            // Return response based on request type
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

    // Delete a social media entry
    public function destroy($id)
    {
        $socialmedia = Socialmedia::findOrFail($id);
        $socialmedia->delete();
        return response()->json(['status' => true, 'message' => 'Social Media deleted successfully']);
    }

    // Show a specific social media entry
    public function show(Request $request, $id)
    {
        $socialmedia = Socialmedia::find($id);
        return view('backend.socialmedia-show', compact('socialmedia'));
    }
}
