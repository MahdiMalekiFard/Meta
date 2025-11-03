<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Message\DeleteMessageAction;
use App\Actions\Message\StoreMessageAction;
use App\Actions\Message\UpdateMessageAction;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Message::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Message::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.message.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.message.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     *
     * @return mixed
     */
    public function store(StoreMessageRequest $request)
    {
        StoreMessageAction::run($request->validated());
        return redirect(route('admin.message.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('message.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return view('admin.pages.message.show',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Message $message
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Message $message)
    {
        return view('admin.pages.message.edit',compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMessageRequest $request
     * @param Message              $message
     *
     * @return mixed
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        UpdateMessageAction::run($message,$request->validated());
        return redirect(route('admin.message.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('message.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     *
     * @return mixed
     */
    public function destroy(Message $message)
    {
        DeleteMessageAction::run($message);
        return redirect(route('admin.message.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('message.model')]));
    }
}
