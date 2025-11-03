<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Province\DeleteProvinceAction;
use App\Actions\Province\StoreProvinceAction;
use App\Actions\Province\UpdateProvinceAction;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use App\Models\Province;
use App\Models\Ticket;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Province::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService, ProvinceRepositoryInterface $provinceRepository)
    {
        if ($request->ajax()) {
            return Datatables::of(Province::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.province.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title);
                             })
                             ->addColumn('country_title', function ($row) {
                                 return Str::limit($row->country->title);
                             })
                             ->filterColumn('country_title', function ($query, $keyword) {
                                 $query->whereHas('country.translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->filterColumn('title', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.province.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.province.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProvinceRequest $request
     *
     * @return mixed
     */
    public function store(StoreProvinceRequest $request)
    {
        StoreProvinceAction::run($request->validated());
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('province.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
     
        return view('admin.pages.province.show',compact('province'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Province $province
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Province $province)
    {
        $selectedCountries = [
            [
                'uuid'   => $province->country->uuid,
                'value' => $province->country->title,
            ],
        ];
        return view('admin.pages.province.edit', compact('province','selectedCountries'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProvinceRequest $request
     * @param Province              $province
     *
     * @return mixed
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        UpdateProvinceAction::run($province, $request->validated());
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('province.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Province $province
     *
     * @return mixed
     */
    public function destroy(Province $province)
    {
        DeleteProvinceAction::run($province);
        return redirect(route('admin.province.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('province.model')]));
    }
}
