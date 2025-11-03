<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Favorite\DeleteFavoriteAction;
use App\Actions\Favorite\StoreFavoriteAction;
use App\Actions\Favorite\UpdateFavoriteAction;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use App\Models\Favorite;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FavoriteController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Favorite::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.favorite.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.favorite.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.favorite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFavoriteRequest $request
     *
     * @return mixed
     */
    public function store(StoreFavoriteRequest $request)
    {
        StoreFavoriteAction::run($request->validated());
        return redirect(route('admin.favorite.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('favorite.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite)
    {
        return view('admin.pages.favorite.show',compact('favorite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Favorite $favorite
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Favorite $favorite)
    {
        return view('admin.pages.favorite.edit',compact('favorite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFavoriteRequest $request
     * @param Favorite              $favorite
     *
     * @return mixed
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        UpdateFavoriteAction::run($favorite,$request->validated());
        return redirect(route('admin.favorite.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('favorite.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Favorite $favorite
     *
     * @return mixed
     */
    public function destroy(Favorite $favorite)
    {
        DeleteFavoriteAction::run($favorite);
        return redirect(route('admin.favorite.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('favorite.model')]));
    }
}
