<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Subscription\DeleteSubscriptionAction;
use App\Actions\Subscription\StoreSubscriptionAction;
use App\Actions\Subscription\UpdateSubscriptionAction;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Models\Ticket;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionController extends BaseWebController
{
    public function __construct()
    {
        $this->authorizeResource(Subscription::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Subscription::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.subscription.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.subscription.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.subscription.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSubscriptionRequest $request
     *
     * @return mixed
     */
    public function store(StoreSubscriptionRequest $request)
    {
        StoreSubscriptionAction::run($request->validated());
        return redirect(route('admin.subscription.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('subscription.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        return view('admin.pages.subscription.show',compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Subscription $subscription
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Subscription $subscription)
    {
        return view('admin.pages.subscription.edit',compact('subscription'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSubscriptionRequest $request
     * @param Subscription              $subscription
     *
     * @return mixed
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        UpdateSubscriptionAction::run($subscription,$request->validated());
        return redirect(route('admin.subscription.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('subscription.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subscription $subscription
     *
     * @return mixed
     */
    public function destroy(Subscription $subscription)
    {
        DeleteSubscriptionAction::run($subscription);
        return redirect(route('admin.subscription.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('subscription.model')]));
    }
}
