@php use App\Models\Module;use App\Models\Order;use App\Models\Server;use App\Models\Service;use App\Models\User; @endphp

<x-admin.layout.master
    :title="trans('dashboard.model')">


    <div class="row gy-5 g-xl-10">
        <x-admin.widget.simple-report-cart
            title="مجموع کاربران"
            icon="fa-users"
            :count="User::count()"
        />

        <x-admin.widget.simple-report-cart
            title="سرورهای فعال"
            icon="fa-cloud"
            :count="Server::count()"
        />


        <x-admin.widget.simple-report-cart
            title="سفارشات"
            icon="fa-sack-dollar"
            :count="Order::count()"
        />

    </div>
</x-admin.layout.master>

