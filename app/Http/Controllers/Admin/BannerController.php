<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Banner\DeleteBannerAction;
use App\Actions\Banner\StoreBannerAction;
use App\Actions\Banner\UpdateBannerAction;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Banner::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Banner::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.banner.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title);
                             })
                             ->filterColumn('title', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('description', function ($row) {
                                 return Str::limit($row->description);
                             })
                             ->filterColumn('description', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'description')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('button', function ($row) {
                                 return Str::limit($row->button);
                             })
                             ->addColumn('link', function ($row) {
                                 return Str::limit($row->link);
                             })
                             ->addColumn('gravity', function ($row) {
                                 return Str::limit($row->gravity);
                             })
                             ->addColumn('click', function ($row) {
                                 return Str::limit($row->click);
                             })
                             ->addColumn('limit', function ($row) {
                                 return Str::limit($row->limit);
                             })
                             ->addColumn('published', function ($row) {
                                 return Str::limit($row->published);
                             })
                             ->addColumn('expire_at', function ($row) {
                                 return Str::limit($row->expire_at);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.banner.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.banner.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBannerRequest $request
     *
     * @return mixed
     */
    public function store(StoreBannerRequest $request)
    {
        StoreBannerAction::run($request->validated());
        return redirect(route('admin.banner.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('banner.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('admin.pages.banner.show', compact('banner'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Banner $banner
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Banner $banner)
    {
        return view('admin.pages.banner.edit', compact('banner'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBannerRequest $request
     * @param Banner              $banner
     *
     * @return mixed
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        UpdateBannerAction::run($banner, $request->validated());
        return redirect(route('admin.banner.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('banner.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     *
     * @return mixed
     */
    public function destroy(Banner $banner)
    {
        DeleteBannerAction::run($banner);
        return redirect(route('admin.banner.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('banner.model')]));
    }
}
