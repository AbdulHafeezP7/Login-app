<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;

// Controller for managing articles
class ArticleController extends Controller
{
    // Display the article index view
    public function index()
    {
        return view('backend.articles');
    }

    // Retrieve and return DataTable for articles
    public function dataTablesForArticles()
    {
        $query = Article::query();

        // Return the DataTable representation of articles
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
                return $row->image ? asset('images/' . $row->image) : 'No Image';
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
            // Filter articles by title (English)
            ->filterColumn('title_en', function ($query, $keyword) {
                $query->where('title_en', 'like', "%{$keyword}%");
            })
            // Filter articles by title (Arabic)
            ->filterColumn('title_ar', function ($query, $keyword) {
                $query->where('title_ar', 'like', "%{$keyword}%");
            })
            // Filter articles by content (English)
            ->filterColumn('content_en', function ($query, $keyword) {
                $query->where('content_en', 'like', "%{$keyword}%");
            })
            // Filter articles by content (Arabic)
            ->filterColumn('content_ar', function ($query, $keyword) {
                $query->where('content_ar', 'like', "%{$keyword}%");
            })
            // Filter articles by slug
            ->filterColumn('slug', function ($query, $keyword) {
                $query->where('slug', 'like', "%{$keyword}%");
            })
            // Order articles by sort value
            ->orderColumn('sort', function ($query) {
                $query->orderBy('sort', 'asc');
            })
            ->make(true);
    }

    // Display the view for adding new articles
    public function addArticles()
    {
        return view('backend.articlesAdd');
    }

    // Store a new article in the database
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

            // Handle image upload
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

    // Decrement the sort order of an article
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

    // Increment the sort order of an article
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

    // Display the edit form for an article
    public function edit($id)
    {
        $article = Article::find($id);
        return view('backend.article-edit', compact('article', 'id'));
    }

    // Update an existing article in the database
    public function update(ArticleUpdateRequest $request)
    {
        try {
            $article = Article::findOrFail($request->id);
            $article->title_en = $request->title_en;
            $article->title_ar = $request->title_ar;
            $article->content_en = $request->content_en;
            $article->content_ar = $request->content_ar;
            $article->slug = $request->slug;

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $article->image = $imageName;
            }

            $article->save();

            // Return response based on the request type
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Article updated successfully.']);
            } else {
                return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->validator->errors()->first()], 422);
            } else {
                return back()->with('error', $e->validator->errors()->first());
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 400);
            } else {
                return back()->with('error', $e->getMessage());
            }
        }
    }

    // Delete an article from the database
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['status' => true, 'message' => 'Article deleted successfully']);
    }

    // Display the details of an article
    public function show(Request $request, $id)
    {
        $article = Article::find($id);
        return view('backend.article-show', compact('article'));
    }
}