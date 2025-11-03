@php use App\Enums\BooleanEnum;use App\Enums\PlanTypeEnum;use App\Enums\ModuleEnum; @endphp
<div class="table-responsive">
    <!--begin::Table-->
    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
        <!--begin::Table head-->
        <thead>
        <tr class="fw-bold text-muted">
            <th class="min-w-200px">Modules</th>
            <th class="min-w-150px">Sort</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE1->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE2->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE3->title()}}</th>
            <th class="min-w-150px">{{PlanTypeEnum::TYPE4->title()}}</th>
            <th class="min-w-150px">aaa</th>
        </tr>
        </thead>
        <!--end::Table head-->
        <!--begin::Table body-->
        <tbody>
        @foreach($modules as $index=>$module)
            <tr>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.select
                        :name="'modules['.$index.'][key]'"
                        :wire:model.live="'modules.'.$index.'.key'"
                        :type="ModuleEnum::class"
                    />
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    <x-admin.element.input type="number" :disabled="!$module['editable']"
                                           :wire:model.live="'modules.'.$index.'.sort'"
                                           :name="'modules['.$index.'][sort]'"
                    />
                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    @if(!$module['limitable'])
                        <x-admin.element.select
                            :type="BooleanEnum::class"
                            :wire:model.live="'modules.'.$index.'.plan_type_1'"
                            :name="'modules['.$index.'][plan_type_1]'"
                        />
                    @else
                        <x-admin.element.input type="number" :disabled="!$module['editable']"
                                               :wire:model.live="'modules.'.$index.'.plan_type_1'"
                                               :name="'modules['.$index.'][plan_type_1]'"
                        />
                    @endif

                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    @if(!$module['limitable'])
                        <x-admin.element.select
                            :type="BooleanEnum::class"
                            :wire:model.live="'modules.'.$index.'.plan_type_2'"
                            :name="'modules['.$index.'][plan_type_2]'"
                        />
                    @else
                        <x-admin.element.input type="number" :disabled="!$module['editable']"
                                               :wire:model.live="'modules.'.$index.'.plan_type_2'"
                                               :name="'modules['.$index.'][plan_type_2]'"
                        />
                    @endif

                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    @if(!$module['limitable'])
                        <x-admin.element.select
                            :type="BooleanEnum::class"
                            :wire:model.live="'modules.'.$index.'.plan_type_3'"
                            :name="'modules['.$index.'][plan_type_3]'"
                        />
                    @else
                        <x-admin.element.input type="number" :disabled="!$module['editable']"
                                               :wire:model.live="'modules.'.$index.'.plan_type_3'"
                                               :name="'modules['.$index.'][plan_type_3]'"
                        />
                    @endif

                </td>
                <td class="text-dark fw-bold text-hover-primary fs-6">
                    @if(!$module['limitable'])
                        <x-admin.element.select
                            :type="BooleanEnum::class"
                            :wire:model.live="'modules.'.$index.'.plan_type_4'"
                            :name="'modules['.$index.'][plan_type_4]'"
                        />
                    @else
                        <x-admin.element.input type="number" :disabled="!$module['editable']"
                                               :wire:model.live="'modules.'.$index.'.plan_type_4'"
                                               :name="'modules['.$index.'][plan_type_4]'"
                        />
                    @endif

                </td>
                <td class="text-end">
                    <button hidden wire:click="enableEdit({{$module['key']}})" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <i class="fad fa-pen fs-2"> </i>
                    </button>
                    <button wire:click="removeRow({{$index}})" type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                        <i class="fad fa-trash fs-2"></i>
                    </button>
                </td>
            </tr>
        @endforeach

        </tbody>
        <tfoot>
        <tr>
            <button class="btn btn-primary" type="button" wire:click="addModule">Add Module</button>
        </tr>
        </tfoot>
        <!--end::Table body-->
    </table>
    <!--end::Table-->
</div>