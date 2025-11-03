<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Server\DeleteServerAction;
use App\Actions\Server\StoreServerAction;
use App\Actions\Server\UpdateServerAction;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerRequest;
use App\Models\Server;
use App\Yajra\Column\ExpiredAtColumn;
use App\Yajra\Column\UpdatedAtAtColumn;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Server::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.server.index_options', ['row' => $row]);
                             })
                             ->addColumn('user_name', function ($row) {
                                 return $row->user->full_name;
                             })
                             ->addColumn('services_name', function ($row) {
                                 return $row->user->services->pluck('title')->implode(', ');
                             })
                             ->addColumn('expired_at', new ExpiredAtColumn())
                             ->addColumn('updated_at', new UpdatedAtAtColumn())
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.server.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.server.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreServerRequest $request
     *
     * @return mixed
     */
    public function store(StoreServerRequest $request)
    {
        StoreServerAction::run($request->validated());
        return redirect(route('admin.server.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('server.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Server $server)
    {
        return view('admin.pages.server.show', compact('server'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Server $server
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Server $server)
    {
        return view('admin.pages.server.edit', compact('server'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateServerRequest $request
     * @param Server              $server
     *
     * @return mixed
     */
    public function update(UpdateServerRequest $request, Server $server)
    {
        UpdateServerAction::run($server, $request->validated());
        return redirect(route('admin.server.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('server.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Server $server
     *
     * @return mixed
     */
    public function destroy(Server $server)
    {
        DeleteServerAction::run($server);
        return redirect(route('admin.server.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('server.model')]));
    }
}
