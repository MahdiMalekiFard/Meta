@php use App\Enums\BooleanEnum;use App\Enums\PlanTypeEnum;use App\Enums\ModuleEnum; @endphp
<div class="table-responsive">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
        <tr class="fw-bold text-muted">
            <th class="min-w-200px">month</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE1->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE2->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE3->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE4->title()}}</th>
        </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody>

        @foreach([1,3,6,12] as $month)
            <tr>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input disabled class="form-control-flush" type="text" value="قیمت"/>
                    <x-admin.element.input disabled class="form-control-flush" type="text" value="قیمت ویژه"/>
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.1.price')])
                                           wire:model.debounce="prices.{{$month}}.1.price"
                                           name="prices[{{$month}}][1][price]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.1.price_special')])
                                           wire:model.debounce="prices.{{$month}}.1.price_special"
                                           name="prices[{{$month}}][1][price_special]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.2.price')])
                                           wire:model.debounce="prices.{{$month}}.2.price"
                                           name="prices[{{$month}}][2][price]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.2.price_special')])
                                           wire:model.debounce="prices.{{$month}}.2.price_special"
                                           name="prices[{{$month}}][2][price_special]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.3.price')])
                                           wire:model.debounce="prices.{{$month}}.3.price"
                                           name="prices[{{$month}}][3][price]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.3.price_special')])
                                           wire:model.debounce="prices.{{$month}}.3.price_special"
                                           name="prices[{{$month}}][3][price_special]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.4.price')])
                                           wire:model.debounce="prices.{{$month}}.4.price"
                                           name="prices[{{$month}}][4][price]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                    <x-admin.element.input type="number"
                                           @class(['is-invalid' => $errors->has('prices.'.$month.'.4.price_special')])
                                           wire:model.debounce="prices.{{$month}}.4.price_special"
                                           name="prices[{{$month}}][4][price_special]"
                                           wire:change.debounce="priceUpdatedEvent"
                    />
                </td>
            </tr>
        @endforeach

        </tbody>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>