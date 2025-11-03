<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Plan\DeletePlanAction;
use App\Actions\Plan\StorePlanAction;
use App\Actions\Plan\UpdatePlanAction;
use App\Http\Requests\StorePlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Yajra\Column\TitleColumn;
use App\Yajra\Column\UpdatedAtAtColumn;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PlanController extends BaseWebController
{
    /**
     * Display a listing of the resource.
     *
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Plan::query())
                             ->addIndexColumn()
                             ->addColumn('actions', function ($row) {
                                 return view('admin.pages.plan.index_options', ['row' => $row]);
                             })
                             ->addColumn('title', new TitleColumn())
                             ->addColumn('updated_at', new UpdatedAtAtColumn())
                             ->addColumn('service', function ($row) {
                                 return $row->planable->title . ' (' . $row->planable->key . ')';
                             })
                             ->orderColumns(['id'], '-:column $1')
                             ->make(true);
        }
        return view('admin.pages.plan.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(ServiceRepositoryInterface $serviceRepository)
    {
        $services = $serviceRepository->get();
        return view('admin.pages.plan.create', compact('services'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlanRequest $request
     *
     * @return mixed
     */
    public function store(StorePlanRequest $request)
    {
        $formatedArray = $this->formatPricingArray($request->input('prices', []));
        $payload = array_merge($request->validated(), ['prices' => $formatedArray]);
        StorePlanAction::run($payload);
        return redirect(route('admin.plan.index'))->withToastSuccess(trans('general.store_success', ['model' => trans('plan.model')]));
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        return view('admin.pages.plan.show', compact('plan'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Plan                       $plan
     * @param ServiceRepositoryInterface $serviceRepository
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Plan $plan, ServiceRepositoryInterface $serviceRepository)
    {
        $plan->load([
            'pricings' => function ($query) {
                $query->orderBy('month');
            },
        ]);
        $services = $serviceRepository->get();
        return view('admin.pages.plan.edit', compact('plan', 'services'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlanRequest $request
     * @param Plan              $plan
     *
     * @return mixed
     */
    public function update(UpdatePlanRequest $request, Plan $plan)
    {
        $formatedArray = $this->formatPricingArray($request->input('prices', []));
        $payload = array_merge($request->validated(), ['prices' => $formatedArray]);
        UpdatePlanAction::run($plan, $payload);
        return redirect(route('admin.plan.index'))->withToastSuccess(trans('general.update_success', ['model' => trans('plan.model')]));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param Plan $plan
     *
     * @return mixed
     */
    public function destroy(Plan $plan)
    {
        DeletePlanAction::run($plan);
        return redirect(route('admin.plan.index'))->withToastSuccess(trans('general.delete_success', ['model' => trans('plan.model')]));
    }
    
    private function formatPricingArray(array $array): array
    {
        $prices = [];
        
        foreach ($array as $month => $plans) {
            $newPlans = [];
            foreach ($plans as $planType => $price) {
                $newPlans[$planType] = [
                    'price'         => $price['price'],
                    'price_special' => $price['price_special'],
                ];
            }
            
            $prices[] = [
                'month' => $month,
                'plans' => $newPlans,
            ];
        }
        
        return $prices;
    }
}
