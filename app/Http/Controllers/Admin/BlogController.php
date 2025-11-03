<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Blog\DeleteBlogAction;
use App\Actions\Blog\StoreBlogAction;
use App\Actions\Blog\UpdateBlogAction;
use App\Helpers\Constants;
use App\Helpers\DatatableHelper;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Tags\Tag;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Blog::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService, BlogRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of(Blog::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.blog.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title, 50);
                             })
                             ->addColumn('published', function ($row) {
                                 return DatatableHelper::published($row->published);
                             })
                             ->filterColumn('title', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('categories_title', function ($row) {
                                 return Str::limit($row->categories_title, 50) ?? '';
                             })
                             ->filterColumn('categories_title', function ($query, $keyword) {
                                 $query->whereHas('categories.translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('created_at', function ($row) {
                                 return jdate($row->updated_at)->format(
                                     Constants::DEFAULT_DATE_FORMAT
                                 );
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.blog.index', [
            'filters' => $searchFieldsService->generate(User::class),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.blog.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBlogRequest $request
     *
     * @return mixed
     */
    public function store(StoreBlogRequest $request)
    {
        StoreBlogAction::run($request->validated());
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('blog.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('admin.pages.blog.show', compact('blog'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Blog $blog
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Blog $blog)
    {
        $selectedCategories = $blog->categories->map(function (Category $category) {
            return [
                'id'    => $category->id,
                'value' => $category->title,
            ];
        })->toArray();
        
        $selectedTags = $blog->tags->map(function (Tag $tag) {
            return [
                'id'    => $tag->id,
                'value' => $tag->name,
            ];
        })->toArray();
        return view('admin.pages.blog.edit', compact('blog', 'selectedCategories', 'selectedTags'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBlogRequest $request
     * @param Blog              $blog
     *
     * @return mixed
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        UpdateBlogAction::run($blog, $request->validated());
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('blog.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Blog $blog
     *
     * @return mixed
     */
    public function destroy(Blog $blog)
    {
        DeleteBlogAction::run($blog);
        return redirect(route('admin.blog.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('blog.model')]));
    }
}
