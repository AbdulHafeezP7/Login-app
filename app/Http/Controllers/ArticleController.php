<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ArticleRequest;
use App\Rules\NotEmptyHtml;


class ArticleController extends Controller
{

    public function index()
    {
        return view('backend.articles');
    }
    public function dataTablesForArticles(Request $request)
    {
        if ($request->ajax()) {
            $query = Article::query();

            return DataTables::of($query)
                ->addColumn('title_en', function ($row) {
                    return $row->title_en;
                })
                ->addColumn('title_ar', function ($row) {
                    return $row->title_ar;
                })
                ->addColumn('image', function ($row) {
                    if ($row->image) {
                        return $imageUrl = asset('images/' . $row->image); // Ensure this path is correct

                    } else {
                        return 'No Image';
                    }
                })
                ->addColumn('article_en', function ($row) {
                    return $row->article_en;
                })
                ->addColumn('article_ar', function ($row) {
                    return $row->article_ar;
                })
                ->addColumn('slug', function ($row) {
                    return $row->slug;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->filterColumn('title_en', function ($query, $keyword) {
                    $query->where('title_en', 'like', "%{$keyword}%");
                })
                ->filterColumn('title_ar', function ($query, $keyword) {
                    $query->where('title_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('article_en', function ($query, $keyword) {
                    $query->where('article_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('article_ar', function ($query, $keyword) {
                    $query->where('article_ar', 'like', "%{$keyword}%");
                })
                ->filterColumn('slug', function ($query, $keyword) {
                    $query->where('slug', 'like', "%{$keyword}%");
                })
                ->make(true);
        }
    }
    public function addArticles()
    {
        return view('backend.articlesAdd');
    }

    public function store(ArticleRequest $request)
    {
        try {
            $request->validate([
                'title_en' => 'required|string|max:255',
                'title_ar' => 'required|string|max:255',
                'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'content_en' => ['required', new NotEmptyHtml],
                'content_ar' => ['required', new NotEmptyHtml],
                'slug' => 'required|string|unique:articles,slug|max:255',
            ], [
                'slug.unique' => 'The slug should be unique.',
            ]);

            $article = new Article;
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->article_en = $request->content_en;
            $article->article_ar = $request->content_ar;
            $article->slug = $request->slug;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $article->image = $imageName;
            }
            $article->save();

            return response()->json(['status' => true, 'message' => 'Article created successfully.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['status' => false, 'message' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }





    public function edit($id)
    {
        $article = Article::find($id);

        return view('backend.article-edit', compact('article'));
    }


    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

            $request->validate([
                'title_en' => 'required|string|max:255',
                'title_ar' => 'required|string|max:255',
                // 'content_en' => 'required',
                // 'content_ar' => 'required',
                'slug' => 'required|string|max:255|unique:articles,slug,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ], [
                'slug.unique' => 'The slug should be unique.',
            ]);

            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->article_en = $request->article_en;
            $article->article_ar = $request->article_ar;
            $article->slug = $request->slug;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $article->image = $imageName;
            }

            $article->save();

            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Article updated successfully.']);
            } else {
                return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
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
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['status' => true, 'message' => 'Article deleted successfully'],);
    }


    public function show(Request $request, $id)
    {
        $article = Article::find($id);

        return view('backend.article-show', compact('article'));
    }
}
