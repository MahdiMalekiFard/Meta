<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Setting\DeleteSettingAction;
use App\Actions\Setting\StoreSettingAction;
use App\Actions\Setting\UpdateSettingAction;
use App\Enums\SettingEnum;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Models\Ticket;
use App\Yajra\Column\ActionColumn;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Setting::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Setting::query())
                             ->addIndexColumn()
                             ->addColumn('actions', new ActionColumn('admin.pages.setting.index_options'))
                             ->addColumn('help', function (Setting $setting) {
                                 return __($setting->help)??'';
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.setting.index');
    }
    
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Setting $setting
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Setting $setting)
    {
        $roles = Role::all();
        return view('admin.pages.setting.edit', compact('setting','roles'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSettingRequest $request
     * @param Setting              $setting
     *
     * @return mixed
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        UpdateSettingAction::run($setting, $request->validated());
        return redirect(route('admin.setting.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('setting.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Setting $setting
     *
     * @return mixed
     */
    public function destroy(Setting $setting)
    {
        DeleteSettingAction::run($setting);
        return redirect(route('admin.setting.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('setting.model')]));
    }
}
