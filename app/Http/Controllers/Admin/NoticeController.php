<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Notice\DeleteNoticeAction;
use App\Actions\Notice\StoreNoticeAction;
use App\Actions\Notice\UpdateNoticeAction;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Notice::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Notice::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.notice.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.notice.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNoticeRequest $request
     *
     * @return mixed
     */
    public function store(StoreNoticeRequest $request)
    {
        StoreNoticeAction::run($request->validated());
        return redirect(route('admin.notice.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('notice.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        return view('admin.pages.notice.show',compact('notice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Notice $notice
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Notice $notice)
    {
        return view('admin.pages.notice.edit',compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNoticeRequest $request
     * @param Notice              $notice
     *
     * @return mixed
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        UpdateNoticeAction::run($notice,$request->validated());
        return redirect(route('admin.notice.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('notice.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notice $notice
     *
     * @return mixed
     */
    public function destroy(Notice $notice)
    {
        DeleteNoticeAction::run($notice);
        return redirect(route('admin.notice.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('notice.model')]));
    }
}
