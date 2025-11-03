<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Service\DeleteServiceAction;
use App\Actions\Service\StoreServiceAction;
use App\Actions\Service\UpdateServiceAction;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\Ticket;
use App\Yajra\Column\ActionColumn;
use App\Yajra\Column\CategoriesTitleColumn;
use App\Yajra\Column\CreatedAtColumn;
use App\Yajra\Column\PublishedColumn;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Column\UpdatedAtAtColumn;
use App\Yajra\Filter\CategoriesTitleFilter;
use App\Yajra\Filter\TitleFilter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Service::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Service::query())
                             ->addIndexColumn()
                             ->addColumn('actions', new ActionColumn('admin.pages.service.index_options'))
                             ->addColumn('title', new TitleColumn())
                             ->addColumn('updated_at', new UpdatedAtAtColumn())
                             ->filterColumn('title', new TitleFilter())
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.service.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.service.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServiceRequest $request
     *
     * @return mixed
     */
    public function store(StoreServiceRequest $request)
    {
        StoreServiceAction::run($request->validated());
        return redirect(route('admin.service.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('service.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return view('admin.pages.service.show', compact('service'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Service $service)
    {
       
        return view('admin.pages.service.edit', compact('service',));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateServiceRequest $request
     * @param Service              $service
     *
     * @return mixed
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        UpdateServiceAction::run($service, $request->validated());
        return redirect(route('admin.service.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('service.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     *
     * @return mixed
     */
    public function destroy(Service $service)
    {
        DeleteServiceAction::run($service);
        return redirect(route('admin.service.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('service.model')]));
    }
}
