<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Ticket\DeleteTicketAction;
use App\Actions\Ticket\StoreTicketAction;
use App\Actions\Ticket\ToggleTicketAction;
use App\Actions\Ticket\UpdateTicketAction;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Repositories\Ticket\TicketRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class TicketController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Ticket::class);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request, AdvancedSearchFieldsService $searchFieldsService, TicketRepositoryInterface $repository)
    {
        if ($request->ajax()) {
            return Datatables::of($repository->builder(array_merge($request->all(), [
                'search' => $request->input('search.value'),
            ])))
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.ticket.index_options', ['row' => $row]);
                             })
                             ->addColumn('subject', function ($row) {
                                 return Str::limit($row->subject, 50) ?? '';
                             })
                             ->addColumn('description', function ($row) {
                                 return Str::limit($row->description, 50) ?? '';
                             })
                             ->addColumn('department', function ($row) {
                                 return $row->department->title() ?? '';
                             })
                             ->addColumn('status', function ($row) {
                                 return $row->status->title();
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.ticket.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.ticket.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTicketRequest $request
     *
     * @return mixed
     */
    public function store(StoreTicketRequest $request)
    {
        StoreTicketAction::run($request->validated());
        return redirect(route('admin.ticket.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('ticket.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.pages.ticket.show', compact('ticket'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.pages.ticket.edit', compact('ticket'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTicketRequest $request
     * @param Ticket              $ticket
     *
     * @return mixed
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        UpdateTicketAction::run($ticket, $request->validated());
        return redirect(route('admin.ticket.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('ticket.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     *
     * @return mixed
     */
    public function destroy(Ticket $ticket)
    {
        DeleteTicketAction::run($ticket);
        return redirect(route('admin.ticket.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('ticket.model')]));
    }
    
    public function toggle(Ticket $ticket)
    {
        ToggleTicketAction::run($ticket);
        return redirect(route('admin.ticket.index'))->withToastSuccess(trans('general.toggle_success', ['model' => trans('ticket.model')]));
    }
}
