<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Report\DeleteReportAction;
use App\Actions\Report\StoreReportAction;
use App\Actions\Report\UpdateReportAction;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Report;
use App\Models\Ticket;
use App\Services\GetReference;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Report::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Report::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.report.index_options', ['row' => $row]);
                             })
                             ->addColumn('user_id', function ($row) {
                                 return Str::limit($row->user->name);
                             })
                             ->addColumn('report_reason_id', function ($row) {
                                 return Str::limit($row->report_reason_id);
                             })
                             ->addColumn('reportable_type', function ($row) {
                                 return GetReference::reference($row->reportable_type);
                             })
                             ->addColumn('reportable_id', function ($row) {
                                 return Str::limit($row->reportable->title);
                             })
                             ->addColumn('message', function ($row) {
                                 return Str::limit($row->message);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.report.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.report.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReportRequest $request
     *
     * @return mixed
     */
    public function store(StoreReportRequest $request)
    {
        StoreReportAction::run($request->validated());
        return redirect(route('admin.report.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('report.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return view('admin.pages.report.show', compact('report'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Report $report
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Report $report)
    {
        return view('admin.pages.report.edit', compact('report'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateReportRequest $request
     * @param Report              $report
     *
     * @return mixed
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        UpdateReportAction::run($report, $request->validated());
        return redirect(route('admin.report.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('report.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Report $report
     *
     * @return mixed
     */
    public function destroy(Report $report)
    {
        DeleteReportAction::run($report);
        return redirect(route('admin.report.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('report.model')]));
    }
}
