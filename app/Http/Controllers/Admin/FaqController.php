<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Faq\DeleteFaqAction;
use App\Actions\Faq\StoreFaqAction;
use App\Actions\Faq\UpdateFaqAction;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\Faq;
use App\Models\Opinion;
use App\Models\Ticket;
use App\Repositories\Faq\FaqRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->authorizeResource(Faq::class);
    }
    
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService, FaqRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of(Faq::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.faq.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title);
                             })
                             ->addColumn('part', function ($row) {
                                 return $row->part->value;
                             })
                             ->addColumn('published', function ($row) {
                                 return $row->published;
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.faq.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.faq.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFaqRequest $request
     *
     * @return mixed
     */
    public function store(StoreFaqRequest $request)
    {
        StoreFaqAction::run($request->validated());
        return redirect(route('admin.faq.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('faq.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        return view('admin.pages.faq.show', compact('faq'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Faq $faq
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Faq $faq)
    {
        return view('admin.pages.faq.edit', compact('faq'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFaqRequest $request
     * @param Faq              $faq
     *
     * @return mixed
     */
    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        UpdateFaqAction::run($faq, $request->validated());
        return redirect(route('admin.faq.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('faq.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     *
     * @return mixed
     */
    public function destroy(Faq $faq)
    {
        DeleteFaqAction::run($faq);
        return redirect(route('admin.faq.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('faq.model')]));
    }
}
