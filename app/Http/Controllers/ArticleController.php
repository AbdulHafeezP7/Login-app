<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;

// Controller For Article
class ArticleController extends Controller
{
    // View Article Index
    public function index()
    {
        return view('backend.articles');
    }
    // Datatable of Article
    public function dataTablesForArticles()
    {
        $query = Article::query();
        return DataTables::of($query)
            ->addColumn('title_en', function ($row) {
                return $row->title_en;
            })
            ->addColumn('title_ar', function ($row) {
                return $row->title_ar;
            })
            ->addColumn('content_en', function ($row) {
                return $row->content_en;
            })
            ->addColumn('content_ar', function ($row) {
                return $row->content_ar;
            })
            ->addColumn('image', function ($row) {
                if ($row->image) {
                    return $imageUrl = asset('images/' . $row->image);
                } else {
                    return 'No Image';
                }
            })
            ->addColumn('slug', function ($row) {
                return $row->slug;
            })
            ->addColumn('sort', function ($row) {
                return $row->sort;
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
            ->filterColumn('content_en', function ($query, $keyword) {
                $query->where('content_en', 'like', "%{$keyword}%");
            })
            ->filterColumn('content_ar', function ($query, $keyword) {
                $query->where('content_ar', 'like', "%{$keyword}%");
            })
            ->filterColumn('slug', function ($query, $keyword) {
                $query->where('slug', 'like', "%{$keyword}%");
            })
            ->orderColumn('sort', function ($query) {
                $query->orderBy('sort', 'asc');
            })
            ->make(true);
    }
    // Add Articles
    public function addArticles()
    {
        return view('backend.articlesAdd');
    }
    // Store Articles
    public function store(ArticleRequest $request)
    {
        try {
            $totalArticles = Article::count();
            $article = new Article;
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->content_en = $request->content_en;
            $article->content_ar = $request->content_ar;
            $article->slug = $request->slug;
            $article->sort = $totalArticles + 1;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $article->image = $imageName;
            }
            $article->save();
            return response()->json(['status' => true, 'message' => 'Article created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // Sort Decrement Function For Article
    public function articleDecrement(Request $request)
    {
        $article = Article::find($request->articleId);
        $sort = ($article->sort != "") ? --$article->sort : 0;
        if ($sort >= 1) {
            $articleDownData = Article::where('sort', $sort)->first();
            if ($articleDownData) {
                $newSort = ($articleDownData->sort == 0 || $articleDownData->sort == null) ? 0 : $articleDownData->sort;
                $articleDownData->sort = $newSort + 1;
                $articleDownData->save();
            }
            $article->sort = $sort;
            $article->save();
        }
        return response()->json(['status' => true, 'message' => 'Article sorted successfully.']);
    }
    // Sort Increment Function For Article
    public function articleIncrement(Request $request)
    {
        $article = Article::find($request->articleId);
        $sort = ++$article->sort;
        $articleCount = Article::count('id');
        if ($sort <= $articleCount) {
            $articleUpData = Article::where('sort', $sort)->first();
            if ($articleUpData) {
                $newSort = ($articleUpData->sort == 0 || $articleUpData->sort == null) ? 0 : $articleUpData->sort;
                $articleUpData->sort = $newSort - 1;
                $articleUpData->save();
            }
            $article->sort = $sort;
            $article->save();
        }
        return response()->json(['status' => true, 'message' => 'Article sorted successfully.']);
    }
    // Edit Articles
    public function edit($id)
    {
        $article = Article::find($id);
        return view('backend.article-edit', compact('article', 'id'));
    }
    // Update Articles
    public function update(ArticleUpdateRequest $request)
    {
        try {
            $article = Article::findOrFail($request->id);
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->content_en = $request->content_en;
            $article->content_ar = $request->content_ar;
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
    // Delete Articles
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['status' => true, 'message' => 'Article deleted successfully']);
    }
    // View Articles
    public function show(Request $request, $id)
    {
        $article = Article::find($id);
        return view('backend.article-show', compact('article'));
    }
}
