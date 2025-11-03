<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Module\DeleteModuleAction;
use App\Actions\Module\StoreModuleAction;
use App\Actions\Module\UpdateModuleAction;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModuleController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Module::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.module.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.module.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModuleRequest $request
     *
     * @return mixed
     */
    public function store(StoreModuleRequest $request)
    {
        StoreModuleAction::run($request->validated());
        return redirect(route('admin.module.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('module.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        return view('admin.pages.module.show',compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Module $module)
    {
        return view('admin.pages.module.edit',compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateModuleRequest $request
     * @param Module              $module
     *
     * @return mixed
     */
    public function update(UpdateModuleRequest $request, Module $module)
    {
        UpdateModuleAction::run($module,$request->validated());
        return redirect(route('admin.module.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('module.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     *
     * @return mixed
     */
    public function destroy(Module $module)
    {
        DeleteModuleAction::run($module);
        return redirect(route('admin.module.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('module.model')]));
    }
}
