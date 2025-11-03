<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Opinion\DeleteOpinionAction;
use App\Actions\Opinion\StoreOpinionAction;
use App\Actions\Opinion\UpdateOpinionAction;
use App\Helpers\Constants;
use App\Helpers\DatatableHelper;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Requests\UpdateOpinionRequest;
use App\Models\Opinion;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OpinionController extends BaseWebController
{
    
    public function __construct()
    {
        $this->authorizeResource(Opinion::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Opinion::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.opinion.index_options', ['row' => $row]);
                             })
                             ->addColumn('published', function ($row) {
                                 return DatatableHelper::published($row->published);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title, 50);
                             })
                             ->filterColumn('title', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('company', function ($row) {
                                 return Str::limit($row->company, 50);
                             })
                             ->filterColumn('company', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'company')
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
        return view('admin.pages.opinion.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.opinion.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOpinionRequest $request
     *
     * @return mixed
     */
    public function store(StoreOpinionRequest $request)
    {
        StoreOpinionAction::run($request->validated());
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('opinion.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Opinion $opinion)
    {
        return view('admin.pages.opinion.show', compact('opinion'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Opinion $opinion
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Opinion $opinion)
    {
        return view('admin.pages.opinion.edit', compact('opinion'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOpinionRequest $request
     * @param Opinion              $opinion
     *
     * @return mixed
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion)
    {
        UpdateOpinionAction::run($opinion, $request->validated());
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('opinion.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Opinion $opinion
     *
     * @return mixed
     */
    public function destroy(Opinion $opinion)
    {
        DeleteOpinionAction::run($opinion);
        return redirect(route('admin.opinion.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('opinion.model')]));
    }
}
