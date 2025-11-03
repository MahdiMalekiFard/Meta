<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="/assets/media/logos/logo-square.jpg"/>
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">
                    {{auth()->user()->full_name}} <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                </div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                    {{auth()->user()->email}} </a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="?page=account/overview" class="menu-link px-5">
            {{__('_menu.profile')}}
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="?page=apps/projects/list" class="menu-link px-5">
            <span class="menu-text">My Projects</span>
            <span class="menu-badge">
                <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
            </span>
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
{{--    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">--}}
{{--        <a href="#" class="menu-link px-5">--}}
{{--                <span class="menu-title position-relative">--}}
{{--                    Mode--}}
{{--                    <span class="ms-5 position-absolute translate-middle-y top-50 end-0">--}}
{{--                        <i class="ki-solid ki-night-day theme-light-show fs-2"></i>                        <i class="ki-solid ki-moon theme-dark-show fs-2"></i>                    </span>--}}
{{--                </span>--}}
{{--        </a>--}}
{{--        @include('admin.partials.theme-mode.__menu')--}}
{{--    </div>--}}
    <!--end::Menu item-->
    <!--begin::Menu item-->
{{--    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">--}}
{{--        <a href="#" class="menu-link px-5">--}}
{{--            <span class="menu-title position-relative">--}}
{{--                Language--}}
{{--                <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">--}}
{{--                    @if(app()->getLocale()=='en')--}}
{{--                        English <img class="w-15px h-15px rounded-1 ms-2" src="/assets/media/flags/united-states.svg" alt=""/>--}}
{{--                    @elseif(app()->getLocale()=='fa')--}}
{{--                        Persian <img class="w-15px h-15px rounded-1 ms-2" src="/assets/media/flags/iran.svg" alt=""/>--}}
{{--                    @endif--}}
{{--                </span>--}}
{{--            </span>--}}
{{--        </a>--}}
{{--        <!--begin::Menu sub-->--}}
{{--        <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
{{--            <!--begin::Menu item-->--}}
{{--            <div class="menu-item px-3">--}}
{{--                <a href="{{route('admin.change-locale',['lang'=>'en'])}}" class="menu-link d-flex px-5 {{app()->getLocale()=='en'?'active':''}}">--}}
{{--                    <span class="symbol symbol-20px me-4">--}}
{{--                        <img class="rounded-1" src="/assets/media/flags/united-states.svg" alt=""/>--}}
{{--                    </span>--}}
{{--                    English--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <!--end::Menu item-->--}}
{{--            <!--begin::Menu item-->--}}
{{--            <div class="menu-item px-3">--}}
{{--                <a href="{{route('admin.change-locale',['lang'=>'fa'])}}" class="menu-link d-flex px-5 {{app()->getLocale()=='fa'?'active':''}}">--}}
{{--                    <span class="symbol symbol-20px me-4">--}}
{{--                        <img class="rounded-1" src="/assets/media/flags/iran.svg" alt=""/>--}}
{{--                    </span>--}}
{{--                    Persian--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <!--end::Menu item-->--}}
{{--        </div>--}}
{{--        <!--end::Menu sub-->--}}
{{--    </div>--}}
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5 my-1">
        <a href="?page=account/settings" class="menu-link px-5">
            Settings
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{route('auth.logout',['locale'=>config('app.fallback_locale')])}}" class="menu-link px-5">
            Sign Out
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->