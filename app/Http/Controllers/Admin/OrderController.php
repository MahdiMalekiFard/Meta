<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Order\DeleteOrderAction;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Order::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.order.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderRequest $request
     *
     * @return mixed
     */
    public function store(StoreOrderRequest $request)
    {
        StoreOrderAction::run($request->validated());
        return redirect(route('admin.order.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('order.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('admin.pages.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Order $order)
    {
        return view('admin.pages.order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderRequest $request
     * @param Order              $order
     *
     * @return mixed
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        UpdateOrderAction::run($order,$request->validated());
        return redirect(route('admin.order.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('order.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     *
     * @return mixed
     */
    public function destroy(Order $order)
    {
        DeleteOrderAction::run($order);
        return redirect(route('admin.order.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('order.model')]));
    }
}
