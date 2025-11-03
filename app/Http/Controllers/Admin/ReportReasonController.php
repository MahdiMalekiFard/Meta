<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ReportReason\DeleteReportReasonAction;
use App\Actions\ReportReason\StoreReportReasonAction;
use App\Actions\ReportReason\UpdateReportReasonAction;
use App\Http\Requests\StoreReportReasonRequest;
use App\Http\Requests\UpdateReportReasonRequest;
use App\Models\ReportReason;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ReportReasonController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(ReportReason::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(ReportReason::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.report_reason.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', function ($row) {
                                 return Str::limit($row->title);
                             })
                             ->filterColumn('title', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'title')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('description', function ($row) {
                                 return Str::limit($row->description);
                             })
                             ->filterColumn('description', function ($query, $keyword) {
                                 $query->whereHas('translations', function ($query) use ($keyword) {
                                     $query
                                         ->where('key', 'description')
                                         ->where('value', 'like', '%' . $keyword . '%');
                                 });
                             })
                             ->addColumn('published', function ($row) {
                                 return Str::limit($row->published);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.reportReason.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.reportReason.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReportReasonRequest $request
     *
     * @return mixed
     */
    public function store(StoreReportReasonRequest $request)
    {
        StoreReportReasonAction::run($request->validated());
        return redirect(route('admin.report-reason.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('reportReason.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(ReportReason $reportReason)
    {
        return view('admin.pages.reportReason.show', compact('reportReason'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param ReportReason $reportReason
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(ReportReason $reportReason)
    {
        return view('admin.pages.reportReason.edit', compact('reportReason'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReportReasonRequest $request
     * @param ReportReason              $reportReason
     *
     * @return mixed
     */
    public function update(UpdateReportReasonRequest $request, ReportReason $reportReason)
    {
        UpdateReportReasonAction::run($reportReason, $request->validated());
        return redirect(route('admin.report-reason.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('reportReason.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param ReportReason $reportReason
     *
     * @return mixed
     */
    public function destroy(ReportReason $reportReason)
    {
        DeleteReportReasonAction::run($reportReason);
        return redirect(route('admin.report-reason.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('reportReason.model')]));
    }
}
