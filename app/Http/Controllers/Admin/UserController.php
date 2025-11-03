<?php

namespace App\Http\Controllers\Admin;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request,AdvancedSearchFieldsService $searchFieldsService,UserRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of($repository->query()->getQuery())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.user.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.user.index',[
            'filters'=>$searchFieldsService->generate(User::class)
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.user.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserRequest $request
     *
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        StoreUserAction::run($request->validated());
        return redirect(route('admin.user.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('user.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(User $user)
    {
        return view('admin.pages.user.edit',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        UpdateUserAction::run($user,$request->validated());
        return redirect(route('admin.user.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('user.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return mixed
     */
    public function destroy(User $user)
    {
        DeleteUserAction::run($user);
        return redirect(route('admin.user.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('user.model')]));
    }
}
