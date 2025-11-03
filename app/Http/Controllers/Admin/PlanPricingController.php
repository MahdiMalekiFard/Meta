<?php

namespace App\Http\Controllers\Admin;

use App\Actions\PlanPricing\DeletePlanPricingAction;
use App\Actions\PlanPricing\StorePlanPricingAction;
use App\Actions\PlanPricing\UpdatePlanPricingAction;
use App\Http\Requests\StorePlanPricingRequest;
use App\Http\Requests\UpdatePlanPricingRequest;
use App\Models\PlanPricing;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PlanPricingController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(PlanPricing::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.plan_pricing.index_options', ['row' => $row]);
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.plan_pricing.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.plan_pricing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlanPricingRequest $request
     *
     * @return mixed
     */
    public function store(StorePlanPricingRequest $request)
    {
        StorePlanPricingAction::run($request->validated());
        return redirect(route('admin.plan-pricing.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('planPricing.model')]));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanPricing $planPricing)
    {
        return view('admin.pages.planPricing.show',compact('planPricing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PlanPricing $planPricing
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(PlanPricing $planPricing)
    {
        return view('admin.pages.plan_pricing.edit',compact('planPricing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlanPricingRequest $request
     * @param PlanPricing              $planPricing
     *
     * @return mixed
     */
    public function update(UpdatePlanPricingRequest $request, PlanPricing $planPricing)
    {
        UpdatePlanPricingAction::run($planPricing,$request->validated());
        return redirect(route('admin.plan-pricing.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('planPricing.model')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlanPricing $planPricing
     *
     * @return mixed
     */
    public function destroy(PlanPricing $planPricing)
    {
        DeletePlanPricingAction::run($planPricing);
        return redirect(route('admin.plan-pricing.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('planPricing.model')]));
    }
}
