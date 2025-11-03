<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Like\DeleteLikeAction;
use App\Actions\Like\StoreLikeAction;
use App\Actions\Like\UpdateLikeAction;
use App\Helpers\Utils;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use App\Models\Like;
use App\Models\Ticket;
use App\Repositories\Like\LikeRepositoryInterface;
use App\Services\GetReference;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class LikeController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Like::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request,LikeRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of($repository->builder(array_merge($request->all(), [
                'search' => null,
            ])))
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.like.index_options', ['row' => $row]);
                             })
                             ->addColumn('user_id', function ($row) {
                                 return Str::limit($row->user->name);
                             })
                             ->addColumn('likeable_type', function ($row) {
                                 return Utils::getKeyFromEloquent($row->likeable_type);
                             })
                             ->addColumn('likeable_id', function ($row) {
                                 return Str::limit($row->likeable->title??$row->likeable->name);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.like.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.like.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLikeRequest $request
     *
     * @return mixed
     */
    public function store(StoreLikeRequest $request)
    {
        StoreLikeAction::run($request->validated());
        return redirect(route('admin.like.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('like.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Like $like)
    {
        return view('admin.pages.like.show', compact('like'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Like $like
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Like $like)
    {
        return view('admin.pages.like.edit', compact('like'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLikeRequest $request
     * @param Like              $like
     *
     * @return mixed
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        UpdateLikeAction::run($like, $request->validated());
        return redirect(route('admin.like.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('like.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Like $like
     *
     * @return mixed
     */
    public function destroy(Like $like)
    {
        DeleteLikeAction::run($like);
        return redirect(route('admin.like.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('like.model')]));
    }
}
