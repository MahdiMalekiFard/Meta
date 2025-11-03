<?php

namespace App\Http\Controllers\Admin;

use App\Actions\OrderItem\DeleteOrderItemAction;
use App\Actions\OrderItem\StoreOrderItemAction;
use App\Actions\OrderItem\UpdateOrderItemAction;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderItemController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(OrderItem::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.order_item.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.order_item.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.order_item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrderItemRequest $request
     *
     * @return mixed
     */
    public function store(StoreOrderItemRequest $request)
    {
        StoreOrderItemAction::run($request->validated());
        return redirect(route('admin.order-item.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('orderItem.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        return view('admin.pages.orderItem.show',compact('orderItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param OrderItem $orderItem
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(OrderItem $orderItem)
    {
        return view('admin.pages.order_item.edit',compact('orderItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateOrderItemRequest $request
     * @param OrderItem              $orderItem
     *
     * @return mixed
     */
    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem)
    {
        UpdateOrderItemAction::run($orderItem,$request->validated());
        return redirect(route('admin.order-item.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('orderItem.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OrderItem $orderItem
     *
     * @return mixed
     */
    public function destroy(OrderItem $orderItem)
    {
        DeleteOrderItemAction::run($orderItem);
        return redirect(route('admin.order-item.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('orderItem.model')]));
    }
}
