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
                ->addColumn('tiktok_name', function ($row) {
                    return $row->tiktok_name;
                })
                ->addColumn('tiktok_image', function ($row) {
                    if ($row->tiktok_image) {
                        return $imageUrl = asset('images/' . $row->tiktok_image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('snapchat_name', function ($row) {
                    return $row->snapchat_name;
                })
                ->addColumn('snapchat_image', function ($row) {
                    if ($row->snapchat_image) {
                        return $imageUrl = asset('images/' . $row->snapchat_image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('instagram_name', function ($row) {
                    return $row->instagram_name;
                })
                ->addColumn('instagram_image', function ($row) {
                    if ($row->instagram_image) {
                        return $imageUrl = asset('images/' . $row->instagram_image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('facebook_name', function ($row) {
                    return $row->facebook_name;
                })
                ->addColumn('facebook_image', function ($row) {
                    if ($row->facebook_image) {
                        return $imageUrl = asset('images/' . $row->facebook_image); // Ensure this path is correct
                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('youtube_name', function ($row) {
                    return $row->youtube_name;
                })
                ->addColumn('youtube_image', function ($row) {
                    if ($row->youtube_image) {
                        return $imageUrl = asset('images/' . $row->youtube_image); // Ensure this path is correct
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
                ->filterColumn('tiktok_name', function ($query, $keyword) {
                    $query->where('tiktok_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('snapchat_name', function ($query, $keyword) {
                    $query->where('snapchat_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('instagram_name', function ($query, $keyword) {
                    $query->where('instagram_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('facebook_name', function ($query, $keyword) {
                    $query->where('facebook_name', 'like', "%{$keyword}%");
                })
                ->filterColumn('youtube_name', function ($query, $keyword) {
                    $query->where('youtube_name', 'like', "%{$keyword}%");
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

            $socialmedia->tiktok_name = $request->tiktok_name;
            if ($request->hasFile('tiktok_image')) {
                $tiktokImageName = time() . '_tiktok.' . $request->tiktok_image->extension();
                $request->tiktok_image->move(public_path('images'), $tiktokImageName);
                $socialmedia->tiktok_image = $tiktokImageName;
            }

            $socialmedia->snapchat_name = $request->snapchat_name;
            if ($request->hasFile('snapchat_image')) {
                $snapchatImageName = time() . '_snapchat.' . $request->snapchat_image->extension();
                $request->snapchat_image->move(public_path('images'), $snapchatImageName);
                $socialmedia->snapchat_image = $snapchatImageName;
            }

            $socialmedia->instagram_name = $request->instagram_name;
            if ($request->hasFile('instagram_image')) {
                $instagramImageName = time() . '_instagram.' . $request->instagram_image->extension();
                $request->instagram_image->move(public_path('images'), $instagramImageName);
                $socialmedia->instagram_image = $instagramImageName;
            }

            $socialmedia->facebook_name = $request->facebook_name;
            if ($request->hasFile('facebook_image')) {
                $facebookImageName = time() . '_facebook.' . $request->facebook_image->extension();
                $request->facebook_image->move(public_path('images'), $facebookImageName);
                $socialmedia->facebook_image = $facebookImageName;
            }

            $socialmedia->youtube_name = $request->youtube_name;
            if ($request->hasFile('youtube_image')) {
                $youtubeImageName = time() . '_youtube.' . $request->youtube_image->extension();
                $request->youtube_image->move(public_path('images'), $youtubeImageName);
                $socialmedia->youtube_image = $youtubeImageName;
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
            $socialmedia->tiktok_name = $request->tiktok_name;
            if ($request->hasFile('tiktok_image')) {
                $imageName = time() . '_tiktok.' . $request->tiktok_image->extension();
                $request->tiktok_image->move(public_path('images'), $imageName);
                $socialmedia->tiktok_image = $imageName;
            }
            $socialmedia->snapchat_name = $request->snapchat_name;
            if ($request->hasFile('snapchat_image')) {
                $imageName = time() . '_snapchat.' . $request->snapchat_image->extension();
                $request->snapchat_image->move(public_path('images'), $imageName);
                $socialmedia->snapchat_image = $imageName;
            }
            $socialmedia->instagram_name = $request->instagram_name;
            if ($request->hasFile('instagram_image')) {
                $imageName = time() . '_instagram.' . $request->instagram_image->extension();
                $request->instagram_image->move(public_path('images'), $imageName);
                $socialmedia->instagram_image = $imageName;
            }
            $socialmedia->facebook_name = $request->facebook_name;
            if ($request->hasFile('facebook_image')) {
                $imageName = time() . '_facebook.' . $request->facebook_image->extension();
                $request->facebook_image->move(public_path('images'), $imageName);
                $socialmedia->facebook_image = $imageName;
            }
            $socialmedia->youtube_name = $request->youtube_name;
            if ($request->hasFile('youtube_image')) {
                $imageName = time() . '_youtube.' . $request->youtube_image->extension();
                $request->youtube_image->move(public_path('images'), $imageName);
                $socialmedia->youtube_image = $imageName;
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
        return response()->json(['status' => true, 'message' => 'Social Media deleted successfully'],'');
    }
    public function show(Request $request, $id)
    {
        $socialmedia = Socialmedia::find($id);

        return view('backend.socialmedia-show', compact('socialmedia'));
    }
}
