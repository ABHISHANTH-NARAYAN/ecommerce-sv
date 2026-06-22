<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Yajra\DataTables\Facades\DataTables;
use App\Actions\NewsStoreAction;
use App\Http\Requests\Admin\NewsStoreRequest;
use App\Actions\NewsUpdateAction;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $news = News::with('category')->latest();

            // Status Filter
            if ($request->filled('status')) {
                $news->where('status', $request->status);
            }

            // Category Filter
            if ($request->filled('category_id')) {
                $news->where('news_category_id', $request->category_id);
            }

            return DataTables::of($news)

                ->addIndexColumn()

                ->addColumn('category', function ($item) {
                    return $item->category?->name ?? 'No Category';
                })

                ->addColumn('image', function ($item) {
                    return $item->image
                        ? '<img src="' . asset('storage/' . $item->image) . '" width="80">'
                        : 'No Image';
                })

                ->addColumn('action', function ($item) {
                    return '
                        <a href="' . route('admin.news.show', $item->id) . '">View</a> |
                        <a href="' . route('admin.news.edit', $item->id) . '">Edit</a> |
                        <form action="' . route('admin.news.destroy', $item->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" onclick="return confirm(\'Delete this news?\')">
                                Delete
                            </button>
                        </form>
                    ';
                })

                ->rawColumns(['image', 'action'])
                ->make(true);
        }

        return view('admin.news.indexnews', [
            'categories' => NewsCategory::all()
        ]);
    }

    public function create()
    {
        return view('admin.news.createnews', [
            'categories' => NewsCategory::all()
        ]);
    }

    public function store(
        NewsStoreRequest $request,
        NewsStoreAction $action
    ) {
        $action->execute(
            $request->validated() + [
                'image' => $request->file('image')
            ]
        );

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News Created Successfully');
    }

    public function show(News $news)
    {
        return view('admin.news.shownews', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.editnews', [
            'news' => $news,
            'categories' => NewsCategory::all()
        ]);
    }

   public function update(
    NewsStoreRequest $request,
    News $news,
    NewsUpdateAction $action
)
{
    $action->execute(
        $news,
        $request->validated() + [
            'image' => $request->file('image')
        ]
    );

    return redirect()
        ->route('admin.news.index')
        ->with('success', 'News Updated Successfully');
}

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News Deleted Successfully');
    }
}